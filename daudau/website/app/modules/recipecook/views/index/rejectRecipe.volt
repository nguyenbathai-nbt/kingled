<div class="container create-recipe-page ng-scope" ng-app="recipeApp" style="max-width:940px">
    <div class="create-form-header center">
        <h1>Chỉnh sửa công thức</h1>
    </div>
    <div class="create-form-wrapper submit-form-wrapper body-content ng-scope" ng-controller="TabController as tab"
         ng-init="init()">
        <div id="advance" ng-controller="contestController" ng-init="init()" class="ng-scope">
            {#            <ul class="nav nav-tabs step-tabs" role="tablist">#}
            {#                <li class="step-tab ng-scope active" >#}
            {#                    <a href="#infoTab" id="menu-tab-infoTab" target="_self" role="tab" data-toggle="tab">#}
            {#                        <span class="step-num">1</span> Công thức#}
            {#                    </a>#}
            {#                </li>#}
            {#                <li class="step-tab ng-scope" target="_self" >#}
            {#                    <a href="#finishTab" id="menu-tab-finishTab"  role="tab" data-toggle="tab" target="_self">#}
            {#                        <span class="step-num">2</span> Hoàn tất &amp; Phân loại#}
            {#                    </a>#}
            {#                </li>#}
            {#            </ul>#}
            <div class="tab-content">
                <form method="post" enctype="multipart/form-data" class="ng-pristine ng-invalid ng-invalid-required">
                    <div id="infoTab" class="create-form tab-pane clearfix active" style="padding: 0px 0px">
                        <recipe-basic-info control="control" class="ng-isolate-scope">
                            <div class="simple-container" style="padding: 0 20px;">
                                <div class="form-row">
                                    <div class="form-group">
                                        <div class="has-photo">
                                            <output id="image-review">
                                                <span><img class="default-photo" style="width: 100%;" src="{{ recipe_cook.image.getImageBase() }}"></span>
                                            </output>

                                            <div accept="image/*" title="select file" class="upload-button" style="right:auto; width: 100%;border-radius: 0; position: relative">
                                                <div class="overlay" style="background: #f3f3f3;color:#333;">
                                                    <span class="fa fa-camera upload-ico"></span>Click để tải hình đại diện
                                                </div>
                                                <input type="file" id="image-logo" name="image-logo" accept="image/*" title="select file" class="upload-button" style="border-radius: 0px; top: 0px; bottom: 0px; left: 0px; right: 0px; width: 100%; opacity: 0; position: absolute;">
                                            </div>
                                        </div>
                                        <div ng-show="imgOverralProgess>0" style="height:2px" class="progress ng-hide">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group has-feedback">
                                        <input id="name-recipe" type="text" name="name-recipe" class="form-control name ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="" placeholder="Nhập tên công thức" value="{{ recipe_cook.getName() }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group has-feedback">
                                        <textarea id="description-recipe" name="description-recipe" rows="4" class="form-control name ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" placeholder="Nhập nội dung mô tả ngắn gọn về công thức" required="" value="">{{ recipe_cook.getDescription() }}</textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Độ khó, Thời gian (phút)</label>
                                        <select style="float:left;margin-right:6px;width:180px;"
                                                class="form-control name ng-pristine ng-untouched ng-valid ng-not-empty"
                                                id="level" name="level" required="1">
                                            {% if recipe_cook.getLevel() is sameas('Không chỉ định') %}
                                                <option value="Không chỉ định" selected>Không chỉ định</option>
                                                <option value="Dễ" >Dễ</option>
                                                <option value="Trung bình" >Trung bình</option>
                                                <option value="Khó" >Khó</option>

                                            {% elseif recipe_cook.getLevel() is sameas('Dễ') %}
                                                <option value="Không chỉ định" >Không chỉ định</option>
                                                <option value="Dễ" selected>Dễ</option>
                                                <option value="Trung bình" >Trung bình</option>
                                                <option value="Khó" >Khó</option>

                                            {% elseif recipe_cook.getLevel() is sameas('Trung bình') %}
                                                <option value="Không chỉ định" >Không chỉ định</option>
                                                <option value="Dễ" >Dễ</option>
                                                <option value="Trung bình" selected>Trung bình</option>
                                                <option value="Khó" >Khó</option>

                                            {% elseif recipe_cook.getLevel() is sameas('Khó') %}
                                                <option value="Không chỉ định" >Không chỉ định</option>
                                                <option value="Dễ" >Dễ</option>
                                                <option value="Trung bình" >Trung bình</option>
                                                <option value="Khó" selected>Khó</option>
                                            {% endif %}
                                        </select>
                                        <input style="width:100px; float:left;" id="time_do" name="time_do" placeholder="phút" required type="number" class="form-control name ng-pristine ng-untouched ng-valid ng-not-empty" value="{{ recipe_cook.getTimeDo() }}">
                                    </div>
                                </div>
                                <div class="form-row ingredient-form">
                                    <div class="headline">
                                        <div class="form-left">Nguyên liệu <span style="color:red">*</span>

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="ui-draggable ng-pristine ng-untouched ng-valid ng-scope ng-not-empty"
                                             id="ingr-draggable" data-as-sortable="dragIngredientListeners"
                                             data-ng-model="ingredients">
                                            <!-- ngRepeat: ingr in ingredients -->
                                            <div class="form-field ingredient-form-row ng-scope as-sortable-item"
                                                 data-ng-repeat="ingr in ingredients" data-as-sortable-item="">
                                                <recipe-ingredient-basic data-as-sortable-item-handle="" ng-init="init()" class="ng-scope as-sortable-item-handle">
                                                    <div class="ingredient-field">
                                                        <table ng-hide="ingr.completed" id="raw-material">
                                                            <tbody>
                                                            {% if recipe_material is not null %}
                                                                {% for item in recipe_material %}
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-inline">
                                                                            <div class="form-group">
                                                                                <label class="sr-only" for="raw-material">Nguyên liệu<span style="color:red"> (*)</span></label>
                                                                                <input type="text" id="raw-material" name="raw-material[]" class="form-control" required="1" placeholder="Nguyên liệu" data-fv-notempty="true" data-fv-notempty-message="Please enter a value" value="{{ item.rawmaterial.getName() }}">
                                                                            </div>&nbsp;
                                                                            <div class="form-group">
                                                                                <label class="sr-only" for="quantitative">Định lượng<span style="color:red"> (*)</span></label>
                                                                                <input type="text" id="quantitative" name="quantitative[]" class="form-control" required="1" placeholder="Định lượng" data-fv-notempty="true" data-fv-notempty-message="Please enter a value" value="{{ item.quantitative.getCode() }}">
                                                                            </div>&nbsp;
                                                                            <div class="form-group"><label class="sr-only" for="number">Number<span style="color:red"> (*)</span></label>
                                                                                <input type="text" id="number" name="number[]" class="form-control" required="1" placeholder="Number" data-fv-notempty="true" data-fv-notempty-message="Please enter a value" value="{{ item.getNumber() }}">
                                                                            </div>&nbsp;
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" class="btn btn-danger btn-close" style="margin-left:10px;display: block; position: relative;right: 0px;bottom: 0px"><span class="fa fa-trash"></span></a>
                                                                    </td>
                                                                </tr>
                                                              {% endfor %}

                                                            {% endif %}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </recipe-ingredient-basic>
                                            </div><!-- end ngRepeat: ingr in ingredients -->
                                            <a class="addmore-ingredients add-more-btn" href="javascript:void(0)" id="add-raw-material" onclick="addRawMaterial()" style="margin-top: 5px;margin-bottom: 10px">+ thêm nguyên liệu</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row heading">
                                    <div class="form-left">Cách làm <span style="color:red">*</span></div>
                                </div>
                                <div class="form-row" id="step">
                                    {% if step is not null %}
                                        {% for item in step %}
                                            <div ng-repeat="step in steps" class="ng-scope">
                                                <recipe-step>
                                                    <div class="step-box">
                                                        <a href="javascript:void(0)" class="btn btn-danger btn-close" ng-click="remove(step)"><span class="fa fa-trash"></span></a>
                                                        <div class="step-count ng-binding">{{ item.getCount() }}</div>
                                                        <div class="step-direction">
                                                            <textarea name="contentStep[]" rows="4" cols="40" class="form-control ng-pristine ng-untouched ng-valid ng-isolate-scope ng-empty" placeholder="Nhập hướng dẫn cách làm cho bước 1">{{ item.getDescription() }}</textarea>
                                                        </div>
                                                        {#                                                                                                <div class="step-acts" ng-hide="step.id>0">#}
                                                        {#                                                                                                    <a href="javascript:void(0)" ng-click="step.focused=true;" class="btn-show-opts text-gray text-italic">#}
                                                        {#                                                                                                        <span class="fa fa-camera"></span> Nhập hướng dẫn cách làm trước, sau đó tải ảnh lên#}
                                                        {#                                                                                                    </a>#}
                                                        {#                                                                                                </div>#}
                                                        <div>
                                                            <div class="step-photo-container attached-photos-container ng-hide" ng-init="initSortableImage()" style="display:block; border: none; height:auto; background:none" ng-show="step.id>0">
                                                                {#                                                            <div class="step-btns">#}
                                                                {#                                                                <a href="javascript:void(0)" class="step-photo-upload-btn disabled">#}
                                                                {#                                                                    <span class="fa fa-camera"></span> Tải hình ảnh bước thực hiện#}
                                                                {#                                                                    <input type="file" name="files[]" multiple="" style="opacity: 0;position: absolute; margin-top: -18px;">#}
                                                                {#                                                                </a>#}
                                                                {#                                                                <div class="text-gray text-italic text-small" style="text-align:center">(Giới hạn <span class="text-highlight ng-binding">4</span>hình ảnh)#}
                                                                {#                                                                </div>#}
                                                                {#                                                            </div>#}
                                                                <div style="width:100%;padding: 10px 0;">
                                                                    <div ng-show="step.images.length>0" id="stepPhotosContainer0" style="min-height:100px; min-width:536px;" class="ng-hide">
                                                                        <ul class="step-imgs sort-able ui-sortable">
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </recipe-step>
                                            </div>

                                        {% endfor %}
                                    {% endif %}
                                </div>
                                <a class="addmore-ingredients add-more-btn" href="javascript:void(0)" id="add-step" onclick="addStep()" target="_self">+ thêm bước thực hiện</a>
                            </div>
                        </recipe-basic-info>
                        {#                    <div class="form-row">#}
                        {#                        <div class="step-toolbar" style="border-top:1px solid #ddd; text-align:center;padding-top:15px;">#}
                        {#                            <button type="submit" ng-click="setTab(1)" ng-class="{active: isCurrentTab(1)}" ng-if="!isCurrentTab(4)" class="btn btn-danger danger-gradient" style="width:100%;padding:15px;" >Lưu &amp; Tiếp tục#}
                        {#                            </button>#}
                        {#                        </div>#}
                        {#                    </div>#}
                    </div>
                    {#                <div id="finishTab" class="create-form tab-pane clearfix ng-hide" >#}
                    <div id="finishTab" class="create-form tab-pane clearfix active" style="padding: 0px 0px">
                        <!-- ngIf: recipeId>0 -->
                        <div class="simple-container ng-scope" ng-if="recipeId>0"
                             ng-controller="MappingController as mappingCtrl" ng-init="init()">
                            <div class="form-row">
                                <h4 class="title">Phân loại</h4>
                                <span class="desc text-gray">Bước phân loại này sẽ giúp cho người dùng tìm thấy công thức của bạn dễ dàng hơn</span>
                            </div>
                            <div class="form-row">
                                <h4>Công thức</h4>
                                <recipe-mapping-list mappings="mapping.Courses" class="ng-isolate-scope">
                                    <ul class="list-inline">
                                        <!-- ngRepeat: map in mappings -->
                                        {% if list_category is not null %}
                                            {% for item in list_category %}
                                                <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">

                                                    <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;" ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}" class="text-gray">
                                                        <input type="checkbox" name="category[]" class="ng-hide ng-pristine ng-untouched ng-valid ng-empty" ng-model="map.IsMapped" value="{{ item.getId() }}">
                                                        <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped" aria-hidden="true"></i>
                                                        <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>
                                                        <span class="ng-binding">{{ item.getName() }}</span>
                                                    </label>
                                                </li><!-- end ngRepeat: map in mappings -->
                                            {% endfor %}
                                        {% endif %}

                                        {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                                        {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                                        {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                                        {#                                               class="text-gray">#}
                                        {#                                            <input type="checkbox" name="catogery[]"#}
                                        {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                                        {#                                                   ng-model="map.IsMapped">#}
                                        {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                                        {#                                               aria-hidden="true"></i>#}
                                        {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                                        {#                                            <span class="ng-binding">Món tráng miệng</span>#}
                                        {#                                        </label>#}
                                        {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                                        {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                                        {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                                        {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                                        {#                                               class="text-gray">#}
                                        {#                                            <input type="checkbox" name="catogery[]"#}
                                        {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                                        {#                                                   ng-model="map.IsMapped">#}
                                        {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                                        {#                                               aria-hidden="true"></i>#}
                                        {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                                        {#                                            <span class="ng-binding">Món chay</span>#}
                                        {#                                        </label>#}
                                        {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                                        {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                                        {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                                        {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                                        {#                                               class="text-gray">#}
                                        {#                                            <input type="checkbox" name="catogery[]"#}
                                        {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                                        {#                                                   ng-model="map.IsMapped">#}
                                        {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                                        {#                                               aria-hidden="true"></i>#}
                                        {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                                        {#                                            <span class="ng-binding">Món chính</span>#}
                                        {#                                        </label>#}
                                        {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                                        {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                                        {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                                        {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                                        {#                                               class="text-gray">#}
                                        {#                                            <input type="checkbox" name="catogery[]"#}
                                        {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                                        {#                                                   ng-model="map.IsMapped">#}
                                        {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                                        {#                                               aria-hidden="true"></i>#}
                                        {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                                        {#                                            <span class="ng-binding">Món ăn sáng</span>#}
                                        {#                                        </label>#}
                                        {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                                        {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                                        {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                                        {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                                        {#                                               class="text-gray">#}
                                        {#                                            <input type="checkbox" name="catogery[]"#}
                                        {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                                        {#                                                   ng-model="map.IsMapped">#}
                                        {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                                        {#                                               aria-hidden="true"></i>#}
                                        {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                                        {#                                            <span class="ng-binding">Nhanh và dễ</span>#}
                                        {#                                        </label>#}
                                        {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                                        {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                                        {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                                        {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                                        {#                                               class="text-gray">#}
                                        {#                                            <input type="checkbox" name="catogery[]"#}
                                        {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                                        {#                                                   ng-model="map.IsMapped">#}
                                        {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                                        {#                                               aria-hidden="true"></i>#}
                                        {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                                        {#                                            <span class="ng-binding">Thức uống</span>#}
                                        {#                                        </label>#}
                                        {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                                        {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                                        {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                                        {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                                        {#                                               class="text-gray">#}
                                        {#                                            <input type="checkbox" name="catogery[]"#}
                                        {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                                        {#                                                   ng-model="map.IsMapped">#}
                                        {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                                        {#                                               aria-hidden="true"></i>#}
                                        {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                                        {#                                            <span class="ng-binding">Bánh - Bánh ngọt</span>#}
                                        {#                                        </label>#}
                                        {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                                        {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                                        {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                                        {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                                        {#                                               class="text-gray">#}
                                        {#                                            <input type="checkbox" name="catogery[]"#}
                                        {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                                        {#                                                   ng-model="map.IsMapped">#}
                                        {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                                        {#                                               aria-hidden="true"></i>#}
                                        {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                                        {#                                            <span class="ng-binding">Món ăn cho trẻ</span>#}
                                        {#                                        </label>#}
                                        {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                                        {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                                        {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                                        {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                                        {#                                               class="text-gray">#}
                                        {#                                            <input type="checkbox" name="catogery[]"#}
                                        {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                                        {#                                                   ng-model="map.IsMapped">#}
                                        {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                                        {#                                               aria-hidden="true"></i>#}
                                        {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                                        {#                                            <span class="ng-binding">Món nhậu</span>#}
                                        {#                                        </label>#}
                                        {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                                    </ul>
                                </recipe-mapping-list>
                            </div>
                            <div class="form-row">
                                <div class="step-toolbar"
                                     style="border-top:1px solid #ddd; text-align:center;padding-top:15px;">
                                    <button type="submit" ng-click="setTab(1)" ng-class="{active: isCurrentTab(1)}"
                                            ng-if="!isCurrentTab(4)" class="btn btn-danger danger-gradient"
                                            style="width:100%;padding:15px;">
                                        Lưu &amp; Tiếp tục

                                    </button>
                                </div>
                            </div>
                            {#                        <div class="form-row">#}
                            {#                            <h4> Ẩm thực</h4>#}
                            {#                            <recipe-mapping-list mappings="mapping.Cuisines" class="ng-isolate-scope">#}
                            {#                                <ul class="list-inline">#}
                            {#                                    <!-- ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Việt Nam</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Thái Lan</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ý</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Hàn Quốc</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Nhật</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Âu</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Trung Quốc</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ấn Độ</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Singapore</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Pháp</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Brazil</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Mỹ</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Úc</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Mexico</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Indonesia</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Nga</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Malaysia</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Philippines</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Nam Phi</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                </ul>#}
                            {#                            </recipe-mapping-list>#}
                            {#                        </div>#}
                            {#                        <div class="form-row">#}
                            {#                            <h4>Loại món</h4>#}
                            {#                            <recipe-mapping-list mappings="mapping.DishTypes" class="ng-isolate-scope">#}
                            {#                                <ul class="list-inline">#}
                            {#                                    <!-- ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Salad</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Nước chấm - Sốt</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Canh</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Lẩu</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Nộm - Gỏi</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Soup - Cháo</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Nem - Chả</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Chay</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Xôi</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Bánh mặn</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Bánh ngọt</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Sinh tố - Nước ép</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Nước ép</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Cocktail - Mocktail</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Kem</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Chè</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Mứt - Kẹo</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Đồ sống</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Snacks</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Cupcake - Muffin</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Pasta - Spaghetti</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Miến - Hủ tiếu</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Bún - Mì - Phở</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Đồ uống</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Nướng - Quay</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Nghêu - Sò - Ốc</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Rang - Xào</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Món chiên</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Món cuốn</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Chưng - hấp</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Muối chua - Ngâm chua</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Kho - Rim</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ủ - Lên men</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Món luộc</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Thạch - Rau câu</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Sữa chua</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                </ul>#}
                            {#                            </recipe-mapping-list>#}
                            {#                        </div>#}
                            {#                        <div class="form-row">#}
                            {#                            <h4>Cách thức thực hiện</h4>#}
                            {#                            <recipe-mapping-list mappings="mapping.CookingMethods" class="ng-isolate-scope">#}
                            {#                                <ul class="list-inline">#}
                            {#                                    <!-- ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Nướng</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Chiên</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Lẩu</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Luộc</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Hầm</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Hấp</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Tiềm</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Xào</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Trộn</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Xay</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ép</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Kho</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ngâm</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Om</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Sốt</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Nấu </span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Pha chế</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Muối</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Vắt</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ủ</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Cuốn</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Quay</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Rang</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Làm Bánh</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Nước  Chấm</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Uống</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Chưng</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ăn Sống</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ăn</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ướp</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ram</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                </ul>#}
                            {#                            </recipe-mapping-list>#}
                            {#                        </div>#}
                            {#                        <div class="form-row">#}
                            {#                            <h4>Mùa &amp; dịp lễ</h4>#}
                            {#                            <recipe-mapping-list mappings="mapping.Seasons" class="ng-isolate-scope">#}
                            {#                                <ul class="list-inline">#}
                            {#                                    <!-- ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Mùa xuân</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Mùa hè</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Mùa Thu</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Mùa Đông</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                </ul>#}
                            {#                            </recipe-mapping-list>#}
                            {#                        </div>#}
                            {#                        <div class="form-row">#}
                            {#                            <h4>Mục đích (<span class="text-gray">tốt cho</span>)</h4>#}
                            {#                            <recipe-mapping-list mappings="mapping.Purposes" class="ng-isolate-scope">#}
                            {#                                <ul class="list-inline">#}
                            {#                                    <!-- ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ăn sáng</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ăn trưa</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ăn kiêng</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Giảm cân</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Cho phái mạnh</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ăn vặt</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Tiệc</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ăn chay</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Chữa bệnh</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ăn gia đình</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Phụ nữ sau khi sinh</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Phụ nữ mang thai</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Trẻ dưới 1 tuổi</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Tốt cho sức khỏe</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Ăn tối</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Tốt cho trẻ em</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Tốt cho tim mạch</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Cho phái nữ</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">#}
                            {#                                        <label ng-click="map.IsMapped = !map.IsMapped" style="cursor:pointer;"#}
                            {#                                               ng-class="{'text-green': map.IsMapped, 'text-gray': !map.IsMapped}"#}
                            {#                                               class="text-gray">#}
                            {#                                            <input type="checkbox"#}
                            {#                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"#}
                            {#                                                   ng-model="map.IsMapped">#}
                            {#                                            <i class="fa fa-toggle-on ng-hide" ng-show="map.IsMapped"#}
                            {#                                               aria-hidden="true"></i>#}
                            {#                                            <i class="fa fa-toggle-off" ng-hide="map.IsMapped" aria-hidden="true"></i>#}
                            {#                                            <span class="ng-binding">Tăng cân</span>#}
                            {#                                        </label>#}
                            {#                                    </li><!-- end ngRepeat: map in mappings -->#}
                            {#                                </ul>#}
                            {#                            </recipe-mapping-list>#}
                            {#                        </div>#}
                            {#                        <div class="form-row">#}
                            {#                            <div class="text-center center row" style="margin:0">#}
                            {#                                <div class="col-sm-2 col-lg-2" style="padding:15px 15px 15px 0;">#}
                            {#                                    <button class="btn btn-default" style="width:100%;padding:15px;"#}
                            {#                                            ng-click="setTab(1, true)">Bước 1#}
                            {#                                    </button>#}
                            {#                                </div>#}
                            {#                                <div class="col-sm-10 col-lg-10" style="padding:15px 0 15px 15px;">#}
                            {#                                    <button class="btn btn-danger danger-gradient btn-next-step"#}
                            {#                                            style="width:100%;padding:15px;" ng-click="submitRecipe()"#}
                            {#                                            ng-disabled="saving" data-step="3">#}
                            {#                                        <span ng-show="!saving">Hoàn tất</span>#}
                            {#                                        <img ng-show="saving" class="ng-hide"#}
                            {#                                             src="/Style/images/icons/small-loading.gif">#}
                            {#                                    </button>#}
                            {#                                </div>#}
                            {#                            </div>#}
                            {#                        </div>#}
                            {#                        <div ng-show="errors.length>0" class="ng-hide">#}
                            {#                            <div class="panel-warning">#}
                            {#                                <div>Bạn cần hoàn tất những bước sau:</div>#}

                            {#                                <!-- ngRepeat: error in errors  | orderBy:'Step' -->#}
                            {#                            </div>#}

                            {#                        </div>#}
                        </div><!-- end ngIf: recipeId>0 -->
                        <!-- ngIf: recipeId<=0 -->

                    </div>
                </form>

                {#                <div class="create-form tab-pane active clearfix ng-hide" style="padding: 0 30px;"#}
                {#                     ng-show="isCurrentTab(4)" ng-class="{active: isCurrentTab(4)}">#}
                {#                    <h2>Chúc mừng, công thức của bạn đã được gửi thành công</h2>#}

                {#                    <div class="desc">#}
                {#                        Công thức của bạn sẽ được duyệt và hiển thị từ <strong>15 phút - 1 giờ làm việc</strong> , không#}
                {#                        tính T7 - CN. Bạn có thể xem lại công thức của mình vừa tạo bên dưới#}
                {#                    </div>#}
                {#                    <div class="draft-recipe">#}
                {#                        <div class="item-info">#}
                {#                            <a ng-href="" target="_self" class="photo"><img class="img-responsive"></a>#}
                {#                            <h3 class="ng-binding"></h3>#}
                {#                            <div class="item-stats">#}
                {#                                <span class="stats-item">#}
                {#                                    <span class="stats-text">Thời gian: </span>#}
                {#                                    <span class="stats-count ng-binding"></span> phút#}
                {#                                </span>#}
                {#                                <span class="stats-item">#}
                {#                                    <span class="stats-text">Mức độ: </span>#}
                {#                                    <span class="stats-count ng-binding"></span>#}
                {#                                </span>#}
                {#                                <span class="stats-item">#}
                {#                                    <span class="stats-text">Điểm tích lũy: </span>#}
                {#                                    <span class="stats-count"><span class="text-green ng-binding">+</span> <img#}
                {#                                                src="/Content/img/cp.png" style="width:20px;"> <a#}
                {#                                                class="text-small text-highlight" href="/tai-khoan" target="_self">chi tiết</a></span>#}
                {#                                </span>#}
                {#                                <span class="stats-item">#}
                {#                                    <span class="stats-text">Trạng thái: </span>#}
                {#                                    <span class="stats-count">#}
                {#                                        <a href="/tai-khoan/cong-thuc" target="_self" class="text-orange"#}
                {#                                           ng-switch="submitedRecipe.SubmitStatus">#}

                {#                                        </a>#}
                {#                                    </span>#}
                {#                                </span>#}
                {#                            </div>#}
                {#                        </div>#}
                {#                    </div>#}
                {#                    <div class="desc" style="padding:8px 0; margin-top:10px;">#}
                {#                        <img src="/Content/img/cp.png" style="width:18px;"> là điểm tích lũy dùng để đổi các phần quà có#}
                {#                        giá trị tại trang <a href="/doi-thuong" class="text-highlight text-small" target="_self"><span#}
                {#                                    class="fa fa-gift"></span> đổi thưởng</a>#}
                {#                    </div>#}
                {#                    <div style="padding: 15px;border-top: 1px solid #ddd;margin-top: 15px;text-align: center;">#}
                {#                        Bạn có muốn chia sẻ công thức bạn vừa tạo đến những người bạn trên facebook?#}
                {#                        <div style="margin-top: 15px;text-align: center;">#}
                {#                            <a class="btn btn-primary" href="javascript:void(0);" ng-hide="contestId>0"#}
                {#                               ng-click="shareFBUi(submitedRecipe.Url)" style="margin-right:6px" target="_self"><span#}
                {#                                        class="fa fa-facebook"></span> Chia sẻ ngay</a>#}
                {#                            <a class="btn btn-primary ng-hide" href="javascript:void(0);" ng-show="contestId>0"#}
                {#                               ng-click="shareContestFBUi()" style="margin-right:6px" target="_self"><span#}
                {#                                        class="fa fa-facebook"></span> Chia sẻ kêu gọi bình chọn</a>#}
                {#                            <a class="btn btn-default" href="/tai-khoan/cong-thuc" target="_self"> <span#}
                {#                                        class="fa fa-hand-o-right"></span> Danh sách công thức đã tạo</a>#}
                {#                        </div>#}
                {#                    </div>#}
                {#                    <div style="padding: 15px;margin-top: 15px;text-align: center;">#}

                {#                        <div class="count-friend"><a href="/thanh-vien/bathainguyen/quan-tam" target="_self"><b><span#}
                {#                                            class="text-highlight">0</span> bạn bè trên Facebook</b></a> đang sử dụng#}
                {#                            <strong>Cooky.vn</strong>. Hãy cùng bạn bè chia sẻ kinh nghiệm nấu nướng nhé!#}
                {#                        </div>#}
                {#                        <div class="user-list fb-friendlist">#}
                {#                        </div>#}

                {#                    </div>#}
            </div>
        </div>
    </div>
</div>
<div style="background: #FFF9C4;
    padding: 15px;
    border: 1px dashed #FFF176;
    margin: 30px auto;
    width: 770px;
    border-radius: 12px;
    overflow: hidden;">
</div>
</div>
<script type="text/javascript" src="/public/js/jquery.js"></script>
<script type="text/javascript">
    var numberStep = {{ count_step }};
    var numberStepAfterDelete = 1;

    function handleFileSelect(evt) {
        $('#image-review').empty();
        var files = evt.target.files;
        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    var span = document.createElement('span');
                    span.innerHTML =
                        [
                            '<img class="default-photo" style="width: 100%;" src="',
                            e.target.result,
                            '" title="', escape(theFile.name),
                            '"/>'
                        ].join('');

                    document.getElementById('image-review').insertBefore(span, null);
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }

    function handleFileSelectStep(evt) {
        var files = evt.target.files;
        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    var li = document.createElement('li');
                    li.innerHTML =
                        [
                            '<img class="default-photo" style="width: 100%;" src="',
                            e.target.result,
                            '" title="', escape(theFile.name),
                            '"/>'
                        ].join('');
                    $(this).parent().parent().parent().children('ul').append();
                    document.getElementsByClassName('image-review').insertBefore(li, null);
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }

    function addRawMaterial() {
        $("#raw-material tbody").append('<tr>' +
            '<td>' +
            '<div class="form-inline">{{ form.renderInlineAll() }}</div>' +
            '</td>' +
            '<td>' +
            '<a href="javascript:void(0)" class="btn btn-danger btn-close" style="margin-left:10px;display: block; position: relative;right: 0px;bottom: 0px"><span class="fa fa-trash"></span></a>' +
            '</td>' +
            '</tr>');
    }

    function addStep() {
        numberStep++;
        $("#step").append('  <div ng-repeat="step in steps"  class="ng-scope">\n' +
            '                                        <recipe-step>\n' +
            '                                            <div class="step-box">\n' +
            '                                                <a href="javascript:void(0)" class="btn btn-danger btn-close"\n' +
            '                                                   ng-click="remove(step)"><span class="fa fa-trash"></span></a>\n' +
            '                                                <div class="step-count ng-binding">' + numberStep + '</div>\n' +
            '                                                <div class="step-direction">\n' +
            '                                                    <textarea name="contentStep[]" rows="4" cols="40" focus-me="" ng-blur="step.focused=false;" class="form-control ng-pristine ng-untouched ng-valid ng-isolate-scope ng-empty" ng-model="step.description" placeholder="Nhập hướng dẫn cách làm cho bước ' + numberStep + '"></textarea>\n' +
            '                                                </div>\n' +
            '                                                <div>\n' +
            '                                                    <div class="step-photo-container attached-photos-container ng-hide" ng-init="initSortableImage()" style="display:block; border: none; height:auto; background:none" ng-show="step.id>0">\n' +
            '                                                            <div style="width:100%;padding: 10px 0;">\n' +
            '                                                                <div ng-show="step.images.length>0" id="stepPhotosContainer0" style="min-height:100px; min-width:536px;" class="ng-hide">\n' +
            '                                                                    <ul class="step-imgs sort-able ui-sortable">\n' +
            '                                                                        <!-- ngRepeat: file in step.images|orderBy: \'order\' -->\n' +
            '                                                                    </ul>\n' +
            '                                                                </div>\n' +
            '                                                            </div>\n' +
            '                                                    </div>\n' +
            '                                                </div>\n' +
            '                                            </div>\n' +
            '                                        </recipe-step>\n' +
            '                                    </div>');
    }

    function deleteRawMaterial() {
        $('#raw-material tbody').on('click', '.btn', function () {
            $(this).closest('tr').remove();
        })
    }

    function deleteStep() {
        $('#step ').on('click', '.btn', function () {
            $(this).parent().parent().parent().remove();
            count();
        });
    }

    function count() {
        numberStepAfterDelete = 0;
        $('#step .ng-scope recipe-step .step-box ').each(function (index, value) {
            numberStepAfterDelete++;
            $(this).children('.step-count').html(numberStepAfterDelete);
            $(this).children('.step-direction').children('textarea').attr("placeholder", "Nhập hướng dẫn cách làm cho bước " + numberStepAfterDelete);
        });
        numberStep = numberStepAfterDelete;
    }

    function isCheck() {

        $("input[type=checkbox]").on("click", function () {
            console.log($(this).is(":checked"));
            if ($(this).is(":checked")) {
                $(this).parent().removeClass('text-gray');
                $(this).parent().addClass('text-green');
                $(this).parent().children(":nth-child(2)").removeClass('ng-hide');
                $(this).parent().children(":nth-child(3)").addClass('ng-hide');
            } else {
                $(this).parent().addClass('text-gray');
                $(this).parent().removeClass('text-green');
                $(this).parent().children("i:nth-child(2)").addClass('ng-hide');
                $(this).parent().children("i:nth-child(3)").removeClass('ng-hide');
            }
        });

    }

    function changePage() {
        $('#menu-tab-infoTab').on('click', function () {
            $('#infoTab').addClass('active');
            $('#infoTab').removeClass('ng-hide');
            $('#finishTab').removeClass('active');
            $('#finishTab').addClass('ng-hide');
        });
        $('#menu-tab-finishTab').on('click', function () {
            $('#finishTab').addClass('active');
            $('#finishTab').removeClass('ng-hide');
            $('#infoTab').removeClass('active');
            $('#infoTab').addClass('ng-hide');
        });
    }

    $(document).ready(function () {
        deleteRawMaterial();
        deleteStep();
        isCheck();
        document.getElementById('image-logo').addEventListener('change', handleFileSelect, false);
        $('input[name="files"]').each(function () {
            alert($(this).val());
        });
    });


</script>
