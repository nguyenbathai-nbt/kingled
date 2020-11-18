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
        {% if bookmark is not null %}
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th> {{ helper.translate('Tên người dùng') }}</th>
                        <th> {{ helper.translate('Công thức') }}</th>
{#                        <th> {{ helper.translate('Action') }}</th>#}
                    </tr>
                    </thead>
                    <tbody>
                    {% for item in bookmark %}
                        <tr>
                            <td>{{ loop.index }}</td>
                            <td>{{ item.user.username }}</td>
                            <td>{{ item.recipe_cook.name }}</td>
{#                            <td>#}
{#                                <a class="btn btn-primary"#}
{#                                   href="{{ url.get() }}admin/bookmark/viewBookmark/{{ item.getId() }}"#}
{#                                   title="{{ helper.translate('View Bookmark') }}"><i class="fa fa-file-text"></i>&nbsp;</a>#}
{#                                <a class="btn btn-primary"#}
{#                                   href="{{ url.get() }}admin/bookmark/editBookmark/{{ item.getId() }}"#}
{#                                   title="{{ helper.translate('Edit Bookmark') }}"><i#}
{#                                            class="glyphicon glyphicon-pencil"></i></a>#}
{#                               #}
{#                            </td>#}
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
        {% if bookmark is not null %}
            {{ paging }}
        {% endif %}
    </div>
</div>