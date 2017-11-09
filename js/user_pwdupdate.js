function user_pwdupdate() {
    $.post("ajax/changepwd.php",
        {
            oldpwd: $('#oldpwd').val(),
            newpwd: $('#newpwd').val(),
            uid: $('#uid').val()
        },
        function (data, status) {
            if (status == "success") {
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
                else {
                    $('#tips').removeClass("alert-warning alert-danger");
                    $('#tips').addClass("alert-success");
                    $("#tipstext").html(data);
                    $('#tips').show();
                }
            }
            else {
                $('#tips').removeClass("alert-success alert-warning ");
                $('#tips').addClass("alert-danger");
                $("#tipstext").text("更新失败404");
                $('#tips').show();
            }
        });
}
