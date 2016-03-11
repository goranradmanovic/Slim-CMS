{% extends 'templates/default.php' %}

{% block title %} Albums {% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<div class="back pull-left">
						<a href="{{ urlFor('photos.photos') }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					User Albums
				</div>
				<div class="panel-body">
					<!--Provjera dali korisnik ima objavljenjih albuma za ucitavanje slika-->
					{% if albums is empty %}
						<div class="alert alert-info" role="alert">
							<p class="text-center">You do not have a single album.</p>
						</div>
					{% else %}
						<div class="row">
							{% for album in albums %}
								<div class="col-xs-6 col-md-3">
									<div class="album">
										<a href="{{ urlFor('albums.album_photos', {'id': album.id}) }}">
											<!--Provjera da li ne postoji slika u albumu i onda prikazivanje defaultne slike albuma-->
											<img src="{{ not album.getAlbumThumbnail.path ? album.getAlbumThumbnail : album.getAlbumThumbnail.path }}" alt="Album photos" class="album__thumb"/>
										</a>
									</div>
									<a href="{{ urlFor('albums.album_photos', {'id': album.id}) }}" class="btn btn-primary album__title">{{ album.title[:14] }} <span class="badge">{{ album.countPhotosInAlbum }} photos</span></a>

									{# PHP nacin za brisanje slike #}
									{#<a href="{{ urlFor('albums.delete_album', {'id': album.id}) }}" class="btn btn-danger btn-xs btn__delete"><i class="glyphicon glyphicon-trash"></i> Delete album</a>#}
									{% if auth %}
										<a href="#" id="btnDeleteAlbum" data-identity="{{ album.id }}" class="btn btn-danger btn-xs btn__delete"><i class="glyphicon glyphicon-trash"></i> Delete album</a>
									{% endif %}
								</div>
							{% endfor %}
						</div>
					{% endif %}
				</div>
			</div>
		</div>
	</div>
{% endblock %}