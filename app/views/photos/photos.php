{% extends 'templates/default.php' %}

{% block title %} Photos {% endblock %}

{% block content %}
	
	<div class="photos">
		
		<ul>
			<li><a href="{{ urlFor('photos.create_album') }}">+ Create Album</a></li>
			<li><a href="#">Add Photos</a></li>
		</ul>

		<div class="">
			<ul>
				<li><a href="#">Your Photos</a></li>
				<li><a href="#">Albums</a></li>
			</ul>
		</div>
	</div>

{% endblock %}