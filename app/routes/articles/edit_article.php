<?php

//Get putanja do ovog fajla

$app->get('/articles/edit', $authenticated(), function() use ($app) {
	
	//Dohvatanje naslova clanaka i njihov id od specificnog autora tih clanaka
	$titles = $app->article->where('user_id', '=', $app->auth->id)->select('id','title')->get();

	//Request objekat
	$request = $app->request;

	//Dohvatanje id od clanka iz URL tj. Get var. i kastovanje u int radi sigurnosti
	(int) $id = $request->get('id');

	if (!isset($id))
	{
		//Ako id od clanka ne postoji u get supergolobalnoj var. tj. nije poslat preko URL-a i ne postoji u URL-u
		//onda namjestamo var articles na null tako da nam na views-u views/articles/edit_articles.php ne prikazuje formu za editovanje clanka
		$articles = null;
	}

	//Dohvatanje clanaka iz baze p.
	$articles = $app->article->select('id','title','text')->where('id', '=', $id)->get();

	return $app->render('/articles/edit_article.php', [
		'titles' => $titles,
		'articles' => $articles
	]);

})->name('articles.edit');

//Post putanja do fajla

$app->post('/articles/edit', $authenticated(), function() use ($app) {

	//Request objekat
	$request = $app->request;

	//Dohvatanje polja i vrijdnosti iz forme i id od clanka iz URL-a
	$id = $request->get('id');
	$title = $request->post('title');
	$text = $request->post('text');

	//Validacijska klasa
	$v = $app->validation;

	//Validacija polja iz forme

	$v->validate([
		'title' => [$title, 'required|max(55)'],
		'text' => [$text, 'required'],
	]);

	//Ako je validacija prosla uspijesno

	if ($v->passes())
	{
		//Updatujemo red u bazi p. u zavisnosti od id. where() m. mora biti prije update() m.
		$app->article->where('id', '=', $id)->update([
			'title' => $title,
			'text' => $text
		]);

		//Prikazivanje poruke korisniku i redirekcija
		$app->flash('global', 'You are successfuly updated your article.');
		return $app->redirect($app->urlFor('home'));
	}

	return $app->render('/articles/edit_article.php', [
		'request' => $request,
		'errors' => $v->errors()
	]);

})->name('articles.edit.post');

?>