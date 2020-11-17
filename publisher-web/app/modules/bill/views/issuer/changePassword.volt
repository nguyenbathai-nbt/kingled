<form method="POST" to="#imodal2" class="ajax_form" action="{{ url.get() }}issuer/changePassword/{{ user_id }}">
    <div class="modal-header" style="padding-bottom: 0px">
        <h3 class="page-header">Change Password</h3>
        <div id="verify-on-blockchain"></div>

    </div>
    <div class="modal-body" >
        {{ form.renderAll() }}
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"
                aria-hidden="true">{{ helper.translate("Close") }}</button>
        <button type="button" id="btn-submit" class="btn btn-primary">{{ helper.translate('Save') }}</button>
    </div>
</form>
<script>
    $("#btn-submit").click(function () {
        $.ajax({
            type: 'Post',
            url: "{{ url.get() }}issuer/loadAjaxChangePassword",
            data: {
                id: {{ user_id }},
                new_password: $('#new_password').val(),
                confirm_password: $('#confirm_password').val()
            },
            dataType: 'json',
            complete: function (data) {
                console.log(data.responseJSON);
                if (data.responseJSON.typeresult == "success") {
                    $('#verify-on-blockchain').html(" <div class=\"alert alert-success\">" + data.responseJSON.messageresult + "</div>");
                }else if(data.responseJSON.typeresult=="error"){
                    $('#verify-on-blockchain').html(" <div class=\"alert alert-error\">" + data.responseJSON.messageresult + "</div>");
                }else if(data.responseJSON.typeresult=="warning")
                {
                    $('#verify-on-blockchain').html(" <div class=\"alert alert-warning\">" + data.responseJSON.messageresult + "</div>");
                }
            }
        });
    })
</script>
