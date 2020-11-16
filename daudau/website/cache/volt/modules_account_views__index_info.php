<style type="text/css">
    .avatar-upload {
        position: relative;
        max-width: 205px;
        margin: 50px auto;
    }

    .avatar-upload .avatar-edit {
        position: absolute;
        right: 12px;
        z-index: 1;
        top: 10px;
    }

    .avatar-upload .avatar-edit input {
        display: none;
    }

    .avatar-upload .avatar-edit input + label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #FFFFFF;
        border: 1px solid #0000002e;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }

    .avatar-upload .avatar-edit input + label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }

    .avatar-upload .avatar-edit input + label:after {
        content: "\f040";
        font-family: 'FontAwesome';
        color: #757575;
        position: absolute;
        top: 8px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }

    .avatar-upload .avatar-preview {
        width: 192px;
        height: 192px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .avatar-upload .avatar-preview > div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }


</style>
<div class="setting-page-container">
    <div class="page-container container">
        <div class="account-sidebar">
            <div class="sidebar-head">
                <div class="avatar-upload">
                    <form id="form-avatar" method="post" action="/tai-khoan/ajaxUploadAvatar" enctype="multipart/form-data">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload" name="imageUpload" accept=".png, .jpg, .jpeg"/>
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url(<?= $user->image->getImageBase() ?>);">
                            </div>
                            <button id="btn-submit-form-avatar" type="submit" class="btn btn-primary btn-submit"
                                    style="margin-top: 15px">Thay đổi
                            </button>
                        </div>
                    </form>
                </div>
                <h3 class="title" style="margin-top: 60px">
                    <a href="/thanh-vien/<?= $user->getUserName() ?>" title="Trang cá nhân" target="_self">
                        <span><?= $user->getUserName() ?></span>
                    </a>
                </h3>
            </div>
            <div class="sidebar-content">
                <ul class="list-unstyled">
                    <li class="active"><a href="/tai-khoan/thong-tin" target="_self"> <span class="glyphicon glyphicon-user"></span> Thông tin tài khoản</a></li>
                    <li><a href="/tai-khoan/cong-thuc" target="_self"> <span class="glyphicon glyphicon-stats"></span>Công thức của tôi</a></li>
                </ul>
            </div>
        </div>
        <div class="page-account-info">
            <div class="account-toolbar">
                <ul>
                    <li class="active"><a target="_self">Thông tin cá nhân</a></li>
                    <li><a href="/tai-khoan/doi-mat-khau" target="_self">Đổi mật khẩu</a></li>
                </ul>
            </div>
            <div class="panel-group" id="my-account-container">
                <div class="account-editor-block" id="thong-tin">
                    <div class="form-row">
                        <div class="form-left"></div>
                        <div class="form-right">
                            <h3 class="block-title">Thông tin tài khoản</h3>
                        </div>
                    </div>
                    <form action="/tai-khoan/thong-tin" method="post" novalidate="novalidate">
                        <div class="form-row">
                            <div class="form-left">
                                <div class="control-label">Tên tài khoản</div>
                            </div>
                            <div class="form-right">
                                <input class="form-control" id="username" name="username" type="text" value="<?= $username ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-left">
                                <div class="control-label">Email</div>
                            </div>
                            <div class="form-right">
                                <input class="form-control" id="email" name="email" type="text" value="<?= $email ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-left">
                                <div class="control-label">Số điện thoại</div>
                            </div>
                            <div class="form-right">
                                <input class="form-control" id="phone" name="phone" type="text" value="<?= $phone ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-left">
                            </div>
                            <div class="form-right">
                                <button type="submit" class="btn btn-primary btn-submit" style="margin-right: 5px;" target="_self">Lưu thay đổi</button>
                                <a onclick="location.reload();" class="btn btn-default btn-cancel" target="_self">Huỷ</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>

<script type="text/javascript" src="/public/js/jquery.js"></script>
<script type="text/javascript">
    function readURL(evt) {
        $('#btn-submit-form-avatar').removeAttr('disabled');
        var files = evt.target.files;
        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                    $('#avatar-login').attr('src', e.target.result);
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
    $(document).ready(function () {
        $('#btn-submit-form-avatar').attr('disabled', 'true');
        document.getElementById('imageUpload').addEventListener('change', readURL, false);


    });
</script>