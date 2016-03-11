{% extends 'templates/default.php' %}

{% block title %} Edit Article {% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
	 			<div class="panel-heading text-center">
					<div class="back pull-left">
						<a href="{{ urlFor('home') }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					<h3 class="panel-title">Edit Article</h3>
				</div>
				<div class="panel-body">
					<div class="col-md-6">
						<!--Provjeravamo da li imamo nekih naslova u bazi p.,ako nemamo ispisujemo poruku,a ako imamo prolazimo kroz te naslove-->
						{% if titles is empty %}
							<div class="alert alert-info" role="alert">
								<p>You do not have any articles.</p>
							</div>
						{% else %}
							<h3 class="text-center">User Article</h3><br/>
							
							{% for title in titles %}
								<div class="panel panel-default">
									<div class="panel-heading">{{ title.title }}</div>
									<div class="panel-body">
										<p>Author: {{ title.getArticleAuthor() }}</p>
										<small>
											<span>Created:</span>
											<time pubdate datetime="{{ title.created_at|date('d/m/Y @ H:i:s') }}">{{ title.created_at|date('d/m/Y @ H:i:s') }}</time>
											</small><hr>
										<p>{{ title.text[:50]}} ...</p>
									
										<div class="panel-footer">
											<a href="{{ urlFor('articles.edit', {'uid': auth.id, 'aid': title.id}) }}" class="btn btn-info">Edit {{ title.title[:15] }}</a>&nbsp;&nbsp;
										<a href="{{ urlFor('articles.delete', {'id': title.id}) }}" class="btn btn-danger">Delete Article</a>
										</div>
									</div>
								</div>
							{% endfor %}
						{% endif %}
					</div>
					<div class="col-md-6">
						{% for article in articles %} <!--Prolaz korz sve el. clanka-->
							{% if article.id %} <!--Ako postoji clanak u bazi sa specificnim id dohvatamo taj clanak na get routu i saljemo ga ovamo u articles var.-->
								<h3 class="text-center">Article editing form</h3><br/>
			
								<form class="form-horizontal" action="{{ urlFor('articles.edit.post', {'id': article.id}) }}" method="post" autocomplete="off">
									<div class="form-group{{ errors.has('title') ? ' has-error' : '' }}">
										<label for="inputEmail3" class="col-sm-2 control-label">Title</label>
										<div class="col-sm-10">
											<input type="text" name="title" class="form-control" id="inputEmail3" placeholder="Article Title" value="{{ article.title }}">
											{% if errors.has('title') %}
												<span class="help-block">{{ errors.first('title') }}</span>
											{% endif %}
										</div>
									</div>
									<div class="form-group{{ errors.has('text') ? ' has-error' : '' }}">
										<label for="inputEmail3" class="col-sm-2 control-label">Content</label>
										<div class="col-sm-10">
											<textarea name="text" class="form-control" rows="11">{{ article.text }}</textarea>
											{% if errors.has('text') %}
												<span class="help-block">{{ errors.first('text') }}</span>
											{% endif %}
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" class="btn btn-default">Edit</button>
											<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
										</div>
									</div>
								</form>
							{% endif %}
						{% endfor %}
					</div>
				</div>
			</div>
		</div>
	</div>
{% endblock %}