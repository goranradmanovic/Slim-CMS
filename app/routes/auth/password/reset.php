<?php

//Get putanja

$app->get('/password-reset', $guest(), function () use ($app) {

	//Dohvatamo email i identifier koje smo poslali preko URL i koje se nalaze u request objektu

	$request = $app->request;

	//Dohvatanje vrijednosti iz URL-a

	$email = $request->get('email');
	$identifier = $request->get('identifier');

	//Hasujemo identifier

	$hashedIdentifier = $app->hash->hash($identifier);

	//Dohvatamo korisnika iz baze p. uz pomoc email iz URL-a

	$user = $app->user->where('email', $email)->first();

	//Ako korisnik ne postoji u bazi redirektujemo ga

	if (!$user)
	{
		return $app->response->redirect($app->urlFor('home'));
	}

	//Ako recover hash ne postoji na korisnikovom racunu tj. u bazi p. onda redirektujemo korisnika na home p.

	if (!$user->recover_hash)
	{
		return $app->response->redirect($app->urlFor('home'));
	}

	//Provjera da li hasirani identifier iz URL-a je jednak hashu iz recover_hash polja iz baze p.

	if (!$app->hash->hashCheck($user->recover_hash, $hashedIdentifier))
	{
		return $app->response->redirect($app->urlFor('home'));
	}

	//Saljemo na views reset.php fajl sa formom za unost nove sifre , email korisnika i hash,zato sto ih moramo zadrzati u URL-u
	$app->render('/auth/password/reset.php', [
		'email' => $email,
		'identifier' => $identifier
	]);

})->name('password.reset');

//Post putanja

$app->post('/password-reset', $guest(), function () use ($app) {

	//Dohvatamo email i identifier koje smo poslali preko URL i koje se nalaze u request objektu

	$request = $app->request;

	//Dohvatanje vrijednosti iz URL-a

	$email = $request->get('email');
	$identifier = $request->get('identifier');

	//Dohvatanje vrijednosti iz forme

	$password = $request->post('password');
	$passwordConfirm = $request->post('password_confirm');

	//Hasiramo identifier

	$hashedIdentifier = $app->hash->hash($identifier);

	//Dohvatamo korisnika iz baze p. uz pomoc emaila

	$user = $app->user->where('email', $email)->first();

	//Ako korisnik ne postoji u bazi redirektujemo ga na home page

	if (!$user)
	{
		return $app->response->redirect($app->urlFor('home'));
	}

	//Ako recover hash ne postoji na korisnikovom racunu tj. u bazi p. onda redirektujemo korisnika na home p.

	if (!$user->recover_hash)
	{
		return $app->response->redirect($app->urlFor('home'));
	}

	//Provjera da li hasirani identifier iz URL-a je jednak hashu iz recover_hash polja iz baze p.

	if (!$app->hash->hashCheck($user->recover_hash, $hashedIdentifier))
	{
		return $app->response->redirect($app->urlFor('home'));
	}


	//****Reset korisnikove sifre***//

	//Dohvatanje validacijske klase

	$v = $app->validation;

	$v->validate([
		'password' => [$password, 'required|min(6)'],
		'password_confirm' => [$passwordConfirm, 'required|matches(password)'],
	]);

	//Ako validacija novih sifri prodje,mozemo setovati tj. namjestiti novu sifu u bazu p. i ukloniti recover_hash iz polja u bazi p.

	if ($v->passes())
	{
		//Updatujemo korisnicki red u bazi p. sa novom sifrom tj. hasom od nove sifre 

		$user->update([
			'password' => $app->hash->password($password),
			'recover_hash' => null
		]);

		//Prikazivanje poruke korisniku da je uspijesno promjenio sifu i da se moze ulogovati i redirekcija na home page

		$app->flash('global', 'Your password has been reset and you can now sign in.');
		return $app->response->redirect($app->urlFor('home'));
	}


	//Dohvatanje i prikazivanje reset st.
	$app->render('/auth/password/reset.php');

})->name('password.reset.post');

?>