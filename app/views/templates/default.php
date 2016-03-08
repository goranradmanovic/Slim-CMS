<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="apple-moblie-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is blog cms system">
		<meta name="author" content="Goran Radmanovic">
		<meta name="robots" content="index, follow, all">
		<meta name="keywords" content="blog, cms, photos, articles">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="{{ baseUrl }}{{ public }}assets/css/sweetalert.css">
		<link rel="stylesheet" href="{{ baseUrl }}{{ public }}assets/css/lightgallery.css">
		<link rel="stylesheet" href="{{ baseUrl }}{{ public }}assets/css/style.css">
		<title>Website | {% block title %}{% endblock %}</title>
	</head>
	<body>

		<div class="container">

			<!--Ukljucivanje fajla za navigaciju sjata-->
			{% include 'templates/partials/navigation.php' %}

			<!--Ukljucivanje fajla u kome ce prikazivati notifikacije za korisnika-->
			{% include 'templates/partials/messages.php' %}

			<!--Prikazivanje sadrzaja stranice-->
			{% block content %}{% endblock %}

		</div>

		<script src='{{ baseUrl }}{{ public }}assets/js/sweetalert.min.js'></script>
		<script defer src='https://www.google.com/recaptcha/api.js'></script>
		<script defer src='{{ baseUrl }}{{ public }}assets/js/zepto-min.js'></script>
		<script defer src='{{ baseUrl }}{{ public }}assets/js/jquery-2.1.4.min.js'></script>
		<script defer src='{{ baseUrl }}{{ public }}assets/js/lightgallery.js'></script>
		<script defer src='{{ baseUrl }}{{ public }}assets/js/lg-thumbnail.js'></script>
		<script defer src='{{ baseUrl }}{{ public }}assets/js/lg-fullscreen.js'></script>
		<script defer src='{{ baseUrl }}{{ public }}assets/js/main.js'></script>
		<script>
			{% if flash['global'] %}
				swal({
					title: "{{ flash['global'] }}",
					type: "success",
					showConfirmButton: false,
					timer: 1200,
				});
			{% endif %}

			{% if flash['danger'] %}
				swal({
					title: "{{ flash['danger'] }}",
					type: "warning",
					showConfirmButton: false,
					timer: 2200,
				});
			{% endif %}
		</script>
	</body>
</html>