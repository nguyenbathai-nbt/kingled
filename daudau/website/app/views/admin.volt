<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{ get_title() }}
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="/favicon.png" type="image/png">
    {{ stylesheet_link('/AdminLTE-2.4.10/bower_components/bootstrap/dist/css/bootstrap.min.css') }}
    {{ stylesheet_link('/AdminLTE-2.4.10/bower_components/font-awesome/css/font-awesome.min.css') }}
    {{ stylesheet_link('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}
    {{ stylesheet_link('/AdminLTE-2.4.10/dist/css/AdminLTE.css') }}
    {#    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>#}
    {#        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>#}

    {% for stylesheet in stylesheets %}
        <link rel="stylesheet" href="{{ stylesheet }}">
    {% endfor %}
    {% if stylesheetsother is defined %}
        {% for stylesheet in stylesheetsother %}
            <link rel="stylesheet" type="text/css" href="{{ stylesheet }}">
        {% endfor %}
    {% endif %}


</head>
<body class="hold-transition {{ cssClass }}">

{{ content() }}

{% for script in scripts %}
    {% if substr(script, 0, 7) === "<script" %}
        {{ script }}
    {% else %}
        <script type="text/javascript" src="{{ script }}"></script>
    {% endif %}
{% endfor %}
{% if scriptsother is defined %}
    {% for script in scriptsother %}
        {% if substr(script, 0, 7) === "<script" %}
            {{ script }}
        {% else %}
            <script src="{{ script }}"></script>
        {% endif %}
    {% endfor %}
{% endif %}

{% if script_add is defined %}
    {% for value in script_add %}
        {% if substr(value, 0, 7) === "<script" %}
            {{ value }}
        {% else %}
            <script src="{{ value }}"></script>
        {% endif %}
    {% endfor %}
{% endif %}
</body>

</html>