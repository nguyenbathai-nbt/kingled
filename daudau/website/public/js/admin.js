$(document).ready(function () {
        bindEvent('');
        //checkbox language
        $('.check input:checkbox').click(function () {
            $('.check input:checkbox').not(this).prop('checked', false);
            var change_language = call.getJson("/change-language", {'language': $(this).val()});
            change_language.then(function (data) {
                location.reload();
            }).done(function () {
            });
        });
        $('#status_id').select2();
        $('body [data-type="select2"]').select2();
        $('li.dropdown').on('click', function (event) {
            if ($(this).hasClass('open')) {
                $(this).removeClass('open');
            } else {
                $(this).addClass('open');
            }
        });
        // $('a.sidebar-toggle').on('click', function () {
        //
        //     if ($('body.sidebar-mini').hasClass('sidebar-collapse')) {
        //         $('body.sidebar-mini').removeClass('sidebar-collapse');
        //     } else {
        //         $('body.sidebar-mini').addClass('sidebar-collapse');
        //     }
        // });
        $('#control-sidebar').on('click', function (event) {
            // event.preventDefault();
            if ($('aside.control-sidebar').hasClass('control-sidebar-open')) {
                $('aside.control-sidebar').removeClass('control-sidebar-open');
            } else {
                $('aside.control-sidebar').addClass('control-sidebar-open');
            }
        });
        $(' a.confirm_dialog').on('click', function (event) {
            event.preventDefault();
            var runevent = $(this);
            var href = $(this).attr('href');
            var question = '';
            if ($(this).attr('id') == 'deleteCustomer') {
                $question = "Are you sure want to deleted? All operators that created by them will also be deleted";
            } else {
                $question = "Are you sure want to deleted? ";
            }
            bootbox.confirm($question, function (result) {
                if (result == true) {
                    runevent.unbind('click');
                    //runevent.trigger('click');
                    location.href = href;
                }
            });
        })

        var call = new Call();

        $("#customer_id").change(function () {
            var customer_call_instance_id = call.getJson("/ec2/instances/loadAjaxInstanceByCustomerId", {'customer_id': $(this).val()});
            customer_call_instance_id.then(function (data) {
                $("#instance_id option").remove();
                data = $.parseJSON(data);
                $("#instance_id").select2({
                    data: data
                });
            }).done(function () {
            });
        });
        $("#instance_id").change(function () {
            var customer_call_instance_id = call.getJson("/ec2/instances/loadAjaxInstancePublicIp", {'pulic_ip': $(this).val()});
            customer_call_instance_id.then(function (data) {
                id = $.parseJSON(data);
                $("#grafanna").html(' <div class="col-sm-2" style="padding-top: 10px">\n' +
                    '            <iframe src="https://grafana.videabiz.com/d-solo/nXqFJ44Zz/node-exporter-full?refresh=60s&orgId=1&var-job=node_exporter&var-name=' + id + '%3A9100&var-node=' + id + '&var-port=9100&theme=light&panelId=20"\n' +
                    '                    width="100%" height="200" frameborder="0"></iframe>\n' +
                    '            <iframe src="https://grafana.videabiz.com/d-solo/nXqFJ44Zz/node-exporter-full?refresh=60s&orgId=1&var-job=node_exporter&var-name=' + id + '%3A9100&var-node=' + id + '&var-port=9100&panelId=14"\n' +
                    '                    width="100%" height="100" frameborder="0"></iframe>\n' +
                    '        </div>\n' +
                    '        <div class="col-sm-2" style="padding-top: 10px">\n' +
                    '            <iframe src="https://grafana.videabiz.com/d-solo/nXqFJ44Zz/node-exporter-full?refresh=60s&orgId=1&var-job=node_exporter&var-name=' + id + '%3A9100&var-node=' + id + '&var-port=9100&theme=light&panelId=16"\n' +
                    '                    width="100%" height="200" frameborder="0"></iframe>\n' +
                    '            <iframe src="https://grafana.videabiz.com/d-solo/nXqFJ44Zz/node-exporter-full?refresh=60s&orgId=1&var-job=node_exporter&var-name=' + id + '%3A9100&var-node=' + id + '&var-port=9100&panelId=75"\n' +
                    '                    width="100%" height="100" frameborder="0"></iframe>\n' +
                    '        </div>\n' +
                    '        <div class="col-sm-2" style="padding-top: 10px">\n' +
                    '            <iframe src="https://grafana.videabiz.com/d-solo/nXqFJ44Zz/node-exporter-full?refresh=60s&orgId=1&var-job=node_exporter&var-name=' + id + '%3A9100&var-node=' + id + '&var-port=9100&theme=light&panelId=154"\n' +
                    '                    width="100%" height="200" frameborder="0"></iframe>\n' +
                    '            <iframe src="https://grafana.videabiz.com/d-solo/nXqFJ44Zz/node-exporter-full?refresh=60s&orgId=1&var-job=node_exporter&var-name=' + id + '%3A9100&var-node=' + id + '&var-port=9100&panelId=23"\n' +
                    '                    width="100%" height="100" frameborder="0"></iframe>\n' +
                    '        </div>');
            }).done(function () {
            });
        });

    }
);

