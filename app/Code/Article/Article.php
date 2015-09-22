<?php

//Imenovanje fajla i klase
namespace Code\Article;

//Koristenje Eloquenta
use Illuminate\Database\Eloquent\Model as Eloquent;

class Article extends Eloquent
{
	//Definisanje tabele
	protected $table = 'articles';

	//Definisanje kolona u koje je dozvoljen upis u bazu p.
	protected $fillable = [
		'user_id',
		'text'
	];
}

?>