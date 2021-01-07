<!--Page Content-->
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
        {if isset($smarty.session.notification)}
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-{$smarty.session.notification.result}" role="alert">
                        {$smarty.session.notification.message}
                    </div>
                </div>
            </div>
        {/if}
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
    </div>