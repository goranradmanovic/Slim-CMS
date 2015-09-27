{% extends 'templates/default.php' %}

{% block title %} Post {% endblock%}

{% block content %}
	<a href="{{ urlFor('home') }}">Back</a>

	<h2>{{ post.title }}</h2>

	<p>{{ post.text }}</p>

	<div class="author">
		<p>By {{ post.getUsernameOrFullName() }} on {{ post.created_at }}.</p>
	</div>
	
{% endblock %}