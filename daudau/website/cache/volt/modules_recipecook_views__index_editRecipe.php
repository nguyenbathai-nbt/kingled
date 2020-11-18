<div class="container create-recipe-page ng-scope" ng-app="recipeApp" style="max-width:940px">
    <div class="create-form-header center">
        <h1>Chỉnh sửa công thức</h1>
    </div>
    <div class="create-form-wrapper submit-form-wrapper body-content ng-scope" ng-controller="TabController as tab"
         ng-init="init()">
        <div id="advance" ng-controller="contestController" ng-init="init()" class="ng-scope">
            <div class="tab-content">
                <form method="post" enctype="multipart/form-data" onsubmit="return checkBeforeSubmit(this)"
                      class="ng-pristine ng-invalid ng-invalid-required">
                    <div id="infoTab" class="create-form tab-pane clearfix active" style="padding: 0px 0px">
                        <recipe-basic-info control="control" class="ng-isolate-scope">
                            <div class="simple-container" style="padding: 0 20px;">
                                <div class="form-row">
                                    <div class="form-group">
                                        <div class="has-photo">
                                            <output id="image-review">
                                                <span><img class="default-photo" style="width: 100%;"
                                                           src="<?= $recipe_cook->image->getImageBase() ?>"></span>
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
                                        <input id="name-recipe" type="text" name="name-recipe" class="form-control name ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" required="" placeholder="Nhập tên công thức" value="<?= $recipe_cook->getName() ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group has-feedback">
                                        <textarea id="description-recipe" name="description-recipe" rows="4" class="form-control name ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required" placeholder="Nhập nội dung mô tả ngắn gọn về công thức" required="" value=""><?= $recipe_cook->getDescription() ?></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Độ khó, Thời gian (phút)</label>
                                        <select style="float:left;margin-right:6px;width:180px;" class="form-control name ng-pristine ng-untouched ng-valid ng-not-empty" id="level" name="level" required="1">
                                            <?php if (($recipe_cook->getLevel()) === ('Không chỉ định')) { ?>
                                                <option value="Không chỉ định" selected>Không chỉ định</option>
                                                <option value="Dễ">Dễ</option>
                                                <option value="Trung bình">Trung bình</option>
                                                <option value="Khó">Khó</option>

                                            <?php } elseif (($recipe_cook->getLevel()) === ('Dễ')) { ?>
                                                <option value="Không chỉ định">Không chỉ định</option>
                                                <option value="Dễ" selected>Dễ</option>
                                                <option value="Trung bình">Trung bình</option>
                                                <option value="Khó">Khó</option>

                                            <?php } elseif (($recipe_cook->getLevel()) === ('Trung bình')) { ?>
                                                <option value="Không chỉ định">Không chỉ định</option>
                                                <option value="Dễ">Dễ</option>
                                                <option value="Trung bình" selected>Trung bình</option>
                                                <option value="Khó">Khó</option>

                                            <?php } elseif (($recipe_cook->getLevel()) === ('Khó')) { ?>
                                                <option value="Không chỉ định">Không chỉ định</option>
                                                <option value="Dễ">Dễ</option>
                                                <option value="Trung bình">Trung bình</option>
                                                <option value="Khó" selected>Khó</option>
                                            <?php } ?>
                                        </select>
                                        <input style="width:100px; float:left;" id="time_do" name="time_do" placeholder="phút" required type="number" class="form-control name ng-pristine ng-untouched ng-valid ng-not-empty" value="<?= $recipe_cook->getTimeDo() ?>">
                                    </div>
                                </div>
                                <div class="form-row ingredient-form">
                                    <div class="headline">
                                        <div class="form-left">Nguyên liệu <span style="color:red">*</span></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="ui-draggable ng-pristine ng-untouched ng-valid ng-scope ng-not-empty" id="ingr-draggable" >
                                            <div class="form-field ingredient-form-row ng-scope as-sortable-item">
                                                <recipe-ingredient-basic data-as-sortable-item-handle="" class="ng-scope as-sortable-item-handle">
                                                    <div class="ingredient-field">
                                                        <table ng-hide="ingr.completed" id="raw-material">
                                                            <tbody>
                                                            <datalist id="list_raw_material">
                                                                <?php if ($list_raw_material != null) { ?>
                                                                    <?php foreach ($list_raw_material as $item) { ?>
                                                                        <option><?= $item->getName() ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>

                                                            </datalist>
                                                            <datalist id="list_quantitative">
                                                                <?php if ($list_quantitative != null) { ?>
                                                                    <?php foreach ($list_quantitative as $item) { ?>
                                                                        <option><?= $item->getName() ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>

                                                            </datalist>
                                                            <?php if ($recipe_material != null) { ?>
                                                                <?php foreach ($recipe_material as $item) { ?>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="form-inline">
                                                                                <div class="form-group">
                                                                                    <label class="sr-only" for="raw-material">Nguyên liệu<span style="color:red"> (*)</span></label>
                                                                                    <input type="text" id="raw_material" list="list_raw_material" name="raw_material[]" class="form-control" required="1" placeholder="Nguyên liệu" value="<?= $item->rawmaterial->getName() ?>">
                                                                                </div>&nbsp;
                                                                                <div class="form-group">
                                                                                    <label class="sr-only" for="quantitative">Định lượng<span style="color:red"> (*)</span></label>
                                                                                    <input type="text" id="quantitative" list="list_quantitative" name="quantitative[]" class="form-control" required="1" placeholder="Định lượng" value="<?= $item->quantitative->getName() ?>">
                                                                                </div>&nbsp;
                                                                                <div class="form-group"><label class="sr-only" for="number">Number<span style="color:red"> (*)</span></label>
                                                                                    <input type="text" id="number" name="number[]" class="form-control" required="1" placeholder="Number" value="<?= $item->getNumber() ?>">
                                                                                </div>&nbsp;
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <a href="javascript:void(0)" class="btn btn-danger btn-close" style="margin-left:10px;display: block; position: relative;right: 0px;bottom: 0px"><span class="fa fa-trash"></span></a>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>

                                                            <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </recipe-ingredient-basic>
                                            </div>
                                            <a class="addmore-ingredients add-more-btn" href="javascript:void(0)"
                                               id="add-raw-material" onclick="addRawMaterial()"
                                               style="margin-top: 5px;margin-bottom: 10px">+ thêm nguyên liệu</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row heading">
                                    <div class="form-left">Cách làm <span style="color:red">*</span></div>
                                </div>
                                <div class="form-row" id="step">
                                    <?php if ($step != null) { ?>
                                        <?php foreach ($step as $item) { ?>
                                            <div ng-repeat="step in steps" class="ng-scope">
                                                <recipe-step>
                                                    <div class="step-box">
                                                        <a href="javascript:void(0)" class="btn btn-danger btn-close"><span class="fa fa-trash"></span></a>
                                                        <div class="step-count ng-binding"><?= $item->getCount() ?></div>
                                                        <div class="step-direction">
                                                            <textarea name="contentStep[]" rows="4" cols="40" class="form-control ng-pristine ng-untouched ng-valid ng-isolate-scope ng-empty" placeholder="Nhập hướng dẫn cách làm cho bước 1"><?= $item->getDescription() ?></textarea>
                                                        </div>
                                                        <div>
                                                            <div class="step-photo-container attached-photos-container" style="display:block; border: none; height:auto; background:none">
                                                                <div class="step-btns">
                                                                    <a class="step-photo-upload-btn disabled">
                                                                        <span class="fa fa-camera"></span> Tải hình ảnh bước thực hiện
                                                                    </a>
                                                                    <div class="text-gray text-italic text-small" style="text-align:center">(Giới hạn <span class="text-highlight ng-binding">6</span>hình ảnh)
                                                                    </div>
                                                                </div>
                                                                <div style="width:100%;padding: 10px 0;">
                                                                    <div style="min-height:100px; min-width:536px;">
                                                                        <div class="attached-photos">
                                                                            <input type="hidden"
                                                                                   name="numberImageStep[]" value="<?= $this->length($list_image_step[$item->getId()]) ?>">
                                                                            <?php if ($list_image_step[$item->getId()] != null) { ?>
                                                                                <?php foreach ($list_image_step[$item->getId()] as $item2) { ?>
                                                                                    <div class="attached-photo" style="margin-right: 5px">
                                                                                        <button class="review-img-upload-box-item" style="position: relative; display: inline-block; border: 1px solid #ddd; margin: 0px;padding:0px;width: 100px; height: 100px; vertical-align: middle;" title="upload on select files">
                                                                                            <span class="glyphicon glyphicon-plus" ng-hide="loading" style="display: none"></span>
                                                                                            <input type="file" name="stepImage[]" multiple="multiple" class="stepImage hasImage" style="opacity: 0;position: absolute; margin-top: 0px;width: 100px;height: 100px">
                                                                                            <input type="hidden" name="valueImageBase[]" value="<?= $item2->getImageUrl() ?>">
                                                                                            <div style="height: 100px;width: 100px;display: block">
                                                                                                <div>
                                                                                                    <a href="javascript:void(0);" title="view full size">
                                                                                                        <img style="width:100px;height:100px" src="<?= $item2->getImageUrl() ?>">
                                                                                                    </a>
                                                                                                    <a class="act remove removeStep" href="javascript:void(0);" title="Remove">+ </a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </button>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                            <div class="attached-photo">
                                                                                <button class="review-img-upload-box-item" style="position: relative; display: inline-block; border: 1px solid #ddd; margin: 0px;padding:0px;width: 100px; height: 100px; vertical-align: middle;" title="upload on select files">
                                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                                    <input type="file" name="stepImage[]" multiple="multiple" class="stepImage" style="opacity: 0;position: absolute; margin-top: -59px;width: 100px;height: 100px">
                                                                                    <input type="hidden" name="valueImageBase[]" value="">
                                                                                    <div style="height: 100px;width: 100px;display: none"></div>
                                                                                </button>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </recipe-step>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <a class="addmore-ingredients add-more-btn" href="javascript:void(0)" id="add-step" onclick="addStep()" target="_self">+ thêm bước thực hiện</a>
                            </div>
                        </recipe-basic-info>
                    </div>
                    <div id="finishTab" class="create-form tab-pane clearfix active" style="padding: 0px 0px">
                        <div class="simple-container ng-scope">
                            <div class="form-row">
                                <h4 class="title">Phân loại</h4>
                                <span class="desc text-gray">Bước phân loại này sẽ giúp cho người dùng tìm thấy công thức của bạn dễ dàng hơn</span>
                            </div>
                            <?php foreach ($list_category_type as $item) { ?>
                                <div class="form-row <?= $item->getCode() ?>">
                                    <h4><?= $item->getName() ?></h4>
                                    <input type="hidden" id="<?= $item->getCode() ?>" value="1">
                                    <recipe-mapping-list mappings="mapping.Courses" class="ng-isolate-scope">
                                        <ul class="list-inline">
                                            <?php if ($list_category[$item->getName()] != null) { ?>
                                                <?php foreach ($list_category[$item->getName()] as $item2) { ?>
                                                    <li class="col-sm-4 ng-scope" ng-repeat="map in mappings">
                                                        <?php if (isset($list_recipe_category[$item2->getId()])) { ?>
                                                            <label style="cursor:pointer;" class="text-green">
                                                                <input type="checkbox" name="category[]"
                                                                       class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"
                                                                       value="<?= $item2->getId() ?> " checked="checked">
                                                                <i class="fa fa-toggle-on " aria-hidden="true"></i>
                                                                <i class="fa fa-toggle-off ng-hide"
                                                                   aria-hidden="true"></i>
                                                                <span class="ng-binding"><?= $item2->getName() ?></span>
                                                            </label>
                                                        <?php } else { ?>
                                                            <label style="cursor:pointer;" class="text-gray">
                                                                <input type="checkbox" name="category[]"
                                                                       class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"
                                                                       value="<?= $item2->getId() ?>">
                                                                <i class="fa fa-toggle-on ng-hide"
                                                                   aria-hidden="true"></i>
                                                                <i class="fa fa-toggle-off" aria-hidden="true"></i>
                                                                <span class="ng-binding"><?= $item2->getName() ?></span>
                                                            </label>
                                                        <?php } ?>

                                                    </li>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    </recipe-mapping-list>
                                </div>
                                <p id="message-<?= $item->getCode() ?>" style="display: none;color: red">Vui lòng chọn 1
                                    phân loại của mục này</p>
                            <?php } ?>
                            <div class="form-row">
                                <div class="step-toolbar"
                                     style="border-top:1px solid #ddd; text-align:center;padding-top:15px;">
                                    <button class="btn btn-danger danger-gradient" style="width:100%;padding:15px;">Lưu
                                        &amp; Tiếp tục
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
    var numberStep = <?= $count_step ?>;
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

    function readUrlImageStep(evt) {
        var files = evt.target.files;
        var that = $(this);
        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    var div = document.createElement('div');
                    var html = '<div class="attached-photo"  style="margin-right: 5px"> ' +
                        '<button class="review-img-upload-box-item" style="position: relative; display: inline-block; border: 1px solid #ddd; margin: 0px;padding:0px;width: 100px; height: 100px; vertical-align: middle;" title="upload on select files">      ' +
                        '<span class="glyphicon glyphicon-plus" ng-hide="loading"></span>  ' +
                        '<input type="file" name="stepImage[]" multiple="multiple" class="stepImage" style="opacity: 0;position: absolute; margin-top: -59px;width: 100px;height: 100px">' +
                        '<input type="hidden" name="valueImageBase[]" value="">'+
                        '<div style="height: 100px;width: 100px;display: none">         ' +
                        '</div>      ' +
                        '</button>  ' +
                        '</div>';
                    div.innerHTML =
                        [
                            '<a href="javascript:void(0);" title="view full size">',
                            ' <img style="width:100px;height:100px" src="', e.target.result, '">',
                            ' </a>',
                            ' <a class="act remove removeStep" ng-click="delete(photo)" title="Remove" href="javascript:void(0);">+ </a>',
                        ].join('');
                    that.parent().children("div").html(div);
                    if (!that.hasClass('hasImage')) {
                        that.parent().parent().parent().append(html);
                        that.addClass('hasImage');
                    }
                    that.parent().parent().parent().children('input').val(Number(that.parent().parent().parent().children('input').val()) + 1);
                    that.parent().children("input").css('margin-top', '0px');
                    that.parent().children("div").css('display', 'block');
                    that.parent().children("span").css('display', 'none');
                    var userSelection = document.getElementsByClassName('stepImage');
                    for (var i = 0; i < userSelection.length; i++) {
                        (function (index) {
                            userSelection[index].addEventListener("change", readUrlImageStep, false);
                        })(i);
                    }
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }

    function addRawMaterial() {
        $("#raw-material tbody").append('<tr>' +
            '<td>' +
            '<div class="form-inline"><div class="form-group">' +
            ' <label class="sr-only" for="raw_material">Nguyên liệu' +
            '     <span style="color:red"> (*)</span> ' +
            ' </label> ' +
            ' <input type="text" id="raw_material" list="list_raw_material" name="raw_material[]" class="form-control raw_material" required="1" placeholder="Nguyên liệu" data-fv-notempty="true" data-fv-notempty-message="Please enter a value"> ' +
            ' </div> ' +
            '<div class="form-group"> ' +
            ' <label class="sr-only" for="quantitative">Định lượng ' +
            '     <span style="color:red"> (*)</span> ' +
            ' </label> ' +
            ' <input type="text" id="quantitative" name="quantitative[]" list="list_quantitative" class="form-control quantitative" required="1" placeholder="Định lượng" data-fv-notempty="true" data-fv-notempty-message="Please enter a value"> ' +
            '</div> ' +
            '<div class="form-group"> ' +
            ' <label class="sr-only" for="number">Number ' +
            '     <span style="color:red"> (*)</span> ' +
            ' </label> ' +
            ' <input type="text" id="number" name="number[]" class="form-control" required="1" placeholder="Number" data-fv-notempty="true" data-fv-notempty-message="Please enter a value"> ' +
            '</div></div>' +
            '</td>' +
            '<td>' +
            '<a href="javascript:void(0)" class="btn btn-danger btn-close" style="margin-left:10px;display: block; position: relative;right: 0px;bottom: 0px"><span class="fa fa-trash"></span></a>' +
            '</td>' +
            '</tr> ');
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
        <?php foreach ($list_category_type as $item) { ?>
        $(".<?= $item->getCode() ?> input[type=checkbox]").on("click", function () {

            <?php if (($item->getCode()) === ('CACH-THUC-HIEN')) { ?>
            $(".<?= $item->getCode() ?> input[type=checkbox]").each(function () {
                $(this).prop('checked', false);
                $(this).parent().addClass('text-gray');
                $(this).parent().removeClass('text-green');
                $(this).parent().children("i:nth-child(2)").addClass('ng-hide');
                $(this).parent().children("i:nth-child(3)").removeClass('ng-hide');
            });
            $(this).prop('checked', true);
            $(this).parent().removeClass('text-gray');
            $(this).parent().addClass('text-green');
            $(this).parent().children(":nth-child(2)").removeClass('ng-hide');
            $(this).parent().children(":nth-child(3)").addClass('ng-hide');
            <?php } else { ?>
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
            <?php } ?>

        });
        <?php } ?>
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

    function category() {
        <?php foreach ($list_category_type as $item) { ?>
        $(".<?= $item->getCode() ?> input[type=checkbox]").on("click", function () {
            var content = '';
            $(".<?= $item->getCode() ?> input[type=checkbox]").each(function () {
                if ($(this).is(":checked")) {
                    content += $(this).val() + ',';
                }
            });
            $("#<?= $item->getCode() ?>").val(content);
        });
        <?php } ?>
    }

    function checkBeforeSubmit() {
        <?php foreach ($list_category_type as $item) { ?>
        if ($("#<?= $item->getCode() ?>").val().length == 0) {
            $('#message-<?= $item->getCode() ?>').css('display', 'block');
            return false;
        } else {
            $('#message-<?= $item->getCode() ?>').css('display', 'none');
        }
        <?php } ?>

        return true;
    }

    function removeImageStep() {
        $('#step ').on('click', '.removeStep', function () {
            $(this).parent().parent().parent().parent().parent().children('input').val(Number( $(this).parent().parent().parent().parent().parent().children('input').val()) - 1);
            $(this).parent().parent().parent().parent().remove();

        });
    }

    $(document).ready(function () {
        deleteRawMaterial();
        deleteStep();
        isCheck();
        category();
        removeImageStep();
        document.getElementById('image-logo').addEventListener('change', handleFileSelect, false);
        $('input[name="files"]').each(function () {
            alert($(this).val());
        });
        var userSelection = document.getElementsByClassName('stepImage');
        console.log(userSelection.length);
        for (var i = 0; i < userSelection.length; i++) {
            (function (index) {
                userSelection[index].addEventListener("change", readUrlImageStep, false);
                var locationStepImage = $(this);

            })(i);
        }
    });


</script>
