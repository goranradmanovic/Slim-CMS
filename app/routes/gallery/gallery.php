<?php

//Get putanja

$app->get('/gallery', function () use ($app) {

	//Dohvatanje svih albuma iz baze p.
	$albums = $app->album->getAlbums();

	//Slanje svih albuma na gallery.php i rendovanje st.
	return $app->render('/gallery/gallery.php', ['albums' => $albums]);

})->name('gallery');

?>