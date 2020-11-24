<div class="row">

    <div class="col-md-12 col-md-offset-2">
        <form class="form-vertical" method="POST" action="index.php?uc=changerMDP&action=nouveauMotDePasse">
            <fieldset>
                <legend>Modifier le mot de passe:</legend>
                <div class="form-group">
                    <label for="nom">Ancien mot de passe :</label>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <input class="form-control" id="oldMDP" type="password" name="oldMDP" size="30" maxlength="45" placeholder="Ancien mot de passe" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nom">Nouveau mot de passe : (doit contenir au moins 8 caractères, 1 minuscule et 1 majuscule)</label>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <input class="form-control" id="nMDP" type="text" name="nMDP" size="30" maxlength="45" placeholder="Ancien mot de passe" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nom">Confirmer nouveau mot de passe (doit contenir au moins 8 caractères, 1 minuscule et 1 majuscule)</label>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <input class="form-control" id="nMDPBis" type="text" name="nMDPBis" size="30" maxlength="45" placeholder="Nouveau mot de passe" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                        </div>
                    </div>
                </div>
                <div>
                    <?php
                    if (isset($_REQUEST['erreurs'])) {
                        foreach ($_REQUEST['erreurs'] as $erreur) {
                            echo '<h1 class="text-danger">' . $erreur . '</h1>';
                        }
                    }
                    ?>
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
                <button type="reset" class="btn btn-primary">annuler</button>
            </fieldset>
        </form>

    </div>
</div>