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
				<li><a href="{{ urlFor('photos.all_photos') }}">Your Photos</a></li>
				<li><a href="{{ urlFor('albums.all_albums') }}">Albums</a></li>
			</ul>
		</div>

		{% for album in albums %}

			<div class="album">
				<div>
					<a href="{{ urlFor('albums.album_photos', {'id': album.id}) }}">
					{% if album.getAlbumThumbnail.path is null %}
						<img src="{{ baseUrl }}{{ public }}assets/icons/Album.svg" alt="Album photos" width="200px" height="200px"/></a>
					{% else %}
						<img src="{{ album.getAlbumThumbnail.path }}" alt="Album photos" width="200px" height="200px"/></a>
					{% endif %}
				</div>

				<div>
					<a href="{{ urlFor('albums.album_photos', {'id': album.id}) }}">{{ album.title }}</a>

					<p>{{ album.countPhotosInAlbum }} photos</p>

					{% if auth %}
						<a href="#" id="btnDelete" data-identity="{{ album.id }}">Delete Album</a>
					{% endif %}
				</div>
			</div>
			<hr>
		{% endfor %}
	</div>
{% endblock %}