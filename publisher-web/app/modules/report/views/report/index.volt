<div class="box box-success">
    <div class="box-header">

        <div class="pull">
            <form class="form-inline" id="transcript-form">
                <button id="validateButtonExport1" type="submit" class="btn btn-flat btn-primary">Xuất báo cáo</button>
            </form>
        </div>

    </div>
    <div class="box-body table-responsive">
    </div>
    <div class="box-footer">
    </div>
</div>
<script type="text/javascript">
    $(function () {
        var call = new Call();
        $("#statusAll").click(function (e) {
            e.preventDefault();
            call.run("transcript/changeStatus", [], ["status"]);
        });
        var validationExport = function (url) {
            $("#transcript-form").formValidation('destroy').formValidation({
                framework: 'bootstrap',
                fields: {
                    academic_period_id: {
                        validators: {
                            notEmpty: {
                                message: 'Vui lòng nhập dữ liệu'
                            }
                        }
                    }
                }
            }).on('success.form.fv', function (e) {
                e.preventDefault();
                var $form = $(e.target), fv = $form.data('formValidation');
                fv.disableSubmitButtons(false);
                $form.attr('action', url);
                fv.defaultSubmit();
                fv.resetForm();
                $form.removeAttr('action');
            });
        };

        $("#validateButtonExport1").on("click", function () {
            validationExport('/report/exportReport');
        });
    });

</script>

