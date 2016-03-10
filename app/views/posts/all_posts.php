{% extends 'templates/default.php' %}

{% block title %} Posts {% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Blog posts</h3>
				</div>
				<div class="panel-body">
					{% if posts is empty %}
						<div class="alert alert-warning" role="alert">
							<p class="text-center">No posts, yet.</p>
						</div>
					{% else %}

						{% for post in posts %}
							<div class="list-group">
								<a href="{{ urlFor('post.show', {'postId': post.id}) }}" class="list-group-item">
									<h2 class="list-group-item-heading">{{ post.title }}</h2>
									<p class="list-group-item-text">{{ post.text[:50] }}</p>
								</a>
							</div>

							<div class="author">
								<p>By <i class="glyphicon glyphicon-user"></i> {{ post.getArticleAuthor() }}</p>
							</div>
							<hr>
						{% endfor %}
					{% endif %}
				</div>
			</div>
		</div>
	</div>
{% endblock %}