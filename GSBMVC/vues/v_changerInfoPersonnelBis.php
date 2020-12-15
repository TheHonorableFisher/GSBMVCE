<div class="row">
    <div class="col-md-12 col-md-offset-2">
        <form class="form-vertical" method="POST" action="index.php?uc=gererPersonnel&action=validerChangementInfos">
            <fieldset>
                <legend>Changer Information d'un personnel</legend>
                <div class="form-group">
                    <label>Choisir sa nouvelle région : </label>
                    <select name="newRegion" id="newRegion">
                        <option value="">-- Choisir une option</option>
                        <?php
                            $regions = $pdo->getRegionVisiteur($idVisiteur);
                            foreach ($regions as $key => $value) {
                                echo '<option value=' . "$value[0]" . '>' . $value[0] . '</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Choisir son rôle : </label>          
                    <select name="newRole" id="newRole">
                        <option value="">-- Choisir une option</option>
                        <option value="Visiteur">Visiteur</option>
                        <option value="Délégué">Délégué</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
                <button type="reset" class="btn btn-primary">annuler</button>
            </fieldset>
        </form>

    </div>
</div>