<form method="post" action="">
    <div class="box box-success">
        <div class="box-header">
            <div><?= $this->flashSession->output() ?></div>

        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->renderDecorated('username') ?>
                    <?= $form->renderDecorated('email') ?>
                    <?= $form->renderDecorated('phone') ?>

                </div>
                <div class="col-md-6">

                    <?= $form->renderDecorated('status_id') ?>
                    <?= $form->renderDecorated('role_id') ?>
                </div>

            </div>
        </div>
        <?php if (($user->role->getCode()) === ('CHEF')) { ?>
            <div class="col-md-12">
                <div class="simple-container ng-scope">
                    <div class="form-row">
                        <h4 class="title">Phân loại</h4>
                        <span class="desc text-gray">Đầu bếp chỉ được duyệt những công thức thuộc nhóm những nhóm này</span>
                    </div>
                    <?php foreach ($list_category_type as $item) { ?>
                        <div class="form-row <?= $item->getCode() ?>">
                            <h4><?= $item->getName() ?></h4>
                            <input type="hidden" id="<?= $item->getCode() ?>">
                            <div class="row" style="margin-left: 0px; margin-right: 0px">
                                <recipe-mapping-list mappings="mapping.Courses" class="ng-isolate-scope">
                                    <ul class="list-inline">
                                        <?php if ($list_category[$item->getName()] != null) { ?>
                                            <?php foreach ($list_category[$item->getName()] as $item2) { ?>
                                                <li class="col-sm-3 ng-scope" ng-repeat="map in mappings">
                                                    <?php if ($this->isIncluded($item2->getId(), $list_id_user_category)) { ?>
                                                        <label style="cursor:pointer;color: green"
                                                               class="text-green">
                                                            <input type="checkbox" name="category[]"
                                                                   class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"
                                                                   value="<?= $item2->getId() ?>" checked="checked">
                                                            <i class="fa fa-toggle-on " aria-hidden="true"></i>
                                                            <i class="fa fa-toggle-off ng-hide" aria-hidden="true"></i>
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
                        </div>
                        </br>
                    <?php } ?>

                </div>
            </div>
        <?php } ?>
        <div class="box-footer">
            <div class="pull-right">

                <input type="submit" class="btn btn-primary" value="Lưu"/>
                <a href="<?= $this->url->get() ?>admin/user/listUser" class="btn btn-default"><i class="icon left arrow"></i> Trở lại</a>
            </div>

        </div>
    </div>
</form>

<script type="text/javascript" src="/public/js/jquery.js"></script>
<script type="text/javascript">
    var numberStep = 1;
    var numberStepAfterDelete = 1;

    function isCheck() {
        <?php foreach ($list_category_type as $item) { ?>
        $(".<?= $item->getCode() ?> input[type=checkbox]").on("click", function () {
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
        <?php } ?>
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

    $(document).ready(function () {
        isCheck();
        category();

    });


</script>
