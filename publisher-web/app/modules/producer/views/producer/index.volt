
<div class="box box-success def-content">
    <div class="box-header">
        <div>{{ this.flashSession.output() }}</div>
        <div class="pull">
        </div>
    </div>
    <div class="box-body table-responsive">
        {% if producers is not null %}
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th> {{ helper.translate('Tên chuyền') }}</th>
                        <th> {{ helper.translate('Mã chuyền') }}</th>
                        <th> {{ helper.translate('Thao tác') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {% for item in producers %}
                        <tr>
                            <td>{{ loop.index }}</td>
                            <td>{{ item.getName() }}</td>
                            <td>{{ item.getCode() }}</td>
                            <td>

                                <a class="btn btn-primary"
                                   href="{{ url.get() }}producer/edit/{{ item.getId() }}"
                                   title="{{ helper.translate('Chỉnh sửa tài khoản') }}"><i
                                            class="glyphicon glyphicon-pencil"></i></a>
                                <a id="deleteCustomer" class="btn btn-danger confirm_dialog"
                                   href="{{ url.get() }}producer/delete/{{ item.getId() }}"
                                   title="{{ helper.translate('Xóa tài khoản') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
                            </td>


                        </tr>
                    {% endfor %}
                    </tbody>
                </table>
            </div>
        {% else %}
            <div>Don't have data</div>
        {% endif %}
    </div>
    <div class="box-footer">
        {% if producers  is not null %}
            {{ paging }}
        {% endif %}
    </div>
</div>
