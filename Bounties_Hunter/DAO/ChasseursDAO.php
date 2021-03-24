<?php

Class ChasseursDAO{
    
    static function CheckChasseurs($pseudo,$password){
        require('tools/DataBaseLinker.php');
        require('DTO/ChasseursDTO.php');
        
        $bdd=DataBaseLinker::getConnexion();
        
        $reponse=$bdd->prepare("SELECT * from chasseurs where Pseudo = ? and Password = ? ");
        $reponse->execute(array($pseudo,$password));
        $chasseur=$reponse->fetch();
        
        if($chasseur){
            
            $hunter = new ChasseursDTO();
            $hunter->setId($chasseur['ID']);
            
            
            return $hunter;
        }
        else{
            return null;
        }
    }
    static function GetHunterInfo($id){
        require('tools/DataBaseLinker.php');
        require('DTO/ChasseursDTO.php');
        
        $bdd=DataBaseLinker::getConnexion();
         
        $reponse=$bdd->prepare("SELECT * from chasseurs where ID = ? ");
        $reponse->execute(array($id));
        $chasseur=$reponse->fetch();
        
        
        $hunter= new ChasseursDTO();
        
        $hunter->setId($chasseur['ID']);
        $hunter->setPrénom($chasseur['Prénom']);
        $hunter->setNom($chasseur['Nom']);
        $hunter->setPseudo($chasseur['Pseudo']);
        $hunter->setBirthday($chasseur['Date_Naissance']);
        $hunter->setPhoto($chasseur['Photo_Path']);
        $hunter->setAdmin($chasseur['IsAdmin']);
        
        return $hunter;
    }
}
