<div class="container-fluid login-container" style="height: 100vh">
    <div class="login-box">
        <div class="login-logo logo-edit" >
            <a ><img style="height:140px;" src="/logo.png" alt="logo"/></a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Đăng ký </p>
            {{ this.flashSession.output() }}
            <form action="/signup" method="post">
                <div class="form-group has-feedback">
                    {{ form.render('username') }}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {{ form.render('password') }}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {{ form.render('re_password') }}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {{ form.render('email') }}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-xs-4">
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng ký</button>
                    </div>
                    <div class="col-xs-4">
                        <a href="/dang-nhap" class="btn btn-primary btn-block btn-flat"> Trở lại</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="box-footer">
        </div>
    </div>
</div>
