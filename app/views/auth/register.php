{% extends 'templates/default.php' %}

{% block title %}Register{% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<div class="back pull-left">
						<a href="{{ urlFor('home') }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					<h3 class="panel-title">Sign Up</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ urlFor('register.post') }}" method="post" autocomplete="off">
						<div class="form-group{{ (errors.has('email')) ? ' has-error' : '' }}">
							<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="inputEmail3" placeholder="Email"  name="email" id="email" {% if request.post('email') %} value="{{ request.post('email') }}" {% endif %}>
								{% if errors.has('email') %}
									<span class="help-block">{{ errors.first('email') }}</span>
								{% endif%}
							</div>
						</div>
						<div class="form-group{{ (errors.has('username')) ? ' has-error' : '' }}">
							<label for="inputEmail3" class="col-sm-2 control-label">Username</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inputEmail3" placeholder="Username"  name="username" id="email" {% if request.post('username') %} value="{{ request.post('username') }}" {% endif %}>
								{% if errors.has('email') %}
									<span class="help-block">{{ errors.first('username') }}</span>
								{% endif%}
							</div>
						</div>
						<div class="form-group{{ (errors.has('password')) ? ' has-error' : '' }}">
							<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
								<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
								{% if errors.has('password') %}
									<span class="help-block">{{ errors.first('password') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group{{ (errors.has('password_confirm')) ? ' has-error' : '' }}">
							<label for="inputPassword3" class="col-sm-2 control-label">Confirm Password</label>
							<div class="col-sm-10">
								<input type="password" name="password_confirm" class="form-control" id="inputPassword3" placeholder="Confirm Password ">
								{% if errors.has('password_confirm') %}
									<span class="help-block">{{ errors.first('password_confirm') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group{{ (errors.has('g-recaptcha-response')) ? ' has-error' : '' }}">
							<label for="inputPassword3" class="col-sm-2 control-label">Google ReCaptcha</label>
							<div class="col-sm-10">
								<div class="g-recaptcha" data-sitekey="6LdFxiETAAAAAH3BZXPQKyymErlSlbob4bn2YXNW"></div>
								{% if errors.has('g-recaptcha-response') %}
									<span class="help-block">{{ errors.first('g-recaptcha-response') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default">Sign Up</button>
								<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
{% endblock %}