<?php
require_once 'config/config.conf.php';
require_once 'config/bdd.conf.php';
require_once 'components/smarty/libs/Smarty.class.php';

//$articleManager = new articleManager($bdd); (debug)
//print_r2($newArticle); (debug)

$page = !empty($_GET['p']) ? ($_GET['p']) : 1;

$articleManager = new articleManager($bdd);

//Avoir le nombre d'article qu'il faut publiée pour l'index

$nbArticleTotalAPublie = $articleManager->countArticlePublie();

//Permet d'avoir un point de départ pour l'index

$indexDepart = ($page - 1) * nb_article_par_page;

//Permet de choisir le nb d'article par page

$nbPage = ceil($nbArticleTotalAPublie / nb_article_par_page);

//Permet d'établir l'index

$listArticle = $articleManager->getListArticleAAfficher($indexDepart, nb_article_par_page);
//print_r2($_SESSION); (debug)

$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');

$smarty->assign('listArticle', $listArticle);
$smarty->assign('userConnecte', $userConnecte);
$smarty->assign('nbPage', $nbPage);
$smarty->assign('page', $page);

include_once 'includes/header.inc.php';

$smarty->display('index.tpl');

include_once 'includes/footer.inc.php';

unset($_SESSION['notification']);
