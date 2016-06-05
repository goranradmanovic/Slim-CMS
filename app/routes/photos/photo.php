<?php

//Get putanja
$app->get('/photo/:id/:gid/:aid', function($id, $gid, $aid) use ($app) {

	//Provjera da li u GET-u postoji ID od albuma, paginacije od galerije i paginacije od trenutnog albuma i njegovih slika
	if (!isset($id, $gid, $aid) && is_numeric($id, $gid, $aid))
	{	
		//Redirekcija korisnika na st. sa svim albumima
		return $app->redirect($app->urlFor('albums.all_albums'));
	}

	//Dohvatanje Photo klase iz Slim cont.
	$photo = $app->photo;

	//Povlacenje spscificne slike iz baze p.
	$OnePhoto = $photo->getPhoto($id);

	//Vracanje view-a korisniku sa odredjenom slikom
	return $app->render('/photos/photo.php', [
		'photo' => $OnePhoto,
		'gid' => $gid,
		'aid' => $aid,
	]);

})->name('photos.photo');

?>