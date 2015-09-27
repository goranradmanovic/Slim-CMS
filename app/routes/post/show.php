<?php

//Nova putanja routs za prikazivanje postova na show.php
//Propsutanje var. kojoj mozemo pistupiti i vidjti koji post iz baze zelimo prikazati korisniku,i koju dohvatamo
//uz pomoc URL-a i GET-a,prvi param je putanja,onda tu var. postId propustamo u closure funck kao param

$app->get('/posts/:postId', $guest(), function($postId) use ($app) {

	//Dohvatanje postova iz baze sa specificnim id-em npr. (1,2,3) kojeg dobijamo kroz URL
	//:postId je PDO placeholder koji poslije zamjenimo sa stvarnom vrijednoscu i nema veza sa :postId iz URL-a

	//$post = $app->article->query('SELECT articles.*, users.username, users.first_name, users.last_name FROM articles LEFT JOIN users
									//ON articles.user_id = users.id WHERE articles.id = postId')->get();

	$post = $app->article->leftJoin('users', 'articles.user_id', '=', 'users.id')->select('articles.*','users.username','users.first_name','users.last_name')
	->where('articles.id', '=', $postId)->get();

	//Ako post nije pronadjen tj. ako nemamo nista u bazi,onda cemo output 404 gresku

	if (!$post)
	{
		$app->notFound(); //Prikazujemo 404 gresku
	}

	//'views/posts/show.php' je lokacija gdje ce prikazivati post iz routes/posts/show.php fajla,a ['post' => $post] je vrijednost
	//iz sql query koja ce se prikazivati na stranici,ova $post var. se salje u views/posts/show.php

	$app->render('posts/show.php', ['post' => $post]);

})->name('post.show');

?>