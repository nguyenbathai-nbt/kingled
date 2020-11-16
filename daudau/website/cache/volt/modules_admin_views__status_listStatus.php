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
        <?php if ($status != null) { ?>
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th> <?= $this->helper->translate('Tên') ?></th>
                        <th> <?= $this->helper->translate('Mã số') ?></th>
                        <th> <?= $this->helper->translate('Thao tác') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $v1523236281iterator = $status; $v1523236281incr = 0; $v1523236281loop = new stdClass(); $v1523236281loop->self = &$v1523236281loop; $v1523236281loop->length = count($v1523236281iterator); $v1523236281loop->index = 1; $v1523236281loop->index0 = 1; $v1523236281loop->revindex = $v1523236281loop->length; $v1523236281loop->revindex0 = $v1523236281loop->length - 1; ?><?php foreach ($v1523236281iterator as $item) { ?><?php $v1523236281loop->first = ($v1523236281incr == 0); $v1523236281loop->index = $v1523236281incr + 1; $v1523236281loop->index0 = $v1523236281incr; $v1523236281loop->revindex = $v1523236281loop->length - $v1523236281incr; $v1523236281loop->revindex0 = $v1523236281loop->length - ($v1523236281incr + 1); $v1523236281loop->last = ($v1523236281incr == ($v1523236281loop->length - 1)); ?>
                        <tr>
                            <td><?= $v1523236281loop->index ?></td>
                            <td><?= $item->getName() ?></td>
                            <td><?= $item->getCode() ?></td>
                            <td>
                                <a class="btn btn-primary"
                                   href="<?= $this->url->get() ?>admin/status/viewStatus/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Xem thông tin trạng thái') ?>"><i
                                            class="fa fa-file-text"></i>&nbsp;</a>
                                <a class="btn btn-primary"
                                   href="<?= $this->url->get() ?>admin/status/editStatus/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Chỉnh sửa trạng thái') ?>"><i
                                            class="glyphicon glyphicon-pencil"></i></a>
                                <a id="deleteCustomer" class="btn btn-danger confirm_dialog"
                                   href="<?= $this->url->get() ?>admin/status/deleteStatus/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Xóa trạng thái') ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </td>

                        </tr>
                    <?php $v1523236281incr++; } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div>Không có dữ liệu</div>
        <?php } ?>
    </div>
    <div class="box-footer">
        <?php if ($status != null) { ?>
            <?= $paging ?>
        <?php } ?>
    </div>
</div>