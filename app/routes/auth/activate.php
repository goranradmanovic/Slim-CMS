<?php

//Get putanja

$app->get('/activate', $guest(), function() use ($app) {

	//Povlacenje podataka iz URL i GET metode uz pomoc Slim $app->request objekta

	$request = $app->request;

	//Podatci iz email URL-a
	$email = $request->get('email');
	$identifier = $request->get('identifier');

	//hasiramo identifier i provjeravamo sa hasom iz baze pod poljem activate_hash

	$hashedIdentifier = $app->hash->hash($identifier);

	//Povlacenje korisnickog naloga iz baze p. i provjera jeli nalog vec aktiviran,ako jeste ne trebamo ga opet aktivirati

	$user = $app->user->where('email', $email)->where('active', false)->first();

	//Provjera da li korisnika ne mozemo naci ili da li hash 'active_hash' ne slaze sa hasiranim identifierom koji smo poslai
	//u emailu

	if (!$user || !$app->hahsCheck($user->active_hash, $hashedIdentifier))
	{
		//Poruka upozorenja za korisnika
		$app->flash('global', 'There was problem activating your account');

		//Redirekcija korisnika na home page
		return $app->response->redirect($app->urlFor('home'));
	}
	else
	{
		//U suprotnome aktiviramo korisnikov racun uz pomoc activateAccount() metoda iz User klase,prikazemo mu potvrdnu poruku
		//i redirektujemo ga na home.php

		$user->activateAccount();

		//Potvrdna poruka za korisnika
		$app->flash('global', 'Your account has been activated and you can sing in.');

		//Redirekcija korisnika na home page
		return $app->response->redirect($app->urlFor('home'));
	}

})->name('activate');

?>