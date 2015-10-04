{% extends 'templates/default.php' %}

{% block title %} Create Album {% endblock %}

{% block content %}
	
	<div class="photos">
		
		<ul>
			<li><a href="{{ urlFor('upload.photos') }}">Add Photos</a></li>
		</ul>

		<div class="">
			<ul>
				<li><a href="#">Your Photos</a></li>
				<li><a href="{{ urlFor('ablums.all_albums') }}">Albums</a></li>
			</ul>
		</div>
	</div>

	<div>
		<form action="{{ urlFor('albums.create_album.post') }}" method="post" autocomplete="off">
			<div>
				<label for="album">Album Title</label>
				<input type="text" name="title" id="album" placeholder="Album Name">
				{% if errors.has('title') %} {{ errors.first('title') }} {% endif %}
			</div>

			<div>
				<input type="submit" value="Create">
				<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
			</div>
		</form>
	</div>

{% endblock %}