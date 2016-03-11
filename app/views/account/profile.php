{% extends 'templates/default.php' %}

{% block title %}Update profile{% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<div class="back pull-left">
						<a href="{{ urlFor('home') }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					<h3 class="panel-title">Update your Profile info</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ urlFor('account.profile.post') }}" method="post" autocomplete="off">
						<div class="form-group{{ (errors.has('email')) ? ' has-error' : '' }}">
							<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Enter your Email" value="{{ request.post('email') ? request.post('email') : auth.email }}">
								{% if errors.has('email') %}
									<span class="help-block">{{ errors.first('email') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group{{ (errors.has('first_name')) ? ' has-error' : '' }}">
							<label for="inputPassword3" class="col-sm-2 control-label">First Name</label>
							<div class="col-sm-10">
								<input type="text" name="first_name" class="form-control" id="inputPassword3" placeholder="Enter your First Name" value="{{ request.post('first_name') ? request.post('first_name') : auth.first_name }}">
								{% if errors.has('first_name') %}
									<span class="help-block">{{ errors.first('first_name') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group{{ (errors.has('last_name')) ? ' has-error' : '' }}">
							<label for="inputPassword3" class="col-sm-2 control-label">Last Name</label>
							<div class="col-sm-10">
								<input type="text" name="last_name" class="form-control" id="inputPassword3" placeholder="Enter your First Name" value="{{ request.post('last_name') ? request.post('last_name') : auth.last_name }}">
								{% if errors.has('last_name') %}
									<span class="help-block">{{ errors.first('last_name') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default">Update</button>
								<!--Csrf token i zastita,prebacivanje imena tokena i vrijednosti iz CsrfMiddleware-a-->
								<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
{% endblock %}