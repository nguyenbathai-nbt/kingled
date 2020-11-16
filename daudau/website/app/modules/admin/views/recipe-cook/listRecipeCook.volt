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
        {% if recipe_cook is not null %}
            <div class="dataTables_wrapper form-inline">
                <table class="table table-condensed table-bordered table-hover dataTable estate_table"
                       style="border-collapse:collapse;">
                    <thead>
                    <tr role="row">
                        <th>
                            #
                        </th>
                        <th> {{ helper.translate('Tên') }}</th>
                        <th> {{ helper.translate('Mã') }}</th>
                        <th> {{ helper.translate('Độ khó') }}</th>
                        <th> {{ helper.translate('Lượt thích') }}</th>
                        <th> {{ helper.translate('Lượt xem') }}</th>
                        <th> {{ helper.translate('Thời gian') }}</th>
                        <th> {{ helper.translate('Mô tả') }}</th>
                        <th> {{ helper.translate('Người dùng') }}</th>
                        <th> {{ helper.translate('Trạng thái') }}</th>
                        <th> {{ helper.translate('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    {% for item in recipe_cook %}
                        <tr>
                            <td>{{ loop.index }}</td>
                            <td>{{ item.getName() }}</td>
                            <td>{{ item.getCode() }}</td>
                            <td>{{ item.getLevel() }}</td>
                            <td>{{ item.getBookmarkTotal() }}</td>
                            <td>{{ item.totalSeemRecipe(item.getId()) }}</td>
                            <td>{{ item.getTimeDo() }}</td>
                            <td>{{ item.getDescription() }}</td>
                            <td>{{ item.user.getUserName() }}</td>
                            {% if item.status.getCode() is sameas('enable') %}
                                <td><span class="btn-success" style="padding: 5px;border-radius: 5px;margin-top: 5px;line-height: 30px;font-size: 8px">{{ item.status.getName() }}</span></td>
                            {% elseif item.status.getCode() is sameas('reject') %}
                                <td><span class="btn-danger" style="padding: 5px;border-radius: 5px;margin-top: 5px;line-height: 30px;font-size: 8px">{{ item.status.getName() }}</span></td>
                            {% elseif item.status.getCode() is sameas('disable') %}
                                <td><span class="btn-danger" style="padding: 5px;border-radius: 5px;margin-top: 5px;line-height: 30px;font-size: 8px">{{ item.status.getName() }}</span></td>
                            {% elseif item.status.getCode() is sameas('confirm') %}
                                <td><span class="btn-info" style="padding: 5px;border-radius: 5px;margin-top: 5px;line-height: 30px;font-size: 8px">{{ item.status.getName() }}</span></td>
                            {% elseif item.status.getCode() is sameas('edit') %}
                                <td><span class="btn-warning" style="padding: 5px;border-radius: 5px;margin-top: 5px;line-height: 30px;font-size: 8px">{{ item.status.getName() }}</span></td>
                            {% elseif item.status.getCode() is sameas('old') %}
                                <td></td>
                            {% endif %}
                            <td>
                                <a class="btn btn-primary"
                                   href="{{ url.get() }}admin/recipe-cook/informationRecipeCook/{{ item.getId() }}"
                                   title="{{ helper.translate('Xem thông tin công thức') }}"><i class="fa fa-file-text"></i>&nbsp;</a>
                                <a class="btn btn-info"
                                   href="{{ url.get() }}admin/recipe-cook/editRecipeCook/{{ item.getId() }}"
                                   title="{{ helper.translate('Chỉnh sửa công thức') }}"><i
                                            class="glyphicon glyphicon-pencil"></i></a>
                                <a class="btn btn-info"
                                   href="{{ url.get() }}admin/recipe-cook/spamRecipeCook/{{ item.getId() }}"
                                   title="{{ helper.translate('Xem phản hồi công thức') }}"><i
                                            class="glyphicon glyphicon-th-list"></i></a>
                                <a id="deleteCustomer" class="btn btn-danger confirm_dialog"
                                   href="{{ url.get() }}admin/recipe-cook/deleteRecipeCook/{{ item.getId() }}"
                                   title="{{ helper.translate('Xóa công thức') }}"><i
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
        {% if recipe_cook is not null %}
            {{ paging }}
        {% endif %}
    </div>
</div>