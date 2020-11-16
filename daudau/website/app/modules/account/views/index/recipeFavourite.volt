<section class="page-container page-profile-container">
    {% if find_user is sameas('false') %}
        <div class="container">
            <h2 style="text-align: center">Không tìm thấy tài khoản này!</h2>
        </div>
    {% else %}
        <div class="container">

            <div class="profile-container">
                <div class="inner">
                    <div class="profile-wrapper profile-box ng-scope" ng-app="userRecipesApp"
                         ng-controller="UserRecipesController">
                        <ul class="nav nav-tabs profile-nav-tabs" role="tablist">
                            <li role="presentation" class="tab active" id="tab-owner"
                                onclick="selectedTab(this, 'ownerList')">
                                <a href="javascript:void(0)" role="tab" data-toggle="tab" target="_self">
                                    Công thức yêu thích <span class="stats-count"> {{ total_recipe_favourite }} </span>
                                </a>
                            </li>
                        </ul>
                        <div class="row10">
                            <!-- ngIf: false -->
                            <cooky-simple-list options="recipeOptions" class="ng-isolate-scope">
                                <div ng-class="options.containerClass" class="recipe-list-wrapper">
                                    {% if recipe_favourite is not null %}
                                        {% for item in recipe_favourite %}
                                            {% if item.recipe_cook.getStatusId() == status_id_enable %}
                                            <div class="ng-scope member-recipe-item">
                                                <div class="item-inner ng-scope">
                                                    <div class="item-photo">
                                                        <a class="photo" href="/cong-thuc/{{ item.recipe_cook.getCode() }}.html">
                                                            <img class="img-responsive" alt="Trứng chiên bơ kiểu Ý"
                                                                 src="{{ item.recipe_cook.image.getImageBase() }}">

                                                        </a>
                                                        <a id="{{ item.getId() }}" href="javascript:void(0);"
                                                           title="Yêu thích" onclick=""
                                                           class="btn-act btn-add-favourite ng-isolate-scope"
                                                           options="{&quot;Id&quot;:39881,&quot;TotalLiked&quot;:113,&quot;IsLiked&quot;:false}">
                                                            {% if item.recipe_cook.getBookmarkTotal() is not 0 %}
                                                                <span ng-if="{{ item.recipe_cook.getBookmarkTotal() }} > 0"
                                                                      class="ng-binding ng-scope">{{ item.recipe_cook.getBookmarkTotal() }} &nbsp;</span>
                                                            {% endif %}
                                                            {% if item.recipe_cook.checkbookmarkRecipe(auth_site_home['id'],item.recipe_cook.getId()) is sameas('true') %}
                                                                <i class="{{ item.recipe_cook.checkbookmarkRecipe(auth_site_home['id'],item.recipe_cook.getId()) }} ico ico-28 ico-iblock ico-favourite ico-favourited"></i>
                                                            {% else %}
                                                                <i class="ico ico-28 ico-iblock ico-favourite "></i>
                                                            {% endif %}
                                                        </a>
                                                    </div>
                                                    <div class="item-info">
                                                        <div class="item-title">
                                                            <h3><a ng-href="/cong-thuc/{{ item.recipe_cook.getCode() }}.html"
                                                                   title="{{ item.recipe_cook.getName() }}" class="ng-binding"
                                                                   href="/cong-thuc/{{ item.recipe_cook.getCode() }}">{{ item.recipe_cook.getName() }}</a>
                                                            </h3>
                                                        </div>
                                                        <div class="desc ng-binding">{{ item.recipe_cook.getDescription() }}</div>

                                                    </div>
                                                    <div class="item-footer">
                                                        <div class="recipe-acts">
                                                            <div class="recipe-stats">
                                                            <span class="stats-item"><span class="fa fa-clock-o stats-ico"></span><span class="stats-count ng-binding"> {{ item.recipe_cook.getTimeDo() }}</span> ph</span>
                                                                <span class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count ng-binding"> {{ item.recipe_cook.getLevel() }}</span></span>
                                                                <span class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count ng-binding"> {{ item.recipe_cook.totalSeemRecipe(item.recipe_cook.getId()) }}</span> xem</span>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div>
                                                        <div class="item-header" style="margin-top: 35px">
                                                            <div class="hprofile">
                                                                <div class="profile">
                                                                    <span class="postedby-text">công thức bởi:</span>
                                                                    <a target="_blank" href="/thanh-vien/{{ item.recipe_cook.user.getUserName() }}" class="name">{{ item.recipe_cook.user.getUserName() }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {% endif %}
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
    {% endif %}
</section>
<script type="text/javascript" src="/public/js/jquery.js"></script>
<script type="text/javascript">
    $('.btn-add-favourite').on('click', function () {
        var id =$(this).attr('id');
        $.ajax({
            type: 'Post',
            url: "{{ url.get() }}admin/bookmark/ajaxFavourite",
            data: {
                id: $(this).attr('id'),
            },
            dataType: 'json',
            complete: function (data) {
                console.log(data.responseJSON);
                if (data.responseJSON.value == "enable") {
                    console.log(id);
                    $('#'+id).html("<span ng-if=\"" + data.responseJSON.totalbookmark + " > 0\" class=\"ng-binding ng-scope\">" + data.responseJSON.totalbookmark + " &nbsp;</span>"
                        + "<i class=\"true ico ico-28 ico-iblock ico-favourite ico-favourited\"></i>");
                } else {
                    console.log(id);
                    if(data.responseJSON.totalbookmark == 0)
                    {
                        $('#'+id).html( "<i class=\"ico ico-28 ico-iblock ico-favourite \"></i>");
                    }else{
                        $('#'+id).html("<span ng-if=\"" + data.responseJSON.totalbookmark + " > 0\" class=\"ng-binding ng-scope\">" + data.responseJSON.totalbookmark + " &nbsp;</span>"
                            + "<i class=\"true ico ico-28 ico-iblock ico-favourite \"></i>");
                    }


                }

            }
        });
    })
</script>