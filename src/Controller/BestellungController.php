<?php

namespace App\Controller;

use App\Repository\BestellungRepository;
use App\View\View;


class BestellungController
{
	public function index()
	{
		$bestellungRepository = new BestellungRepository();
		
		$view = new View('bestellung/index');
		$view->title = 'Warenkorb';
		$view->heading = 'Warenkorb';
		$view->bestellungen = $bestellungRepository->readBestellungen();
		$view->display();
	}
	
	public function doCreate()
	{
		if (isset($_POST['send'])) {
            $firstName = $_POST['user_id'];
            $lastName = $_POST['videospiel_id'];

            $bestellungRepository = new BestellungRepository();
            $bestellungRepository->create($user_id, $videospiel_id);
        }
	}

    public function delete()
    {
        $bestellungRepository = new BestellungRepository();
        $bestellungRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /videospiel');
    }
}

?>