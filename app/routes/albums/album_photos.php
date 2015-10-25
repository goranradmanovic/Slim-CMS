<?php

//Get putanja do fajla
$app->get('/album_photos', function () use ($app) {

	//Request objekat
	$request = $app->request;

	//Album objekta
	$album = $app->album;

	//Dohvatanje ID od albuma iz URL-a
	(int) $albumId = $request->get('id');

	//Provjera da li u GET-u postoji ID od albuma
	if (!isset($albumId))
	{	
		//Redirekcija korisnika na st. sa svim albumima
		return $app->redirect($app->urlFor('albums.all_albums'));
	}

	//Metod za prikazivanje svih slika iz odredjenog albuma
	$albumPhotos = $album->DisplayAlbumPhotos($albumId);

	//Slanje podataka na view od svih slika iz albuma
	return $app->render('/albums/album_photos.php', [
		'albumPhotos' => $albumPhotos,
	]);

})->name('albums.album_photos');

?>