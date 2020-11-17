<div class="container-fluid login-container" style="height: 100vh">
    <div class="login-box">
        <div class="login-logo">
            <a href="/admin"><img height="150px" src="/logo.png" alt="logo"/></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            {{ this.flashSession.output() }}
            <form action="/login" method="post">
                <div class="form-group has-feedback">
                    {{ form.render('username') }}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    {{ form.render('password') }}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                {{ form.render('remember') }} Remember Me
                            </label>
                        </div>
                    </div>
                    {{ form.render(form.getCsrfName()) }}
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>

                    <!-- /.col -->
                </div>
            </form>


        </div>
        <div class="box-footer">
            <a href="/forgot" style="float: left;">I forgot my password</a>
            <a href="/signup" style="float: left;margin-left: 15px">Sign Up</a><br>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
</div>
{{ partial('html/scripts') }}
