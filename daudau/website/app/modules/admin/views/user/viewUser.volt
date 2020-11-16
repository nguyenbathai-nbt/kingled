<form method="post" action="">
    <div class="box box-success">
        <div class="box-header">
            <div>{{ this.flashSession.output() }}</div>

        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    {{ form.renderDecorated('username') }}
                    {{ form.renderDecorated('email') }}
                    {{ form.renderDecorated('phone') }}

                </div>
                <div class="col-md-6">

                    {{ form.renderDecorated('status_id') }}
                    {{ form.renderDecorated('role_id') }}
                </div>

            </div>
        </div>
        {% if user.role.getCode() is sameas('CHEF') %}
        <div class="col-md-12">
            <div class="simple-container ng-scope">
                <div class="form-row">
                    <h4 class="title">Phân loại</h4>
                    <span class="desc text-gray">Đầu bếp chỉ được duyệt những công thức thuộc nhóm những nhóm này</span>
                </div>
                {% for item in list_category_type %}
                    <div class="form-row {{ item.getCode() }}">
                        <h4>{{ item.getName() }}</h4>
                        <input type="hidden" id="{{ item.getCode() }}">
                        <div class="row" style="margin-left: 0px; margin-right: 0px">
                            <recipe-mapping-list mappings="mapping.Courses" class="ng-isolate-scope">
                                <ul class="list-inline">
                                    {% if list_category[item.getName()] is not null %}
                                        {% for item2 in list_category[item.getName()] %}
                                            <li class="col-sm-3 ng-scope" ng-repeat="map in mappings">
                                                {% if item2.getId() in list_id_user_category %}
                                                    <label style="cursor:pointer;color: #7cb342!important"
                                                           class="text-green">

                                                        <input type="checkbox" name="category[]"
                                                               class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"
                                                               value="{{ item2.getId() }}">
                                                        <i class="fa fa-toggle-on " aria-hidden="true"></i>
                                                        <i class="fa fa-toggle-off ng-hide" aria-hidden="true"></i>
                                                        <span class="ng-binding">{{ item2.getName() }}</span>
                                                    </label>
                                                {% else %}
                                                    <label style="cursor:pointer;" class="text-gray">
                                                        <input type="checkbox" name="category[]"
                                                               class="ng-hide ng-pristine ng-untouched ng-valid ng-empty"
                                                               value="{{ item2.getId() }}">
                                                        <i class="fa fa-toggle-on ng-hide"
                                                           aria-hidden="true"></i>
                                                        <i class="fa fa-toggle-off" aria-hidden="true"></i>
                                                        <span class="ng-binding">{{ item2.getName() }}</span>
                                                    </label>
                                                {% endif %}
                                            </li>
                                        {% endfor %}
                                    {% endif %}
                                </ul>
                            </recipe-mapping-list>
                        </div>
                    </div>
                    </br>
                {% endfor %}

            </div>
        </div>
        {% endif %}
        <div class="box-footer">
            <div class="pull-right">
                <a href="{{ url.get() }}admin/user/listUser" class="btn btn-default"><i class="icon left arrow"></i> Trở lại</a>
            </div>

        </div>
    </div>
</form>

