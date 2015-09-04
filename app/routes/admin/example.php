<?php

//get putanja, admin() je filter tj. midelware koji provjerava svaki put kad se posalje zahtijev za aplikaciju da li je korisnik admin

$app->get('/admin/example', $admin(), function () use ($app) {

	//Provjera ovlastenje korisnika - Ovo je samo primjer !! Ovo mjenjam
	if ($app->auth->hasPermission('can_post_topic'))
	{
		echo 'User can post topic.';
	}

	//Prikazivanje example.php stranice iz views/admin foldera

	$app->redner('admin/example.php');

})->name('admin.example');




?>