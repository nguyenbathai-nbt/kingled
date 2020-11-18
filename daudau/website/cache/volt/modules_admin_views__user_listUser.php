<div class="box box-success def-content">
    <div class="box-header">
        <div><?= $this->flashSession->output() ?></div>
        <div class="pull">
            <form class="form-inline">
                


                
            </form>
        </div>
    </div>
    <div class="box-body table-responsive">
        <?php if ($user != null) { ?>
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th> <?= $this->helper->translate('Tên đăng nhập') ?></th>
                        <th> <?= $this->helper->translate('E-mail') ?></th>
                        <th> <?= $this->helper->translate('Số điện thoại') ?></th>
                        <th> <?= $this->helper->translate('Trạng thái') ?></th>
                        <th> <?= $this->helper->translate('Quyền') ?></th>
                        <th> <?= $this->helper->translate('Thao tác') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $v37222346901iterator = $user; $v37222346901incr = 0; $v37222346901loop = new stdClass(); $v37222346901loop->self = &$v37222346901loop; $v37222346901loop->length = count($v37222346901iterator); $v37222346901loop->index = 1; $v37222346901loop->index0 = 1; $v37222346901loop->revindex = $v37222346901loop->length; $v37222346901loop->revindex0 = $v37222346901loop->length - 1; ?><?php foreach ($v37222346901iterator as $item) { ?><?php $v37222346901loop->first = ($v37222346901incr == 0); $v37222346901loop->index = $v37222346901incr + 1; $v37222346901loop->index0 = $v37222346901incr; $v37222346901loop->revindex = $v37222346901loop->length - $v37222346901incr; $v37222346901loop->revindex0 = $v37222346901loop->length - ($v37222346901incr + 1); $v37222346901loop->last = ($v37222346901incr == ($v37222346901loop->length - 1)); ?>
                        <tr>
                            <td><?= $v37222346901loop->index ?></td>
                            <td><?= $item->getUsername() ?></td>
                            <td><?= $item->getEmail() ?></td>
                            <td><?= $item->getPhone() ?></td>
                            <td><?= $item->status->getCode() ?></td>
                            <td><?= $item->role->getCode() ?></td>
                            <td>
                                <a class="btn btn-primary"
                                   href="<?= $this->url->get() ?>admin/user/viewUser/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Xem thông tin người dùng') ?>"><i class="fa fa-file-text"></i>&nbsp;</a>
                                <a class="btn btn-primary" href="<?= $this->url->get() ?>admin/user/editUser/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Chỉnh sửa người dùng') ?>"><i
                                            class="glyphicon glyphicon-pencil"></i></a>
                                <a class="btn btn-danger confirm_dialog"
                                   href="<?= $this->url->get() ?>admin/user/deleteUser/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Xóa người dùng') ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </td>

                        </tr>
                    <?php $v37222346901incr++; } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div>Không có dữ liệu</div>
        <?php } ?>
    </div>
    <div class="box-footer">
        <?php if ($user != null) { ?>
            <?= $paging ?>
        <?php } ?>
    </div>
</div>