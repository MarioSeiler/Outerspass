<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\View\View;

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{
    public function index()
    {
        $userRepository = new UserRepository();

        $view = new View('user/index');
        $view->title = 'Benutzer';
        $view->heading = 'Benutzer';
        $view->users = $userRepository->readAll();
        $view->display();
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

        if (isset($_POST['email']) && ! empty($_POST['email'])) {
            $email = $_POST['email'];
            
            // see: http://php.net/manual/de/function.filter-var.php
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo 'This is not an email';
            }
        } else {
            echo 'Email not set';
        }
        
        if (isset($_POST['send'])) {
            $firstName = $_POST['fname'];
            $lastName = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userRepository = new UserRepository();
            $userRepository->create($firstName, $lastName, $email, $password);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }
    public function login(){
        $view = new View('user/login');
        $view->title = 'Anmelden';
        $view->heading = 'Anmelden';
        $view->display();
    }

    public function doLogin(){

        $userRepository = new UserRepository();
        $userRepository->login($_POST['email'], $_POST['password']);

        // Check if the user is logged in, if not then redirect him to login page
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            header("location: login");
            exit;
        }
        else{
            header("location: /default/index");
        }

    }

    public function delete()
    {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }
}
