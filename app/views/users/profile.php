{% extends 'templates/default.php' %}

{% block title %} {{ user.getFullNameOrUsername }} {% endtitle %}

{% block content %}
	
	<h2>{{ user.username }}</h2>

	<img src="" alt="Profile picture for {{ user.getFullNameOrUsername }}">

	<dl>
		{% if user.getFullName %}

			<dt>Full Name</dt>
			<dd>{{ user.getFullName }}</dd>
		{% endif %}

		<dt>Email</dt>
		<dd>{{ user.email }}</dd>
	</dl>
{% endblock %}