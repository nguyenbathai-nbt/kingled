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
                    <th> {{ helper.translate('ID') }}</th>
                    <th> {{ helper.translate('Recipient') }}</th>
                    <th> {{ helper.translate('Recipient Mail') }}</th>
                    <th> {{ helper.translate('Badge Code') }}</th>
                    <th> {{ helper.translate('Issued Date') }}</th>
                    <th> {{ helper.translate('Expire Date') }}</th>
                </tr>
                </thead>
                <tbody>
                {% if issued is not null %}
                    {% for item in customer %}
                        <tr>
                            <td>{{ loop.index }}</td>
                            <td>{{ item.org_name }}</td>
                            <td>{{ item.plan.name }}</td>
                            <td>{{ item.email }}</td>
                            <td>{{ item.phone }}</td>
                            <td>
                                <a class="btn btn-primary"
                                   href="{{ url.get() }}customers/users/{{ item.id }}"
                                   title="{{ helper.translate('View Operators') }}"><i class="fa fa-file-text"></i>&nbsp;</a>
                                <a class="btn btn-primary" href="{{ url.get() }}customers/edit/{{ item.id }}"
                                   title="{{ helper.translate('Edit') }}"><i class="glyphicon glyphicon-pencil"></i></a>
                                <a id="deleteCustomer" class="btn btn-danger confirm_dialog"
                                   href="{{ url.get() }}customers/delete/{{ item.id }}"
                                   title="{{ helper.translate('Remove') }}"><i
                                            class="glyphicon glyphicon-trash"></i></a>
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
        {% if issued is not null %}
            {{ paging }}
        {% endif %}
    </div>
</div>