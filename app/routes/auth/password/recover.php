<?php

//Get putanja

$app->get('/recover-password', $guest(), function() use ($app) {

	//Dohvatanje stranice koju prikazujemo korisniku
	$app->render('/auth/password/recover.php');

})->name('password.recover');

//Post putanja

$app->post('/recover-password', $guest(), function() use ($app) {

	//Dohvatanje request objekta u kome se nalazi sve podatci iz forme

	$request = $app->request();

	//Dohvatanje vrijednosti iz forme

	$email = $request->post('email');

	//Dohvatanje validacijek klase

	$v = $app->validation;

	//Validacije polja iz forme uz pomoc validate() m.

	$v->validate([
		'email' => [$email, 'required|email']
	]);

	//Ako je validacija prosla uspijesno

	if ($v->passes())
	{
		//Dohvatanje korisnika iz baze na osnovu emaila kojeg je unije u formu

		$user = $app->user->where('email', $email)->first();

		//Provjera da li postoji korisnik u bazi p. sa specificnim prodledjenim emailom

		if (!$user)
		{
			//Ako korisnik ne postoji u bazi p. i ako se ne moze naci na osnovu prosledjenog email-a,prikazujemo korisniku
			//poruku i zadrzavamo ga na recover st.

			$app->flash('global', 'Could not find that user.');
			return $app->response->redirect($app->urlFor('password.recover'));
		}
		else
		{
			//U suprotnome ako korisnik postoji u bazi p. saljemo mu email poruku sa linkom za reset sifre
			//Generisemo nasumicni strng niz koji ce biti nas identifier,hasujemo ga i snimamo u bazi p. u polju recover_hash. Onda saljemo
			//taj identifier u email poruci u obliku linka i kad korisnik klikne na njega poslace ga opet nazad na stranicu gdje cemo ga opet
			//hasovati i provjeriti sa onim u hasom u bazi p. od poljem recover_hash

			$identifier = $app->randomlib->generateString(128);

			//Update-ujemo tenutnog korisnika tj. polje recover_hash u bazi p.

			$user->update([
				'recover_hash' => $app->hash->hash($identifier)
			]);

			//Slanje email poruke

			$app->mail->send('email/auth/password/recover.php', ['user' => $user, 'identifier' => $identifier], function ($message) use ($user) {
				$message->to($user->email);
				$message->subject('Recover your password.');
			});

			//Info poruka za korisnika i redirekcija na home page
			$app->flash('global', 'We emailed you instruction to reset your password.');
			return $app->response->redirect($app->urlFor('home'));
		}
	}

	//Dohvatanje stranice koju prikazujemo korisniku
	$app->render('/auth/password/recover.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);

})->name('password.recover.post');

?>