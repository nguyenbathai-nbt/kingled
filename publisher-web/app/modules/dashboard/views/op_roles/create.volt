<form method="post" action="" >
    <div class="box box-success">
        <div class="box-header">
            <div>{{this.flashSession.output()}}</div>
            <div class="pull-left">
                <a href="/roles" class="btn btn-default"><i class="icon left arrow"></i> {{ helper.translate('Go back') }}</a>
                <input type="submit" class="btn btn-primary" value="{{ helper.translate('Save') }}"/>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    {{ form.renderDecorated('name') }}
                    {{ form.renderDecorated('description') }}
                    {{ form.renderDecorated('active') }}
                </div>

            </div>
        </div>
        <div class="box-footer">

        </div>
    </div>
</form>