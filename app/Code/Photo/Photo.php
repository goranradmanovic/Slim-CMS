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

	//Dohvatanje svih korisnikovih slika
	public function getUserPhotos($user_id)
	{
		return $this->select('id','path')->where('user_id', $user_id)->get();
	}

	//Dohvatanje slika iz odredjenog albuma
	public function getAlbumPhotos($album_id)
	{
		return $this->where('album_id', $album_id)->get();
	}

	//Metod za dohvatanje jedne slike
	public function getPhoto($id)
	{
		return $this->select('path')->where('id', $id)->first();
	}

	//Brisanje odredjene slike
	public function deletePhoto($id)
	{
		return $this->destroy($id);
	}

	//Putanja do foldera gdje se nalaze slike
	public function getPhotoPath()
	{
		return $this->path;
	}

}

?>