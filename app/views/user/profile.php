{% extends 'templates/default.php' %}

{% block title %} {{ user.getFullNameOrUsername }} {% endblock %}

{% block content %}
	
	<h2>{{ user.username }}</h2>

	<img src="{{ user.getProfileImg }}" title="{{ user.img_title }}" alt="Profile picture for {{ user.getFullNameOrUsername }}">

	<dl>
		{% if user.getFullName %}

			<dt>Full Name</dt>
			<dd>{{ user.getFullName }}</dd>
		{% endif %}

		<dt>Email</dt>
		<dd>{{ user.email }}</dd>
	</dl>
{% endblock %}