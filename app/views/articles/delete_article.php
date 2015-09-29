{% extends 'templates/default.php' %}

{% block title %} Delete Article {% endblock %}

{% block content %}
	
	<!--Provjera da li postoji article var. koju saljemo sa delete routa-->
	{% if articles %}

		<!--Prolaz kroz sve el.aricles var.-->
		{% for article in articles %}

			<div class="article">
				<article>
					<h4>{{ article.title }}</h4>
					<span>Created</span>
					<time pubdate datetime="{{ article.created_at|date('d/m/Y @ H:i:s') }}">{{ article.created_at|date('d/m/Y @ H:i:s')  }}</time>
					<p>{{ article.text[:50]}} ...</p>
				</article>

				<a href="{{ urlFor('articles.delete') }}?id={{ article.id }}">Delete Article</a>
				<hr >
			</div>

		{% endfor %}

	{% endif %}
		
{% endblock %}