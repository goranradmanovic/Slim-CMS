<?php

//Get putanja

$app->get('/delete_photo/:id', $authenticated(), function($id) use ($app) {

	//Dohvatanje Photo objekta
	$photo = $app->photo;

	//Dohvatanje putanje do slike koju brisemo
	echo $photoPath = $app->photo->getPhotoPath($id);

	//Dohvatanje stare korisnikove slike i njeno brisanje it uploads/profile_img foldera
	//Sistemska putanje do profilene slike korisnika
	//(C:/xampp/htdocs/Vijezbe/Church/app/uploads/profile_img/155e339180caf9_gokqijelpmfhn.jpeg)
	//Zato sto file_exists() f. uzima sistemsku putanju,a ne url putanju do file da bi se izvrsila

	$AbsPhotoPath = str_replace($app->config->get('app.url'), $_SERVER['DOCUMENT_ROOT'], $photoPath->path);

	//Provjera da li odredjena slika postoji u uploads/gallery/Album folderu
	file_exists($AbsPhotoPath) ? unlink($AbsPhotoPath) : null;

	//Brisanje slike iz baze p.
	$photo->deletePhoto($id);

	//Obavjetenje korisnika o brisanje slike i redirekcija na st. sa svim slikama
	$app->flash('global', 'You are successfully deleted photo.');
	$app->redirect($app->urlFor('photos.all_photos'));

})->name('delete_photo');

?>