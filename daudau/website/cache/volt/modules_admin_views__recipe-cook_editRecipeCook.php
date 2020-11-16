
<form method="post" action="" >
    <div class="box box-success">
        <div class="box-header">
            <div><?= $this->flashSession->output() ?></div>

        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->renderDecorated('name') ?>
                    <?= $form->renderDecorated('code') ?>
                    <?= $form->renderDecorated('level') ?>
                    <?= $form->renderDecorated('link_video') ?>


                </div>
                <div class="col-md-6">
                    <?= $form->renderDecorated('time_do') ?>
                    <?= $form->renderDecorated('description') ?>
                    <?= $form->renderDecorated('status_id') ?>
                    <?= $form->renderDecorated('link_share') ?>

                </div>


            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <input type="submit" class="btn btn-primary" value="Lưu"/>
                <a href="/admin/category/listCategory" class="btn btn-default"><i class="icon left arrow"></i> Trở lại</a>

            </div>
        </div>
    </div>
</form>