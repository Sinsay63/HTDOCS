<?php

class CommandeDTO {

    private $idCommande;
    private $dateCommande;
    private $idfacture;
    private $idTableSalle;

    public function __construct($dateCommande, $idfacture, $idTableSalle) {
        $this->dateCommande = $dateCommande;
        $this->idfacture = $idfacture;
        $this->idTableSalle = $idTableSalle;
    }

    public function getIdCommande() {
        return $this->idCommande;
    }

    public function getDateCommande() {
        return $this->dateCommande;
    }

    public function getIdfacture() {
        return $this->idfacture;
    }

    public function getIdTableSalle() {
        return $this->idTableSalle;
    }

    public function setIdCommande($idCommande): void {
        $this->idCommande = $idCommande;
    }

    public function setDateCommande($dateCommande): void {
        $this->dateCommande = $dateCommande;
    }

    public function setIdfacture($idfacture): void {
        $this->idfacture = $idfacture;
    }

    public function setIdTableSalle($idTableSalle): void {
        $this->idTableSalle = $idTableSalle;
    }

}
