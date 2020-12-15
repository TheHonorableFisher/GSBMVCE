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
        $mois = str_replace('-','',$mois);

        $listeFiche = $pdo->getFiche($_SESSION['statut'],'RB');
       
        $listeFiche = triMoisFiche($listeFiche,$mois);
       
        include('vues/v_afficheFicheFrais.php');
        break;
    }
}
