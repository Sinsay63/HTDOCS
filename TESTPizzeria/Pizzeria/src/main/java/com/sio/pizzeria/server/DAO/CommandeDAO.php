<?php

include_once('DTO/CommandeDTO.php');

class CommandeDAO {

    public static function get($id) {
        $commande = null;

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM Commande WHERE idCommande = :idCommande');
        $state->bindValue(":idCommande", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0) {
            $result = $resultats[0];
            $commande = new CommandeDTO($result["dateCommande"], $result["facture"], $result["idTableSalle"]);
            $commande->setIdCommande($result["idCommande"]);
        }

        return $commande;
    }

    public static function getList() {
        $commandes = array();

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM Commande');
        $state->execute();
        $resultats = $state->fetchAll();

        foreach ($resultats as $result) {
            $commande = new CommandeDTO($result["dateCommande"], $result["facture"], $result["idTableSalle"]);
            $commande->setIdCommande($result["idCommande"]);

            $commandes[] = $commande;
        }

        return $commandes;
    }

    public static function delete($id) {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('DELETE FROM Commande WHERE idCommande = :idCommande');
        $state->bindValue(":idCommande", $id);
        $state->execute();
    }

    public static function insert($commande) {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('INSERT INTO Commande(dateCommande, facture, idTableSalle) VALUES(:dateCommande, :facture, :idTableSalle)');
        $state->bindValue(":dateCommande", $commande->getDateCommande());
        $state->bindValue(":facture", $commande->getIdfacture());
        $state->bindValue(":idTableSalle", $commande->getIdTableSalle());
        $state->execute();

        $commande->setIdCommande($connex->lastInsertId());
    }

//    public static function update($commande) {
//        $connex = DatabaseLinker::getConnexion();
//
//        $state = $connex->prepare('UPDATE Carte SET nomCarte=:nomCarte, prix=:prix, idMarque=:idMarque WHERE idCarte = :idCarte');
//
//        $state->bindValue(":nomCarte", $carte->getNomCarte());
//        $state->bindValue(":idCarte", $carte->getIdCarte());
//        $state->bindValue(":prix", $carte->getPrix());
//        $state->bindValue(":idMarque", $carte->getIdMarque());
//        $state->execute();
//    }

}
