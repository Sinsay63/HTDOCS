<?php

Class WantedDTO{
    
    private $nom;
    private $prénom;
    private $prime;    
    private $description;
    
    
    function getNom() {
        return $this->nom;
    }

    function getPrénom() {
        return $this->prénom;
    }

    function getPrime() {
        return $this->prime;
    }

    function getDescription() {
        return $this->description;
    }

    function setNom($nom): void {
        $this->nom = $nom;
    }

    function setPrénom($prénom): void {
        $this->prénom = $prénom;
    }

    function setPrime($prime): void {
        $this->prime = $prime;
    }

    function setDescription($description): void {
        $this->description = $description;
    }


    
    
    
    
}
