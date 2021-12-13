<?php

class AventurierDTO implements JsonSerializable {

    private $idAventurier;
    private $nomAventurier;
    private $prenomAventurier;
    private $dateNaissance;

    public function getIdAventurier() {
        return $this->idAventurier;
    }

    public function setIdAventurier($idAventurier) {
        $this->idAventurier = $idAventurier;
    }

    public function getNomAventurier() {
        return $this->nomAventurier;
    }

    public function setNomAventurier($nomAventurier) {
        $this->nomAventurier = $nomAventurier;
    }

    public function getPrenomAventurier() {
        return $this->prenomAventurier;
    }

    public function setPrenomAventurier($prenomAventurier) {
        $this->prenomAventurier = $prenomAventurier;
    }

    public function getDateNaissance() {
        return $this->dateNaissance;
    }

    public function setDateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;
    }

    public function jsonSerialize() {
        return array(
            'idAventurier' => $this->idAventurier,
            'nomAventurier' => $this->nomAventurier,
            'prenomAventurier' => $this->prenomAventurier,
            'dateNaissance' => $this->dateNaissance
        );
    }

}
