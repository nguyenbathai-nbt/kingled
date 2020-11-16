<div class="">

    {{ partial('body/header') }}
    <!-- Left side column. contains the logo and sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 0px">
        <!-- Content Header (Page header) -->
        {{ partial('content/header') }}

        <!-- Main content -->
        <section class="content" style="padding-top: 0px">
            {{ content() }}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    {{ partial('content/footer') }}

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
                    {% set language = session.get('language') %}
                    <div class="form-group">
                        <label class="control-sidebar-subheading check">
                            English

                            <input type="checkbox" name="language" {% if language is 'en' %} {{ 'checked' }}{% endif %} value="en" class="pull-right" >
                        </label>

                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label class="control-sidebar-subheading check">
                            Vietnamese
                            <input type="checkbox" name="language" {% if language is 'vn' %} {{ 'checked' }} {% endif %}value="vn" class="pull-right" >
                        </label>
                    </div>
                </form>

            </div>
            <div class="tab-pane" id="control-sidebar-settings-tab">

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