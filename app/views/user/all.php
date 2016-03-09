{% extends 'templates/default.php' %}

{% block title %}All users{% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
  				<div class="panel-body">
					<h2 class="text-center">All users table</h2>
					<hr/>
					<!--Provjera da li je korisnicki niz prazan koji se nalazi u routes/all.php falju u var. $users-->
					{% if users is empty %}
						<div class="alert alert-info" role="alert">
							<p class="text-center">No registered users.</p>
						</div>
					{% else %}
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Picture</th>
									<th>Username</th>
									<th>Full name</th>
									<th>Active</th>
									<th>Admin</th>
									<th>Moderator</th>
									<th>Can post content</th>
								</tr>
							</thead>
							<tbody>
								<!--Prolaz kroz sve el. $users var koja je niz sa svim korisnicim aiz baze-->
								{% for user in users %}
									<tr>
										<!--Dohvatanje korisnikove profilne slike-->

										<td><img src="{{ user.getProfileImg }}" alt="User_profile.jpg" class="table__user--image"></td>

										<!--Link do korisnikovog profila-->
										<td><a href="{{ urlFor('user.profile', {username: user.username}) }}">{{ user.username }}</a></td>

										<!--Provjera da li korisnik ima puno ime i prezime i ispis ako ima-->
										<td>{{ user.getFullname ? user.getFullname : 'No' }}</td>

										<td>{{ user.active ? 'Yes' : 'No'}}</td>
										
										<td>{{ user.isAdmin ? 'Yes' : 'No' }}</td> <!--Provjera korisnikovih priviliegija-->
									
										<td>{{ user.isModerator ? 'Yes' : 'No' }}</td> <!--Provjera korisnikovih priviliegija-->
										
										<td>{{ user.canPostTopic ? 'Yes' : 'No' }}</td> <!--Provjera korisnikovih priviliegija-->
									</tr>
								{% endfor %}
							</tbody>
						</table>
					</div>
					<!--Linkovi za PDF I XLSX prikaz tabele-->
					<div class="text-center">
						<a href="{{ urlFor('assets.pdf') }}" download>PDF table</a>&nbsp;&nbsp;
						<a href="{{ urlFor('assets.xlsx') }}" download>XLSX table</a>
					</div>	
				</div>
			</div>
		</div>
	{% endif %}
{% endblock %}