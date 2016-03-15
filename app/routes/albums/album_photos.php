<?php

//Get putanja do fajla
$app->get('/album_photos/:id/:gid/:aid', function ($id, $gid, $aid) use ($app) {

	//$id - Album ID, $gid - Gallery br. st., $aid - Album br. st. paginacije)
	//$aid kad dolazimo sa gallery st. zelimo da sletimo na prvu st. paginacije od slika iz odredjenog albuma
	//Provjera da li u GET-u postoji ID od albuma, paginacije od galerije i paginacije od trenutnog albuma i njegovih slika
	if (!isset($id, $gid, $aid) && is_numeric($id, $gid, $aid))
	{	
		//Redirekcija korisnika na st. sa svim albumima
		return $app->redirect($app->urlFor('albums.all_albums'));
	}

	//Paginacija
	$page = $aid; //Dohvatamo redni broj stranice galrije preko URL-a i smijestamo ga u $page var. 'gid' je redni br. st. galerije
	//Provjera da je redni br. st. namjesten i da li je broj,a ako nije majestamo ga na defultni br. st. a to je 1
	$page = (isset($page) && is_numeric($page) ) ? $page : 1;

	$per_page = 12; //Broj prikazivanja rezultata po strnici

	//Brojanje redova u Article tabeli,a bi taj broj mogli podijeliti sa br. rezultatat po st. i izracunati koliki nam je ukupni br. st. (potrebno za prikazivanje brojeva paginacije)
	$count = $app->photo->count();

	//Racunanje ukupnog broja st. na osnovu redova iz baze i br. rezultata po st.
	$pages = ceil($count / $per_page);

	//Ako je br.st.veci od 1 onda mnozimo br. st. sa br. rezultata po st. i od tog broja oduzimamo br. rezultata po st. u  suprotnome je start var. 0 tj. vracanje redova iz baze krece od 0 pa do 12
	$start = ($page > 1) ? ($page * $per_page) - $per_page : 0;

	//Dohvatanje svih slika iz albuma iz baze podataka koji su u rasponu od br. start do br. rezultata po st. tj. dohvatamo po 12 rezultata po st.
	$albumPhotos = $app->photo->getAlbumPhotos($id, $start, $per_page);

	//Slanje podataka na view od svih slika iz albuma
	return $app->render('/albums/album_photos.php', [
		'albumPhotos' => $albumPhotos,
		'page' => $page,
		'pages' => $pages,
		'gid' => $gid
	]);

})->name('albums.album_photos');

?>