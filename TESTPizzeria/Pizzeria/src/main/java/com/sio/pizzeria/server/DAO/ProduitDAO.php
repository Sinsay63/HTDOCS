<?php

include_once('DTO/ProduitDTO.php');

class ProduitDAO {

    public static function get($id) {
        $produit = null;

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM Produit WHERE idProduit = :idProduit');
        $state->bindValue(":idProduit", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0) {
            $result = $resultats[0];
            $produit = new ProduitDTO($result["nomProduit"], $result["prix"], $result["idTypeProduit"]);
            $produit->setIdProduit($result["idProduit"]);
        }

        return $produit;
    }

    public static function getList() {
        $produits = array();

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM Produit');
        $state->execute();
        $resultats = $state->fetchAll();

        foreach ($resultats as $result) {
            $produit = new ProduitDTO($result["nomProduit"], $result["prix"], $result["idTypeProduit"]);
            $produit->setIdProduit($result["idProduit"]);

            $produits[] = $produit;
        }

        return $produits;
    }

    public static function delete($id) {
        $connex = DatabaseLinker::getConnexion();
        $success = false;
        $state = $connex->prepare('DELETE FROM Produit WHERE idProduit = :idProduit');
        $state->bindValue(":idProduit", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0) {
            $success = true;
        }
        return $success;
    }

    public static function insert($produit) {
        $connex = DatabaseLinker::getConnexion();
        $state = $connex->prepare('INSERT INTO Produit(nomProduit,prix,idTypeProduit) VALUES(:nomProduit,:prix,:idTypeProduit)');
        $state->bindValue(":nomProduit", $produit->getNomProduit());
        $state->bindValue(":prix", $produit->getPrix());
        $state->bindValue(":idTypeProduit", $produit->getIdTypeProduit());
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0) {
            $produit->setIdProduit($connex->lastInsertId());
            return $produit;
        }
        return null;
    }

    public static function update($produit) {
        $connex = DatabaseLinker::getConnexion();
        $success = false;

        $state = $connex->prepare('UPDATE Produit SET nomProduit=:nomProduit, prix = :prix, idTypeProduit = :idTypeProduit WHERE idProduit = :idProduit');

        $state->bindValue(":idProduit", $produit->getIdProduit());
        $state->bindValue(":nomProduit", $produit->getNomProduit());
        $state->bindValue(":prix", $produit->getPrix());
        $state->bindValue(":idTypeProduit", $produit->getIdTypeProduit());
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0) {
            $success = true;
        }
        return $success;
    }

}
