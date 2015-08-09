<?php

//Pozivanje svih namespace-ova
use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

use Noodlehaus\Config;

use Code\User\User;

//Pokretanje sessije
session_cache_limiter(false);
session_start();

//Ukljucivanje i prikazivanje gresaka,a u produkcijskim uslovima ovo trebamo staviti na Off
ini_set('display_errors', 'On');

//Drugo definirati include root putanju (putanja do include foldera)
//Daje nam apsolutnu putanju do root foldera (C:\xampp\htdocs\Vijezbe\Church) "echo INC_ROOT",olaksava uljucivanje dr. fold. i fajlova
define('INC_ROOT', dirname(__DIR__));

//Ukljucivanje autoload.php fajla
require_once INC_ROOT . '/vendor/autoload.php';


//Nova instanca Slim klase sa opcijama u konstrktoru
$app = new Slim([
	'mode' => file_get_contents(INC_ROOT . '/mode.txt'),
	'view' => new Twig(),
	'templates.path' => INC_ROOT . '/app/views'
]);

//Ucitaavanje konfiguracijskih postavki iz production ili developmenet fajla,preko 'mode' u konstrktoru Slim k.
//A koristimo configureMode() Slim m. da te konf. dodamo u Slim contaner. Coristimo Config klasu iz hasankan paketa i load() m. za povlacenje config. fajla

$app->configureMode($app->config('mode'), function() use ($app) {
	$app->config = Config::load(INC_ROOT . "/app/config/{$app->mode}.php");
});

//Dodavanje fajla database.php sa konekcijom na bazu podataka
require_once 'database.php';

//Ukljucivanje fajla sa svim putanjama u nasoj aplikaciji
require_once 'routes.php';

//Dodavanje User klase tj.modela u Slim container radi daljeg koristenje u Slim-u
$app->container->set('user', function() {
	return new User;
});

//Konfigurisanje views omogucuje ukljucivanje debugginga i parser_extensiona

$view = $app->view();

$view->parserOptions = ['debug' => $app->config->get('twig.debug')]; //Dohvatanje twgig opcije iz config fajla

//Konfigurisanje i dodavanje Parser Extensiona,a arg. mu je TwigExtension koji nam omogucava da generisemo URL u views-u

$view->parserExtension = [new TwigExtension];

?>