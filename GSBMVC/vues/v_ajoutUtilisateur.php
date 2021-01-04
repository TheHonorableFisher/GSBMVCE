<form method="post" action="index.php?uc=creerUtilisateur&action=ValiderUtilisateur">

    <div class="row">

        <div class="col-md-12 col-md-offset-2">
            <fieldset>
                <legend>Création utilisateur</legend>
        </div>
        <div class="form-group">
            <label for="nom">Identifiant</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <input class="form-control" id="id" type="text" name="id" size="30" maxlength="4" pattern="[A-Za-z]{1,45}" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="nom">Nom</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <input class="form-control" id="nom" type="text" name="nom" size="30" maxlength="45" pattern="[A-Za-z]{1,45}" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <input class="form-control" id="prenom" type="text" name="prenom" size="30" maxlength="45" pattern="[A-Za-z]{1,45}" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="num">Numéro Téléphone au format 0709050806</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <input class="form-control" id="num" type="text" name="num" size="30" maxlength="10" pattern="[0-9]{10}" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <input class="form-control" id="adresse" type="texte" name="adresse" size="30" maxlength="45" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="cp">Code Postal</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <input class="form-control" id="cp" type="texte" name="cp" size="30" maxlength="5" pattern="[0-9]{5}" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="ville">Ville</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <input class="form-control" id="ville" type="texte" name="ville" size="30" maxlength="45" pattern="[A-Za-z]{2,45}" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="date_embauche">Date Embauche (aaaa-mm-jj) avant 2099</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <input class="form-control" id="date_embauche" type="date" name="date_embauche" size="30" maxlength="10" min="1970-01-01" max="2999-12-31" required>
                </div>
            </div>
        </div>
        <label for="role">Rôle</label>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <input class="form-control" id="role_Visiteur" type="radio" name="role" value="role_Visiteur">Visiteur :</input>
                <input class="form-control" id="role" type="radio" name="role" value="role_Delegue">Délégué</input>
            </div>
        </div>
        <label for="region_affectation">Région affectation</label>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <input class="form-control" id="region_affectation" type="texte" name="region_affectation" size="30" maxlength="45" pattern="[A-Za-z]{1,45}">
            </div>
        </div>
    </div>
    </br>
    <button type="submit" class="btn btn-primary">Valider</button>
    <button type="reset" class="btn btn-primary">annuler</button>
    </fieldset>

</form>