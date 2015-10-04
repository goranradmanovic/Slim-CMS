{% extends 'templates/default.php' %}

{% block title %} Photos {% endblock %}

{% block content %}
	
	<div class="photos">
		
		<ul>
			<li><a href="{{ urlFor('albums.create_album') }}">+ Create Album</a></li>
			<li><a href="{{ urlFor('upload.photos')}}">Add Photos</a></li>
		</ul>

		<div class="">
			<ul>
				<li><a href="#">Your Photos</a></li>
				<li><a href="{{ urlFor('ablums.all_albums') }}">Albums</a></li>
			</ul>
		</div>
	</div>

{% endblock %}