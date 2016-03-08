{% extends 'templates/default.php' %}

{% block title %}Image Upload{% endblock %}

{% block content %}
	<form action="{{ urlFor('upload.post') }}" method="post" enctype="multipart/form-data" autocomplete="off">
		
		<div>
			<label for="photo-title">Photo Title</label>
			<input type="text" name="img_title" id="photo-title" placeholder="Enter photo title" required>
			{% if errors.has('img_title') %}{{ errors.first('img_title') }}{% endif %}
		</div>

		<div>
			<label for="input-file">File Input</label>
			<input type="file" name="picture" id="input-file" required><br/>
			<small>You can attach files up to 1MB</small>
			{% if errors.has('picture') %}{{ errors.first('picture') }}{% endif %}
		</div>

		<div>
			<input type="hidden" name="MAX_FILE_SIZE" value="1048576"> <!--Ogranicavanje velicine fajla za slanje-->
			<input type="submit" value="Upload">
			<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
		</div>
	</form>
{% endblock %}