<form method="post" action="" enctype="multipart/form-data">
    <div class="box box-success">
        <div class="box-header">
            <div>{{ this.flashSession.output() }}</div>

        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    {{ form.renderDecorated('name') }}
                    {{ form.renderDecorated('product_id') }}
                    {{ form.renderDecorated('product_name') }}
                    {{ form.renderDecorated('quantity') }}
                    {{ form.renderDecorated('conveyor_id') }}
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
                <a href="{{ url.get() }}issuer" class="btn btn-default"><i class="icon left arrow"></i> Trở về</a>
                <input type="submit" class="btn btn-primary" value="Lưu"/>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#product_id').on('select2:select', function (e) {
                var data = e.params.data;
                var url = "{{ url.get() }}bill/displayNameProductById/" + data.id;
                $.ajax({
                    type: 'Post',
                    url: url,
                    data: {
                        quantity: data.id
                    },
                    dataType: 'json',
                    complete: function (response) {
                        $('#product_name').val(response.responseJSON);

                    }
                });
            });

        });
    </script>
</form>
