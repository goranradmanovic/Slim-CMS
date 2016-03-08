{% extends 'templates/default.php' %}

{% block title %} Gallery {% endblock %}

{% block content %}
	
	<div class="gallery">
		<!--<div id="lightgallery">
			<a href="img/img1.jpg"><img src="img/thumb1.jpg" /></a>
			<a href="img/img2.jpg"><img src="img/thumb2.jpg" /></a>
		</div>-->
		<h1>Albums</h1>
		{% for album in albums %}
			<div>
				<h3>{{ album.title }}</h3>
				<a href="{{ urlFor('albums.album_photos', {'id': album.id}) }}">
					<img src="{{ album.getAlbumThumbnail.path }}" alt="Album thumbnail.jpg" width="250px" height="250px">
				</a>
				<p>Photos in album: {{ album.countPhotosInAlbum }}</p>	
			</div>
					
		{% endfor %}
	</div>

{% endblock %}