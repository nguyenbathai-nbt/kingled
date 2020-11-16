<header class="main-header ">
    <a href="/admin/" class="logo">
        <span class="logo-mini"><b>B</b>C</span>
        <span class="logo-lg"><b>Badgechain</b></span>
    </a>
    <nav class="navbar navbar-static-top">

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/public/account.png" class="user-image" alt="User Image">
                        {% set user = session.get('auth-identity') %}
                        <span class="hidden-xs">{{ user['full_name'] }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="/public/account.png" class="img-circle" alt="User Image">
                            <p>
                                <small>{{ user['full_name'] }} </small>
                            </p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            {% if user is not defined  %}
                            {% else %}
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">{{ helper.translate('Profile') }}</a>
                                </div>
                                <div class="pull-right">

                                    <a href="/logout"
                                       class="btn btn-default btn-flat">{{ helper.translate('Sign out') }}</a>

                                </div>
                            {% endif %}
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