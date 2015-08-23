<?php

//Imenovanje foldera i klase

namespace Code\Mail;

class Mailer
{
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
}

?>