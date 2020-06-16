<?php

namespace App\Controller;

use App\Repository\VideospielRepository;
use App\Repository\GenreRepository;
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
		$genreRepository = new GenreRepository();
		
		$view = new View('videospiel/create');
		$view->title = 'Videospiel hinzufügen';
		$view->heading = 'Videospiel hinzufügen';
		$view->genres = $genreRepository->readAll();
		$view->display();
	}
	
	public function genre()
	{
		$videospielRepository = new VideospielRepository();
		$view = new View('videospiel/index');
		$view->title = 'Videospiele im Genre: ' . $_GET["genre"];
		$view->heading = 'Videospiele im Genre: ' . $_GET["genre"];
		$view->videospiele = $videospielRepository->readGenre($_GET["genre"]);
		$view->display();
	}
	
    public function doCreate()
    {
        if (isset($_POST['send'])) {
            $videospielRepository = new VideospielRepository();
			$genreRepository = new GenreRepository();
			$titel = $_POST['titel'];
            $publisher = $_POST['publisher'];
            $trailer = $_POST['trailer'];
            $price = $_POST['price'];
            $genre_id = $genreRepository->getID($_POST['genre']);

            
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