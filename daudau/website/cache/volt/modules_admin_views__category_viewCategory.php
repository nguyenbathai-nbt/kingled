
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


                </div>
                <div class="col-md-6">
                    <?= $form->renderDecorated('type_id') ?>
                    <?= $form->renderDecorated('status_id') ?>

                </div>

            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <a href="/admin/category/listCategory" class="btn btn-default"><i class="icon left arrow"></i> Trở về</a>

            </div>
        </div>
    </div>
</form>