<!-- Info boxes -->
<div class="">
    {% if groups is not null %}
        {% for item in groups %}
            <div class="row boder-badge" style="">
                <div class="col-xs-2 col-md-2">
                    <img src="data:{{ item.badgetemplate.image_type }};base64,{{ item.badgetemplate.image }}" alt=""
                         style="width: 100%;text-align: center"></div>
                <div class="col-xs-10 col-md-8">
                    <div style="">
                        <h3 style="margin: 10px 0px;"><a
                                    href="{{ url.get() }}group/edit/{{ item.getId() }}">
                                {{ item.getGroupName() }}</a>
                        </h3>
                    </div>
                    <div class="comment-text" style="margin-top:20px">
                        Group code: {{ item.getGroupCOde() }}
                    </div>
                    <div class="comment-text" style="margin-top:20px">
                        Description: {{ item.getDescription() }}
                    </div>

                    <div class="action" style="margin-top: 25px;">
                        <a href="{{ url.get() }}group/edit/{{ item.getId() }}" class="btn btn-badge-menu btn-info"
                           title="Edit">
                            Bade Settings
                        </a>
                        <a href="{{ url.get() }}group/getRecipientByGroupId/{{ item.getId() }}"
                           class="btn btn-badge-menu btn-info" title="Approved">
                            Issued List ({{ count_recipient[item.getId()] }})
                        </a>
                        <a href="#" class="btn btn-badge-menu btn-primary" title="Delete">
                            Copy Badge
                        </a>
                        <a href="{{ url.get() }}group/delete/{{ item.getId() }}"
                           class="btn btn-badge-menu btn-danger confirm_dialog" title="Delete">
                            Delete Badge
                        </a>
                    </div>
                </div>
            </div>
        {% endfor %}
    {% else %}
        <div>Don't have data</div>
    {% endif %}

</div>

</div>
