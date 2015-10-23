{% extends 'templates/default.php' %}

{% block title %} Album Photos {% endblock %}

{% block content %}
	
	<div class="album-photos">
		
		{% if albumPhotos is null %}
				<p>There's no photos in this album.</p>
		{% else %}
			{% for albumPhoto in albumPhotos %}
				<img src="{{ albumPhoto.path  }}" alt="Album Photo.jpg" width="200px" height="200px">
			{% endfor %}
		{% endif %}
		<a href="{{ urlFor('albums.all_albums') }}">Go back</a>
	</div>

{% endblock %}