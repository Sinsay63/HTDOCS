<?php

class DataBaseLinker{
    private static  $urlBDD="mysql:host=localhost;dbname=fireblog;charset=utf8;";
    private static  $username="root";
    private static  $password="";
    private static  $connexion;
    
    static function getConnexion(){
            self::$connexion = new PDO (self::$urlBDD, self::$username, self::$password);
            return self::$connexion;
    }
}

