{% extends 'templates/default.php' %}

{% block title %} Home {% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<!--Korisnicke opcije (Provjera da li je korisnik autentificiran)-->
			{% if auth %}
				<div class="media user-greetings">
					<div class="media-left">
						<a href="{{ urlFor('user.profile', {'username': auth.username}) }}">
							<img class="media-object home__profile--image" src="{{ auth.getProfileImg }}" title="{{ user.img_title }}" alt="Your profile picture">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading text-info">Hello, {{ auth.getFullNameOrUsername }}</h4>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title text-center">{{ auth.isAdmin ? 'Admin Options' : 'Moderator Options'}}</h3>
					</div>
					<div class="panel-body">
						<div class="list-group">
							<!--Propustamo placeholder username: i vrijednost auth.username da bi se generisao link profilnu stranicu odredjenog korisnika-->
							<a href="{{ urlFor('user.profile', {'username': auth.username}) }}" class="list-group-item text-center">Your Profile</a>
							<a href="{{ urlFor('password.change') }}" class="list-group-item text-center">Change password</a>
							<a href="{{ urlFor('account.profile') }}" class="list-group-item text-center">Update profile</a>
							<a href="{{ urlFor('articles.article') }}" class="list-group-item text-center">Publish Article</a>
							<a href="{{ urlFor('articles.edit', {'uid': auth.id, 'aid': 0}) }}" class="list-group-item text-center">Edit Article</a><!--'uid' - user id, 'aid' - article id-->
							<a href="{{ urlFor('photos.photos') }}" class="list-group-item text-center">Photos Options</a>

							<!--Ako je korisnik admin prikazujemo mu ovaj link,a ako nije onda ga sakrijemo od njega-->
							{% if auth.isAdmin %}
								<a href="{{ urlFor('admin.example') }}" class="list-group-item text-center">Admin area</a>
								<a href="{{ urlFor('user.all') }}" class="list-group-item text-center">All users</a>
							{% endif %}
						</div>
					</div>
				</div>
			{% else %}
				<div class="panel panel-info">
					<div class="panel-heading text-center">Default credentials</div>
					<div class="panel-body">
						<div class="text-center">
							<h4>Admin</h4>
							<p>Username: admin</p>
							<p>Password: password</p>
						</div>
						<hr>
						<div class="text-center">
							<h4>Moderator</h4>
							<p>Username: moderator</p>
							<p>Password: password</p>
						</div>
					</div>
				</div>
			{% endif %}
		</div>
	</div>
{% endblock %}