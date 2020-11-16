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


    {{ partial('html/scripts') }}
    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>