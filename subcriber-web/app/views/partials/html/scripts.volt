{% for script in scripts %}
    {% if substr(script, 0, 7) === "<script" %}
        {{ script }}
    {% else %}
        <script src="{{ script }}"></script>
    {% endif %}
{% endfor %}

{% if script_add is defined %}
    {% for value in script_add %}
        {% if substr(value, 0, 7) === "<script" %}
            {{ value }}
        {% else %}
            <script src="{{ value }}"></script>
        {% endif %}
    {% endfor %}
{% endif %}
