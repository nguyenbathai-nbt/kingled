<form method="post" action="" enctype="multipart/form-data">
    <div class="box box-success">
        <div class="box-header">
            <div>{{ this.flashSession.output() }}</div>

        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    {{ form.renderDecorated('username') }}
                    {{ form.renderDecorated('role_id') }}
                    {{ form.renderDecorated('status_id') }}
                </div>

                <div class="col-md-6">

                </div>

            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
{#                <a href="" class="btn btn-default"><i class="icon left arrow"></i> Go back</a>#}
                <input type="submit" class="btn btn-primary" value="Save"/>
            </div>
        </div>
    </div>
</form>
