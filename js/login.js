$().ready(function () {
    $('#tips').hide();
    $('#btndiv').hide();
    $('#idinput,#pwdinput').bind('input propertychange', function () {
        $('#tips').hide();
    });

    var slider = new SliderUnlock("#slider", {}, function () {
        success:$('#btndiv').show();
    });
    slider.init();
})


function GetQueryString(name) {//正则表达式获取地址栏参数
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]);
    return null;
}

function logina() {
    var id = $('#idinput').val();
    var pwd = $('#pwdinput').val();
    if (id == "") {
        $('#tips').removeClass("alert-danger");
        $('#tips').addClass("alert-warning");
        $('#idinputdiv').removeClass("has-success");
        $('#idinputdiv').addClass("has-error");
        $('#tipstext').html("<strong>警告！</strong>请输入用户名！");
        $('#tips').show();
    }
    else if (pwd == "") {
        $('#tips').removeClass("alert-danger");
        $('#tips').addClass("alert-warning");
        $('#pwdinputdiv').removeClass("has-success");
        $('#pwdinputdiv').addClass("has-error");
        $('#tipstext').html("<strong>警告！</strong>请输入密码！");
        $('#tips').show();
    }
    else {
        var arr = {id: id, pwd: pwd};
        $.ajax({
            type: "post",
            data: arr,
            url: "../ajax/admin_login.php",
            success: function (data) {
                if (data == 'pwderror') {
                    $('#tips').removeClass("alert-warning");
                    $('#tips').addClass("alert-danger");
                    $('#pwdinputdiv').removeClass("has-error");
                    $('#pwdinputdiv').removeClass("has-error");
                    $('#tipstext').html("<strong>错误！</strong>用户名或密码输入错误");
                    $('#tips').show();
                }
                else if (data == 'querynull') {
                    $('#tips').removeClass("alert-warning");
                    $('#tips').addClass("alert-danger");
                    $('#pwdinputdiv').removeClass("has-error");
                    $('#pwdinputdiv').removeClass("has-error");
                    $('#tipstext').html("<strong>错误！</strong>用户名或密码输入错误");
                    $('#tips').show();
                }
                else if (data == 'success') {
                    window.location.href = "../manage/admin_home.php";
                }
            }
        })
    }
}

function login() {
    var id = $('#idinput').val();
    var pwd = $('#pwdinput').val();
    if (id == "") {
        $('#tips').removeClass("alert-danger");
        $('#tips').addClass("alert-warning");
        $('#idinputdiv').removeClass("has-success");
        $('#idinputdiv').addClass("has-error");
        $('#tipstext').html("<strong>警告！</strong>请输入用户名！");
        $('#tips').show();
    }
    else if (pwd == "") {
        $('#tips').removeClass("alert-danger");
        $('#tips').addClass("alert-warning");
        $('#pwdinputdiv').removeClass("has-success");
        $('#pwdinputdiv').addClass("has-error");
        $('#tipstext').html("<strong>警告！</strong>请输入密码！");
        $('#tips').show();
    }
    else {
        var arr = {id: id, pwd: pwd};
        $.ajax({
            type: "post",
            data: arr,
            url: "../ajax/login.php",
            success: function (data) {
                if (data == 'pwderror') {
                    $('#tips').removeClass("alert-warning");
                    $('#tips').addClass("alert-danger");
                    $('#pwdinputdiv').removeClass("has-error");
                    $('#pwdinputdiv').removeClass("has-error");
                    $('#tipstext').html("<strong>错误！</strong>用户名或密码输入错误");
                    $('#tips').show();
                }
                else if (data == 'querynull') {
                    $('#tips').removeClass("alert-warning");
                    $('#tips').addClass("alert-danger");
                    $('#pwdinputdiv').removeClass("has-error");
                    $('#pwdinputdiv').removeClass("has-error");
                    $('#tipstext').html("<strong>错误！</strong>用户名或密码输入错误");
                    $('#tips').show();
                }
                else if (data == 'success') {
                    var i = GetQueryString('reg');
                    if (i == null) {
                        window.history.go(-1);
                        window.location.reload();
                    }
                    else if (i == 1) {
                        window.history.go(-2);
                        window.location.reload();
                    }
                    else if (i == 2) {
                        window.location.href = "index.php";
                    }
                }
            }
        })
    }
}