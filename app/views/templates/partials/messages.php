{% if flash.global %}
	<div class="alert alert-info" role="alert">
		<div class="global text-center">{{ flash.global }}</div>
	</div>
{% endif %}

{% if flash.danger %}
	<div class="alert alert-warning" role="alert">
		<div class="danger text-center">{{ flash.danger }}</div>
	</div>
{% endif %}