<?php

//Get URL putanja

$app->get('/upload', function() use ($app) {
	$app->render('/upload/upload_img.php');
})->name('upload');


//Post putanja za obradu podataka iz forme

$app->post('/upload', function() use ($app) {

	//Dohvatanje Slim request objekata
	$request = $app->request;

	$img_title = $request->post('img_title');
	//$picture = $request->post('C:\xampp\tmp\\', function() { isset($_FILES['picture']) ?: $_FILES['picture']; });
	$picture = $_FILES['picture'];

	//Pozivanje validacijske klase
	$v = $app->validation;

	//Validacija polja iz forme
	$v->validate([
		'img_title' => [$img_title, 'required|alnumDash|min(4)'],
		'picture' => [$picture, 'required']
	]);
	
	//Ako je validacija prosla uspijesno

	if ($v->passes())
	{
		echo 'ok';
	}








	$app->render('/upload/upload_img.php', [
		'errors' => $v->errors(),
		'request' => $request
	]);

})->name('upload.post');

?>