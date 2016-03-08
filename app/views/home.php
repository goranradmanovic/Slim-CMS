{% extends 'templates/default.php' %}

{% block title %} Home {% endblock %}

{% block content %}

	<!--Korisnicke opcije (Provjera da li je korisnik autentificiran)-->
	{% if auth %}

		<p>Hello, {{ auth.getFullNameOrUsername }} <img src="{{ auth.getProfileImg }}" title="{{ user.img_title }}" alt="Your profile picture"></p>
		<!--Propustamo placeholder username: i vrijednost auth.username da bi se generisao link profilnu stranicu odredjenog korisnika-->
		<a href="{{ urlFor('user.profile', {username: auth.username}) }}">Your Profile</a>
		<a href="{{ urlFor('register') }}">Register</a>
		<a href="{{ urlFor('password.change') }}">Change password</a>
		<a href="{{ urlFor('account.profile') }}">Update profile</a>
		<a href="{{ urlFor('articles.article') }}">Publish Article</a>
		<a href="{{ urlFor('articles.edit', {'uid': auth.id, 'aid': 0}) }}">Edit Article</a><!--'uid' - user id, 'aid' - article id-->
		<a href="{{ urlFor('photos.photos') }}">Photos</a>

		<!--Ako je korisnik admin prikazujemo mu ovaj link,a ako nije onda ga sakrijemo od njega-->
		{% if auth.isAdmin %}
			<a href="{{ urlFor('admin.example') }}">Admin area</a>
			<a href="{{ urlFor('user.all') }}">All users</a>
		{% endif %}

	{% else %}

		Home page 

	{% endif %}

{% endblock %}