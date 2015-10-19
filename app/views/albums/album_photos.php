{% extends 'templates/default.php' %}

{% block title %} Album Photos {% endblock %}

{% block content %}
	
	<div class="album-photos">
		
		{% for albumPhoto in albumPhotos %}
			
			<img src="{{ albumPhoto.path }}" alt="Album Photo.jpg" width="200px" height="200px">

		{% endfor %}

		<a href="{{ urlFor('albums.all_albums') }}">Go back</a>
	</div>

{% endblock %}