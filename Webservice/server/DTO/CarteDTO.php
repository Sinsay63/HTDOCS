<?php

class CarteDTO implements JsonSerializable {

    private $idCarte;
    private $nomCarte;
    private $prix;
    private $idMarque;

    public function __construct($nomCarte,$prix,$idMarque) {
        $this->nomCarte = $nomCarte;
        $this->prix = $prix;
        $this->idMarque = $idMarque;
    }

    public function getIdCarte() {
        return $this->idCarte;
    }

    public function getNomCarte() {
        return $this->nomCarte;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getIdMarque() {
        return $this->idMarque;
    }

    public function setIdCarte($idCarte): void {
        $this->idCarte = $idCarte;
    }

    public function setNomCarte($nomCarte): void {
        $this->nomCarte = $nomCarte;
    }

    public function setPrix($prix): void {
        $this->prix = $prix;
    }

    public function setIdMarque($idMarque): void {
        $this->idMarque = $idMarque;
    }

    // cette fonction définit la manière dont les attributs privés (donc normalement inaccessibles) de l'objet vont être encodés en JSON
    public function jsonSerialize() {
        return array(
            'idCarte' => $this->idCarte,
            'nomCarte' => $this->nomCarte,
            'prix' => $this->prix,
            'idMarque' => $this->idMarque
        );
    }

}
