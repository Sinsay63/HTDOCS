<?php

Class ControllerConnexion{
    
    static function includeView(){
        require('Connexion.php');
    }
    
    static function authenticate($pseudo,$password){
        require('DAO/ChasseursDAO.php');
        $hunter=ChasseursDAO::CheckChasseurs($pseudo, $password);
        if($hunter!=null){
            $_SESSION['ID']=$hunter->getId();
            self::redirectUser();
        }
        else{
            header('location : index.php?page=connexion');
            exit;
        }
    }
    
    static function redirectUser(){
        header('location: index.php?page=viewWanted');
        exit;
    }
    
    static function GetUserInfo($id){
        require('DAO/ChasseursDAO.php');
        $hunter=ChasseursDAO::GetHunterInfo($id);
        return $hunter;
    }
}