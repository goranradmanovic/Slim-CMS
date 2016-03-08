{% extends 'templates/default.php' %}

{% block title %} Edit Article {% endblock %}

{% block content %}

	{% if titles is empty %}
		<p>You do not have any articles.</p>
	{% else %}
		<div>
			<h3>Click title for editing.</h3>
			<label for="titles">Titles</label>
			{% for title in titles %}

				<div class="article-info">
					<button type="submit" id="titles"><a href="{{ urlFor('articles.edit', {'uid': auth.id, 'aid': title.id}) }}">{{ title.title }}</a></button>
				
					<div class="article">
						<article>
							<h4>{{ title.title }}</h4>

							<p>Author {{ title.getArticleAuthor() }}</p>
							<span>Created</span>
							<time pubdate datetime="{{ title.created_at|date('d/m/Y @ H:i:s') }}">{{ title.created_at|date('d/m/Y @ H:i:s') }}</time>
							<p>{{ title.text[:50]}} ...</p>
						</article>

						<small><a href="{{ urlFor('articles.delete', {'id': title.id}) }}">Delete Article</a></small>
					</div>
				</div><br><hr>
				
			{% endfor %}
		</div>
	{% endif %}

	{% for article in articles %} <!--Prolaz korz sve el. clanka-->
		{% if article.id %} <!--Ako postoji clanak u bazi sa specificnim id dohvatamo taj clanak na get routu i saljemo ga ovamo u articles var.-->
			<h3>Article editing form</h3>
			<form action="{{ urlFor('articles.edit.post', {'id': article.id}) }}" method="post" autocomplete="off">
				<div>
					<label for="title">Title</label>
					<input type="text" name="title" id="title" value="{{ article.title }}">
					{% if errors.has('title') %}{{ errors.first('title') }}{% endif %}
				</div>

				<div>
					<label for="content">Content</label>
					<textarea name="text" id="content">{{ article.text }}</textarea>
					{% if errors.has('text') %}{{ errors.first('text') }}{% endif %}
				</div>

				<div>
					<input type="submit" value="Edit">
					<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
				</div>
			</form>
		{% endif %}
	{% endfor %}

{% endblock %}