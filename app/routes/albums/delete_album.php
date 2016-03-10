<?php

//Get putanja do fajla

$app->get('/delete_album/:id', $authenticated(), function($id) use($app) {

	$app->response()->header('Content-Type', 'application/json'); //Namjestanje headera

	//Dohvatanje imena albuma
	$albumTitle = $app->album->getAlbumTitle($id);

	//Putanja do foldera koji brisemo
	$dirPath = INC_ROOT . "/app/uploads/gallery/{$albumTitle->title}";

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
	(bool) $result = $app->album->DeleteAlbum($id, $app->auth->id);

	//Odgovor server o uspijesnom ili ne uspijesnom brisanju fajlova i foldera
	if ($result)
	{
		echo json_encode(array(
			"status" => true,
			"message" => "Album deleted successfully."
		));
	}
	else
	{
		echo json_encode(array(
			"status" => false,
			"message" => "Album id {$id} does not exist."
		));
	}

})->name('albums.delete_album');

?>