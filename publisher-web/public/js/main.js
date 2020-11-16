onReady(function () {
    var rotation = new Rotation();
    rotation.init();

    var domain = window.location.protocol + '//' + window.location.host;

    $('body form').formValidation();

    $('body').on('change', '#checkAll', function () {
        var list = $("input[name='item[]']");
        var checked_status = this.checked;
        $.each(list, function (i, val) {
            list[i].checked = checked_status;
        });
    });

    $('body').on('click', '#select-items2', function () {
        var $html = $('<thead />').append($("#student-search > thead").clone()).html();
        var list = $("input[name='item[]']");
        var to = $(this).attr('to') ? $(this).attr('to') : "#student-search-result";
        var check = false;
        $.each(list, function (i, val) {
            if (list[i].checked === true) {
                check = true;
                var $id = $(list[i]).val();
                $(list[i]).attr("checked", "checked");
                $html += $('<td />').append($('#row-' + $id).clone()).html();
            }
        });
        if (check) {
            $(to).html($html);
            $('#imodal').modal('hide');
        } else {
            var call = new Call();
            var tour = call.tour('student-search');
            tour.start();
        }
    });

    $('body').on('click', '#select-assign', function () {

        //console.log("vao");
        var $html = $('<thead />').append($("#student-search > thead").clone()).html();
        var list = $("input[name='item[]']");
        var listId = "";
        $.each(list, function (i, val) {
            if (list[i].checked === true) {
                listId += $(list[i]).val() + ',';
            }
        });
        var lstIdNew = listId.substr(0, listId.length - 1);
        var hostname = $(location).attr('hostname');
        var url = $('#url').val();
        var idteacher = $('#idteacher').val();
        //console.log(hostname+url+idteacher);
        var url = "http://" + hostname + url + idteacher + "/?lstId=" + lstIdNew;
        $(location).attr('href', url);
        $('#imodal').modal('hide');
    });

    $('#offlineDate,#dob,#decisionDate,#decisionDate,#enrollmentDate,#admissionDate,#examDate,#houAcceptanceDate,#clmHandoverDate,#toDate,#fromDate,#startDate,#endDate,#finalExamDate,#time,#technicalAcceptanceDate, #date-picker,#startTimeT').datepicker({
        format: 'yyyy-mm-dd'
    }).on('changeDate', function (e) {
        $('form').formValidation('revalidateField', $(this));
    });

    $('#date-time-picker, #dateTimePicker1, #dateTimePicker2').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        sideBySide: true
    });

    $('#start-time-picker').datetimepicker({
        format: "YYYY-MM-DD'T'HH:mm:ss'.000Z",
        sideBySide: true
    });

    var call = new Call();
    call.runSelect2("#clazzId", "/student/class/loadAjax", "Class");
    call.runSelect2("#idClassList", "/student/class/loadAjax", "Class List");
    call.runSelect2("#studentAjax", "/student/student-info/loadAjax", "Student");
    call.runSelect2("#recruitmentAjx", "/enrollment/consulting/searchAjax", "Recruiment's Firstname");
    call.runSelect2("#consultantAjx", "/enrollment/consulting/searchConsultantAjax", "Consultant's Firstname");
    call.runSelect2("#userAjax", "/system-administration/user/loadAjax", "User");
    call.runSelect2("#userGroupAjax", "/system-administration/user-group/loadAjax", "User Group");
    call.runSelect2("#courseSyllabus", "/course/courses/loadAjax", "Course Syllabus");
    call.runSelect2("#courseAjax", "/course/course-evaluation/loadAjax", "Course");
    call.runSelect2("#teacherAjax", "/human-resource/teacher-activity/searchAjax", "Teacher");
    call.runSelect2("#unitAjax", "/academic-affairs/unit/searchAjax", "Unit");
    call.runSelect2("#subjectAjax", "/academic-affairs/subject/searchAjax", "Subject");
    call.runSelect2("#subjectApplyAjax", "/academic-affairs/subject/searchApplyAjax", "Subject Apply");
    call.runSelect2("#staffAjax", "/human-resource/staffs/loadAjax", "Staff");
    call.runSelect2("#staffUserAjax", "/system-administration/user/loadAjax?staff=true&teacher=true", "Staff User");
    call.runSelect2("#majorAjax", "/academic-affairs/major/loadAjaxMajor", "Major");

    //mis***
    $("#user-unit").select2();
    $("#acc-unit").select2();

    $("#aa-unit").select2();
    $("#aa-major").select2();

    $("#aa-curriculum").select2();
    $("#curr-major").select2();
    $("#subj-curriculum").select2();
    $("#subj-unit").select2();
    $("#subj-major").select2();
    $("#usergroup-unit").select2();
    $("#clazz-unit").select2();
    $("#employee-unit").select2();

    $("#clazz-unit").change(function () {
        var APCall = call.getJson("/plan-schedule/academic-period/loadAjax", {'unit': $("#clazz-unit").val()});
        APCall.then(function (data) {
            $("#clazz-academic-period option").remove();
            data = $.parseJSON(data);
            $("#clazz-academic-period").select2({
                data: data
            });
        }).done(function () {
        });
    });

    $("#employee-unit").change(function () {
        var UserCall = call.getJson("/user/admin/loadAjax", {'unit': $("#employee-unit").val()});
        UserCall.then(function (data) {
            $("#employee-user option").remove();
            data = $.parseJSON(data);
            $("#employee-user").select2({
                data: data
            });
        }).done(function () {
        });
    });

    $('#allowed_date, #decision_date').datepicker({
        format: 'yyyy-mm-dd'
    });
    var $clazz_id = $("#clazz_id");
    var $unit_id_for_student_and_clazz = $("#unit_id_for_student_and_clazz");
    var $outcome_period_id = $("#outcome_period_id");
    var $academic_period = $("#academic_period_id");
    var $selectSuject = $("#select_subject");
    var $unit_id = $("#unit_id");
    var $unit = $("#unitS");
    var $unitep = $("#unitId");
    var $unitStd = $("#unitStd");
    var $unitCst = $("#unitCst");
    var $staffStd = $("#staffStd");
    var $major = $("#majorS");
    var $majorTP = $("#majorTP");
    var $majorc = $("#majorC");
    var $clazzC = $("#clazzC");
    var $majorsj = $("#majorSj");
    var $majortp = $("#majorTP");
    var $majorCop = $("#majorCop");
    var $clazz = $("#clazzS");
    var $student = $("#studentS");
    var $subject = $("#subjectS");
    var $subjectTP = $("#subjectTP");
    var $majorEp = $("#majorEP");
    var $subjectsCop = $("#subjectsCop");
    var $classExamPlan = $("#idClassList");
    var $unitTev = $("#unitTev");
    var $staffS = $("#staffS");
    var $studentAjaxs = $("#studentAjaxs");


    $studentAjaxs.select2();
    $staffS.select2();
    $unitTev.select2();
    $unitCst.select2();
    $unit.select2();
    $unitep.select2();
    $unitStd.select2();
    $staffStd.select2();
    $major.select2();
    $majorTP.select2();
    $majorCop.select2();
    $majorc.select2();
    $clazzC.select2();
    $majorsj.select2();
    $majortp.select2();
    $clazz.select2();
    $student.select2();
    $subject.select2();
    $subjectTP.select2();
    $majorEp.select2();
    $classExamPlan.select2();
    $subjectsCop.select2();
    $("#select-data").select2();

    $selectSuject.change(function () {
        $SelectSubjectCall = call.getJson("/academic-affairs/subject/loadAjaxSubject", {'subject_id': $(this).val()});
        $SelectSubjectCall.then(function (data) {
            $("#list_subject ul").empty();
            data = $.parseJSON(data);
            console.log(data);
            var currentTimeStr = 1;
            var listHtmlStr = "";
            $.each(data, function (i, item) {
                listHtmlStr = listHtmlStr +
                        '<li class="transfer-double-list-li transfer-double-list-li-' + currentTimeStr + '">' +
                        '<div class="checkbox-group">' +
                        '<input type="checkbox"  value="' + item.id + '" class="checkbox-normal checkbox-item-' + currentTimeStr + '" id="itemCheckbox_' + item.id + '_' + currentTimeStr + '">' +
                        '<label class="checkbox-name-' + currentTimeStr + '" for="itemCheckbox_' + item.id + '_' + currentTimeStr + '">' + item.text + '</label>' +
                        '</div>' +
                        '</li>'

//                '<li class="transfer-double-selected-list-li  transfer-double-selected-list-li-' + currentTimeStr + ' .clearfix">' +
//                        '<div class="checkbox-group">' +
//                        '<input type="checkbox" value="' + item.id + '" class="checkbox-normal checkbox-selected-item-' + currentTimeStr + '" id="selectedCheckbox_' + i + '_' + currentTimeStr + '">' +
//                        '<label class="checkbox-selected-name-' + currentTimeStr + '" for="selectedCheckbox_' + i + '_' + currentTimeStr + '">' + item.text + '</label>' +
//                        '</div>' +
//                        '</li>'
            });

            $("#list_subject ul").html(listHtmlStr);
        }).done(function () {});
    });

    $clazz_id.change(function () {
        $StudentVersionedCall = call.getJson("/student/student-versioned/loadAjaxStudentversioned", {'clazz_id': $(this).val()});
        $StudentVersionedCall.then(function (data) {
            $("#student option").remove();
            data = $.parseJSON(data);
            $("#student").select2({
                data: data
            });
        }).done(function () {});
    });

    $unit_id.change(function () {
        $OutcomePeriodCall = call.getJson("/academic-affairs/outcome-period/loadAjaxOutcomePeriod", {'unit_id': $(this).val()});
        $OutcomePeriodCall.then(function (data) {
            $("#outcome_period_id option").remove();
            data = $.parseJSON(data);
            $("#outcome_period_id").select2({
                data: data
            });
        }).done(function () {});

        $MajorCall = call.getJson("/academic-affairs/major/loadAjaxMajor", {'unit_id': $(this).val()});
        $MajorCall.then(function (data) {
            $("#major_id option").remove();
            data = $.parseJSON(data);
            $("#major_id").select2({
                data: data
            });
        }).done(function () {});
    });

    $outcome_period_id.change(function () {
        $AcademicPeriodCall = call.getJson("/plan-schedule/academic-period/loadAjaxAcademicPeriod", {'outcome_period_id': $(this).val(), 'unit_id': $("#unit_id").val()});
        $AcademicPeriodCall.then(function (data) {
            $("#academic_period_id option").remove();
            data = $.parseJSON(data);
            $("#academic_period_id").select2({
                data: data
            });
        }).done(function () {});
    });

    $unit_id_for_student_and_clazz.change(function () {
        $UnitStudentAndClazzCall = call.getJson("/plan-schedule/academic-period/loadAjaxAcademicPeriodStudentAndClazz", {'unit_id_for_student_and_clazz': $(this).val()});
        $UnitStudentAndClazzCall.then(function (data) {
            $("#academic_period_id option").remove();
            data = $.parseJSON(data);
            $("#academic_period_id").select2({
                data: data
            });
        }).done(function () {});
    });



    $academic_period.change(function () {
        $clazzCall = call.getJson("/student/clazz/loadAjax", {'academic_period_id': $(this).val()});
        $clazzCall.then(function (data) {
            $("#clazz_id option").remove();
            data = $.parseJSON(data);
            $("#clazz_id").select2({
                data: data
            });
        }).done(function () {});
    });

    $unit.change(function () {
        var dtc = call.getJson("/student/class/loadAjax", {'unit': $(this).val()});
        dtc.then(function (data) {
            $("#clazzS option").remove();
            data = $.parseJSON(data);
            $clazz.select2({
                data: data
            });
        }).done(function () {
        });
    });


    $major.change(function () {
        var majorCall = call.getJson("/student/learning-plan/loadAjax", {'major': $(this).val()});
        majorCall.then(function (data) {
            $("#subjectS option").remove();
            data = $.parseJSON(data);
            $subject.select2({
                data: data
            });
        }).done(function () {
        });
    });
    $majorTP.change(function () {
        var majorCall = call.getJson("/student/learning-plan/loadAjaxSubject", {'major': $(this).val()});
        majorCall.then(function (data) {
            $("#subjectTP option").remove();
            data = $.parseJSON(data);
            $subjectTP.select2({
                data: data
            });
        }).done(function () {
        });
    });

    $clazz.change(function () {
        var studentCall = call.getJson("/student/student-info/loadAjax", {'unit': $unit.val(), 'clazz': $(this).val()});
        studentCall.then(function (data) {
            $("#studentS option").remove();
            data = $.parseJSON(data);
            $student.select2({
                data: data
            });
        }).done(function () {
        });
    });

    $('body [data-type="select2"]').select2();

    /**
     * List of all the available skins
     * 
     * @type Array
     */
    var AdminLTE = $.AdminLTE;
    var my_skins = [
        "skin-blue",
        "skin-black",
        "skin-red",
        "skin-yellow",
        "skin-purple",
        "skin-green",
        "skin-blue-light",
        "skin-black-light",
        "skin-red-light",
        "skin-yellow-light",
        "skin-purple-light",
        "skin-green-light"
    ];
    setup();
    /**
     * Toggles layout classes
     * 
     * @param String cls the layout class to toggle
     * @returns void
     */
    function change_layout(cls) {
        $("body").toggleClass(cls);
        AdminLTE.layout.fixSidebar();
        //Fix the problem with right sidebar and layout boxed
        if (cls == "layout-boxed")
            AdminLTE.controlSidebar._fix($(".control-sidebar-bg"));
        if ($('body').hasClass('fixed') && cls == 'fixed') {
            AdminLTE.pushMenu.expandOnHover();
            AdminLTE.controlSidebar._fixForFixed($('.control-sidebar'));
            AdminLTE.layout.activate();
        }
    }

    /**
     * Replaces the old skin with the new skin
     * @param String cls the new skin class
     * @returns Boolean false to prevent link's default action
     */
    function change_skin(cls) {
        $.each(my_skins, function (i) {
            $("body").removeClass(my_skins[i]);
        });

        $("body").addClass(cls);
        store('skin', cls);
        return false;
    }

    /**
     * Store a new settings in the browser
     * 
     * @param String name Name of the setting
     * @param String val Value of the setting
     * @returns void
     */
    function store(name, val) {
        if (typeof (Storage) !== "undefined") {
            localStorage.setItem(name, val);
        } else {
            alert('Please use a modern browser to properly view this template!');
        }
    }

    /**
     * Get a prestored setting
     * 
     * @param String name Name of of the setting
     * @returns String The value of the setting | null
     */
    function get(name) {
        if (typeof (Storage) !== "undefined") {
            return localStorage.getItem(name);
        } else {
            alert('Please use a modern browser to properly view this template!');
        }
    }

    /**
     * Retrieve default settings and apply them to the template
     * 
     * @returns void
     */
    function setup() {
        var tmp = get('skin');
        if (tmp && $.inArray(tmp, my_skins))
            change_skin(tmp);

        //Add the change skin listener
        $("[data-skin]").on('click', function (e) {
            e.preventDefault();
            var $skin = $(this).data('skin');
            change_skin($skin);
            configAction({skin: $skin});
        });

        //Add the layout manager
        $("[data-layout]").on('click', function () {
            var $layout = $(this).data('layout');
            change_layout($layout);
            configAction({layout: $layout});
        });

        $("[data-controlsidebar]").on('click', function () {
            change_layout($(this).data('controlsidebar'));
            var slide = !AdminLTE.options.controlSidebarOptions.slide;
            AdminLTE.options.controlSidebarOptions.slide = slide;
            if (!slide)
                $('.control-sidebar').removeClass('control-sidebar-open');
        });

        $("[data-sidebarskin='toggle']").on('click', function () {
            var sidebar = $(".control-sidebar");
            if (sidebar.hasClass("control-sidebar-dark")) {
                sidebar.removeClass("control-sidebar-dark")
                sidebar.addClass("control-sidebar-light")
            } else {
                sidebar.removeClass("control-sidebar-light")
                sidebar.addClass("control-sidebar-dark")
            }
        });

        $("[data-enable='expandOnHover']").on('click', function () {
            //$(this).attr('disabled', true);
            AdminLTE.pushMenu.expandOnHover();
            if (!$('body').hasClass('sidebar-collapse'))
                $("[data-layout='sidebar-collapse']").click();
        });

        // Reset options
        if ($('body').hasClass('fixed')) {
            $("[data-layout='fixed']").attr('checked', 'checked');
        }
        if ($('body').hasClass('layout-boxed')) {
            $("[data-layout='layout-boxed']").attr('checked', 'checked');
        }
        if ($('body').hasClass('sidebar-collapse')) {
            $("[data-layout='sidebar-collapse']").attr('checked', 'checked');
        }
    }

    function configAction(data) {
        $.ajax({
            type: "GET",
            url: domain + "/cms/configuration/install",
            data: data
        }).done(function () {
        });
    }

    $("#add_row").on('click', function (e) {
        var row = $("#original").html().toString();
        row = row.replace('<a href="#" class="btn btn-flat btn-primary" id="add_row"><i class="fa fa-plus"></i></a>', '<a href="#" class="btn btn-flat btn-danger" id="remove_row"><i class="fa fa-minus"></i></a>');
        $("#row-plus").append(row);
        e.preventDefault();
    });

    $("#row-plus").on('click', "#remove_row", function (e) {
        var row = $(this).parent().parent();
        row.remove();
        e.preventDefault();
    });

});

