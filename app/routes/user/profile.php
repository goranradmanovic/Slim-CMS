<?php

//Get URL putanja. :username je vriejdnost koju saljemo preko URL-a,a u callbasc funk. hvatamo tu vrijednost

$app->get('/u/:username', $authenticated(), function($username) use ($app) {

	//Dohvatanje svih korisnikovih podataka iz baze p.
	$user = $app->user->where('username', $username)->first();

	//Provjera da li korisnikovi podatci postoje u bazi p.

	if (!$user)
	{
		$app->notFound(); //404 error
	}

	//Rendujemo prikaz view i propustamo user object u taj view tako da mozemo prikazati sve o korisniku i korisiti User model
	//klasu sa svim metodama
	
	$app->render('/user/profile.php', ['user' => $user]);

})->name('user.profile');

?>