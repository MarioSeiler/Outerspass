<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;


class VideospielRepository extends Repository
{
	protected $tableName = 'videospiel';
	
	public function create($titel, $publisher, $trailer, $price, $genre_id)
	{
		$query = "INSERT INTO $this->tableName (titel, publisher, trailer, price, genre_id) VALUES (?,?,?,?)";
		
		$statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssss', $titel, $publisher, $trailer, $price, $genre_id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
	}
	
	public function readGenre($genre)
	{
		 // Query erstellen
        $query = "SELECT * FROM {$this->tableName} INNER JOIN genre ON $this->tablename.genre_id = genre.id WHERE genre.genre=?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $genre);

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
		$query = "SELECT genre.genre_id FROM {$this->tableName} INNER JOIN genre ON $this->tablename.genre_id = genre.id WHERE genre.genre=?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $genre);

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
}
?>