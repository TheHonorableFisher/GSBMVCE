    <h2>Fiches de frais cloturés</h2> 
      <div class="corpsForm">
        <fieldset>
        <table class="table table-bordered">
          <?php
          //var_dump($fiches);
            foreach ($fiches as $uneFiche) {
              $ficheNom = $uneFiche['nom'];
              $fichePrenom = $uneFiche['prenom'];
              $ficheMois = substr($uneFiche['mois'], -2);
              $ficheAnnee = substr($uneFiche['mois'], 0,4);
              echo ('<tr><th>' . $ficheNom . ' ' . $fichePrenom . ' ' . $ficheMois . '-' . $ficheAnnee);
              echo ('<form action="index.php?uc=validerFrais&action=appliquerValiderFrais" method="POST"');
              echo ('<button type="submit" class="btn btn-primary">Valider</button>');
              echo ('</form>');
              echo ('</th></tr>');
            }
            ?>
        </table>
        </fieldset>	 
      </div>       