<div class="row">
    <div class="col-md-12 col-md-offset-2">
        <form class="form-vertical" method="POST" action="index.php?uc=suivreFrais&action=afficheFicheFrais">
            <fieldset>
                <legend>Suivit des fiches de frais</legend>
                <div class="form-group">
                    <label>Choisir un mois : </label>
                    <select name="mois" id="mois">
                        <option value="">-- Choisir une option</option>
                        <?php
                            foreach ($listeMois as $key => $value) {
                                foreach($value as $key2 => $value2){
                                    echo '<option value=' . "$key2" . '>' . $value2 . '</option>'; 
                                }              
                            }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
                <button type="reset" class="btn btn-primary">annuler</button>
            </fieldset>
        </form>

    </div>
</div>