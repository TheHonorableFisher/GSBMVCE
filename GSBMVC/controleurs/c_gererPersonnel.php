<?php
include_once('vues/v_sommaire.php');
$action = $_REQUEST['action'];
switch($action){
    case 'changerInfos' : {

        include('vues/v_changerInfoPersonnel.php');
        break;
    }
    case 'changerInfosBis': {

        $idVisiteur = $_REQUEST['personnels'];
        include('vues/v_changerInfoPersonnelBis.php');
        break;
    }
    case 'validerChangementInfos' : {

        $newReg = $_REQUEST['newRegion'];
        $newRole = $_REQUEST['newRole'];

        break;
    }
}