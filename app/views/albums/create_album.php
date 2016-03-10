{% extends 'templates/default.php' %}

{% block title %} Create Album {% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<div class="back pull-left">
						<a href="{{ urlFor('photos.photos') }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					Create New Photo Album
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ urlFor('albums.create_album.post') }}" method="post" autocomplete="off">
						<div class="form-group{{ errors.has('title') ? ' has-error' : '' }}">
							<label for="inputEmail3" class="col-sm-2 control-label">Album Name</label>
							<div class="col-sm-10">
								<input type="text" name="title" class="form-control" id="inputEmail3" placeholder="Enter Album Name">
								{% if errors.has('title') %}
									<span class="help-block">{{ errors.first('title') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default">Create</button>
								<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
{% endblock %}