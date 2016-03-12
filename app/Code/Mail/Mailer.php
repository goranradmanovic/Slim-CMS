<?php

//Imenovanje foldera i klase

namespace Code\Mail;

class Mailer
{
	/*
	// Zakomentarisano zato sto se odnosi na PHPMailer (ovo je funkcionalini dio koda)
	
	protected $view; //Ovo ce biti views koji cemo prikazati sa Slim metodom render()
	protected $mailer; //Ovo ce biti PHPMailer paket koji cemo propistiti u constuctor ove klase

	//U konstruktor ubacujemo $views i $mailer kao dependencies da bi ih mogli prikazati u viewsu
	public function __construct($view, $mailer)
	{
		$this->view = $view;
		$this->mailer = $mailer;
	}

	//Metod send korstimo za slanje email por., arg. mu je $template koji zelimo poslati unutar views-a,$data su podatci koje
	//zelimo poslati unutar viewsa,i $callback je callback funk. koja namjesta body,subject i dr. od emaila a koji se nalaze u Message k.

	public function send($template, $data, $callback)
	{
		//Kreiramo instancu Message k. da bi mogli poslati body od email,a arg. constuctora $this->mailer,omogucava da se metode
		//iz Message k. izvrse. Message k. ne treba importovati zato sto se nalazi u istom folderu kao i Mailer k.

		$message = new Message($this->mailer);

		//Dodajemo $data na view koji smo propustili kao param. u register.php ('email/auth/registered.php'),a to su korinsicki 
		//podatci,tako da su ti korisnicki podatci dostupni i šerovani na views-u i da se mogu koristiti unutar Twiga

		$this->view->appendData($data);

		//Dodajemo tijelo email-a tj. poruku sa tekstom body,uz pomoc body() m. iz Message klase,u koji propustamo $template arg.
		//koji ce onda otici na register.php i preuzeti views ('email/auth/registered.php') i uz pomoc render() metoda poslati ga
		//kao tijelo emila

		$message->body($this->view->render($template));

		//Pozivamo callback funkciju sa register.php zajedno sa $message = new Message($this->mailer); da bi mogli koristiti
		//Message metode. callback func. uzima param. $message i onda prilikom svog izvrsavanje koristi to() i subject() m.

		call_user_func($callback, $message);

		//Slanje email poruke
		
		$this->mailer->send();
	}
	*/

	//Mailgun dio coda za slanje emailova

	protected $view; //Ovo ce biti views koji cemo prikazati sa Slim metodom render()
	protected $mailer; //Ovo ce biti PHPMailer paket koji cemo propistiti u constuctor ove klase
	protected $config; //Ovo ce bit var za cuvanje i povlacenje svih konfiguracijskih postavki koje nam trebaju

	//U konstruktor ubacujemo $views i $mailer kao dependencies da bi ih mogli prikazati u viewsu
	public function __construct($view, $config, $mailer)
	{
		$this->view = $view;
		$this->mailer = $mailer;
		$this->config = $config;
	}

	//Metod send korstimo za slanje email por., arg. mu je $template koji zelimo poslati unutar views-a,$data su podatci koje
	//zelimo poslati unutar viewsa,i $callback je callback funk. koja namjesta body,subject i dr. od emaila a koji se nalaze u Message k.

	public function send($template, $data, $callback)
	{
		//Nova instanca Mailgun Messagebuildera koji sluzi za pravljenje emailova
		$builder = $this->mailer->MessageBuilder();

		

		//Kreiramo instancu Message k. da bi mogli poslati body od email,a arg. constuctora $builder,omogucava da se metode
		//iz Message k. izvrse. Message k. ne treba importovati zato sto se nalazi u istom folderu kao i Mailer k.

		$message = new Message($builder);

		//Nastimavamo od koga je poruka sa setFromAddress(),a iz konfiguracije dohvatamo email adresu od koga se salje poruka
		$message->from($this->config->get('mail.from'));

		//Dodajemo $data na view koji smo propustili kao param. u register.php ('email/auth/registered.php'),a to su korinsicki 
		//podatci,tako da su ti korisnicki podatci dostupni i šerovani na views-u i da se mogu koristiti unutar Twiga

		$this->view->appendData($data);

		//Dodajemo tijelo email-a tj. poruku sa tekstom body,uz pomoc body() m. iz Message klase,u koji propustamo $template arg.
		//koji ce onda otici na register.php i preuzeti views ('email/auth/registered.php') i uz pomoc render() metoda poslati ga
		//kao tijelo emila

		$message->body($this->view->render($template));

		//Pozivamo callback funkciju sa register.php zajedno sa $message = new Message($this->mailer); da bi mogli koristiti
		//Message metode. callback func. uzima param. $message i onda prilikom svog izvrsavanje koristi to() i subject() m.

		call_user_func($callback, $message);

		//Dohvatamo domenu od Mailguna zato sto cemo slati POST request kroz Milgun API
		$domain = $this->config->get('mail.domain');

		//Slanje email poruke (getMessage() m. je iz Mailguna i sluzi sa dohvatanje email poruke,a post() sluzi sa slanje emaila)
		//"{$domain}/messages" se odnosi na nasu domenu na Mailgun st. i messages view tj. poruke na toj st.
		$this->mailer->post("{$domain}/messages", $builder->getMessage());
	}
}

?>