<?php

//Get putanja i obrada podataka u get() m.

$app->get('/articles/delete', $authenticated(), function () use ($app) {

	//Dohvatanje svih clanaka koje je objavio trenutni autentificirani korisnik
	$articles = $app->article->where('user_id', '=', $app->auth->id)->get();

	//Dohvatanje request objekta
	$request = $app->request;

	//Dohvatanje id od clanka
	(int) $id = $request->get('id');

	//Ako je id setovan tj. postoji u URL-u i dohvacen je iz URL-a
	if (isset($id))
	{
		//Brisemo clanak iz baze p. sa specoficnim id-em 
		$app->article->destroy($id);

		//Redirekcija korisnika na delete st. i prikzivanje poruke korisniku
		$app->flash('global', 'You are successfuly deleted article.');
		return $app->redirect($app->urlFor('articles.delete'));
	}

	//Dohvatanje views-a i slanje na njega sve clanke od korisnika
	return $app->render('/articles/delete_article.php', [
		'articles' => $articles
	]);

})->name('articles.delete');

?>