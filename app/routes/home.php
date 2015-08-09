<?php

//Stvaranje putanje do views home.php stanice

$app->get('/', function() use ($app) {

	$app->render('home.php');

})->name('home');

?>