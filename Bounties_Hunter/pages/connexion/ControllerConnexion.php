<?php

Class ControllerConnexion{
    
    static function includeView(){
        require('Connexion.php');
    }
    
    static function authenticate($pseudo,$password){
        $hunter=ChasseursDAO::CheckChasseurs($pseudo, $password);
        if($hunter!=null){
            $_SESSION['ID']=$hunter->getId();
            
        }
    }
    
    static function redirectUser(){
        header('location: index.php?page=viewWanted');
        exit;
    }
    
    static function 
    
}