<nav>
	<ul class="pagination">
		{% if pages > 1 %}

			{% set range = 5 %}

			{% if page != 1 %}
				<li><a href="1">First</a></li>
			{% endif %}

			{% set prev = page - 1 %}

			{% if  page > 1 %}
				<li><a href="{{ prev }}" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
			{% endif %}

			{% for i in (page - range)..((page + range) + 1) %}

				{% if (i > 0) and (i <= pages) %}
					<li><a href="{{ i }}" {% if page == i %} class="selected" {% endif %}>{{ i }}</a></li>
				{% endif %}

			{% endfor %}

			{% if page != pages %}

				{% set  next = page + 1 %}

				<li><a href="{{ next }}" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
				<li><a href="{{ pages }}">Last</a></li>

			{% endif %}

		{% endif %}
	</ul>
</nav>