<?php

Class ChasseursDAO{
    
    
    
    static function CheckChasseurs($pseudo,$password){
        $bdd=DataBaseLinker::getConnexion();
        
        $reponse=$bdd->prepare("SELECT * from chasseurs where Pseudo = ? and Password = ?");
        $reponse->bindParam(1, $pseudo);
        $reponse->bindParam(2, sha1($password));
        $reponse->execute();
        $chasseur=$reponse->fetch();
        
        if($chasseur){
            
            $hunter = new ChasseursDTO();
            $hunter->setId($chasseur['ID']);
            $hunter->setPrénom($chasseur['Prénom']);
            $hunter->setNom($chasseur['Nom']);
            $hunter->setPseudo($pseudo);
            $hunter->setBirthday($chasseur['Date_Naissance']);
            $hunter->setPhoto($chasseur['Photo_Path']);
            $hunter->setAdmin($chasseur['IsAdmin']);
            
            return $hunter;
        }
        else{
            return null;
        }
    }
}
