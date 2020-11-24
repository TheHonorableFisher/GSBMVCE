<?php
include("vues/v_sommaire.php");

$action = $_REQUEST['action'];
switch($action){
    case 'changerLeMotDePasse':{
        include("vues/v_changerMdp.php");
        break;
    }
    case 'nouveauMotDePasse':{
        try{
            $id = $_SESSION['idVisiteur'];
            $oldMDP = $_REQUEST['oldMDP'];
            $newPwd = $_REQUEST['nMDP'];
            $newPwdBis = $_REQUEST['nMDPBis'];
            
            if($pdo->checkPassword($id,$oldMDP)){
                if($oldMDP != $newPwd && $oldMDP != $newPwdBis){
                    if($newPwd == $newPwdBis){
                        $motdepasse = $pdo->changePassword($id,$newPwd);
                        echo "Mot de passe mis à jour :)";
                    }else{
                        throw new Exception("Nouveau mot de passe non égal");
                    }
                }else{
                    throw new Exception("Ancien mot de passe égal au nouveau mot de passe");
                }
            }else{
                throw new Exception("Ancien mot de passe incorrecte");
            }        
        }catch(Exception $e){
            echo ajouterErreur($e->getMessage(),"mot de passe");
        }
    }
    default:{
        include("vues/v_changerMdp.php");
    }
}