<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];

switch($action){
    case 'suivitFrais' : {
        // A finir

        var_dump(get12DerniersMois()) ;

        
        break;
    }
}
