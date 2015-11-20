<?php

//Get putanja do fajla

$app->get('/posts/all_posts', function() use ($app) {

	//Dohvatanje svih postova iz baze podataka
	$posts = $app->article->select('*')->get();

	//Slanje podataka na views
	$app->render('posts/all_posts.php', ['posts' => $posts]);

})->name('posts.all_posts');

?>