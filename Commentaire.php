<div class="row">
    <div class = "col-lg-6 offset-lg-3">
        <form id="articleform" method="POST" action="article.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">
            <div class = "col-lg-12">
                <div class="form-group">
                    <label for="titre">Pseudo</label>
                    <input type="texte" name="pseudo" class="form-control" id="pseudo" value="" placeholder="" required="">
                </div>
            </div>

            <div class = "col-lg-6 offset-lg-3">
                <div class = "col-lg-12">
                    <div class="form-group">
                        <label for="titre">mail</label>
                        <input type="texte" name="mail" class="form-control" id="mail" value="" placeholder="" required="">
                    </div>
                </div>

                <div class = "col-lg-6 offset-lg-3">
                    <div class = "col-lg-12">
                        <div class="form-group">
                            <label for="texte">Contenu du commentaire</label>
                            <textarea class="form-control" id="texte" name="texte" rows="3" required=""></textarea>

                        </div>
                    </div>
                    <button type = "submit" id = "submit" name = "submit" class = "btn btn-primary" value="commentaire">Envoyer mon commentaire</button>
                </div>  
            </div> 
    </div> 
</div> 

<?php
// On verifie que les valuers du pseudo ne sont pas nul puis qu'elle sont bien dans le poste
$pseudo = null;
if (!empty($_POST['pseudo'])) {
    $pseudo = $_POST['pseudo'];
}

// Ensuite pour le contenu
$texte = null;
if (!empty($_POST['texte'])) {
    // On ne laisse pas l'utilisateur mettre n'importe quoi (injection de code)
    $content = htmlspecialchars($_POST['texte']);
}

// On verifie l'id de l'article 
$id_article = null;
if (!empty($_POST['id_article']) && ctype_digit($_POST['id_article'])) {
    $article_id = $_POST['id_article'];
}

// Vérification finale des infos envoyées dans le formulaire par le post
// Si il n'y a pas d'auteur OU qu'il n'y a pas de contenu OU qu'il n'y a pas d'identifiant d'article on renvoie l'erreur
if (!$pseudo || !$id_article || !$texte) {
    die("Votre formulaire a été mal rempli !");
}

//Vérification que l'id de l'article pointe bien vers un article qui existe donc connexion a la bd

$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

$query = $pdo->prepare('SELECT * FROM article WHERE id = :id');
$query->execute(['id' => $id]);

// Si rien n'est revenu, on fait une erreur
if ($query->rowCount() === 0) {
    die("Ho ! L'article $article_id n'existe pas boloss !");
}

// Insertion du commentaire
$query = $pdo->prepare('INSERT INTO commentaire SET pseudo = :pseudo, texte = :texte, id_article = :id_article, created_at = NOW()');
$query->execute(compact('pseudo', 'texte', 'id_article'));

// Redirection vers l'article en question :
header('Location: article.php?id=' . $id);
exit();
