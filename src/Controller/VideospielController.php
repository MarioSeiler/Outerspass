<?php

namespace App\Controller;

use App\Repository\VideospielRepository;
use App\View\View;


class VideospielController
{
	public function index()
	{
		$videospielRepository = new VideospielRepository();
		
		$view = new View('videospiel/index');
		$view->title = 'Videospiele';
		$view->heading = 'Videospiele';
		$view->videospiele = $videospielRepository->readAll();
		$view->display();
	}
	
	public function create()
	{
		$view = new View('videospiel/create');
		$view->title = 'Videospiel hinzufügen';
		$view->heading = 'Videospiel hinzufügen';
		$view->display();
	}
	
	public function single()
	{
		$view = new View('videospiel/single');
		$view->title = 'Videospiel Einzelansicht';
		$view->heading = 'Videospiel Einzelansicht';
		$view->display();
	}
	
	public function genre($genre)
	{
		$view = new View('videospiel/index');
		$view->title = 'Videospiele im Genre von' . $genre;
		$view->heading = 'Videospiele im Genre von' . $genre;
		$view->videospiele = $videospielRepository->readGenre($genre);
		$view->display();
	}
	
    public function doCreate()
    {
        if (isset($_POST['send'])) {
            $videospielRepository = new VideospielRepository();
			$titel = $_POST['titel'];
            $publisher = $_POST['publisher'];
            $trailer = $_POST['trailer'];
            $price = $_POST['price'];
            $genre_id = $videospielRepository->getGenre_id($_POST['genre_id']);

            
            $videospielRepository->create($titel, $publisher, $trailer, $price, $genre_id);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /videospiel');
    }

    public function delete()
    {
        $videospielRepository = new VideospielRepository();
        $videospielRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /videospiel');
    }
}

?>