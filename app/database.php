<?php

//Ukljucivanje Manager k. iz illuminate/database paketa za rad sa bazom koji preimenujemo u Cpausle

use Illuminate\Database\Capsule\Manager as Capsule;

//Nova instanca Capsule klase
$capsule = new Capsule;

//Dodavanje konkcije na bazu p. iz production.php ili development.php fajla,uz pomoc Capsule metoda addConnection() sa nizom arg. 

$capsule->addConnections([
	'driver' => $app->config->get('db.driver'),
	'host' => $app->config->get('db.host'),
	'name' => $app->config->get('db.name'),
	'username' => $app->config->get('db.username'),
	'password' => $app->config->get('db.password'),
	'charset' => $app->config->get('db.charset'),
	'collation' => $app->config->get('db.collation'),
	'prefix' => $app->config->get('db.prefix')
]);

//Pokretanje Eloquenta da ga mozemo koristiti sa nasim models tj. modelom.
//bootEloquent() je metod iz Capsule klase za pokretanje Eloqunta za rad sa bazom p.

$capsule->bootEloquent();

?>