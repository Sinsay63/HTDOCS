<?php

class ProduitDTO implements JsonSerializable {

    private $idProduit;
    private $nomProduit;
    private $prix;
    private $idTypeProduit;

    public function __construct($nomProduit, $prix, $idTypeProduit) {
        $this->nomProduit = $nomProduit;
        $this->prix = $prix;
        $this->idTypeProduit = $idTypeProduit;
    }

    public function getIdProduit() {
        return $this->idProduit;
    }

    public function getNomProduit() {
        return $this->nomProduit;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getIdTypeProduit() {
        return $this->idTypeProduit;
    }

    public function setIdProduit($idProduit): void {
        $this->idProduit = $idProduit;
    }

    public function setNomProduit($nomProduit): void {
        $this->nomProduit = $nomProduit;
    }

    public function setPrix($prix): void {
        $this->prix = $prix;
    }

    public function setIdTypeProduit($idTypeProduit): void {
        $this->idTypeProduit = $idTypeProduit;
    }

    public function jsonSerialize() {
        return array(
            'idProduit' => $this->idProduit,
            'nomProduit' => $this->nomProduit,
            'prix' => $this->prix,
            'idTypeProduit' => $this->idTypeProduit
        );
    }

}
