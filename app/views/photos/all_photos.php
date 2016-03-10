{% extends 'templates/default.php' %}

{% block title %}All Photos{% endblock %}

{% block content %}
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">
				<div class="back pull-left">
					<a href="{{ urlFor('photos.photos') }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
				</div>
				User Photos
			</div>
			<div class="panel-body">
				<!--Provjera dali korisnik ima objavljenjih albuma za ucitavanje slika-->
				{% if photos is empty %}
					<div class="alert alert-info" role="alert">
						<p class="text-center">You do not have a single photo.</p>
					</div>
				{% else %}
					<div class="row">
						{% for photo in photos %}
							<div class="col-xs-6 col-md-3">
								<a href="{{ urlFor('photos.photo', {'id': photo.id}) }}"><img src="{{ photo.path }}" alt="User photo.jpg" class="thumbnail thumb__img"></a>

								{# PHP nacin za brisanje slike #}
								{#<a href="{{ urlFor('delete_photo', {'id': photo.id}) }}" class="btn btn-danger btn-xs btn__delete"><i class="glyphicon glyphicon-trash"></i> Delete photo</a>#}
								<a href="#" id="btnDeleteSinglePhoto" data-identity="{{ photo.id }}" class="btn btn-danger btn-xs btn__delete"><i class="glyphicon glyphicon-trash"></i> Delete photo</a>
							</div>
						{% endfor %}
					</div>
				{% endif %}
			</div>
		</div>
	</div>
</div>
{% endblock %}