{% extends 'email/templates/default.php' %}

{% block content %}
	<p>You have registerd!</p>

	<p>Activate your account using this link: {{ baseUrl }}{{ urlFor('activate') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}</p>
{% endblock %}

{# Na kraju aktivacijskog linka stavljamo tj. dodajemo query string uz pomoc ? zato sto saljemo sa GET Metodom i dodajemo
arg.iz register.php odakle saljemo email korisniku ['user' => $user, 'identifier' => $identifier],uz pomoc user objekta dohvatamo
korisnikovu email adrsu koju je obezbjediou u registracijskoj formi.
Twig funkcija url_encode enkodira URL identifier zato sto se u nasumicnom stringu umjesto praznog prostora pojavljuje znak +,i odmah
nam se ne slaze hash iz 'active_hash' iz baze p. sa hasom koji napravimo kad izvucemo ovaj nasumicni string iz URL-a
#}