{% set currentUrl = router.getRewriteUri() %}
<ul class="sidebar-menu" data-widget="tree">
    {% set user = session.get('auth-identity') %}
    {% for keyparent,menu in menus %}
        {% set menuJson =  menu|json_encode %}
        {% set menuActive=false %}
        {% if activemenu is defined %}
            {% for active in activemenu %}
                {% if active is sameas(keyparent) %}
                    {% set menuActive = true %}
                {% endif %}
            {% endfor %}
        {% endif %}
        {% if menu.cssClass is defined %}
            {% if menu.role is defined %}
                {% set checkheader=0 %}
                {% for item in menu.role %}
                    {% if item is sameas(user['role']) %}
                        {% set checkheader = 1 %}
                        {% break %}
                    {% endif %}
                {% endfor %}
                {% if checkheader == 1 %}
                    {% if menu.cssClass == 'header' %}
                        <li class="header">{{ helper.translate(menu.text) }}</li>
                    {% endif %}
                {% endif %}
            {% else %}
                {% if menu.cssClass == 'header' %}
                    <li class="header">{{ helper.translate(menu.text) }}</li>
                {% endif %}
            {% endif %}
        {% else %}

            {% if menu.role is defined %}
                {% set checkmenu = 0 %}
                {% for item in menu.role %}
                    {% if item is sameas(user['role']) %}
                        {% set checkmenu = 1 %}
                        {% break %}
                    {% endif %}
                {% endfor %}
                {% if checkmenu == 1 %}
                    {% if menu.children is defined %}
                        <li class="{{ menuActive ? 'active ' : '' }}{{ (menu.children | length) > 0? 'treeview' : '' }}{{ menuActive ? ' menu-open' : '' }}">
                            <a href="">
                                <i class="{{ menu.iconCss }}"></i>
                                <span>{{ helper.translate(menu.text) }}</span>
                                {% if (menu.children | length) > 0 %}
                                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                                {% endif %}
                            </a>
                            {% if (menu.children | length) > 0 %}
                                <ul class="treeview-menu">
                                    {% for key,submenu in menu.children %}
                                        {#                                <li class="{{ (strpos(currentUrl, submenu.href) !== false ) ? 'active' : '' }}"><a#}
                                        {% set childrenActive=false %}
                                        {#                                    {% if menuActive is true %}#}
                                        {% for active in activemenu %}
                                            {% if active is sameas(key) %}
                                                {% set childrenActive=true %}
                                            {% endif %}
                                        {% endfor %}
                                        {#                                    {% endif %}#}
                                        <li class="{{ childrenActive ? 'active ' : '' }}">
                                            <a
                                                    href="{{ submenu.href }}"><i
                                                        class="{{ submenu.iconCss }}"></i>{{ helper.translate(submenu.text) }}
                                            </a></li>
                                    {% endfor %}
                                </ul>
                            {% endif %}
                        </li>
                    {% else %}
                        <li class="{{ menuActive ? 'active ' : '' }}">
                            <a href="{{ menu.href }}">
                                <i class="{{ menu.iconCss }}"></i>
                                <span>{{ helper.translate(menu.text) }}</span>
                            </a>
                        </li>
                    {% endif %}
                {% endif %}
            {% else %}
                {% if menu.children is defined %}
                    <li class="{{ menuActive ? 'active ' : '' }}{{ (menu.children | length) > 0? 'treeview' : '' }}{{ menuActive ? ' menu-open' : '' }}">
                        <a href="">
                            <i class="{{ menu.iconCss }}"></i>
                            <span>{{ helper.translate(menu.text) }}</span>
                            {% if (menu.children | length) > 0 %}
                                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                            {% endif %}
                        </a>
                        {% if (menu.children | length) > 0 %}
                            <ul class="treeview-menu">
                                {% for key,submenu in menu.children %}
                                    {#                                <li class="{{ (strpos(currentUrl, submenu.href) !== false ) ? 'active' : '' }}"><a#}
                                    {% set childrenActive=false %}
                                    {#                                    {% if menuActive is true %}#}
                                    {% for active in activemenu %}
                                        {% if active is sameas(key) %}
                                            {% set childrenActive=true %}
                                        {% endif %}
                                    {% endfor %}
                                    {#                                    {% endif %}#}
                                    <li class="{{ childrenActive ? 'active ' : '' }}">
                                        <a
                                                href="{{ submenu.href }}"><i
                                                    class="{{ submenu.iconCss }}"></i>{{ helper.translate(submenu.text) }}
                                        </a></li>
                                {% endfor %}
                            </ul>
                        {% endif %}
                    </li>
                {% else %}
                    <li class="{{ menuActive ? 'active ' : '' }}">
                        <a href="{{ menu.href }}">
                            <i class="{{ menu.iconCss }}"></i>
                            <span>{{ helper.translate(menu.text) }}</span>
                        </a>
                    </li>
                {% endif %}
            {% endif %}
        {% endif %}
    {% endfor %}
</ul>
