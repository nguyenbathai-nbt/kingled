<style type="text/css">
    .slick-dots {
        bottom: 10px !important;
    }

    .slick-dots li button:before {
        content: '' !important;
        background-color: #fff !important;
        border-radius: 50% !important;
        color: transparent !important;
        height: 16px !important;
        width: 16px !important;
    }

    .slick-dots li.slick-active button:before {
        color: transparent !important;
    }
</style>
<div class="home-body-container ng-scope" ng-app="cookyHomeApp" ng-controller="homeController">
    <div class="cooky-featured-search">
        <div class="container">
            <div id="lazy-top-home-banners" style="opacity: 1;">
                <div class="top-today-recipes slick-initialized slick-slider">
                    <div class="slick-list draggable" tabindex="3" style="height: 380px;">
                        <div class="slick-track"
                             style="opacity: 1; width: 7980px; transform: translate3d(0px, 0px, 0px);">
                            <div class="today-recipe slick-slide" index="0" style="width: 1140px;">
                                <a target="_blank" class="item"
                                   href="">
                                    <img src="/cooky-ads-637057967324628185.jpg"
                                         alt="Mì Cay Kim Chi Hải Sản">
                                </a>
                                {#                                <div class="item-tips">#}
                                {#                                    <div class="item-tip-1">#}
                                {#                                        <a href="https://www.cooky.vn/cong-thuc/mi-cay-kim-chi-48085?utm_source=webbibigo&amp;utm_medium=banner&amp;utm_campaign=primary"#}
                                {#                                           title="Mì Cay Kim Chi Hải Sản" target="_blank">Mì Cay Kim Chi Hải Sản</a>#}
                                {#                                    </div>#}
                                {#                                    <div class="item-tip-2">#}
                                {#                                        <span class="fa fa-file-text-o"></span>#}
                                {#                                        <a href="https://www.cooky.vn/cong-thuc/mi-cay-kim-chi-48085?utm_source=webbibigo&amp;utm_medium=banner&amp;utm_campaign=primary"#}
                                {#                                           title="Bibigo-KimChi" target="_blank">Bibigo-KimChi</a>#}
                                {#                                    </div>#}
                                {#                                </div>#}
                            </div>
                            <div class="today-recipe slick-slide" index="1" style="width: 1140px;">
                                <a target="_blank" class="item"
                                   href="">
                                    <img src="/cooky-ads-637057967324628185.jpg"
                                         alt="BÁNH TRUNG THU THẬP CẨM HÌNH THỎ">
                                </a>
                                <div class="item-tips">
                                    <div class="item-tip-1">
                                        <a href=""
                                           title="BÁNH TRUNG THU THẬP CẨM HÌNH THỎ" target="_blank">BÁNH TRUNG THU THẬP
                                            CẨM HÌNH THỎ</a>
                                    </div>
                                    <div class="item-tip-2">
                                        <span class="fa fa-file-text-o"></span>
                                        <span>Làm Bánh</span>
                                    </div>
                                </div>
                            </div>
                            <div class="today-recipe slick-slide " index="2" style="width: 1140px;">
                                <a target="_blank" class="item"
                                   href="">
                                    <img src="/cooky-ads-637057967324628185.jpg"
                                         alt="KEM BƠ SẦU RIÊNG">
                                </a>
                                <div class="item-tips">
                                    <div class="item-tip-1">
                                        <a href=""
                                           title="KEM BƠ SẦU RIÊNG" target="_blank">KEM BƠ SẦU RIÊNG</a>
                                    </div>
                                    <div class="item-tip-2">
                                        <span class="fa fa-file-text-o"></span>
                                        <span>Món Ngon Mỗi Ngày</span>
                                    </div>
                                </div>
                            </div>
                            <div class="today-recipe slick-slide " index="3" style="width: 1140px;">
                                <a target="_blank" class="item" href="/cooky-ads-637057967324628185.jpg">
                                    <img src="/cooky-ads-637057967324628185.jpg" alt="GÀ ÁC TIỀM THUỐC BẮC">
                                </a>
                                <div class="item-tips">
                                    <div class="item-tip-1">
                                        <a href=""
                                           title="GÀ ÁC TIỀM THUỐC BẮC" target="_blank">GÀ ÁC TIỀM THUỐC BẮC</a>
                                    </div>
                                    <div class="item-tip-2">
                                        <span class="fa fa-file-text-o"></span>
                                        <span>Món Ngon Mỗi Ngày</span>
                                    </div>
                                </div>
                            </div>
                            <div class="today-recipe slick-slide" index="4" style="width: 1140px;">
                                <a target="_blank" class="item"
                                   href="">
                                    <img src="/cooky-ads-637057967324628185.jpg"
                                         alt="BÁNH TRUNG THU NHÂN TRỨNG MUỐI TAN CHẢY">
                                </a>
                                <div class="item-tips">
                                    <div class="item-tip-1">
                                        <a href=""
                                           title="BÁNH TRUNG THU NHÂN TRỨNG MUỐI TAN CHẢY" target="_blank">BÁNH TRUNG
                                            THU NHÂN TRỨNG MUỐI TAN CHẢY</a>
                                    </div>
                                    <div class="item-tip-2">
                                        <span class="fa fa-file-text-o"></span>
                                        <span>Làm Bánh</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <ul class="slick-dots" style="display: block;">
                        <li class="slick-active">
                            <button type="button" id="btn-dot-1" data-role="none">1</button>
                        </li>
                        <li class="">
                            <button type="button" id="btn-dot-2" data-role="none">2</button>
                        </li>
                        <li class="">
                            <button type="button" id="btn-dot-3" data-role="none">3</button>
                        </li>
                        <li class="">
                            <button type="button" id="btn-dot-4" data-role="none">4</button>
                        </li>
                        <li class="">
                            <button type="button" id="btn-dot-5" data-role="none">5</button>
                        </li>
                    </ul>
                </div>

                <script type="text/javascript" src="/public/js/jquery.js"></script>
                {#                <script type="text/javascript">#}
                {#                    window.onload = function () {#}
                {#                        var check = 1;#}
                {#                        setInterval(function () {#}
                {#                            if (check == 1) {#}
                {#                                $('.slick-track').css("transform", "translate3d(0px, 0px, 0px)");#}
                {#                                $('.slick-dots li').removeClass('slick-active');#}
                {#                                $('.slick-dots li:nth-child(' + check + ')').addClass('slick-active');#}
                {#                                check = 2;#}
                {#                            } else if (check == 2) {#}

                {#                                $('.slick-track').css("transform", "translate3d(-1140px, 0px, 0px)");#}
                {#                                $('.slick-dots li').removeClass('slick-active');#}
                {#                                $('.slick-dots li:nth-child(' + check + ')').addClass('slick-active');#}
                {#                                check = 3;#}
                {#                            } else if (check == 3) {#}
                {#                                $('.slick-track').css("transform", "translate3d(-2280px, 0px, 0px)");#}
                {#                                $('.slick-dots li').removeClass('slick-active');#}
                {#                                $('.slick-dots li:nth-child(' + check + ')').addClass('slick-active');#}
                {#                                check = 4;#}
                {#                            } else if (check == 4) {#}
                {#                                $('.slick-track').css("transform", "translate3d(-3420px, 0px, 0px)");#}
                {#                                $('.slick-dots li').removeClass('slick-active');#}
                {#                                $('.slick-dots li:nth-child(' + check + ')').addClass('slick-active');#}
                {#                                check = 5;#}
                {#                            } else if (check == 5) {#}
                {#                                $('.slick-track').css("transform", "translate3d(-4560px, 0px, 0px)");#}
                {#                                $('.slick-dots li').removeClass('slick-active');#}
                {#                                $('.slick-dots li:nth-child(' + check + ')').addClass('slick-active');#}
                {#                                check = 1;#}
                {#                            }#}

                {#                        }, 1000);#}

                {#                    };#}
                {#                </script>#}
            </div>
            <div style="width: 100%; position: absolute; top: 50px;">
                <div style="max-width: 800px; margin: 0 15%;">
                    <div class="title">
                        <h1 class="mt2 mb1 center">Ăn gì hôm nay? Nấu ngay món ngon</h1>
                    </div>
{#                    <div class="search-container">#}
{#                        <span class="glyphicon glyphicon-search"></span>#}
{#                        <input id="home-search-input" name="url" data-behavior="search_field" type="text"#}
{#                               class="form-control"#}
{#                               placeholder="">#}
{#                    </div>#}
                    {#                    <div class="trending-link">#}
                    {#                        <ul>#}
                    {#                            <li>#}
                    {#                                <a href="https://www.cooky.vn/channel/knorr?itm_source=home_z1_p1_search&amp;itm_medium=desktop&amp;itm_content=textlink&amp;itm_campaign=010818_Knorr+Channel"#}
                    {#                                   target="_blank">Knorr Channel</a></li>#}
                    {#                            <li>#}
                    {#                                <a href="https://www.cooky.vn/cong-thuc/ga-nuong-muoi-ot-cooky-47164?itm_source=home_z1_p2_search&amp;itm_medium=desktop&amp;itm_content=textlink&amp;itm_campaign=010818_Gà+Nướng+Muối+Ớt"#}
                    {#                                   target="_blank">Gà Nướng Muối Ớt</a></li>#}
                    {#                            <li>#}
                    {#                                <a href="https://www.cooky.vn/cong-thuc/ba-roi-chay-toi-39614?itm_source=home_z1_p3_search&amp;itm_medium=desktop&amp;itm_content=textlink&amp;itm_campaign=010818_Ba+Rọi+Cháy+Tỏi"#}
                    {#                                   target="_blank">Ba Rọi Cháy Tỏi</a></li>#}
                    {#                            <li>#}
                    {#                                <a href="https://www.cooky.vn/cong-thuc/sup-toc-tien-48560?itm_source=home_z1_p4_search&amp;itm_medium=desktop&amp;itm_content=textlink&amp;itm_campaign=010818_Súp+Tóc+Tiên"#}
                    {#                                   target="_blank">Súp Tóc Tiên</a></li>#}
                    {#                            <li>#}
                    {#                                <a href="https://www.cooky.vn/cong-thuc/kem-bo-sau-rieng-nguyen-mui-49671?itm_source=home_z1_p5_search&amp;itm_medium=desktop&amp;itm_content=textlink&amp;itm_campaign=010818_Kem+Bơ+Sầu+Riêng"#}
                    {#                                   target="_blank">Kem Bơ Sầu Riêng</a></li>#}
                    {#                            <li>#}
                    {#                                <a href="https://www.cooky.vn/blog/7-bi-quyet-xao-mien-khong-dinh-mem-dai-nguyen-soi-dam-bao-khong-von-cuc-thanh-cong-ngay-lan-dau-5204?itm_source=home_z1_p6_search&amp;itm_medium=desktop&amp;itm_content=textlink&amp;itm_campaign=010818_Bí+Quyết+Xào+Miến"#}
                    {#                                   target="_blank">Bí Quyết Xào Miến</a></li>#}
                    {#                            <li>#}
                    {#                                <a href="https://www.cooky.vn/bo-suu-tap/cac-mon-bap-bo-ngon-kho-cuong-643964?itm_source=home_z1_p7_search&amp;itm_medium=desktop&amp;itm_content=textlink&amp;itm_campaign=010818_Bộ+Sưu+Tập+Bắp+Bò"#}
                    {#                                   target="_blank">Bộ Sưu Tập Bắp Bò</a></li>#}
                    {#                        </ul>#}
                    {#                    </div>#}
                </div>
            </div>
        </div>
    </div>
    {#        <div class="container">#}
    {#            <div class="recommend-cuisine-box row10">#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/mon-an-sang-c5?itm_source=home_z2_p1_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=AnSang">#}
    {#                        <img class="ico" src="/Content/img/icons/cat/breakfast.png">#}
    {#                        <span>Ăn sáng</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/mon-an-an-vat-p7?itm_source=home_z2_p2_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=AnVat">#}
    {#                        <img src="/Content/img/icons/cat/popcorn.png" class="ico">#}
    {#                        <span>Ăn vặt</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/mon-khai-vi-c1?itm_source=home_z2_p3_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=KhaiVi">#}
    {#                        <img src="/Content/img/icons/cat/dessert.png" class="ico">#}
    {#                        <span>Khai vị</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/mon-chay-c3?itm_source=home_z2_p4_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=MonChay">#}
    {#                        <img src="/Content/img/icons/cat/vegetable.png" class="ico">#}
    {#                        <span>Món chay</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/mon-chinh-c4?itm_source=home_z2_p5_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=MonChinh">#}
    {#                        <img src="/Content/img/icons/cat/maincourse.png" class="ico">#}
    {#                        <span>Món chính</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/mon-an-nhanh-va-de-c6?itm_source=home_z2_p6_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=NhanhDe">#}
    {#                        <img src="/Content/img/icons/cat/quickeasy.png" class="ico">#}
    {#                        <span>Nhanh - Dễ</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/banh-banh-ngot-c8?itm_source=home_z2_p7_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=lambanh">#}
    {#                        <img src="/Content/img/icons/cat/baking.png" class="ico">#}
    {#                        <span>Làm bánh</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/mon-an-tot-cho-suc-khoe-p15?itm_source=home_z2_p8_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=healthy">#}
    {#                        <img src="/Content/img/icons/cat/healthy.png" class="ico">#}
    {#                        <span>Healthy</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/thuc-uong-c7?itm_source=home_z2_p9_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=thucuong">#}
    {#                        <img src="/Content/img/icons/cat/drinks.png" class="ico">#}
    {#                        <span>Thức uống</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/mon-salad-ngon-d104?itm_source=home_z2_p10_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=salad">#}
    {#                        <img src="/Content/img/icons/cat/salad.png" class="ico">#}
    {#                        <span>Salad</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/mon-nuoc-cham-ngon-d105?itm_source=home_z2_p11_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=nuoccham">#}
    {#                        <img src="/Content/img/icons/cat/sauce.png" class="ico">#}
    {#                        <span>Nước chấm</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/mon-pasta-spaghetti-ngon-d124?itm_source=home_z2_p12_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=pasta">#}
    {#                        <img src="/Content/img/icons/cat/pasta.png" class="ico">#}
    {#                        <span>Pasta - Spaghetti</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/mon-an-tu-ga-ngon-i5?itm_source=home_z2_p13_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=Chicken">#}
    {#                        <img src="/Content/img/icons/cat/chicken.png" class="ico">#}
    {#                        <span>Gà</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/mon-snacks-ngon-d122?itm_source=home_z2_p14_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=Snacks">#}
    {#                        <img src="/Content/img/icons/cat/snack.png" class="ico">#}
    {#                        <span>Snacks</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/mon-bun-mi-pho-ngon-d126?itm_source=home_z2_p15_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=BúnMìPhở">#}
    {#                        <img src="/Content/img/icons/cat/noodle.png" class="ico">#}
    {#                        <span>Bún - Mì - Phở</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#                <div class="item">#}
    {#                    <a target="_blank" href="/cach-lam/mon-lau-ngon-d107?itm_source=home_z2_p16_category&amp;itm_medium=desktop&amp;itm_content=category&amp;itm_campaign=Lẩu">#}
    {#                        <img src="/Content/img/icons/cat/hotspot.png" class="ico">#}
    {#                        <span>Lẩu</span>#}
    {#                    </a>#}
    {#                </div>#}
    {#            </div>#}
    {#        </div>#}


    <div class="wide-box wide-box-white ">
        <div class="container">
            <div class="dining-recipes-box home-top-recipes home-top-box" style="">
                <div class="headline">
                    <h2>
                        Công thức từ cộng đồng
                    </h2>
                </div>
                <div class="row recipes-list row10">
                    <div class="top-recipes-user">
                        {% if list_recipe is not null %}
                            {% for item in list_recipe %}
                                <div class="today-recipe-user ">
                                    <div class="item-block recipe-block">
                                        <div class="item-content">
                                            <div class="featured-recipe-item">
                                                <div class="recipe-photo">
                                                    <a target="_blank" href="/cong-thuc/{{ item.getCode() }}.html"
                                                       class="photo">
                                                        <img alt="{{ item.getImageId() }}" class="lazy img-responsive"
                                                             src="{{ item.image.image_base }}" style="display: block;">
                                                    </a>
                                                    <a id="{{ item.getId() }}-a" href="javascript:void(0);"
                                                       title="Yêu thích" onclick=""
                                                       class="btn-act btn-add-favourite ng-isolate-scope">
                                                        {% if item.getBookmarkTotal() is not 0 %}
                                                            <span ng-if="{{ item.getBookmarkTotal() }} > 0"
                                                                  class="ng-binding ng-scope">{{ item.getBookmarkTotal() }} &nbsp;</span>
                                                        {% endif %}
                                                        {% if list_bookmark[item.getId()] is sameas('true') %}
                                                            <i class="{{ list_bookmark[item.getId()] }} ico ico-28 ico-iblock ico-favourite ico-favourited"></i>
                                                        {% else %}
                                                            <i class="ico ico-28 ico-iblock ico-favourite "></i>
                                                        {% endif %}
                                                    </a>
                                                </div>
                                                <div class="item-info-box">
                                                    <h3 class="title">
                                                        <a target="_blank" href="/cong-thuc/{{ item.getCode() }}.html"
                                                           title="{{ item.getName() }}">{{ item.getName() }}</a>
                                                    </h3>
                                                    <div class="stats">
                                                        <ul class="list-inline nomargin">
                                                            <li><span class="fa fa-clock-o stats-ico"></span><span
                                                                        class="stats-count"> {{ item.getTimeDo() }}p</span>
                                                            </li>
                                                            <li><span class="fa fa-bolt stats-ico"></span> <span
                                                                        class="stats-text"> {{ item.getLevel() }}</span>
                                                            </li>
                                                            <li><span class="fa fa-bar-chart stats-ico"></span><span
                                                                        class="stats-count"> {{ item.getTotalSeenRecipe(item.getId()) }}</span>
                                                                xem
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-header">
                                            <div class="hprofile">
                                                <div class="profile">
                                                    <span class="postedby-text">công thức bởi:</span>
                                                    <a target="_blank" href="/thanh-vien/{{ item.user.getUserName() }}"
                                                       class="name">{{ item.user.getUserName() }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {% endfor %}
                        {% endif %}
                    </div>
                </div>
            </div>
            <div class="home-top-box top-ranking-members">
                <div class="headline">
                    <h2>
                        TOP THÀNH VIÊN
                    </h2>
                </div>
                <div class="ranking-members-list" style="opacity: 1;">
                    <div class="member-list topchef-list row10">
                        {% if list_top_user is not null %}
                            {% for item in list_top_user %}
                                <div class="member-item-wrapper">
                                    <div class="member-item">
                                        <span class="topnum topnum1">{{ loop.index }}</span>
                                        <div class="member-profile nopadding">
                                            <div class="avatar z-effect">
                                                <img src="{{ item.image.getImageBase() }}"
                                                     class="img-responsive img-circle">
                                            </div>
                                            <div class="profile">
                                                <a target="_blank" href="/thanh-vien/{{ item.getUserName() }}"
                                                   class="cooky-user-link name"
                                                   data-userid="239741">{{ item.getUserName() }}</a>
                                                <span class="stats-text user-lvl tastee "></span>
                                                <div class="stats">
                                            <span class="stats-item">
                                                <span class="stats-count">{{ item.getTotalRecipe(item.getId()) }}</span>
                                                <span class="stats-text">Công thức</span>
                                            </span>
                                                    <span class="stats-item">
                                                <span class="stats-count">{{ item.getTotalUserBookmark(item.getId()) }}</span>
                                                <span class="stats-text">Quan tâm</span>
                                            </span>
                                                </div>
                                                <div class="member-acts">

                                                    <friend-follow-item-button-only ng-cloak="" userid="239741"
                                                                                    status="0"
                                                                                    type="1"></friend-follow-item-button-only>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {% endfor %}
                        {% endif %}

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="wide-box wide-box-white">
        <div class="container">
            <div class="home-top-box">
                <div class="headline">
                    <h2> Công thức phổ biến</h2>
                </div>
                <div class="top-cooky-recipes">
                    <div class="row recipes-list row">
                        <div class="top-recipes">
                            {% if list_seen_popular is not null %}
                                {% for item in list_seen_popular %}
                                    <div class="today-recipe">
                                        <div class="item-block recipe-block">
                                            <div class="item-content">
                                                <div class="featured-recipe-item">
                                                    <div class="recipe-photo">
                                                        <a target="_blank" href="/cong-thuc/{{ item.recipe.getCode() }}.html" class="photo">
                                                            <img alt="{{ item.recipe.getName() }}" class="lazy" src="{{ item.recipe.image.getImageBase() }}" style="width:100%;">
                                                        </a>
                                                        <a id="{{ item.recipe.getId() }}-b" href="javascript:void(0);"
                                                           title="Yêu thích"
                                                           class="btn-act btn-add-favourite ng-isolate-scope">
                                                            {% if item.recipe.getBookmarkTotal() is not 0 %}
                                                                <span ng-if="{{ item.recipe.getBookmarkTotal() }} > 0"
                                                                      class="ng-binding ng-scope">{{ item.recipe.getBookmarkTotal() }} &nbsp;</span>
                                                            {% endif %}
                                                                {% if list_book_recipe_popular[item.recipe.getId()] is sameas('true') %}
                                                                    <i class="ico ico-28 ico-iblock ico-favourite ico-favourited"></i>
                                                                {% else %}
                                                                    <i class="ico ico-28 ico-iblock ico-favourite "></i>
                                                                {% endif %}


                                                        </a>
                                                    </div>
                                                    <div class="item-info-box">
                                                        <h3 class="title">
                                                            <a target="_blank"
                                                               href="/cong-thuc/{{ item.recipe.getCode() }}.html">{{ item.recipe.getName() }}</a>
                                                        </h3>
                                                        <div class="stats">
                                                            <ul class="list-inline nomargin">
                                                                <li><span class="fa fa-clock-o stats-ico"></span><span
                                                                            class="stats-count"> {{ item.recipe.getTimeDo() }}p</span>
                                                                </li>
                                                                <li><span class="fa fa-bolt stats-ico"></span> <span
                                                                            class="stats-text"> {{ item.recipe.getLevel() }}</span>
                                                                </li>
                                                                <li><span class="fa fa-bar-chart stats-ico"></span><span
                                                                            class="stats-count"> {{ item.recipe.getTotalSeenRecipe(item.recipe.getId()) }} xem</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-header">
                                                <div class="hprofile">
                                                    <div class="profile">
                                                        <span class="postedby-text">công thức bởi:</span>
                                                        <a target="_blank"
                                                           href="/thanh-vien/{{ item.recipe.user.getUserName() }}"
                                                           class="name">{{ item.recipe.user.getUserName() }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {% endfor %}
                            {% endif %}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wide-box wide-box-white">
        <div class="container">
            <div class="home-top-box">
                <div class="headline">
                    <h2> Công thức bởi những người bạn quan tâm</h2>
                </div>
                <div class="top-cooky-recipes">
                    <div class="row recipes-list row">
                        <div class="top-recipes">
                            {% if list_recipe_bookmark_usser is not null %}
                                {% for item in list_recipe_bookmark_usser %}
                                    <div class="today-recipe">
                                        <div class="item-block recipe-block">
                                            <div class="item-content">
                                                <div class="featured-recipe-item">
                                                    <div class="recipe-photo">
                                                        <a target="_blank"
                                                           href="/cong-thuc/{{ item.getCode() }}.html"
                                                           class="photo">
                                                            <img alt="{{ item.getName() }}" class="lazy"
                                                                 src="{{ item.image.getImageBase() }}"
                                                                 style="width:100%;">
                                                        </a>
                                                        <a id="{{ item.getId() }}-c" href="javascript:void(0);"
                                                           title="Yêu thích"
                                                           class="btn-act btn-add-favourite ng-isolate-scope">
                                                            {% if item.getBookmarkTotal() is not 0 %}
                                                                <span ng-if="{{ item.getBookmarkTotal() }} > 0"
                                                                      class="ng-binding ng-scope">{{ item.getBookmarkTotal() }} &nbsp;</span>
                                                            {% endif %}
                                                                {% if list_book_recipe_bookmark_user[item.getId()] is sameas('true') %}
                                                                    <i class="ico ico-28 ico-iblock ico-favourite ico-favourited"></i>
                                                                {% else %}
                                                                    <i class="ico ico-28 ico-iblock ico-favourite "></i>
                                                                {% endif %}
                                                        </a>
                                                    </div>
                                                    <div class="item-info-box">
                                                        <h3 class="title">
                                                            <a target="_blank"
                                                               href="/cong-thuc/{{ item.getCode() }}.html">{{ item.getName() }}
                                                            </a>
                                                        </h3>
                                                        <div class="stats">
                                                            <ul class="list-inline nomargin">
                                                                <li><span class="fa fa-clock-o stats-ico"></span><span
                                                                            class="stats-count"> {{ item.getTimeDo() }}p</span>
                                                                </li>
                                                                <li><span class="fa fa-bolt stats-ico"></span> <span
                                                                            class="stats-text"> {{ item.getLevel() }}</span>
                                                                </li>
                                                                <li><span class="fa fa-bar-chart stats-ico"></span><span
                                                                            class="stats-count"> {{ item.getTotalSeenRecipe(item.getId()) }}xem</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-header">
                                                <div class="hprofile">
                                                    <div class="profile">
                                                        <span class="postedby-text">công thức bởi:</span>
                                                        <a target="_blank"
                                                           href="/thanh-vien/{{ item.user.getUserName() }}"
                                                           class="name">{{ item.user.getUserName() }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {% endfor %}
                            {% endif %}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="disableVBX"></div>
</div>
<script type="text/javascript" src="/public/js/jquery.js"></script>
<script type="text/javascript">
    var auth={{ user_id }};
    $('.btn-add-favourite').on('click', function () {
        var id = $(this).attr('id');
        var split_id = id.split('-');
        var split_id_a= split_id[0] +'-a';
        var split_id_b= split_id[0] +'-b';
        var split_id_c= split_id[0] +'-c';
        if(auth=="null" || auth==null || auth=="")
        {
            location.href = '/dang-nhap';
            return false;
        }else{
            $.ajax({
                type: 'Post',
                url: "{{ url.get() }}admin/bookmark/ajaxFavourite",
                data: {
                    id: split_id[0],
                },
                dataType: 'json',
                complete: function (data) {
                    if (data.responseJSON.value == "enable") {
                        $('#' + split_id_a).html("<span ng-if=\"" + data.responseJSON.totalbookmark + " > 0\" class=\"ng-binding ng-scope\">" + data.responseJSON.totalbookmark + " &nbsp;</span>"
                            + "<i class=\"true ico ico-28 ico-iblock ico-favourite ico-favourited\"></i>");
                        $('#' + split_id_b).html("<span ng-if=\"" + data.responseJSON.totalbookmark + " > 0\" class=\"ng-binding ng-scope\">" + data.responseJSON.totalbookmark + " &nbsp;</span>"
                            + "<i class=\"true ico ico-28 ico-iblock ico-favourite ico-favourited\"></i>");
                        $('#' + split_id_c).html("<span ng-if=\"" + data.responseJSON.totalbookmark + " > 0\" class=\"ng-binding ng-scope\">" + data.responseJSON.totalbookmark + " &nbsp;</span>"
                            + "<i class=\"true ico ico-28 ico-iblock ico-favourite ico-favourited\"></i>");
                    } else {
                        if (data.responseJSON.totalbookmark == 0) {
                            $('#' + split_id_a).html("<i class=\"ico ico-28 ico-iblock ico-favourite \"></i>");
                            $('#' + split_id_b).html("<i class=\"ico ico-28 ico-iblock ico-favourite \"></i>");
                            $('#' + split_id_c).html("<i class=\"ico ico-28 ico-iblock ico-favourite \"></i>");
                        } else {
                            $('#' + split_id_a).html("<span ng-if=\"" + data.responseJSON.totalbookmark + " > 0\" class=\"ng-binding ng-scope\">" + data.responseJSON.totalbookmark + " &nbsp;</span>"
                                + "<i class=\"true ico ico-28 ico-iblock ico-favourite \"></i>");
                            $('#' + split_id_b).html("<span ng-if=\"" + data.responseJSON.totalbookmark + " > 0\" class=\"ng-binding ng-scope\">" + data.responseJSON.totalbookmark + " &nbsp;</span>"
                                + "<i class=\"true ico ico-28 ico-iblock ico-favourite \"></i>");
                            $('#' + split_id_c).html("<span ng-if=\"" + data.responseJSON.totalbookmark + " > 0\" class=\"ng-binding ng-scope\">" + data.responseJSON.totalbookmark + " &nbsp;</span>"
                                + "<i class=\"true ico ico-28 ico-iblock ico-favourite \"></i>");
                        }
                    }
                }
            });
        }

    })
</script>