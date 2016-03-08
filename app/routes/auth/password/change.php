<?php

//$authenticated() je filter koji oznacava da korisnik mora biti potvrdjen da bi mogao promjeniti svoju sifu

$app->get('/change-password', $authenticated(), function() use ($app) {

	$app->render('auth/password/change.php');

})->name('password.change');

//Post routes

$app->post('/change-password', $authenticated(), function() use ($app) {
	
	//Dohvatanje request objekta sa podatcima koji su poslati iz forme

	$request = $app->request;

	//Dohvatanje podataka iz forme i smijestanje u var.

	$passwordOld = $app->request->post('password_old');
	$password = $app->request->post('password');
	$passwordConfirm = $app->request->post('password_confirm');

	$v = $app->validation; //Pristup validacijskoj klasi

	//Validacija podataka iz forme

	$v->validate([
		'password_old' => [$passwordOld, 'required|matchesCurrentPassword'],
		'password' => [$password, 'required|min(6)'],
		'password_confirm' =>[$passwordConfirm, 'required|matches(password)']
	]);

	//Ako ova validacija prodje,onda trebamo update korisnicku sifru tako sto cemo je hasovati novu sifru koju su obezbjedili,onda trebamo sacuvati
	//tu sifru u bazi p. i poslati im email da im je sifra promjenjena,trebamo im prikazati globalnu poruku da su promjenili sifru i redirektovati
	//ih na home page. U suprotnom zelimo im pokazati formu sa greskama ako nesto nisu dobro unijeli

	//Ako je validacija prosla uspijesno update-ujemo korisnicku sifru

	if ($v->passes())
	{
		//Cuvanje svih korisnikovih podataka u varijabli

		$user = $app->auth;

		//Hasujemo korisnikovu sifru i updatujemo polje u bazi p.

		$user->update(['password' => $app->hash->password($password)]);

		//Slanje email poruke korisniku da je promjenio sifru

		$app->mail->send('email/auth/password/changed.php', [], function ($message) use ($user) {
			$message->to($user->email);
			$message->subject('You changed your password.');
		});

		//Prikazivanje flash poruke korisniku i redirekcija na home page

		$app->flash('global', 'You change your password.');
		return $app->response->redirect($app->urlFor('home'));
	}

	//A ako validacije ne prodje,onda prikazujemo korisniku greske koje su napravili u formi

	$app->render('auth/password/change.php', ['errors' => $v->errors()]);

})->name('password.change.post');

?>