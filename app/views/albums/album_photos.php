{% extends 'templates/default.php' %}

{% block title %} Album Photos {% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<div class="back pull-left">
						<a href="{{ urlFor('gallery', {'id': gid}) }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					All Album Photos
				</div>
				<div class="panel-body">
					<!--Provjera dali korisnik ima objavljenjih albuma za ucitavanje slika-->
					{% if albumPhotos is empty %}
						<div class="alert alert-info" role="alert">
							<p class="text-center">There's no photos in this album.</p>
						</div>
					{% else %}
						<div class="row">
							{% for albumPhoto in albumPhotos %}
								<div class="col-xs-6 col-md-3">
									<a href="{{ urlFor('photos.photo', {'id': albumPhoto.id, 'gid': gid, 'aid': page}) }}"><img src="{{ albumPhoto.path  }}" alt="Album Photo.jpg" class="thumbnail thumb__img"></a>
								</div>
							{% endfor %}
						</div>
					{% endif %}
				</div>
			</div>

			<!--Ukljucujemo paginaciju samo ako ima nekih slika u odredjenom Albumu-->
			{% if not albumPhotos is empty %}
				<!--Ukljucivanje paginacije st.-->
				{% include 'templates/partials/pagination.php' %}
			{% endif %}
		</div>
	</div>
{% endblock %}