function Call() {
    var self = this;
    self.host = window.location.protocol + '//' + window.location.host;
    self.href = query = window.location.href;

    self.init = function () {
    };
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
            if (message === 'graduate_status') {
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
        var result = [{"id": 1, "text": "A11"}, {"id": 2, "text": "A21"}, {"id": 3, "text": "A31"}, {
            "id": 4,
            "text": "A41"
        }, {"id": 5, "text": "A51"}, {"id": 6, "text": "B11"}, {"id": 7, "text": "B21"}, {
            "id": 8,
            "text": "B31"
        }, {"id": 9, "text": "B41"}, {"id": 10, "text": "B51"}, {"id": 11, "text": "D11"}, {
            "id": 13,
            "text": "D31"
        }, {"id": 14, "text": "C11"}, {"id": 15, "text": "C21"}, {"id": 16, "text": "C31"}, {
            "id": 17,
            "text": "C41"
        }, {"id": 18, "text": "C51"}, {"id": 19, "text": "E11"}, {"id": 20, "text": "E31"}, {
            "id": 21,
            "text": "E51"
        }, {"id": 22, "text": "T\u1ea1o d\u00e1ng c\u00f4ng nghi\u1ec7p 4-2014"}, {"id": 23, "text": "A12"}, {
            "id": 24,
            "text": "A22"
        }, {"id": 25, "text": "A32"}];
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

function addParameter(url, parameterName, parameterValue) {
    atStart = false
    replaceDuplicates = true;
    if (url.indexOf('#') > 0) {
        var cl = url.indexOf('#');
        urlhash = url.substring(url.indexOf('#'), url.length);
    } else {
        urlhash = '';
        cl = url.length;
    }
    sourceUrl = url.substring(0, cl);

    var urlParts = sourceUrl.split("?");
    var newQueryString = "";

    if (urlParts.length > 1) {
        var parameters = urlParts[1].split("&");
        for (var i = 0; (i < parameters.length); i++) {
            var parameterParts = parameters[i].split("=");
            if (!(replaceDuplicates && parameterParts[0] == parameterName)) {
                if (newQueryString == "")
                    newQueryString = "?";
                else
                    newQueryString += "&";
                newQueryString += parameterParts[0] + "=" + (parameterParts[1] ? parameterParts[1] : '');
            }
        }
    }
    if (newQueryString == "")
        newQueryString = "?";

    if (atStart) {
        newQueryString = '?' + parameterName + "=" + parameterValue + (newQueryString.length > 1 ? '&' + newQueryString.substring(1) : '');
    } else {
        if (newQueryString !== "" && newQueryString != '?')
            newQueryString += "&";
        newQueryString += parameterName + "=" + (parameterValue ? parameterValue : '');
    }
    return urlParts[0] + newQueryString + urlhash;
}
;

function mapItemtoObject(item) {
    var type = 'GET';
    //var event = $(this).attr('on');
    var data = item.parent('form').serialize();
    var url = item.attr('data-url');
    if (item.attr('href') != '') {
        url = item.attr('href');
    }

    if (item.attr('on') == 'submit') {
        data = item.serialize();
        url = item.attr('action');
        type = item.attr('method');
    }
    if (item.attr('on') == 'change') {
        url = addParameter(url, item.attr('name'), item.val());
    }
    if (item.attr('type') == 'POST')
        type = 'POST';
    var obj = new ajaxItem(item.attr('to'), url, data, type);

    return obj;
}

function ajaxItem(to, data_url, data, type) {

    this.to = to;
    this.data = data;
    this.type = type;
    this.data_url = data_url;

}

function updateHtml(item, data) {
    $(item.to).html(data);

    bindEvent(item.to);
}

function updateJson(item, json) {

    if (json.type == 'redirect') {
        item.data_url = json.data;
        // alert(item.data_url);
        callAjax(item);
    }

}

function callAjax(item) {

    // var data = item.data_url.ajax = true;

    $.ajax({
        type: item.type,
        url: addParameter(item.data_url, 'ajax', 'true'),
        data: item.data,
    }).done(function (data) {
        //alert("success");
        //alert(data);
        updateHtml(item, data);
        /* try {
         json = JSON.parse(data);
         } catch (exception) {
         json = null;
         }

         // updateHtml(item, data);
         if (json == null) {

         } else {
         updateJson(item, json);
         }*/
        // alert("success");
    }).fail(function () {
        bootbox.alert("Error");
    }).always(function () {
        // bootbox.alert("Complete");
        // alert("complete");
    });
}

function bindEvent(prefix) {

    $(document).ready(function () {
        $(prefix + " .ajax_click").off("click");
        $(prefix + ' .ajax_click').on('click', function (event) {
            event.preventDefault();
            callAjax(mapItemtoObject($(this)));
            ;
        });
        $(prefix + " .ajax_dialog").off("click");
        $(prefix + " .ajax_dialog").on("click", function (evt) {
            evt.preventDefault();
            var url = $(this).attr('href');
            url = addParameter(url, 'ajax', 'true');
            to = $(this).attr('to');
            if (to == null) {
                to = '#imodal';
            }
            var $modal = $(to);
            $('body').modalmanager('loading');

            setTimeout(function () {

                $modal.load(url, '', function () {
                    $modal.modal({backdrop: 'static', keyboard: false});
                    bindEvent(to);
                });
            }, 1000);

        });
        $(prefix + " .ajax_load").off("load");
        $(prefix + " .ajax_load").on("load", function () {

            callAjax(mapItemtoObject($(this)));
        });

        $(prefix + " .ajax_form_search").off("submit");
        $(prefix + " .ajax_form_search").on("submit", function (evt) {
            var form = $(this);
            var to = $(this).attr('to');
            evt.preventDefault();
            var obj = new ajaxItem(to, form.attr('action'), form.serialize(), form.attr('method'));
            callAjax(obj);
        });

        $("body form.ajax_form").formValidation().on('success.form.fv', function () {
            $(prefix + " .ajax_form").off("submit");
            $(prefix + " .ajax_form").on("submit", function (evt) {
                var form = $(this);
                var settings = form.data('settings');
                var to = $(this).attr('to');
                evt.preventDefault();
                var obj = new ajaxItem(to, form.attr('action'), form.serialize(), form.attr('method'));
                callAjax(obj);
            });
        });
    });
}