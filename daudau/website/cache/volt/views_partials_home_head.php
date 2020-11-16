<header class="clearfix header-cont newyear">


    <div class="header-top clearfix">
        <div class="container" style="position:relative">
            <div class="logo header-top-1">
                <div class="navbar-brand">
                    <a href="/" style="color: #fff;">
                        <img class="logo img-responsive" src="/logo.png" alt="D - Công thức nấu ăn ngon">
                    </a>
                </div>
            </div>
            <div class="header-top-2" style="margin-left: 15px">
                <div class="aligncenter-sm ng-scope" id="cookySearchBox">
                    <div ng-controller="SearchSuggestionController" class="ng-scope">
                        <form id="searchform" class="form-horizontal ng-pristine ng-valid" method="">
                            <div class="qsearch-box">
                                <input type="text" id="searchinput" autocomplete="off" name="searchinput"
                                       placeholder="tìm kiếm công thức"
                                       class="ng-pristine ng-untouched ng-valid ng-empty">
                                <button type="" class="glyphicon glyphicon-search ico-search"></button>
                            </div>
                            <div style="display: none" class="search-suggest-panel">
                                <ul class="group suggest-recipe">
                                    <li>
                                        <div class="left">Từ khóa</div>
                                        <ul class="items">
                                            <li>
                                                <div>
                                                    <span class="textname ng-binding"></span>
                                                    <a class="detail-link" id="urlsearch"
                                                       href="">Xem tất cả</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="left">Công thức</div>
                                        <ul class="items" id="list-recipe-search">
                                        </ul>
                                    </li>
                                </ul>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="/public/js/jquery.js"></script>
            <script type="text/javascript">
                var globalCurrentUser = null;
                var globalCurrentTimestamp = 1567608231;
                var bindingEvent = false;
                var classOpen = false;
                var demo = 1;
                var content = '';
                $('body').on('click',function () {
                    $('.search-suggest-panel').css('display', 'none');
                });
                function menuClick() {
                    if (!bindingEvent) {
                        setTimeout(function () {
                            if (document.getElementById('cooky-persional-stats')) {
                                if (!classOpen) {
                                    document.getElementById('cooky-persional-stats').setAttribute("class", "cell dropdown user-menu open ng-scope");
                                    document.getElementById('persional-menu').setAttribute("style", "");
                                    classOpen = true;
                                } else {
                                    document.getElementById('cooky-persional-stats').setAttribute("class", "cell dropdown user-menu ng-scope");
                                    document.getElementById('persional-menu').setAttribute("style", "");
                                    classOpen = false;
                                }
                            }

                        }, 0);
                    }
                };

                function formSubmitAjax() {
                    $('#searchform').submit(function (e) {
                        e.preventDefault();
                        $.ajax({
                            type: 'Post',
                            url: "<?= $this->url->get() ?>cong-thuc/tim-kiem-cong-thuc",
                            data: {
                                value: $('#searchinput').val(),
                            },
                            dataType: 'json',
                            complete: function (data) {
                                content = '';
                                jQuery.each(data.responseJSON, function (index, value) {
                                    $('#urlsearch').attr('href','/cach-lam?st='+value.url);
                                    content += '<li  class=" ng-scope">\n' +
                                        '                                                <a href="/cong-thuc/' + value.code + '.html" title="' + value.name + '">\n' +
                                        '                                                    <div>\n' +
                                        '                                                        <img title=' + value.name + '" alt="' + value.name + '" src="' + value.image + '">\n' +
                                        '                                                        <span >' + value.name + '</span>\n' +
                                        '                                                        <br>\n' +
                                        '                                                        <span class="">' + value.time + ' phút</span>\n' +
                                        '                                                    </div>\n' +
                                        '                                                </a>\n' +
                                        '                                            </li>';

                                });
                                $('#list-recipe-search').html(content);
                            }
                        });
                    });
                };

                formSubmitAjax();
                var value_search = '';
                $('#searchinput').keyup(function (e) {
                    if (e.which == 13) {
                        $('.search-suggest-panel').css('display', 'block');
                        $('.textname').html($('#searchinput').val());
                    } else {
                        if ($('#searchinput').val().length == 0) {
                            $('.search-suggest-panel').css('display', 'none');

                        } else {
                            $('.search-suggest-panel').css('display', 'block');
                            $('.textname').html($('#searchinput').val());

                        }
                    }
                });
            </script>
            <div class="navbar-right user-header">
                <div class="cell">
                    <a class="btn-quick-create" title="Đăng công thức" href="/cong-thuc/tao-cong-thuc">
                        <span class="cooky-ico">Đăng công thức</span>
                    </a>
                </div>
                <?php $user = $this->session->get('auth-site-home'); ?>
                <?php if ($user != null) { ?>
                    <div id="cooky-persional-stats" class="cell dropdown user-menu"
                         ng-controller="userLinkCtrl as uCtrl">
                        <img class="img-circle dropdown-toggle header-user-img" id="avatar-login" onclick="menuClick()"
                             ng-click="init()"
                             data-toggle="dropdown" src="<?= $user['image'] ?>" alt="<?= $user['full_name'] ?>">

                        <div id="persional-menu" class="dropdown-menu" role="menu">
                            <div id="personal-menu-info" ng-hide="showloading ">
                                <div class="menu-header">
                                    <a target="_self" class="profile" alt="<?= $user['full_name'] ?>" href="">Trang cá
                                        nhân của </a>
                                    <span class="logout">
                            <a target="_self" href="/logout">Thoát</a>
                        </span>
                                </div>
                                <ul class="menu-list">
                                    <li>
                                        <a target="_self" href="/tai-khoan/cong-thuc">
                                            <i class="glyphicon glyphicon-list-alt"></i>Công thức của tôi
                                            <span class="counter" ng-cloak=""></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_self" href="/tai-khoan/cong-thuc-da-xem">
                                            <i class="glyphicon glyphicon-calendar ico"></i>Công thức đã xem
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_self" href="/tai-khoan/cong-thuc-yeu-thich">
                                            <i class="glyphicon glyphicon-heart ico"></i>Công thức yêu thích
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_self" href="/tai-khoan/cong-thuc-da-luu">
                                            <i class="glyphicon glyphicon-bookmark ico"></i>Công thức đã lưu
                                        </a>
                                    </li>
                                    
                                    
                                    
                                    
                                    
                                    
                                    <li>
                                        <a target="_self" href="/tai-khoan/thong-tin">
                                            <i class="glyphicon glyphicon-cog ico"></i>Quản lý tài khoản
                                            <span class="text-gray ng-binding"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_self" href="/tai-khoan/tim-kiem-thanh-vien">
                                            <i class="glyphicon glyphicon-search ico"></i>Tìm kiếm thành viên
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="cell">
                        <div class="btn-quick-create" title="<?= $user['full_name'] ?>">
                            <a target="_self" href="/thanh-vien/<?= $user['full_name'] ?>">
                                <span style="font-size: 14px"><?= $user['full_name'] ?></span>
                            </a>
                        </div>
                    </div>

                <?php } else { ?>
                    <div id="cooky-persional-stats" class="cell dropdown user-menu"
                         ng-controller="userLinkCtrl as uCtrl">
                        <a target="_self" href="/dang-nhap"><img class="img-circle dropdown-toggle header-user-img"
                                                             id="avatar-not-login"
                                                             src="/AdminLTE-2.4.10/dist/img/user2-160x160.jpg"
                                                             alt=""></a>
                    </div>
                <?php } ?>
            </div>
            <div id="update-profile-popup" style="display: none"></div>
            <div id="update-profile-popup-loading" style="display: none">
                Đang tải ...
            </div>
            <div id="loginPopup" style="display: none">
            </div>


        </div>
    </div>
</header>
<script type="text/javascript" src="/public/js/jquery.js"></script>














