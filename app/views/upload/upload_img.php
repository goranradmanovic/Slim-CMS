{% extends 'templates/default.php' %}

{% block title %}Image Upload{% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<div class="back pull-left">
						<a href="{{ urlFor('home') }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					<h3 class="panel-title">Upload your Profile Photo</h3>
				</div>
				<div class="panel-body">
					<form action="{{ urlFor('upload.post') }}" method="post" enctype="multipart/form-data" autocomplete="off" class="form-horizontal" id="UserUploadProfileImage">
						<div class="form-group{{ (errors.has('img_title')) ? ' has-error' : '' }}">
							<label for="inputEmail3" class="col-sm-2 control-label">Photo Title</label>
							<div class="col-sm-10">
								<input type="text" name="img_title" class="form-control" id="inputEmail3 FileInput" placeholder="Enter your Photo Title" required>
								{% if errors.has('img_title') %}
									<span class="help-block">{{ errors.first('img_title') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group{{ errors.has('picture') ? ' has-error' : '' }}">
							<label for="exampleInputFile" class="col-sm-2 control-label">File input</label>
							<div class="col-sm-10">
								<input type="file" name="picture" required id="photos_upload" id="exampleInputFile">
								<small><p class="help-block">You can attach files up to 1MB.</p></small>
								{% if errors.has('picture') %}
									<span class="help-block">{{ errors.first('picture') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default" id="submitBtn">Upload Photo</button>
								<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
								<input type="hidden" name="MAX_FILE_SIZE" value="1048576"> <!--Ogranicavanje velicine fajla za slanje-->
							</div>
						</div>

						<!--Upload progress bar-->
						<div class="progress progress-hide" id="progress">
							<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" id="progress-bar">
								<span class="sr-only" id="percent"></span>
							</div>
						</div>
						<div class="alert alert-info progress-hide text-center" role="alert" id="info-message"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
{% endblock %}