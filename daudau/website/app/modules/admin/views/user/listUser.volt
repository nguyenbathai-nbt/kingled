<div class="box box-success def-content">
    <div class="box-header">
        <div>{{ this.flashSession.output() }}</div>
        <div class="pull">
            <form class="form-inline">
                {#                {{ form.renderInlineAll() }}#}
{#                <button class="btn btn-flat btn-primary" type="submit"><i#}
{#                            class="fa fa-search"></i> {{ helper.translate('Search') }}</button>#}
                {#                <a href="{{ url.get() }}customers/create" class="btn btn-primary"><i class="fa fa-plus"></i> Create customer</a>#}
            </form>
        </div>
    </div>
    <div class="box-body table-responsive">
        {% if user is not null %}
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th> {{ helper.translate('Tên đăng nhập') }}</th>
                        <th> {{ helper.translate('E-mail') }}</th>
                        <th> {{ helper.translate('Số điện thoại') }}</th>
                        <th> {{ helper.translate('Trạng thái') }}</th>
                        <th> {{ helper.translate('Quyền') }}</th>
                        <th> {{ helper.translate('Thao tác') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {% for item in user %}
                        <tr>
                            <td>{{ loop.index }}</td>
                            <td>{{ item.getUsername() }}</td>
                            <td>{{ item.getEmail() }}</td>
                            <td>{{ item.getPhone() }}</td>
                            <td>{{ item.status.getCode() }}</td>
                            <td>{{ item.role.getCode() }}</td>
                            <td>
                                <a class="btn btn-primary"
                                   href="{{ url.get() }}admin/user/viewUser/{{ item.getId() }}"
                                   title="{{ helper.translate('Xem thông tin người dùng') }}"><i class="fa fa-file-text"></i>&nbsp;</a>
                                <a class="btn btn-primary" href="{{ url.get() }}admin/user/editUser/{{ item.getId() }}"
                                   title="{{ helper.translate('Chỉnh sửa người dùng') }}"><i
                                            class="glyphicon glyphicon-pencil"></i></a>
                                <a class="btn btn-danger confirm_dialog"
                                   href="{{ url.get() }}admin/user/deleteUser/{{ item.getId() }}"
                                   title="{{ helper.translate('Xóa người dùng') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </td>

                        </tr>
                    {% endfor %}
                    </tbody>
                </table>
            </div>
        {% else %}
            <div>Không có dữ liệu</div>
        {% endif %}
    </div>
    <div class="box-footer">
        {% if user is not null %}
            {{ paging }}
        {% endif %}
    </div>
</div>