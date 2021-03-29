<?php

Class SuperController{
   public static function callPage($page){
        switch($page){
            case "connexion" : 
                require_once("pages/Connexion/ControllerConnexion.php");

                $connexion = new ControllerConnexion();
                $connexion->includeView();
                if(!empty($_POST['pseudo']) && !empty($_POST[('password')])){
                    $auth=$connexion->authenticate($_POST['pseudo'], $_POST['password']);
                    if($auth){
                        $connexion->redirectUser();
                    }
                }
            break;
                
            case "viewWanted" :
                require_once("pages/wanted/ControllerWanted.php");
                
                $wanted= new ControllerWanted();
                $wanted->displayWanted();
            break;
        
            case "profil":
                
        }
    }
}
