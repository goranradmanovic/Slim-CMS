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
					<h3 class="text-center">Admin/Moderator Ratio</h3>

					{# Setiramo inicijalne vrijednosti var. za admina i moderatora #}
					{% set admin = 0 %}
					{% set moderator = 0 %}

					{# Provjeravamo da li nam stizu podatci sa routa o korisnicima #}
					{% if users %}
						{# Prolaz kroz niz sa podacima o korisnicima #}
						{% for user in users %}
							{# Provjera da li korisnik ima Admin priviligije i dodavanje 1 na admin var. u suprotnome dodajemo 1 na moderator var i tako racanumo koliko imamo admina ili moderatora #}
							{% if user.isAdmin %}
								{% set admin = admin + 1 %}
							{% else %}
								{% set moderator = moderator + 1 %}
							{% endif %}
						{% endfor %}
					{% endif %}

					{% set vars = [admin, moderator] %}
					
					<div class="ct-chart ct-golden-section"></div>

					<div class="map">
						<p><span class="dot red"></span> Admin</p>
						<p><span class="dot light-red"></span> Moderator</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		//Varijable za prebacivanje vrijednosti iz Twig.a i JS
		var admin = "{{ admin }}";
		var moderator = "{{ moderator }}";

		var data = {
			//labels: ['Bananas', 'Apples', 'Grapes'],
			series: [admin, moderator]
		};

		var options = {
			labelInterpolationFnc: function(value) {
				return value[0]
			}
		};

		var responsiveOptions = [
			['screen and (min-width: 640px)', {
				chartPadding: 30,
				labelOffset: 100,
				labelDirection: 'explode',
				labelInterpolationFnc: function(value) {
					return value;
				}
		}],
		['screen and (min-width: 1024px)', {
				labelOffset: 80,
				chartPadding: 20
			}]
		];

		new Chartist.Pie('.ct-chart', data, options, responsiveOptions);
	</script>
{% endblock %}