<section class="content-header">
    <h1>
        {% for name in names %}
            {% if loop.last %}
                {{ helper.translate(name['label']) }}
            {% endif %}
        {% endfor %}
        <!--        <small>Version 2.0</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa "></i> {{ helper.translate('Home') }}</a></li>
        {% for name in names %}
            <li class="active">
                {{ link_to(name['href'], helper.translate(name['label'])) }}
            </li>
        {% endfor %}
    </ol>
</section>
<div class="container-fluid" style="margin-top: 15px">
    {{ this.flashSession.output() }}
</div>