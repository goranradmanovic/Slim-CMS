<?php

//Slim metod notFound() se koristi za stvaranje vlasith poruka o nastaloj 404 greski

$app->notFound(function () use ($app) {

	//Ako se stranica ne moze naci prikazujemo tj. rendujemo view

	$app->render('errors/404.php');
});

?>