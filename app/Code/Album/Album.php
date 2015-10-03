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

}

?>