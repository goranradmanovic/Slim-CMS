{% extends 'templates/default.php' %}

{% block title %}404{% endblock %}

{% block content %}
	<!--Adding full 404 error page -->
	<div class="row">
		<div class="col-md-12">
			<img src="{{ baseUrl }}{{ public }}assets/icons/404.svg" alt="404 image" class="svgfondo"/>
		</div>
	</div>
{% endblock %}