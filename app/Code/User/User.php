<?php

//Imenovanje namspace ovog fajla
namespace Code\User;

//Uljucivanje i koristenje Eloquent klase iz Illuminate\Database paketa
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
	//Definiranje imena tabele u koju ce se moci upisivati u bazi p.

	protected $table = 'users';

	//Definiranje polja u koja ce se moci upisivati u bazi p.

	protected $fillable = [
		'username',
		'email',
		'first_name',
		'last_name',
		'password',
		'active',
		'active_hash',
		'recover_hash',
		'remember_identifier',
		'remember_token'
	];

	//Metod za dohvatanje punog imena korisnika

	public function getFullName()
	{
		//Provjeravamo da li ne postoji ime i prezime u bazi p.,i ako je to tacno vracamo null vrijednost,a mozemo vracati i false vrijednost

		if (!$this->first_name || !$this->last_name)
		{
			return null;
		}

		//Ako postoji ime i prezime u bazi p.,i ako je to tacno vracamo vrijednosti imena i prezimena iz baze p.

		return "{$this->fist_name} {$this->last_name}";
	}

	//Metod za dohvatanje punog imena i prezimena ili username iz baze p.

	public function getFullNameOrUsername()
	{	
		/*Vracamo puno ime,a ako funck. getFullName vrati null tj. ako ne postoji uneseno puno ime u bazu p.
		onda vracamo username koji mora uvjek biti unesen u bazu p. prilikom regsitracije korisnika
		?: znaci da se jedna od ove dvije vrijednosti output tj. prikaze na stanici*/

		return getFullName() ?: $this->username;
	}

	//Metod za aktivaciju korisnickog racuna

	public function activateAccount()
	{
		/*Sa Eloquent update() m. upisujemo u bazu p. u 'active' polje true tj. 1 int.,a u polje 'active_hash' null da bi ponistili hash 
		koji se upisuje iz emaila koji saljemo korisnku kad napravi racun na stranici*/

		$this->update([
			'active' => true,
			'active_hash' => null
		]);
	}

	//Metod za dohvatanje profil slike korisnika koju je uplodao na Gravatar. Arg. funck. su opcije koje mozemo staviti,a koje
	//su prazan niz po defaultu,a umjesto koga mozemo upisati neke opcije

	public function getAvatar($options = [])
	{
		//Detektujemo velicinu slike,koju propustamo kako el. niza,a po defultu je 45

		$size = isset($options['size']) ? $options['size'] : 45;

		//Vracamo string koji je dio url-a sa gravatar stranice i dodajemo hash od korisnickog email-a
		//kao sto stoji u upustvu sa gravatar stranice

		return 'http://www.gravatar.com/avatar/' . md5($this->email) . '?s=' . $size . '&d=identicon';
	}


}

?>