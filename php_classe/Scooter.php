<?php

class Scooter{
    private $couleur = "bleu";
    private $vitesse = 150;
    
    public function démarrer() {
        echo 'Vroum vroum!';
        
    }
    public function accelerer(){
        $this->vitesse++;
    }
    public function displayCouleur(){
        echo $this->couleur;
    }
    public function changeCouleur(){
        $this->couleur="rouge";
    }
}
