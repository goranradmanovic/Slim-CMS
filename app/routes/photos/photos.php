<?php

//Get putanja

$app->get('/photos', $authenticated(), function () use ($app) {

	//Dohvatanje photos st. iz views/photos foldera
	return $app->render('/photos/photos.php', ['gid' => 1, 'aid' => 1]);

})->name('photos.photos');

?>