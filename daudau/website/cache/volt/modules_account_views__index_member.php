<section class="page-container page-profile-container">
    <?php if (($find_user) === ('false')) { ?>
        <div class="container">
            <h2 style="text-align: center">Không tìm thấy tài khoản này!</h2>
        </div>
    <?php } else { ?>
        <div class="container">

            <div class="page-header page-profile-header">
                <div class="profile-cover-photo" style="background-image:url('/imgs/member-kitchen.jpg')">
                </div>
                <div class="profile-info-container" style="background:transparent">
                    <div style="clear: both;width: 100%;"></div>
                    <div class="profile-photo">
                        <div class="avt" style="margin: 0 auto;">
                            <img class="img-responsive" alt="monglinh1504" src="<?= $user->image->getImageBase() ?>">
                        </div>
                    </div>
                    <div class="profile-info clearfix">
                        <div class="profile-name"><h1><?= $user->getUserName() ?></h1></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="profile-stats">
                        <div class="stats-item">
                            <span class="stats-text">lượt xem:</span>
                            <span class="stats-count"> <?= $total_seen ?> </span>
                        </div>
                        <div class="stats-item">
                            <span class="stats-text">Công thức:</span>
                            <span class="stats-count"> <?= $total_recipe ?> </span>
                        </div>
                        <div>
                            <input  type="range" value="<?= $average_rate ?>" step="0.25" id="backing4" style="display: none">
                            <div class="rateit" id="rateit10" data-rateit-backingfld="#backing4" data-rateit-resetable="true" data-rateit-ispreset="true"data-rateit-min="0" data-rateit-max="5" data-rateit-mode="font"  style="font-size:50px">
                            </div>
                            <span><?= $average_rate ?>/5</span>
                            <span class="count" title="Đang được quan tâm" style="color: #b2b2b2;font-size: 15px;padding: 6px 8px;"><i style=""></i><b></b>
                                    <span id="totalFollowing1"><?= $total_user_rate ?> đánh giá</span>
                                    </span>
                        </div>
                    </div>
                    <div class="favourite clearfix">
                        <div id="friend-status-div" class="btn-friend-stat">
                            <?php if (($btn_bookmark) === ('true')) { ?>
                                <div data-bind="visible:true" style="">
                                      <span style="cursor:default">
                                        <a id="btn-rate-user" title="Quan tâm" href="javascript:void(0)" target="_self">
                                                <span id="tittle-rate-user">Đánh giá</span>
                                        </a>
                                    </span>
                                    <span style="cursor:default">
                                <a id="btn-bookmark-user" title="Quan tâm" href="javascript:void(0)" target="_self">
                                    <?php if ($bookmark_user != null) { ?>
                                        <span id="tittle-bookmark-user"> Đã quan tâm</span>
                                    <?php } else { ?>
                                        <span id="tittle-bookmark-user">Quan tâm</span>
                                    <?php } ?>
                                </a>
                                <span class="count" title="Đang được quan tâm"><i style=""></i><b></b>
                                    <span id="totalFollowing"><?= $total_user_bookmark ?></span>
                                    </span>
                            </span>
                                </div>
                            <?php } ?>
                        </div>
                        <script type="text/javascript" src="/public/js/jquery.js"></script>
                        <script type="text/javascript">
                            $('#btn-bookmark-user').on('click', function () {
                                $.ajax({
                                    type: 'Post',
                                    url: '/thanh-vien/quan-tam',
                                    data: {
                                        user: <?= $auth_site_home['id'] ?>,
                                        bookmark_user: <?= $user->getId() ?>,
                                    },
                                    dataType: 'json',
                                    complete: function (data) {
                                        console.log(data.responseJSON.total);
                                        $('#tittle-bookmark-user').html(data.responseJSON.value);
                                        $('#totalFollowing').html(data.responseJSON.total);
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>

            <div class="profile-container">
                <div class="inner">
                    <ul class="nomargin tab-list">
                        <li class="active"><a href="/thanh-vien/<?= $user->getUserName() ?>" target="_self"><span
                                        class="count"><?= $total_recipe ?></span>Công thức </a></li>
                        <li><a href="/thanh-vien/<?= $user->getUserName() ?>/quan-tam" target="_self"><span
                                        class="count"><?= $total_user_bookmark ?></span> Quan tâm</a></li>
                    </ul>


                    <div class="profile-wrapper profile-box ng-scope" ng-app="userRecipesApp"
                         ng-controller="UserRecipesController">
                        <ul class="nav nav-tabs profile-nav-tabs" role="tablist">
                            <li role="presentation" class="tab active" id="tab-owner"
                                onclick="selectedTab(this, 'ownerList')">
                                <a href="javascript:void(0)" role="tab" data-toggle="tab" target="_self">Công thức <span
                                            class="stats-count"> <?= $total_recipe ?> </span>
                                </a>
                            </li>
                        </ul>
                        <div class="row10">
                            <!-- ngIf: false -->
                            <cooky-simple-list options="recipeOptions" class="ng-isolate-scope">
                                <div ng-class="options.containerClass" class="recipe-list-wrapper">
                                    <?php if ($recipe != null) { ?>
                                        <?php foreach ($recipe as $item) { ?>
                                            <div class="ng-scope member-recipe-item">
                                                <div class="item-inner ng-scope">
                                                    <div class="item-photo">
                                                        <a class="photo" href="/cong-thuc/<?= $item->getCode() ?>.html">
                                                            <img class="img-responsive" alt="Trứng chiên bơ kiểu Ý"
                                                                 src="<?= $item->image->getImageBase() ?>">
                                                        </a>
                                                        <a id="<?= $item->getId() ?>" href="javascript:void(0);"
                                                           title="Yêu thích" onclick=""
                                                           class="btn-act btn-add-favourite ng-isolate-scope">
                                                            <?php if ($item->getBookmarkTotal() != 0) { ?>
                                                                <span ng-if="<?= $item->getBookmarkTotal() ?> > 0"
                                                                      class="ng-binding ng-scope"><?= $item->getBookmarkTotal() ?> &nbsp;</span>
                                                            <?php } ?>
                                                            <?php if (($list_bookmark[$item->getId()]) === ('true')) { ?>
                                                                <i class="<?= $list_bookmark[$item->getId()] ?> ico ico-28 ico-iblock ico-favourite ico-favourited"></i>
                                                            <?php } else { ?>
                                                                <i class="ico ico-28 ico-iblock ico-favourite "></i>
                                                            <?php } ?>
                                                        </a>
                                                    </div>
                                                    <div class="item-info">
                                                        <div class="item-title">
                                                            <h3><a ng-href="/cong-thuc/<?= $item->getCode() ?>.html"
                                                                   title="<?= $item->getName() ?>" class="ng-binding"
                                                                   href="/cong-thuc/<?= $item->getCode() ?>"><?= $item->getName() ?></a>
                                                            </h3>
                                                        </div>
                                                        <div class="desc ng-binding"><?= $item->getDescription() ?></div>

                                                    </div>
                                                    <div class="item-footer">
                                                        <div class="recipe-acts">
                                                            <div class="recipe-stats">
                                                                <span class="stats-item"><span
                                                                            class="fa fa-clock-o stats-ico"></span><span
                                                                            class="stats-count ng-binding"> <?= $item->getTimeDo() ?></span> ph</span>
                                                                <span class="stats-item"><span
                                                                            class="fa fa-bolt stats-ico"></span> <span
                                                                            class="stats-text stats-count ng-binding"> <?= $item->getLevel() ?></span></span>
                                                                <span class="stats-item"><span
                                                                            class="fa fa-bar-chart stats-ico"></span><span
                                                                            class="stats-count ng-binding"> <?= $list_seen_recipe[$item->getId()] ?></span> xem</span>
                                                            </div>
                                                            <a href="javascript:void(0)"
                                                               recipe-add-collection-item-popup-full="" options="item"
                                                               class="btn btn-save ng-isolate-scope"
                                                               title="thêm vào bộ sưu tập" target="_self">
                                                                <i class="ico ico-24 ico-block ico-save"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
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
    <?php } ?>
</section>
<script type="text/javascript" src="/public/js/jquery.js"></script>
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
    $('.btn-add-favourite').on('click', function () {
        var id = $(this).attr('id');
        $.ajax({
            type: 'Post',
            url: "<?= $this->url->get() ?>admin/bookmark/ajaxFavourite",
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
    });
    $('#btn-rate-user').on('click', function () {
        $.ajax({
            type: 'Post',
            url: "<?= $this->url->get() ?>admin/bookmark/ajaxRating",
            data: {
                point_rate: point_rate,
                user: <?= $auth_site_home['id'] ?>,
                bookmark_user: <?= $user->getId() ?>,
            },
            dataType: 'json',
            complete: function (data) {
              location.reload();
            }
        });
    });

</script>