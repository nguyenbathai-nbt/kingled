<div class="box box-success def-content">
    <div class="box-header">
        <div>{{ this.flashSession.output() }}</div>
        <div class="pull">
            <form class="form-inline">
                {#                {{ form.renderInlineAll() }}#}
                <button class="btn btn-flat btn-primary" type="submit"><i
                            class="fa fa-search"></i> {{ helper.translate('Search') }}</button>
                {#                <a href="{{ url.get() }}customers/create" class="btn btn-primary"><i class="fa fa-plus"></i> Create customer</a>#}
            </form>
        </div>
    </div>
    <div class="box-body table-responsive">

        <div class="dataTables_wrapper form-inline">
            <table class="table table-condensed table-bordered table-hover dataTable estate_table "
                   style="border-collapse:collapse;">
                <thead>
                <tr role="row" style="color: white;background-color: #5d5a5a">
                    <th>
                        #
                    </th>
                    <th> {{ helper.translate('Username') }}</th>
                    <th> {{ helper.translate('Email') }}</th>
                    <th> {{ helper.translate('User key') }}</th>
                    <th> {{ helper.translate('Role') }}</th>
                    <th> {{ helper.translate('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                {% if list_issuer is not null %}
                    {% for item in list_issuer %}
                        <tr>
                            <td>{{ loop.index }}</td>
                            <td>{{ item.getUsername() }}</td>
                            <td>{{ item.getEmail() }}</td>
                            <td>{{ item.getUserKey() }}</td>
                            <td>{{ item.getRole() }}</td>
                            <td>
                                <a class="btn btn-primary ajax_dialog"
                                   href="{{ url.get() }}issuer/changePassword/{{ item.getId() }}"
                                   title="{{ helper.translate('Change password') }}"><i class="fa fa-key"></i>&nbsp;</a>
                                <a class="btn btn-primary" href="{{ url.get() }}issuer/viewIssuer/{{ item.id }}"
                                   title="{{ helper.translate('View Issuer') }}"><i
                                            class="fa fa-file-text"></i>&nbsp;</a>
{#                                <a class="btn btn-primary" href="{{ url.get() }}customers/edit/{{ item.id }}"#}
{#                                   title="{{ helper.translate('Edit') }}"><i class="glyphicon glyphicon-pencil"></i></a>#}
{#                                <a id="deleteCustomer" class="btn btn-danger confirm_dialog"#}
{#                                   href="{{ url.get() }}customers/delete/{{ item.id }}"#}
{#                                   title="{{ helper.translate('Remove') }}"><i#}
{#                                            class="glyphicon glyphicon-trash"></i></a>#}
                            </td>

                        </tr>
                    {% endfor %}
                {% else %}
                    <tr>
                        <td>Don't have data</td>
                    </tr>
                {% endif %}
                </tbody>
            </table>
        </div>

    </div>
    <div class="box-footer">
        {% if list_issuer is not null %}
            {{ paging }}
        {% endif %}
    </div>
</div>