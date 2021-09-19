<?php

class DataBaseLinker{
    private static  $urlBDD="mysql:host=localhost;dbname=fireblog;";
    private static  $username="root";
    private static  $password="root";
    private static  $connexion;
    
    static function getConnexion(){
            self::$connexion = new PDO (self::$urlBDD, self::$username, self::$password);
            return self::$connexion;
    }
}

