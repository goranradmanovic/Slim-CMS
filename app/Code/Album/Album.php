<?php

//Imenovanje fajla
namespace Code\Album;

//Koristenje Eloquent modela
use Illuminate\Database\Eloquent\Model as Eloquent;

class Album extends Eloquent
{
	//Var. u kojoj cuvamo ime tabele iz baze p.

	protected $table = 'albums';

	//Polja u koja je moguce upisivanje,radi zastite od MassAsimentta

	protected $fillable = ['user_id', 'title'];

	//Metod za dohvatanje svih albuma iz baze p.
	public function getAlbums()
	{
		return $this->select('*')->get();
	}

	//Metod za dohvatanje imena albuma od specificnog korisnika
	public function getUserAlbums($user_id)
	{
		return $this->where('user_id', $user_id)->get();
	}

	//Povezivanje photo tabele sa album tabelom
	public function photo()
	{
		return $this->hasOne('Code\Photo\Photo');
	}

	//Metod za brojeanje slika u odredjenom albumu
	public function countPhotosInAlbum()
	{
		return $this->photo->select('id')->where('album_id', $this->id)->count();
	}

	//Metod za dohvatanje prve slike u Albumu
	public function getAlbumThumbnail()
	{
		//Dohvatanje prve slike iz albuma tj. njene putanje
		return $this->photo->where('album_id', $this->id)->first(['path']);
	}

}

?>