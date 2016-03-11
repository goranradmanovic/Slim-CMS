{% extends 'templates/default.php' %}

{% block title %} {{ user.getFullNameOrUsername }} {% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<div class="back pull-left">
						<a href="{{ urlFor('home') }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					User Profile
				</div>
				<div class="panel-body">
					<div class="thumbnail">
						<img src="{{ user.getProfileImg }}" title="{{ user.img_title }}" alt="Profile picture for {{ user.getFullNameOrUsername }}">
						<div class="caption center-block">
							<h3>Username: {{ user.username }}</h3>
							{% if user.getFullName %}
								<p><i class="glyphicon glyphicon-user"></i> Full Name: {{ user.getFullName }}</p>
							{% endif %}
							<p><i class="glyphicon glyphicon-envelope"></i> Email: {{ user.email }}</p>

							<p>
								<span>Upload Profile picture</span>&nbsp;
								<a href="{{ urlFor('upload') }}" class="btn btn-primary" role="button">Upload Image</a><br/><br/>

								{% if user.img_path %}
									<span>Delete Profile picture</span>&nbsp;&nbsp;
									{# Dugme za brisanje profil slike na PHP nacin #}
									{#<a href="{{ urlFor('delete_img') }}" class="btn btn-danger" role="button">Delete picture</a>#}
									<a href="#" class="btn btn-danger" id="btnDelete" role="button">Delete picture</a>
								{% endif %}
							</p>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
{% endblock %}