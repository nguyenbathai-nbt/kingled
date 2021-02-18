<form method="post" action="" >
    <div class="box box-success">
        <div class="box-header">
            <div> {{ this.flashSession.output() }}</div>
            <div class="pull-left">
                <a href="/users" class="btn btn-default"><i class="icon left arrow"></i> {{ helper.translate('Go back') }}</a>
                <input type="submit" class="btn btn-primary" value="{{ helper.translate('Save') }}"/>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    {{ form.renderDecorated('full_name') }}
                    {{ form.renderDecorated('password') }}
                    {{ form.renderDecorated('email') }}
                    {{ form.renderDecorated('phone') }}
                </div>
                <div class="col-md-6">
                    {{ form.renderDecorated('role') }}
                    {{ form.renderDecorated('active') }}
                    {{ form.renderDecorated('banned') }}
                    {{ form.renderDecorated('suspend') }}

                </div>
            </div>
        </div>
        <div class="box-footer">

        </div>
    </div>
</form>