<?php

require_once('tools/DataBaseLinker.php');
require_once('DTO/WantedDTO.php');
Class WantedDAO{
    
    static function searchAllWanted(){
        $bdd= DataBaseLinker::getConnexion();
        
        $reponse=$bdd->prepare('Select * from wanted');
        $reponse->execute();
        $rep=$reponse->fetchAll();
        
        if(!empty($rep)){
            $tab=[];
            foreach($rep as $value){

                $wanted= new WantedDTO();

                $wanted->setPrénom($value['Prénom']);
                $wanted->setNom($value['Nom']);
                $wanted->setPrime($value['Prime']);
                $wanted->setDescription($value['Description']);

                $tab[]=$wanted;
            }
            return $tab;
        }
        else{
            return null;
        }
    }
    
    
    
    
    
    
    
}

