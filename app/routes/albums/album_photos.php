<?php

//Get putanja do fajla

$app->get('/album_photos', function () use ($app) {

	//Provjera da li u GET-u postoji ID od albuma

	if (!isset($_GET['id']))
	{
		return $app->redirect($app->urlFor('albums.all_albums'));
	}

	(int) $albumId = $_GET['id'];

	$album = $app->album;

	$albumPhotos = $album->DisplayAlbumPhotos($albumId);

	return $app->render('/albums/album_photos.php', [
		'albumPhotos' => $albumPhotos
	]);

})->name('albums.album_photos');

?>