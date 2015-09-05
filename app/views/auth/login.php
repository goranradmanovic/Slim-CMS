{% extends 'templates/default.php' %}

{% block title %}Login{% endblock %}

{% block content %}
	<form action="{{ urlFor('login.post') }}" method="post" autocomplete="off">
		<div>
			<label for="identifier">Username/Email</label>
			<input type="text" name="identifier" id="identifier">
			{% if errors.has('identifier') %}{{ errors.first('identifier') }}{% endif %}
		</div>

		<div>
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
			{% if errors.has('password') %}{{ errors.first('password') }}{% endif %}
		</div>

		<div>
			<input type="checkbox" name="remember" id="remember"><label for="remember">Remember me</label>
		</div>

		<div>
			<input type="submit" value="Log in">
			<!--Csrf token i zastita,prebacivanje imena tokena i vrijednosti iz CsrfMiddleware-a-->
			<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

			<a href="{{ urlFor('password.recover') }}">Forgot your password?</a>
		</div>
	</form>
{% endblock %}