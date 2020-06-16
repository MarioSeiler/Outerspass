<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;


class GenreRepository extends Repository
{
	protected $tableName = 'genre';
	
	public function getID($genre)
	{
		$query = "SELECT * FROM {$this->tableName} WHERE {$this->tableName}.genre=?";

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
        return $row->id;
	}
}

?>