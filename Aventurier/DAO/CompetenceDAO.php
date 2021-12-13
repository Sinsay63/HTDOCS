<?php

include_once("../tools/DatabaseLinker.php");
include_once("../DTO/CompetenceDTO.php");

class CompetenceDAO {

    public static function get($id) {
        $competence = null;

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM Competence WHERE idCompetence = :idCompetence');
        $state->bindValue(":idCompetence", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0) {
            $result = $resultats[0];
            $competence = new CompetenceDTO();
            $competence->setIdCompetence($result["idCompetence"]);
            $competence->setLibelle($result["libelle"]);
        }

        return $competence;
    }

    public static function getList() {
        $competences = array();

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM Competence');
        $state->execute();
        $resultats = $state->fetchAll();

        foreach ($resultats as $result) {
            $competence = new CompetenceDTO();
            $competence->setIdCompetence($result["idCompetence"]);
            $competence->setLibelle($result["libelle"]);
            $competences[] = $competence;
        }

        return $competences;
    }

    public static function insert($competence) {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('INSERT INTO Competence(libelle) VALUES(:libelle)');
        $state->bindValue(":libelle", $competence->getLibelle());
        $state->execute();

        $competence->setIdCompetence($connex->lastInsertId());
    }

    public static function update($competence) {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('UPDATE Competence SET libelle=:libelle WHERE idCompetence=:idCompetence');
        $state->bindValue(":libelle", $competence->getLibelle());
        $state->bindValue(":idCompetence", $competence->getIdCompetence());
        $state->execute();
    }

}
