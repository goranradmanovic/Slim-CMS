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
		'remember_token',
		'img_path',
		'img_title'
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

		return "{$this->first_name} {$this->last_name}";
	}

	//Metod za dohvatanje punog imena i prezimena ili username iz baze p.

	public function getFullNameOrUsername()
	{	
		/*Vracamo puno ime,a ako funck. getFullName vrati null tj. ako ne postoji uneseno puno ime u bazu p.
		onda vracamo username koji mora uvjek biti unesen u bazu p. prilikom regsitracije korisnika
		?: znaci da se jedna od ove dvije vrijednosti output tj. prikaze na stanici*/

		return $this->getFullName() ?: $this->username;
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

	//Metod za dohvatanje profilne slike tj. putanje od slike iz baze p.

	public function getProfileImg()
	{
		//Provjera da li putanja do profilen slike iz uploads foldera postoji u bazi p.
		//Ako putanja do profilne slike iz uploads foldera ne postoji u bazi p. onda nam vrati null u suprotonme vrati putanju do slike

		return !$this->img_path ? 'http://localhost/Vijezbe/Church/public/assets/icons/Avatar.svg' : $this->img_path;
	}

	//Metod za brisanje profilene slike

	public function deleteProfileImg()
	{
		$this->update([
			'img_path' => null,
			'img_title' => null
		]);
	}

	//Metod za upis remember_identifier-a i rebemebr_token-a u bazu p. ako je korisnik kliknuo na dugme remember me na login formi

	public function updateRememberCredentials($identifier, $token)
	{
		$this->update([
			'remember_identifier' => $identifier,
			'remember_token' => $token
		]);
	}

	//Metod za uklanjanje remember_identifera i remember_tokena iz baze p.

	public function removeRememberCredentials()
	{
		//Pozivamo metod updateRememberCredentials($identifier, $token) i kao arg. propustamo null,null vrijednosti koje ce se upisati u bazu p.
		$this->updateRememberCredentials(null, null);
	}

	//Metod za provjeru da li korisnik ima adminstartorske privilegije. Arg. mu je ime premisije koju provjeravamo u obliku string 'is_admin'

	public function hasPermission($permission)
	{
		//Ovaj metod vraca kljuc ovlastenja iz baze,ako je 1 onda je true,a ako je 0 onda je false
		//$this->permission se odnosi na metod permission()

		return (bool) $this->permission->{$permission};
	}

	//Pomocni metod za funk hasPermission koji provjerava admin ovlastenja.Dovoljno je da ovaj metod pozovemo na korisnika
	//i on ce vratiti iz baze p. true ili false

	public function isAdmin()
	{
		return $this->hasPermission('is_admin');
	}

	//Ovaj metod je poveznica izmedju User k. i hasPermission k.,a ove dvije klase oznacavaju tabele iz baze p. Ovo je dio Eloquenta
	//Ova funk. vraca tip relacije koji postoji izmedju tabela u bazi p.

	public function permission()
	{
		//Korisnik ima jedan set ovlastenja,nema visestruka ovlastenja vec samo jedan red po korisniku iz baze p.
		//Da bi napravili relaciju koristimo eloquent metod hasOne(),koji kao arg. prima namespace od klase u kojoj su ovlastenja
		//i strani kljuc iz users_permission teble,a to je 'user_id'

		return $this->hasOne('Code\User\UserPermission', 'user_id');
	}
}

?>