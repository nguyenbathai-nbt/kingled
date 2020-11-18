<section class="page-container page-profile-container">
    {% if find_user is sameas('false') %}
    <div class="container">
        <h2 style="text-align: center">Không tìm thấy tài khoản này!</h2>
    </div>
    {% else %}
    <div class="container">
        <div class="page-header page-profile-header">
            <div class="profile-cover-photo" style="background-image:url('/imgs/member-kitchen.jpg')">
            </div>


            <div class="profile-info-container" style="background:transparent">
                <div style="clear: both;width: 100%;"></div>
                <div class="profile-photo">
                    <div class="avt" style="margin: 0 auto;">
                        <img class="img-responsive" alt="{{ user.getUserName() }}" src="{{ user.image.getImageBase() }}">
                    </div>
                </div>
                <div class="profile-info clearfix">
                    <div class="profile-name"><h1>{{ user.getUserName() }}</h1></div>
                </div>
                <div class="clearfix"></div>
                <div class="profile-stats">
                    <div class="stats-item">

                        <span class="stats-text">lượt xem:</span>
                        <span class="stats-count"> {{ total_seen }} </span>
                    </div>
                    <div class="stats-item">

                        <span class="stats-text">Công thức:</span>
                        <span class="stats-count"> {{ total_recipe }} </span>
                    </div>
                    <div>
                        <input  type="range" value="{{ average_rate }}" step="0.25" id="backing4" style="display: none">
                        <div class="rateit" id="rateit10" data-rateit-backingfld="#backing4" data-rateit-resetable="true" data-rateit-ispreset="true"data-rateit-min="0" data-rateit-max="5" data-rateit-mode="font"  style="font-size:50px">
                        </div>
                        <span>{{ average_rate }}/5</span>
                        <span class="count" title="Đang được quan tâm" style="color: #b2b2b2;font-size: 15px;padding: 6px 8px;"><i style=""></i><b></b>
                                    <span id="totalFollowing1">{{ total_user_rate }} đánh giá</span>
                                    </span>
                    </div>
                </div>
                <div class="favourite clearfix">
                    <div id="friend-status-div" class="btn-friend-stat">
                        {% if btn_bookmark is sameas('true')%}

                        <div data-bind="visible:true" style="">
                            <span style="cursor:default">
                                        <a id="btn-rate-user" title="Quan tâm" href="javascript:void(0)" target="_self">
                                                <span id="tittle-rate-user">Đánh giá</span>
                                        </a>

                                    </span>
                            <span style="cursor:default" data-bind="visible: status()==0">
                                <a id="btn-bookmark-user" title="Quan tâm" href="javascript:void(0)" target="_self">
                                        <span data-bind="visible: isposting" style="display: none;" class="fa fa-spin fa-spinner"></span>
                                        {% if bookmark_user is not null %}
                                            <span id="tittle-bookmark-user"> Đã quan tâm</span>
                                        {% else %}
                                            <span id="tittle-bookmark-user">Quan tâm</span>

                                        {% endif %}

                                </a>

                                <span class="count" title="Đang được quan tâm"><i style=""></i><b></b>
                                    <span id="totalFollowing">{{ total_user_bookmark }}</span>
                                    </span>
                            </span>
                        </div>
                        {% endif %}
                    </div>
                    <script type="text/javascript" src="/public/js/jquery.js"></script>
                    <script type="text/javascript">
                        $('#btn-bookmark-user').on('click', function () {
                            $.ajax({
                                type: 'Post',
                                url: '/thanh-vien/quan-tam',
                                data: {
                                    user: {{ auth_site_home['id'] }},
                                    bookmark_user: {{ user.getId() }},

                                },
                                dataType: 'json',
                                complete: function (data) {
                                    console.log(data.responseJSON.total);
                                    $('#tittle-bookmark-user').html(data.responseJSON.value);
                                    $('#totalFollowing').html(data.responseJSON.total);
                                },
                                error: function (data) {

                                }
                            });
                        })
                    </script>
                </div>
            </div>
        </div>

        <div class="profile-container">
            <div class="inner">
                <ul class="nomargin tab-list">
                    <li ><a href="/thanh-vien/{{ user.getUserName() }}" target="_self"><span class="count">{{ total_recipe }}</span>Công thức </a></li>
                    <li class="active"><a href="/thanh-vien/{{ user.getUserName() }}/quan-tam" target="_self"><span class="count">{{ total_user_bookmark }}</span> Quan tâm</a></li>
                </ul>
                <div class="profile-wrapper">
                    <div ng-app="userFriendsApp" ng-controller="UserFriendsController" class="ng-scope">

                        <div class="profile-box">
                            <div class="headline">
                                Quan tâm (<span class="stats-count">{{ total_user_bookmark }}</span>)
                            </div>
                            <div class="member-list-wrapper">
                                <cooky-simple-list options="cookyFollowersOptions" class="ng-isolate-scope">
                                    <div ng-class="options.containerClass" class="friend-list-wrapper">
                                        {% if list_user_bookmark is not null %}
                                            {% for item in list_user_bookmark %}
                                                <div ng-include="options.itemTemplateUrl" ng-class="options.itemCssClass" ng-repeat="item in items" class="ng-scope member-item-wrapper"><div class="member-item ng-scope">
                                                        <div class="member-profile nopadding">
                                                            <div class="avatar">
                                                                <img alt="{{ item.user.getUserName() }}" class="img-responsive circle" src="{{ item.user.image.getImageBase() }}">
                                                            </div>
                                                            <div class="info">
                                                                <a class="name cooky-user-link ng-binding"  data-userid="" href="/thanh-vien/{{ item.user.getUserName() }}">{{ item.user.getUserName() }}</a>
                                                                <ul class="stats list-inline list-unstyled">
                                                                    <li><span class="stats-count ng-binding">{{ item.user.getTotalRecipe(item.user.getId()) }}</span><span class="stats-text"> công thức</span> </li>
                                                                    <li><span class="stats-count ng-binding">{{ item.user.getTotalUserBookmark(item.user.getId()) }}</span><span class="stats-text"> quan tâm</span> </li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            {% endfor %}
                                        {% endif %}
                                          <div class="clearfix"></div>
                                        <div ng-show="isLoadingMore" style="text-align:center" class="ng-hide"><img src="/Style/images/icons/small-loading.gif"></div>
                                    </div>
                                </cooky-simple-list>
                            </div>
                        </div>
                        <div class="profile-box">
                            <div class="headline">
                                Đang quan tâm (<span class="stats-count">{{ total_bookmark_user }}</span>)
                            </div>
                            <div class="member-list-wrapper">
                                <!-- ngIf: false -->
                                <cooky-simple-list options="cookyFollowingOptions" class="ng-isolate-scope">
                                    <div ng-class="options.containerClass" class="friend-list-wrapper">
                                        {%if list_bookmark_user is not null  %}
                                            {% for item in list_bookmark_user %}
                                                <div ng-include="options.itemTemplateUrl" ng-class="options.itemCssClass" ng-repeat="item in items" class="ng-scope member-item-wrapper">
                                                    <div class="member-item ng-scope">
                                                        <div class="member-profile nopadding">
                                                            <div class="avatar">
                                                                <img alt="{{ item.bookmark_user.getUserName() }}"  class="img-responsive circle" src="{{ item.bookmark_user.image.getImageBase() }}">
                                                            </div>
                                                            <div class="info">
                                                                <a class="name cooky-user-link ng-binding" ng-href="/thanh-vien/{{ item.bookmark_user.getUserName() }}" data-userid="" href="/thanh-vien/{{ item.bookmark_user.getUserName() }}">{{ item.bookmark_user.getUserName() }}</a>
                                                                <ul class="stats list-inline list-unstyled">
                                                                    <li><span class="stats-count ng-binding">{{ item.bookmark_user.getTotalRecipe(item.bookmark_user.getId()) }}</span><span class="stats-text"> công thức</span> </li>
                                                                    <li><span class="stats-count ng-binding">{{ item.bookmark_user.getTotalUserBookmark(item.bookmark_user.getId()) }}</span><span class="stats-text"> quan tâm</span> </li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            {% endfor %}
                                        {% endif %}
                                        <div class="clearfix"></div>
                                        <div ng-show="isLoadingMore" style="text-align:center" class="ng-hide"><img src="/Style/images/icons/small-loading.gif"></div>
                                    </div>
                                </cooky-simple-list>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {% endif %}
</section>
script type="text/javascript" src="/public/js/jquery.js"></script>
<script type="text/javascript" src="https://rawgit.com/gjunge/rateit.js/master/scripts/jquery.rateit.js"></script>
<script type="text/javascript">
    var point_rate;
    $("#rateit10").bind('rated', function (event, value) {
        point_rate = value;
        console.log(point_rate);
    });

    $(document).ready(function () {
        $('#rateit-reset-2').css('display', 'none');
    });
    $('#btn-rate-user').on('click', function () {
        $.ajax({
            type: 'Post',
            url: "{{ url.get() }}admin/bookmark/ajaxRating",
            data: {
                point_rate: point_rate,
                user: {{ auth_site_home['id'] }},
                bookmark_user: {{ user.getId() }},
            },
            dataType: 'json',
            complete: function (data) {
                location.reload();
            }
        });
    });

</script>