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
    
    

    <?php foreach ($stylesheets as $stylesheet) { ?>
        <link rel="stylesheet" href="<?= $stylesheet ?>">
    <?php } ?>
    <?php if (isset($stylesheetsother)) { ?>
        <?php foreach ($stylesheetsother as $stylesheet) { ?>
            <link rel="stylesheet" type="text/css" href="<?= $stylesheet ?>">
        <?php } ?>
    <?php } ?>


</head>
<body class="hold-transition <?= $cssClass ?>">

<?= $this->getContent() ?>

<?php foreach ($scripts as $script) { ?>
    <?php if (substr($script, 0, 7) === '<script') { ?>
        <?= $script ?>
    <?php } else { ?>
        <script type="text/javascript" src="<?= $script ?>"></script>
    <?php } ?>
<?php } ?>
<?php if (isset($scriptsother)) { ?>
    <?php foreach ($scriptsother as $script) { ?>
        <?php if (substr($script, 0, 7) === '<script') { ?>
            <?= $script ?>
        <?php } else { ?>
            <script src="<?= $script ?>"></script>
        <?php } ?>
    <?php } ?>
<?php } ?>

<?php if (isset($script_add)) { ?>
    <?php foreach ($script_add as $value) { ?>
        <?php if (substr($value, 0, 7) === '<script') { ?>
            <?= $value ?>
        <?php } else { ?>
            <script src="<?= $value ?>"></script>
        <?php } ?>
    <?php } ?>
<?php } ?>
</body>

</html>