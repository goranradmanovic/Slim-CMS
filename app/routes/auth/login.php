<?php

use Carbon\Carbon; //Ukljucivanje Carbon paketa

//URL get() m. putanja

$app->get('/login', function() use($app) {
	$app->render('/auth/login.php');
})->name('login');


//Post putanja za obradu podataka iz forme

$app->post('/login', function() use($app) {

	$request = $app->request; //Request Slim objekat sa svim podatcima iz forme

	//Polja iz forem sa podatcima
	$identifier = $request->post('identifier');
	$password = $request->post('password');
	$remember = $request->post('remember'); //checkbox remmeber

	//Validacijska klasa sa Voilin k. moguncostima
	$v = $app->validation;

	$v->validate([
		'identifier' => [$identifier, 'required'],
		'password' => [$password, 'required']
	]);

	//Ako je validacija prosla uspijesno
	if ($v->passes())
	{
		//Provjeravamo korisnicke podatek iz forme sa onima iz baze p.

		$user = $app->user->where('active', true)->where(function($query) use($identifier) {
			return $query->where('email', $identifier)->orWhere('username', $identifier);
		})->first();

		//Provjeravamo da li su korisnicki podatci pronadjeni u bazi p. i da li se sifre slazu iz forme i baze p.
		//Sa metodom passwordCheck() iz Helpers k. provjeramo da li se dva hash sifi slazu

		if ($user && $app->hash->passwordCheck($password, $user->password))
		{
			//Ako korisnik postoji u bazi i aktiviran je,i ako se hahs-ovi sifri slazu,onda namjestamo sessiju koja ima vrijednost korisnickog ID
			$_SESSION[$app->config->get('auth.session')] = $user->id;

			//Provjera da li je otkaceno Remember Me polje tako sto ga uporedjujemo sa rijeci 'on' koja oznacava da je dugme otkaceno

			if ($remember === 'on')
			{
				//Ako je korisnik kliknuo na remeber dugme onda stvaramo dva nasumicno generisana string niza,od kojih ce jedan biti remeber identifier
				//koji cuvamo u bazi,a dr. remember token koji cuvamo u bazi i koji hasujemo prije cuvanja u bazi p.

				$rememberIdentifier = $app->randomlib->generateString(128);
				$remeberToken = $app->randomlib->generateString(128);

				//Upisujemo remember_identifier i remember_token u polja iz baze p. od korisnika sa updateRememberCredentials() m. iz User k.

				$user->updateRememberCredentials($rememberIdentifier, $app->hash->hash($remeberToken));

				//Setiranje Cookie-a uz pomoc Slim metoda setCookie() u koje kao ar. propustamo ime cookiea,vrijednost i duzinu trajanja
				//isto kao i u obicni cookie kad pravimo,dodatni sigurnosni atributi su '/', path, null - domain, null - HTTPS i true - httponly

				$app->setCookie($app->config->get('auth.remember'), "{$rememberIdentifier}___{$remeberToken}", Carbon::parse('+1 week')->timestamp, '/', null, null, true);
			}

			//Prikaivanje potvrden poruke korisniku o uspijesnom logovanju
			$app->flash('global', 'You are now sing in.');

			//Redirekcija korisnika na home.php
			return $app->response->redirect($app->urlFor('home'));
		}
		else
		{
			//Ako prijavljivanje korisnika nije bilo uspijesno prikazujemo mu poruku uopzorenja i saljemo ga opet na login page da pokusa ponovo

			$app->flash('global', 'Could not log you in.');
			$app->response->redirect($app->urlFor('login'));
		}
	}

	//Dohvaranje gresaka i onog sto je korisnik unijeo u formu za login

	$app->render('/auth/login.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);

})->name('login.post');

?>