{% extends 'templates/default.php' %}

{% block title %}All Photos{% endblock %}

{% block content %}
	
	<!--Ukljucivanje navigacija za slike-->
	{% include 'photos/templates/partials/photos_navigation.php' %}

	<div class="all-photos">
		<!--Provjera da li imamo neke slike-->
		{% if photos is empty %}
			<p>You do not have a single photo.</p>
		{% else %}
			<div class="photos">
				{% for photo in photos %}
					<a href="{{ urlFor('photos.photo', {'id': photo.id}) }}"><img src="{{ photo.path }}" alt="User photo.jpg" width="300px" height="300px"></a>
					<a href="{{ urlFor('delete_photo', {'id': photo.id}) }}">Delete photo</a>
				{% endfor %}
			</div>
		{% endif %}
	</div>

{% endblock %}