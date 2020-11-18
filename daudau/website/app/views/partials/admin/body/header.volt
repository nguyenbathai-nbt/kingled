<header class="main-header ">
    <a href="/admin/" class="logo">
        <span class="logo-mini"><b>D</b>D</span>
        <span class="logo-lg"><b>DAUDAU</b></span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/AdminLTE-2.4.10/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        {% set user = session.get('auth-identity') %}
                        <span class="hidden-xs">{{ user['full_name'] }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="/AdminLTE-2.4.10/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            <p>
                                <small>{{ user['full_name'] }} </small>
                            </p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">{{ helper.translate('Thông tin') }}</a>
                            </div>
                            <div class="pull-right">
                                <a href="/admin/dang-xuat"
                                   class="btn btn-default btn-flat">{{ helper.translate('Đăng xuất') }}</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" id="control-sidebar" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>

    </nav>
</header>