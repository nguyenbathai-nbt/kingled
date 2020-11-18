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
        <?php if ($quantitative != null) { ?>
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
                        <th> <?= $this->helper->translate('Mã rút gọn') ?></th>
                        <th> <?= $this->helper->translate('Trạng thái') ?></th>
                        <th> <?= $this->helper->translate('Thao tác') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $v9057542421iterator = $quantitative; $v9057542421incr = 0; $v9057542421loop = new stdClass(); $v9057542421loop->self = &$v9057542421loop; $v9057542421loop->length = count($v9057542421iterator); $v9057542421loop->index = 1; $v9057542421loop->index0 = 1; $v9057542421loop->revindex = $v9057542421loop->length; $v9057542421loop->revindex0 = $v9057542421loop->length - 1; ?><?php foreach ($v9057542421iterator as $item) { ?><?php $v9057542421loop->first = ($v9057542421incr == 0); $v9057542421loop->index = $v9057542421incr + 1; $v9057542421loop->index0 = $v9057542421incr; $v9057542421loop->revindex = $v9057542421loop->length - $v9057542421incr; $v9057542421loop->revindex0 = $v9057542421loop->length - ($v9057542421incr + 1); $v9057542421loop->last = ($v9057542421incr == ($v9057542421loop->length - 1)); ?>
                        <tr>
                            <td><?= $v9057542421loop->index ?></td>
                            <td><?= $item->getName() ?></td>
                            <td><?= $item->getCode() ?></td>
                            <td><?= $item->getShortCode() ?></td>
                            <td><?= $item->status->getName() ?></td>
                            <td>
                                 <a class="btn btn-primary" href="<?= $this->url->get() ?>admin/quantitative/editQuantitative/<?= $item->getId() ?>" title="<?= $this->helper->translate('Chỉnh sửa thông tin định lượng') ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                                <a id="deleteCustomer" class="btn btn-danger confirm_dialog" href="<?= $this->url->get() ?>admin/quantitative/deleteQuantitative/<?= $item->getId() ?>" title="<?= $this->helper->translate('Xóa định lượng') ?>"><i class="glyphicon glyphicon-trash"></i></a>
                            </td>

                        </tr>
                    <?php $v9057542421incr++; } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div>Don't have data</div>
        <?php } ?>
    </div>
    <div class="box-footer">
        <?php if ($quantitative != null) { ?>
            <?= $paging ?>
        <?php } ?>
    </div>
</div>