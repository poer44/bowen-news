$().ready(function () {
    $('#tips').hide();
    $('#btndiv').hide();
    $('#idinput,#pwdinput，#cpwdinput').bind('input propertychange', function () {
        $('#tips').hide();
    });
    $('#idinput').bind('blur', function () {
        user_check();
    });

    var slider = new SliderUnlock("#slider", {}, function () {
        success:$('#btndiv').show();
    });
    slider.init();
});

function user_check() {
    var id = $('#idinput').val();
    if (id == "") {
        $('#tips').removeClass("alert-danger  alert-success");
        $('#tips').addClass("alert-warning");
        $('#idinputdiv').removeClass("has-success");
        $('#idinputdiv').addClass("has-error");
        $('#tipstext').html("<strong>警告！</strong>请输入用户名！");
        $('#tips').show();
    }
    else {
        $.ajax({
            type: "get",
            url: "ajax/useridcheck.php?q=" + id,
            success: function (data) {
                if (data == "exist") {
                    $('#tips').removeClass("alert-warning  alert-success");
                    $('#tips').addClass("alert-danger");
                    $('#idinputdiv').removeClass("has-success");
                    $('#idinputdiv').addClass("has-error");
                    $('#tipstext').html("<strong>错误！</strong>该用户已存在，换个名字试试吧");
                    $('#tips').show();
                }
                else {
                    $('#idinputdiv').removeClass("has-error");
                    $('#idinputdiv').addClass("has-success");
                }
            }
        })
    }
}

function reg() {
    var id = $('#idinput').val();
    var pwd = $('#pwdinput').val();
    var cpwd = $('#cpwdinput').val();
    if (id == "") {
        $('#tips').removeClass("alert-danger  alert-success");
        $('#tips').addClass("alert-warning");
        $('#idinputdiv').removeClass("has-success");
        $('#idinputdiv').addClass("has-error");
        $('#tipstext').html("<strong>警告！</strong>请输入用户名！");
        $('#tips').show();
    }
    else if (pwd == "") {
        $('#tips').removeClass("alert-danger  alert-success");
        $('#tips').addClass("alert-warning");
        $('#pwdinputdiv').removeClass("has-success");
        $('#pwdinputdiv').addClass("has-error");
        $('#tipstext').html("<strong>警告！</strong>请输入密码！");
        $('#tips').show();
    }
    else if (cpwd == "") {
        $('#tips').removeClass("alert-danger  alert-success");
        $('#tips').addClass("alert-warning");
        $('#cpwdinputdiv').removeClass("has-success");
        $('#cpwdinputdiv').addClass("has-error");
        $('#tipstext').html("<strong>警告！</strong>请输入确认密码！");
        $('#tips').show();
    }
    else if (cpwd != pwd) {
        $('#tips').removeClass("alert-danger  alert-success");
        $('#tips').addClass("alert-warning");
        $('#cpwdinputdiv').removeClass("has-success");
        $('#cpwdinputdiv').addClass("has-error");
        $('#tipstext').html("<strong>警告！</strong>两次密码不一致！请重新输入");
        $('#tips').show();
    }
    else {
        var arr = {id: id, pwd: pwd};
        $.ajax({
            type: "post",
            data: arr,
            url: "ajax/reg.php",
            success: function (data) {
                $('#idinputdiv').removeClass("has-danger");
                $('#pwdinputdiv').removeClass("has-danger");
                $('#cpwdinputdiv').removeClass("has-danger");
                if (data == 'fail') {
                    $('#tips').removeClass("alert-warning  alert-success");
                    $('#tips').addClass("alert-danger");
                    $('#tipstext').html("<strong>错误！</strong>注册失败，请联系管理员！");
                    $('#tips').show();
                }
                else if (data == 'success') {
                    $('#tips').removeClass("alert-warning  alert-danger");
                    $('#tips').addClass("alert-success");
                    $('#tipstext').html("<strong>注册成功！</strong>现在<a onclick='reglogin()'>访问主页</a>吧！");
                    $('#tips').show();
                    $('#btndiv').hide();
                    $('#has').hide();
                }
            }
        })
    }
}
function reglogin() {
    var id = $('#idinput').val();
    var pwd = $('#pwdinput').val();
    var arr = {id: id, pwd: pwd};
    $.ajax({
        type: "post",
        data: arr,
        url: "ajax/login.php",
        success: function (data) {
            if (data == 'success') {
                window.location.href = "index.php";
            }
        }
    })
}