<form method="post" action="" enctype="multipart/form-data">
    <div class="box box-success">
        <div class="box-header">
            <div>{{ this.flashSession.output() }}</div>

        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    {{ form.renderDecorated('import') }}
                </div>

                <div class="col-md-6">

                </div>

            </div>
        </div>
        <div class="box-footer">
            <div class="pull-left">
{#                <a href="" class="btn btn-default"><i class="icon left arrow"></i> Go back</a>#}
                <input type="submit" class="btn btn-primary" value="Tải lên"/>
            </div>
        </div>
    </div>
</form>

