function admin_pwdupdate() {
    if ($('#oldpwd').val() == "") {
        $('#tips').removeClass("alert-success alert-danger");
        $('#tips').addClass("alert-warning");
        $("#tipstext").html("<strong>警告：</strong>请输入原密码");
        $('#tips').show();
    }
    else if ($('#newpwd').val() == "") {
        $('#tips').removeClass("alert-success alert-danger");
        $('#tips').addClass("alert-warning");
        $("#tipstext").html("<strong>警告：</strong>请输入新密码");
        $('#tips').show();
    }
    else if ($('#cnewpwd').val() == "") {
        $('#tips').removeClass("alert-success alert-danger");
        $('#tips').addClass("alert-warning");
        $("#tipstext").html("<strong>警告：</strong>请输入确认密码");
        $('#tips').show();
    }
    else if($('#newpwd').val()!=$('#cnewpwd').val()){
        $('#tips').removeClass("alert-success alert-danger");
        $('#tips').addClass("alert-warning");
        $("#tipstext").html("<strong>警告：</strong>两次密码输入不一致");
        $('#tips').show();
    }
    else {
        var arr = {"oldpwd": $('#oldpwd').val(), "newpwd": $('#newpwd').val(), "admin_id": $('#aid').val()};
        $.ajax({
            type: "post",
            url: "../ajax/admin_changepwd.php",
            data: arr,
            success: function (data) {
                if (data == "pwderror") {
                    $('#tips').removeClass("alert-success alert-warning");
                    $('#tips').addClass("alert-danger");
                    $("#tipstext").html("<strong>错误：</strong>原密码错误");
                    $('#tips').show();
                }
                else if (data == "same") {
                    $('#tips').removeClass("alert-success alert-danger");
                    $('#tips').addClass("alert-warning");
                    $("#tipstext").html("<strong>警告：</strong>新密码与原密码一致，不用更改");
                    $('#tips').show();
                }
                else if (data == "success") {
                    $('#tips').removeClass("alert-warning alert-danger");
                    $('#tips').addClass("alert-success");
                    $("#tipstext").html("<strong>成功：</strong>修改成功");
                    $("input[type='password']").each(function (i, e) {
                        $(e).val("");
                    });
                    $('#cnewpwd').blur();
                    $('#tips').show();
                }
            }
        })
    }
}
