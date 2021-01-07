<?php
/* Smarty version 3.1.34-dev-7, created on 2020-12-30 22:02:22
  from 'C:\wamp64\www\asrprojet\templates\connexion.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5fecf8ee757b18_09080288',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a870a571f1c68606810bc52fc9630cd97158c07e' => 
    array (
      0 => 'C:\\wamp64\\www\\asrprojet\\templates\\connexion.tpl',
      1 => 1609365440,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fecf8ee757b18_09080288 (Smarty_Internal_Template $_smarty_tpl) {
?><!--Page Content-->
    <div class = "container">
        <div class = "row">
            <div class = "col-lg-12 text-center">
                <h1 class = "mt-5">Connectez-vous</h1>
                <p class = "lead"></p>
                <ul class = "list-unstyled">
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </div>
        <?php if ((isset($_SESSION['notification']))) {?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-<?php echo $_SESSION['notification']['result'];?>
" role="alert">
                        <?php echo $_SESSION['notification']['message'];?>

                    </div>
                </div>
            </div>
        <?php }?>
        <div class="row">
            <div class = "col-lg-6 offset-lg-3">
                <form id="userform" method="POST" action="connexion.php" enctype="multipart/form-data">
                    <div class = "col-lg-12">
                        <div class="form-group">
                            <label for="mail">Mail</label>
                            <input type="texte" name="mail" class="form-control" id="mail" value="" placeholder="" required="">
                        </div>
                    </div>
                    <div class = "col-lg-12">
                        <div class="form-group">
                            <label for="mdp">Mot de passe</label>
                            <input type="password" name="mdp" class="form-control" id="mdp" value="" placeholder="" required="">
                        </div>
                    </div>
                    <div class = "col-lg-12">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Connexion</button>
                    </div>
                </form>
            </div>
        </div>
    </div><?php }
}
