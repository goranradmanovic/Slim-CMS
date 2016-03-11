{% extends 'templates/default.php' %}

{% block title %}Admin example{% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="back pull-left">
						<a href="{{ urlFor('home') }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					<h3 class="panel-title text-center">Special Admin Options</h3>
				</div>
				<div class="panel-body">
					<p class="text-center">This is example views and this will be changed soon!</p>
				</div>
			</div>
		</div>
	</div>
{% endblock %}