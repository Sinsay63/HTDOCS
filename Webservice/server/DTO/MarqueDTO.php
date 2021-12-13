<?php

class MarqueDTO implements JsonSerializable {

    private $idMarque;
    private $nomMarque;

    public function __construct($nomMarque) {
        $this->nomMarque = $nomMarque;
    }

    public function getIdMarque() {
        return $this->idMarque;
    }

    public function setIdMarque($idMarque) {
        $this->idMarque = $idMarque;
    }

    public function getNomMarque() {
        return $this->nomMarque;
    }

    public function setNomMarque($nomMarque) {
        $this->nomMarque = $nomMarque;
    }

    // cette fonction définit la manière dont les attributs privés (donc normalement inaccessibles) de l'objet vont être encodés en JSON
    public function jsonSerialize() {
        return array(
            'idMarque' => $this->idMarque,
            'nomMarque' => $this->nomMarque
        );
    }

}
