<?php

//Get putanja

$app->get('/gallery', function () use ($app) {

	return $app->render('/gallery/gallery.php');

})->name('gallery');


?>