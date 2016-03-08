{% extends 'templates/default.php' %}

{% block title %}Recover password{% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading text-center">Enter your email address to start your password recovery.</div>
					<div class="panel-body">
					<form class="form-horizontal" action="{{ urlFor('password.recover.post') }}" method="post" autocomplete="off">
						<div class="form-group{{ (errors.has('email')) ? ' has-error' : '' }}">
							<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Enter your email" {% if request.post('email') %} value="{{ request.post('email') }}" {% endif %}>
								{% if errors.has('email') %}
									<span class="help-block">{{ errors.first('email') }}</span>
								{% endif %}
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default">Request reset</button>
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