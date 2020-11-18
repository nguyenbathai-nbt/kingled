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
        <?php if ($recipe_cook != null) { ?>
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th> <?= $this->helper->translate('Tên') ?></th>
                        <th> <?= $this->helper->translate('Mã') ?></th>
                        <th> <?= $this->helper->translate('Độ khó') ?></th>
                        <th> <?= $this->helper->translate('Lượt thích') ?></th>
                        <th> <?= $this->helper->translate('Lượt xem') ?></th>
                        <th> <?= $this->helper->translate('Thời gian') ?></th>
                        <th> <?= $this->helper->translate('Mô tả') ?></th>
                        <th> <?= $this->helper->translate('Người dùng') ?></th>
                        <th> <?= $this->helper->translate('Trạng thái') ?></th>
                        <th> <?= $this->helper->translate('Action') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $v18020595451iterator = $recipe_cook; $v18020595451incr = 0; $v18020595451loop = new stdClass(); $v18020595451loop->self = &$v18020595451loop; $v18020595451loop->length = count($v18020595451iterator); $v18020595451loop->index = 1; $v18020595451loop->index0 = 1; $v18020595451loop->revindex = $v18020595451loop->length; $v18020595451loop->revindex0 = $v18020595451loop->length - 1; ?><?php foreach ($v18020595451iterator as $item) { ?><?php $v18020595451loop->first = ($v18020595451incr == 0); $v18020595451loop->index = $v18020595451incr + 1; $v18020595451loop->index0 = $v18020595451incr; $v18020595451loop->revindex = $v18020595451loop->length - $v18020595451incr; $v18020595451loop->revindex0 = $v18020595451loop->length - ($v18020595451incr + 1); $v18020595451loop->last = ($v18020595451incr == ($v18020595451loop->length - 1)); ?>
                        <tr>
                            <td><?= $v18020595451loop->index ?></td>
                            <td><?= $item->getName() ?></td>
                            <td><?= $item->getCode() ?></td>
                            <td><?= $item->getLevel() ?></td>
                            <td><?= $item->getBookmarkTotal() ?></td>
                            <td><?= $item->totalSeemRecipe($item->getId()) ?></td>
                            <td><?= $item->getTimeDo() ?></td>
                            <td><?= $item->getDescription() ?></td>
                            <td><?= $item->user->getUserName() ?></td>
                            <?php if (($item->status->getCode()) === ('enable')) { ?>
                                <td><span class="btn-success" style="padding: 5px;border-radius: 5px;margin-top: 5px;line-height: 30px;font-size: 8px"><?= $item->status->getName() ?></span></td>
                            <?php } elseif (($item->status->getCode()) === ('reject')) { ?>
                                <td><span class="btn-danger" style="padding: 5px;border-radius: 5px;margin-top: 5px;line-height: 30px;font-size: 8px"><?= $item->status->getName() ?></span></td>
                            <?php } elseif (($item->status->getCode()) === ('disable')) { ?>
                                <td><span class="btn-danger" style="padding: 5px;border-radius: 5px;margin-top: 5px;line-height: 30px;font-size: 8px"><?= $item->status->getName() ?></span></td>
                            <?php } elseif (($item->status->getCode()) === ('confirm')) { ?>
                                <td><span class="btn-info" style="padding: 5px;border-radius: 5px;margin-top: 5px;line-height: 30px;font-size: 8px"><?= $item->status->getName() ?></span></td>
                            <?php } elseif (($item->status->getCode()) === ('edit')) { ?>
                                <td><span class="btn-warning" style="padding: 5px;border-radius: 5px;margin-top: 5px;line-height: 30px;font-size: 8px"><?= $item->status->getName() ?></span></td>
                            <?php } elseif (($item->status->getCode()) === ('old')) { ?>
                                <td></td>
                            <?php } ?>
                            <td>
                                <a class="btn btn-primary"
                                   href="<?= $this->url->get() ?>admin/recipe-cook/informationRecipeCook/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Xem thông tin công thức') ?>"><i class="fa fa-file-text"></i>&nbsp;</a>
                                <a class="btn btn-info"
                                   href="<?= $this->url->get() ?>admin/recipe-cook/editRecipeCook/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Chỉnh sửa công thức') ?>"><i
                                            class="glyphicon glyphicon-pencil"></i></a>
                                <a class="btn btn-info"
                                   href="<?= $this->url->get() ?>admin/recipe-cook/spamRecipeCook/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Xem phản hồi công thức') ?>"><i
                                            class="glyphicon glyphicon-th-list"></i></a>
                                <a id="deleteCustomer" class="btn btn-danger confirm_dialog"
                                   href="<?= $this->url->get() ?>admin/recipe-cook/deleteRecipeCook/<?= $item->getId() ?>"
                                   title="<?= $this->helper->translate('Xóa công thức') ?>"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </td>
                        </tr>
                    <?php $v18020595451incr++; } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div>Don't have data</div>
        <?php } ?>
    </div>
    <div class="box-footer">
        <?php if ($recipe_cook != null) { ?>
            <?= $paging ?>
        <?php } ?>
    </div>
</div>