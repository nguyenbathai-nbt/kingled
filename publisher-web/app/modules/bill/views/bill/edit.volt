<form method="post" action="" enctype="multipart/form-data">
    <div class="box box-success">
        <div class="box-header">
            <div>{{ this.flashSession.output() }}</div>

        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    {{ form.renderDecorated('name') }}
                    {{ form.renderDecorated('code') }}
                    {{ form.renderDecorated('quantity') }}
                    {{ form.renderDecorated('product_id') }}
                    {{ form.renderDecorated('conveyor_id') }}



                </div>

                <div class="col-md-6">
                    {{ form.renderDecorated('status_id') }}
                    {{ form.renderDecorated('priority') }}
                    {{ form.renderDecorated('description') }}
                    {{ form.renderDecorated('note') }}
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <a href="{{ url.get() }}bill" class="btn btn-default"><i class="icon left arrow"></i> Go back</a>
                <input type="submit" class="btn btn-primary" value="Save"/>
            </div>
        </div>
    </div>
</form>

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
                        <th> {{ helper.translate('Bộ phận') }}</th>
                        <th> {{ helper.translate('Thời gian vào') }}</th>
                        <th> {{ helper.translate('Thời gian ra') }}</th>
                        <th> {{ helper.translate('Số lượng TP') }}</th>
                        <th> {{ helper.translate('Xác nhận') }}</th>
                        <th> {{ helper.translate('Thời gian') }}</th>
                        <th> {{ helper.translate('Ghi chú') }}</th>
                        <th> {{ helper.translate('Thao tác') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {% for item in timeintimeout %}
                        <tr>
                            <td>{{ loop.index }}</td>
                            <td>{{ item.major.getName() }}</td>
                            <td>{% if item.getTimeIn() is not null %}{{ item.getTimeIn() }}{% else %}
                                    <a class="btn btn-primary"
                                       href="{{ url.get() }}bill/editTimeIn/{{ item.getId() }}"
                                       title="{{ helper.translate('Cập nhật thời gian') }}"><i
                                                class="glyphicon glyphicon-pencil"></i></a>
                                {% endif %}</td>
                            {% if item.getMajorId() is 1 %}
                                {% if item.getQuantity() is not 0 or item.getQuantity() is not null   %}

                                    <td>{% if item.getTimeOut() is not null %}{{ item.getTimeOut() }}{% else %}
                                            <a class="btn btn-primary"
                                               href="{{ url.get() }}bill/editTimeOut/{{ item.getId() }}"
                                               title="{{ helper.translate('Cập nhật thời gian') }}"><i
                                                        class="glyphicon glyphicon-pencil"></i></a>
                                        {% endif %}
                                    </td>
                                    <td>{{ item.getQuantity() }}</td>
                                {% else %}
                                    <td></td>
                                    <td><input type="text" id="quantity_product"><button id="btn_quantity" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></button></td>
                                {% endif %}
                            {% else %}

                                <td>{% if item.getTimeOut() is not null %}{{ item.getTimeOut() }}{% else %}
                                        <a class="btn btn-primary"
                                           href="{{ url.get() }}bill/editTimeOut/{{ item.getId() }}"
                                           title="{{ helper.translate('Cập nhật thời gian') }}"><i
                                                    class="glyphicon glyphicon-pencil"></i></a>
                                    {% endif %}
                                </td>
                                <td>{{ item.getQuantity() }}</td>
                            {% endif %}

                            <td> {% if item.getUserTimeinId() is not null %}{{ item.user_timein.getUsername() }}{% endif %} |
                                {% if item.getUserTimeoutId() is not null %}{{ item.user_timeout.getUsername() }}{% endif %}</td>
                            <td>{{ helper.changeTimeSecondToMinute(item.getCountTime()) }}</td>
                            <td>{{ item.getDescription() }}</td>
                            <td>
                                <a class="btn btn-primary"
                                   href="{{ url.get() }}bill/edit/{{ item.getId() }}"
                                   title="{{ helper.translate('Chỉnh sửa đơn hàng') }}"><i
                                            class="glyphicon glyphicon-pencil"></i></a>
                                <a id="deleteCustomer" class="btn btn-danger confirm_dialog"
                                   href="{{ url.get() }}bill/delete/{{ item.getId() }}"
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
    <script type="text/javascript" src="/public/js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#btn_quantity').click(function () {
                $.ajax({
                    type: 'Post',
                    url: "{{ url.get() }}bill/updateQuantity/{{ id_time.getId() }}",
                    data: {
                        quantity: $('#quantity_product').val()
                    },
                    dataType: 'json',
                    complete: function () {
                        window.location.reload();
                    }
                });
            });

        });
    </script>
</div>

