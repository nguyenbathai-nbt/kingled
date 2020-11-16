<div class="box box-success def-content">
    <div class="box-header">
        <div>{{ this.flashSession.output() }}</div>
        <div class="pull">
            <form class="form-inline">
{#                <button class="btn btn-flat btn-primary" type="submit"><i#}
{#                            class="fa fa-search"></i> {{ helper.translate('Search') }}</button>#}
                {#                <a href="{{ url.get() }}customers/create" class="btn btn-primary"><i class="fa fa-plus"></i> Create customer</a>#}
            </form>
        </div>
    </div>
    <div class="box-body table-responsive">
        {% if spam_recipe_cook is not null %}
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th> {{ helper.translate('Tên người dùng') }}</th>
                        <th> {{ helper.translate('Tên công thức') }}</th>
                        <th> {{ helper.translate('Nội dung phản hồi') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {% for item in spam_recipe_cook %}
                        <tr>
                            <td>{{ loop.index }}</td>
                            <td>{{ item.user.getUserName() }}</td>
                            <td>{{ item.recipe.getCode() }}</td>
                            <td>{{ item.getDescription() }}</td>


                        </tr>
                    {% endfor %}
                    </tbody>
                </table>
            </div>
        {% else %}
            <div>Không có dữ liệu</div>
        {% endif %}
    </div>
</div>