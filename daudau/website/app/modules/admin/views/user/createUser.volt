<form method="post" action="">
    <div class="box box-success">
        <div class="box-header">
            <div>{{ this.flashSession.output() }}</div>

        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    {{ form.renderDecorated('username') }}
                    {{ form.renderDecorated('email') }}
                    {{ form.renderDecorated('phone') }}

                </div>
                <div class="col-md-6">

                    {{ form.renderDecorated('status_id') }}
                    {{ form.renderDecorated('role_id') }}
                </div>

            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">

                <input type="submit" class="btn btn-primary" value="Lưu"/>
                <a href="{{ url.get() }}admin/user/listUser" class="btn btn-default"><i class="icon left arrow"></i> Trở lại</a>
            </div>

        </div>
    </div>
</form>