{% extends 'templates/default.php' %}

{% block title %} Upload Photos {% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<div class="back pull-left">
						<a href="{{ urlFor('photos.photos') }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					Upload Photos to Album
				</div>
				<div class="panel-body">
					<!--Provjera dali korisnik ima objavljenjih albuma za ucitavanje slika-->
					{% if albums is empty %}
						<div class="alert alert-info" role="alert">
							<p class="text-center">You do not have a single album.</p>
						</div>
					{% else %}
						<form action="{{ urlFor('upload.photos.post') }}" method="post" enctype="multipart/form-data" id="uploadPhotosForm" class="form-horizontal">
							<div class="form-group{{ errors.has('albums') ? ' has-error' : '' }}">
								<label for="inputEmail3" class="col-sm-2 control-label">Select Album</label>
								<div class="col-sm-10">
									<select class="btn btn-default dropdown-toggle" name="albums" required>
										<option>None Selected</option>
										{% for album in albums %}
											<option value="{{ album.id }}">{{ album.title }}</option>
										{% endfor %}
									</select>
									{% if errors.has('albums') %}
										<span class="help-block">{{ errors.first('albums') }}</span>
									{% endif %}
								</div>
							</div>
							<div class="form-group{{ errors.has('photos.name') ? ' has-error' : '' }}">
								<label for="exampleInputFile" class="col-sm-2 control-label">File input</label>
								<div class="col-sm-10">
									<input type="file" name="photos[]" multiple required id="exampleInputFile FileInput">
									<small><p class="help-block">Select your photos for upload.</p></small>
									{% if errors.has('photos.name') %}
										<span class="help-block">{{ errors.first('photos.name') }}</span>
									{% endif %}
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" id="submitBtn" class="btn btn-default">Upload Photos</button>
									<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
									<input type="hidden" name="MAX_FILE_SIZE" value="5242880" /> <!--Ogranicenje velicine fajla za slanje-->
								</div>
							</div>
						</form>

						<!--Upload progress bar-->
						<div class="progress progress-hide" id="progress">
							<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" id="progress-bar">
								<span class="sr-only" id="percent"></span>
							</div>
						</div>

						<div class="alert alert-info progress-hide text-center" role="alert" id="info-message"></div>
					{% endif %}
				</div>
			</div>
		</div>
	</div>
{% endblock %}