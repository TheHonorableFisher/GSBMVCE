    <!-- Division pour le sommaire -->
<div class="row">
      
    <nav class='col-md-2'>
        
        <h4>
            <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?>
        </h4>
        <h6>
            <?php 
            echo $_SESSION['statut'] 
            ?>
        </h6>
           
        <ul class="list-unstyled">
            <p>---------------------</p>
            <li>
              <a href="index.php?uc=gererFrais&action=saisirFrais" title="Saisie fiche de frais ">Saisie fiche de frais</a>
            </li>
            <li>
              <a href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais">Mes fiches de frais</a>
            </li>
            <?php
              if($_SESSION['statut'] === 'Responsable'){
                echo '<p>---------------------</p>';
                echo '<a href="index.php?uc=creerUtilisateur&action=CreerUtilisateur" title="Créer utilisateur">Créer utilisateur</a>';
                echo '</br><a href="index.php?uc=gererPersonnel&action=changerInfos" title="Changer infos personnel">Gérer personnel</a>';
              }
              if($_SESSION['statut'] === 'Responsable' || $_SESSION['statut'] === 'Délégué'){
                echo '</br><a href="index.php?uc=suivreFrais&action=afficheMois" title="Suivre fiche de frais">Suivre fiche de frais</a>';
                echo '</br><a href="index.php?uc=validerFrais&action=validerFrais" title="Valider fiche de frais">Valider fiche de frais</a>';
              }
            ?>
            <p>---------------------</p>
            <li>
              <a href="index.php?uc=monCompte&action=afficherInformation" title="Mon compte">Mon compte</a>
            </li>
            <li>
              <a href="index.php?uc=modifierUtilisateur&action=modifierUtilisateur" title="Modifier utilisateur">Modifier mes informations</a>
            </li>
            <li>
                <a href="index.php?uc=changerMDP&action=changerLeMotDePasse" title="Changer le mot de passe">Changer le mot de passe</a>
            </li>    
            <p>---------------------</p>
 	          <li>
              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
            </li>
         </ul>
        
    </nav>
    <div id="contenu" class="col-md-10">
   
        
    
    