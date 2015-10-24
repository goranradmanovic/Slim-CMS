<?php

//Get putanja do fajla

$app->get('/delete_album', $authenticated(), function () use ($app) {

	//Request objekat
	$request = $app->request;

	//Dohvatanje vriejdnosti tj. ID od albuma
	(int) $albumId = $request->get('id');

	//Provjera da li je ID od albuma poslat u GET-u,a ako nije redirekcija korisnika nazad
	if (!isset($_GET['id']))
	{
		return $app->redirect($app->urlFor('albums.all_albums'));
	}

	//Dohvatanje imena albuma
	$albumTitle = $app->album->getAlbumTitle($albumId);

	//Putanja do foldera koji brisemo
	$dirPath = INC_ROOT . '\app\uploads\gallery\\' . $albumTitle->title;

	//Rekurzivni Iterator Direktorija i Rekurzivni Iterator Iteratora
	$recDir = new RecursiveDirectoryIterator($dirPath, FilesystemIterator::SKIP_DOTS);

	//Iterator ce proci korz sve fajlove u dir. prvo pa i obrisati ih iz foldera da bi mogli koristiti rmdir()
	$recIter = new RecursiveIteratorIterator($recDir, RecursiveIteratorIterator::CHILD_FIRST);

	//Prolaz kroz direktoriji i izlistavanje svih fajlova u njemu
	foreach ($recIter as $file)
	{
		//Brisemo sve fajlove iz foldera
		$file->isDir() ? rmdir($file) : unlink($file);
	}

	//Brisemo zeljeni folder posto smo ga ispraznili od fajlova
	rmdir($dirPath);

	//Brisanje albuma i slika iz baze p. uz pomoc DeleteAlbum funk. iz Album klase
	$app->album->DeleteAlbum($albumId, $app->auth->id);

	//Prikazivanje potvrdne poruke korisniku i redirekcija na st. sa svim albumima
	$app->flash('global', 'You are successfully deleted album.');
	return $app->redirect($app->urlFor('albums.all_albums'));

})->name('albums.delete_album');

?>