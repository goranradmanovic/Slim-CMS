{% extends 'templates/default.php' %}

{% block title %} Post {% endblock%}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="well well-lg">
				<a href="{{ urlFor('posts.all_posts') }}"><i class="glyphicon glyphicon-menu-left"></i> Back</a>

				{% for post in post %}
					<article>
						<h2 class="text-center">{{ post.title }}</h2>
						<p class="text-center">{{ post.text }}</p>

						<div class="author">
							<p>By <i class="glyphicon glyphicon-user"></i> {{ post.getArticleAuthor() }} on {{ post.created_at|date('d/m/Y H:m:i') }}</p>
						</div>
					</article>
				{% endfor %}
			</div>
		</div>
	</div>
{% endblock %}