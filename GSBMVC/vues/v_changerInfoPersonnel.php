<div class="row">

    <div class="col-md-12 col-md-offset-2">
        <form class="form-vertical" method="POST" action="index.php?uc=gererPersonnel&action=changerInfosBis">
            <fieldset>
                <legend>Changer Information d'un personnel</legend>
                <div class="form-group">
                    <label>Choisir un employé :</label>
                    <select name="personnels" id="personnels" required>
                        <?php       
                            foreach ($personnels as $key => $value) {
                                echo "<option value=" . $value[0] . ">" . $value[1] . " " . $value[2] . " - " . $value[3] . " - " . $value[4] . '</option>';
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