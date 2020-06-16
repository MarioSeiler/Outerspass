<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;


class VideospielRepository extends Repository
{
	protected $tableName = 'videospiel';
	protected $supportTableName ='genre';
	
	public function create($titel, $publisher, $trailer, $price, $genre_id)
	{
		$query = "INSERT INTO $this->tableName (titel, publisher, trailer, price, genre_id) VALUES (?,?,?,?,?)";
		
		$statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sssdi', $titel, $publisher, $trailer, $price, $genre_id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
	}
	
	public function readGenre($genre)
	{
		 // Query erstellen
        $query = "SELECT {$this->tableName}.*, {$this->supportTableName}.genre FROM {$this->tableName} INNER JOIN {$this->supportTableName} ON {$this->tableName}.genre_id = {$this->supportTableName}.id WHERE {$this->supportTableName}.genre=?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $genre);

        // Das Statement absetzen
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
		
		$rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        // Datenbankressourcen wieder freigeben
        $result->close();

        // Den gefundenen Datensatz zurückgeben
        return $rows;
	}
	
	public function getGenre_id($genre)
	{
		$query = "SELECT {$this->supportTableName}.id FROM {$this->tableName} INNER JOIN {$this->supportTableName} ON {$this->tableName}.genre_id = {$this->supportTableName}.id WHERE {$this->supportTableName}.genre=?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $genre);

        // Das Statement absetzen
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_object();

        // Datenbankressourcen wieder freigeben
        $result->close();

        // Den gefundenen Datensatz zurückgeben
        return $row;
	}
	
	public function readAll($max = 100)
	{
		$query = "SELECT {$this->tableName}.*, {$this->supportTableName}.genre FROM {$this->tableName} INNER JOIN {$this->supportTableName} ON {$this->tableName}.genre_id = {$this->supportTableName}.id LIMIT 0, $max";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        return $rows;
	}
}
?>