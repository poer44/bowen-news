$().ready(function () {
    $('#tips').hide();
    $('#oldpwd,#newpwd,#cnewpwd').bind('input propertychange', function () {
        $('#tips').hide();
    });
    $("#pwdbtn").click(function () {
        if (emptycheck() == true) {
            cpwdcheck();
            if (cpwdcheck() == true) {
                try {
                    if (typeof(eval(admin_pwdupdate)) == "function") {
                        admin_pwdupdate();
                        return false;
                    }
                } catch (e) {
                    if (typeof(eval(user_pwdupdate)) == "function") {
                        user_pwdupdate();
                        return false;
                    }
                }
                ;
                return false;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    });
})

function emptycheck() {
    var oldpwd = $('#oldpwd').val();
    var newpwd = $('#newpwd').val();
    var cnewpwd = $('#cnewpwd').val();
    if (oldpwd != "" && newpwd != "" && cnewpwd != "") {
        return true;
    }
    else {
        $('#tips').removeClass("alert-success alert-danger");
        $('#tips').addClass("alert-warning");
        $('#tipstext').html('<strong>警告:</strong>请填写完整');
        $('#tips').show();
        return false;
    }
}

function cpwdcheck() {
    var newpwd = $('#newpwd').val();
    var cnewpwd = $('#cnewpwd').val();
    if (newpwd != cnewpwd) {
        $('#tips').removeClass("alert-success alert-danger");
        $('#tips').addClass("alert-warning");
        $('#tipstext').html('<strong>警告:</strong>确认密码输入不一致');
        $('#tips').show();
        return false;
    }
    else {
        return true;
    }
}

