<?php
include_once('vues/v_sommaire.php');
$action = $_REQUEST['action'];
switch($action){
    case 'changerInfos' : {
        $personnels = $pdo->getPersonnel();
        include('vues/v_changerInfoPersonnel.php');
        break;
    }
    case 'changerInfosBis': {   
        $idVisiteur = $_REQUEST['personnels'];
        $_SESSION['idUpdatePers'] = $idVisiteur;
        include('vues/v_changerInfoPersonnelBis.php');
        break;
    }
    case 'validerChangementInfos' : {

        $idVisiteur = $_SESSION['idUpdatePers'];
        $newReg = $_REQUEST['newRegion'];
        $newRole = $_REQUEST['newRole'];

        try{
            $pdo->updateInformationPerso($idVisiteur,$newReg, $newRole);
            echo '<p>Opération réalisé avec succès !</p>';
        }catch(Exception $e){
            echo $e->getMessage();
        }

        break;
    }
}