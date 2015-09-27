{% extends 'templates/default.php' %}

{% block title %} Post {% endblock%}

{% block content %}
	<a href="{{ urlFor('posts.all_posts') }}">Back</a>

	{% for post in post %}

		<h2>{{ post.title }}</h2>

		<p>{{ post.text }}</p>

		<div class="author">

			{% if post.first_name %}
				<p>By {{ [post.first_name, post.last_name]|join(' ') }} on {{ post.created_at }}.</p>
			{% else %}
				<p>By {{ post.username }} on {{ post.created_at }}.</p>
			{% endif %}
		</div> 
	{% endfor %}
{% endblock %}