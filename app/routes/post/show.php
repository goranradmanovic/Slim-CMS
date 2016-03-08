<?php

//Nova putanja routs za prikazivanje postova na show.php
//Propsutanje var. kojoj mozemo pistupiti i vidjti koji post iz baze zelimo prikazati korisniku,i koju dohvatamo
//uz pomoc URL-a i GET-a,prvi param je putanja,onda tu var. postId propustamo u closure funck kao param

$app->get('/posts/:postId', function($postId) use ($app) {

	//Dohvatanje postova iz baze sa specificnim id-em npr. (1,2,3) kojeg dobijamo kroz URL

	$post = $app->article->select('*')->where('id', $postId)->get();

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