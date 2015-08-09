<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Website | {% block title %}{% endblock %}</title>
		<link rel="stylesheet" href="">
	</head>
	<body>
		<!--Ukljucivanje fajla u kome ce prikazivati notifikacije za korisnika-->
		{% extends 'templates/partials/messages.php' %}

		<!--Ukljucivanje fajla za navigaciju sjata-->
		{% extends 'templates/partials/navigation.php' %}

		<!--Prikazivanje sadrzaja stranice-->
		{% block content %}{% endblock %}
	</body>
</html>