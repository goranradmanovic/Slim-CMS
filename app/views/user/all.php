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
				<table>
					<thead>
						<tr>
							<th>User profile</th>
							<th>User name</th>
							<th>Admin</th>
							<th>Moderator</th>
							<th>Can post content</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<!--Link do korisnikovog profila-->
							<td><a href="{{ urlFor('user.profile', {username: user.username}) }}">{{ user.username }}</a></td>

							<!--Provjera da li korisnik ima puno ime i prezime i ispis ako ima-->
							{% if user.getFullName %}
								<td>{{ user.getFullname }}</td>
							{% else %}
								<td></td>
							{% endif %}

							<!--Provjera korisnikovih priviliegija-->
							{% if user.isAdmin %}
								<td>Admin</td>
							{% else %}
								<td></td>
							{% endif %}
						</tr>
					</tbody>
				</table>
			</div>
		{% endfor %}

	{% endif %}

{% endblock %}