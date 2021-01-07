<?php

session_start();
//Permet d'afficher les erreurs et les avertissements de PHP
error_reporting(E_ALL);
ini_set("display_error", 1);

define('nb_article_par_page', 2);

//Permet de debug plus facilement 
function print_r2($tab_a_afficher_print_r) {
    echo '<pre>';
    print_r($tab_a_afficher_print_r);
    echo '</pre>';
}

function loadClass($class) {
    if (is_file("classes/" . $class . ".class.php")){
        require_once ("classes/" . $class . ".class.php");
    }
}

spl_autoload_register("loadClass");

require_once 'check-connexion.conf.php';
