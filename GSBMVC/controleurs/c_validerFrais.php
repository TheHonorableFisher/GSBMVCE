<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];

switch($action){
    case 'validerFrais' : {
        $fiches = $pdo->getFiche($_SESSION['statut'],'CL');
        include("vues/v_listeFicheCloture.php");
        break;
    }
    case 'aplliquerValiderFrais' : {
        //var_dump($_REQUEST['check_list']);
        $fiches = $_REQUEST['check_list'];
        foreach($fiches as $uneFiche){
            $separe = explode('-', $uneFiche );
            $nom = $separe[0];
            $date = $separe[1];
            $pdo->setValider($nom,$date);
        }
        break;
    }
}