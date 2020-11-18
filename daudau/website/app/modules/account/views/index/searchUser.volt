<section class="page-container page-profile-container">
        <div class="container">

            <div class="profile-container">
                <div class="inner">
                    <div class="profile-wrapper">
                        <div ng-app="userFriendsApp" ng-controller="UserFriendsController" class="ng-scope">
                            <div class="profile-box" style="margin-bottom: 0px">
                                <div style="text-align: center">
                                    <form id="searchformUser" class="form-horizontal ng-pristine ng-valid" method="Post"
                                          novalidate="novalidate" style="width: 400px;margin-left: 15px">
                                        <div class="qsearch-box">
                                            <input type="text" id="searchuser" name="searchuser" placeholder="tìm kiếm thành viên" value="{{ search_user_text }}" class="ng-pristine ng-untouched ng-valid ng-empty">
                                            <button type="submit"
                                                    class="glyphicon glyphicon-search ico-search"></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="member-list-wrapper">
                                    <cooky-simple-list options="cookyFollowersOptions" class="ng-isolate-scope">
                                        <div ng-class="options.containerClass" class="friend-list-wrapper">
                                            {% if search_user is not null %}
                                                {% for item in search_user %}
                                                    <div ng-include="options.itemTemplateUrl"
                                                         ng-class="options.itemCssClass" ng-repeat="item in items"
                                                         class="ng-scope member-item-wrapper">
                                                        <div class="member-item ng-scope">
                                                            <div class="member-profile nopadding">
                                                                <div class="avatar">
                                                                    <img alt="{{ item.getUserName() }}"
                                                                         class="img-responsive circle"
                                                                         src="{{ item.image.getImageBase() }}">
                                                                </div>
                                                                <div class="info">
                                                                    <a class="name cooky-user-link ng-binding"
                                                                       target="_blank" data-userid=""
                                                                       href="/thanh-vien/{{ item.getUserName() }}">{{ item.getUserName() }}</a>
                                                                    <ul class="stats list-inline list-unstyled">
                                                                        <li>
                                                                            <span class="stats-count ng-binding">{{ item.getTotalRecipe(item.getId()) }}</span><span
                                                                                    class="stats-text"> công thức</span>
                                                                        </li>
                                                                        <li>
                                                                            <span class="stats-count ng-binding">{{ item.getTotalBookmarkUser(item.getId()) }}</span><span
                                                                                    class="stats-text"> quan tâm</span>
                                                                        </li>
                                                                    </ul>

                                                                </div>
                                                            </div>
                                                            {#                                                        {% if item.user.getId() != auth_site_home['id'] %}#}
                                                            {#                                                            <div class="member-controls member-acts ng-scope" ng-if="!item.isposting">#}
                                                            {#                                                                <div ng-show="visible()" userid="item.UserId" status="item.Status" type="options.type" class="ng-isolate-scope">#}
                                                            {#                                                                    <a ng-show="!isPosting" ng-mouseenter="hover = true" ng-mouseleave="hover = false" title="Quan tâm" href="javascript:void(0)" ng-click="follow()" class="btn btn-default" ng-class="itemClass()" style="background:none; box-shadow:none;">#}

                                                            {#                                                                        <span class="fa fa-plus text-gray" ng-class="itemSpanClass()"></span>#}
                                                            {#                                                                        <span class="sr-only ng-binding" ng-bind="title(false)">Quan tâm</span>#}
                                                            {#                                                                    </a>#}
                                                            {#                                                                    <span ng-show="isPosting" style="cursor: pointer" class="glyphicon glyphicon-refresh glyphicon-refresh-animate ng-hide"></span>#}
                                                            {#                                                                </div>#}
                                                            {#                                                            </div>#}
                                                            {#                                                        {% endif %}#}


                                                        </div>
                                                    </div>

                                                {% endfor %}

                                            {% endif %}

                                            <div class="clearfix"></div>
                                            <div ng-show="isLoadingMore" style="text-align:center" class="ng-hide"><img
                                                        src="/Style/images/icons/small-loading.gif"></div>

                                        </div>
                                    </cooky-simple-list>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
</section>