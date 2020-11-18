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
                    {{ form.renderDecorated('quantity') }}
                    {{ form.renderDecorated('product_id') }}



                </div>

                <div class="col-md-6">
                    {{ form.renderDecorated('status_id') }}
                    {{ form.renderDecorated('priority') }}
                    {{ form.renderDecorated('description') }}
                    {{ form.renderDecorated('note') }}
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right">
                <a href="{{ url.get() }}issuer" class="btn btn-default"><i class="icon left arrow"></i> Go back</a>
                <input type="submit" class="btn btn-primary" value="Save"/>
            </div>
        </div>
    </div>
</form>
