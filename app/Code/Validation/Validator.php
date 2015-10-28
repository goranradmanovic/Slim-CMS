<?php

//Imenovanje namespace klase
namespace Code\Validation;

//Koristenje drugih paketa
use Violin\Violin;
use Code\User\User;
use Code\Helpers\Hash;
use Code\Album\Album;
use ReCaptcha\ReCaptcha;

class Validator extends Violin
{
	//Bilo koje custom pravilo koje napravimo ce se cuvati u ovoj var.
	protected $user;

	//Properti Validator klase u kome ce biti instanca Hash klase
	protected $hash;

	//Properti Validator klase u kome ce biti instanca Album klase
	protected $album;

	//Properti Validator klase u kome ce biti instanca ReCaptcha klase
	protected $recaptcha;
	
	//Trenutni ulogovani korisnik
	protected $auth;

	public function __construct(User $user, Hash $hash, Album $album, ReCaptcha $recaptcha, $auth = null)
	{
		$this->user = $user;
		$this->hash = $hash;
		$this->album = $album;
		$this->auth = $auth;
		$this->recaptcha = $recaptcha;

		//Dodavanje custom poruke za uniqueEmail pravilo sa addFieldMessages() met. iz Violin klase
		//Za svako email polje iz forme koje ima uniqueEmail pravilo dodaj ovu poruku

		$this->addFieldMessages([
			'email' => [
				'uniqueEmail' => 'That email is already in use.'
			],
			'username' => [
				'uniqueUsername' => 'That username is already in use.'
			],
			'title'=> [
				'uniqueAlbumName' => 'That album name is already in use.'
			],
			'g-recaptcha-response' => [
				'validReCaptcha' => 'Please check in the Captcha field.'
			]
		]);
	
		//Dodavanje nase poruke za pravilo koje smo napravili za provjeru korisnikove sifre iz baze p. i one sto je unijeo u polje old password

		$this->addRuleMessages([
			'matchesCurrentPassword' => 'That does not match your current password.'
		]);
	}

	//Funk. za provjeru i validaciju jedinstvenog email korisnika.Ovaj metod pravimo uz pomoc Violin validate() m.
	//i dodajemo mu nastavak za onu funkcionalnost koju pravimo npt. provjera email,username ili sl.

	public function validate_uniqueEmail($value, $input, $args)
	{
		//Ova funk vraca true ili false
		//Povlacenje korisnikovog emaila iz baze radi usporedbe da li je jedinstven,$value ce bit vrijednost email iz forme kad se unese

		$user = $this->user->where('email', $value);

		//Provjera da li je email koji je poslati kroz formu za update krosinikovih podataka zapravo njegov email iz baze p. i onda
		//vracamo vrijednost true,tako da bi ovo pravilo proslo na formi i da bi korisnik mogao updatovati svoj profil.Jer ako korisnik
		//upise u formu jedinstveni email onda nikad i necemo uzimati taj email u razmatranje
		//Ako je korisnik autentificiran i potvrdjen i ako je email od korisnika jednak vrijednosti tj. emailu koji je korisnik unijeo u 
		//formu u polje za update email vracamo true tako da bi ovo pravilo proslo

		if ($this->auth && $this->auth->email === $value)
		{
			return true;
		}

		//Provjera da li email postoji u bazi i kastovanje svega u bool vrijednost
		//Ako ovo nije istinito i tacno onda u bazi p. postoje korisnici sa ovom email adresom

		return ! (bool) $user->count();
	}

	//Funkc. za validaciju jedinstvenog username

	public function validate_uniqueUsername($value, $input, $args)
	{
		//Ako u bazi postoji neki username i funk. count() vrati 1 to znaci da je taj username zauzet
		//$value je vrijednost koju smo pokupili iz forme,username alex postoji to bi bilo true,a mi provjeravamo da li to nije istinito tj. netacno

		return ! (bool) $this->user->where('username', $value)->count();
	}

	//Metod za provjeru da li korisnikova sirfa sto je unijeo u polje Oldpassword jendaka onoj iz baze p.

	public function validate_matchesCurrentPassword($value, $input, $args)
	{
		//Provjera da li je ovaj korisnik ulogovan i da li se sifra koju je unijeo korisnik u polje old password slaze sa onom iz baze p.
		//tj. da li dva hash od ovih sifri podudaraju. $value je vrijednost koju je obezbjedio korisnik tj. ono sto je unijeo u polje old password

		if ($this->auth && $this->hash->passwordCheck($value, $this->auth->password))
		{
			//Ako je ovo istinito tj. ako se sifre slazu vracamo true

			return true;
		}

		//U suprotnome ako se sifre ne slazu,vracamo false
		return false;
	}

	//Metod za validaciju jedinstvenog imena abluma

	public function validate_uniqueAlbumName($value, $input, $args)
	{
		//Ako u bazi postoji neki title i funk. count() vrati 1 to znaci da je taj title zauzet
		//$value je vrijednost koju smo pokupili iz forme,ako neki 'title' postoji to bi bilo true,a mi provjeravamo da li to nije istinito tj. netacno
	
		return ! (bool) $this->album->where('title', $value)->count();
	}

	//Metod za validaciju ReCaptcha-e

	public function validate_validReCaptcha($value, $input, $args)
	{
		//Validacija g-recaptcha-response polja iz forme
		$response = $this->recaptcha->verify($value);

		//Provjera da li validacija g-recaptcha-response polja iz forme nije prosla uspijesno
		if (!$response->isSuccess())
		{
			//Dohvatamo greske
			return ! (bool) $response->getErrorCodes();
		}	
	}
}

?>