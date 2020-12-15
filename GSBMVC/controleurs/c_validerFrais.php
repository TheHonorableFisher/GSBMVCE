<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];

switch($action){
    case 'validerFrais' : {
        include("vues/v_listeFicheCloture.php");
        break;
    }
}