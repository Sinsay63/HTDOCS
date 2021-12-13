<?php

class TableSalleDTO {

    private $idTableSalle;
    private $numero;
    private $nbPersonne;

    public function __construct($numero, $nbPersonne) {
        $this->numero = $numero;
        $this->nbPersonne = $nbPersonne;
    }

    public function getIdTableSalle() {
        return $this->idTableSalle;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getNbPersonne() {
        return $this->nbPersonne;
    }

    public function setIdTableSalle($idTableSalle): void {
        $this->idTableSalle = $idTableSalle;
    }

    public function setNumero($numero): void {
        $this->numero = $numero;
    }

    public function setNbPersonne($nbPersonne): void {
        $this->nbPersonne = $nbPersonne;
    }

}
