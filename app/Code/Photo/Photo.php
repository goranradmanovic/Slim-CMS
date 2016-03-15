<?php

//Imenovanje fajla
namespace Code\Photo;

//Koristenje illuminate paketa
use Illuminate\Database\Eloquent\Model as Eloquent;

class Photo extends Eloquent
{
	//Ime tabele
	protected $table = 'photos';

	//Polja u koja je dozvoljen upis
	protected $fillable = [
		'user_id',
		'album_id',
		'path',
		'size',
		'type'
	];

	//Metod za dohvatanje svih slika
	public function getPhotos()
	{
		return $this->select('*')->get();
	}

	//Dohvatanje svih korisnikovih slika i limitiranje rezultata radi paginacije
	public function getUserPhotos($user_id, $start, $perPage)
	{
		return $this->select('id','path')->where('user_id', $user_id)->skip($start)->take($perPage)->get();
	}

	//Dohvatanje slika iz odredjenog albuma i limitiranje rezultata radi paginacije
	public function getAlbumPhotos($album_id, $start, $perPage)
	{
		return $this->select('id','path')->where('album_id', $album_id)->skip($start)->take($perPage)->get();
	}

	//Metod za dohvatanje jedne slike
	public function getPhoto($id)
	{
		return $this->select('path','album_id')->where('id', $id)->first();
	}

	//Brisanje odredjene slike
	public function deletePhoto($id)
	{
		$this->destroy($id);
	}

	//Putanja do foldera gdje se nalaze slike
	public function getPhotoPath($id)
	{
		return $this->select('path')->where('id', $id)->first();
	}
}

?>