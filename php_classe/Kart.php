<?php

class Kart{
    private $poids = 750;
    private $adhérence=100;
 
    
    public function getPoids(){
        return $this->poids;
    }
    public function getAdhérence(){
        return $this->adhérence;
    }
    public function setAdhérence($adhérence){
        $this->adhérence = $adhérence;
    }
    public function setPoids($poids){
        $this->poids = $poids;
    }
}
