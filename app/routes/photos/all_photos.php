<?php

//Get putanja

$app->get('/all_photos', $authenticated(), function() use ($app) {

	//Dohvatanje Photo klase iz Slim cont.
	$photo = $app->photo;

	//Dohvatanje svih korisnikovih slika
	$photos = $photo->getUserPhotos($app->auth->id);

	return $app->render('/photos/all_photos.php', [
		'photos' => $photos
	]);

})->name('photos.all_photos');

?>