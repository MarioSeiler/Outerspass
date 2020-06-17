<?php

namespace App\Controller;

use App\Repository\VideospielRepository;
use App\Repository\GenreRepository;
use App\View\View;
use Exception;


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
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['user'] == 'bseilm@bbcag.ch')
		{
			$genreRepository = new GenreRepository();

			$view = new View('videospiel/create');
			$view->title = 'Videospiel hinzufügen';
			$view->heading = 'Videospiel hinzufügen';
			$view->genres = $genreRepository->readAll();
			$view->display();
		}
		else
		{
			throw new Exception("Nur Admins haben Zugang");
		}
	}
	
	
	public function doSearch()
	{
		if (isset($_GET["send"]) || isset($_GET["searchtype"]) || empty($_GET["searchtype"]) || isset($_GET["q"]) || empty($_GET["q"]))
		{
			$videospielRepository = new VideospielRepository();
			$view = new View('videospiel/index');
			$view->title = 'Videospiele';
			$view->heading = 'Videospiele';
			$view->videospiele = $videospielRepository->readSearch($_GET["searchtype"],$_GET["q"]);
			$view->display();
		}
		else
		{
			
			throw new Exception("Fehlerhafte Eingabe");
		}
	}
	
    public function doCreate()
    {
        if (isset($_POST['send']) || isset($_POST['titel']) || empty($_POST['titel']) || isset($_POST['publisher']) || empty($_POST['publisher']) || isset($_POST['trailer']) || empty($_POST['trailer']) || isset($_POST['price']) || empty($_POST['price']) || isset($_POST['genre']) || empty($_POST['genre']))
		{
            $videospielRepository = new VideospielRepository();
			$genreRepository = new GenreRepository();
			$titel = $_POST['titel'];
            $publisher = $_POST['publisher'];
            $trailer = $_POST['trailer'];
            $price = $_POST['price'];
            $genre_id = $genreRepository->getID($_POST['genre']);

            
            $videospielRepository->create($titel, $publisher, $trailer, $price, $genre_id);	
			header('Location: /videospiel');
        }
		else
		{
			
			throw new Exception("Fehlerhafte Daten angegeben");
		}
        
    }

    public function delete()
    {
		
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['user'] == 'bseilm@bbcag.ch')
		{
			if(isset($_GET['id']) || empty($_GET['id']))
			{
				$videospielRepository = new VideospielRepository();
				$videospielRepository->deleteById($_GET['id']);

				// Anfrage an die URI /user weiterleiten (HTTP 302)
				header('Location: /videospiel');
				
			}
			else
			{
				throw new Exception("Keine ID angegeben");
			}
			
		}
		else 
		{
			throw new Exception("Nur Admins haben Zugang");
		}
    }
}

?>