<form method="post" action="" enctype="multipart/form-data">
    <div class="box box-success">
        <div class="box-header">
            <div>{{ this.flashSession.output() }}</div>

        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    {{ form.renderDecorated('name') }}
                    {{ form.renderDecorated('code') }}
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">

                <input type="submit" class="btn btn-primary" value="Save"/>
            </div>
        </div>
    </div>
</form>
