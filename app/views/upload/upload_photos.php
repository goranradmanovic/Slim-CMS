{% extends 'templates/default.php' %}

{% block title %} Upload Photos {% endblock %}

{% block content %}

	<!--Ukljucivanje potos navigacije-->
	{% include 'photos/templates/partials/photos_navigation.php' %}
	
	<!--Provjera dali korisnik ima objavljenjih albuma za ucitavanje slika-->
	{% if albums is empty %}
		<p>You do not have a single album.</p>
	{% else %}
		<form action="{{ urlFor('upload.photos.post') }}" method="post" enctype="multipart/form-data">
			<div>
				<label for="album">Select Album</label>
				<select name="albums" id="album" required>
					<option value="">None</option>

					{% for album in albums %}
						<option value="{{ album.id }}">{{ album.title }}</option>
					{% endfor %}
				</select>
				{% if errors.has('albums') %} {{ errors.first('albums') }} {% endif %}
			</div>


			<div>
				<label for="photos_upload">Upload Photos</label>
				<input type="file" name="photos[]" multiple required id="photos_upload">
				{% if errors.has('photos.name') %} {{ errors.first('photos.name') }} {% endif %}
			</div>

			<div>
				<input type="submit" value="Upload Photos">
				<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
				<input type="hidden" name="MAX_FILE_SIZE" value="5242880" /> <!--Ogranicenje velicine fajla za slanje-->
			</div>
		</form>
	{% endif %}
{% endblock %}