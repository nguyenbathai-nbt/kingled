<div class="box box-success def-content">
    <div class="box-header">
        <div>{{ this.flashSession.output() }}</div>
        <div class="pull">
            <form class="form-inline">
                {{ form.renderInlineAll() }}
                <button class="btn btn-flat btn-primary" type="submit"><i
                            class="fa fa-search"></i> {{ helper.translate('Search') }}</button>
                {#                <a href="{{ url.get() }}customers/create" class="btn btn-primary"><i class="fa fa-plus"></i> Create customer</a>#}
            </form>
        </div>
    </div>
    <div class="box-body table-responsive">
        {% if op_user is not null %}
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th> {{ helper.translate('Fullname') }}</th>
                        <th> {{ helper.translate('Email') }}</th>
                        <th> {{ helper.translate('Phone') }}</th>
                        <th> {{ helper.translate('Role') }}</th>
                        <th> {{ helper.translate('Active') }}</th>
                        <th> {{ helper.translate('Action') }}</th>

                    </tr>
                    </thead>
                    <tbody>
                    {% for item in op_user %}
                        <tr>
                            <td>{{ loop.index }}</td>
                            <td>{{ item.full_name }}</td>
                            <td>{{ item.email }}</td>
                            <td>{{ item.phone }}</td>
                            <td>{{ item._role.name }}</td>
                            <td>{{ item.active==1 ? "Yes":"No" }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ url.get() }}users/edit/{{ item.id }}"
                                   title="{{ helper.translate('Edit') }}"><i class="glyphicon glyphicon-pencil"></i></a>
                                <a class="btn btn-danger confirm_dialog"
                                   href="{{ url.get() }}users/delete/{{ item.id }}"
                                   title="{{ helper.translate('Remove') }}"><i
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
        {% if op_user is not null %}
            {{ paging }}
        {% endif %}
    </div>
</div>
