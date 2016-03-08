<?php

//Konfiguracijsk niz sa najbitnijim postavkama za aplikaciju

return [
	'app' => [
		'url' => 'http://192.168.1.4',
		'public' => '/Vijezbe/Slim-CMS/public/',
		'profile_uploads' => '/Vijezbe/Slim-CMS/app/uploads/profile_img/',
		'hash' => [
			'algo' => PASSWORD_BCRYPT,
			'cost' => 10
		]
	],

	'db' => [
		'driver' => 'mysql',
		'host' => '127.0.0.1',
		'name' => 'church',
		'username' => 'root',
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
		'host' => 'smtp.gmail.com',
		'username' => 'milosdakic89@gmail.com',
		'password' => 'm1I9l9O8s9',
		'port' => 587,
		'html' => true
	],

	'twig' => [
		'debug' => true
	],

	'csrf' => [
		'key' => 'csrf_token'
	]
];

?>