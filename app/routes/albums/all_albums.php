<?php

//Get putanja
$app->get('/all_albums/:id', $authenticated(), function ($id) use ($app) {

	//Paginacija
	$page = $id; //Dohvatamo redni broj stranice preko URL-a i smijestamo ga u $page var
	//Provjera da je redni br. st. namjesten i da li je broj,a ako nije majestamo ga na defultni br. st. a to je 1
	$page = (isset($page) && is_numeric($page) ) ? $page : 1;

	$per_page = 8; //Broj prikazivanja rezultata po strnici

	//Brojanje redova u Article tabeli,a bi taj broj mogli podijeliti sa br. rezultatat po st. i izracunati koliki nam je ukupni br. st. (potrebno za prikazivanje brojeva paginacije)
	$count = $app->album->count();

	//Racunanje ukupnog broja st. na osnovu redova iz baze i br. rezultata po st.
	$pages = ceil($count / $per_page);

	//Ako je br.st.veci od 1 onda mnozimo br. st. sa br. rezultata po st. i od tog broja oduzimamo br. rezultata po st. u  suprotnome je start var. 0 tj. vracanje redova iz baze krece od 0 pa do 8
	$start = ($page > 1) ? ($page * $per_page) - $per_page : 0;

	//Dohvatanje svih korisnikovih albuma iz baze podataka koji su u rasponu od br. start do br. rezultata po st. tj. dohvatamo po 5 rezultata po st.
	$albums = $app->album->getUserAlbumsPagination($app->auth->id, $start, $per_page);

	//Dohvatanje stranice iz viewsa i slanje podataka
	return $app->render('/albums/all_albums.php', [
		'albums' => $albums,
		'page' => $page,
		'pages' => $pages
	]);

})->name('albums.all_albums');

?>