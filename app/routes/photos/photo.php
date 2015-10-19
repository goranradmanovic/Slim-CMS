<?php

//Get putanja

$app->get('/photo', function () use ($app) {

	//Dohvatanje Photo klase iz Slim cont.
	$photo = $app->photo;

	//Provjera da li je id poslat krou URL i da li je id prazan
	if (!isset($_GET['id']) || empty($_GET['id']))
	{	
		//Redirekcija u slucaju da id od slike ne postoji
		return $app->redirect($app->urlFor('photos.all_photos'));
	}

	//Dohvatanje id od sliek
	(int) $photoId = $_GET['id'];

	//Povlacenje spscificne slike iz baze p.
	$OnePhoto = $photo->getPhoto($photoId);

	//Vracanje view-a korisniku sa odredjenom slikom
	return $app->render('/photos/photo.php', [
		'photo' => $OnePhoto
	]);

})->name('photos.photo');

?>