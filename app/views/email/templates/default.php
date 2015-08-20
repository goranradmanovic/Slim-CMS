{# Provjeravamo da li je korisnik autentificiran i potvrdjen i ako jeste prikazujemo mu pozdravnu poruku na svim templetima #}

{% if auth %}
	<p>Hello {{ auth.getFullNameOrUsername() }},</p>
{% else %}
	<p>Hello there,</p>
{% endif %}

{# Content block gdje stavljamo sadrzaj email-a #}

{% block content %}{% endblock %}