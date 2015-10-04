<?php

//Ucitavanje slika u albume i galeriju

//Get putanja

$app->get('/upload_photos',$authenticated(), function () use ($app) {

	//Dohvatanje svih korisnikovih albuma  koje je kreirao i slanje na views da se iskoristi za dropdovn listu
	$albums = $app->album->getUserAlbums($app->auth->id);

	//Dohvatanje st. iz viewsa
	return $app->render('upload/upload_photos.php', [
		'albums' => $albums
	]);

})->name('upload.photos');

//Post putanja za obradu podataka iz forme

$app->post('/upload_photos', $authenticated(), function () use ($app) {

	//Request objekat
	$request = $app->request;

	//Kupljenje podataka iz forme
	(int) $albums = $request->post('albums');
	$photos = $_FILES['photos']['name'];

	//Dohvatanje validacijske klase
	$v = $app->validation;

	//Provjera da li je validacija prosla uspijesno

	if ($v->validate([
		'albums' => [$albums, 'required'],
		'photos' => [$photos, 'required']
	]));


	var_dump($albums);
	var_dump($photos);
	
	//Dohvatanje st. iz viewsa
	return $app->render('upload/upload_photos.php', [
		'errors' => $v->errors()
	]);

})->name('upload.photos.post');

?>