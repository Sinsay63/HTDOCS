<?php

class TailleDTO {

    private $idTaille;
    private $nomTaille;

    public function __construct($nomTaille) {
        $this->nomTaille = $nomTaille;
    }

    public function getIdTaille() {
        return $this->idTaille;
    }

    public function getNomTaille() {
        return $this->nomTaille;
    }

    public function setIdTaille($idTaille): void {
        $this->idTaille = $idTaille;
    }

    public function setNomTaille($nomTaille): void {
        $this->nomTaille = $nomTaille;
    }

}
