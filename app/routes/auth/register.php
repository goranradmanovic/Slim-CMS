<?php

//Stvaranje putanje do register.php iz views/auth foldera

$app->get('/register', function() use($app) {
	$app->render('/auth/register.php');
})->name('register');

//Post putanja za obradu podataka

$app->post('/register', function() use($app) {

	//Dohvatanje Slimovog request objekta u kome se nalaze svi podatci poslati iz forme
	$request = $app->request;

	//Podatci iz polja register forme
	$email = $request->post('email');
	$username = $request->post('username');
	$password = $request->post('password');
	$passwordConfirm = $request->post('password_confirm');

	//validaciju izvrsavamo prije registracije korisnika i smijestanja u bazu p.

	$v = $app->validation; // 'validation' je ime Validator klase koje smo uljucili u slim conatiner

	//Metod iz Violin k. koji provjerava polja iz forme

	$v->validate([
		'email' => [$email, 'required|email|uniqueEmail'],
		'username' => [$username, 'required|alnumDash|max(20)|uniqueUsername'],
		'password' => [$password, 'required|min(6)'],
		'password_confirm' => [$passwordConfirm, 'required|matches(password)']
	]);

	//Provjera da li je validacija prosla uspiejsno sa passes() m.

	if ($v->passes())
	{
		//Ako je validacija prosla uspijesno,onda registujemo korisnika tj. upisemo ga u bazu p. uzpomoc Eloquent create() m

		//Kad registrujemo krisnika onda trebamo da kreiramo identifajer koji je nasumican string iz randomlib,i onda to hasujemo
		//i sacuvamo u bazi p.,a koji je zapravo identifajer koji saljemo korisniku u email u obliku linka.Kad korisnik klikne na
		//link i propusti identifier,onda cemo hasirati tj. identifier i usporediti ga sa active_hasom iz baze,i ako se slaze
		//aktiviracemo korisnicki nalog. Prvo generisemo identifier tj. nasumicni string karaktera uz pomoc generateString() iz randomlib
		//Generisanje nasumicnog stringa od 128 karaktera,a onda ga hasiramo u create() m. i upisujemo u bazu p.

		$identifier = $app->randomlib->generateString(128);

		//Upisivanje korisnika u bazu p.

		$user = $app->user->create([
			'username' => $username,
			'password' => $app->hash->password($password),
			'email' => $email,
			'active' => false,
			'active_hash' => $app->hash->hash($identifier)
		]);

		//Prikazivanje poruke i notifikacije korisniku uz pomoc flash() m.,a poruku smo nazvali global
		$app->flash('global', 'You have been registered.');

		//Redirekcija korisnika na home page uzpomoc urlFor() dohvatamo putanju do home.php,a uz pomoc
		//Slim metoda redirect saljemo korisnika na home page i prikazujemo mu poruku sa flash() met.

		return $app->response->redirect($app->urlFor('home'));
	}


	//Ako su se desila greska na formi za unos podataka,prikazacemo te greska na views/auth/register.php stranici i 
	//zadrzati ono sto je korisnik vec unio u formu. Propustanje varijabli u Twig Slim views se vrsi uz pomoc niza koji je
	//dr. arg. [].Jedan od arg. je request obj. zato da zadrzimo ono sto je korisnik vec unijeo u formu

	$app->render('auth/register.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);

})->name('register.post');

?>