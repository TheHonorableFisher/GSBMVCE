<form method="post">
    <div class="row">

        <div class="col-md-12 col-md-offset-2">
            <fieldset>
                <legend> Vous allez modifiez information personnelle d'un utilisateur</legend>
        </div>
        <div class="form-group">
            <label for="tele">Numéro Téléphone au format 0709050806</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <input class="form-control" id="tele" type="text" name="tele" size="30" maxlength="10" pattern="[0-9]{10}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                <input class="form-control" id="adresse" type="texte" name="adresse" size="30" maxlength="45">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="cp">Code Postal</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <input class="form-control" id="cp" type="texte" name="cp" size="30" maxlength="5" pattern="[0-9]{5}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="ville">Ville</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <input class="form-control" id="ville" type="texte" name="ville" size="30" maxlength="45" pattern="[A-Za-z]{2,45}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
        <button type="reset" class="btn btn-primary">annuler</button>
        </fieldset>
</form>