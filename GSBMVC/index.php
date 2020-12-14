<?php
require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");
include("vues/v_entete.php") ;
session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
if(!isset($_REQUEST['uc']) || !$estConnecte){
     $_REQUEST['uc'] = 'connexion';
}	 
$uc = $_REQUEST['uc'];
switch($uc){
	case 'connexion':{
		include("controleurs/c_connexion.php");break;
	}
	case 'gererFrais' :{
		include("controleurs/c_gererFrais.php");break;
	}
	case 'etatFrais' :{
		include("controleurs/c_etatFrais.php");break; 
	}
	case 'suivreFrais' : {
		include("controleurs/c_suivreFrais.php");break;
	}
	case 'changerMDP' :{
		include("controleurs/c_changerMdp.php");break;
	}
	case 'monCompte':{
		include("controleurs/c_monCompte.php");break;
	}
	case 'gererPersonnel':{
		include("controleurs/c_gererPersonnel.php");break;
	}
}
include("vues/v_pied.php") ;
?>

