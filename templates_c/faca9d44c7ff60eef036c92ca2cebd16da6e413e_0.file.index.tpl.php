<?php
/* Smarty version 3.1.34-dev-7, created on 2021-01-06 22:29:05
  from 'C:\wamp64\www\asrprojet\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ff639b1baf938_71447943',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'faca9d44c7ff60eef036c92ca2cebd16da6e413e' => 
    array (
      0 => 'C:\\wamp64\\www\\asrprojet\\templates\\index.tpl',
      1 => 1609972144,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ff639b1baf938_71447943 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- Page Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h1 class="mt-5">Sommaire du blog</h1>
      <p class="lead">Les articles postés sont ci-dessous </p>
      <ul class="list-unstyled">
        <li></li>
        <li></li>
      </ul>
    </div>
  </div>
    <div class="row">
    <div class="col-lg-12 text-center mt-5">
      <form class="form-inline" id="rechercheForm" method="GET" action="recherche.php" >
        <label class="sr-only" for="recherche">Recherche</label>
        <input type="text" class="form-control mb-2 mr-sm-2" id="recherche" placeholder="Rechercher un article" name="recherche" value="">
        <button type="submit" class="btn btn-dark mb-2" name="submitRecherche">Rechercher</button>
      </form>
        <ul class="list-unstyled">
            <li></li>
            <li></li>
        </ul>
    </div>
  </div>
    <!--Condition if qui permet d'avoir des notifications en cas de problemes ou de bon fonctionnement-->
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
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listArticle']->value, 'article');
$_smarty_tpl->tpl_vars['article']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->do_else = false;
?>
    <div class="col-md-6">
      <div class="card" style="">
        <img src="img/<?php echo $_smarty_tpl->tpl_vars['article']->value->getId();?>
.jpg" class="card-img-top" alt="<?php echo $_smarty_tpl->tpl_vars['article']->value->getTitre();?>
" style="width:100px">
        <div class="card-body">
          <h5 class="card-title"><?php echo $_smarty_tpl->tpl_vars['article']->value->getTitre();?>
</h5>
          <p class="card-text"><?php echo substr($_smarty_tpl->tpl_vars['article']->value->getTexte(),0,150);?>
...</p>
          <a href="#" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['article']->value->getDate();?>
</a>
          <?php if ($_smarty_tpl->tpl_vars['userConnecte']->value->isConnect == true) {?>
          <a href="article.php?id=<?php echo $_smarty_tpl->tpl_vars['article']->value->getId();?>
" class="btn btn-danger">Modifier</a>
          <?php }?>
          <?php if ($_smarty_tpl->tpl_vars['userConnecte']->value->isConnect == true) {?>
          <a href="commentaire.php?id=<?php echo $_smarty_tpl->tpl_vars['article']->value->getId();?>
" class="btn btn-warning">Commentaire</a>
          <?php }?>
        </div>
      </div>
    </div>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>
<div class="row mt-3">
      <div class="col-12">
           <nav aria-label="Navigation entre les pages">
          <ul class="pagination justify-content-center">
              <?php
$_smarty_tpl->tpl_vars['index'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['index']->step = 1;$_smarty_tpl->tpl_vars['index']->total = (int) ceil(($_smarty_tpl->tpl_vars['index']->step > 0 ? $_smarty_tpl->tpl_vars['nbPage']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['nbPage']->value)+1)/abs($_smarty_tpl->tpl_vars['index']->step));
if ($_smarty_tpl->tpl_vars['index']->total > 0) {
for ($_smarty_tpl->tpl_vars['index']->value = 1, $_smarty_tpl->tpl_vars['index']->iteration = 1;$_smarty_tpl->tpl_vars['index']->iteration <= $_smarty_tpl->tpl_vars['index']->total;$_smarty_tpl->tpl_vars['index']->value += $_smarty_tpl->tpl_vars['index']->step, $_smarty_tpl->tpl_vars['index']->iteration++) {
$_smarty_tpl->tpl_vars['index']->first = $_smarty_tpl->tpl_vars['index']->iteration === 1;$_smarty_tpl->tpl_vars['index']->last = $_smarty_tpl->tpl_vars['index']->iteration === $_smarty_tpl->tpl_vars['index']->total;?>
                  <li class="page-item <?php if (($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['index']->value)) {?>active<?php }?>"><a class="page-link" href="index.php?p=<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['index']->value;?>
</a></li>
              <?php }
}
?>
          </ul>
          </nav>
      </div>
  </div>
</div>
<?php }
}
