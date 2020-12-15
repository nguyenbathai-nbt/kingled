
<div class="box box-success def-content">
    <div class="box-header">
        <div>{{ this.flashSession.output() }}</div>
        <div class="pull">
        </div>
    </div>
    <div class="box-body table-responsive">
        {% if bills is not null %}
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th> {{ helper.translate('Tên HĐ') }}</th>
                        <th> {{ helper.translate('Mã HĐ') }}</th>
                        <th> {{ helper.translate('Mã SP') }}</th>
                        <th> {{ helper.translate('Số lượng') }}</th>
                        <th> {{ helper.translate('Độ ưu tiên') }}</th>
                        <th> {{ helper.translate('Trạng thái') }}</th>
                        <th> {{ helper.translate('Thao tác') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {% for item in bills %}
                        <tr>
                            <td>{{ loop.index }}</td>
                            <td>{{ item.bill.getName() }}</td>
                            <td>{{ item.bill.getCode() }}</td>
                            <td>{{ item.product.getCode() }}</td>
                            <td>{{ item.getQuantity() }}</td>
                            <td>{{ item.bill.getPriority() }}</td>
                            <td>{{ item.bill.status.getName() }}</td>
                            <td>
                                <a class="btn btn-primary"
                                   href="{{ url.get() }}bill/edit/{{ item.getBillId() }}"
                                   title="{{ helper.translate('Chỉnh sửa đơn hàng') }}"><i
                                            class="glyphicon glyphicon-pencil"></i></a>
                                <a id="deleteCustomer" class="btn btn-danger confirm_dialog"
                                   href="{{ url.get() }}bill/delete/{{ item.getBillId() }}"
                                   title="{{ helper.translate('Xóa đơn hàng') }}"><i
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
        {% if bills  is not null %}
            {{ paging }}
        {% endif %}
    </div>
</div>
