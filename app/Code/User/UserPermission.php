<?php

//Imenovanje klase i fajla
namespace Code\User;

//Koristenje Eloquenta
use Illuminate\Database\Eloquent\Model as Eloquent;

class UserPermission extends Eloquent
{
	//Ovo je tabele iz baze p. i ovo se zahtijea od strane Eloquenta

	protected $table = 'users_permissions';

	//Definiramo fillable polja u koja se moze upisivati u bazu p.

	protected $fillable = [
		'is_admin',
		'is_moderator',
		'can_post_topic'
	];

	//Definiranje default vrijednosti kad se korisnik registruje,a mozemo staviti jos polja iz baze p. ovdje ako nam treba
	//npr. ako zelimo da korisnik ima pravo da nesto stavi na blog ili slicno

	public static $default = [
		'is_admin' => false,
		'is_moderator' => true,
		'can_post_topic' => true
	];
}

?>