function Call() {
    var self = this;
    self.host = window.location.protocol + '//' + window.location.host;
    self.href = query = window.location.href;

    self.init = function () {};
    self.tour = function (form) {
        var tour = new Tour({
            name: 'tour',
            steps: [
                {
                    element: "#" + form + " #checkAll",
                    title: window.translate.choose_checkbox,
                    content: window.translate.please_click_checkbox
                }
            ],
            backdrop: true,
            storage: false,
            template: "<div class='popover tour'>" +
                    "<div class='arrow'></div>" +
                    "<h3 class='popover-title'></h3>" +
                    "<div class='popover-content'></div>" +
                    "<button class='btn btn-primary btn-flat pull-right' data-role='end'>" + window.translate.close + "</button>" +
                    "</div>"
        });
        tour.init();
        return tour;
    };

    self.checkItemStatus = function (form) {
        var formId = "#" + form;
        var list = $(formId + " input[name='item[]']");
        var isCheck = false;
        $.each(list, function (i, val) {
            if (list[i].checked === true)
                isCheck = true;
        });
        return isCheck;
    };

    self.checkRequire = function (elements) {
        var elementRequire = "";
        if (elements) {
            $.each(elements, function (i, val) {
                var element = $("#" + val);
                if (!element.val()) {
                    elementRequire = val;
                    return false;
                }
            });
        }
        return elementRequire;
    };

    self.run = function (action, data, require, formId, method) {
        var url = (action !== "") ? action : $(this).attr("href");
        var form_id = formId ? formId : "form-lists";
        var type = method ? method : "POST";
        var message = self.checkRequire(require);
        if (!self.checkItemStatus(form_id)) {
            var tour = self.tour(form_id);
            tour.start();
        } else if (message) {
            var element = $("#" + message);
            if (message === 'graduate_status')
            {
                var contentRequire = element.attr("data-err") ? element.attr("data-err") : window.translate.please_choose + window.translate.graduate_status;
            } else {
                var contentRequire = element.attr("data-err") ? element.attr("data-err") : window.translate.please_choose + message;
            }

            var tour = self.tour();
            tour.addStep({
                element: element,
                placement: "top",
                smartPlacement: true,
                title: window.translate.next_step,
                content: contentRequire
            });
            tour.goTo(1);
            tour.start();
        } else {
            bootbox.confirm(window.translate.are_you_sure, function (result) {
                if (result) {
                    var form = $("#" + form_id);
                    form.attr('action', url);
                    form.attr("method", type);
                    if (require) {
                        $.each(require, function (i, val) {
                            var element = $("#" + val);
                            var input = $('<input />').attr('type', 'hidden');
                            input.attr('name', val);
                            input.attr('value', element.val());
                            form.append(input);
                        });
                    } else if (data) {
                        $.each(data, function (i, val) {
                            var element = $("#" + val);
                            var input = $('<input />').attr('type', 'hidden');
                            input.attr('name', val);
                            input.attr('value', element.val());
                            form.append(input);
                        });
                    }

                    form.attr('action', url).submit();
                    form.formValidation().on('success.form.fv', function (e) {
                        e.preventDefault();
                        var fv = $(e.target).data('formValidation');
                        fv.defaultSubmit();
                    });
                    form.submit();
                    $('#imodal').modal('hide');
                }
            });
        }
    };
    self.getJson = function (path, data, method) {
        var type = method ? method : "GET";
        var result = [{"id": 1, "text": "A11"}, {"id": 2, "text": "A21"}, {"id": 3, "text": "A31"}, {"id": 4, "text": "A41"}, {"id": 5, "text": "A51"}, {"id": 6, "text": "B11"}, {"id": 7, "text": "B21"}, {"id": 8, "text": "B31"}, {"id": 9, "text": "B41"}, {"id": 10, "text": "B51"}, {"id": 11, "text": "D11"}, {"id": 13, "text": "D31"}, {"id": 14, "text": "C11"}, {"id": 15, "text": "C21"}, {"id": 16, "text": "C31"}, {"id": 17, "text": "C41"}, {"id": 18, "text": "C51"}, {"id": 19, "text": "E11"}, {"id": 20, "text": "E31"}, {"id": 21, "text": "E51"}, {"id": 22, "text": "T\u1ea1o d\u00e1ng c\u00f4ng nghi\u1ec7p 4-2014"}, {"id": 23, "text": "A12"}, {"id": 24, "text": "A22"}, {"id": 25, "text": "A32"}];
        var d = $.Deferred();
        $.ajax({
            type: type,
            url: self.host + path,
            data: data
        }).done(function (data) {
            d.resolve(data);
        }).fail(function () {
        }).always(function () {
        });
        return d.promise();

    };
    self.formatRepo = function (repo) {
        if (repo.loading)
            return repo.text;
        var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.text + "</div>" +
                "</div></div>";
        return markup;
    };

    self.formatRepoSelection = function (repo) {
        return repo.text;
    };

    self.runSelect2 = function (element, path, placeholder, templateResult, templateSelection) {
        $(element).select2({
            allowClear: true,
            placeholder: "Select an " + placeholder,
            ajax: {
                url: self.host + path,
                dataType: 'json',
                data: function (params) {
                    return {
                        key: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            minimumInputLength: 2,
            templateResult: self.formatRepo,
            templateSelection: self.formatRepoSelection

        });
    };

}