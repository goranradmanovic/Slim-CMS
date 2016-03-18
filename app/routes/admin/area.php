<?php

//get putanja, admin() je filter tj. midelware koji provjerava svaki put kad se posalje zahtijev za aplikaciju da li je korisnik admin

$app->get('/admin/area', $admin(), function () use ($app) {

	//Provjera ovlastenje korisnika - Ovo je samo primjer !! Ovo mjenjam
	/*
		if ($app->auth->hasPermission('can_post_topic'))
		{
			//echo 'User can post topic.';
		}
	*/

	//Povlacenje svih korisnika iz baze podataka koji su aktivni
	$users = $app->user->select('id')->where('active', true)->get();

	//Prikazivanje example.php stranice iz views/admin foldera
	$app->render('admin/area.php', [
		'users' => $users,
	]);

})->name('admin.area');

?>