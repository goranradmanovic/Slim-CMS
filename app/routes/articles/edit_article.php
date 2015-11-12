<?php

//Get putanja do ovog fajla (':uid' - user id, ':aid' - article id)

$app->get('/articles/edit/:uid/:aid', $authenticated(), function($uid, $aid) use ($app) {

	//Prvojera id od korisnika koji saljemo iz main navigacije sajta i trenutno autenficiranog korisnika,da nebi doslo do editovanj tudjih clanaka
	if ($uid != $app->auth->id)
	{
		//Prikazivanje poruke korisniku i redirekcija
		$app->flash('danger', 'You can edit only yours articles.');
		return $app->redirect($app->urlFor('home'));
	}

	//Dohvatanje naslova clanaka i njihov id od specificnog autora tih clanaka
	$titles = $app->article->where('user_id', $uid)->select('id','title','created_at')->get();

	//Dohvatanje clanaka iz baze p.
	$articles = $app->article->select('id','title','text')->where('id', $aid)->get();
	
	//Vracamo rendovani views sa podatcima iz baze p.
	return $app->render('/articles/edit_article.php', [
		'titles' => $titles,
		'articles' => $articles
	]);

})->name('articles.edit');

//Post putanja do fajla

$app->post('/articles/edit/:id', $authenticated(), function($id) use ($app) {

	//Request objekat
	$request = $app->request;

	//Dohvatanje polja i vrijdnosti iz forme i id od clanka iz URL-a
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
		$app->article->where('id', $id)->update([
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