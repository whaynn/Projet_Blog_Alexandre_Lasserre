<?php
require_once 'config/config.conf.php';
require_once 'config/bdd.conf.php';
//print_r2($_SESSION); (debug)
//print_r2($_GET); (debug)
if (isset($_GET['submitRecherche'])) {
    $recherche = $_GET['recherche'];
    $articleManager = new articleManager($bdd);
    $listeArticles = $articleManager->getListArticlesFromRecherche($recherche);
    //print_r2($listeArticles); (debug)
    include_once 'includes/header.inc.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mt-5">Résultat de vos recherches :</h1>
                <br>
                <ul class="list-unstyled">
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </div>
        <?php if (isset($_SESSION['notification'])) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-<?= $_SESSION['notification']['result'] ?>" role="alert">
                        <?= $_SESSION['notification']['message'] ?>
                    </div>
                </div>
            </div>
            <?php
            unset($_SESSION['notification']);
        }
        ?>

        <div class="row">
            <?php
            foreach ($listeArticles as $key => $article) {
                ?>
                <div class="col-md-6">
                    <div class="card" style="">
                        <img src="img/<?= $article->getId(); ?>.jpg" class="card-img-top" alt="<?= $article->getTitre(); ?>" style="width:100px">
                        <div class="card-body">
                            <h5 class="card-title"><?= $article->getTitre(); ?></h5>
                            <p class="card-text"><?= substr($article->getTexte(), 0, 150) . '...'; ?></p>
                            <a href="#" class="btn btn-primary"><?= $article->getDate(); ?></a>
                            <?php if ($userConnecte->isConnect == true) { ?>
                                <a href="article.php?id=<?= $article->getId(); ?>" class="btn btn-warning">Modifier</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
<br>
    <center><a href="index.php" class="btn btn-dark">Retour</a></center>  
    <?php
    include_once 'includes/footer.inc.php';
} else {
    header("Location: index.php");
}
?>
