<?php
include_once("../tools/DatabaseLinker.php");
include_once("../DTO/CapaciteDTO.php");
class CapaciteDAO {

    public static function get($idAventurier) {
        $capacites = [];

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT cap.idAventurier,cap.idCompetence,cap.niveau,comp.libelle FROM capacite as cap INNER JOIN competence as comp on comp.idCompetence IN (SELECT idCompetence FROM capacite WHERE idCompetence = cap.idCompetence) WHERE cap.idAventurier= :idAventurier');
        $state->bindValue(":idAventurier", $idAventurier);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0) {
            foreach ($resultats as $result) {
                $capacite = new CapaciteDTO();
                $capacite->setIdAventurier($idAventurier);
                $capacite->setLibelleCompetence($result["libelle"]);
                $capacite->setIdCompetence($result["idCompetence"]);
                $capacite->setNiveau($result["niveau"]);
                $capacites[]=$capacite;
            }
        }

        return $capacites;
    }

}
