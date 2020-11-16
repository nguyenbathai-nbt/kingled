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
        <?php if ($role != null) { ?>
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
                    <?php $v6583476561iterator = $role; $v6583476561incr = 0; $v6583476561loop = new stdClass(); $v6583476561loop->self = &$v6583476561loop; $v6583476561loop->length = count($v6583476561iterator); $v6583476561loop->index = 1; $v6583476561loop->index0 = 1; $v6583476561loop->revindex = $v6583476561loop->length; $v6583476561loop->revindex0 = $v6583476561loop->length - 1; ?><?php foreach ($v6583476561iterator as $item) { ?><?php $v6583476561loop->first = ($v6583476561incr == 0); $v6583476561loop->index = $v6583476561incr + 1; $v6583476561loop->index0 = $v6583476561incr; $v6583476561loop->revindex = $v6583476561loop->length - $v6583476561incr; $v6583476561loop->revindex0 = $v6583476561loop->length - ($v6583476561incr + 1); $v6583476561loop->last = ($v6583476561incr == ($v6583476561loop->length - 1)); ?>
                        <tr>
                            <td><?= $v6583476561loop->index ?></td>
                            <td><?= $item->getName() ?></td>
                            <td><?= $item->getCode() ?></td>
                            <td>
                                <a class="btn btn-primary"
                                   href="<?= $this->url->get() ?>admin/role/viewRole/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Xem thông tin quyền') ?>"><i class="fa fa-file-text"></i>&nbsp;</a>
                                <a class="btn btn-primary" href="<?= $this->url->get() ?>admin/role/editRole/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Chỉnh sửa quyền') ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                                <a id="deleteCustomer" class="btn btn-danger confirm_dialog"
                                   href="<?= $this->url->get() ?>admin/role/deleteRole/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Xóa quyền') ?>"><i class="glyphicon glyphicon-trash"></i></a>
                            </td>

                        </tr>
                    <?php $v6583476561incr++; } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div>Không có dữ liệu</div>
        <?php } ?>
    </div>
    <div class="box-footer">
        <?php if ($role != null) { ?>
            <?= $paging ?>
        <?php } ?>
    </div>
</div>