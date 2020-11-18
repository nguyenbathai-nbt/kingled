<div class="box box-success def-content">
    <div class="box-header">
        <div>{{ this.flashSession.output() }}</div>
        <div class="pull">
            <form class="form-inline">
                {{ form.renderInlineAll() }}
{#                <button class="btn btn-flat btn-primary" type="submit"><i#}
{#                            class="fa fa-search"></i> {{ helper.translate('Search') }}</button>#}
                {#                <a href="{{ url.get() }}customers/create" class="btn btn-primary"><i class="fa fa-plus"></i> Create customer</a>#}
            </form>
        </div>
    </div>
    <div class="box-body table-responsive">
        {% if status is not null %}
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th> {{ helper.translate('Tên') }}</th>
                        <th> {{ helper.translate('Mã số') }}</th>
                        <th> {{ helper.translate('Thao tác') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {% for item in status %}
                        <tr>
                            <td>{{ loop.index }}</td>
                            <td>{{ item.getName() }}</td>
                            <td>{{ item.getCode() }}</td>
                            <td>
                                <a class="btn btn-primary"
                                   href="{{ url.get() }}admin/status/viewStatus/{{ item.getId() }}"
                                   title="{{ helper.translate('Xem thông tin trạng thái') }}"><i
                                            class="fa fa-file-text"></i>&nbsp;</a>
                                <a class="btn btn-primary"
                                   href="{{ url.get() }}admin/status/editStatus/{{ item.getId() }}"
                                   title="{{ helper.translate('Chỉnh sửa trạng thái') }}"><i
                                            class="glyphicon glyphicon-pencil"></i></a>
                                <a id="deleteCustomer" class="btn btn-danger confirm_dialog"
                                   href="{{ url.get() }}admin/status/deleteStatus/{{ item.getId() }}"
                                   title="{{ helper.translate('Xóa trạng thái') }}"><i
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
        {% if status is not null %}
            {{ paging }}
        {% endif %}
    </div>
</div>