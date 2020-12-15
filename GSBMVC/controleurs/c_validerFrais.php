<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];

switch($action){
    case 'validerFrais' : {
        include("vues/v_listeFicheCloture.php");
        break;
    }
}