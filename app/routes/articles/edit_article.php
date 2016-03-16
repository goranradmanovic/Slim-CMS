<?php

//Get putanja do ovog fajla (':uid' - user id, ':aid' - article id, ':pid' - pagination id)

$app->get('/articles/edit/:uid/:aid/:pid', $authenticated(), function($uid, $aid, $pid) use ($app) {

	//Prvojera id od korisnika koji saljemo iz main navigacije sajta i trenutno autenficiranog korisnika,da nebi doslo do editovanj tudjih clanaka
	if ($uid != $app->auth->id)
	{
		//Prikazivanje poruke korisniku i redirekcija
		$app->flash('danger', 'You can edit only yours articles.');
		return $app->redirect($app->urlFor('home'));
	}

	//Paginacija
	$page = $pid; //Dohvatamo redni broj stranice preko URL-a i smijestamo ga u $page var
	//Provjera da je redni br. st. namjesten i da li je broj,a ako nije majestamo ga na defultni br. st. a to je 1
	$page = (isset($page) && is_numeric($page) ) ? $page : 1;

	$per_page = 4; //Broj prikazivanja rezultata po strnici

	//Brojanje redova u Article tabeli,a bi taj broj mogli podijeliti sa br. rezultatat po st. i izracunati koliki nam je ukupni br. st. (potrebno za prikazivanje brojeva paginacije)
	$count = $app->article->count();

	//Racunanje ukupnog broja st. na osnovu redova iz baze i br. rezultata po st.
	$pages = ceil($count / $per_page);

	//Ako je br.st.veci od 1 onda mnozimo br. st. sa br. rezultata po st. i od tog broja oduzimamo br. rezultata po st. u  suprotnome je start var. 0 tj. vracanje redova iz baze krece od 0 pa do 4
	$start = ($page > 1) ? ($page * $per_page) - $per_page : 0;

	//Dohvatanje svih naslova clanaka i njihov id od specificnog autora tih clanaka iz baze podataka koji su u rasponu od br. start do br. rezultata po st. tj. dohvatamo po 8 rezultata po st.
	$titles = $app->article->where('user_id', $uid)->select('id','user_id','title','text','created_at')->skip($start)->take($per_page)->get();

	//Dohvatanje clanaka iz baze p.
	$articles = $app->article->select('id','title','text')->where('id', $aid)->get();
	
	//Vracamo rendovani views sa podatcima iz baze p.
	return $app->render('/articles/edit_article.php', [
		'titles' => $titles,
		'articles' => $articles,
		'page' => $page,
		'pages' => $pages
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