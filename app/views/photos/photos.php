{% extends 'templates/default.php' %}

{% block title %} Photos {% endblock %}

{% block content %}
	<!--Ukljucivanje navigacije za opcije za upload slika i kreiranje albuma-->
	{% include 'photos/templates/partials/photos_navigation.php' %}
{% endblock %}