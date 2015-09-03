<?php

//Get putanja do all.php stranice iz views/user foldera

$app->get('/users', function() use ($app) {

	//Povlacenje svih korisnika iz baze podataka koji su aktivni

	$users = $app->user->where('active', true)->get();

	$app->render('user/all.php', [
		'users' => $users
	]);

})->name('user.all');

?>