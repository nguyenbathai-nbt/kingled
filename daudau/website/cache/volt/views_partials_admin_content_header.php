<section class="content-header">
    <h1>
        <?php $v3346244201iterator = $names; $v3346244201incr = 0; $v3346244201loop = new stdClass(); $v3346244201loop->self = &$v3346244201loop; $v3346244201loop->length = count($v3346244201iterator); $v3346244201loop->index = 1; $v3346244201loop->index0 = 1; $v3346244201loop->revindex = $v3346244201loop->length; $v3346244201loop->revindex0 = $v3346244201loop->length - 1; ?><?php foreach ($v3346244201iterator as $name) { ?><?php $v3346244201loop->first = ($v3346244201incr == 0); $v3346244201loop->index = $v3346244201incr + 1; $v3346244201loop->index0 = $v3346244201incr; $v3346244201loop->revindex = $v3346244201loop->length - $v3346244201incr; $v3346244201loop->revindex0 = $v3346244201loop->length - ($v3346244201incr + 1); $v3346244201loop->last = ($v3346244201incr == ($v3346244201loop->length - 1)); ?>
            <?php if ($v3346244201loop->last) { ?>
                <?= $this->helper->translate($name['label']) ?>
            <?php } ?>
        <?php $v3346244201incr++; } ?>
        <!--        <small>Version 2.0</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa "></i> <?= $this->helper->translate('Home') ?></a></li>
        <?php $v3346244201iterator = $names; $v3346244201incr = 0; $v3346244201loop = new stdClass(); $v3346244201loop->self = &$v3346244201loop; $v3346244201loop->length = count($v3346244201iterator); $v3346244201loop->index = 1; $v3346244201loop->index0 = 1; $v3346244201loop->revindex = $v3346244201loop->length; $v3346244201loop->revindex0 = $v3346244201loop->length - 1; ?><?php foreach ($v3346244201iterator as $name) { ?><?php $v3346244201loop->first = ($v3346244201incr == 0); $v3346244201loop->index = $v3346244201incr + 1; $v3346244201loop->index0 = $v3346244201incr; $v3346244201loop->revindex = $v3346244201loop->length - $v3346244201incr; $v3346244201loop->revindex0 = $v3346244201loop->length - ($v3346244201incr + 1); $v3346244201loop->last = ($v3346244201incr == ($v3346244201loop->length - 1)); ?>
            <li class="active">
                <?= $this->tag->linkTo([$name['href'], $this->helper->translate($name['label'])]) ?>
            </li>
        <?php $v3346244201incr++; } ?>
    </ol>
</section>
<div class="container-fluid" style="margin-top: 15px">
    <?= $this->flashSession->output() ?>
</div>