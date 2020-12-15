<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];

switch($action){
    case 'afficheMois' : {

        $listeMois = get12DerniersMois();

        include('vues/v_moisFicheFrais.php');
        break;
    }
    case 'afficheFicheFrais' : {

        $mois = $_REQUEST['mois'];
        break;
    }
}
