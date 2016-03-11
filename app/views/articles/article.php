{% extends 'templates/default.php' %}

{% block title %}Article{% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<div class="back pull-left">
						<a href="{{ urlFor('home') }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					<h3 class="panel-title">Publish Article</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{ urlFor('article.post') }}" method="post" autocomplete="off">
						<div class="form-group{{ (errors.has('title')) ? ' has-error' : '' }}">
							<label for="inputEmail3" class="col-sm-2 control-label">Title</label>
							<div class="col-sm-10">
								<input type="text" name="title" class="form-control" id="inputEmail3" placeholder="Enter your Article Title">
								{% if errors.has('title') %}
									<span class="help-block">{{ errors.first('title') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group{{ (errors.has('article')) ? ' has-error' : '' }}">
							<label for="inputEmail3" class="col-sm-2 control-label">Content</label>
							<div class="col-sm-10">
								<textarea name="article" id="inputEmail3" class="form-control" rows="8"></textarea>
								{% if errors.has('article') %}
									<span class="help-block">{{ errors.first('article') }}</span>
								{% endif %}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default">Publish</button>
								<!--Csrf token i zastita,prebacivanje imena tokena i vrijednosti iz CsrfMiddleware-a-->
								<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
{% endblock %}