<?php

//Get URL putanja

$app->get('/upload', function() use ($app) {
	$app->render('/upload/upload_img.php');
})->name('upload');


//Post putanja za obradu podataka iz forme

$app->post('/upload', function() use ($app) {

	$app->render('/upload/upload_img.php');

})->name('upload.post');

?>