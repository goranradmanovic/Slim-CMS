{% extends 'templates/default.php' %}

{% block title %}Login{% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<form class="form-horizontal" action="{{ urlFor('login.post') }}" method="post" autocomplete="off">
						<div class="form-group{{ (errors.has('identifier')) ? ' has-error' : '' }}">
							<label for="inputEmail3" class="col-sm-2 control-label">Username/Email</label>
							<div class="col-sm-10">
								<input type="text" name="identifier" class="form-control" id="inputEmail3" placeholder="Enter your Username or Email">
								{% if errors.has('identifier') %}
									<span class="help-block">{{ errors.first('identifier') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group{{ (errors.has('password')) ? ' has-error' : '' }}">
							<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-10">
								<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Enter your Password">
								{% if errors.has('password') %}
									<span class="help-block">{{ errors.first('password') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember me
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="">
									<label>
										<a href="{{ urlFor('password.recover') }}">Forgot your password ?</a>
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default">Sign in</button>
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