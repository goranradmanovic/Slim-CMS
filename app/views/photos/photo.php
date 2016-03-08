{% extends 'templates/default.php' %}

{% block title %}All Photos{% endblock %}

{% block content %}
	
	<div class="single-photo">
		<div class="photo">
			<a href="{{ urlFor('photos.all_photos') }}">Back</a>
			<img src="{{ photo.path }}" alt="User photo.jpg" width="75%" height="75%">
		</div>
	</div>

{% endblock %}