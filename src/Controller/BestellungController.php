<?php

namespace App\Controller;

use App\Repository\BestellungRepository;
use App\View\View;
use Exception;


class BestellungController
{
	public function index()
	{
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            header("location: /user/login");
            exit;
        }
		$bestellungRepository = new BestellungRepository();
		
		$view = new View('bestellung/index');
		$view->title = 'Warenkorb';
		$view->heading = 'Warenkorb';
		$view->bestellungen = $bestellungRepository->readBestellungen($_SESSION["user_id"]);
		$view->display();
	}
	
	public function doCreate()
	{
		if (isset($_POST['send']) || isset($_POST['user_id']) || empty($_POST['user_id']) || isset($_POST['videospiel_id']) || empty($_POST['videospiel_id'])) 
		{
            $user_id = $_POST['user_id'];
            $videospiel_id = $_POST['videospiel_id'];

            $bestellungRepository = new BestellungRepository();
            $bestellungRepository->create($user_id, $videospiel_id);
			header('Location: /videospiel');
        }
		else
		{
			throw new Exception("Konnte Videospiel nicht zum Warenkorb hinzufügen");
		}
		
	}

    public function delete()
    {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && isset($_GET['id']) || empty($_GET['id']))
		{
		$bestellungRepository = new BestellungRepository();
        $bestellungRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
		header('Location: /bestellung');
		}
		else
		{
			throw new Exception("Nicht angemeldet");
		}
        
    }
}

?>