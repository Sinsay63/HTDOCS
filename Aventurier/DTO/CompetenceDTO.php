<?php

class CompetenceDTO implements JsonSerializable {

    private $idCompetence;
    private $libelle;

    public function getIdCompetence() {
        return $this->idCompetence;
    }

    public function setIdCompetence($idCompetence) {
        $this->idCompetence = $idCompetence;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    public function jsonSerialize() {
        return array(
            'idCompetence' => $this->idCompetence,
            'libelle' => $this->libelle
        );
    }

}
