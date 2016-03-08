{% extends 'templates/default.php' %}

{% block title %}Article{% endblock %}

{% block content %}
	<form action="{{ urlFor('article.post') }}" method="post" autocomplete="off">
		<div>
			<label for="title">Title</label>
			<input type="text" name="title" id="title" {% if request.post('title') %} value="{{ request.post('title') }}" {% endif %}>
			{% if errors.has('title') %} {{ errors.first('title') }} {% endif %}
		</div>

		<div>
			<label for="article">Article</label>
			<textarea name="article" id="article"></textarea>
			{% if errors.has('article') %} {{ errors.first('article') }} {% endif %}
		</div>

		<div>
			<input type="submit" value="Publish">
			<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
		</div>
	</form>
{% endblock %}