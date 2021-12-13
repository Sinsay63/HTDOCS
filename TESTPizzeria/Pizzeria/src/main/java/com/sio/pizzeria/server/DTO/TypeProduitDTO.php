<?php

class TypeProduitDTO {

    private $idTypeProduit;
    private $nomTypeProduit;

    public function __construct($idTypeProduit, $nomTypeProduit) {
        $this->idTypeProduit = $idTypeProduit;
        $this->nomTypeProduit = $nomTypeProduit;
    }

    public function getIdTypeProduit() {
        return $this->idTypeProduit;
    }

    public function getNomTypeProduit() {
        return $this->nomTypeProduit;
    }

    public function setIdTypeProduit($idTypeProduit): void {
        $this->idTypeProduit = $idTypeProduit;
    }

    public function setNomTypeProduit($nomTypeProduit): void {
        $this->nomTypeProduit = $nomTypeProduit;
    }

}
