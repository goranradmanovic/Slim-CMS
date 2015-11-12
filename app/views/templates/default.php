<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="CMS, MVC, Slim2 application">
		<meta name="author" content="Goran Radmanovic">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="apple-moblie-web-app-capable" content="yes">
		<meta name="robots" content="index, follow, all"/>
		<meta name="keywords" content="domajax, ajax, jquery, plugin, javascript"/>
		<link rel="stylesheet" href="assets/css/sweetalert.css">
		<title>Website | {% block title %}{% endblock %}</title>
	</head>
	<body>
		<!--Ukljucivanje fajla u kome ce prikazivati notifikacije za korisnika-->
		{% include 'templates/partials/messages.php' %}

		<!--Ukljucivanje fajla za navigaciju sjata-->
		{% include 'templates/partials/navigation.php' %}

		<!--Prikazivanje sadrzaja stranice-->
		{% block content %}{% endblock %}

		<script defer src='https://www.google.com/recaptcha/api.js'></script>
		<script defer src='assets/js/zepto-min.js'></script>
		<script src='assets/js/sweetalert.min.js'></script>
		<script defer src='assets/js/main.js'></script>
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