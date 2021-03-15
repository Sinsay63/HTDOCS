<?php

class Quad{
    private $nbRouesMotrices;
    private $cylindrée;
    
    
    function __construct($nbroues,$cylindre) {
        $this->nbRouesMotrices=$nbroues;
        $this->cylindrée=$cylindre;
    }
    function getNbRouesMotrices(){
        return $this->nbRouesMotrices;
    }
    function getCylyndrée(){
        return $this->cylindrée;
    }
}

