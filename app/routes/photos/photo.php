<?php

//Get putanja
$app->get('/photo/:id', function($id) use ($app) {

	//Dohvatanje Photo klase iz Slim cont.
	$photo = $app->photo;

	//Povlacenje spscificne slike iz baze p.
	$OnePhoto = $photo->getPhoto($id);

	//Vracanje view-a korisniku sa odredjenom slikom
	return $app->render('/photos/photo.php', [
		'photo' => $OnePhoto
	]);

})->name('photos.photo');

?>