<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];

switch($action){
    case 'afficherInformation' : {

        $statutUser = $_SESSION['statut'];
        $nomUser = $_SESSION['nom'];
        $prenomUser = $_SESSION['prenom'];
        $dateHired = $_SESSION['embauche'];

        $adresse = $_SESSION['adresse'];
        $cp = $_SESSION['cp'];
        $city = $_SESSION['ville'];

        $secteur = $_SESSION['secteur'];
        $region = $_SESSION['region'];

        include("vues/v_afficherInfoCompte.php");
        break;
    }
   
}