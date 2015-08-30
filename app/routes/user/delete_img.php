<?php

//Get putanja do ove stranice

$app->get('/delete-img', function() use ($app) {

	//Sistemska putanje do profilene slike korisnika
	//(C:/xampp/htdocs/Vijezbe/Church/app/uploads/profile_img/155e339180caf9_gokqijelpmfhn.jpeg)
	//Zato sto file_exists() f. uzima sistemsku putanju,a ne url putanju do file da bi se izvrsila

	$profile_img_path = str_replace($app->config->get('app.url'), $_SERVER['DOCUMENT_ROOT'], $app->auth->img_path);

	//Provjera da li profilna slika postoji u uploads/profile_img

	file_exists($profile_img_path) ? unlink($profile_img_path) : null;

	//Brisanje slike iz baze p.
	$app->user->deleteProfileImg();

	//Prikazivanje potvrdne poruke korisniku i redirekcija na user profile stranicu
	$app->flash('global', 'Your profile picture is successfuly deleted.');
	return $app->response->redirect($app->urlFor('user.profile', ["username" => "{$app->auth->username}"]));

})->name('delete-img');

?>