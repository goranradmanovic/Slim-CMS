{% extends 'templates/default.php' %}

{% block title %} Post {% endblock%}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">		
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<div class="back pull-left">
						<a href="{{ urlFor('posts.all_posts', {'id': page}) }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					<h3 class="panel-title">Blog Post</h3>
				</div>
				<div class="panel-body">
					{% for post in post %}
						<article>
							<h2 class="text-center">{{ post.title }}</h2>
							<!--Izbjegavamo html el. i css style koji se dodaju sa Tinymce editorom.Ovo priakazuje normalni text-->
							{% autoescape %} 
								<p class="text-center">{{ post.text|raw }}</p>
							{% endautoescape %}
							<div class="author">
								<p>By <i class="glyphicon glyphicon-user"></i> {{ post.getArticleAuthor() }} on {{ post.created_at|date('d/m/Y H:m:i') }}</p>
							</div>
						</article>
					{% endfor %}
				</div>
			</div>
		</div>
	</div>
{% endblock %}