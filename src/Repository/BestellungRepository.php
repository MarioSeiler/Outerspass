<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;


class BestellungRepository extends Repository
{
	protected $tableName = 'bestellung';
	protected $supportTableName1 = 'videospiel';
	protected $supportTableName2 = 'user';
	
	public function create($user_id, $videospiel_id)
	{
		$query = "INSERT INTO $this->tableName (user_id, videospiel_id,istGekauft) VALUES (?,?,?)";
		
		$statement = ConnectionHandler::getConnection()->prepare($query);
		
		$istGekauft = false;
		$statement->bind_param('iib', $user_id, $videospiel_id, $istGekauft);

        if (!$statement->execute()) { 
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
	}
	
	/*public function readGenre($genre)
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
	}*/
	
	public function readBestellungen($user_id)
	{
			$query = "SELECT {$this->tableName}.id, {$this->supportTableName1}.titel, {$this->supportTableName1}.price FROM {$this->tableName} INNER JOIN {$this->supportTableName1} ON {$this->tableName}.videospiel_id = {$this->supportTableName1}.id 
		INNER JOIN {$this->supportTableName2} ON {$this->tableName}.user_id = {$this->supportTableName2}.id WHERE {$this->tableName}.user_id=?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $user_id);

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
	
	public function deleteById($id)
    {
        $query = "DELETE FROM {$this->tableName} WHERE id=? AND user_id=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $id, $_SESSION['user_id']);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }
}
?>