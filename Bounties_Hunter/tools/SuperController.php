<?php


Class SuperController{
   public static function callPage($page){
        switch($page){
            case "connexion" : 
                require_once("pages/Connexion/ControllerConnexion.php");

                $connexion = new ControllerConnexion();
                $connexion->includeView();
                if(!empty($_POST['pseudo']) && !empty($_POST[('password')])){
            
                    ControllerConnexion::authenticate($_POST['pseudo'], $_POST['password']);
                }
            break;
        }
    }
}
