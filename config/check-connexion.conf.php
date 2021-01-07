<?php

require_once 'bdd.conf.php';
//Permet de gerer les connexion utilisateur avec création d'un SID unique.
if (isset($_COOKIE['sid'])) {
    $sid = $_COOKIE['sid'];
    $userManager = new userManager($bdd);
    $userConnecte = $userManager->getBySid($sid);
    if ($userConnecte->getMail() != '') {
        $userConnecte->isConnect = true;
    } else {
        $userConnecte->isConnect = false;
    }
} else {
    $userConnecte = new user();
    $userConnecte->isConnect = false;
}
