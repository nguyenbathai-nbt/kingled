<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= $this->tag->getTitle() ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="/favicon.png" type="image/png">
    <?= $this->tag->stylesheetLink('/AdminLTE-2.4.10/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>
    <?= $this->tag->stylesheetLink('/AdminLTE-2.4.10/bower_components/font-awesome/css/font-awesome.min.css') ?>
    <?= $this->tag->stylesheetLink('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') ?>
    <?= $this->tag->stylesheetLink('/AdminLTE-2.4.10/dist/css/AdminLTE.css') ?>
    <?= $this->tag->stylesheetLink('/rateit/scripts/rateit.css') ?>
    <?php $v25556856241iterator = $stylesheets; $v25556856241incr = 0; $v25556856241loop = new stdClass(); $v25556856241loop->self = &$v25556856241loop; $v25556856241loop->length = count($v25556856241iterator); $v25556856241loop->index = 1; $v25556856241loop->index0 = 1; $v25556856241loop->revindex = $v25556856241loop->length; $v25556856241loop->revindex0 = $v25556856241loop->length - 1; ?><?php foreach ($v25556856241iterator as $stylesheet) { ?><?php $v25556856241loop->first = ($v25556856241incr == 0); $v25556856241loop->index = $v25556856241incr + 1; $v25556856241loop->index0 = $v25556856241incr; $v25556856241loop->revindex = $v25556856241loop->length - $v25556856241incr; $v25556856241loop->revindex0 = $v25556856241loop->length - ($v25556856241incr + 1); $v25556856241loop->last = ($v25556856241incr == ($v25556856241loop->length - 1)); ?>
        <link rel="stylesheet" type="text/css" href="<?= $stylesheet ?>">
    <?php $v25556856241incr++; } ?>
    <?php if (isset($stylesheetsother)) { ?>
        <?php $v25556856241iterator = $stylesheetsother; $v25556856241incr = 0; $v25556856241loop = new stdClass(); $v25556856241loop->self = &$v25556856241loop; $v25556856241loop->length = count($v25556856241iterator); $v25556856241loop->index = 1; $v25556856241loop->index0 = 1; $v25556856241loop->revindex = $v25556856241loop->length; $v25556856241loop->revindex0 = $v25556856241loop->length - 1; ?><?php foreach ($v25556856241iterator as $stylesheet) { ?><?php $v25556856241loop->first = ($v25556856241incr == 0); $v25556856241loop->index = $v25556856241incr + 1; $v25556856241loop->index0 = $v25556856241incr; $v25556856241loop->revindex = $v25556856241loop->length - $v25556856241incr; $v25556856241loop->revindex0 = $v25556856241loop->length - ($v25556856241incr + 1); $v25556856241loop->last = ($v25556856241incr == ($v25556856241loop->length - 1)); ?>
            <link rel="stylesheet" type="text/css" href="<?= $stylesheet ?>">
        <?php $v25556856241incr++; } ?>
    <?php } ?>


</head>
<body>


<?= $this->getContent() ?>

<?php $v25556856241iterator = $scripts; $v25556856241incr = 0; $v25556856241loop = new stdClass(); $v25556856241loop->self = &$v25556856241loop; $v25556856241loop->length = count($v25556856241iterator); $v25556856241loop->index = 1; $v25556856241loop->index0 = 1; $v25556856241loop->revindex = $v25556856241loop->length; $v25556856241loop->revindex0 = $v25556856241loop->length - 1; ?><?php foreach ($v25556856241iterator as $script) { ?><?php $v25556856241loop->first = ($v25556856241incr == 0); $v25556856241loop->index = $v25556856241incr + 1; $v25556856241loop->index0 = $v25556856241incr; $v25556856241loop->revindex = $v25556856241loop->length - $v25556856241incr; $v25556856241loop->revindex0 = $v25556856241loop->length - ($v25556856241incr + 1); $v25556856241loop->last = ($v25556856241incr == ($v25556856241loop->length - 1)); ?>
    <?php if (substr($script, 0, 7) === '<script') { ?>
        <?= $script ?>
    <?php } else { ?>
        <script type="text/javascript" src="<?= $script ?>"></script>
    <?php } ?>
<?php $v25556856241incr++; } ?>

<?php if (isset($scriptsother)) { ?>
    <?php $v25556856241iterator = $scriptsother; $v25556856241incr = 0; $v25556856241loop = new stdClass(); $v25556856241loop->self = &$v25556856241loop; $v25556856241loop->length = count($v25556856241iterator); $v25556856241loop->index = 1; $v25556856241loop->index0 = 1; $v25556856241loop->revindex = $v25556856241loop->length; $v25556856241loop->revindex0 = $v25556856241loop->length - 1; ?><?php foreach ($v25556856241iterator as $script) { ?><?php $v25556856241loop->first = ($v25556856241incr == 0); $v25556856241loop->index = $v25556856241incr + 1; $v25556856241loop->index0 = $v25556856241incr; $v25556856241loop->revindex = $v25556856241loop->length - $v25556856241incr; $v25556856241loop->revindex0 = $v25556856241loop->length - ($v25556856241incr + 1); $v25556856241loop->last = ($v25556856241incr == ($v25556856241loop->length - 1)); ?>
        <?php if (substr($script, 0, 7) === '<script') { ?>
            <?= $script ?>
        <?php } else { ?>
            <script type="text/javascript" src="<?= $script ?>"></script>
        <?php } ?>
    <?php $v25556856241incr++; } ?>
<?php } ?>

<?php if (isset($script_add)) { ?>
    <?php $v25556856241iterator = $script_add; $v25556856241incr = 0; $v25556856241loop = new stdClass(); $v25556856241loop->self = &$v25556856241loop; $v25556856241loop->length = count($v25556856241iterator); $v25556856241loop->index = 1; $v25556856241loop->index0 = 1; $v25556856241loop->revindex = $v25556856241loop->length; $v25556856241loop->revindex0 = $v25556856241loop->length - 1; ?><?php foreach ($v25556856241iterator as $value) { ?><?php $v25556856241loop->first = ($v25556856241incr == 0); $v25556856241loop->index = $v25556856241incr + 1; $v25556856241loop->index0 = $v25556856241incr; $v25556856241loop->revindex = $v25556856241loop->length - $v25556856241incr; $v25556856241loop->revindex0 = $v25556856241loop->length - ($v25556856241incr + 1); $v25556856241loop->last = ($v25556856241incr == ($v25556856241loop->length - 1)); ?>
        <?php if (substr($value, 0, 7) === '<script') { ?>
            <?= $value ?>
        <?php } else { ?>
            <script src="<?= $value ?>"></script>
        <?php } ?>
    <?php $v25556856241incr++; } ?>
<?php } ?>
</body>

</html>