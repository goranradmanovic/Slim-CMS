{% extends 'templates/default.php' %}

{% block title %}Reset password{% endblock %}

{% block content %}
	<!--<h3>Enter your new password.</h3>
	
	<form action="{{ urlFor('password.reset.post') }}?email={{ email }}&identifier={{ identifier|url_encode }}" method="post" autocomplete="off">
		<div>
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
			{% if errors.has('password') %}{{ errors.first('password') }}{% endif %}
		</div>

		<div>
			<label for="password_confirm">Confirm Password</label>
			<input type="password" name="password_confirm" id="password_confirm">
			{% if errors.has('password_confirm') %}{{ errors.first('password_confirm') }}{% endif %}
		</div>

		<div>
			<input type="submit" value="Change password">
			<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
		</div>
	</form> -->

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title text-center">Reset your new password</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ urlFor('password.reset.post') }}?email={{ email }}&identifier={{ identifier|url_encode }}" method="post" autocomplete="off">

						<div class="form-group{{ errors.has('password') ? ' has-error' : '' }}">
							<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
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