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
							<th>Picture</th>
							<th>Username</th>
							<th>Full name</th>
							<th>Admin</th>
							<th>Moderator</th>
							<th>Can post content</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<!--Dohvatanje korisnikove profilne slike-->

							<td><img src="{{ user.getProfileImg }}" alt="User_profile.jpg" width="25px" height="25px"></td>

							<!--Link do korisnikovog profila-->
							<td><a href="{{ urlFor('user.profile', {username: user.username}) }}">{{ user.username }}</a></td>

							<!--Provjera da li korisnik ima puno ime i prezime i ispis ako ima-->
							<td>{{ user.getFullname ? user.getFullname : 'No' }}</td> 
							
							<td>{{ user.isAdmin ? 'Admin' : 'No' }}</td> <!--Provjera korisnikovih priviliegija-->
						
							<td>{{ user.isModerator ? 'Moderator' : 'No' }}</td> <!--Provjera korisnikovih priviliegija-->
							
							<td>{{ user.canPostTopic ? 'Yes' : 'No' }}</td> <!--Provjera korisnikovih priviliegija-->
						</tr>
					</tbody>
				</table>
			</div>
		{% endfor %}

	{% endif %}

{% endblock %}