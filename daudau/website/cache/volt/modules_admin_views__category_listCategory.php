<div class="box box-success def-content">
    <div class="box-header">
        <div><?= $this->flashSession->output() ?></div>
        <div class="pull">
            <form class="form-inline">
                <?= $form->renderInlineAll() ?>


                
            </form>
        </div>
    </div>
    <div class="box-body table-responsive">
        <?php if ($category != null) { ?>
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th> <?= $this->helper->translate('Tên ') ?></th>
                        <th> <?= $this->helper->translate('Mã số') ?></th>
                        <th> <?= $this->helper->translate('Thế loại') ?></th>
                        <th> <?= $this->helper->translate('Trạng thái') ?></th>
                        <th> <?= $this->helper->translate('Thao tác') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $v12407864001iterator = $category; $v12407864001incr = 0; $v12407864001loop = new stdClass(); $v12407864001loop->self = &$v12407864001loop; $v12407864001loop->length = count($v12407864001iterator); $v12407864001loop->index = 1; $v12407864001loop->index0 = 1; $v12407864001loop->revindex = $v12407864001loop->length; $v12407864001loop->revindex0 = $v12407864001loop->length - 1; ?><?php foreach ($v12407864001iterator as $item) { ?><?php $v12407864001loop->first = ($v12407864001incr == 0); $v12407864001loop->index = $v12407864001incr + 1; $v12407864001loop->index0 = $v12407864001incr; $v12407864001loop->revindex = $v12407864001loop->length - $v12407864001incr; $v12407864001loop->revindex0 = $v12407864001loop->length - ($v12407864001incr + 1); $v12407864001loop->last = ($v12407864001incr == ($v12407864001loop->length - 1)); ?>
                        <tr>
                            <td><?= $v12407864001loop->index ?></td>
                            <td><?= $item->getName() ?></td>
                            <td><?= $item->getCode() ?></td>
                            <td><?= $item->category_type->getName() ?></td>
                            <td><?= $item->status->getName() ?></td>
                            <td>
                                <a class="btn btn-primary"
                                   href="<?= $this->url->get() ?>admin/category/viewCategory/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Xem thông tin nhóm công thức') ?>"><i class="fa fa-file-text"></i>&nbsp;</a>
                                <a class="btn btn-primary"
                                   href="<?= $this->url->get() ?>admin/category/editCategory/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Chỉnh sửa nhóm công thức') ?>"><i
                                            class="glyphicon glyphicon-pencil"></i></a>
                                <a id="deleteCustomer" class="btn btn-danger confirm_dialog"
                                   href="<?= $this->url->get() ?>admin/category/deleteCategory/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Xóa nhóm công thức') ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </td>

                        </tr>
                    <?php $v12407864001incr++; } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div>Không có dữ liệu</div>
        <?php } ?>
    </div>
    <div class="box-footer">
        <?php if ($category != null) { ?>
            <?= $paging ?>
        <?php } ?>
    </div>
</div>