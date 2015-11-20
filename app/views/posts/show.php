{% extends 'templates/default.php' %}

{% block title %} Post {% endblock%}

{% block content %}
	<a href="{{ urlFor('posts.all_posts') }}">Back</a>

	{% for post in post %}

		<h2>{{ post.title }}</h2>

		<p>{{ post.text }}</p>

		<div class="author">
			<p>By {{ post.getArticleAuthor() }} on {{ post.created_at|date('d/m/Y H:m:i') }}.</p>
		</div> 
	{% endfor %}
{% endblock %}