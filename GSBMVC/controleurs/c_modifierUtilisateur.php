<?php
include("vues/v_sommaire.php");

$action = $_REQUEST['action'];
switch($action){
    case 'modifierUtilisateur':{
        include("vues/v_ModifierUtilisateur.php");
        break;
    }
    $id = $_SESSION['idVisiteur'];
    $newNum = $_REQUEST['tele'];
    $newAdr = $_REQUEST['adresse'];
    $newcP = $_REQUEST['cp'];
    $newVille = $_REQUEST['ville'];
    
   
    $pdo->ModifierVisiteur($newNum, $newAdr, $newCP,$newVille,$id);
    
    default:{
        include("vues/v_ModifierUtilisateur.php");
    }
}