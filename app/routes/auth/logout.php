<?php

//Get URL putanja

$app->get('/logout', function() use ($app) {

	//Unistavanje korisnikove sesije na serveru,da bi se korisnik mogao izlogovati
	unset($_SESSION[$app->config->get('auth.session')]);

	//Ako se korisnik izloguje brisemo remember_identifier i remember_token iz baze p. i brisemo i cookie
	//Prvo provjeravamo da li cookie postoji,jer ako cookie postoji znamo da je korisnik kliknuo na remember me dugme

	if ($app->getCookie($app->config->get('auth.remember')))
	{
		//Ukljanjamo vrijednosti iz baze p. iz polja remember_identifier i remember_token
		$app->auth->removeRememberCredentials();

		//Brisemo cookie sa Slim deleteCooike() m. Arg. mu je ime cookia
		$app->deleteCookie($app->config->get('auth.remember'));
	}

	//Prikazivanje poruke korisniku da se uspijesno izlogovao i redirekcija korisnika na home page
	$app->flash('global', 'You have been logged out.');
	return $app->response->redirect($app->urlFor('home'));

})->name('logout');

?>