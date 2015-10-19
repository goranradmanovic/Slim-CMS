<?php

//Get putanja

$app->get('/all_albums', $authenticated(), function () use ($app) {

	//Dohvatanje svih albuma od specificnog korisnika
	$albums = $app->album->getUserAlbums($app->auth->id);

	//Dohvatanje stranice iz viewsa i slanje podataka
	return $app->render('/albums/all_albums.php', [
		'albums' => $albums,
	]);

})->name('albums.all_albums');

?>