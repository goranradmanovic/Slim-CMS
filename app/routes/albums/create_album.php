<?php

//Get putanja

$app->get('/create_album', $authenticated(), function () use ($app) {

	//Dohvatanje create:album st. iz views/photos

	return $app->render('/albums/create_album.php');

})->name('albums.create_album');

//Post putanja za obradu podataka iz forme

$app->post('/create_album', $authenticated(), function () use ($app) {

	//Dohvatanje request objekta
	$request = $app->request;

	//Dohvatanje polja iz forme
	$title = $request->post('title');

	//Dohvatanje validacione klase
	$v = $app->validation;

	//Validacija polja iz forme
	$v->validate([
		'title' => [$title, 'required|min(5)|max(255)|uniqueAlbumName']
	]);

	//Ako je validacija prosla uspijesno
	if ($v->passes())
	{	
		//Kreiramo folder za slike koji ce se zvati kao ime albuma
		mkdir(INC_ROOT . '/app/uploads/gallery/' . $title);

		//Upisujemo podatke u bazu p.
		$app->album->create([
			'user_id' => $app->auth->id,
			'title' => $title
		]);

		//Redirekcija korisnika i prikazivanje info poruke
		$app->flash('global', 'You have create new album');
		$app->redirect($app->urlFor('photos.photos'));
	}

	//Dohvatanje st. iz views/post i slanje gresaka na nju ako su se dogodile
	return $app->render('/albums/create_album.php', [
		'errors' => $v->errors()
	]);

})->name('albums.create_album.post');

?>