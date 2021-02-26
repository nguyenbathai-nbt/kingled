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
{#                <a href="" class="btn btn-default"><i class="icon left arrow"></i> Go back</a>#}
                <input type="submit" class="btn btn-primary" value="Save"/>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    function handleFileSelect(evt) {
        var files = evt.target.files;
        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    $('#list').empty();
                    var span = document.createElement('span');
                    span.innerHTML =
                        [
                            '<img style="height: 75px; margin: 5px" src="',
                            e.target.result,
                            '" title="', escape(theFile.name),
                            '"/>'
                        ].join('');

                    document.getElementById('list').insertBefore(span, null);
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
    $(document).ready(function () {


        document.getElementById('import').addEventListener('change', handleFileSelect, false);
    })

</script>
