<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];

switch($action){
    case 'suivitFrais' : {
        // A finir
        include('vues/v_listeMois.php');
        break;
    }
}
