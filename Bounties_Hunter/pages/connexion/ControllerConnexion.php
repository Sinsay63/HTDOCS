<?php
require_once('DAO/ChasseursDAO.php');
Class ControllerConnexion{
    
    function includeView(){
        require('Connexion.php');
    }
    
    function  authenticate($pseudo,$password){
        $hunter=ChasseursDAO::CheckChasseurs($pseudo, $password);
        if($hunter!=null){
            $_SESSION['ID']=$hunter->getId();
            return true;
        }
        else{
            return false;
        }
    }
    
    function redirectUser(){
        header('location: index.php?page=viewWanted');
        exit;
    }
    
    static function GetUserInfo($id){
        $hunter=ChasseursDAO::GetHunterInfo($id);
        return $hunter;
    }
}