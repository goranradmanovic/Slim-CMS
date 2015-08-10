<?php

//Stvaranje putanje do register.php iz views/auth foldera

$app->get('/register', function() use($app) {
	$app->render('/auth/register.php');
})->name('register');


?>