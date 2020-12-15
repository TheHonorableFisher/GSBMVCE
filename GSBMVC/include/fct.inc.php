﻿<?php
/** 
 * Fonctions pour l'application GSB
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 */
 /**
 * Teste si un quelconque visiteur est connecté
 * @return vrai ou faux 
 */
function estConnecte(){
  return isset($_SESSION['idVisiteur']);
}
/**
 * Enregistre dans une variable session les infos d'un visiteur
 
 * @param $id 
 * @param $nom
 * @param $prenom
 * @param $dateEmbauche
 * @param $adresse
 * @param $cp
 * @param $ville
 */
function connecter($id,$nom,$prenom,$adresse,$cp,$ville,$dateEmbauche,$statut,$region){
	$_SESSION['idVisiteur']= $id; 
	$_SESSION['nom']= $nom;
	$_SESSION['prenom']= $prenom;
	$_SESSION['adresse'] = $adresse;
	$_SESSION['cp'] = $cp;
	$_SESSION['ville'] = $ville;
	$_SESSION['embauche'] = $dateEmbauche;
	$_SESSION['statut'] = $statut;
	$_SESSION['region'] = $region;
}
/**
 * Détruit la session active
 */
function deconnecter(){
	session_destroy();
}
/**
 * Transforme une date au format français jj/mm/aaaa vers le format anglais aaaa-mm-jj
 
 * @param $madate au format  jj/mm/aaaa
 * @return la date au format anglais aaaa-mm-jj
*/
function dateFrancaisVersAnglais($maDate){
	@list($jour,$mois,$annee) = explode('/',$maDate);
	return date('Y-m-d',mktime(0,0,0,$mois,$jour,$annee));
}
/**
 * Transforme une date au format format anglais aaaa-mm-jj vers le format français jj/mm/aaaa 
 
 * @param $madate au format  aaaa-mm-jj
 * @return la date au format format français jj/mm/aaaa
*/
function dateAnglaisVersFrancais($maDate){
   @list($annee,$mois,$jour)=explode('-',$maDate);
   $date="$jour"."/".$mois."/".$annee;
   return $date;
}
/**
 * retourne le mois au format aaaamm selon le jour dans le mois
 
 * @param $date au format  jj/mm/aaaa
 * @return le mois au format aaaamm
*/
function getMois($date){
		@list($jour,$mois,$annee) = explode('/',$date);
		if(strlen($mois) == 1){
			$mois = "0".$mois;
		}
		return $annee.$mois;
}

/* gestion des erreurs*/
/**
 * Indique si une valeur est un entier positif ou nul
 
 * @param $valeur
 * @return vrai ou faux
*/
function estEntierPositif($valeur) {
	return preg_match("/[^0-9]/", $valeur) == 0; 
	// le / est le délimiteur de regex, 
	//^ signifie que l'on veut que la chaîne comporte au moins un caractère qui ne soit pas un chiffre (^= on ne veut pas)
	//expression regulière == 0 --> Faux (donc tous les caractères sont des chiffres), on retourne vrai
	
}

/**
 * Indique si un tableau de valeurs est constitué d'entiers positifs ou nuls
 
 * @param $tabEntiers : le tableau
 * @return vrai ou faux
*/
function estTableauEntiers($tabEntiers) {
	$ok = true;
	var_dump($tabEntiers);
	// $tabentiers est un tableau cle/valeur, dans le foreach, on ne prend que la valeur : si la valeur est nulle, ce n'est pas un entier et on n'exécute pas le foreach
	/*
	foreach($tabEntiers as $unEntier){
		if(!estEntierPositif($unEntier)){
		 	$ok=false; 
		}
	} */
	// correction plantage montant null
	$lesCles = array_keys($tabEntiers);
	foreach($lesCles as $unIdFrais){
		if(($tabEntiers[$unIdFrais]) == "" || !estEntierPositif($tabEntiers[$unIdFrais])){
			$ok=false; 
	   }
	}
	return $ok;
}
/**
 * Vérifie si une date est inférieure d'un an à la date actuelle
 
 * @param $dateTestee 
 * @return vrai ou faux
*/
function estDateDepassee($dateTestee){
	$dateActuelle=date("d/m/Y");
	@list($jour,$mois,$annee) = explode('/',$dateActuelle);
	$annee--;
	$AnPasse = $annee.$mois.$jour;
	@list($jourTeste,$moisTeste,$anneeTeste) = explode('/',$dateTestee);
	return ($anneeTeste.$moisTeste.$jourTeste < $AnPasse); 
}
/**
 * calcul la date actuelle sous aaaamm
 
 * 
 * @return vrai ou faux
*/
function moisActuel(){
	$dateActuelle=date("d/m/Y");
	@list($jour,$mois,$annee) = explode('/',$dateActuelle);
	//$annee--;
	$moisActuel = $mois;
	return $annee.$moisActuel; 
}
/**
 * calcul la date actuelle - 1 an sous aaaamm
 
 * 
 * @return vrai ou faux
*/
function moisAnPasse(){
	$dateActuelle=date("d/m/Y");
	@list($jour,$mois,$annee) = explode('/',$dateActuelle);
	$annee--;
	$moisActuel = $annee.$mois;
	return $moisActuel; 
}

