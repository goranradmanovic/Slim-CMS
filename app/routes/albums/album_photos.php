<?php

//Get putanja do fajla
$app->get('/album_photos/:id', function ($id) use ($app) {

	//Album objekta
	$album = $app->album;

	//Provjera da li u GET-u postoji ID od albuma
	if (!isset($id))
	{	
		//Redirekcija korisnika na st. sa svim albumima
		return $app->redirect($app->urlFor('albums.all_albums'));
	}

	//Metod za prikazivanje svih slika iz odredjenog albuma
	$albumPhotos = $album->DisplayAlbumPhotos($id);

	//Slanje podataka na view od svih slika iz albuma
	return $app->render('/albums/album_photos.php', [
		'albumPhotos' => $albumPhotos,
	]);

})->name('albums.album_photos');

?>