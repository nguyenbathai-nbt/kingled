<div class="" style="margin: auto 1%">
    <div class="row">
        <div class="" style="height: 100px;margin-left: 20px">
            <div class="">
                <div class="col-xs-2 col-md-1" style="height: 100px">
                    <img src="http://placehold.it/80" class="img-circle img-responsive" alt=""
                         style="text-align: center;"></div>
                <div class="col-xs-10 col-md-4">
                    <div>
                        <h4>{{ recipient_name }}</h4>
                        <div class="mic-info">
                           {{ total_badge }} badge, {{ total_issuer }} issuer
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">


    </div>
    <div class="" style="margin-bottom: 10px">

        <section class="content-header" style="padding-top: 0px">
            <h1>
                MY BADGES

            </h1>
{#            <ol class="breadcrumb" style="margin: 0px 0px;padding: 0px 0px;top: -15px;">#}
{#                <a class="btn btn-info">Image view</a>#}
{#                <a class="btn btn-info">List view</a>#}
{#            </ol>#}
        </section>
    </div>
    <div class="row boder-badge">
        {% for item in list_badge %}
            {% if loop.index % 5 is 1 %}
                <div class="row row-dont-has-margin" style="padding-bottom: 0px;">
            {% endif %}
            <a href="/badge/info/{{ item.getAssertionId() }}">
                <div class="card col-md-2 col-xs-3 col-sm-3 mini-badge">
                    <div style="margin-top: 10px">
                        <img class="card-img-top" src="{{ item.getABadgeImageUri() }}"
                             alt="Card image cap" style="width: 100%">
                        <div class="card-body">
                            <h5 class="card-title">{{ item.getGroupName() }}</h5>
                            <p class="card-text">{{ item.getABadgeDescription() }}</p>

                        </div>
                    </div>

                </div>
            </a>
            {% if  loop.index % 5 is 0 %}
                </div>
            {% endif %}
            {% if loop.last % 5 is not 0 %}
                {{ "</div>" }}
            {% endif %}
        {% endfor %}


    </div>


</div>