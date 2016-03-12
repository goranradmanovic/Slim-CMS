<?php

//Imenovanje klase i foldera
namespace Code\Mail;

class Message
{
	/*
	//Message klas sluzi za pravljenje emailova (Ovaj dio coda se odnosi na PHPMailer klasu,a zakomentarisan je zato sto smo presli na koristenje Mailgun usluge)

	protected $mailer;

	public function __construct($mailer)
	{
		$this->mailer = $mailer;
	}

	//Funkcija za slanje emailova na oderdjenu adresu. Arg. mu je adresa na koju saljemo,a mozemo dodati i ime kome saljemo
	//u argumente i addAddress() m. i dodamo novi parametar ime na register.php ($message->to($user->email);)

	public function to($address)
	{
		$this->mailer->addAddress($address);
	}

	//Funkcija za setiranje tj. postavaljenje subjecta tj. naslova email-a

	public function subject($subject)
	{
		$this->mailer->Subject = $subject;
	}

	//Funkcija za setiranje tj. postavaljenje body-a tj. sadrzaja email-a

	public function body($body)
	{
		$this->mailer->Body = $body;
	}
	*/

	//Message klas sluzi za pravljenje emailova (Ovaj dio koda se odnosi na Mailgun slanje emailova)

	protected $mailer;

	public function __construct($mailer)
	{
		$this->mailer = $mailer;
	}

	//Funkcija za slanje emailova na oderdjenu adresu. Arg. mu je adresa na koju saljemo,a mozemo dodati i ime kome saljemo
	//u argumente i addAddress() m. i dodamo novi parametar ime na register.php ($message->to($user->email);)

	public function to($address)
	{
		$this->mailer->addToRecipient($address);
	}

	//Funkcija za setiranje tj. postavaljenje subjecta tj. naslova email-a

	public function subject($subject)
	{
		$this->mailer->setSubject($subject);
	}

	//Funkcija za setirnaje od koga se salje email poruka

	public function from($address)
	{
		//Nastimavamo od koga je poruka sa setFromAddress(),a iz konfiguracije dohvatamo email adresu od koga se salje poruka
		$this->mailer->setFromAddress($address);
	}

	//Funkcija za setiranje tj. postavaljenje body-a tj. sadrzaja email-a

	public function body($body)
	{
		$this->mailer->setHtmlBody($body);
	}
}

?>