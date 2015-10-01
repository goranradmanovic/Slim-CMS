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
		'title',
		'text'
	];

	//Funkcija za dohvatanje nsalova clanka

	public function getTitle()
	{
		return $this->title;
	}

	//Funkcija za dohvatanje sadrzaja clanka

	public function getText()
	{
		return $this->text;
	}

	//Funcija za editovanje clanka

	public function editArticle($title, $text)
	{
		$this->update([
			'title' => $title,
			'text' => $text
		]);
	}

	//Funkcija za brisanje clanka

	public function deleteArticle($id, $user_id)
	{
		$this->where('id', $id)->where('user_id', $user_id)->delete();
	}

	//Funkcija za pravljenje relacije prema users tabeli iz baze p.  i omogucavanje povlacenja korisnickih podataka
	//Eloquent pravi relaciju prema User modelu tj. users t. iz baze p. i povezuje korisnicki 'id' sa 'user_id' iz
	//articles t. iz baze p. tj. Articles modelom
	
	public function user()
	{
		return $this->belongsTo('Code\User\User');
	}

	//Funkcija za dohvatanje autora clanka

	public function getArticleAuthor()
	{
		return $this->user->getFullNameOrUsername();
	}
}

?>