<div class="box box-success def-content">
    <div class="box-header">
        <div><?= $this->flashSession->output() ?></div>
        <div class="pull">
            <form class="form-inline">
                <?= $form->renderInlineAll() ?>
                <button class="btn btn-flat btn-primary" type="submit"><i
                            class="fa fa-search"></i> <?= $this->helper->translate('Search') ?></button>
                
            </form>
        </div>
    </div>
    <div class="box-body table-responsive">
        <?php if ($bookmark != null) { ?>
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th> <?= $this->helper->translate('User') ?></th>
                        <th> <?= $this->helper->translate('Recipe cook') ?></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $v14125294881iterator = $bookmark; $v14125294881incr = 0; $v14125294881loop = new stdClass(); $v14125294881loop->self = &$v14125294881loop; $v14125294881loop->length = count($v14125294881iterator); $v14125294881loop->index = 1; $v14125294881loop->index0 = 1; $v14125294881loop->revindex = $v14125294881loop->length; $v14125294881loop->revindex0 = $v14125294881loop->length - 1; ?><?php foreach ($v14125294881iterator as $item) { ?><?php $v14125294881loop->first = ($v14125294881incr == 0); $v14125294881loop->index = $v14125294881incr + 1; $v14125294881loop->index0 = $v14125294881incr; $v14125294881loop->revindex = $v14125294881loop->length - $v14125294881incr; $v14125294881loop->revindex0 = $v14125294881loop->length - ($v14125294881incr + 1); $v14125294881loop->last = ($v14125294881incr == ($v14125294881loop->length - 1)); ?>
                        <tr>
                            <td><?= $v14125294881loop->index ?></td>
                            <td><?= $item->user->username ?></td>
                            <td><?= $item->recipe_cook->name ?></td>










                        </tr>
                    <?php $v14125294881incr++; } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div>Don't have data</div>
        <?php } ?>
    </div>
    <div class="box-footer">
        <?php if ($bookmark != null) { ?>
            <?= $paging ?>
        <?php } ?>
    </div>
</div>