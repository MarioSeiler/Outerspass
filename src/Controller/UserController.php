<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\View\View;
use Exception;

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{
    public function index()
    {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['user'] == 'bseilm@bbcag.ch')
		{
			$userRepository = new UserRepository();

			$view = new View('user/index');
			$view->title = 'Benutzer';
			$view->heading = 'Benutzer';
			$view->users = $userRepository->readAll();
			$view->display();
		}
		else
		{
			throw new Exception("Nur Admins haben Zugang");
		}
    }

    public function create()
    {
        $view = new View('user/create');
        $view->title = 'Benutzer erstellen';
        $view->heading = 'Benutzer erstellen';
        $view->display();
    }

    public function doCreate()
    {      
		if(isset($_POST['fname']) || isset($_POST['lname']) || isset($_POST['email']) || isset($_POST['password']) || empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['email']) || empty($_POST['password']) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $userRepository = new UserRepository();
			$userRepository->create($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password']);

			// Anfrage an die URI /user weiterleiten (HTTP 302)
			header('Location: /');
        }
		else
		{
			
			throw new Exception("Keine gültige E-Mail");
            exit;
		}

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /');
    }
    public function login(){
        $view = new View('user/login');
        $view->title = 'Anmelden';
        $view->heading = 'Anmelden';
        $view->display();
    }

    public function doLogin(){

		if(isset($_POST['email']) || empty($_POST['email']) || isset($_POST['password'])|| empty($_POST['password']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$userRepository = new UserRepository();
			$userRepository->login($_POST['email'], $_POST['password']);

			// Check if the user is logged in, if not then redirect him to login page
			if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
				header("location: login");
				exit;
			}
			else
			{
				header("location: /default/index");
			}
		}
		else
		{
			
			throw new Exception ("Ungültige Anmeldedaten");
			exit;
		}
        

    }
    public function update(){
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            header("location: login");
            exit;
        }
        
        $userRepository = new UserRepository();
        $view = new View('user/update');
        $view->title = 'Ändern';
        $view->heading = 'Ändern';
        $view->user = $userRepository->readbyID($_SESSION['user_id']);
        $view->display();

    }
    public function doUpdate(){
		if(isset($_POST['fname']) || isset($_POST['lname']) || isset($_POST['email']) || isset($_POST['password']) || isset($_POST['password-repeat']) || empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password-repeat']) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $_POST['password'] !== $_POST['password-repeat']){ 
			$userRepository = new UserRepository();
			$userRepository->update($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password'], $_POST['password-repeat'], $_POST['id']);

			header("location: /user/update");
			
            
        }
		else
		{
			throw new Exception("Fehlerhafte Daten angegeben");
            exit;
		}
    }


    public function delete()
    {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['user'] == 'bseilm@bbcag.ch')
		{
			if(isset($_GET['id']) || empty($_GET['id']))
			{
                $userRepository = new UserRepository();
                $userRepository->deleteById($_GET['id']);
                // Anfrage an die URI /user weiterleiten (HTTP 302)
                        header('Location: /user');
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

    public function logout(){

        $_SESSION = array();
        // Finally, destroy the session.
        session_destroy();

        
        session_start();
        $_SESSION['loggedin'] = false;

        header('Location: /user/login');
    }
}
