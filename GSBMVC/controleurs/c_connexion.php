<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch($action){
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	case 'valideConnexion':{
		$login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
		$visiteur = $pdo->getInfosVisiteur($login,$mdp);
		if(!is_array( $visiteur)){
			ajouterErreur("Login ou mot de passe incorrect","connexion");
			include("vues/v_connexion.php");
		}
		else{
			$id = $visiteur['id'];
			$nom =  $visiteur['nom'];
			$prenom = $visiteur['prenom'];	
			$dateEmbauche = $visiteur['embauche'];
			$adresse = $visiteur['adresse'];
			$cp = $visiteur['cp'];
			$ville = $visiteur['ville'];
			$region = $visiteur['region'];
			$secteur = $visiteur['secteur'];
			$statut = $visiteur['statut'];
			connecter($id,$nom,$prenom,$adresse,$cp,$ville,$dateEmbauche,$region,$secteur,$statut);
			include("vues/v_sommaire.php");
		}
		break;
	}
	case 'deconnexion': {
		deconnecter();
	}
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>