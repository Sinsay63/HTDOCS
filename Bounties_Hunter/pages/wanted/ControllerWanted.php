<?php
require_once ('DAO/WantedDAO.php');
Class ControllerWanted{
    
    static function SearchAllWanted(){
        $wanted= WantedDAO::searchAllWanted();
        return $wanted;
    }
    
    function displayWanted(){
        require_once("Wanted.php");
    }
}
