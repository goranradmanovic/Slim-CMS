{% extends 'templates/default.php' %}

{% block title %} {{ user.getFullNameOrUsername }} {% endblock %}

{% block content %}
	<div class="row">
		<div class="col-sm-6 col-md-4 col-md-offset-4">
			<div class="thumbnail">
				<img src="{{ user.getProfileImg }}" title="{{ user.img_title }}" alt="Profile picture for {{ user.getFullNameOrUsername }}">
				<div class="caption">
					<h3>Username: {{ user.username }}</h3>
					{% if user.getFullName %}
						<p><i class="glyphicon glyphicon-user"></i> Full Name: {{ user.getFullName }}</p>
					{% endif %}
					<p><i class="glyphicon glyphicon-envelope"></i> Email: {{ user.email }}</p>

					<p>
						<span>Upload Profile picture</span>&nbsp;
						<a href="{{ urlFor('upload') }}" class="btn btn-primary" role="button">Upload Image</a><br/><br/>
						<span>Delete Profile picture</span>&nbsp;&nbsp;

						{# Dugme za brisanje profil slike na PHP nacin #}
						{#<a href="{{ urlFor('delete_img') }}" class="btn btn-danger" role="button">Button</a>#}
						<a href="#" class="btn btn-danger" id="btnDelete" role="button">Delete picture</a>
					</p>
				</div>
			</div>
		</div>
	</div>
{% endblock %}