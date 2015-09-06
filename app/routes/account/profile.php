<?php

//Get putanja

$app->get('/account/profile', $authenticated(), function () use ($app) {

	//Prikazivanje profile.php st. iz views/account foldera

	$app->render('/account/profile.php'); 

})->name('account.profile');

//Post putanja

$app->post('/account/profile', $authenticated(), function () use ($app) {

	//Dohvatanje request objekta

	$request = $app->request;

	//Dohvatanje vrijednosti iz forme

	$email = $request->post('email');
	$firstName = $request->post('first_name');
	$lastName = $request->post('last_name');

	//Dohvatanje validacijske klase

	$v = $app->validation;

	//Validacija polja iz forme

	$v->validate([
		'email' => [$email, 'required|email|uniqueEmail'],
		'first_name' => [$firstName, 'alpha|max(50)'],
		'last_name' => [$lastName, 'alpha|max(50)']
	]);

	//Trenutni autentificirani tj. potvrdjene i ulogovani korisnik tj. svi njegovi podatci iz baze

	$user = $app->auth;

	//Ako je validacija prosla uspijesno

	if ($v->passes())
	{
		//Updejetujemo korisnikove podatke u bazi p.

		$user->update([
			'email' => $email,
			'first_name' => $firstName,
			'last_name' => $lastName
		]);

		//Redirekcija korisnika i prikazivanje info poruke

		$app->flash('global', 'Your details have been updated.');
		return $app->redirect($app->urlFor('account.profile'));
	}

	//U suprotnome hvatmo greske nastale prilikom unosta podataka u formu i saljemo ih na views profile.php da ih prikazemo
	//request nam sluzi da bi mogli zadrzati podatke koje je korisnik unijeo u formu i prikazati im ako nesto pogrijese

	$app->render('/account/profile.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);

})->name('account.profile.post');

?>