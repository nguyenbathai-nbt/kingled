<div class="container-fluid login-container" style="height: 100vh">
    <div class="login-box">
        <div class="login-logo">
            <a href="/admin"><img height="150px" src="/logo.png" alt="logo"/></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign up </p>
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
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <div class="col-xs-4">
                        <a href="/login" class="btn btn-primary btn-block btn-flat"> Back</a>

                    </div>

                    <!-- /.col -->
                </div>
            </form>


        </div>
        <div class="box-footer">

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
</div>
{{ partial('html/scripts') }}
