{% extends 'templates/default.php' %}

{% block title %} Albums {% endblock %}

{% block content %}
	
	<div class="albums">

		<ul>
			<li><a href="{{ urlFor('albums.create_album') }}">+ Create Album</a></li>
			<li><a href="#">Add Photos</a></li>
		</ul>

		<div class="">
			<ul>
				<li><a href="#">Your Photos</a></li>
				<li><a href="{{ urlFor('ablums.all_albums') }}">Albums</a></li>
			</ul>
		</div>

		{% for album in albums %}

			<div class="album">
				
				<img src="" alt="Album photos">

				<a href="">{{ album.title }}</a>

			</div>

		{% endfor %}
	</div>
{% endblock %}