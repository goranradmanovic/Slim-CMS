{% extends 'templates/default.php' %}

{% block title %}All Photos{% endblock %}

{% block content %}
	
	<div class="all-photos">
		<div class="photos">
			{% for photo in photos %}
				<a href="{{ urlFor('photos.photo', {'id': photo.id}) }}"><img src="{{ photo.path }}" alt="User photo.jpg" width="300px" height="300px"></a>
				<a href="{{ urlFor('delete_photo', {'id': photo.id}) }}">Delete photo</a>
			{% endfor %}
		</div>
	</div>

{% endblock %}