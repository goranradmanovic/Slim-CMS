{% extends 'templates/default.php' %}

{% block title %} Posts {% endblock %}

{% block content %}
	
	{% if posts is empty %}
		<p>No posts, yet</p>
	{% else %}

		{% for post in posts %}

			<div class="post">
				<h2><a href="{{ urlFor('post.show', {'postId': post.id}) }}">{{ post.title }}</a></h2>

				<p>{{ post.text[:50] }}</p>

				<div class="author">
					<p>{{ post.getArticleAuthor() }}</p>
				</div>
			</div>
			
		{% endfor %}
	{% endif %}
{% endblock %}