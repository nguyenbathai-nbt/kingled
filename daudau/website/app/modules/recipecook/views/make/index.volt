<div ng-app="searchApp" class="container full-container ng-scope">
    <div ng-controller="SearchController" class="ng-scope">
        <div class="result-box">
            <div class="result-box-inner" style="position: relative;">
                <div class="result-list recipe-list">
                    <div class="result-headline">
                        <div>
                            <div class="result-container">
                                <h1>
                                   <span ng-if="true" class="ng-scope">
                                        <strong class="text-highlight ng-binding">{{ count_list_recipe }} </strong> cách làm {{ st }} ngon
                                    </span>
                                </h1>
                                <div class="keyword-suggestions">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div>
                        <style type="text/css">
                            .rating-score {
                                width: 70px !important;
                            }

                            .rating-score img {
                                width: 10px;
                            }

                            .btn-group {
                                margin-left: 0 !important;
                            }

                            .btn-group .btn.dropdown-toggle {
                                border-top-left-radius: 0;
                                border-bottom-left-radius: 0;
                            }
                        </style>
                        <div class="result-recipe-wrapper row10">
                            {% if list_recipe is not null %}
                                {% for item in list_recipe %}
                                    <div ng-repeat="recipe in recipes" class="result-recipe-item ng-scope">
                                        <div class="item-inner">
                                            <div class="item-photo">
                                                <a class="photo" rel="alternate"
                                                   media="only screen and (max-width: 640px)"
                                                   href="/cong-thuc/{{ item.getCode() }}.html" target="_blank">
                                                    <img alt="{{ item.getName() }}" class="photo img-responsive"
                                                         src="{{ item.image.getImageBase() }}">
                                                </a>
                                                <a id="{{ item.getId() }}" href="javascript:void(0);" title="Yêu thích"
                                                   class="btn-act btn-add-favourite ng-isolate-scope" options="recipe">
                                                    {% if item.getBookmarkTotal() is not 0 %}
                                                        <span ng-if="{{ item.getBookmarkTotal() }} > 0"
                                                              class="ng-binding ng-scope">{{ item.getBookmarkTotal() }} &nbsp;</span>
                                                    {% endif %}
                                                    {% if item.checkFavouriteRecipe(auth_site_home['id'],item.getId()) is sameas('true') %}
                                                        <i class="ico ico-28 ico-iblock ico-favourite ico-favourited"></i>
                                                    {% else %}
                                                        <i class="ico ico-28 ico-iblock ico-favourite "></i>
                                                    {% endif %}
                                                </a>
                                            </div>
                                            <div class="item-info">
                                                <div class="item-header">
                                                    <div class="title">
                                                        <h2>
                                                            <a rel="alternate"
                                                               media="only screen and (max-width: 640px)"
                                                               title="{{ item.getName() }}"
                                                               href="/cong-thuc/{{ item.getCode() }}.html"
                                                               target="_blank"
                                                               class="ng-binding">{{ item.getName() }}</a>
                                                        </h2>
                                                    </div>
                                                    <div class="item-stats">
                                                        <div class="stats">
                                                            <ul class="list-inline nomargin">
                                                                <li class="stats-item">
                                                                    <span class="fa fa-clock-o stats-ico"></span>
                                                                    <span ng-show="recipe.TotalTimeSpan.Minutes>0">
                                                                        <span class="stats-count ng-binding"> {{ item.getTimeDo() }}</span>
                                                                        <span class="stats-text">ph</span>
                                                                    </span>
                                                                </li>
                                                                <li class="stats-item">
                                                                    <span class="fa fa-bar-chart stats-ico"></span>
                                                                    <span class="stats-count ng-binding"> {{ item.getBookmarkTotal() }}</span>
                                                                </li>
                                                                <li class="stats-item">
                                                                    <span class="fa fa-bolt stats-ico"></span>
                                                                    <span class="stats-text stats-count ng-binding"> {{ item.getLevel() }}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-footer">
                                                    <div class="recipe-by">
                                                        <a  href="/thanh-vien/{{ item.user.getUserName() }}" target="_blank" class="ng-binding">
                                                            <img class="circle" alt="{{ item.user.getUserName() }}" src="{{ item.user.image.getImageBase() }}">
                                                            {{ item.user.getUserName() }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {% endfor %}
                            {% endif %}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/public/js/jquery.js"></script>
<script type="text/javascript">
    $('.btn-add-favourite').on('click', function () {
        var id = $(this).attr('id');
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
                    $('#' + id).html("<span ng-if=\"" + data.responseJSON.totalbookmark + " > 0\" class=\"ng-binding ng-scope\">" + data.responseJSON.totalbookmark + " &nbsp;</span>"
                        + "<i class=\"true ico ico-28 ico-iblock ico-favourite ico-favourited\"></i>");
                } else {
                    console.log(id);
                    if (data.responseJSON.totalbookmark == 0) {
                        $('#' + id).html("<i class=\"ico ico-28 ico-iblock ico-favourite \"></i>");
                    } else {
                        $('#' + id).html("<span ng-if=\"" + data.responseJSON.totalbookmark + " > 0\" class=\"ng-binding ng-scope\">" + data.responseJSON.totalbookmark + " &nbsp;</span>"
                            + "<i class=\"true ico ico-28 ico-iblock ico-favourite \"></i>");
                    }


                }

            }
        });
    })
</script>