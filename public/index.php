<?php
session_start();
<<<<<<< HEAD

=======
>>>>>>> e7d645ef5186264735fa53db8fdc8ea3c1169af0
/*
 * Die index.php Datei ist der Einstiegspunkt des MVC. Hier werden zuerst alle
 * vom Framework benötigten Klassen geladen und danach wird die Anfrage dem
 * Dispatcher weitergegeben.
 *
 * Wie in der .htaccess Datei beschrieben, werden alle Anfragen, welche nicht
 * auf eine bestehende Datei zeigen hierhin umgeleitet.
 */

require_once __DIR__.'/../vendor/autoload.php';

use App\Dispatcher\Dispatcher;
use App\Exception\ExceptionListener;

ExceptionListener::register();
Dispatcher::dispatch();
