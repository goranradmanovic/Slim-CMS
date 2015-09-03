{% extends 'templates/default.php' %}

{% block title %}All users{% endblock %}

{% block content %}
	<h2>All users</h2>

	<!--Provjera da li je korisnicki niz prazan koji se nalazi u routes/all.php falju u var. $users-->

	{% if users is empty %}
		<p>No registered users.</p>
	{% else %}

		<!--Prolaz kroz sve el. $users var koja je niz sa svim korisnicim aiz baze-->

		{% for user in users %}
			<div class="user">
				<a href="{{ urlFor('user.profile', {username: user.username}) }}">{{ user.username }}</a>

				<!--Provjera da li korisnik ima puno ime i prezime i ispis ako ima-->

				{% if user.getFullName %}
					<h3>{{ user.getFullName }}</h3>
				{% endif %}

				<!--Provjera korisnikovih priviliegija-->

				{% if user.isAdmin %}
					<small>Admin</small>
				{% endif %}
			</div>
		{% endfor %}

	{% endif %}

{% endblock %}