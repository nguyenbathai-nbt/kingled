<div class="container-fluid login-container" style="height: 100vh;">
    <div class="login-box">
        <div class="login-logo logo-edit" >
            <a href="/admin"><img style="height:140px;" src="/logo.png" alt="logo"/></a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Đăng nhập để bắt đầu trải nghiệm</p>
            <?= $this->flashSession->output() ?>
            <form action="/dang-nhap" method="post">
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
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" style="width: 92px">Đăng nhập</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="box-footer">
            <a href="/forgot" style="float: left;margin-right: 20px;margin-left: 5px">Quên mật khẩu</a>
            <a href="/dang-ky" style="float: left;margin-left: 15px">Đăng ký</a><br>
        </div>
    </div>
</div>
