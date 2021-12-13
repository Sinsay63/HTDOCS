<?php

class TableSalleDAO {
    public static function get($id)
		{
			$tableSalle = null;

			$connex = DatabaseLinker::getConnexion();

			$state = $connex->prepare('SELECT * FROM TableSalleDAO WHERE idTableSalle = :idTableSalle');
			$state->bindValue(":idTableSalle", $id);
			$state->execute();
			$resultats = $state->fetchAll();

			if (sizeof($resultats) > 0)
			{
				$result = $resultats[0];
				$tableSalle = new TableSalleDTO($result["numero"], $result["nbPersonne"], $result["idTableSalle"]);
				$tableSalle->setIdtableSalle($result["idtableSalle"]);
			}

			return $tableSalle;
		}

		public static function getList()
		{
			$tableSalles = array();

			$connex = DatabaseLinker::getConnexion();

			$state = $connex->prepare('SELECT * FROM TableSalle');
			$state->execute();
			$resultats = $state->fetchAll();

			foreach ($resultats	as $result)
			{
				$carte = new TableSalleDTO($result["numero"], $result["nbPersonne"], $result["idTableSalle"]);
				$carte->setIdtableSalle($result["idTableSalle"]);
				
				$tableSalles[] = $tableSalle;
			}

			return $tableSalles;
		}

		public static function delete($id)
		{
			$connex = DatabaseLinker::getConnexion();

			$state = $connex->prepare('DELETE FROM TableSalle WHERE idTableSalle = :idTableSalle');
			$state->bindValue(":idTableSalle", $id);
			$state->execute();
		}

		public static function insert($tableSalle)
		{
			$connex = DatabaseLinker::getConnexion();

			$state = $connex->prepare('INSERT INTO TableSalle(numero, nbPersonne, idTableSalle) VALUES(:numero, :nbPersonne, :idTableSalle)');
			$state->bindValue(":numero", $tableSalle->getNumero());
			$state->bindValue(":nbPersonne", $tableSalle->getNbPersonne());
			$state->bindValue(":idTableSalle", $carte->getTableSalle());
			$state->execute();

			$carte->setIdtableSalle($connex->lastInsertId());
		}

		public static function update($tableSalle)
		{
			$connex = DatabaseLinker::getConnexion();

			$state = $connex->prepare('UPDATE TableSalle SET numero=:numero, nbPersonne=:nbPersonne, idTableSalle=:idTableSalle WHERE idTableSalle = :idTableSalle');
	
			$state->bindValue(":numero", $tableSalle->getNumero());
			$state->bindValue(":idTableSalle", $tableSallee->getIdTableSalle());
			$state->bindValue(":nbPersonne", $tableSalle->getNbPersonne());
			$state->bindValue(":idCommande", $tableSalle->getIdCommande());
			$state->execute();
		}
}
