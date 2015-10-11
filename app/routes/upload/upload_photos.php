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
	$albumId = $request->post('albums');
	$photos = $_FILES['photos']['name'];
	$size = $_FILES['photos']['size'];
	$type = $_FILES['photos']['type'];
	$tmp = $_FILES['photos']['tmp_name'];
	
	//Dohvatanje imena albuma,radi ucitavanje slika u njega
	$albumName = $app->album->where('id', $albumId)->select('title')->first();

	//Dohvatanje validacijske klase
	$v = $app->validation;

	//Provjera da li je validacija prosla uspijesno

	if ($v->validate([
		'albums' => [$albumId, 'required'],
		'photos' => [$_FILES['photos']['name'], 'required']
	]));

	//Ako je validacija prosla uspijesno

	if ($v->passes())
	{
		

		$images = $app->image; //Dohvatanje image klase za rad sa slikama

		$allowedMIME = ['jpg','jpeg','png']; //Dozvoljeni niz ekstenzija

		//Namjestanje dozvoljenog niza estenzija,dozvoljene velicine fajla,dozvoljene dizmenzije slike,i smijestanje u profile_img folder.

		//$images->setMime($allowedMIME)->setSize(1000, 5242880)->setDimension(1250, 1250)->setLocation(INC_ROOT . "\app\uploads\gallery\\$albumName->title");
	
		//Provjera da li uplodovana slika postoji

		if (is_object($images))
		{
			echo '<pre>' , var_dump($images) , '</pre>';
			
			foreach ($images as $image)
			{
				
				echo '<pre>' , var_dump($image) , '</pre>';

			}
		}
					
				
	}
	
	//Dohvatanje st. iz viewsa
	return $app->render('upload/upload_photos.php', [
		'errors' => $v->errors()
	]);

})->name('upload.photos.post');

?>