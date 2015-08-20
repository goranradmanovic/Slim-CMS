<?php

//Imenovanje klase i foldera
namespace Code\Message;

class Message
{
	//Message klas sluzi za pravljenje emailova

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
}

?>