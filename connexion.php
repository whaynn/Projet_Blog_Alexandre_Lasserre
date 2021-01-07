<?php
require_once 'config/config.conf.php';
require_once 'config/bdd.conf.php';
require_once 'components/smarty/libs/Smarty.class.php';

if (isset($_POST['submit'])) {
    //print_r2($_POST); (debug)
    //print_r2($_FILES);

    //Création de l'utilisateur
    $user = new user();
    $user->hydrate($_POST);

    //Recherche de l'utilisateur dans la base
    $userManager = new userManager($bdd);
    $userEnBdd = $userManager->getByMail($user->getMail());

//print_r2($user);  (debug)
    $isConnect = password_verify($user->getMdp(), $userEnBdd->getMdp());
//var_dump($isConnect); (debug)
    if ($isConnect == true) {
        $sid = md5($user->getMail() . time());
        
        //echo $sid; (debug)
        
        //Création du cookie grace a set cookie
        setcookie("sid", $sid, time() + 86400);
        //mise en bdd du sid
        $user->setSid($sid);
        $userManager->updateByMail($user);
        //var_dump($userManager->getResult()); (debug)
    }
    //Permet d'afficher les erreurs / le bon fonctionnement
    if ($isConnect == true) {
        $_SESSION['notification']['result'] = 'success';
        $_SESSION['notification']['message'] = 'Connexion réussi';
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['notification']['result'] = 'danger';
        $_SESSION['notification']['message'] = 'Mail ou Mot de Passe incorrect';
        header("Location: connexion.php");
        exit();
    }
} else {

$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');

    //echo 'Aucun formulaire posté';

    include_once 'includes/header.inc.php';
    $smarty->display('connexion.tpl');
    include_once 'includes/footer.inc.php';
}
