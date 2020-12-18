    <h2>Fiches de frais cloturés</h2> 
      <div class="corpsForm">
        <fieldset>
        <form action="index.php?uc=validerFrais&action=aplliquerValiderFrais" method="post">
        <table class="table table-bordered">
          <?php
          //var_dump($fiches);
            foreach ($fiches as $uneFiche) {
              $ficheNom = $uneFiche['nom'];
              $fichePrenom = $uneFiche['prenom'];
              $ficheMois = substr($uneFiche['mois'], -2);
              $ficheAnnee = substr($uneFiche['mois'], 0,4);
              echo ('<tr><th>' . $ficheNom . ' ' . $fichePrenom . ' ' . $ficheMois . '-' . $ficheAnnee);
              echo ('<input type="checkbox" id="' . $ficheNom . '-' . $uneFiche['mois'] . '" name="check_list[]" value="' . $ficheNom . '-' . $uneFiche['mois'] . '">');
              echo ('</th></tr>');
            }
            ?>
        </table>
        <button type="submit" class="btn btn-primary">Valider</button>
        </form>
        </fieldset>	 
      </div>       