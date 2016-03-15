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

	//Putanja do defaultne album slike
	protected $defaultAlbumImage = 'http://192.168.1.4/Vijezbe/Slim-CMS/public/assets/icons/Album.svg';

	//Metod za dohvatanje svih albuma iz baze p.
	public function getAlbums($start, $perPage)
	{
		return $this->select('*')->skip($start)->take($perPage)->get();
	}

	//Metod za dohvatanje naslova albuma
	public function getAlbumTitle($albumId)
	{
		return $this->select('title')->where('id', $albumId)->first();
	}

	//Metod za dohvatanje imena albuma od specificnog korisnika
	public function getUserAlbums($user_id)
	{
		return $this->select('id','title')->where('user_id', $user_id)->get();
	}

	//Metod za dohvatanje imena albuma od specificnog korisnika radi stvaranja paginacije na all_albums
	public function getUserAlbumsPagination($user_id, $start, $perPage)
	{
		return $this->select('id','title')->where('user_id', $user_id)->skip($start)->take($perPage)->get();
	}

	//Povezivanje photo tabele sa album tabelom
	public function photo()
	{
		return $this->hasOne('Code\Photo\Photo', 'album_id');
	}

	//Metod za brojeanje slika u odredjenom albumu
	public function countPhotosInAlbum()
	{
		return $this->photo()->select('id')->where('album_id', $this->id)->count();
	}

	//Metod za dohvatanje prve slike u Albumu
	public function getAlbumThumbnail()
	{
		//Dohvatanje prve slike iz albuma tj. njene putanje
		$imagePath = $this->photo()->where('album_id', $this->id)->first(['path']);

		//Ako ne postoji ni jedna putanja slike u odredjenom albumu onda vracamo defaultnu sliku od albuma
		return !$imagePath ? $this->defaultAlbumImage : $imagePath;
	}

	//Metod za povlacenje svih slika iz jednog albuma iz baze podataka
	public function DisplayAlbumPhotos($albumId)
	{
		$path = $this->find($albumId)->photo()->select('id','path')->get();

		//Provjera da li postoje slike u odredjenom albumu,a ako ne postoje vracamo null
		if (count($path) === 0)
		{
			return null;
		}

		return $path;
	}

	//Metod za prikazivanje svih korisnikovih slika
	public function DisplayUserPhotos($albumId, $userId)
	{
		return $this->find($albumId)->photo->where('user_id', $userId)->get(['path']); //Ovo je Eloquent dinamcki properti
	}

	//Metod za brisanje albuma i slika iz albuma iz baze p.
	public function DeleteAlbum($albumId, $userId)
	{
		//Brisanje slika iz odredjenog albuma iz baze p.
		$this->find($albumId)->photo()->where('album_id', $albumId)->where('user_id', $userId)->delete();

		//Brisanje albuma iz baze p.
		$this->find($albumId)->where('id', $albumId)->where('user_id', $userId)->delete();

		return true;
	}
}

?>