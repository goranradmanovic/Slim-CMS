<?php 

//Get route for xslx.php file

$app->get('/xlsx', $authenticated(), function () use ($app) {

	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-disposition: attachment; filename=users_table.xlsx');
	header('Cache-Control: max-age=0');

	//Ukljucivanje XLSXWriter klase
	$xlsx = $app->xlsx;
	
	$header = [
		'Username' => 'string',
		'Full Name' => 'string',
		'Active' => 'integer',
		'Admin' => 'integer',
		'Moderator' => 'integer',
		'Can Post' => 'integer'
	];

	$xlsx->setAuthor('Goran Radmanovic'); //ime autora
	$xlsx->writeSheetHeader('Sheet1', $header); //optionalni upis naslova tj. imena polja u XLSX tabeli
	
	//Querrying for all users from users table in the database
	$users = $app->user->query('SELECT users.id,username,first_name,last_name,active,users_permissions.user_id,users_permissions.is_admin,
								users_permissions.is_moderator,users_permissions.can_post_topic 
								FROM users LEFT JOIN users_permissions ON users.id = users_permissions.user_id')->get();

	foreach($users as $user)
	{
		 //Upisivanje u redove
		$xlsx->writeSheetRow('Sheet1', [$user->username, $user->getFullName(), $user->active, (int)$user->isAdmin(), (int)$user->isModerator(), (int)$user->canPostTopic()]);
	}

	$xlsx->writeToStdOut(); //Pisanje u fajl u downloadanje u browser

})->name('assets.xlsx');

?>