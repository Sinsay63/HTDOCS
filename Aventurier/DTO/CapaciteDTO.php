<?php

class CapaciteDTO implements JsonSerializable {

    private $idAventurier;
    private $idCompetence;
    private $libelleCompetence;
    private $niveau;

    public function getIdAventurier() {
        return $this->idAventurier;
    }

    public function setIdAventurier($idAventurier) {
        $this->idAventurier = $idAventurier;
    }

    public function getIdCompetence() {
        return $this->idCompetence;
    }

    public function setIdCompetence($idCompetence) {
        $this->idCompetence = $idCompetence;
    }

    public function getNiveau() {
        return $this->niveau;
    }

    public function setNiveau($niveau) {
        $this->niveau = $niveau;
    }

    public function getLibelleCompetence() {
        return $this->libelleCompetence;
    }

    public function setLibelleCompetence($libelleCompetence) {
        $this->libelleCompetence = $libelleCompetence;
    }

    public function jsonSerialize() {
        return array(
            'idAventurier' => $this->idAventurier,
            'idCompetence' => $this->idCompetence,
            'libelleCompetence' => $this->libelleCompetence,
            'niveau' => $this->niveau
        );
    }

}
