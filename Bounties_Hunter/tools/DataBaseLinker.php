<?php

Class  DataBaseLinker{
    
    static function getConnexion(){
    
    $dsn = 'mysql:host=localhost;dbname=hunters';
    $user = 'root';
    $password = '';
    try {
        $bdd = new PDO($dsn,$user,$password);

    }
    catch(PDOException $e)
    {
        die('erreur : '.$e->getMessage());
    }
    
    return $bdd;
    }   
}