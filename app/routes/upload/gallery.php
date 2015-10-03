<?php

//Get putanja do stranice iz views

$app->get('/upload/gallery', function () use ($app) {

	return $app->render('/upload/gallery.php');

})->name('upload.gallery');







?>