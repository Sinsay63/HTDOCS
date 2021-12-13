<?php

include_once('DTO/MarqueDTO.php');

class MarqueDAO {

    public static function get($id) {
        $marque = null;

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM Marque WHERE idMarque = :idMarque');
        $state->bindValue(":idMarque", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0) {
            $result = $resultats[0];
            $marque = new MarqueDTO($result["nomMarque"]);
            $marque->setIdMarque($result["idMarque"]);
        }

        return $marque;
    }

    public static function getList() {
        $marques = array();

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM Marque');
        $state->execute();
        $resultats = $state->fetchAll();

        foreach ($resultats as $result) {
            $marque = new MarqueDTO($result["nomMarque"]);
            $marque->setIdMarque($result["idMarque"]);

            $marques[] = $marque;
        }

        return $marques;
    }

    public static function delete($id) {
        $connex = DatabaseLinker::getConnexion();
        $success = false;
        $state = $connex->prepare('DELETE FROM Marque WHERE idMarque = :idMarque');
        $state->bindValue(":idMarque", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0) {
            $success = true;
        }
        return $success;
    }

    public static function insert($marque) {
        $connex = DatabaseLinker::getConnexion();
        $state = $connex->prepare('INSERT INTO Marque(nomMarque) VALUES(:nomMarque)');
        $state->bindValue(":nomMarque", $marque->getNomMarque());
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0) {
            $marque->setIdMarque($connex->lastInsertId());
            return $marque;
        }
        return null;
    }

    public static function update($marque) {
        $connex = DatabaseLinker::getConnexion();
        $success = false;

        $state = $connex->prepare('UPDATE Marque SET nomMarque=:nomMarque WHERE idMarque = :idMarque');

        $state->bindValue(":nomMarque", $marque->getNomMarque());
        $state->bindValue(":idMarque", $marque->getIdMarque());
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0) {
            $success = true;
        }
        return $success;
    }

}
