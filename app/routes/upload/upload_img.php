<?php

//Upload Profile Image

//Get URL putanja

$app->get('/upload', $authenticated(), function() use ($app) {
	$app->render('/upload/upload_img.php');
})->name('upload');


//Post putanja za obradu podataka iz forme

$app->post('/upload', $authenticated(), function() use ($app) {

	//Dohvatanje Slim request objekata
	$request = $app->request;

	$img_title = $request->post('img_title');
	$picture = $_FILES['picture'];

	//Provjera da li postoji nesto u $_FILES globalnoj var. tj da li je slika poslata
	//echo (!empty($_FILES['picture'])) ? "No files uploaded!!" : 'ok';

	/*
		if (empty($_FILES['picture']['name']))
		{
	        $app->flash('global', 'Please select pictures files for upload!');
	        return $app->response->redirect($app->urlFor('upload'));
	    }
	*/

	//Pozivanje validacijske klase
	$v = $app->validation;

	//Validacija polja iz forme
	$v->validate([
		'img_title' => [$img_title, 'required|min(4)'],
		'picture' => [$_FILES['picture']['name'], 'required']
	]);
	
	//Ako je validacija prosla uspijesno

	if ($v->passes())
	{
		$image = $app->image; //Dohvatanje Image klase sa start.php fajla iz Slim2 containera

		$allowedMIME = ['jpg','jpeg','png']; //Dozvoljeni niz ekstenzija za upload

		//Folder za smijestanje korisnickih slika od profila
		$userDir = INC_ROOT . "\app\uploads\profile_img\\{$app->auth->username}\\";

		//Stvaranje korisnickog foldera za profilne slike koji ce se zvati kao njihovo username
		$userUploadFolder = fDirectory::create($userDir);

		//Namjestanje dozvoljenog niza estenzija,dozvoljene velicine fajla,dozvoljene dizmenzije slike,i smijestanje u profile_img folder.
		$image->setMime($allowedMIME)->setSize(1000, 1048576)->setDimension(500, 500)->setLocation($userUploadFolder);

		//Provjera da li uplodovana slika postoji
		if($image['picture'])
		{	
			//Izvrsavanje uploada slike
			$upload = $image->upload(); 

			//Provjera da li je slika ucitana na zeljenu lokaciju
			if($upload)
			{	
				//Dohvatanje stare korisnikove slike i njeno brisanje it uploads/profile_img foldera
				//Sistemska putanje do profilene slike korisnika
				//(C:/xampp/htdocs/Vijezbe/Church/app/uploads/profile_img/155e339180caf9_gokqijelpmfhn.jpeg)
				//Zato sto file_exists() f. uzima sistemsku putanju,a ne url putanju do file da bi se izvrsila

				$profileImgPath = str_replace($app->config->get('app.url'), $_SERVER['DOCUMENT_ROOT'], $app->auth->img_path);

				file_exists($profileImgPath) ? unlink($profileImgPath) : null; //Provjera da li profilna slika postoji u uploads/profile_img

				//Smanjivanje slike na zeljenu velicinu
				$resize = Bulletproof\resize (
							$image->getFullPath(), 
							$image->getMime(),
							$image->getWidth(),
							$image->getHeight(),
							100,
							100
				);

				//Dohvatanje putanje do slike i imena slike
				$img_path = $app->config->get('app.url') . $app->config->get('app.profile_uploads') . $app->auth->username . '/' . $image->getName() . '.' . $image->getMime();

				$user = $app->auth; //Cuvanje korisnikovih podataka u var.

				//Update korisnikov red u bazi p. sa putanjom do profil slike i naslovom slike

				$user->update([
					'img_path' => $img_path,
					'img_title' => $img_title
				]);

				//Ispis potvrdne poruke i redirekcija na upload_img.php stranicu
				$app->flash('global', 'Your profile picture is uploaded sucessfully.');
				$app->response->redirect($app->urlFor('upload'));
			}
			else
			{	
				//Ispis greske i redirekcija na upload_img.php stranicu
				$app->flash('global', $image['error']);
				return $app->response->redirect($app->urlFor('upload'));
			}
		}
	}

	$app->render('/upload/upload_img.php', ['errors' => $v->errors()]);

})->name('upload.post');

?>