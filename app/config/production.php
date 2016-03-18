<?php

//Konfiguracijsk niz sa najbitnijim postavkama za aplikaciju
//U mail niz sam ubacio i mailgun podatke za slanje mailova
//Ako zelimo koristiti SMTP moramo u kljuc username navesti email koji koristimo i u password
//obezbjediti sifu

return [
	'app' => [
		'url' => 'http://slim-cms.byethost13.com/',
		'public' => 'public/',
		'profile_uploads' => '/Vijezbe/Slim-CMS/app/uploads/profile_img/',
		'hash' => [
			'algo' => PASSWORD_BCRYPT,
			'cost' => 10
		]
	],

	'db' => [
		'driver' => 'mysql',
		'host' => 'sql103.byethost13.com',
		'name' => 'b13_15075048_slimcms',
		'username' => 'b13_15075048',
		'password' => 'g1o2r3a8n4',
		'charset' => 'utf8',
		'collation' => 'utf8_unicode_ci',
		'prexif' => ''
	],

	'auth' => [
		'session' => 'user_id',
		'remember' => 'user_r'
	],

	'mail' => [
		'smtp_auth' => true,
		'smtp_secure' => 'tls',
		'host' => '',
		'password' => '',
		'port' => 587,
		'html' => true,

		'secret' => 'key-fafbd1c6478f322cac6c8ec7e78e1b51',
		'domain' => 'sandbox139f1c75dad64bf9a4a802340f9f74a2.mailgun.org',
		'from' => 'grcms@gmail.com'
	],

	'twig' => [
		'debug' => true
	],

	'csrf' => [
		'key' => 'csrf_token'
	]
];

?>