/**
 * retourne les 12 mois de l'année
 * 
 * @return tableau contenant les 12 derniers mois dans l'ordre
 */
function get12DerniersMois(){
	$tabMois = array(
		0 => 'Janvier',
		1 => 'Février',
		2 => 'Mars',
		3 => 'Avril',
		4 => 'Mai',
		5 => 'Juin',
		6 => 'Juillet',
		7 => 'Août',
		8 => 'Septembre',
		9 => 'Octobre',
		10 => 'Novembre',
		11 => 'Décembre'
	);
	
	return $tabMois;
}

/**
 * Vérifie la validité du format d'une date française jj/mm/aaaa 
 
 * @param $date 
 * @return vrai ou faux
*/
function estDateValide($date){
	$tabDate = explode('/',$date);
	$dateOK = true;
	if (count($tabDate) != 3) {
	    $dateOK = false;
    }
    else {
		if (!estTableauEntiers($tabDate)) {
			$dateOK = false;
		}
		else {
			if (!checkdate($tabDate[1], $tabDate[0], $tabDate[2])) {
				$dateOK = false;
			}
		}
    }
	return $dateOK;
}

/**
 * Vérifie que le tableau de frais ne contient que des valeurs numériques 
 
 * @param $lesFrais 
 * @return vrai ou faux
*/
function lesQteFraisValides($lesFrais){
	return estTableauEntiers($lesFrais);
}
/**
 * Vérifie la validité des trois arguments : la date, le libellé du frais et le montant 
 
 * des message d'erreurs sont ajoutés au tableau des erreurs
 
 * @param $dateFrais 
 * @param $libelle 
 * @param $montant
 */
function valideInfosFrais($dateFrais,$libelle,$montant){
	if($dateFrais==""){
		ajouterErreur("Le champ date ne doit pas être vide","HorsForfait");
	}
	else{
		if(!estDatevalide($dateFrais)){
			ajouterErreur("Date invalide","HorsForfait");
		}	
		else{
			if(estDateDepassee($dateFrais)){
				ajouterErreur("date d'enregistrement du frais dépassé, plus de 1 an","HorsForfait");
			}			
		}
	}
	if($libelle == ""){
		ajouterErreur("Le champ description ne peut pas être vide","HorsForfait");
	}
	if($montant == ""){
		ajouterErreur("Le champ montant ne peut pas être vide","HorsForfait");
	}
	else
		if( !is_numeric($montant) ){
			ajouterErreur("Le champ montant doit être numérique","HorsForfait");
		}
}
/**
 * Ajoute le libellé d'une erreur au tableau des erreurs 
 
 * @param $msg : le libellé de l'erreur 
 */
function ajouterErreur($msg, $form){
   if (! isset($_REQUEST['erreurs'])){
      $_REQUEST['erreurs']=array();
      $_REQUEST['erreurForm']=$form;
	} 
   $_REQUEST['erreurs'][]=$msg;
}
/**
 * Retoune le nombre de lignes du tableau des erreurs 
 
 * @return le nombre d'erreurs
 */
function nbErreurs(){
   if (!isset($_REQUEST['erreurs'])){
	   return 0;
	}
	else{
	   return count($_REQUEST['erreurs']);
	}
}
?>