
<form method="post" action="" >
    <div class="box box-success">
        <div class="box-header">
            <div>{{this.flashSession.output()}}</div>

        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {{ form.renderDecorated('name') }}
                    {{ form.renderDecorated('code') }}

                </div>

            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <a href="/admin/role/listRole" class="btn btn-default"><i class="icon left arrow"></i> Trở lại</a>

            </div>
        </div>
    </div>
</form>