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
        echo('Validation');
        break;
    }
}