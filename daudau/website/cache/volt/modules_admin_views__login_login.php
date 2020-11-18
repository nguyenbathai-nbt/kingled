<div class="container-fluid login-container-admin" style="height: 100vh">
    <div class="login-box">
        <div class="login-logo logo-edit" >
            <a href="/admin"><img style="height:140px;" src="/logo.png" alt="logo"/></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Đăng nhập</p>
            <?= $this->flashSession->output() ?>
            <form action="" method="post">
                <div class="form-group has-feedback">
                    <?= $form->render('username') ?>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <?= $form->render('password') ?>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <?= $form->render('remember') ?> Remember Me
                            </label>
                        </div>
                    </div>
                    <?= $form->render($form->getCsrfName()) ?>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" style="width: 92px">Đăng nhập</button>
                    </div>

                    <!-- /.col -->
                </div>
            </form>


        </div>
        <div class="box-footer">
            <a href="/forgot" style="float: left;margin-left: 5px;margin-right: 20px">Quên mật khẩu</a>
            <a href="<?= $this->url->get() ?>admin/dang-ky" style="float: left;margin-left: 15px">Đăng ký</a><br>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
</div>

