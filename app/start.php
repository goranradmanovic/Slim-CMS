<?php

//Pozivanje svih namespace-ova
use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

use Noodlehaus\Config;
use RandomLib\Factory as RandomLib;
use BulletProof\Image;

use Code\User\User;
use Code\Helpers\Hash;
use Code\Validation\Validator;
use Code\Middleware\BeforeMiddleware;
use Code\Middleware\CsrfMiddleware;
use Code\Mail\Mailer;
use Code\Article\Article;
use Code\Album\Album;
use Code\Photo\Photo;

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

//Ukljucivanje BeforeMiddleware klasa u Slim aplikaciju uz pomoc add() m.
$app->add(new BeforeMiddleware);

//Ukljucivanje CsrfMiddleware klase u Slim aplikaciju uz pomoc add() m.
$app->add(new CsrfMiddleware);

//Ucitaavanje konfiguracijskih postavki iz production ili developmenet fajla,preko 'mode' u konstrktoru Slim k.
//A koristimo configureMode() Slim m. da te konf. dodamo u Slim contaner. Coristimo Config klasu iz hasankan paketa i load() m. za povlacenje config. fajla

$app->configureMode($app->config('mode'), function() use ($app) {
	$app->config = Config::load(INC_ROOT . "/app/config/{$app->mode}.php");
});

//Dodavanje fajla database.php sa konekcijom na bazu podataka
require_once 'database.php';

//Uljucivanje filters.php fajla da bi onemogucili korisnika da ide na odredjene dijelove aplikacije kroz URL
require_once 'filters.php';

//Ukljucivanje fajla sa svim putanjama u nasoj aplikaciji
require_once 'routes.php';

//Dodavanje Midleware-a stanja (state) na Slim container kad korisnik nije autentificiran tj. potvrdjen
//ako je $app->auth = true; onda imamo user object dodan na ovaj auth i da mozemo dohvatiti podatke o trenutnom ulogovanom kor.

$app->auth = false;

//Dodavanje User klase tj.modela u Slim container radi daljeg koristenje u Slim-u
$app->container->set('user', function() {
	return new User;
});

//Dodavanje Hash klase u Slim container

$app->container->singleton('hash', function() use ($app) {
	return new Hash($app->config);
});

//Dodavanje Validator klase u Slim conatiner

$app->container->singleton('validation', function() use ($app) {
	return new Validator($app->user, $app->hash, $app->album, $app->auth);
});

//Ukljucivanje PHPMailera i Mailer kalse u Slim container

$app->container->singleton('mail', function() use ($app) {
	$mailer = new PHPMailer;

	$mailer->isSMTP();
	$mailer->Host = $app->config->get('mail.host');
	$mailer->SMTPAuth = $app->config->get('mail.smtp_auth');
	$mailer->SMTPSecure = $app->config->get('mail.smtp_secure');
	$mailer->Port = $app->config->get('mail.port');
	$mailer->Username = $app->config->get('mail.username');
	$mailer->Password = $app->config->get('mail.password');
	$mailer->isHTML($app->config->get('mail.html'));

	//Return mailer object. $app->view omogucava slanje view-sa sa emailom u sebi korisniku,a $mailer postavlja PHPMailer postavke

	return new Mailer($app->view, $mailer);
});

//Uljucivanje RandomLib paketa u Slim conatiner

$app->container->singleton('randomlib', function() use ($app) {
	//Instanciramo RandomLib biblioteku

	$factory = new RandomLib;

	//Metod za generisanje nasumicnih stringova iz RandomLib-a

	return $factory->getMediumStrengthGenerator();
});

//Uklucivanje BulletProof klase u Slim2 conatiner

$app->container->set('image', function() {
	//Nova instanca Image klase za upload slika
	
	return new Image($_FILES);
});

//Ukljucivanje TCPDF klase u Slim2 container

$app->container->set('pdf', function() {
	//Vraca novu instancu TCPDF klase.Arg. konstruktora su iz dokumentacije

	return new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
});

//Ukljucivanje XLSXWriter klase u Slim2 container

$app->container->set('xlsx', function () {
	//Vraca novu instancu XLSXWriter klase

	return new XLSXWriter;
});

//Ukljucivanje Article klase u Slim container

$app->container->set('article', function () use ($app) {

	//Vracamo novu instancu Article klase

	return new Article;
});

//Ukljucivanje Album klase u Slim container

$app->container->set('album', function () use ($app) {

	//Vracamo novu instancu Album klase

	return new Album;
});

//Ukljucivanje Photo klase u Slim container

$app->container->set('photo', function () use ($app) {

	//Vracamo novu instancu Photo klase

	return new Photo;
});

$app->container->set('fupload', function () use ($app) {

	//Vracamo novu instancu fUpload klase

	return new fUpload;
});

//Konfigurisanje views omogucuje ukljucivanje debugginga i parser_extensiona

$view = $app->view();

$view->parserOptions = ['debug' => $app->config->get('twig.debug')]; //Dohvatanje twgig opcije iz config fajla

//Konfigurisanje i dodavanje Parser Extensiona,a arg. mu je TwigExtension koji nam omogucava da generisemo URL u views-u

$view->parserExtensions = [new TwigExtension];

?>