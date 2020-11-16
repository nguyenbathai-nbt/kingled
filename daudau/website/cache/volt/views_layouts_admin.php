<div class="wrapper">

    <?= $this->partial('admin/body/header') ?>
    <!-- Left side column. contains the logo and sidebar -->
    <?= $this->partial('admin/body/sidebar') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?= $this->partial('admin/content/header') ?>

        <!-- Main content -->
        <section class="content" style="padding-top: 0px">
            <?= $this->getContent() ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?= $this->partial('admin/content/footer') ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-gears"></i></a>
            </li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">Language Settings</h3>
                    <?php $language = $this->session->get('language'); ?>
                    <div class="form-group">
                        <label class="control-sidebar-subheading check">
                            English

                            <input type="checkbox" name="language" <?php if ($language == 'en') { ?> <?= 'checked' ?><?php } ?> value="en" class="pull-right" >
                        </label>

                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label class="control-sidebar-subheading check">
                            Vietnamese
                            <input type="checkbox" name="language" <?php if ($language == 'vn') { ?> <?= 'checked' ?> <?php } ?>value="vn" class="pull-right" >
                        </label>
                    </div>
                </form>

            </div>
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    <div id="imodal" class="modal modal-default fade" aria-hidden="true" data-width="750" data-height="550"></div>
</div>

<!-- ./wrapper -->