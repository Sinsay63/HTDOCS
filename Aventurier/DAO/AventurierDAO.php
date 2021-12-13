<?php

include_once("../tools/DatabaseLinker.php");
include_once("../DTO/AventurierDTO.php");

class AventurierDAO {

    public static function get($id) {
        $aventurier = null;

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM Aventurier WHERE idAventurier = :idAventurier');
        $state->bindValue(":idAventurier", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0) {
            $result = $resultats[0];
            $aventurier = new AventurierDTO();
            $aventurier->setIdAventurier($result["idAventurier"]);
            $aventurier->setNomAventurier($result["nomAventurier"]);
            $aventurier->setPrenomAventurier($result["prenomAventurier"]);
            $aventurier->setDateNaissance($result["dateNaissance"]);
        }

        return $aventurier;
    }

    public static function getList() {
        $aventuriers = array();

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM Aventurier');
        $state->execute();
        $resultats = $state->fetchAll();

        foreach ($resultats as $result) {
            $aventurier = new AventurierDTO();
            $aventurier->setIdAventurier($result["idAventurier"]);
            $aventurier->setNomAventurier($result["nomAventurier"]);
            $aventurier->setPrenomAventurier($result["prenomAventurier"]);
            $aventurier->setDateNaissance($result["dateNaissance"]);

            $aventuriers[] = $aventurier;
        }

        return $aventuriers;
    }

    public static function insert($aventurier) {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('INSERT INTO Aventurier(nomAventurier, prenomAventurier, dateNaissance) VALUES(:nomAventurier, :prenomAventurier, :dateNaissance)');
        $state->bindValue(":nomAventurier", $aventurier->getNomAventurier());
        $state->bindValue(":prenomAventurier", $aventurier->getPrenomAventurier());
        $state->bindValue(":dateNaissance", $aventurier->getDateNaissance());
        $state->execute();

        $aventurier->setIdAventurier($connex->lastInsertId());
    }

    public static function update($aventurier) {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('UPDATE Aventurier SET nomAventurier=:nomAventurier, prenomAventurier=:prenomAventurier, dateNaissance=:dateNaissance WHERE idAventurier=:idAventurier');
        $state->bindValue(":nomAventurier", $aventurier->getNomAventurier());
        $state->bindValue(":prenomAventurier", $aventurier->getPrenomAventurier());
        $state->bindValue(":dateNaissance", $aventurier->getDateNaissance());
        $state->bindValue(":idAventurier", $aventurier->getIdAventurier());
        $state->execute();
    }

    public static function updateBirthByIdAventurier($date, $idAventurier) {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('UPDATE Aventurier SET dateNaissance=:dateNaissance WHERE idAventurier=:idAventurier');
        $state->bindValue(":dateNaissance", $date);
        $state->bindValue(":idAventurier", $idAventurier);
        $state->execute();
    }

}
