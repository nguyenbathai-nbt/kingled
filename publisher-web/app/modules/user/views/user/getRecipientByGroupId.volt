<div class="box box-success def-content">
    <div class="box-header">
        <div>{{ this.flashSession.output() }}</div>
        <div class="pull">
            <form class="form-inline">
                <button class="btn btn-flat btn-primary" type="submit"><i
                            class="fa fa-search"></i> {{ helper.translate('Search') }}</button>
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
                    <th> {{ helper.translate('Recipient Name') }}</th>
                    <th> {{ helper.translate('Recipient Mail') }}</th>
                    <th> {{ helper.translate('Badge Code') }}</th>
                    <th> {{ helper.translate('Issued Date') }}</th>
                    <th> {{ helper.translate('Expire Date') }}</th>
                    <th> {{ helper.translate('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                {% if badge is not null %}
                    {% for item in badge %}
                        <tr>
                            <td>{{ loop.index }}</td>
                            <td>{{ item.badgeinfo.recipient_name }}</td>
                            </td>
                            <td>{{ item.badgeinfo.recipient_id }}</td>
                            <td>{{ item.group.group_code }}</td>
                            <td>{{ item.badgeinfo.issued_date }}</td>
                            <td></td>
                            <td>
                                {% if websubscriber is not null %}
                                <a class="btn btn-primary" href="{{ websubscriber }}/badge/info/{{ item.badgeinfo.assertion_id }}" title="View Badge info"><i class="glyphicon glyphicon-eye-open"></i></a>
                                {% else %}
                                    <a class="btn btn-primary" href="#" title="You dont have url web subscriber"><i class="glyphicon glyphicon-eye-open"></i></a>

                                {% endif %}
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
    {#    <div class="box-footer">#}
    {#        {% if badge is not null %}#}
    {#            {{ paging }}#}
    {#        {% endif %}#}
    {#    </div>#}
</div>
