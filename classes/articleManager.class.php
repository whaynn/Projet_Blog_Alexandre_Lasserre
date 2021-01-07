<?php

class articleManager {

    //declarations et instanciations 
    private $bdd; //Instance de la base de donnée
    private $result;
    private $message;
    private $article;
    private $getLastInsertId;

    public function __construct(PDO $bdd) {
        $this->setBdd($bdd);
    }

    function getBdd() {
        return $this->bdd;
    }

    function getResult() {
        return $this->result;
    }

    function getMessage() {
        return $this->message;
    }

    function getArticle() {
        return $this->article;
    }

    function getGetLastInsertId() {
        return $this->getLastInsertId;
    }

    function setBdd($bdd): void {
        $this->bdd = $bdd;
    }

    function setResult($result): void {
        $this->result = $result;
    }

    function setMessage($message): void {
        $this->message = $message;
    }

    function setArticle($article): void {
        $this->article = $article;
    }

    function setGetLastInsertId($getLastInsertId): void {
        $this->getLastInsertId = $getLastInsertId;
    }

    public function get($id) { //Récupere les donées pour l'id choisi
        $sql = 'SELECT * FROM article WHERE id = :id';
        $req = $this->bdd->prepare($sql);

        // Attribution d'une valeur entiere (l'id : marqueurs nominatifs) puis execution de la requête 
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        // stockage des données dans un tableau (fetch)
        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        $article = new article();
        $article->hydrate($donnees);

        return $article;
    }

    public function getList() {
        $listArticle = [];

        // Permet de préparer une requête (ici un SELECT qui va permetre ensuite de lister les articles)
        $sql = 'SELECT id, '
                . 'titre, '
                . 'texte, '
                . 'publie, '
                . 'DATE_FORMAT(date, "%d/%m/%Y") as date '
                . 'FROM article';
        $req = $this->bdd->prepare($sql);

        // Exécution de la requête : Attribution des valeurs aux marqueurs nominatifs
        $req->execute();

        // stockage des données dans un tableau (fetch)
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            $article = new article();
            $article->hydrate($donnees);
            $listArticle[] = $article;
        }
        //print_r2($listArticle); //Debug
        return $listArticle;
    }

    //Fonction permettant d'ajouter un article (avec insert)
    public function add(article $article) {
        $sql = "INSERT INTO article "
                . "(titre, texte, publie, date) "
                . "VALUES (:titre, :texte, :publie, :date)";
        $req = $this->bdd->prepare($sql);
        // Cette syntaxe permet de sécurisé les variables (on ne laisse pas l'utilisateur rentrer ce qu'il veut on fait une vérification)
        $req->bindValue(':titre', $article->getTitre(), PDO::PARAM_STR);
        $req->bindValue(':texte', $article->getTexte(), PDO::PARAM_STR);
        $req->bindValue(':publie', $article->getPublie(), PDO::PARAM_INT);
        $req->bindValue(':date', $article->getDate(), PDO::PARAM_STR);
        //Exécuter la requête
        $req->execute();
        if ($req->errorCode() == 00000) {
            $this->result = true;
            $this->getLastInsertId = $this->bdd->lastInsertId();
        } else {
            $this->result = false;
        }
        return $this;
    }

    // Fonction qui permet de compter le nombre d'article publié grâce à la fonction COUNT
    public function countArticlePublie() {
        $sql = "SELECT COUNT(*)as total FROM article "
                . "WHERE publie = 1";
        $req = $this->bdd->prepare($sql);
        $req->execute();
        $count = $req->fetch(PDO::FETCH_ASSOC);
        $total = $count['total'];

        return $total;
    }

    // Fonction qui permet d'avoir une liste des articles publiés
    public function getListArticleAAfficher($depart, $limit) {
        $listArticle = [];

        // Requete SELECT pour prendre les informations néccesaire puis un WHERE sur le publie qui permet de ne choisir que les articles publiés
        $sql = 'SELECT id,'
                . 'titre,'
                . 'texte,'
                . 'publie,'
                . 'DATE_FORMAT(date, "%d/%m/%Y") as date '
                . 'FROM article '
                . 'WHERE publie = 1 '
                . 'LIMIT :depart, :limit';
        $req = $this->bdd->prepare($sql);

        $req->bindValue(':depart', $depart, PDO::PARAM_INT);
        $req->bindValue(':limit', $limit, PDO::PARAM_INT);
        // Exécution de la requête : Attribution des valeurs aux marqueurs nominatifs
        $req->execute();

        // stockage des données dans un tableau (fetch)
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            $article = new article();
            $article->hydrate($donnees);
            $listArticle[] = $article;
        }
        //print_r2($listArticle);  debug
        return $listArticle;
    }

    // Fonction qui permet de mettre à jour un article (Grace a son id unique)
    public function update(article $article) {
        //print_r2($article); debug
        $sql = "UPDATE article SET "
                . "titre = :titre, "
                . "texte = :texte, "
                . "publie = :publie "
                . "WHERE id = :id";
        $req = $this->bdd->prepare($sql);
        $req->bindValue(':titre', $article->getTitre(), PDO::PARAM_STR);
        $req->bindValue(':texte', $article->getTexte(), PDO::PARAM_STR);
        $req->bindValue(':publie', $article->getPublie(), PDO::PARAM_INT);
        $req->bindValue(':id', $article->getId(), PDO::PARAM_INT);
        $req->execute();
        if ($req->errorCode() == 00000) {
            $this->result = true;
            $this->getLastInsertId = $article->getId();
        } else {
            $this->result = false;
        }
        return $this;
    }

    //Fonction permettant une recherche dans les articles par mots-clés (dans le texte et le titre)
    public function getListArticlesFromRecherche($recherche) {
        $listArticle = [];

        $sql = 'SELECT id, '
                . 'titre, '
                . 'texte, '
                . 'publie, '
                . 'DATE_FORMAT(date, "%d/%m/%Y") as date '
                . 'FROM article '
                . 'WHERE publie = 1 '
                . 'AND (titre LIKE :recherche '
                . 'OR texte LIKE :recherche)';
        $req = $this->bdd->prepare($sql);

        $req->bindValue(':recherche', "%" . $recherche . "%", PDO::PARAM_STR);

        $req->execute();

        while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            //Créations d'objets avec les données de la table
            $article = new article();
            $article->hydrate($donnees);
            $listArticle[] = $article;
        }

        //print_r2($listArticle); debug
        return $listArticle;
    }

}
