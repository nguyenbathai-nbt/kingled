<div class="box box-success def-content">
    <div class="box-header">
        <div><?= $this->flashSession->output() ?></div>
        <div class="pull">
            <form class="form-inline">


                
            </form>
        </div>
    </div>
    <div class="box-body table-responsive">
        <?php if ($spam_recipe_cook != null) { ?>
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th> <?= $this->helper->translate('Tên người dùng') ?></th>
                        <th> <?= $this->helper->translate('Tên công thức') ?></th>
                        <th> <?= $this->helper->translate('Nội dung phản hồi') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $v3513208781iterator = $spam_recipe_cook; $v3513208781incr = 0; $v3513208781loop = new stdClass(); $v3513208781loop->self = &$v3513208781loop; $v3513208781loop->length = count($v3513208781iterator); $v3513208781loop->index = 1; $v3513208781loop->index0 = 1; $v3513208781loop->revindex = $v3513208781loop->length; $v3513208781loop->revindex0 = $v3513208781loop->length - 1; ?><?php foreach ($v3513208781iterator as $item) { ?><?php $v3513208781loop->first = ($v3513208781incr == 0); $v3513208781loop->index = $v3513208781incr + 1; $v3513208781loop->index0 = $v3513208781incr; $v3513208781loop->revindex = $v3513208781loop->length - $v3513208781incr; $v3513208781loop->revindex0 = $v3513208781loop->length - ($v3513208781incr + 1); $v3513208781loop->last = ($v3513208781incr == ($v3513208781loop->length - 1)); ?>
                        <tr>
                            <td><?= $v3513208781loop->index ?></td>
                            <td><?= $item->user->getUserName() ?></td>
                            <td><?= $item->recipe->getCode() ?></td>
                            <td><?= $item->getDescription() ?></td>


                        </tr>
                    <?php $v3513208781incr++; } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div>Không có dữ liệu</div>
        <?php } ?>
    </div>
</div>