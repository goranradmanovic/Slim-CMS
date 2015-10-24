<?php

//Get putanja

$app->get('/delete_photo', $authenticated(), function () use ($app) {

	//Request objekat za kupljenje podataka iz GET-a
	$request = $app->request;

	//Dohvatanje Photo objekta
	$photo = $app->photo;

	//Dohvatanje ID od slike iz URL-a
	(int) $photoId = $request->get('id');

	//Provjera da li je ID od slike setovan tj. namjesten i da li postoji
	if (!isset($photoId))
	{	
		//Redirekcija korisnika na st. sa svim slikama
		return $app->redirect($app->urlFor('photos.all_photos'));
	}

	//Dohvatanje putanje do slike koju brisemo
	$photoPath = $app->photo->getPhotoPath($photoId);

	//Dohvatanje stare korisnikove slike i njeno brisanje it uploads/profile_img foldera
	//Sistemska putanje do profilene slike korisnika
	//(C:/xampp/htdocs/Vijezbe/Church/app/uploads/profile_img/155e339180caf9_gokqijelpmfhn.jpeg)
	//Zato sto file_exists() f. uzima sistemsku putanju,a ne url putanju do file da bi se izvrsila

	$AbsPhotoPath = str_replace($app->config->get('app.url'), $_SERVER['DOCUMENT_ROOT'], $photoPath->path);

	//Provjera da li odredjena slika postoji u uploads/gallery/Album folderu
	file_exists($AbsPhotoPath) ? unlink($AbsPhotoPath) : null;

	//Brisanje slike iz baze p.
	$photo->deletePhoto($photoId);

	//Obavjetenje korisnika o brisanje slike i redirekcija na st. sa svim slikama
	$app->flash('global', 'You are successfully deleted photo.');
	$app->redirect($app->urlFor('photos.all_photos'));

})->name('delete_photo');

?>