<?php

//Autentifikacijka prvojera, var $require oznacava da li korisnik treba da bude autentificira tj. potvrdjen ili ne,ovo ce biti true ili false

$authenticationCheck = function($required) use ($app)
{
	return function() use ($required, $app)
	{
		//Provjera da li je korisnik ulogovan i da li treba da bude redirektovan ili ne
		//Provjera da li korisnik nije authentificira tj. potvrdjen i ako je ovaj $required true onda ga trebamo redirektovati
		//ili ako su redirektovani i $require je false trebamo ga opet redirektovati

		if ((!$app->auth && $required) || ($app->auth && !$required))
		{
			//Redirekcija na home page
			return $app->redirect($app->urlFor('home'));
		}
	};
};

//Autentificirani midleware tj. filter $authenticationCheck(true) mora biti istinit

$authenticated = function() use ($authenticationCheck)
{
	return $authenticationCheck(true);
};

//Guest midleware tj. filter $authenticationCheck(false)

$guest = function() use ($authenticationCheck)
{
	return $authenticationCheck(false);
};

//Provjera da li je korisnik admin

$admin = function() use ($app)
{
	return function() use ($app)
	{
		//Provjera ako korisnik nije ulogovan i nije admin

		if (!$app->auth && !$app->auth->isAdmin())
		{
			//Redirekcija na home page
			return $app->redirect($app->urlFor('home'));
		}
	};
};

?>