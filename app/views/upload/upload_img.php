{% extends 'templates/default.php' %}

{% block title %}Image Upload{% endblock %}

{% block content %}
	<form action="{{ urlFor('upload.post') }}" method="post" enctype="multipart/form-data" autocomplete="off">
		
		<div>
			<label for="photo-title">Photo Title</label>
			<input type="text" name="title" id="photo-title" placeholder="Enter photo title" required>
			{% if errors.has('title') %}{{ errors.first('title') }}{% endif %}
		</div>

		<div>
			<label for="input-file">File Input</label>
			<input type="file" name="picture" id="input-file" required>
		</div>

		<div>
			<input type="hidden" name="MAX_FILE_SIZE" value="30000"> <!--Ogranicavanje velicine fajla za slanje-->
			<input type="submit" value="Upload">
			<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
		</div>
	</form>
{% endblock %}