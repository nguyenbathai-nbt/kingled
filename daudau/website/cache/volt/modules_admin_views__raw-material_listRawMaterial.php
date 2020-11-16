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
        <?php if ($raw_meterial != null) { ?>
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
                    <?php $v38222984351iterator = $raw_meterial; $v38222984351incr = 0; $v38222984351loop = new stdClass(); $v38222984351loop->self = &$v38222984351loop; $v38222984351loop->length = count($v38222984351iterator); $v38222984351loop->index = 1; $v38222984351loop->index0 = 1; $v38222984351loop->revindex = $v38222984351loop->length; $v38222984351loop->revindex0 = $v38222984351loop->length - 1; ?><?php foreach ($v38222984351iterator as $item) { ?><?php $v38222984351loop->first = ($v38222984351incr == 0); $v38222984351loop->index = $v38222984351incr + 1; $v38222984351loop->index0 = $v38222984351incr; $v38222984351loop->revindex = $v38222984351loop->length - $v38222984351incr; $v38222984351loop->revindex0 = $v38222984351loop->length - ($v38222984351incr + 1); $v38222984351loop->last = ($v38222984351incr == ($v38222984351loop->length - 1)); ?>
                        <tr>
                            <td><?= $v38222984351loop->index ?></td>
                            <td><?= $item->getName() ?></td>
                            <td><?= $item->getCode() ?></td>
                            <td><?= $item->getShortCode() ?></td>
                            <td><?= $item->status->getName() ?></td>
                            <td>

                                <a class="btn btn-primary"
                                   href="<?= $this->url->get() ?>admin/raw-material/editRawMaterial/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Chỉnh sửa nguyên liệu') ?>"><i
                                            class="glyphicon glyphicon-pencil"></i></a>
                                <a id="deleteCustomer" class="btn btn-danger confirm_dialog"
                                   href="<?= $this->url->get() ?>admin/raw-material/deleteRawMaterial/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Xóa nguyên liệu') ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </td>

                        </tr>
                    <?php $v38222984351incr++; } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div>Don't have data</div>
        <?php } ?>
    </div>
    <div class="box-footer">
        <?php if ($raw_meterial != null) { ?>
            <?= $paging ?>
        <?php } ?>
    </div>
</div>