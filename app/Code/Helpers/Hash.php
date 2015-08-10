<?php

//Imenovanje namespace klase

namespace Code\Helpers;

class Hash
{
	protected $config;

	//Propustanje arg. u konstruktor da bi mogli iskoristiti kofiguraciju iz development.php fajla,ovaj arg. cemo propustiti u start.php 
	//kad tamo instaniciramo i dodamo Hash klasu u Slim container

	public function __construct($config)
	{
		$this->config = $config;
	}

	//Metod za hasing sifri

	public function password($password)
	{
		return password_hash($password, $this->config->get('app.hash.algo'), ['cost' => $this->config->get('app.hash.cost')]);
	}

	//Funk. za prvheru sifre. Arg. je sifra u obliku strniga koju unese korisnik i hash sifre korisnika iz baze p.

	public function passwordCheck($password, $hash)
	{
		return password_verify($password, $hash);
	}

	//Funk. za generalni hasing stringova sa sha256

	public function hash($input)
	{
		return hash('sha256', $input);
	}

	//Metod za prvojeru da li se dva hash slazu i da li su jednaka. Arg. je hash koji vec znamo, i hash koji nam je proslijedio korisnik

	public function hashCheck($known, $user)
	{
		return hash_equals($known, $user);
	}
}

?>