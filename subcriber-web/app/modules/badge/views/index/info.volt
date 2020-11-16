{% if badge_info is not null %}
    <div class="" style="margin: auto 1%">
        <div class="row" style="margin-top: 20px">
            <div class=" col-md-3 col-xs-3">
                <div class="row">
                    <div class="" style="height: 100px;">
                        <div class="">
                            <div class="col-xs-2 col-md-4" style="height: 100px">
                                <img src="/public/account.png" class="img-circle img-responsive" alt=""
                                     style="text-align: center;"></div>
                            <div class="col-xs-10 col-md-8">
                                <div>
                                    <div class="mic-info">
                                        {% if auth is sameas('true') %}
                                            {% set user = session.get('auth-identity') %}
                                            <h4>{{ user['full_name'] }}</h4>

                                        {% else %}
                                            <h4>Anonymous</h4>
                                        {% endif %}

                                    </div>
                                </div>
                                <div class="comment-text">
                                    {% if auth is sameas('true') %}
                                        <a href="{{ url.get() }}all-badge">Show all badge</a>

                                    {% else %}

                                    {% endif %}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-left: 0px">
                    <h3>OPTIONS</h3>
                    <a href="#" class="printPage">Print Badge</a><br>

                    <script>
                        $('a.printPage').click(function () {
                            window.print();
                            return false;
                        });
                    </script>
                    <a href="javascript:void(0)" id="bchain_data" data-obj='{{ bchain_data }}'>
                        Download Badge
                    </a>
                    <br>
                    <script>
                        $("#bchain_data").click(function () {
                            $("<a />", {
                                "download": "bchain_data.json",
                                "href": "data:application/json," + encodeURIComponent(JSON.stringify($(this).data().obj))
                            }).appendTo("body")
                                .click(function () {
                                    $(this).remove()
                                })[0].click()
                        })
                    </script>
                    <a href="javascript:void(0)" id="request_data" data-obj='{{ request_data }}'>
                        Download Orginal Badge
                    </a>

                    <script>
                        $("#request_data").click(function () {
                            $("<a />", {
                                "download": "request_data.json",
                                "href": "data:application/json," + encodeURIComponent(JSON.stringify($(this).data().obj))
                            }).appendTo("body")
                                .click(function () {
                                    $(this).remove()
                                })[0].click()
                        })
                    </script>


                </div>
                <div class="row" id="verify-on-blockchain" style="margin-top: 15px">
                </div>
                <div style="text-align: center">
                    <div class="row" style="margin-top: 15px">
                        <a id="btn-verify" class="btn btn-primary">VERIFY BLOCKCHAIN</a>
                    </div>
                </div>

                <script></script>
                <script type="text/javascript">
                    $("#btn-verify").click(function () {

                        $("#btn-verify").attr("disabled", true);
                        $.ajax({
                            type: 'Post',
                            url: "{{ url.get() }}badge/verify",
                            data: {
                                id: '{{ bchain_trans_id }}'
                            },
                            dataType: 'json',
                            complete: function (data) {
                                console.log(data.responseJSON);
                                $('#verify-on-blockchain').html("<img src='" + data.responseJSON.urlimage + "'" + "class='img-responsive' style = 'height:57px;float:left ' ><p style='line-height: 50px;height: auto;float: left;margin-left: 10px;font-size: 18px;color: " + data.responseJSON.color + "'>" + data.responseJSON.value + "</p> ");
                                $("#btn-verify").attr("disabled", false);
                            }
                        });
                    })

                </script>
                <div style="margin-top: 30px">
                    <div class="col-md-9 col-xs-10  ">
                        <h4>
                            QR Code
                        </h4>
                        <img src="{{ qrCodeUri }}" style="width: 100%;margin-left: 18%;margin-top: 20px">
                    </div>

                </div>
            </div>
            <div class=" col-md-7 col-xs-7 border-badge-dont-have-margin" style="padding: 0px 0px">

                <div class="row" style="margin-top: 15px">
                    <div class="" style="margin-left: 20px">
                        <div class="col-xs-4 col-md-5" style="margin-right: 0px">
                            <div class="row">
                                <img src="{{ badge_info.getABadgeImageUri() }}" class=" img-responsive" alt=""
                                     style="width: 100%;text-align: center;">
                            </div>
                        </div>

                        <div class="col-xs-8 col-md-7" style="padding:0px 0px   ">
                            <div class="row">
                                <div>
                                    <h1 style="text-align: center">{{ badge_info.getGroupName() }} </h1>
                                </div>
                                <div class="line">

                                </div>
                                <div class="comment-text">
                                    <table class="badge-info" style="margin-top: 15px;margin-left: 20px">
                                        <tr>
                                            <td>Badge name</td>
                                            <td>{{ badge_info.getGroupName() }}</td>
                                        </tr>
                                        <tr>
                                            <td>Issuer from</td>
                                            <td> {{ group_url }}</td>
                                        </tr>
                                        <tr>
                                            <td>Recipient name</td>
                                            <td> {{ badge_info.getRecipientName() }}</td>
                                        </tr>
                                        <tr>
                                            <td>Recipient ID</td>
                                            <td> {{ badge_info.getRecipientId() }}</td>
                                        </tr>
                                        <tr>
                                            <td>Issue Date</td>
                                            <td>{{ helper.util().toTime(badge_info.getIssuedDate()) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Expiry Date</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Criteria</td>
                                            <td>{{ badge_info.getABCriteriaNarrative() }}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class=" col-md-2 col-xs-2" style="padding-left: 15px">
                <div>
                    <h4>Issuer</h4>
                    <a href="#">{{ badge_info.getGroupName() }}</a>
                </div>
                <div style="margin-top: 20px">
                    <a class="btn btn-info" href="{{ group_url }}" style="text-align: center">ISSUER'S WEBSITE</a>
                </div>
            </div>
        </div>
    </div>
{% else %}
    <div class="row" style="margin-top: 15px; height: 300px">
        <h3 style="text-align: center">Data not found. Wait a minute to synchronized to database</h3>
    </div>

{% endif %}
