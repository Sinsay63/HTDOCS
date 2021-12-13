<?php

include_once('DTO/CarteDTO.php');

class CarteDAO {

    public static function get($id) {
        $carte = null;

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM Carte WHERE idCarte = :idCarte');
        $state->bindValue(":idCarte", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0) {
            $result = $resultats[0];
            $carte = new CarteDTO($result["nomCarte"], $result["prix"], $result["idMarque"]);
            $carte->setIdCarte($result["idCarte"]);
        }

        return $carte;
    }

    public static function getList() {
        $cartes = array();

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM Carte');
        $state->execute();
        $resultats = $state->fetchAll();

        foreach ($resultats as $result) {
            $carte = new CarteDTO($result["nomCarte"], $result["prix"], $result["idMarque"]);
            $carte->setIdCarte($result["idCarte"]);

            $cartes[] = $carte;
        }

        return $cartes;
    }

    public static function delete($id) {
        $connex = DatabaseLinker::getConnexion();
        $success = false;
        $state = $connex->prepare('DELETE FROM Carte WHERE idCarte = :idCarte');
        $state->bindValue(":idCarte", $id);
        $state->execute();
        $result = $state->fetchAll();
        if (sizeof($result) > 0) {
            $success = true;
        }
        return $success;
    }

    public static function insert($carte) {
        $connex = DatabaseLinker::getConnexion();
        $success = false;
        $state = $connex->prepare('INSERT INTO Carte(nomCarte,prix,idMarque) VALUES(:nomCarte,:prix,:idMarque)');
        $state->bindValue(":nomCarte", $carte->getNomCarte());
        $state->bindValue(":prix", $carte->getPrix());
        $state->bindValue(":idMarque", $carte->getIdMarque());
        $state->execute();
        $carte->setIdCarte($connex->lastInsertId());
        $result = $state->fetchAll();
        if (sizeof($result) > 0) {
            $success = true;
        }
        return $success;
    }

    public static function update($carte) {
        $connex = DatabaseLinker::getConnexion();
        $success = false;
        $state = $connex->prepare('UPDATE Carte SET nomCarte=:nomCarte,prix = :prix, idMarque=:idMarque WHERE idCarte = :idCarte');

        $state->bindValue(":nomCarte", $carte->getNomCarte());
        $state->bindValue(":prix", $carte->getPrix());
        $state->bindValue(":idMarque", $carte->getIdMarque());
        $state->bindValue(":idCarte", $carte->getIdCarte());
        $state->execute();
        $result = $state->fetchAll();

        if (sizeof($result) > 0) {
            $success = true;
        }
        return $success;
    }

}
