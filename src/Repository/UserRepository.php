<?php

namespace App\Repository;

use App\Database\ConnectionHandler;
use Exception;

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class UserRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'user';

    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param $firstName Wert für die Spalte firstName
     * @param $lastName Wert für die Spalte lastName
     * @param $email Wert für die Spalte email
     * @param $password Wert für die Spalte password
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function create($firstName, $lastName, $email, $password)
    {
        
        if(empty($firstName) || empty($lastName) || empty($email) || empty($password) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception("Keine gültige E-Mail");
            exit;
        }
        $query = "Select * from $this->tableName where email = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $email);

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
        if($row->email == $email){

            throw new Exception("E-Mail wird bereits verwendet.");
            exit;

        }

        $password = sha1($password);
        
        $query = "INSERT INTO $this->tableName (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssss', $firstName, $lastName, $email, $password);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;


    }

    public function login($email, $password)
    {

        $query = "Select * from $this->tableName where email = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $email);

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
        if($row->email == $email && $row->password == sha1($password)){

            $_SESSION["loggedin"] = true;
            $_SESSION["user"] = $row->email;
			$_SESSION["user_id"] = $row->id;

        }

    }
    public function update($firstName, $lastName, $email, $password, $passwordRepeat, $id){
        if(($password != $passwordRepeat) || empty($firstName) || empty($lastName) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception("Luis gay Fehler!");
            exit;
        }

        
        if(empty($password)){
            $query = "UPDATE $this->tableName SET firstName = ?, lastName = ?, email = ? where id = ?";
            
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('sssi', $firstName, $lastName, $email, $id);
            
            if (!$statement->execute()) {
                throw new Exception($statement->error);
            }
            return $statement->insert_id; 
        }
        else{
            $password = sha1($password);
            
            $query = "UPDATE $this->tableName SET firstName = ?, lastName = ?, email = ?, password = ? where id = ?";
    
            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('ssssi', $firstName, $lastName, $email, $password, $id);
    
            if (!$statement->execute()) {
                throw new Exception($statement->error);
            }
            return $statement->insert_id;

        }

    }

}
