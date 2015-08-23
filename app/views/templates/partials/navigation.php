<!--Navigacija stranice-->

<menu>
	<ul>
		<li><a href="{{ urlFor('home') }}">Home</a></li>

		<li><a href="{{ urlFor('register') }}">Register</a></li>
		<li><a href="{{ urlFor('login') }}">Login</a></li>
		<li><a href="{{ urlFor('logout') }}">Logout</a></li>
		<li><a href="{{ urlFor('user.profile', {username: auth.username}) }}">Your Profile</a></li>
	</ul>
</menu>