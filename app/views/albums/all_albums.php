{% extends 'templates/default.php' %}

{% block title %} Albums {% endblock %}

{% block content %}
	
	<div class="albums">

		<ul>
			<li><a href="{{ urlFor('albums.create_album') }}">+ Create Album</a></li>
			<li><a href="{{ urlFor('upload.photos') }}">Add Photos</a></li>
		</ul>

		<div class="">
			<ul>
				<li><a href="#">Your Photos</a></li>
				<li><a href="{{ urlFor('ablums.all_albums') }}">Albums</a></li>
			</ul>
		</div>

		{% for album in albums %}

			<div class="album">
				<div>
					<a href=""><img src="{{ album.getAlbumThumbnail.path }}" alt="Album photos"/></a>
				</div>

				<div>
					<a href="">{{ album.title }}</a>

					<p>{{ album.countPhotosInAlbum }} photos</p>
				</div>
			</div>

		{% endfor %}
	</div>
{% endblock %}