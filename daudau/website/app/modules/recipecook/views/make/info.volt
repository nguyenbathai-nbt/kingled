<div ng-app="searchApp" class="container full-container ng-scope">
    <div ng-controller="SearchController" class="ng-scope">
        <div class="result-box">
            <div class="result-box-inner" style="position: relative;">
                <div class="result-list recipe-list">
                    <div class="result-headline">
                        <div>
                            <div class="result-container">

                                <h1>
                                    <!-- ngIf: false -->
                                    <!-- ngIf: true --><span ng-if="true" class="ng-scope">
                                        <strong class="text-highlight ng-binding">29926 </strong> Món ăn ngon mỗi ngày
                                    </span><!-- end ngIf: true -->

                                </h1>
                                <div class="keyword-suggestions">
                                </div>
                                <div style="float:left;width:100%;">
                                    <div class="random-link">
                                        <ul>
                                            <li style="font-size:11px; font-weight:bold;">Gợi ý :</li>
                                            <li><a href="/cach-lam/rau-muong-xao-toi" target="_blank">rau muong xao toi</a></li>
                                            <li><a href="/cach-lam/long-non-xao-dua-chua" target="_blank">long non xao dua chua</a></li>
                                            <li><a href="/cach-lam/ba-chi-chien-nuoc-mam" target="_blank">ba chi chien nuoc mam</a></li>
                                            <li><a href="/cach-lam/che-khoai-mon" target="_blank">che khoai mon</a></li>
                                            <li><a href="/cach-lam/goi-ga" target="_blank">goi ga</a></li>
                                            <li><a href="/cach-lam/banh-dorayaki" target="_blank">banh dorayaki</a></li>
                                            <li><a href="/cach-lam/lau-ca-dieu-hong" target="_blank">lau ca dieu hong</a></li>
                                            <li><a href="/cach-lam/rau-nhut" target="_blank">rau nhut</a></li>
                                            <li><a href="/cach-lam/lau" target="_blank">lau</a></li>
                                            <li><a href="/cach-lam/mojito-chanh" target="_blank">mojito chanh</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cooky-filter" id="cooky-filter">
                        <div class="filter-bar horizontal" id="filterbar">
                            <div class="filter-headline">
                                <span class="fa fa-sliders text-highlight"></span> <span class="sr-only">Bộ lọc</span>
                            </div>
                            <!-- ngIf: true --><div class="filter-properties ng-scope" ng-if="true">
                                <!-- ngRepeat: filterType in filter.FilterTypes --><div class="filter-property ng-scope" ng-repeat="filterType in filter.FilterTypes">
                                    <div class="property-header ng-binding" ng-class="{'active' : isFilterType(filterType.type)}" ng-click="filterClick(filterType.type)">Thực đơn <span class="fa fa-caret-down"></span></div>
                                </div><!-- end ngRepeat: filterType in filter.FilterTypes --><div class="filter-property ng-scope" ng-repeat="filterType in filter.FilterTypes">
                                    <div class="property-header ng-binding" ng-class="{'active' : isFilterType(filterType.type)}" ng-click="filterClick(filterType.type)">Loại món <span class="fa fa-caret-down"></span></div>
                                </div><!-- end ngRepeat: filterType in filter.FilterTypes --><div class="filter-property ng-scope" ng-repeat="filterType in filter.FilterTypes">
                                    <div class="property-header ng-binding" ng-class="{'active' : isFilterType(filterType.type)}" ng-click="filterClick(filterType.type)">Nguyên liệu <span class="fa fa-caret-down"></span></div>
                                </div><!-- end ngRepeat: filterType in filter.FilterTypes --><div class="filter-property ng-scope" ng-repeat="filterType in filter.FilterTypes">
                                    <div class="property-header ng-binding" ng-class="{'active' : isFilterType(filterType.type)}" ng-click="filterClick(filterType.type)">Độ khó <span class="fa fa-caret-down"></span></div>
                                </div><!-- end ngRepeat: filterType in filter.FilterTypes --><div class="filter-property ng-scope" ng-repeat="filterType in filter.FilterTypes">
                                    <div class="property-header ng-binding" ng-class="{'active' : isFilterType(filterType.type)}" ng-click="filterClick(filterType.type)">Mùa &amp; Dịp lễ <span class="fa fa-caret-down"></span></div>
                                </div><!-- end ngRepeat: filterType in filter.FilterTypes --><div class="filter-property ng-scope" ng-repeat="filterType in filter.FilterTypes">
                                    <div class="property-header ng-binding" ng-class="{'active' : isFilterType(filterType.type)}" ng-click="filterClick(filterType.type)">Ẩm thực <span class="fa fa-caret-down"></span></div>
                                </div><!-- end ngRepeat: filterType in filter.FilterTypes --><div class="filter-property ng-scope" ng-repeat="filterType in filter.FilterTypes">
                                    <div class="property-header ng-binding" ng-class="{'active' : isFilterType(filterType.type)}" ng-click="filterClick(filterType.type)">Cách thực hiện <span class="fa fa-caret-down"></span></div>
                                </div><!-- end ngRepeat: filterType in filter.FilterTypes --><div class="filter-property ng-scope" ng-repeat="filterType in filter.FilterTypes">
                                    <div class="property-header ng-binding" ng-class="{'active' : isFilterType(filterType.type)}" ng-click="filterClick(filterType.type)">Mục đích <span class="fa fa-caret-down"></span></div>
                                </div><!-- end ngRepeat: filterType in filter.FilterTypes -->
                            </div><!-- end ngIf: true -->
                            <div class="pull-right">
                                <div style="margin-right:6px;float: left;">
                                    <div class="well-video">
                                        <!-- ngIf: videostatus == true -->
                                        <!-- ngIf: videostatus == false --><i class="fa fa-toggle-on fa-rotate-180 inactive ng-scope" ng-if="videostatus == false" ng-click="changeStatus();">
                                        </i><!-- end ngIf: videostatus == false -->
                                        <i> video</i>
                                    </div>
                                </div>
                                <div class="sortby" style="margin-right:6px;">
                                    <span class="label">Sắp xếp:</span>
                                    <select ng-change="doSearch()" ng-model="sortType" class="selection ng-pristine ng-untouched ng-valid ng-not-empty" convert-to-number="">
                                        <option value="1">Thực hiện nhiều</option>
                                        <option value="2">Mới nhất</option>
                                        <option value="3">Lượt xem</option>
                                        <option value="5">Yêu thích</option>

                                        <option value="7">Đúng nhất</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- ngIf: showFilterBox --><div style="position: relative; height: auto; padding: 10px;" ng-if="showFilterBox" class="search-filter-box ng-scope" id="cooky-search-filter-div">
                            <!-- ngIf: isLoadingFilterBox -->
                            <!-- ngIf: currentFilters.data.CanSearch -->
                            <!-- ngRepeat: group in currentFilters.data.Groups --><div ng-repeat="group in currentFilters.data.Groups" class="filter-group ng-scope">
                                <!-- ngIf: currentFilters.data.ShowGroupName && filtered.length>0 -->
                                <!-- ngRepeat: item in filtered = ( group.Items | filter: {IsHidden : false}) --><div ng-repeat="item in filtered = ( group.Items | filter: {IsHidden : false})" class="filter-item ng-scope">
            <span ng-click="selectToggle(item)" style="cursor: pointer">
                <span class="fa text-gray fa-square-o" ng-class="{'fa-check-square text-highlight': item.Selected,'fa-square-o': !item.Selected}"></span>

                <span class="ng-binding">Món khai vị</span>
            </span>
                                </div><!-- end ngRepeat: item in filtered = ( group.Items | filter: {IsHidden : false}) --><div ng-repeat="item in filtered = ( group.Items | filter: {IsHidden : false})" class="filter-item ng-scope">
            <span ng-click="selectToggle(item)" style="cursor: pointer">
                <span class="fa text-gray fa-square-o" ng-class="{'fa-check-square text-highlight': item.Selected,'fa-square-o': !item.Selected}"></span>

                <span class="ng-binding">Món tráng miệng</span>
            </span>
                                </div><!-- end ngRepeat: item in filtered = ( group.Items | filter: {IsHidden : false}) --><div ng-repeat="item in filtered = ( group.Items | filter: {IsHidden : false})" class="filter-item ng-scope">
            <span ng-click="selectToggle(item)" style="cursor: pointer">
                <span class="fa text-gray fa-square-o" ng-class="{'fa-check-square text-highlight': item.Selected,'fa-square-o': !item.Selected}"></span>

                <span class="ng-binding">Món chay</span>
            </span>
                                </div><!-- end ngRepeat: item in filtered = ( group.Items | filter: {IsHidden : false}) --><div ng-repeat="item in filtered = ( group.Items | filter: {IsHidden : false})" class="filter-item ng-scope">
            <span ng-click="selectToggle(item)" style="cursor: pointer">
                <span class="fa text-gray fa-square-o" ng-class="{'fa-check-square text-highlight': item.Selected,'fa-square-o': !item.Selected}"></span>

                <span class="ng-binding">Món chính</span>
            </span>
                                </div><!-- end ngRepeat: item in filtered = ( group.Items | filter: {IsHidden : false}) --><div ng-repeat="item in filtered = ( group.Items | filter: {IsHidden : false})" class="filter-item ng-scope">
            <span ng-click="selectToggle(item)" style="cursor: pointer">
                <span class="fa text-gray fa-square-o" ng-class="{'fa-check-square text-highlight': item.Selected,'fa-square-o': !item.Selected}"></span>

                <span class="ng-binding">Món ăn sáng</span>
            </span>
                                </div><!-- end ngRepeat: item in filtered = ( group.Items | filter: {IsHidden : false}) --><div ng-repeat="item in filtered = ( group.Items | filter: {IsHidden : false})" class="filter-item ng-scope">
            <span ng-click="selectToggle(item)" style="cursor: pointer">
                <span class="fa text-gray fa-square-o" ng-class="{'fa-check-square text-highlight': item.Selected,'fa-square-o': !item.Selected}"></span>

                <span class="ng-binding">Nhanh và dễ</span>
            </span>
                                </div><!-- end ngRepeat: item in filtered = ( group.Items | filter: {IsHidden : false}) --><div ng-repeat="item in filtered = ( group.Items | filter: {IsHidden : false})" class="filter-item ng-scope">
            <span ng-click="selectToggle(item)" style="cursor: pointer">
                <span class="fa text-gray fa-square-o" ng-class="{'fa-check-square text-highlight': item.Selected,'fa-square-o': !item.Selected}"></span>

                <span class="ng-binding">Thức uống</span>
            </span>
                                </div><!-- end ngRepeat: item in filtered = ( group.Items | filter: {IsHidden : false}) --><div ng-repeat="item in filtered = ( group.Items | filter: {IsHidden : false})" class="filter-item ng-scope">
            <span ng-click="selectToggle(item)" style="cursor: pointer">
                <span class="fa text-gray fa-square-o" ng-class="{'fa-check-square text-highlight': item.Selected,'fa-square-o': !item.Selected}"></span>

                <span class="ng-binding">Bánh - Bánh ngọt</span>
            </span>
                                </div><!-- end ngRepeat: item in filtered = ( group.Items | filter: {IsHidden : false}) --><div ng-repeat="item in filtered = ( group.Items | filter: {IsHidden : false})" class="filter-item ng-scope">
            <span ng-click="selectToggle(item)" style="cursor: pointer">
                <span class="fa text-gray fa-square-o" ng-class="{'fa-check-square text-highlight': item.Selected,'fa-square-o': !item.Selected}"></span>

                <span class="ng-binding">Món ăn cho trẻ</span>
            </span>
                                </div><!-- end ngRepeat: item in filtered = ( group.Items | filter: {IsHidden : false}) --><div ng-repeat="item in filtered = ( group.Items | filter: {IsHidden : false})" class="filter-item ng-scope">
            <span ng-click="selectToggle(item)" style="cursor: pointer">
                <span class="fa text-gray fa-square-o" ng-class="{'fa-check-square text-highlight': item.Selected,'fa-square-o': !item.Selected}"></span>

                <span class="ng-binding">Món nhậu</span>
            </span>
                                </div><!-- end ngRepeat: item in filtered = ( group.Items | filter: {IsHidden : false}) -->
                            </div><!-- end ngRepeat: group in currentFilters.data.Groups -->

                            <div class="search-more ng-hide" ng-show="currentFilters.canLoadMore()">

                                <a href="javascript:void(0)" ng-click="currentFilters.loadMore()" target="_self">
                                    <span ng-show="!isLoading">Xem thêm </span>...
                                </a>

                            </div>

                        </div><!-- end ngIf: showFilterBox -->
                    </div>
                    <div class="filter-selected-options" style="min-height:16px">
                        <!-- ngRepeat: type in filter.FilterTypes --><div class="dropdown filter-selected-container ng-scope" ng-repeat="type in filter.FilterTypes">
                            <div ng-show="type.selectedItems.length>0" class="filter-selected-item dropdown-toggle ng-hide" data-delay="1000" data-close-others="true" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false">
                                <a href="javascript:void(0)" class="btn-act" style="color: #ddd;" ng-click="clearSelections(type.type)" target="_self">
                                    <span class="fa fa-close" style="margin-top: 3px;"></span>
                                </a>
                                <span class="ng-binding">Thực đơn</span>
                                <span class="caret" style="margin-top:6px; margin-right: 0px;"></span>
                            </div>
                            <ul class="dropdown-menu">
                                <!-- ngRepeat: item in type.selectedItems -->
                            </ul>
                        </div><!-- end ngRepeat: type in filter.FilterTypes --><div class="dropdown filter-selected-container ng-scope" ng-repeat="type in filter.FilterTypes">
                            <div ng-show="type.selectedItems.length>0" class="filter-selected-item dropdown-toggle ng-hide" data-delay="1000" data-close-others="true" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false">
                                <a href="javascript:void(0)" class="btn-act" style="color: #ddd;" ng-click="clearSelections(type.type)" target="_self">
                                    <span class="fa fa-close" style="margin-top: 3px;"></span>
                                </a>
                                <span class="ng-binding">Loại món</span>
                                <span class="caret" style="margin-top:6px; margin-right: 0px;"></span>
                            </div>
                            <ul class="dropdown-menu">
                                <!-- ngRepeat: item in type.selectedItems -->
                            </ul>
                        </div><!-- end ngRepeat: type in filter.FilterTypes --><div class="dropdown filter-selected-container ng-scope" ng-repeat="type in filter.FilterTypes">
                            <div ng-show="type.selectedItems.length>0" class="filter-selected-item dropdown-toggle ng-hide" data-delay="1000" data-close-others="true" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false">
                                <a href="javascript:void(0)" class="btn-act" style="color: #ddd;" ng-click="clearSelections(type.type)" target="_self">
                                    <span class="fa fa-close" style="margin-top: 3px;"></span>
                                </a>
                                <span class="ng-binding">Nguyên liệu</span>
                                <span class="caret" style="margin-top:6px; margin-right: 0px;"></span>
                            </div>
                            <ul class="dropdown-menu">
                                <!-- ngRepeat: item in type.selectedItems -->
                            </ul>
                        </div><!-- end ngRepeat: type in filter.FilterTypes --><div class="dropdown filter-selected-container ng-scope" ng-repeat="type in filter.FilterTypes">
                            <div ng-show="type.selectedItems.length>0" class="filter-selected-item dropdown-toggle ng-hide" data-delay="1000" data-close-others="true" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false">
                                <a href="javascript:void(0)" class="btn-act" style="color: #ddd;" ng-click="clearSelections(type.type)" target="_self">
                                    <span class="fa fa-close" style="margin-top: 3px;"></span>
                                </a>
                                <span class="ng-binding">Độ khó</span>
                                <span class="caret" style="margin-top:6px; margin-right: 0px;"></span>
                            </div>
                            <ul class="dropdown-menu">
                                <!-- ngRepeat: item in type.selectedItems -->
                            </ul>
                        </div><!-- end ngRepeat: type in filter.FilterTypes --><div class="dropdown filter-selected-container ng-scope" ng-repeat="type in filter.FilterTypes">
                            <div ng-show="type.selectedItems.length>0" class="filter-selected-item dropdown-toggle ng-hide" data-delay="1000" data-close-others="true" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false">
                                <a href="javascript:void(0)" class="btn-act" style="color: #ddd;" ng-click="clearSelections(type.type)" target="_self">
                                    <span class="fa fa-close" style="margin-top: 3px;"></span>
                                </a>
                                <span class="ng-binding">Mùa &amp; Dịp lễ</span>
                                <span class="caret" style="margin-top:6px; margin-right: 0px;"></span>
                            </div>
                            <ul class="dropdown-menu">
                                <!-- ngRepeat: item in type.selectedItems -->
                            </ul>
                        </div><!-- end ngRepeat: type in filter.FilterTypes --><div class="dropdown filter-selected-container ng-scope" ng-repeat="type in filter.FilterTypes">
                            <div ng-show="type.selectedItems.length>0" class="filter-selected-item dropdown-toggle ng-hide" data-delay="1000" data-close-others="true" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false">
                                <a href="javascript:void(0)" class="btn-act" style="color: #ddd;" ng-click="clearSelections(type.type)" target="_self">
                                    <span class="fa fa-close" style="margin-top: 3px;"></span>
                                </a>
                                <span class="ng-binding">Ẩm thực</span>
                                <span class="caret" style="margin-top:6px; margin-right: 0px;"></span>
                            </div>
                            <ul class="dropdown-menu">
                                <!-- ngRepeat: item in type.selectedItems -->
                            </ul>
                        </div><!-- end ngRepeat: type in filter.FilterTypes --><div class="dropdown filter-selected-container ng-scope" ng-repeat="type in filter.FilterTypes">
                            <div ng-show="type.selectedItems.length>0" class="filter-selected-item dropdown-toggle ng-hide" data-delay="1000" data-close-others="true" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false">
                                <a href="javascript:void(0)" class="btn-act" style="color: #ddd;" ng-click="clearSelections(type.type)" target="_self">
                                    <span class="fa fa-close" style="margin-top: 3px;"></span>
                                </a>
                                <span class="ng-binding">Cách thực hiện</span>
                                <span class="caret" style="margin-top:6px; margin-right: 0px;"></span>
                            </div>
                            <ul class="dropdown-menu">
                                <!-- ngRepeat: item in type.selectedItems -->
                            </ul>
                        </div><!-- end ngRepeat: type in filter.FilterTypes --><div class="dropdown filter-selected-container ng-scope" ng-repeat="type in filter.FilterTypes">
                            <div ng-show="type.selectedItems.length>0" class="filter-selected-item dropdown-toggle ng-hide" data-delay="1000" data-close-others="true" data-toggle="dropdown" data-hover="dropdown" aria-haspopup="true" aria-expanded="false">
                                <a href="javascript:void(0)" class="btn-act" style="color: #ddd;" ng-click="clearSelections(type.type)" target="_self">
                                    <span class="fa fa-close" style="margin-top: 3px;"></span>
                                </a>
                                <span class="ng-binding">Mục đích</span>
                                <span class="caret" style="margin-top:6px; margin-right: 0px;"></span>
                            </div>
                            <ul class="dropdown-menu">
                                <!-- ngRepeat: item in type.selectedItems -->
                            </ul>
                        </div><!-- end ngRepeat: type in filter.FilterTypes -->
                    </div>
                    <div>
                        <div class="result-list recipe-list row10" style="overflow: initial; display: none;" id="server-view">

                            <div class="result-recipe-wrapper">
                                <div class="result-recipe-item">
                                    <div class="item-inner">
                                        <div class="item-photo">
                                            <a rel="alternate" class="photo" media="only screen and (max-width: 640px)" href="/cong-thuc/banh-bao-sua-22642" target="_blank">
                                                <img data-original="https://media.cooky.vn/recipe/g3/22642/s320x320/recipe22642-636434903807855041.jpg" data-lazy="https://media.cooky.vn/recipe/g3/22642/s320x320/recipe22642-636434903807855041.jpg" alt="Bánh bao sữa" class="lazy photo img-responsive" src="https://media.cooky.vn/recipe/g3/22642/s320x320/recipe22642-636434903807855041.jpg" style="display: block;">
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-header">
                                                <div class="title">
                                                    <h2>
                                                        <a rel="alternate" media="only screen and (max-width: 640px)" href="/cong-thuc/banh-bao-sua-22642" title="Bánh bao sữa" target="_blank">Bánh bao sữa</a>
                                                    </h2>
                                                </div>
                                                <div class="item-stats">
                                                    <div class="stats">
                                                        <ul class="list-inline nomargin">
                                                            <li class="stats-item">
                                                                <span class="fa fa-clock-o stats-ico"></span>
                                                                <span show="recipe.TotalTimeSpan.Hours>0">
                                                                            <span class="stats-count"> 0</span><span class="stats-text">g</span>
                                                                        </span>
                                                                <span show="recipe.TotalTimeSpan.Minutes>0">
                                                                            <span class="stats-count"> 30</span><span class="stats-text">ph</span>
                                                                        </span>
                                                            </li>
                                                            <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count"> 919</span> </li>
                                                            <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count"> </span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ingredients">
                                                    <span> Bột mì</span>
                                                    <span> Đường trắng</span>
                                                    <span> Sữa tươi</span>
                                                    <span> Nước lá dứa</span>
                                                    <span> Men nở</span>

                                                </div>
                                            </div>
                                            <div class="item-footer">
                                                <div class="recipe-by">
                                                    <a href="/thanh-vien/thanhthuydpi" target="_blank">
                                                        <img class="circle" src="https://media.cooky.vn/usr/g1/6609/avt/c50x50/cooky-avatar-636435003757542594.jpg" alt="Bánh bao sữa">
                                                        Thanh Thúy Nguyễn Thị
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="result-recipe-item">
                                    <div class="item-inner">
                                        <div class="item-photo">
                                            <a rel="alternate" class="photo" media="only screen and (max-width: 640px)" href="/cong-thuc/banh-beo-20292" target="_blank">
                                                <img data-original="https://media.cooky.vn/recipe/g3/20292/s320x320/recipe20292-636326043022506538.jpg" data-lazy="https://media.cooky.vn/recipe/g3/20292/s320x320/recipe20292-636326043022506538.jpg" alt="Bánh bèo" class="lazy photo img-responsive" src="https://media.cooky.vn/recipe/g3/20292/s320x320/recipe20292-636326043022506538.jpg" style="display: block;">
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-header">
                                                <div class="title">
                                                    <h2>
                                                        <a rel="alternate" media="only screen and (max-width: 640px)" href="/cong-thuc/banh-beo-20292" title="Bánh bèo" target="_blank">Bánh bèo</a>
                                                    </h2>
                                                </div>
                                                <div class="item-stats">
                                                    <div class="stats">
                                                        <ul class="list-inline nomargin">
                                                            <li class="stats-item">
                                                                <span class="fa fa-clock-o stats-ico"></span>
                                                                <span show="recipe.TotalTimeSpan.Hours>0">
                                                                            <span class="stats-count"> 1</span><span class="stats-text">g</span>
                                                                        </span>
                                                                <span show="recipe.TotalTimeSpan.Minutes>0">
                                                                            <span class="stats-count"> 0</span><span class="stats-text">ph</span>
                                                                        </span>
                                                            </li>
                                                            <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count"> 47536</span> </li>
                                                            <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count"> </span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ingredients">
                                                    <span> Bột gạo</span>
                                                    <span> Bột năng</span>

                                                </div>
                                            </div>
                                            <div class="item-footer">
                                                <div class="recipe-by">
                                                    <a href="/thanh-vien/cooky" target="_blank">
                                                        <img class="circle" src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png" alt="Bánh bèo">
                                                        Cooky VN
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="result-recipe-item">
                                    <div class="item-inner">
                                        <div class="item-photo">
                                            <a rel="alternate" class="photo" media="only screen and (max-width: 640px)" href="/cong-thuc/sua-me-den-cooky-32186" target="_blank">
                                                <img data-original="https://media.cooky.vn/recipe/g4/32186/s320x320/cooky-recipe-cover-r32186.JPG" data-lazy="https://media.cooky.vn/recipe/g4/32186/s320x320/cooky-recipe-cover-r32186.JPG" alt="Sữa mè đen" class="lazy photo img-responsive" src="https://media.cooky.vn/recipe/g4/32186/s320x320/cooky-recipe-cover-r32186.JPG" style="display: block;">
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-header">
                                                <div class="title">
                                                    <h2>
                                                        <a rel="alternate" media="only screen and (max-width: 640px)" href="/cong-thuc/sua-me-den-cooky-32186" title="Sữa mè đen" target="_blank">Sữa mè đen</a>
                                                    </h2>
                                                </div>
                                                <div class="item-stats">
                                                    <div class="stats">
                                                        <ul class="list-inline nomargin">
                                                            <li class="stats-item">
                                                                <span class="fa fa-clock-o stats-ico"></span>
                                                                <span show="recipe.TotalTimeSpan.Hours>0">
                                                                            <span class="stats-count"> 0</span><span class="stats-text">g</span>
                                                                        </span>
                                                                <span show="recipe.TotalTimeSpan.Minutes>0">
                                                                            <span class="stats-count"> 31</span><span class="stats-text">ph</span>
                                                                        </span>
                                                            </li>
                                                            <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count"> 16773</span> </li>
                                                            <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count"> </span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ingredients">
                                                    <span> Mè đen</span>
                                                    <span> Sữa tươi không đường</span>

                                                </div>
                                            </div>
                                            <div class="item-footer">
                                                <div class="recipe-by">
                                                    <a href="/thanh-vien/cooky" target="_blank">
                                                        <img class="circle" src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png" alt="Sữa mè đen">
                                                        Cooky VN
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="result-recipe-item">
                                    <div class="item-inner">
                                        <div class="item-photo">
                                            <a rel="alternate" class="photo" media="only screen and (max-width: 640px)" href="/cong-thuc/banh-bao-nuong-mini-39350" target="_blank">
                                                <img data-original="https://media.cooky.vn/recipe/g4/39350/s320x320/cooky-recipe-cover-r39350.jpg" data-lazy="https://media.cooky.vn/recipe/g4/39350/s320x320/cooky-recipe-cover-r39350.jpg" alt="Bánh bao nướng mini" class="lazy photo img-responsive" src="https://media.cooky.vn/recipe/g4/39350/s320x320/cooky-recipe-cover-r39350.jpg" style="display: block;">
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-header">
                                                <div class="title">
                                                    <h2>
                                                        <a rel="alternate" media="only screen and (max-width: 640px)" href="/cong-thuc/banh-bao-nuong-mini-39350" title="Bánh bao nướng mini" target="_blank">Bánh bao nướng mini</a>
                                                    </h2>
                                                </div>
                                                <div class="item-stats">
                                                    <div class="stats">
                                                        <ul class="list-inline nomargin">
                                                            <li class="stats-item">
                                                                <span class="fa fa-clock-o stats-ico"></span>
                                                                <span show="recipe.TotalTimeSpan.Hours>0">
                                                                            <span class="stats-count"> 0</span><span class="stats-text">g</span>
                                                                        </span>
                                                                <span show="recipe.TotalTimeSpan.Minutes>0">
                                                                            <span class="stats-count"> 40</span><span class="stats-text">ph</span>
                                                                        </span>
                                                            </li>
                                                            <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count"> 430</span> </li>
                                                            <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count"> </span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ingredients">
                                                    <span> Bột bánh bao</span>

                                                </div>
                                            </div>
                                            <div class="item-footer">
                                                <div class="recipe-by">
                                                    <a href="/thanh-vien/thunhan1504" target="_blank">
                                                        <img class="circle" src="https://media.cooky.vn/usr/g16/153137/avt/c50x50/cooky-avatar-636722552809006866.jpg" alt="Bánh bao nướng mini">
                                                        New Balance
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="result-recipe-item">
                                    <div class="item-inner">
                                        <div class="item-photo">
                                            <a rel="alternate" class="photo" media="only screen and (max-width: 640px)" href="/cong-thuc/banh-bap-nhan-pho-mai-chien-gion-30217" target="_blank">
                                                <img data-original="https://media.cooky.vn/recipe/g4/30217/s320x320/cooky-recipe-636603617325977501.png" data-lazy="https://media.cooky.vn/recipe/g4/30217/s320x320/cooky-recipe-636603617325977501.png" alt="Bánh bắp nhân phô mai chiên giòn" class="lazy photo img-responsive" src="https://media.cooky.vn/recipe/g4/30217/s320x320/cooky-recipe-636603617325977501.png" style="display: block;">
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-header">
                                                <div class="title">
                                                    <h2>
                                                        <a rel="alternate" media="only screen and (max-width: 640px)" href="/cong-thuc/banh-bap-nhan-pho-mai-chien-gion-30217" title="Bánh bắp nhân phô mai chiên giòn" target="_blank">Bánh bắp nhân phô mai chiên giòn</a>
                                                    </h2>
                                                </div>
                                                <div class="item-stats">
                                                    <div class="stats">
                                                        <ul class="list-inline nomargin">
                                                            <li class="stats-item">
                                                                <span class="fa fa-clock-o stats-ico"></span>
                                                                <span show="recipe.TotalTimeSpan.Hours>0">
                                                                            <span class="stats-count"> 0</span><span class="stats-text">g</span>
                                                                        </span>
                                                                <span show="recipe.TotalTimeSpan.Minutes>0">
                                                                            <span class="stats-count"> 20</span><span class="stats-text">ph</span>
                                                                        </span>
                                                            </li>
                                                            <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count"> 1474</span> </li>
                                                            <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count"> </span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ingredients">
                                                    <span> Phô mai</span>
                                                    <span> Bột mì</span>
                                                    <span> Bắp hột</span>

                                                </div>
                                            </div>
                                            <div class="item-footer">
                                                <div class="recipe-by">
                                                    <a href="/thanh-vien/quanmanhmultiply" target="_blank">
                                                        <img class="circle" src="https://media.cooky.vn/usr/g12/110264/avt/c50x50/cooky-avatar-636577716242477667.jpg" alt="Bánh bắp nhân phô mai chiên giòn">
                                                        Giang Nguyen
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="result-recipe-item">
                                    <div class="item-inner">
                                        <div class="item-photo">
                                            <a rel="alternate" class="photo" media="only screen and (max-width: 640px)" href="/cong-thuc/thit-ba-chi-lac-sa-tac-cooky-30455" target="_blank">
                                                <img data-original="https://media.cooky.vn/recipe/g4/30455/s320x320/cooky-recipe-cover-r30455.jpg" data-lazy="https://media.cooky.vn/recipe/g4/30455/s320x320/cooky-recipe-cover-r30455.jpg" alt="Thịt ba chỉ lắc sả tắc" class="lazy photo img-responsive" src="https://media.cooky.vn/recipe/g4/30455/s320x320/cooky-recipe-cover-r30455.jpg" style="display: block;">
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-header">
                                                <div class="title">
                                                    <h2>
                                                        <a rel="alternate" media="only screen and (max-width: 640px)" href="/cong-thuc/thit-ba-chi-lac-sa-tac-cooky-30455" title="Thịt ba chỉ lắc sả tắc" target="_blank">Thịt ba chỉ lắc sả tắc</a>
                                                    </h2>
                                                </div>
                                                <div class="item-stats">
                                                    <div class="stats">
                                                        <ul class="list-inline nomargin">
                                                            <li class="stats-item">
                                                                <span class="fa fa-clock-o stats-ico"></span>
                                                                <span show="recipe.TotalTimeSpan.Hours>0">
                                                                            <span class="stats-count"> 0</span><span class="stats-text">g</span>
                                                                        </span>
                                                                <span show="recipe.TotalTimeSpan.Minutes>0">
                                                                            <span class="stats-count"> 30</span><span class="stats-text">ph</span>
                                                                        </span>
                                                            </li>
                                                            <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count"> 12097</span> </li>
                                                            <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count"> </span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ingredients">
                                                    <span> Thịt ba chỉ</span>

                                                </div>
                                            </div>
                                            <div class="item-footer">
                                                <div class="recipe-by">
                                                    <a href="/thanh-vien/cooky" target="_blank">
                                                        <img class="circle" src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png" alt="Thịt ba chỉ lắc sả tắc">
                                                        Cooky VN
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="result-recipe-item">
                                    <div class="item-inner">
                                        <div class="item-photo">
                                            <a rel="alternate" class="photo" media="only screen and (max-width: 640px)" href="/cong-thuc/banh-bao-nhan-thit-trung-2991" target="_blank">
                                                <img data-original="https://media.cooky.vn/recipe/g1/2991/s320x320/recipe2991-636434247715318676.jpg" data-lazy="https://media.cooky.vn/recipe/g1/2991/s320x320/recipe2991-636434247715318676.jpg" alt="Bánh bao nhân thịt trứng" class="lazy photo img-responsive" src="https://media.cooky.vn/recipe/g1/2991/s320x320/recipe2991-636434247715318676.jpg" style="display: block;">
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-header">
                                                <div class="title">
                                                    <h2>
                                                        <a rel="alternate" media="only screen and (max-width: 640px)" href="/cong-thuc/banh-bao-nhan-thit-trung-2991" title="Bánh bao nhân thịt trứng" target="_blank">Bánh bao nhân thịt trứng</a>
                                                    </h2>
                                                </div>
                                                <div class="item-stats">
                                                    <div class="stats">
                                                        <ul class="list-inline nomargin">
                                                            <li class="stats-item">
                                                                <span class="fa fa-clock-o stats-ico"></span>
                                                                <span show="recipe.TotalTimeSpan.Hours>0">
                                                                            <span class="stats-count"> 0</span><span class="stats-text">g</span>
                                                                        </span>
                                                                <span show="recipe.TotalTimeSpan.Minutes>0">
                                                                            <span class="stats-count"> 40</span><span class="stats-text">ph</span>
                                                                        </span>
                                                            </li>
                                                            <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count"> 6244</span> </li>
                                                            <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count"> </span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ingredients">
                                                    <span> Bột bánh bao</span>
                                                    <span> Thịt nạc vai</span>
                                                    <span> Trứng gà</span>

                                                </div>
                                            </div>
                                            <div class="item-footer">
                                                <div class="recipe-by">
                                                    <a href="/thanh-vien/langtudatinh92tn" target="_blank">
                                                        <img class="circle" src="https://media.cooky.vn/usr/g1/6716/avt/c50x50/cooky-avatar-635713426346144030.jpg" alt="Bánh bao nhân thịt trứng">
                                                        gia phat
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="result-recipe-item">
                                    <div class="item-inner">
                                        <div class="item-photo">
                                            <a rel="alternate" class="photo" media="only screen and (max-width: 640px)" href="/cong-thuc/banh-bap-ngot-2013" target="_blank">
                                                <img data-original="https://media.cooky.vn/recipe/g1/2013/s320x320/recipe2013-635695471781400610.jpg" data-lazy="https://media.cooky.vn/recipe/g1/2013/s320x320/recipe2013-635695471781400610.jpg" alt="Bánh bắp ngọt" class="lazy photo img-responsive" src="https://media.cooky.vn/recipe/g1/2013/s320x320/recipe2013-635695471781400610.jpg" style="display: block;">
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-header">
                                                <div class="title">
                                                    <h2>
                                                        <a rel="alternate" media="only screen and (max-width: 640px)" href="/cong-thuc/banh-bap-ngot-2013" title="Bánh bắp ngọt" target="_blank">Bánh bắp ngọt</a>
                                                    </h2>
                                                </div>
                                                <div class="item-stats">
                                                    <div class="stats">
                                                        <ul class="list-inline nomargin">
                                                            <li class="stats-item">
                                                                <span class="fa fa-clock-o stats-ico"></span>
                                                                <span show="recipe.TotalTimeSpan.Hours>0">
                                                                            <span class="stats-count"> 0</span><span class="stats-text">g</span>
                                                                        </span>
                                                                <span show="recipe.TotalTimeSpan.Minutes>0">
                                                                            <span class="stats-count"> 25</span><span class="stats-text">ph</span>
                                                                        </span>
                                                            </li>
                                                            <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count"> 2741</span> </li>
                                                            <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count"> </span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ingredients">
                                                    <span> Bột nếp</span>
                                                    <span> Bột bắp</span>
                                                    <span> Bắp hột</span>

                                                </div>
                                            </div>
                                            <div class="item-footer">
                                                <div class="recipe-by">
                                                    <a href="/thanh-vien/nhumongtran" target="_blank">
                                                        <img class="circle" src="https://media.cooky.vn/usr/g10/94532/avt/c50x50/cooky-avatar-636469383191430221.jpg" alt="Bánh bắp ngọt">
                                                        Như Mộng Trần
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="result-recipe-item">
                                    <div class="item-inner">
                                        <div class="item-photo">
                                            <a rel="alternate" class="photo" media="only screen and (max-width: 640px)" href="/cong-thuc/chan-ga-ham-mat-ong-48113" target="_blank">
                                                <img data-original="https://media.cooky.vn/recipe/g5/48113/s320x320/cooky-recipe-cover-r48113.jpg" data-lazy="https://media.cooky.vn/recipe/g5/48113/s320x320/cooky-recipe-cover-r48113.jpg" alt="Chân gà hầm mật ong" class="lazy photo img-responsive" src="https://media.cooky.vn/recipe/g5/48113/s320x320/cooky-recipe-cover-r48113.jpg" style="display: block;">
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-header">
                                                <div class="title">
                                                    <h2>
                                                        <a rel="alternate" media="only screen and (max-width: 640px)" href="/cong-thuc/chan-ga-ham-mat-ong-48113" title="Chân gà hầm mật ong" target="_blank">Chân gà hầm mật ong</a>
                                                    </h2>
                                                </div>
                                                <div class="item-stats">
                                                    <div class="stats">
                                                        <ul class="list-inline nomargin">
                                                            <li class="stats-item">
                                                                <span class="fa fa-clock-o stats-ico"></span>
                                                                <span show="recipe.TotalTimeSpan.Hours>0">
                                                                            <span class="stats-count"> 0</span><span class="stats-text">g</span>
                                                                        </span>
                                                                <span show="recipe.TotalTimeSpan.Minutes>0">
                                                                            <span class="stats-count"> 55</span><span class="stats-text">ph</span>
                                                                        </span>
                                                            </li>
                                                            <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count"> 613</span> </li>
                                                            <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count"> </span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ingredients">
                                                    <span> Chân gà</span>
                                                    <span> Sườn non</span>
                                                    <span> Mật ong</span>

                                                </div>
                                            </div>
                                            <div class="item-footer">
                                                <div class="recipe-by">
                                                    <a href="/thanh-vien/cooky" target="_blank">
                                                        <img class="circle" src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png" alt="Chân gà hầm mật ong">
                                                        Cooky VN
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="result-recipe-item">
                                    <div class="item-inner">
                                        <div class="item-photo">
                                            <a rel="alternate" class="photo" media="only screen and (max-width: 640px)" href="/cong-thuc/tom-cuon-khoai-tay-cooky-35509" target="_blank">
                                                <img data-original="https://media.cooky.vn/recipe/g4/35509/s320x320/cooky-recipe-cover-r35509.jpg" data-lazy="https://media.cooky.vn/recipe/g4/35509/s320x320/cooky-recipe-cover-r35509.jpg" alt="Tôm cuốn khoai tây" class="lazy photo img-responsive" src="https://media.cooky.vn/recipe/g4/35509/s320x320/cooky-recipe-cover-r35509.jpg" style="display: block;">
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-header">
                                                <div class="title">
                                                    <h2>
                                                        <a rel="alternate" media="only screen and (max-width: 640px)" href="/cong-thuc/tom-cuon-khoai-tay-cooky-35509" title="Tôm cuốn khoai tây" target="_blank">Tôm cuốn khoai tây</a>
                                                    </h2>
                                                </div>
                                                <div class="item-stats">
                                                    <div class="stats">
                                                        <ul class="list-inline nomargin">
                                                            <li class="stats-item">
                                                                <span class="fa fa-clock-o stats-ico"></span>
                                                                <span show="recipe.TotalTimeSpan.Hours>0">
                                                                            <span class="stats-count"> 0</span><span class="stats-text">g</span>
                                                                        </span>
                                                                <span show="recipe.TotalTimeSpan.Minutes>0">
                                                                            <span class="stats-count"> 45</span><span class="stats-text">ph</span>
                                                                        </span>
                                                            </li>
                                                            <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count"> 10076</span> </li>
                                                            <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count"> </span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ingredients">
                                                    <span> Khoai tây</span>
                                                    <span> Tôm tươi</span>

                                                </div>
                                            </div>
                                            <div class="item-footer">
                                                <div class="recipe-by">
                                                    <a href="/thanh-vien/cooky" target="_blank">
                                                        <img class="circle" src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png" alt="Tôm cuốn khoai tây">
                                                        Cooky VN
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="result-recipe-item">
                                    <div class="item-inner">
                                        <div class="item-photo">
                                            <a rel="alternate" class="photo" media="only screen and (max-width: 640px)" href="/cong-thuc/banh-bap-hot-chien-gion-10458" target="_blank">
                                                <img data-original="https://media.cooky.vn/recipe/g2/10458/s320x320/recipe10458-636398605831377203.jpg" data-lazy="https://media.cooky.vn/recipe/g2/10458/s320x320/recipe10458-636398605831377203.jpg" alt="Bánh bắp hột chiên giòn" class="lazy photo img-responsive" src="https://media.cooky.vn/recipe/g2/10458/s320x320/recipe10458-636398605831377203.jpg" style="display: block;">
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-header">
                                                <div class="title">
                                                    <h2>
                                                        <a rel="alternate" media="only screen and (max-width: 640px)" href="/cong-thuc/banh-bap-hot-chien-gion-10458" title="Bánh bắp hột chiên giòn" target="_blank">Bánh bắp hột chiên giòn</a>
                                                    </h2>
                                                </div>
                                                <div class="item-stats">
                                                    <div class="stats">
                                                        <ul class="list-inline nomargin">
                                                            <li class="stats-item">
                                                                <span class="fa fa-clock-o stats-ico"></span>
                                                                <span show="recipe.TotalTimeSpan.Hours>0">
                                                                            <span class="stats-count"> 0</span><span class="stats-text">g</span>
                                                                        </span>
                                                                <span show="recipe.TotalTimeSpan.Minutes>0">
                                                                            <span class="stats-count"> 15</span><span class="stats-text">ph</span>
                                                                        </span>
                                                            </li>
                                                            <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count"> 2967</span> </li>
                                                            <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count"> </span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ingredients">
                                                    <span> Bột bắp</span>
                                                    <span> Bắp hột</span>

                                                </div>
                                            </div>
                                            <div class="item-footer">
                                                <div class="recipe-by">
                                                    <a href="/thanh-vien/thienkhai95" target="_blank">
                                                        <img class="circle" src="https://media.cooky.vn/usr/g10/95294/avt/c50x50/cooky-avatar-636473722340884602.jpg" alt="Bánh bắp hột chiên giòn">
                                                        Thiên Khải
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="result-recipe-item">
                                    <div class="item-inner">
                                        <div class="item-photo">
                                            <a rel="alternate" class="photo" media="only screen and (max-width: 640px)" href="/cong-thuc/tom-song-sot-thai-cooky-29996" target="_blank">
                                                <img data-original="https://media.cooky.vn/recipe/g3/29996/s320x320/cooky-recipe-cover-r29996.JPG" data-lazy="https://media.cooky.vn/recipe/g3/29996/s320x320/cooky-recipe-cover-r29996.JPG" alt="Tôm sống sốt Thái" class="lazy photo img-responsive" src="https://media.cooky.vn/recipe/g3/29996/s320x320/cooky-recipe-cover-r29996.JPG" style="display: block;">
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-header">
                                                <div class="title">
                                                    <h2>
                                                        <a rel="alternate" media="only screen and (max-width: 640px)" href="/cong-thuc/tom-song-sot-thai-cooky-29996" title="Tôm sống sốt Thái" target="_blank">Tôm sống sốt Thái</a>
                                                    </h2>
                                                </div>
                                                <div class="item-stats">
                                                    <div class="stats">
                                                        <ul class="list-inline nomargin">
                                                            <li class="stats-item">
                                                                <span class="fa fa-clock-o stats-ico"></span>
                                                                <span show="recipe.TotalTimeSpan.Hours>0">
                                                                            <span class="stats-count"> 0</span><span class="stats-text">g</span>
                                                                        </span>
                                                                <span show="recipe.TotalTimeSpan.Minutes>0">
                                                                            <span class="stats-count"> 30</span><span class="stats-text">ph</span>
                                                                        </span>
                                                            </li>
                                                            <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count"> 48276</span> </li>
                                                            <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count"> </span></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ingredients">
                                                    <span> Tôm tươi</span>

                                                </div>
                                            </div>
                                            <div class="item-footer">
                                                <div class="recipe-by">
                                                    <a href="/thanh-vien/cooky" target="_blank">
                                                        <img class="circle" src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png" alt="Tôm sống sốt Thái">
                                                        Cooky VN
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <style type="text/css">
                            .rating-score { width: 70px !important; }
                            .rating-score img { width: 10px; }
                            .btn-group { margin-left: 0 !important; }
                            .btn-group .btn.dropdown-toggle { border-top-left-radius: 0; border-bottom-left-radius: 0; }
                        </style>

                        <div class="result-recipe-wrapper row10">
                            <!-- ngRepeat: recipe in recipes --><div ng-repeat="recipe in recipes" class="result-recipe-item ng-scope">
                                <div class="item-inner">
                                    <div class="item-photo">
                                        <a class="photo" rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/banh-bao-sua-22642" href="/cong-thuc/banh-bao-sua-22642" target="_blank">
                                            <img ng-src="https://media.cooky.vn/recipe/g3/22642/s320x320/recipe22642-636434903807855041.jpg" alt="Bánh bao sữa" class="photo img-responsive" src="https://media.cooky.vn/recipe/g3/22642/s320x320/recipe22642-636434903807855041.jpg">
                                            <!-- ngIf: recipe.Video -->
                                        </a>
                                        <a href="javascript:void(0);" title="Yêu thích" ng-click="like()" class="btn-act btn-add-favourite ng-isolate-scope" options="recipe"><!-- ngIf: totalLikes > 0 --><span ng-if="totalLikes > 0" class="ng-binding ng-scope">15 &nbsp;</span><!-- end ngIf: totalLikes > 0 --><i class="ico ico-28 ico-iblock ico-favourite" ng-class="{'ico-favourite': !isLiked, 'ico-favourited' : isLiked}"></i></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-header">
                                            <div class="title">
                                                <h2>
                                                    <a rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/banh-bao-sua-22642" title="Bánh bao sữa" href="/cong-thuc/banh-bao-sua-22642" target="_blank" class="ng-binding">Bánh bao sữa</a>
                                                </h2>
                                            </div>
                                            <div class="item-stats">
                                                <div class="stats">
                                                    <ul class="list-inline nomargin">
                                                        <li class="stats-item">
                                                            <span class="fa fa-clock-o stats-ico"></span>
                                                            <span ng-show="recipe.TotalTimeSpan.Hours>0" class="ng-hide">
                                        <span class="stats-count ng-binding"> 0</span><span class="stats-text">g</span>
                                    </span>
                                                            <span ng-show="recipe.TotalTimeSpan.Minutes>0">
                                        <span class="stats-count ng-binding"> 30</span><span class="stats-text">ph</span>
                                    </span>
                                                        </li>
                                                        <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count ng-binding"> 919</span></li>
                                                        <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count ng-binding"> Dễ</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ingredients" style="font-size:12px">
                                                <!-- ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Bột mì</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Đường trắng</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Sữa tươi</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Nước lá dứa</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Men nở</span><!-- end ngRepeat: ing in recipe.MainIngredients -->
                                            </div>
                                        </div>
                                        <div class="item-footer">
                                            <div class="recipe-by">
                                                <a ng-href="/thanh-vien/thanhthuydpi" href="/thanh-vien/thanhthuydpi" target="_blank" class="ng-binding">
                                                    <img class="circle" ng-src="https://media.cooky.vn/usr/g1/6609/avt/c50x50/cooky-avatar-636435003757542594.jpg" alt="Bánh bao sữa" src="https://media.cooky.vn/usr/g1/6609/avt/c50x50/cooky-avatar-636435003757542594.jpg">
                                                    Thanh Thúy Nguyễn Thị
                                                </a>
                                            </div>
                                            <div class="recipe-acts">

                                                <a href="javascript:void(0)" recipe-add-collection-item-popup-full="" options="recipe" class="btn btn-save ng-isolate-scope" title="thêm vào bộ sưu tập" target="_self">
                                                    <i class="ico ico-24 ico-block ico-save"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <span class="fa fa-star text-orange"></span>
                                        <span class="ng-binding">10.0</span>
                                    </div>

                                </div>
                            </div><!-- end ngRepeat: recipe in recipes --><div ng-repeat="recipe in recipes" class="result-recipe-item ng-scope">
                                <div class="item-inner">
                                    <div class="item-photo">
                                        <a class="photo" rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/banh-beo-20292" href="/cong-thuc/banh-beo-20292" target="_blank">
                                            <img ng-src="https://media.cooky.vn/recipe/g3/20292/s320x320/recipe20292-636326043022506538.jpg" alt="Bánh bèo" class="photo img-responsive" src="https://media.cooky.vn/recipe/g3/20292/s320x320/recipe20292-636326043022506538.jpg">
                                            <!-- ngIf: recipe.Video --><img ng-if="recipe.Video" class="play-ico ng-scope" alt="Bánh bèo" src="/Content/img/icons/cooky-video-play-fill.png"><!-- end ngIf: recipe.Video -->
                                        </a>
                                        <a href="javascript:void(0);" title="Yêu thích" ng-click="like()" class="btn-act btn-add-favourite ng-isolate-scope" options="recipe"><!-- ngIf: totalLikes > 0 --><span ng-if="totalLikes > 0" class="ng-binding ng-scope">226 &nbsp;</span><!-- end ngIf: totalLikes > 0 --><i class="ico ico-28 ico-iblock ico-favourite" ng-class="{'ico-favourite': !isLiked, 'ico-favourited' : isLiked}"></i></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-header">
                                            <div class="title">
                                                <h2>
                                                    <a rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/banh-beo-20292" title="Bánh bèo" href="/cong-thuc/banh-beo-20292" target="_blank" class="ng-binding">Bánh bèo</a>
                                                </h2>
                                            </div>
                                            <div class="item-stats">
                                                <div class="stats">
                                                    <ul class="list-inline nomargin">
                                                        <li class="stats-item">
                                                            <span class="fa fa-clock-o stats-ico"></span>
                                                            <span ng-show="recipe.TotalTimeSpan.Hours>0">
                                        <span class="stats-count ng-binding"> 1</span><span class="stats-text">g</span>
                                    </span>
                                                            <span ng-show="recipe.TotalTimeSpan.Minutes>0" class="ng-hide">
                                        <span class="stats-count ng-binding"> 0</span><span class="stats-text">ph</span>
                                    </span>
                                                        </li>
                                                        <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count ng-binding"> 47.5K</span></li>
                                                        <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count ng-binding"> Trung bình</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ingredients" style="font-size:12px">
                                                <!-- ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Bột gạo</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Bột năng</span><!-- end ngRepeat: ing in recipe.MainIngredients -->
                                            </div>
                                        </div>
                                        <div class="item-footer">
                                            <div class="recipe-by">
                                                <a ng-href="/thanh-vien/cooky" href="/thanh-vien/cooky" target="_blank" class="ng-binding">
                                                    <img class="circle" ng-src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png" alt="Bánh bèo" src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png">
                                                    Cooky VN
                                                </a>
                                            </div>
                                            <div class="recipe-acts">

                                                <a href="javascript:void(0)" recipe-add-collection-item-popup-full="" options="recipe" class="btn btn-save ng-isolate-scope" title="thêm vào bộ sưu tập" target="_self">
                                                    <i class="ico ico-24 ico-block ico-save"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <span class="fa fa-star text-orange"></span>
                                        <span class="ng-binding">9.0</span>
                                    </div>

                                </div>
                            </div><!-- end ngRepeat: recipe in recipes --><div ng-repeat="recipe in recipes" class="result-recipe-item ng-scope">
                                <div class="item-inner">
                                    <div class="item-photo">
                                        <a class="photo" rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/sua-me-den-cooky-32186" href="/cong-thuc/sua-me-den-cooky-32186" target="_blank">
                                            <img ng-src="https://media.cooky.vn/recipe/g4/32186/s320x320/cooky-recipe-cover-r32186.JPG" alt="Sữa mè đen" class="photo img-responsive" src="https://media.cooky.vn/recipe/g4/32186/s320x320/cooky-recipe-cover-r32186.JPG">
                                            <!-- ngIf: recipe.Video --><img ng-if="recipe.Video" class="play-ico ng-scope" alt="Sữa mè đen" src="/Content/img/icons/cooky-video-play-fill.png"><!-- end ngIf: recipe.Video -->
                                        </a>
                                        <a href="javascript:void(0);" title="Yêu thích" ng-click="like()" class="btn-act btn-add-favourite ng-isolate-scope" options="recipe"><!-- ngIf: totalLikes > 0 --><span ng-if="totalLikes > 0" class="ng-binding ng-scope">468 &nbsp;</span><!-- end ngIf: totalLikes > 0 --><i class="ico ico-28 ico-iblock ico-favourite" ng-class="{'ico-favourite': !isLiked, 'ico-favourited' : isLiked}"></i></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-header">
                                            <div class="title">
                                                <h2>
                                                    <a rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/sua-me-den-cooky-32186" title="Sữa mè đen" href="/cong-thuc/sua-me-den-cooky-32186" target="_blank" class="ng-binding">Sữa mè đen</a>
                                                </h2>
                                            </div>
                                            <div class="item-stats">
                                                <div class="stats">
                                                    <ul class="list-inline nomargin">
                                                        <li class="stats-item">
                                                            <span class="fa fa-clock-o stats-ico"></span>
                                                            <span ng-show="recipe.TotalTimeSpan.Hours>0" class="ng-hide">
                                        <span class="stats-count ng-binding"> 0</span><span class="stats-text">g</span>
                                    </span>
                                                            <span ng-show="recipe.TotalTimeSpan.Minutes>0">
                                        <span class="stats-count ng-binding"> 31</span><span class="stats-text">ph</span>
                                    </span>
                                                        </li>
                                                        <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count ng-binding"> 16.8K</span></li>
                                                        <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count ng-binding"> Dễ</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ingredients" style="font-size:12px">
                                                <!-- ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Mè đen</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Sữa tươi không đường</span><!-- end ngRepeat: ing in recipe.MainIngredients -->
                                            </div>
                                        </div>
                                        <div class="item-footer">
                                            <div class="recipe-by">
                                                <a ng-href="/thanh-vien/cooky" href="/thanh-vien/cooky" target="_blank" class="ng-binding">
                                                    <img class="circle" ng-src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png" alt="Sữa mè đen" src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png">
                                                    Cooky VN
                                                </a>
                                            </div>
                                            <div class="recipe-acts">

                                                <a href="javascript:void(0)" recipe-add-collection-item-popup-full="" options="recipe" class="btn btn-save ng-isolate-scope" title="thêm vào bộ sưu tập" target="_self">
                                                    <i class="ico ico-24 ico-block ico-save"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <span class="fa fa-star text-orange"></span>
                                        <span class="ng-binding">9.0</span>
                                    </div>

                                </div>
                            </div><!-- end ngRepeat: recipe in recipes --><div ng-repeat="recipe in recipes" class="result-recipe-item ng-scope">
                                <div class="item-inner">
                                    <div class="item-photo">
                                        <a class="photo" rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/banh-bao-nuong-mini-39350" href="/cong-thuc/banh-bao-nuong-mini-39350" target="_blank">
                                            <img ng-src="https://media.cooky.vn/recipe/g4/39350/s320x320/cooky-recipe-cover-r39350.jpg" alt="Bánh bao nướng mini" class="photo img-responsive" src="https://media.cooky.vn/recipe/g4/39350/s320x320/cooky-recipe-cover-r39350.jpg">
                                            <!-- ngIf: recipe.Video -->
                                        </a>
                                        <a href="javascript:void(0);" title="Yêu thích" ng-click="like()" class="btn-act btn-add-favourite ng-isolate-scope" options="recipe"><!-- ngIf: totalLikes > 0 --><span ng-if="totalLikes > 0" class="ng-binding ng-scope">17 &nbsp;</span><!-- end ngIf: totalLikes > 0 --><i class="ico ico-28 ico-iblock ico-favourite" ng-class="{'ico-favourite': !isLiked, 'ico-favourited' : isLiked}"></i></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-header">
                                            <div class="title">
                                                <h2>
                                                    <a rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/banh-bao-nuong-mini-39350" title="Bánh bao nướng mini" href="/cong-thuc/banh-bao-nuong-mini-39350" target="_blank" class="ng-binding">Bánh bao nướng mini</a>
                                                </h2>
                                            </div>
                                            <div class="item-stats">
                                                <div class="stats">
                                                    <ul class="list-inline nomargin">
                                                        <li class="stats-item">
                                                            <span class="fa fa-clock-o stats-ico"></span>
                                                            <span ng-show="recipe.TotalTimeSpan.Hours>0" class="ng-hide">
                                        <span class="stats-count ng-binding"> 0</span><span class="stats-text">g</span>
                                    </span>
                                                            <span ng-show="recipe.TotalTimeSpan.Minutes>0">
                                        <span class="stats-count ng-binding"> 40</span><span class="stats-text">ph</span>
                                    </span>
                                                        </li>
                                                        <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count ng-binding"> 430</span></li>
                                                        <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count ng-binding"> Dễ</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ingredients" style="font-size:12px">
                                                <!-- ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Bột bánh bao</span><!-- end ngRepeat: ing in recipe.MainIngredients -->
                                            </div>
                                        </div>
                                        <div class="item-footer">
                                            <div class="recipe-by">
                                                <a ng-href="/thanh-vien/thunhan1504" href="/thanh-vien/thunhan1504" target="_blank" class="ng-binding">
                                                    <img class="circle" ng-src="https://media.cooky.vn/usr/g16/153137/avt/c50x50/cooky-avatar-636722552809006866.jpg" alt="Bánh bao nướng mini" src="https://media.cooky.vn/usr/g16/153137/avt/c50x50/cooky-avatar-636722552809006866.jpg">
                                                    New Balance
                                                </a>
                                            </div>
                                            <div class="recipe-acts">

                                                <a href="javascript:void(0)" recipe-add-collection-item-popup-full="" options="recipe" class="btn btn-save ng-isolate-scope" title="thêm vào bộ sưu tập" target="_self">
                                                    <i class="ico ico-24 ico-block ico-save"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <span class="fa fa-star text-orange"></span>
                                        <span class="ng-binding">9.0</span>
                                    </div>

                                </div>
                            </div><!-- end ngRepeat: recipe in recipes --><div ng-repeat="recipe in recipes" class="result-recipe-item ng-scope">
                                <div class="item-inner">
                                    <div class="item-photo">
                                        <a class="photo" rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/banh-bap-nhan-pho-mai-chien-gion-30217" href="/cong-thuc/banh-bap-nhan-pho-mai-chien-gion-30217" target="_blank">
                                            <img ng-src="https://media.cooky.vn/recipe/g4/30217/s320x320/cooky-recipe-636603617325977501.png" alt="Bánh bắp nhân phô mai chiên giòn" class="photo img-responsive" src="https://media.cooky.vn/recipe/g4/30217/s320x320/cooky-recipe-636603617325977501.png">
                                            <!-- ngIf: recipe.Video -->
                                        </a>
                                        <a href="javascript:void(0);" title="Yêu thích" ng-click="like()" class="btn-act btn-add-favourite ng-isolate-scope" options="recipe"><!-- ngIf: totalLikes > 0 --><span ng-if="totalLikes > 0" class="ng-binding ng-scope">26 &nbsp;</span><!-- end ngIf: totalLikes > 0 --><i class="ico ico-28 ico-iblock ico-favourite" ng-class="{'ico-favourite': !isLiked, 'ico-favourited' : isLiked}"></i></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-header">
                                            <div class="title">
                                                <h2>
                                                    <a rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/banh-bap-nhan-pho-mai-chien-gion-30217" title="Bánh bắp nhân phô mai chiên giòn" href="/cong-thuc/banh-bap-nhan-pho-mai-chien-gion-30217" target="_blank" class="ng-binding">Bánh bắp nhân phô mai chiên giòn</a>
                                                </h2>
                                            </div>
                                            <div class="item-stats">
                                                <div class="stats">
                                                    <ul class="list-inline nomargin">
                                                        <li class="stats-item">
                                                            <span class="fa fa-clock-o stats-ico"></span>
                                                            <span ng-show="recipe.TotalTimeSpan.Hours>0" class="ng-hide">
                                        <span class="stats-count ng-binding"> 0</span><span class="stats-text">g</span>
                                    </span>
                                                            <span ng-show="recipe.TotalTimeSpan.Minutes>0">
                                        <span class="stats-count ng-binding"> 20</span><span class="stats-text">ph</span>
                                    </span>
                                                        </li>
                                                        <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count ng-binding"> 1.5K</span></li>
                                                        <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count ng-binding"> Dễ</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ingredients" style="font-size:12px">
                                                <!-- ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Phô mai</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Bột mì</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Bắp hột</span><!-- end ngRepeat: ing in recipe.MainIngredients -->
                                            </div>
                                        </div>
                                        <div class="item-footer">
                                            <div class="recipe-by">
                                                <a ng-href="/thanh-vien/quanmanhmultiply" href="/thanh-vien/quanmanhmultiply" target="_blank" class="ng-binding">
                                                    <img class="circle" ng-src="https://media.cooky.vn/usr/g12/110264/avt/c50x50/cooky-avatar-636577716242477667.jpg" alt="Bánh bắp nhân phô mai chiên giòn" src="https://media.cooky.vn/usr/g12/110264/avt/c50x50/cooky-avatar-636577716242477667.jpg">
                                                    Giang Nguyen
                                                </a>
                                            </div>
                                            <div class="recipe-acts">

                                                <a href="javascript:void(0)" recipe-add-collection-item-popup-full="" options="recipe" class="btn btn-save ng-isolate-scope" title="thêm vào bộ sưu tập" target="_self">
                                                    <i class="ico ico-24 ico-block ico-save"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <span class="fa fa-star text-orange"></span>
                                        <span class="ng-binding">7.0</span>
                                    </div>

                                </div>
                            </div><!-- end ngRepeat: recipe in recipes --><div ng-repeat="recipe in recipes" class="result-recipe-item ng-scope">
                                <div class="item-inner">
                                    <div class="item-photo">
                                        <a class="photo" rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/thit-ba-chi-lac-sa-tac-cooky-30455" href="/cong-thuc/thit-ba-chi-lac-sa-tac-cooky-30455" target="_blank">
                                            <img ng-src="https://media.cooky.vn/recipe/g4/30455/s320x320/cooky-recipe-cover-r30455.jpg" alt="Thịt ba chỉ lắc sả tắc" class="photo img-responsive" src="https://media.cooky.vn/recipe/g4/30455/s320x320/cooky-recipe-cover-r30455.jpg">
                                            <!-- ngIf: recipe.Video --><img ng-if="recipe.Video" class="play-ico ng-scope" alt="Thịt ba chỉ lắc sả tắc" src="/Content/img/icons/cooky-video-play-fill.png"><!-- end ngIf: recipe.Video -->
                                        </a>
                                        <a href="javascript:void(0);" title="Yêu thích" ng-click="like()" class="btn-act btn-add-favourite ng-isolate-scope" options="recipe"><!-- ngIf: totalLikes > 0 --><span ng-if="totalLikes > 0" class="ng-binding ng-scope">411 &nbsp;</span><!-- end ngIf: totalLikes > 0 --><i class="ico ico-28 ico-iblock ico-favourite" ng-class="{'ico-favourite': !isLiked, 'ico-favourited' : isLiked}"></i></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-header">
                                            <div class="title">
                                                <h2>
                                                    <a rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/thit-ba-chi-lac-sa-tac-cooky-30455" title="Thịt ba chỉ lắc sả tắc" href="/cong-thuc/thit-ba-chi-lac-sa-tac-cooky-30455" target="_blank" class="ng-binding">Thịt ba chỉ lắc sả tắc</a>
                                                </h2>
                                            </div>
                                            <div class="item-stats">
                                                <div class="stats">
                                                    <ul class="list-inline nomargin">
                                                        <li class="stats-item">
                                                            <span class="fa fa-clock-o stats-ico"></span>
                                                            <span ng-show="recipe.TotalTimeSpan.Hours>0" class="ng-hide">
                                        <span class="stats-count ng-binding"> 0</span><span class="stats-text">g</span>
                                    </span>
                                                            <span ng-show="recipe.TotalTimeSpan.Minutes>0">
                                        <span class="stats-count ng-binding"> 30</span><span class="stats-text">ph</span>
                                    </span>
                                                        </li>
                                                        <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count ng-binding"> 12.1K</span></li>
                                                        <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count ng-binding"> Dễ</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ingredients" style="font-size:12px">
                                                <!-- ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Thịt ba chỉ</span><!-- end ngRepeat: ing in recipe.MainIngredients -->
                                            </div>
                                        </div>
                                        <div class="item-footer">
                                            <div class="recipe-by">
                                                <a ng-href="/thanh-vien/cooky" href="/thanh-vien/cooky" target="_blank" class="ng-binding">
                                                    <img class="circle" ng-src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png" alt="Thịt ba chỉ lắc sả tắc" src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png">
                                                    Cooky VN
                                                </a>
                                            </div>
                                            <div class="recipe-acts">

                                                <a href="javascript:void(0)" recipe-add-collection-item-popup-full="" options="recipe" class="btn btn-save ng-isolate-scope" title="thêm vào bộ sưu tập" target="_self">
                                                    <i class="ico ico-24 ico-block ico-save"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <span class="fa fa-star text-orange"></span>
                                        <span class="ng-binding">8.3</span>
                                    </div>

                                </div>
                            </div><!-- end ngRepeat: recipe in recipes --><div ng-repeat="recipe in recipes" class="result-recipe-item ng-scope">
                                <div class="item-inner">
                                    <div class="item-photo">
                                        <a class="photo" rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/banh-bao-nhan-thit-trung-2991" href="/cong-thuc/banh-bao-nhan-thit-trung-2991" target="_blank">
                                            <img ng-src="https://media.cooky.vn/recipe/g1/2991/s320x320/recipe2991-636434247715318676.jpg" alt="Bánh bao nhân thịt trứng" class="photo img-responsive" src="https://media.cooky.vn/recipe/g1/2991/s320x320/recipe2991-636434247715318676.jpg">
                                            <!-- ngIf: recipe.Video -->
                                        </a>
                                        <a href="javascript:void(0);" title="Yêu thích" ng-click="like()" class="btn-act btn-add-favourite ng-isolate-scope" options="recipe"><!-- ngIf: totalLikes > 0 --><span ng-if="totalLikes > 0" class="ng-binding ng-scope">35 &nbsp;</span><!-- end ngIf: totalLikes > 0 --><i class="ico ico-28 ico-iblock ico-favourite" ng-class="{'ico-favourite': !isLiked, 'ico-favourited' : isLiked}"></i></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-header">
                                            <div class="title">
                                                <h2>
                                                    <a rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/banh-bao-nhan-thit-trung-2991" title="Bánh bao nhân thịt trứng" href="/cong-thuc/banh-bao-nhan-thit-trung-2991" target="_blank" class="ng-binding">Bánh bao nhân thịt trứng</a>
                                                </h2>
                                            </div>
                                            <div class="item-stats">
                                                <div class="stats">
                                                    <ul class="list-inline nomargin">
                                                        <li class="stats-item">
                                                            <span class="fa fa-clock-o stats-ico"></span>
                                                            <span ng-show="recipe.TotalTimeSpan.Hours>0" class="ng-hide">
                                        <span class="stats-count ng-binding"> 0</span><span class="stats-text">g</span>
                                    </span>
                                                            <span ng-show="recipe.TotalTimeSpan.Minutes>0">
                                        <span class="stats-count ng-binding"> 40</span><span class="stats-text">ph</span>
                                    </span>
                                                        </li>
                                                        <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count ng-binding"> 6.2K</span></li>
                                                        <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count ng-binding"> Trung bình</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ingredients" style="font-size:12px">
                                                <!-- ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Bột bánh bao</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Thịt nạc vai</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Trứng gà</span><!-- end ngRepeat: ing in recipe.MainIngredients -->
                                            </div>
                                        </div>
                                        <div class="item-footer">
                                            <div class="recipe-by">
                                                <a ng-href="/thanh-vien/langtudatinh92tn" href="/thanh-vien/langtudatinh92tn" target="_blank" class="ng-binding">
                                                    <img class="circle" ng-src="https://media.cooky.vn/usr/g1/6716/avt/c50x50/cooky-avatar-635713426346144030.jpg" alt="Bánh bao nhân thịt trứng" src="https://media.cooky.vn/usr/g1/6716/avt/c50x50/cooky-avatar-635713426346144030.jpg">
                                                    gia phat
                                                </a>
                                            </div>
                                            <div class="recipe-acts">

                                                <a href="javascript:void(0)" recipe-add-collection-item-popup-full="" options="recipe" class="btn btn-save ng-isolate-scope" title="thêm vào bộ sưu tập" target="_self">
                                                    <i class="ico ico-24 ico-block ico-save"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <span class="fa fa-star text-orange"></span>
                                        <span class="ng-binding">8.0</span>
                                    </div>

                                </div>
                            </div><!-- end ngRepeat: recipe in recipes --><div ng-repeat="recipe in recipes" class="result-recipe-item ng-scope">
                                <div class="item-inner">
                                    <div class="item-photo">
                                        <a class="photo" rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/banh-bap-ngot-2013" href="/cong-thuc/banh-bap-ngot-2013" target="_blank">
                                            <img ng-src="https://media.cooky.vn/recipe/g1/2013/s320x320/recipe2013-635695471781400610.jpg" alt="Bánh bắp ngọt" class="photo img-responsive" src="https://media.cooky.vn/recipe/g1/2013/s320x320/recipe2013-635695471781400610.jpg">
                                            <!-- ngIf: recipe.Video -->
                                        </a>
                                        <a href="javascript:void(0);" title="Yêu thích" ng-click="like()" class="btn-act btn-add-favourite ng-isolate-scope" options="recipe"><!-- ngIf: totalLikes > 0 --><span ng-if="totalLikes > 0" class="ng-binding ng-scope">14 &nbsp;</span><!-- end ngIf: totalLikes > 0 --><i class="ico ico-28 ico-iblock ico-favourite" ng-class="{'ico-favourite': !isLiked, 'ico-favourited' : isLiked}"></i></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-header">
                                            <div class="title">
                                                <h2>
                                                    <a rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/banh-bap-ngot-2013" title="Bánh bắp ngọt" href="/cong-thuc/banh-bap-ngot-2013" target="_blank" class="ng-binding">Bánh bắp ngọt</a>
                                                </h2>
                                            </div>
                                            <div class="item-stats">
                                                <div class="stats">
                                                    <ul class="list-inline nomargin">
                                                        <li class="stats-item">
                                                            <span class="fa fa-clock-o stats-ico"></span>
                                                            <span ng-show="recipe.TotalTimeSpan.Hours>0" class="ng-hide">
                                        <span class="stats-count ng-binding"> 0</span><span class="stats-text">g</span>
                                    </span>
                                                            <span ng-show="recipe.TotalTimeSpan.Minutes>0">
                                        <span class="stats-count ng-binding"> 25</span><span class="stats-text">ph</span>
                                    </span>
                                                        </li>
                                                        <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count ng-binding"> 2.7K</span></li>
                                                        <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count ng-binding"> Dễ</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ingredients" style="font-size:12px">
                                                <!-- ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Bột nếp</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Bột bắp</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Bắp hột</span><!-- end ngRepeat: ing in recipe.MainIngredients -->
                                            </div>
                                        </div>
                                        <div class="item-footer">
                                            <div class="recipe-by">
                                                <a ng-href="/thanh-vien/nhumongtran" href="/thanh-vien/nhumongtran" target="_blank" class="ng-binding">
                                                    <img class="circle" ng-src="https://media.cooky.vn/usr/g10/94532/avt/c50x50/cooky-avatar-636469383191430221.jpg" alt="Bánh bắp ngọt" src="https://media.cooky.vn/usr/g10/94532/avt/c50x50/cooky-avatar-636469383191430221.jpg">
                                                    Như Mộng Trần
                                                </a>
                                            </div>
                                            <div class="recipe-acts">

                                                <a href="javascript:void(0)" recipe-add-collection-item-popup-full="" options="recipe" class="btn btn-save ng-isolate-scope" title="thêm vào bộ sưu tập" target="_self">
                                                    <i class="ico ico-24 ico-block ico-save"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <span class="fa fa-star text-orange"></span>
                                        <span class="ng-binding">8.0</span>
                                    </div>

                                </div>
                            </div><!-- end ngRepeat: recipe in recipes --><div ng-repeat="recipe in recipes" class="result-recipe-item ng-scope">
                                <div class="item-inner">
                                    <div class="item-photo">
                                        <a class="photo" rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/chan-ga-ham-mat-ong-48113" href="/cong-thuc/chan-ga-ham-mat-ong-48113" target="_blank">
                                            <img ng-src="https://media.cooky.vn/recipe/g5/48113/s320x320/cooky-recipe-cover-r48113.jpg" alt="Chân gà hầm mật ong" class="photo img-responsive" src="https://media.cooky.vn/recipe/g5/48113/s320x320/cooky-recipe-cover-r48113.jpg">
                                            <!-- ngIf: recipe.Video --><img ng-if="recipe.Video" class="play-ico ng-scope" alt="Chân gà hầm mật ong" src="/Content/img/icons/cooky-video-play-fill.png"><!-- end ngIf: recipe.Video -->
                                        </a>
                                        <a href="javascript:void(0);" title="Yêu thích" ng-click="like()" class="btn-act btn-add-favourite ng-isolate-scope" options="recipe"><!-- ngIf: totalLikes > 0 --><span ng-if="totalLikes > 0" class="ng-binding ng-scope">156 &nbsp;</span><!-- end ngIf: totalLikes > 0 --><i class="ico ico-28 ico-iblock ico-favourite" ng-class="{'ico-favourite': !isLiked, 'ico-favourited' : isLiked}"></i></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-header">
                                            <div class="title">
                                                <h2>
                                                    <a rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/chan-ga-ham-mat-ong-48113" title="Chân gà hầm mật ong" href="/cong-thuc/chan-ga-ham-mat-ong-48113" target="_blank" class="ng-binding">Chân gà hầm mật ong</a>
                                                </h2>
                                            </div>
                                            <div class="item-stats">
                                                <div class="stats">
                                                    <ul class="list-inline nomargin">
                                                        <li class="stats-item">
                                                            <span class="fa fa-clock-o stats-ico"></span>
                                                            <span ng-show="recipe.TotalTimeSpan.Hours>0" class="ng-hide">
                                        <span class="stats-count ng-binding"> 0</span><span class="stats-text">g</span>
                                    </span>
                                                            <span ng-show="recipe.TotalTimeSpan.Minutes>0">
                                        <span class="stats-count ng-binding"> 55</span><span class="stats-text">ph</span>
                                    </span>
                                                        </li>
                                                        <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count ng-binding"> 613</span></li>
                                                        <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count ng-binding"> Dễ</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ingredients" style="font-size:12px">
                                                <!-- ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Chân gà</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Sườn non</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Mật ong</span><!-- end ngRepeat: ing in recipe.MainIngredients -->
                                            </div>
                                        </div>
                                        <div class="item-footer">
                                            <div class="recipe-by">
                                                <a ng-href="/thanh-vien/cooky" href="/thanh-vien/cooky" target="_blank" class="ng-binding">
                                                    <img class="circle" ng-src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png" alt="Chân gà hầm mật ong" src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png">
                                                    Cooky VN
                                                </a>
                                            </div>
                                            <div class="recipe-acts">

                                                <a href="javascript:void(0)" recipe-add-collection-item-popup-full="" options="recipe" class="btn btn-save ng-isolate-scope" title="thêm vào bộ sưu tập" target="_self">
                                                    <i class="ico ico-24 ico-block ico-save"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <span class="fa fa-star text-orange"></span>
                                        <span class="ng-binding">10.0</span>
                                    </div>

                                </div>
                            </div><!-- end ngRepeat: recipe in recipes --><div ng-repeat="recipe in recipes" class="result-recipe-item ng-scope">
                                <div class="item-inner">
                                    <div class="item-photo">
                                        <a class="photo" rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/tom-cuon-khoai-tay-cooky-35509" href="/cong-thuc/tom-cuon-khoai-tay-cooky-35509" target="_blank">
                                            <img ng-src="https://media.cooky.vn/recipe/g4/35509/s320x320/cooky-recipe-cover-r35509.jpg" alt="Tôm cuốn khoai tây" class="photo img-responsive" src="https://media.cooky.vn/recipe/g4/35509/s320x320/cooky-recipe-cover-r35509.jpg">
                                            <!-- ngIf: recipe.Video --><img ng-if="recipe.Video" class="play-ico ng-scope" alt="Tôm cuốn khoai tây" src="/Content/img/icons/cooky-video-play-fill.png"><!-- end ngIf: recipe.Video -->
                                        </a>
                                        <a href="javascript:void(0);" title="Yêu thích" ng-click="like()" class="btn-act btn-add-favourite ng-isolate-scope" options="recipe"><!-- ngIf: totalLikes > 0 --><span ng-if="totalLikes > 0" class="ng-binding ng-scope">250 &nbsp;</span><!-- end ngIf: totalLikes > 0 --><i class="ico ico-28 ico-iblock ico-favourite" ng-class="{'ico-favourite': !isLiked, 'ico-favourited' : isLiked}"></i></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-header">
                                            <div class="title">
                                                <h2>
                                                    <a rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/tom-cuon-khoai-tay-cooky-35509" title="Tôm cuốn khoai tây" href="/cong-thuc/tom-cuon-khoai-tay-cooky-35509" target="_blank" class="ng-binding">Tôm cuốn khoai tây</a>
                                                </h2>
                                            </div>
                                            <div class="item-stats">
                                                <div class="stats">
                                                    <ul class="list-inline nomargin">
                                                        <li class="stats-item">
                                                            <span class="fa fa-clock-o stats-ico"></span>
                                                            <span ng-show="recipe.TotalTimeSpan.Hours>0" class="ng-hide">
                                        <span class="stats-count ng-binding"> 0</span><span class="stats-text">g</span>
                                    </span>
                                                            <span ng-show="recipe.TotalTimeSpan.Minutes>0">
                                        <span class="stats-count ng-binding"> 45</span><span class="stats-text">ph</span>
                                    </span>
                                                        </li>
                                                        <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count ng-binding"> 10.1K</span></li>
                                                        <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count ng-binding"> Dễ</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ingredients" style="font-size:12px">
                                                <!-- ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Khoai tây</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Tôm tươi</span><!-- end ngRepeat: ing in recipe.MainIngredients -->
                                            </div>
                                        </div>
                                        <div class="item-footer">
                                            <div class="recipe-by">
                                                <a ng-href="/thanh-vien/cooky" href="/thanh-vien/cooky" target="_blank" class="ng-binding">
                                                    <img class="circle" ng-src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png" alt="Tôm cuốn khoai tây" src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png">
                                                    Cooky VN
                                                </a>
                                            </div>
                                            <div class="recipe-acts">

                                                <a href="javascript:void(0)" recipe-add-collection-item-popup-full="" options="recipe" class="btn btn-save ng-isolate-scope" title="thêm vào bộ sưu tập" target="_self">
                                                    <i class="ico ico-24 ico-block ico-save"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <span class="fa fa-star text-orange"></span>
                                        <span class="ng-binding">10.0</span>
                                    </div>

                                </div>
                            </div><!-- end ngRepeat: recipe in recipes --><div ng-repeat="recipe in recipes" class="result-recipe-item ng-scope">
                                <div class="item-inner">
                                    <div class="item-photo">
                                        <a class="photo" rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/banh-bap-hot-chien-gion-10458" href="/cong-thuc/banh-bap-hot-chien-gion-10458" target="_blank">
                                            <img ng-src="https://media.cooky.vn/recipe/g2/10458/s320x320/recipe10458-636398605831377203.jpg" alt="Bánh bắp hột chiên giòn" class="photo img-responsive" src="https://media.cooky.vn/recipe/g2/10458/s320x320/recipe10458-636398605831377203.jpg">
                                            <!-- ngIf: recipe.Video -->
                                        </a>
                                        <a href="javascript:void(0);" title="Yêu thích" ng-click="like()" class="btn-act btn-add-favourite ng-isolate-scope" options="recipe"><!-- ngIf: totalLikes > 0 --><span ng-if="totalLikes > 0" class="ng-binding ng-scope">9 &nbsp;</span><!-- end ngIf: totalLikes > 0 --><i class="ico ico-28 ico-iblock ico-favourite" ng-class="{'ico-favourite': !isLiked, 'ico-favourited' : isLiked}"></i></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-header">
                                            <div class="title">
                                                <h2>
                                                    <a rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/banh-bap-hot-chien-gion-10458" title="Bánh bắp hột chiên giòn" href="/cong-thuc/banh-bap-hot-chien-gion-10458" target="_blank" class="ng-binding">Bánh bắp hột chiên giòn</a>
                                                </h2>
                                            </div>
                                            <div class="item-stats">
                                                <div class="stats">
                                                    <ul class="list-inline nomargin">
                                                        <li class="stats-item">
                                                            <span class="fa fa-clock-o stats-ico"></span>
                                                            <span ng-show="recipe.TotalTimeSpan.Hours>0" class="ng-hide">
                                        <span class="stats-count ng-binding"> 0</span><span class="stats-text">g</span>
                                    </span>
                                                            <span ng-show="recipe.TotalTimeSpan.Minutes>0">
                                        <span class="stats-count ng-binding"> 15</span><span class="stats-text">ph</span>
                                    </span>
                                                        </li>
                                                        <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count ng-binding"> 3K</span></li>
                                                        <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count ng-binding"> Dễ</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ingredients" style="font-size:12px">
                                                <!-- ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Bột bắp</span><!-- end ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Bắp hột</span><!-- end ngRepeat: ing in recipe.MainIngredients -->
                                            </div>
                                        </div>
                                        <div class="item-footer">
                                            <div class="recipe-by">
                                                <a ng-href="/thanh-vien/thienkhai95" href="/thanh-vien/thienkhai95" target="_blank" class="ng-binding">
                                                    <img class="circle" ng-src="https://media.cooky.vn/usr/g10/95294/avt/c50x50/cooky-avatar-636473722340884602.jpg" alt="Bánh bắp hột chiên giòn" src="https://media.cooky.vn/usr/g10/95294/avt/c50x50/cooky-avatar-636473722340884602.jpg">
                                                    Thiên Khải
                                                </a>
                                            </div>
                                            <div class="recipe-acts">

                                                <a href="javascript:void(0)" recipe-add-collection-item-popup-full="" options="recipe" class="btn btn-save ng-isolate-scope" title="thêm vào bộ sưu tập" target="_self">
                                                    <i class="ico ico-24 ico-block ico-save"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <span class="fa fa-star text-orange"></span>
                                        <span class="ng-binding">8.0</span>
                                    </div>

                                </div>
                            </div><!-- end ngRepeat: recipe in recipes --><div ng-repeat="recipe in recipes" class="result-recipe-item ng-scope">
                                <div class="item-inner">
                                    <div class="item-photo">
                                        <a class="photo" rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/tom-song-sot-thai-cooky-29996" href="/cong-thuc/tom-song-sot-thai-cooky-29996" target="_blank">
                                            <img ng-src="https://media.cooky.vn/recipe/g3/29996/s320x320/cooky-recipe-cover-r29996.JPG" alt="Tôm sống sốt Thái" class="photo img-responsive" src="https://media.cooky.vn/recipe/g3/29996/s320x320/cooky-recipe-cover-r29996.JPG">
                                            <!-- ngIf: recipe.Video --><img ng-if="recipe.Video" class="play-ico ng-scope" alt="Tôm sống sốt Thái" src="/Content/img/icons/cooky-video-play-fill.png"><!-- end ngIf: recipe.Video -->
                                        </a>
                                        <a href="javascript:void(0);" title="Yêu thích" ng-click="like()" class="btn-act btn-add-favourite ng-isolate-scope" options="recipe"><!-- ngIf: totalLikes > 0 --><span ng-if="totalLikes > 0" class="ng-binding ng-scope">239 &nbsp;</span><!-- end ngIf: totalLikes > 0 --><i class="ico ico-28 ico-iblock ico-favourite" ng-class="{'ico-favourite': !isLiked, 'ico-favourited' : isLiked}"></i></a>
                                    </div>
                                    <div class="item-info">
                                        <div class="item-header">
                                            <div class="title">
                                                <h2>
                                                    <a rel="alternate" media="only screen and (max-width: 640px)" ng-href="/cong-thuc/tom-song-sot-thai-cooky-29996" title="Tôm sống sốt Thái" href="/cong-thuc/tom-song-sot-thai-cooky-29996" target="_blank" class="ng-binding">Tôm sống sốt Thái</a>
                                                </h2>
                                            </div>
                                            <div class="item-stats">
                                                <div class="stats">
                                                    <ul class="list-inline nomargin">
                                                        <li class="stats-item">
                                                            <span class="fa fa-clock-o stats-ico"></span>
                                                            <span ng-show="recipe.TotalTimeSpan.Hours>0" class="ng-hide">
                                        <span class="stats-count ng-binding"> 0</span><span class="stats-text">g</span>
                                    </span>
                                                            <span ng-show="recipe.TotalTimeSpan.Minutes>0">
                                        <span class="stats-count ng-binding"> 30</span><span class="stats-text">ph</span>
                                    </span>
                                                        </li>
                                                        <li class="stats-item"><span class="fa fa-bar-chart stats-ico"></span><span class="stats-count ng-binding"> 48.3K</span></li>
                                                        <li class="stats-item"><span class="fa fa-bolt stats-ico"></span> <span class="stats-text stats-count ng-binding"> Trung bình</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="ingredients" style="font-size:12px">
                                                <!-- ngRepeat: ing in recipe.MainIngredients --><span ng-repeat="ing in recipe.MainIngredients" class="ng-binding ng-scope"> Tôm tươi</span><!-- end ngRepeat: ing in recipe.MainIngredients -->
                                            </div>
                                        </div>
                                        <div class="item-footer">
                                            <div class="recipe-by">
                                                <a ng-href="/thanh-vien/cooky" href="/thanh-vien/cooky" target="_blank" class="ng-binding">
                                                    <img class="circle" ng-src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png" alt="Tôm sống sốt Thái" src="https://media.cooky.vn/usr/g1/51/avt/c50x50/cooky-avatar-636281353509940328.png">
                                                    Cooky VN
                                                </a>
                                            </div>
                                            <div class="recipe-acts">

                                                <a href="javascript:void(0)" recipe-add-collection-item-popup-full="" options="recipe" class="btn btn-save ng-isolate-scope" title="thêm vào bộ sưu tập" target="_self">
                                                    <i class="ico ico-24 ico-block ico-save"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <span class="fa fa-star text-orange"></span>
                                        <span class="ng-binding">6.7</span>
                                    </div>

                                </div>
                            </div><!-- end ngRepeat: recipe in recipes -->
                        </div>
                        <div class="clearfix"></div>
                        <div class="recipe-more" style="margin:30px 15px;">
                            <div class="recipe-more-inner" ng-show="hasMoreItems">
                                <a href="javascript:void(0)" ng-click="loadMore()" target="_self">
                                    <span ng-show="!isLoading">Xem thêm </span>
                                    <i ng-show="isLoading" class="fa fa-spinner fa-pulse text text-primary ng-hide"></i>
                                    (<span class="text-red ng-binding">12</span><span class="text-gray ng-binding">/29926</span>)
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>