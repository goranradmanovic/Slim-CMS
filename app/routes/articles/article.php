<?php

//Get putanja do fajla
$app->get('/articles/article', $authenticated(), function () use ($app) {

	return $app->render('/articles/article.php');

})->name('articles.article');

//Post putanja do fajla
$app->post('/articles/article', $authenticated(), function () use ($app) {

	//Dohvatanje request objekta sa podatcima iz forme
	$request = $app->request;

	$title = $request->post('title');
	$article = $request->post('article');

	//Dohvatanje validacijske klase
	$v = $app->validation;

	//Validacija polja iz forme
	$v->validate([
		'title' => [$title, 'required|max(55)'],
		'article' => [$article, 'required']
	]);

	//Ako je validacija prosla uspijesno

	if ($v->passes())
	{
		$app->article->create([
			'user_id' => $app->auth->id,
			'title' => $title,
			'text' => $article
		]);

		$app->flash('global', 'Your article has been published.');
		return $app->redirect($app->urlFor('home'));
	}

	return $app->render('/articles/article.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);

})->name('article.post');

?>