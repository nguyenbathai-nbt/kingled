<div class="box box-success def-content">
    <div class="box-header">
        <div>{{ this.flashSession.output() }}</div>
        <div class="pull">
            <form class="form-inline" >
                {{ form.renderInlineAll() }}
                <button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-search"></i> {{ helper.translate('Search') }}</button>
                                <a href="{{ url.get() }}roles/create" class="btn btn-primary"><i class="fa fa-plus"></i> {{ helper.translate('Add new role') }}</a>
            </form>
        </div>
    </div>
    <div class="box-body table-responsive">
        {% if op_users_roles is not null %}
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th>{{ helper.translate('Role name') }}</th>
                        <th>{{ helper.translate('Description') }}</th>
                        <th>{{ helper.translate('Active') }}</th>
                        <th>{{ helper.translate('Action') }}</th>

                    </tr>
                    </thead>
                    <tbody>
                    {% for item in op_users_roles %}
                        <tr>
                            <td>{{ loop.index }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.description }}</td>
                            <td>{{ item.active==1 ? "Yes":"No" }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ url.get() }}roles/edit/{{ item.id }}"
                                   title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                                <a class="btn btn-danger confirm_dialog"
                                   href="{{ url.get() }}roles/delete/{{ item.id }}"
                                   title="Remove"><i class="glyphicon glyphicon-trash"></i></a>
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
        {% if op_users_roles is not null %}
            {{ paging }}
        {% endif %}
    </div>
</div>
