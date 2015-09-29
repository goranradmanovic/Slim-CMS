<?php

//Get putanja do fajla

$app->get('/posts/all_posts', function() use ($app) {

	//$posts = $app->article->query("SELECT articles.*, CONCAT(users.first_name, ' ', users.last_name) AS author FROM articles LEFT JOIN users ON articles.user_id = users.id")->get();

	$posts = $app->article->leftJoin('users', 'articles.user_id', '=', 'users.id')->select('articles.*','users.username','users.first_name','users.last_name')->orderBy('articles.id')->get();

	$app->render('posts/all_posts.php', ['posts' => $posts]);

})->name('posts.all_posts');

?>