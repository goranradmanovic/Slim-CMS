{% extends 'templates/default.php' %}

{% block title %}Admin example{% endblock %}

{% block content %}
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="back pull-left">
						<a href="{{ urlFor('home') }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-menu-left"></i> Back</a>
					</div>
					<h3 class="panel-title text-center">Special Admin Options</h3>
				</div>
				<div class="panel-body">
					<p class="text-center">This is example views and this will be changed soon!</p>

					<div class="ct-chart ct-golden-section"></div>
					
					<hr>

					<div class="photo__info">
						<h2 class="text-center">Photo Table</h2>
						<hr/>
						<!--Provjera da li je korisnicki niz prazan koji se nalazi u routes/all.php falju u var. $users-->
						{% if photos is empty %}
							<div class="alert alert-info" role="alert">
								<p class="text-center">There is no photos, yet.</p>
							</div>
						{% else %}
							<div class="photo__table">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>User</th>
											<th>Album</th>
											<th>Image</th>
											<th>Size</th>
											<th>Type</th>
											<th>Created at</th>
										</tr>
									</thead>
									<tbody>
										<!--Prolaz kroz sve el. $users var koja je niz sa svim korisnicim aiz baze-->
										{% for photo in photos %}
											<tr>
												<td>{{ photo.user_id }}</td>
												<td>{{ photo.getAlbumTitle(album_id) }}</td>

												<!--Provjera da li korisnik ima puno ime i prezime i ispis ako ima-->
												<td><img src="{{ photo.path }}" width="30px" height="25px"></td>
												<td>{{ (photo.size < 1048576) ? photo.size // 1024 ~ ' KB' : photo.size // 1024 ~ ' MB'}}</td>
												<td>{{ photo.type }}</td>
												<td>{{ photo.created_at|date("m/d/Y") }}
											</tr>
										{% endfor %}
									</tbody>
								</table>
							</div>
						{% endif %}
					</div>
				</div>
			</div>
		</div>
	</div>
{% endblock %}