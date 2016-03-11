{% extends 'templates/default.php' %}

{% block title %}Change password{% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="back pull-left">
						<a href="{{ urlFor('home') }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					<h3 class="panel-title text-center">Change Password</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ urlFor('password.change.post') }}" method="post" autocomplete="off">
						<div class="form-group{{ errors.has('password_old') ? ' has-error' : '' }}">
							<label for="inputPassword3" class="col-sm-2 control-label">Old Pass</label>
							<div class="col-sm-10">
								<input type="password" name="password_old" class="form-control" id="inputPassword3" placeholder="Enter your Old Password">
								{% if errors.has('password_old') %}
									<span class="help-block">{{ errors.first('password_old') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group{{ errors.has('password') ? ' has-error' : '' }}">
							<label for="inputPassword3" class="col-sm-2 control-label">New Pass</label>
							<div class="col-sm-10">
								<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Enter your New Password">
								{% if errors.has('password') %}
									<span class="help-block">{{ errors.first('password') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group{{ errors.has('password_confirm') ? ' has-error' : '' }}">
							<label for="inputPassword3" class="col-sm-2 control-label">Confirm Pass</label>
							<div class="col-sm-10">
								<input type="password" name="password_confirm" class="form-control" id="inputPassword3" placeholder="Confirm New Password">
								{% if errors.has('password_confirm') %}
									<span class="help-block">{{ errors.first('password_confirm') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default">Change</button>
								<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
{% endblock %}