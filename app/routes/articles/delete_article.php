<?php

//Get putanja i obrada podataka u get() m.
$app->get('/articles/delete/:id', $authenticated(), function($id) use ($app) {

	//Dohvatanje podataka o id od autora i id od clnaka radi provjere da nebi mogao brisati tudje clanke
	$article = $app->article->select('id','user_id')->where('id', $id)->first();

	//Ako nije id od clanka jednak id iz URL i ako nije id od autora clnaka jednak trenutnom ulogovanom clanku
	if (!($article->id === $id) && !($article->user_id === $app->auth->id))
	{	
		//Prikazujemo korisniku poruku upozorenja i vracamom ga na home st.
		$app->flash('danger', 'You can delete only yours article!');
		return $app->redirect($app->urlFor('home'));
	}

	//Brisemo clanak iz baze p. sa specoficnim id-em 
	$app->article->destroy($id);

	//Redirekcija korisnika na delete st. i prikzivanje poruke korisniku
	$app->flash('global', 'You are successfuly deleted article.');
	return $app->redirect($app->urlFor('articles.edit', ['uid' => $app->auth->id, 'aid' => 0]));

})->name('articles.delete');

?>