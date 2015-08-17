<?php

//Imenovanje Klase i foldera
namespace Code\Middleware;

//Koristenje ugradjenog Slim Middleware-a
use Slim\Middleware;

class BeforeMiddleware extends Middleware
{
	//Metod call() se uvjek pokrece kad je ovaj Middleware u upotrebi

	public function call()
	{
		//BeforeMiddleware sluzi da se prije svakog zahtijeva provjeri da li je sessija iz login.php fajla setovana i da se autentifikacija
		//stavi na 'On' upaljeno,tako da kazemo da je korisnik autenitficiran

		//Uz pomoc hook() m. trebamo zakaciti run() m. da se pokrene u ovoj klasi prije svakog zahtijeva prema aplikaciji
		$this->app->hook('slim.before', [$this, 'run']);

		//Pokrecemo ovo prije sledeceg zahtijeva prema aplikaciji.Ovaj metod moramo tj. citav BeforeMiddlewere moramo
		//dodati nasoj aplikaciji

		$this->next->call();
	}

	//Metod run() ce pokrenuti zahtijev prema nasoj aplikaciji prije svega drugog

	public function run()
	{
		//Provjera da je li je korisnik autentificiran tj. stvaran
		//Provjeravamo da li je sessija setirana koju smo namjestili prilikom logina korisnika i sacuvali na server

		if (isset($_SESSION[$this->app->config->get('auth.session')]))
		{
			//Ako je korisnik autentificiran trebamo prepisati defaultno stanje $app->auth = false sa start.php fajla
			//tako sto cemo povuci sve krosiniko podatek u auth var.

			$this->app->auth = $this->app->user->where('id', $_SESSION[$this->app->config->get('auth.session')])->first();
		}
	}

	//Metod koji provjerava cookie. Kad zavrsimo sa sessijom i kad se opet vratimo na stranicu,ovaj metod ce provjeriti da li postoji cookie u
	//bazi p. i da li se slaze sa cookiem sa korisnikovom comp i onda ce ulogovati korisnika

	protected function checkRememberMe()
	{
		//Provjera da li imamo coockie dosupan i da li je korisnik ulogovan,jer ako jeste onda ga ne treba opet logovati jer bi to stvrorilo redirect petlju

		if ($this->app->getCookie($this->app->config->get('auth.remember')) && !$this->app->auth)
		{
			//Dohvatamo podatke iz Cookia i razdvajamo identifier od tokena koje smo satavili sa '---'
			$data = $this->app->config->get('auth.remember');
			$credentials = explode('___', $data);

			//Provjera da podatci iz cookie-a nisu prazni i da $credentials imaju dva array-a u sebi (rememberIdentifier i rememberToken)

			if (empty(trim($data) || count($credentials) !== 2)
			{
				//Ako je ovo tacno redirektujemo korisnika na home page
				return $this->app->response->redirect($this->app->urlFor('home'));
			}
			else
			{
				//U suprotnome dohvatamo identifier i token iz cookia i hasiramo token
				$identifier = $credentials[0];
				$token = $credentials[1];

				//Dohvatamo krosinika iz baze ciji je remember_identifier jednak $identiferu iz cookia
				$user = $this->app->user->where('remember_identifier', $identifier)->first();

				//Ako smo pronsali korisnika u bazi p. ciji se remember_identifier salaze sa onim identiferom iz cookia
				//onda provjeravamo da li se hash verzija tokena slaze sa hash verzijom tokena iz coockia

				if ($user)
				{
					//Provjera hash tokena ($token = $this->app->hash->hash($credentials[1]);) sa hash tokenom iz baze p.
					if ($this->app->hash->hashCheck($token, $user->remember_token))
					{
						//Ako se ova dva hash-a od tokena slazu onda cemo ulogovati korisnika tako sto cemo namjestiti Sessiju da ima
						//vrijednost korisnikovog id-a iz baze p.

						$_SESSION[$this->app->config->get('auth.session')] = $user->id;

						//Mijenjamo auth sa start.php fajla na true,po defaultu je false

						$this->app->auth = $this->app->user->where('id', $user->id)->first();
					}
					else
					{
						//U suprotnome ako je identifier uredu,a token nije uredu tj. ne slaze se,onda cemo ukloniti vrijednosti
						//iz remember_identifier i remember_token iz baze p.

						$user->removeRememberCredentials();
					}
				}
			}
		}
	}
}

?>