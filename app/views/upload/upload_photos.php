{% extends 'templates/default.php' %}

{% block title %} Upload Photos {% endblock %}

{% block content %}
	
	<form action="{{ urlFor('upload.photos.post') }}" method="post" enctype="multipart/form-data">
		<div>
			<label for="album">Select Album</label>
			<select name="albums" id="album">
				<option>---</option>

				{% for album in albums %}
					<option value="{{ album.id }}">{{ album.title }}</option>
				{% endfor %}
			</select>
			{% if errors.has('album') %} {{ errors.first('album') }} {% endif %}
		</div>

		<div>
			<label for="photos_upload">Upload Photos</label>
			<input type="file" name="photos[]" multiple="multiple" id="photos_upload">
			{% if errors.has('photos') %} {{ errors.first('photos') }} {% endif %}
		</div>

		<div>
			<input type="submit" value="Upload Photos">
			<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
			<input type="hidden" name="MAX_FILE_SIZE" value="30000" /> <!--Ogranicenje velicine fajla za slanje-->
		</div>
	</form>

{% endblock %}