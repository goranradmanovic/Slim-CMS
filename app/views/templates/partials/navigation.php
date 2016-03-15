<menu class="main__menu">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand nopadding" href="{{ urlFor('home') }}"><img src="{{ baseUrl }}{{ public }}/assets/img/gr-logo.png" alt="Brand" class="brand-img"></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="{{ urlFor('home') }}">Home <span class="sr-only">(current)</span></a></li>
					<li><a href="{{ urlFor('posts.all_posts', {'id': 1}) }}">Blog</a></li>
					<li><a href="{{ urlFor('gallery', {'id': 1}) }}">Gallery</a></li>
				</ul>

				<form action="http://www.google.com/search" method="get" target="_blanck" autocomplete="off" class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" name="q" class="form-control" placeholder="Google Search">
					</div>
					<button type="submit" class="btn btn-default">Search</button>
				</form>

				<ul class="nav navbar-nav navbar-right">
					<!--Provjera ako korisnik nije autentificiran-->
					{% if not auth %}
						<li><a href="{{ urlFor('register') }}">Sign Up</a></li>
						<li><a href="{{ urlFor('login') }}">Sign In</a></li>
					{% else %}
						<li><a href="{{ urlFor('logout') }}">Sign Out</a></li>
					{% endif %}
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
</menu>