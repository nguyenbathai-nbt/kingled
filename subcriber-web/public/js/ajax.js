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
                    //  bindEvent(to);
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

$(document).ready(function () {
        bindEvent('');
    }
);
