<?php

//Get putanja do ove stranice
$app->get('/delete_img', function() use ($app) {

	$app->response()->header('Content-Type', 'application/json'); //Namjestanje headera
	
	//Putanja do korisnickog foldera sa profilnim slikama
	$dirPath = INC_ROOT . '\app\uploads\profile_img\\' . $app->auth->username;

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

	//Brisanje slike iz baze p.
	(bool) $result = $app->user->deleteProfileImg();

	//Odgovor server o uspijesnom ili ne uspijesnom brisanju fajlova i foldera
	if ($result)
	{
		echo json_encode(array(
			"status" => true,
			"message" => "Photo deleted successfully.",
			'user' => $app->auth->username
		));
	}
	else
	{
		echo json_encode(array(
			"status" => false,
			"message" => "Photo does not exist."
		));
	}

	//Prikazivanje potvrdne poruke korisniku i redirekcija na user profile stranicu
	//$app->flash('global', 'Your profile picture is successfuly deleted.');
	//return $app->response->redirect($app->urlFor('user.profile', ["username" => "{$app->auth->username}"]));

})->name('delete_img');

?>