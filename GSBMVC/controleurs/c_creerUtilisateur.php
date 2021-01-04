<?php
include("vues/v_sommaire.php");

$action = $_REQUEST['action'];
switch($action){
    case 'creerUtilisateur':{
        include("vues/v_ajoutUtilisateur.php");
        break;
    }

    case 'ValiderUtilisateur':{
     
        $newId= $_REQUEST['id'];
        $newNom = $_REQUEST['nom'];
        $newPrenom = $_REQUEST['prenom'];
        $newNum = $_REQUEST['num'];
        $newAdresse = $_REQUEST['adresse'];
        $newCP = $_REQUEST['cp'];
        $newVille =$_REQUEST['ville'];
        $newDate = $_REQUEST['date_embauche'];
       

       $newMdp = $_REQUEST['mdp'] = $pdo->GenererMDP();


        $newLogin = $_REQUEST['login'] = $pdo->GenererLogin($newNom, $newPrenom);
       
       
        $pdo->CreationVisiteur($newId, $newNom,$newPrenom, $newLogin,$newMdp,$newNum, $newAdresse, $newCP,  $newVille,  $newDate);
        
    }
    default:{
        include("vues/v_ajoutUtilisateur.php");
    }
}