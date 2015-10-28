{% extends 'templates/default.php' %}

{% block title %}Register{% endblock %}

{% block content %}
	<form action="{{ urlFor('register.post') }}" method="post" autocomplete="off">
		<div>
			<label for="email">Email</label>
			<input type="email" name="email" id="email" {% if request.post('email') %} value="{{ request.post('email') }}" {% endif %}>
			{% if errors.has('email') %} {{ errors.first('email') }} {% endif%}
		</div>

		<div>
			<label for="username">Username</label>
			<input type="text" name="username" id="username" {% if request.post('username') %} value="{{ request.post('username') }}" {% endif %}>
			{% if errors.has('username') %} {{ errors.first('username') }} {% endif %}
		</div>

		<div>
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
			{% if errors.has('password') %} {{ errors.first('password') }} {% endif %}
		</div>

		<div>
			<label for="password_confirm">Confirm password</label>
			<input type="password" name="password_confirm" id="password_confirm">
			{% if errors.has('password_confirm') %} {{ errors.first('password_confirm') }} {% endif %}
		</div>

		<div>
			<div class="g-recaptcha" data-sitekey="6LcOyw8TAAAAAN1Gi8cdHilH1RuXPXESYwR-zP5q"></div> <!--Google ReCaptcha-->
			{% if errors.has('g-recaptcha-response') %} {{ errors.first('g-recaptcha-response') }} {% endif %}
		</div>
		
		<div>
			<input type="submit" value="Register">
			<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
		</div>
	</form>
{% endblock %}