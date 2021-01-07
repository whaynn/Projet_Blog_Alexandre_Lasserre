<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Projet Blog en PHP</title>

        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="vendor/css/style.css" rel="stylesheet">

    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">Blog Alexandre LASSERRE</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Accueil
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <?php
                        // Si l'utilisateur est connecter on le laisse acceder a la page pour crée des articles
                        if ($userConnecte->isConnect == true) {
                            ?>

                            <li class="nav-item">
                                <a class="nav-link" href="article.php">Articles</a>
                            </li>
                            <?php
                        }
                        ?>
                        <?php
                         // Si l'utilisateur n'est pas connecter on le laisse acceder a la page pour crée un compte
                        if ($userConnecte->isConnect == false) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="user.php">Création de Compte</a>
                            </li>

                            <?php
                        }
                        ?>
                        <?php
                        // Si l'utilisateur n'est pas connecter on le laisse acceder a la page de connexion
                        if ($userConnecte->isConnect == false) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="connexion.php">Connexion</a>
                            </li>
                            <?php
                            // Si l'utilisateur est connecter on le laisse se déconnecter 
                        } else {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                            </li>
                            <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </nav>
