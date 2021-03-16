<div class="box box-success">
    <div class="box-header">

        <div class="pull">
            <form class="form-inline" id="transcript-form">
                <button id="validateButtonExport1" type="submit" class="btn btn-flat btn-primary">Biểu 1</button>
                <button id="validateButtonExport2" type="submit" class="btn btn-flat btn-primary">&nbsp;Biểu 2</button>
                <button id="validateButtonExport3" type="submit" class="btn btn-flat btn-primary">&nbsp;Biểu 3</button>
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
        $("#validateButtonExport2").on("click", function () {
            validationExport('/learning-outcomes/distance-training-report/export2');
        });
        $("#validateButtonExport3").on("click", function () {
            validationExport('/learning-outcomes/distance-training-report/export3');
        });
        $("#validateButtonExportB4").click(function (e) {
            e.preventDefault();
            $outcome_period_id = $("#outcome_period_id").val();
            $unit_id = $("#unit_id").val();
            if ($unit_id === "") {
                bootbox.alert('Vui lòng chọn đơn vị');
                return;
            }
            if ($outcome_period_id === null || $outcome_period_id == 0) {
                bootbox.alert('Vui lòng chọn đợt xét');

            } else {
                window.location.href = "/learning-outcomes/distance-training-report/export4?outcome_period_id=" + $outcome_period_id + "&unit_id=" + $unit_id;
            }
        });
    });

</script>

