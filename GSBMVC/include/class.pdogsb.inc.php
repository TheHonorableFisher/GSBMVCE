﻿<?php

/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb
{
	private $serveur = 'mysql:host=pa667379-002.dbaas.ovh.net:35252';
	private $bdd = 'dbname=gsbmvc';
	private $user = 'gsbmvc';
	private $mdp = 'g8OBy0IjL2y2';
	private $monPdo; //objet de connection à la bdd
	private static $monPdoGsb = null; //instance unique de la classe
	/**
	 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
	 * pour toutes les méthodes de la classe
	 */
	private function __construct()
	{
		$this->monPdo = new PDO($this->serveur . ';' . $this->bdd, $this->user, $this->mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		$this->monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct()
	{
		$this->monPdo = null;
	}
	/**
	 * Fonction statique qui crée l'unique instance de la classe
 
	 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
	 * @return l'unique objet de la classe PdoGsb
	 */
	public  static function getPdoGsb()
	{
		if (self::$monPdoGsb == null) {
			self::$monPdoGsb = new PdoGsb();
		}
		return self::$monPdoGsb;
	}

	/**
	 * Générer mot de passe
	 * @param $nom
	 * @param $prenom
	 */
	public function GenererLogin($newNom, $newPrenom)
	{
		$longeur = strlen($newPrenom);
		$newPrenom = substr($newPrenom, 0, $longeur - ($longeur - 1));
		$login = $newPrenom . $newNom;
		$strReq =	"INSERT INTO visiteur (login) values :login";
		var_dump($login);
		return $login;
		$req = $this->monPdo->prepare($strReq);
		$req->bindParam(':login', $login);
		$req->execute();
	}

	/**
	 * Générer mot de passe
	 * @param $mdp 
	 */
	public function GenererMDP()
	{
		// Liste des caractères possibles
		$cars = "azertyiopqsdfghjklmwxcvbn0123456789";
		$mdp = '';
		$long = strlen($cars);
		srand((float)microtime() * 1000000);
		//Initialise le générateur de nombres aléatoires
		for ($i = 0; $i < 8; $i++) {
			$mdp = $mdp . substr($cars, rand(0, $long - 1), 1);
		}
		//var_dump($mdp);
		return $mdp;
		$strReq =	"INSERT INTO visiteur (mdp) values $mdp ";
		$req = $this->monPdo->prepare($strReq);
		$req->bindParam(':mdp', $mdp);
		$req->execute();
	}

	/**
	 * Change le mot de passe pour un utilisateur donné
	 * 
	 * @param $id
	 * @param $newPwd
	 */
	public function changePassword($id, $newPwd)
	{
		try {
			$newPwd = hash('sha256', $newPwd);
			$strReq = "UPDATE visiteur SET visiteur.mdp=:mdp WHERE visiteur.id=:id";
			$req = $this->monPdo->prepare($strReq);
			$req->bindParam(':id', $id);
			$req->bindParam(':mdp', $newPwd);
			$req->execute();
		} catch (PDOException $e) {
			echo 'Echec lors du changement de mot de passe : ' . $e->getMessage();
		}
	}

	/**
	 * Retourne vrai ou faux en fonction du mot de passe donné
	 * 
	 * @param $id
	 * @param $mdp
	 * @return True ou False 
	 */
	public function checkPassword($id, $Pwd)
	{
		try {
			$Pwd = substr(hash('sha256', $Pwd), 0, -44);
			$strReq = "SELECT visiteur.mdp FROM visiteur WHERE visiteur.id = :id AND visiteur.mdp = :pwd";
			$req = $this->monPdo->prepare($strReq);
			$req->bindParam(':id', $id);
			$req->bindParam(':pwd', $Pwd);
			$req->execute();
			$reponse = $req->fetch();
			if (empty($reponse)) {
				return false;
			} else {
				return true;
			}
		} catch (PDOException $e) {
			echo "Echec lors de la vérification du mot de passe : " . $e->getMessage();
		}
	}

	/**
	 * Modifier un utilisateur
	 * nouvelle valeur
	 */


	public function ModifierVisiteur($newNum, $newAdr, $newcP, $newVille)
	{
		$strReq = "UPADTE visiteur SET tele = $newNum , adresse = $newAdr,cp = $newcP , ville = $newVille";
		$req = $this->monPdo->prepare($strReq);
		$req->bindParam(':tele', $newNum);
		$req->bindParam(':adresse', $newAdr);
		$req->bindParam(':cp', $newCP);
		$req->bindParam(':ville', $newVille);
		$req->execute();
	}

	/**
	 * Retour l'id, le nom, le prénom, le rôle et la région de tout le personnel
	 * 
	 * @return tableau de valeur associatif
	 */
	public function getPersonnel()
	{
		try {
			$strReq = 'SELECT DISTINCT vaffectation.idVisiteur, visiteur.nom, visiteur.prenom, vaffectation.aff_role, vaffectation.aff_reg
			FROM vaffectation INNER JOIN visiteur on vaffectation.idVisiteur = visiteur.id WHERE vaffectation.aff_role = "Visiteur" OR vaffectation.aff_role = "Délégué"   
			ORDER BY visiteur.nom ASC ,vaffectation.aff_role ASC';
			$req = $this->monPdo->prepare($strReq);
			$req->execute();
			$reponse = $req->fetchAll();
			return $reponse;
		} catch (PDOException $e) {
			echo "Echec récupération personnel : " . $e->getMessage();
		}
	}

	/**
	 * Retourne les informations d'un visiteur
 
	 * @param $login 
	 * @param $mdp
	 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif 
	 */
	public function getInfosVisiteur($login, $mdp)
	{
		try {
			$mdp = substr(hash('sha256', $mdp), 0, -44);
			$strReq = "select visiteur.id as id, visiteur.nom as nom, visiteur.prenom as prenom, visiteur.adresse as adresse, visiteur.cp as cp, visiteur.ville as ville, visiteur.dateEmbauche as embauche, vaffectation.aff_reg as region, vaffectation.aff_sec as secteur, vaffectation.aff_role as statut
			from visiteur INNER JOIN vaffectation on visiteur.id = vaffectation.idVisiteur
			where visiteur.login=:login and visiteur.mdp=:mdp";
			$req = $this->monPdo->prepare($strReq);
			$req->bindParam(':login', $login);
			$req->bindParam(':mdp', $mdp);
			$req->execute();
			$ligne = $req->fetch();
			return $ligne;
		} catch (PDOException $e) {
			echo "Erreur requête : " . $e->getMessage();
		}
	}

	/**
	 * Retourne les regions possible pour un visiteur
	 * 
	 * @param $id
	 * @return Tableau de région 
	 */
	public function getRegionVisiteur($id)
	{
		try {
			$strReq = "SELECT region.id 
			FROM vaffectation INNER JOIN region ON vaffectation.aff_sec = region.sec_code 
			WHERE vaffectation.idVisiteur = :id";
			$req = $this->monPdo->prepare($strReq);
			$req->bindParam(':id', $id);
			$req->execute();
			$regions = $req->fetchAll();
			return $regions;
		} catch (PDOException $e) {
			echo "Erreur requête : " . $e->getMessage();
		}
	}

	/**
	 * Réafecte un employe sur sa nouvelle région avec son nouveau role
	 * 
	 * @param $id
	 * @param $region
	 * @param $role
	 */
	public function updateInformationPerso($id, $region, $role)
	{
		try {
			if ($region != "" && $role != "") {
				$strReq = "INSERT INTO travailler VALUES (:id,CURDATE(),:region, :role)";
				$req = $this->monPdo->prepare($strReq);
				$req->bindParam(':id', $id);
				$req->bindParam(':region', $region);
				$req->bindParam(':role', $role);
				$req->execute();
			} else {
				throw new ErrorException("Erreur Region ou Role null, impossible de mettre à jour les informations du personnel, Veuillez remplir tout les champs");
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
	 * concernées par les deux arguments
 
	 * La boucle foreach ne peut être utilisée ici car on procède
	 * à une modification de la structure itérée - transformation du champ date-
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif 
	 */
	public function getLesFraisHorsForfait($idVisiteur, $mois)
	{
		$req = "select * from lignefraishorsforfait where lignefraishorsforfait.idvisiteur ='$idVisiteur' 
		and lignefraishorsforfait.mois = '$mois' ";
		$res = $this->monPdo->query($req);
		$lesLignes = $res->fetchAll();
		$nbLignes = count($lesLignes);
		for ($i = 0; $i < $nbLignes; $i++) {
			$date = $lesLignes[$i]['date'];
			$lesLignes[$i]['date'] =  dateAnglaisVersFrancais($date);
		}
		return $lesLignes;
	}
	/**
	 * Retourne le nombre de justificatif d'un visiteur pour un mois donné
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @return le nombre entier de justificatifs 
	 */
	public function getNbjustificatifs($idVisiteur, $mois)
	{
		$req = "select fichefrais.nbjustificatifs as nb from  fichefrais where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		$res = $this->monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne['nb'];
	}
	/**
	 * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
	 * concernées par les deux arguments
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif 
	 */
	public function getLesFraisForfait($idVisiteur, $mois)
	{
		$req = "select fraisforfait.id as idfrais, fraisforfait.libelle as libelle, 
		lignefraisforfait.quantite as quantite from lignefraisforfait inner join fraisforfait 
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idvisiteur ='$idVisiteur' and lignefraisforfait.mois='$mois' 
		order by lignefraisforfait.idfraisforfait";
		$res = $this->monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	/**
	 * Retourne tous les id de la table FraisForfait
 
	 * @return un tableau associatif 
	 */
	public function getLesIdFrais()
	{
		$req = "select fraisforfait.id as idfrais from fraisforfait order by fraisforfait.id";
		$res = $this->monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	/**
	 * Met à jour la table ligneFraisForfait
 
	 * Met à jour la table ligneFraisForfait pour un visiteur et
	 * un mois donné en enregistrant les nouveaux montants
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
	 * @return un tableau associatif 
	 */
	public function majFraisForfait($idVisiteur, $mois, $lesFrais)
	{
		$lesCles = array_keys($lesFrais);
		foreach ($lesCles as $unIdFrais) {
			$qte = $lesFrais[$unIdFrais];
			$req = "update lignefraisforfait set lignefraisforfait.quantite = $qte
			where lignefraisforfait.idvisiteur = '$idVisiteur' and lignefraisforfait.mois = '$mois'
			and lignefraisforfait.idfraisforfait = '$unIdFrais'";
			$this->monPdo->exec($req);
		}
	}
	/**
	 * met à jour le nombre de justificatifs de la table ficheFrais
	 * pour le mois et le visiteur concerné
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 */
	public function majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs)
	{
		$req = "update fichefrais set nbjustificatifs = $nbJustificatifs 
		where fichefrais.idvisiteur = '$idVisiteur' and fichefrais.mois = '$mois'";
		$this->monPdo->exec($req);
	}
	/**
	 * Teste si un visiteur possède une fiche de frais pour le mois passé en argument
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @return vrai ou faux 
	 */
	public function estPremierFraisMois($idVisiteur, $mois)
	{
		$ok = false;
		$req = "select count(*) as nblignesfrais from fichefrais 
		where fichefrais.mois = '$mois' and fichefrais.idvisiteur = '$idVisiteur'";
		$res = $this->monPdo->query($req);
		$laLigne = $res->fetch();
		if ($laLigne['nblignesfrais'] == 0) {
			$ok = true;
		}
		return $ok;
	}
	/**
	 * Retourne le dernier mois en cours d'un visiteur
 
	 * @param $idVisiteur 
	 * @return le mois sous la forme aaaamm
	 */
	public function dernierMoisSaisi($idVisiteur)
	{
		$req = "select max(mois) as dernierMois from fichefrais where fichefrais.idvisiteur = '$idVisiteur'";
		$res = $this->monPdo->query($req);
		$laLigne = $res->fetch();
		$dernierMois = $laLigne['dernierMois'];
		return $dernierMois;
	}

	/**
	 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés
 
	 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
	 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 */
	public function creeNouvellesLignesFrais($idVisiteur, $mois)
	{
		$dernierMois = $this->dernierMoisSaisi($idVisiteur);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur, $dernierMois);
		if ($laDerniereFiche['idEtat'] == 'CR') {
			$mt = $this->calculMontantFrais($idVisiteur, $dernierMois);
			$this->majEtatFicheFrais($idVisiteur, $dernierMois, 'CL', $mt);
		}
		$strReq = "insert into fichefrais(idvisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) 
		values(:idVisiteur,:mois,0,0,now(),'CR')";
		$req = $this->monPdo->prepare($strReq);
		$req->bindParam(':idVisiteur', $idVisiteur);
		$req->bindParam(':mois', $mois);
		$req->execute();
		$lesIdFrais = $this->getLesIdFrais();
		$strReq = "insert into lignefraisforfait(idvisiteur,mois,idFraisForfait,quantite) 
	 		values(:idVisiteur,:mois,:unIdFrais,0)";
		$req = $this->monPdo->prepare($strReq);
		$req->bindParam(':idVisiteur', $idVisiteur);
		$req->bindParam(':mois', $mois);
		foreach ($lesIdFrais as $uneLigneIdFrais) {
			$unIdFrais = $uneLigneIdFrais['idfrais'];
			$req->bindParam(':unIdFrais', $unIdFrais);
			$req->execute();
		}
	}
	/**
	 * Crée un nouveau frais hors forfait pour un visiteur un mois donné
	 * à partir des informations fournies en paramètre
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @param $libelle : le libelle du frais
	 * @param $date : la date du frais au format français jj//mm/aaaa
	 * @param $montant : le montant
	 */
	public function creeNouveauFraisHorsForfait($idVisiteur, $mois, $libelle, $date, $montant)
	{
		$dateFr = dateFrancaisVersAnglais($date);
		$libEchap = $this->monPdo->quote($libelle);
		$req = "insert into lignefraishorsforfait 
		values('','$idVisiteur','$mois',$libEchap,'$dateFr','$montant')";
		$this->monPdo->exec($req);
	}
	/**
	 * Supprime le frais hors forfait dont l'id est passé en argument
 
	 * @param $idFrais 
	 */
	public function supprimerFraisHorsForfait($idFrais)
	{
		$req = "delete from lignefraishorsforfait where lignefraishorsforfait.id =$idFrais ";
		$this->monPdo->exec($req);
	}
	/**
	 * Retourne les mois pour lesquel un visiteur a une fiche de frais
 
	 * @param $idVisiteur 
	 * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant 
	 */
	public function getLesMoisDisponibles($idVisiteur)
	{
		//avoir seulement les fiches frais de la dernière année
		$mois1 = moisActuel();
		$mois2 = moisAnPasse();
		//modifier la requete sql pour avoir les douze derniers mois
		$req = "select fichefrais.mois as mois from  fichefrais where fichefrais.idvisiteur ='$idVisiteur' 
		and mois between '" . $mois2 . "' and '" . $mois1 . "' order by fichefrais.mois desc ";
		$res = $this->monPdo->query($req);
		$lesMois = array();
		$laLigne = $res->fetch();
		while ($laLigne != null) {
			$mois = $laLigne['mois'];
			$numAnnee = substr($mois, 0, 4);
			$numMois = substr($mois, 4, 2);
			$lesMois["$mois"] = array(
				"mois" => "$mois",
				"numAnnee"  => "$numAnnee",
				"numMois"  => "$numMois"
			);
			$laLigne = $res->fetch();
		}
		return $lesMois;
	}
	/**
	 * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état 
	 */
	public function getLesInfosFicheFrais($idVisiteur, $mois)
	{
		$strReq = "select fichefrais.idEtat as idEtat, fichefrais.dateModif as dateModif, fichefrais.nbJustificatifs as nbJustificatifs, 
			fichefrais.montantValide as montantValide, etat.libelle as libEtat from fichefrais inner join etat on fichefrais.idEtat = etat.id 
			where fichefrais.idvisiteur = :idVisiteur and fichefrais.mois = :mois";
		$req = $this->monPdo->prepare($strReq);
		$req->bindParam(':idVisiteur', $idVisiteur);
		$req->bindParam(':mois', $mois);
		$req->execute();
		$laLigne  = $req->fetch();
		return $laLigne;
	}
	/**
	 * Modifie l'état et la date de modification d'une fiche de frais
 
	 * Modifie le champ idEtat et met la date de modif à aujourd'hui
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 */

	public function majEtatFicheFrais($idVisiteur, $mois, $etat, $mtValide)
	{
		$strReq = "update fichefrais set idEtat = :etat, dateModif = now() , montantValide = :mt
		where fichefrais.idvisiteur =:idVisiteur and fichefrais.mois = :mois";
		$req = $this->monPdo->prepare($strReq);
		$req->bindParam(':etat', $etat);
		$req->bindParam(':mt', $mtValide);
		$req->bindParam(':idVisiteur', $idVisiteur);
		$req->bindParam(':mois', $mois);
		$req->execute();
		//$this->monPdo->exec($req);
	}

	/** 
	 * Calcul le montant des frais pour un mois et un visiteur
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 */
	public function calculMontantFrais($idVisiteur, $mois)
	{
		$montant = 0;
		$LesFraisHorsForfait = $this->getLesFraisHorsForfait($idVisiteur, $mois);
		$strReq = "select fraisforfait.id as idfrais,lignefraisforfait.quantite*montant as montant 
			from lignefraisforfait inner join fraisforfait 
			on fraisforfait.id = lignefraisforfait.idfraisforfait
			where lignefraisforfait.idvisiteur = :idVisiteur and lignefraisforfait.mois=:mois";
		$req = $this->monPdo->prepare($strReq);
		$req->bindParam(':idVisiteur', $idVisiteur);
		$req->bindParam(':mois', $mois);
		$req->execute();
		$lesMontants = $req->fetchAll();
		//var_dump($lesMontants);
		foreach ($lesMontants as $unMontant) {
			$montant += $unMontant['montant'];
		}
		foreach ($LesFraisHorsForfait as $unFraisHorsForfait) {
			$montant += $unFraisHorsForfait['montant'];
		}
		return $montant;
	}

	public function getFiche($role, $type)
	{
		if ($role == 'Délégué') {
			$region = $_SESSION['region'];

			$strReq = "SELECT DISTINCT visiteur.nom, visiteur.prenom,mois,nbJustificatifs,montantValide,dateModif
			FROM fichefrais 
			INNER JOIN vaffectation ON fichefrais.idVisiteur = vaffectation.idVisiteur 
			INNER JOIN visiteur ON visiteur.id = fichefrais.idVisiteur 
			WHERE idEtat = :type AND vaffectation.aff_role = 'Visiteur' AND vaffectation.aff_reg = :region";
			$req = $this->monPdo->prepare($strReq);
			$req->bindParam(':type', $type);
			$req->bindParam(':region', $region);
			$req->execute();
			return $req->fetchAll();
		} else {
			$secteur = $_SESSION['secteur'];

			$strReq = "SELECT DISTINCT visiteur.nom, visiteur.prenom,mois,nbJustificatifs,montantValide,dateModif 
			FROM fichefrais 
			INNER JOIN vaffectation ON fichefrais.idVisiteur = vaffectation.idVisiteur 
			INNER JOIN visiteur ON visiteur.id = fichefrais.idVisiteur 
			WHERE idEtat = :type AND vaffectation.aff_sec = :secteur";
			$req = $this->monPdo->prepare($strReq);
			$req->bindParam(':type', $type);
			$req->bindParam(':secteur', $secteur);
			$req->execute();
			return $req->fetchAll();
		}
	}

	public function setValider($nom, $date)
	{
		$strReq = "SELECT id FROM visiteur WHERE nom = :nom";
		$req = $this->monPdo->prepare($strReq);
		$req->bindParam(':nom', $nom);
		$req->execute();
		$id = $req->fetchAll();

		$strReq2 = "UPDATE fichefrais SET idEtat = 'VA' WHERE idVisiteur = :id AND mois = :date";
		$req2 = $this->monPdo->prepare($strReq2);
		$req2->bindParam(':id', $id[0]['id']);
		$req2->bindParam(':date', $date);
		$req2->execute();
	}
}
