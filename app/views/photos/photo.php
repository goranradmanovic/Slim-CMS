{% extends 'templates/default.php' %}

{% block title %}All Photos{% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<div class="back pull-left">
						<a href="{{ urlFor('albums.album_photos', {'id': photo.album_id}) }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					<h3 class="panel-title">Photo</h3>
				</div>
				<div class="panel-body">
					<div class="photo">
						<img src="{{ photo.path }}" alt="User photo.jpg" class="single__image">
					</div>
				</div>
			</div>
		</div>
	</div>
{% endblock %}