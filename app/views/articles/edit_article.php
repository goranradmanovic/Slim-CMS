{% extends 'templates/default.php' %}

{% block title %} Edit Article {% endblock %}

{% block content %}

	<div>
		<label for="titles">Titles</label>
		{% for title in titles %}
			<button type="submit" id="titles"><a href="{{ urlFor('articles.edit') }}?id={{ title.id }}">{{ title.title }}</a></button>
		{% endfor %}
	</div>

	{% if articles %} <!--Ako postoji clanak u bazi sa specificnim id dohvatamo taj clanak na get routu i saljemo ga ovamo u articles var.-->
		{% for article in articles %} <!--Prolaz korz sve el. clanka-->
			<form action="{{ urlFor('articles.edit.post') }}?id={{ article.id }}" method="post" autocomplete="off">
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
		{% endfor %}
	{% endif %}
{% endblock %}