<div class="setting-page-container">
    <div class="page-container container" style="padding-top: 0px">
        {% set user = session.get('auth-site-home') %}
        <div class="page-account-info">
            <div class="panel-group ng-scope" ng-app="userProfileApp">
                <div class="panel panel-default ng-scope" style="min-height:400px;" ng-controller="UserRecipeCtrl">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#my-account-container" href="#thong-tin"
                               target="_self">
                                <span class="glyphicon glyphicon-list-alt text-highlight"></span> Công thức của tôi
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse in">
                        <div class="m-recipe-toolbar">
                            <ul>
                                <li><a id="confirmed-recipe" href="javascript:void(0)" target="_self"
                                       class="active-menu"><span
                                                class="menuitem-text"> Đã duyệt</span> </a></li>
                                <li><a id="confirm-recipe" href="javascript:void(0)" target="_self"><span
                                                class="menuitem-text"> Đang duyệt</span></a></li>
                                <li><a id="reject-recipe" href="javascript:void(0)" target="_self"><span
                                                class="menuitem-text"> Từ chối</span> </a></li>
                                {#                                <li><a id="all-recipe" href="javascript:void(0)" target="_self" >#}
                                {#                                        <span class="menuitem-text"> Tất cả</span></a></li>#}
                            </ul>
                        </div>
                        <div id="list-confirmed-recipe" class="panel-body clearfix ">
                            <div>
                                <ul class="list-unstyled m-recipe-list">
                                    {% if list_recipe_approved is not null %}
                                        {% for item in list_recipe_approved %}
                                            <li class="m-recipe-item  ng-scope not-submitted">
                                                <div class="m-recipe-item-inner">
                                                    <div class="photo">
                                                        <a href="/cong-thuc/{{ item.getCode() }}.html">
                                                            <img style="height:auto" class="img-responsive"
                                                                 src="{{ item.image.image_base }}">
                                                        </a>
                                                    </div>
                                                    <div class="item-info">
                                                        <h4><a class="ng-binding"
                                                               href="/cong-thuc/{{ item.getCode() }}.html">{{ item.getName() }}</a>
                                                        </h4>
                                                        <div class="item-stats">
                                                            <ul class="list-inline nomargin">
                                                                <li>
                                                                    <span class="stats-count ng-binding">{{ item.totalSeemRecipe(item.getId()) }}</span>
                                                                    lượt xem
                                                                </li>
                                                                <li>
                                                                    <span class="stats-count ng-binding">{{ item.getBookmarkTotal() }}</span>
                                                                    thích
                                                                </li>
                                                                <li class="ng-binding"><span
                                                                            class="stats-count"> - </span>{{ item.getCreatedTime() }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="desc ng-binding" ng-bind-html="item.Description | to_trusted_html">Mô tả: {{ item.getDescription() }}
                                                        </div>
                                                    </div>
                                                    <a ng-href="/cong-thuc/tao-cong-thuc/50465" href="/cong-thuc/chinh-sua/{{ item.getCode() }}.html">
                                                        <span class="glyphicon glyphicon-pencil"></span><span> Chỉnh sửa</span>
                                                    </a>
                                                    <br>
                                                    <a href="/tai-khoan/xoa-cong-thuc/{{ item.getId() }}" class="confirm_dialog" id="btn-remove-recipe" name="{{ item.getId() }}">
                                                        <span class="glyphicon glyphicon-trash"></span><span> Xóa</span>
                                                    </a>
                                                </div>
                                            </li>
                                        {% endfor %}
                                    {% endif %}
                                </ul>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div id="list-confirm-recipe" class="panel-body clearfix ng-hide">
                            <div>
                                <ul class="list-unstyled m-recipe-list">
                                    {% if list_recipe_confirm is not null %}
                                        {% for item in list_recipe_confirm %}
                                            <li class="m-recipe-item  ng-scope not-submitted">
                                                <div class="m-recipe-item-inner">
                                                    <div class="photo">
                                                        <a href="/cong-thuc/{{ item.getCode() }}.html">
                                                            <img style="height:auto" class="img-responsive"
                                                                 src="{{ item.image.image_base }}">
                                                        </a>
                                                    </div>
                                                    <div class="item-info">
                                                        <h4><a class="ng-binding"
                                                               href="/cong-thuc/{{ item.getCode() }}.html">{{ item.getName() }}</a>
                                                        </h4>
                                                        <div class="item-stats">
                                                            <ul class="list-inline nomargin">
                                                                <li>
                                                                    <span class="stats-count ng-binding">{{ item.getSeenTotal() }}</span>
                                                                    lượt
                                                                    xem
                                                                </li>
                                                                <li>
                                                                    <span class="stats-count ng-binding">{{ item.getBookmarkTotal() }}</span>
                                                                    thích
                                                                </li>
                                                                <li class="ng-binding"><span
                                                                            class="stats-count"> - </span>{{ item.getCreatedTime() }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="desc ng-binding">Mô tả: {{ item.getDescription() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        {% endfor %}
                                    {% endif %}

                                </ul>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div id="list-reject-recipe" class="panel-body clearfix ng-hide">
                            <div>
                                <ul class="list-unstyled m-recipe-list">
                                    {% if list_recipe_reject is not null %}
                                        {% for item in list_recipe_reject %}
                                            <li class="m-recipe-item  ng-scope not-submitted">
                                                <div class="m-recipe-item-inner">
                                                    <div class="photo">
                                                        <a href="/cong-thuc/tu-choi/{{ item.getCode() }}.html">
                                                            <img style="height:auto" class="img-responsive" src="{{ item.image.image_base }}">
                                                        </a>
                                                    </div>
                                                    <div class="item-info">
                                                        <h4><a class="ng-binding" href="/cong-thuc/{{ item.getCode() }}.html">{{ item.getName() }}</a>
                                                        </h4>
                                                        <div class="item-stats">
                                                            <ul class="list-inline nomargin">
                                                                <li>
                                                                    <span class="stats-count ng-binding">{{ item.getSeenTotal() }}</span>
                                                                    lượt xem
                                                                </li>
                                                                <li>
                                                                    <span class="stats-count ng-binding">{{ item.getBookmarkTotal() }}</span>
                                                                    thích
                                                                </li>
                                                                <li class="ng-binding"><span
                                                                            class="stats-count"> - </span>{{ item.getCreatedTime() }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="desc ng-binding"
                                                             ng-bind-html="item.Description | to_trusted_html">{{ item.getDescription() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        {% endfor %}
                                    {% endif %}

                                </ul>
                            </div>
                            <div>

                            </div>
                        </div>
                        <div id="list-all-recipe" class="panel-body clearfix ng-hide">
                            <div>
                                <ul class="list-unstyled m-recipe-list">
                                    {% if list_recipe_all is not null %}
                                        {% for item in list_recipe_all %}
                                            <li class="m-recipe-item  ng-scope not-submitted">
                                                <div class="m-recipe-item-inner">
                                                    <div class="photo">
                                                        <a href="/cong-thuc/{{ item.getCode() }}.html">
                                                            <img style="height:auto" class="img-responsive"
                                                                 src="{{ item.image.image_base }}">
                                                        </a>
                                                    </div>
                                                    <div class="item-info">
                                                        <h4><a class="ng-binding"
                                                               href="/cong-thuc/{{ item.getCode() }}.html">{{ item.getName() }}</a>
                                                        </h4>
                                                        <div class="item-stats">
                                                            <ul class="list-inline nomargin">
                                                                <li>
                                                                    <span class="stats-count ng-binding">{{ item.getSeenTotal() }}</span>
                                                                    lượt
                                                                    xem
                                                                </li>
                                                                <li>
                                                                    <span class="stats-count ng-binding">{{ item.getBookmarkTotal() }}</span>
                                                                    thích
                                                                </li>
                                                                <li class="ng-binding"><span
                                                                            class="stats-count"> - </span>{{ item.getCreatedTime() }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="desc ng-binding"
                                                             ng-bind-html="item.Description | to_trusted_html">{{ item.getDescription() }}
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>
                                        {% endfor %}
                                    {% endif %}

                                </ul>
                            </div>
                            <div>

                            </div>
                            <!-- ngIf: list.Total-list.Count > 0 -->
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/public/js/jquery.js"></script>
<script type="text/javascript">
    var numberStep = 1;
    var numberStepAfterDelete = 1;

    function menuListRecipe() {

    }

    $(document).ready(function () {
        $('#confirmed-recipe').on('click', function () {
            $('#confirmed-recipe').addClass('active-menu');
            $('#confirm-recipe').removeClass('active-menu');
            $('#reject-recipe').removeClass('active-menu');
            $('#all-recipe').removeClass('active-menu');

            $('#list-confirmed-recipe').removeClass('ng-hide');
            $('#list-confirm-recipe').addClass('ng-hide');
            $('#list-reject-recipe').addClass('ng-hide');
            $('#list-all-recipe').addClass('ng-hide');
        });
        $('#confirm-recipe').on('click', function () {

            $('#confirmed-recipe').removeClass('active-menu');
            $('#confirm-recipe').addClass('active-menu');
            $('#reject-recipe').removeClass('active-menu');
            $('#all-recipe').removeClass('active-menu');

            $('#list-confirmed-recipe').addClass('ng-hide');
            $('#list-confirm-recipe').removeClass('ng-hide');
            $('#list-reject-recipe').addClass('ng-hide');
            $('#list-all-recipe').addClass('ng-hide');
        });
        $('#reject-recipe').on('click', function () {
            $('#confirmed-recipe').removeClass('active-menu');
            $('#confirm-recipe').removeClass('active-menu');
            $('#reject-recipe').addClass('active-menu');
            $('#all-recipe').removeClass('active-menu');

            $('#list-confirmed-recipe').addClass('ng-hide');
            $('#list-confirm-recipe').addClass('ng-hide');
            $('#list-reject-recipe').removeClass('ng-hide');
            $('#list-all-recipe').addClass('ng-hide');
        });
        $('#all-recipe').on('click', function () {
            $('#confirmed-recipe').removeClass('active-menu');
            $('#confirm-recipe').removeClass('active-menu');
            $('#reject-recipe').removeClass('active-menu');
            $('#all-recipe').addClass('active-menu');

            $('#list-confirmed-recipe').addClass('ng-hide');
            $('#list-confirm-recipe').addClass('ng-hide');
            $('#list-reject-recipe').addClass('ng-hide');
            $('#list-all-recipe').removeClass('ng-hide');
        });
        $('#btn-remove-recipe').on('click', function () {

        });
    });


</script>