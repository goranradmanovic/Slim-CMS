<?php

namespace Code\Middleware;

use Exception;
use Slim\Middleware;

class CsrfMiddleware extends Middleware
{
	//Ovaj Middleware je srednji dio aplikacije koji se poziva prije zathijeva prema aplikaciji i koji je zaduzen za stvaranje tokena i 
	//provjeru tog tokena u formi

	protected $key; //Ovdje ce biti kljuc koji povacimo iz config development fajla

	public function call()
	{
		$this->key = $this->app->config->get('csrf.key'); //Povlacenje kljuca iz config fajla

		//Dodajemo sa ovim hook() m. i govorimo Slim-u da pogleda prvo ovaj objekat prije zahtijeva prema apli. i pokrene metod check()
		$this->app->hook('slim.before', [$this, 'check']);

		$this->next->call(); //Ovo se zatijeva od strane Slima
	}

	public function check()
	{
		//Setiramo token u sessiju

		//Provjera da li je token setovan tj. namjesten u sessiji i ako nije onda ga setujemo i dodajemo mu dugi nasumicni br. koji hasujemo

		if (!isset($_SESSION[$this->key]))
		{
			$_SESSION[$this->key] = $this->app->hash->hash($this->app->randomlib->generateString(128));
		}

		//Smijestanje nasumicnog generisanog niza u var.
		$token = $_SESSION[$this->key];

		//Provjera kad se token posalje da li request(zahtijev) metod koji koristimo (delete,put,post,get i sl.) je u odredjenim vrijednostima i onda
		//cemo provjeriti token. Slim getMethod() koji vraca vrijednost o kome se dr. metodu radi (put(),get(),post() i sl.)
		//['POST','PUT','DELETE'] su metodi

		if (in_array($this->app->request()->getMethod(), ['POST', 'PUT', 'DELETE']))
		{
			//Ako je ovo tacno i ako se trazeni metod nalazi u nizu koji provjravamo,onda trbamo povuci poslati (submitted) token
			//tako sto cemo povuci ime kljuca tokena iz config/development.php, i onda trebamo provjeriti da li je dostupan,a ako
			//nije dostupan onda ga namjestamo (set) na prazan niz

			$submittedToken = $this->app->request->post($this->key) ?: '';

			//Provjra da li submitted tj. poslati token je jednak onome koji je generisan,ako jeste to je ok i dobro,a ako nije
			//onda bacamo Exception

			if (!$this->app->hash->hashCheck($token, $submittedToken))
			{
				throw new Exception('CSRF token mismatch!');
			}
		}

		//Prebacivanje i dijeljenje podata sa ove stranice tj. imena tokena i vrijednosti tokena na dr. stranicama iz views foldera

		$this->app->view()->appendData([
			'csrf_key' => $this->key,
			'csrf_token' => $token
		]);
	}
}

?>