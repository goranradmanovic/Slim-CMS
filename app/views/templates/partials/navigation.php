<!--Navigacija stranice-->

{% if auth %}
	<p>Hello, {{ auth.getFullNameOrUsername }} <img src="{{ auth.getProfileImg }}" title="{{ user.img_title }}" alt="Your profile picture"></p>
{% endif %}
<menu>
	<ul>
		<li><a href="{{ urlFor('home') }}">Home</a></li>

		<!--Ako je korisnik ulogovan onda ne zelimo da prikazjemo link za register i login stranicu,
			a ako je korisnik potvrdjen autentificiran onda cemo prikazati link za logout-->

		{% if auth %}
			<li><a href="{{ urlFor('logout') }}">Logout</a></li>

			<!--Propustamo placeholder username: i vrijednost auth.username da bi se generisao link profilnu stranicu odredjenog korisnika-->
			<li><a href="{{ urlFor('user.profile', {username: auth.username}) }}">Your Profile</a></li>
			<li><a href="{{ urlFor('upload') }}">Upload Profile Picture</a></li>

			<!--Ako je korisnik admin prikazujemo mu ovaj link,a ako nije onda ga sakrijemo od njega-->
			{# {% if user.isAdmin %}

			{% endif %} #}
			
		{% else %}
			<li><a href="{{ urlFor('register') }}">Register</a></li>
			<li><a href="{{ urlFor('login') }}">Login</a></li>
		{% endif %}
	</ul>
</menu>