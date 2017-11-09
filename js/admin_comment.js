$().ready(function () {
    $('#alert').hide();
});
$('#s_id').bind('focus', function () {
    $("#s_detail").val("");
    $("#s_detail").attr("disabled", "disabled");
    $('thead').show(800);
    $('tbody').show(800);
});
$('#s_id').bind('blur', function () {
    $("#s_detail").removeAttr("disabled");
});
$('#s_detail').bind('focus', function () {
    $("#s_id").val("");
    $("#s_id").attr("disabled", "disabled");
    $('thead').show(800);
    $('tbody').show(800);
});
$('#s_detail').bind('blur', function () {
    $("#s_id").removeAttr("disabled");
});
$('#s_id').bind('input propertychange', function () {
    var s_id = $('#s_id').val();
    $('.user_id').each(function (i) {
        if ($(this).val().indexOf(s_id) == -1) {
            var t = i + 1;
            var to = "comment_id" + t;
            var obj = document.getElementById(to);
            var find = $(obj).val();
            var g = 'c' + find;
            var obj2 = document.getElementsByClassName(g);
            $(obj2).hide();
        }
        else {
            var t = i + 1;
            var to = "comment_id" + t;
            var obj = document.getElementById(to);
            var find = $(obj).val();
            var g = 'c' + find;
            var obj2 = document.getElementsByClassName(g);
            $(obj2).show();
        }
    })
});
$('#s_detail').bind('input propertychange', function () {
    var s_detail = $('#s_detail').val();
    $('.details').each(function (i) {
        if ($(this).val().indexOf(s_detail) == -1) {
            var t = i + 1;
            var to = "comment_id" + t;
            var obj = document.getElementById(to);
            var find = $(obj).val();
            var g = 'c' + find;
            var obj2 = document.getElementsByClassName(g);
            $(obj2).hide(800);
        }
        else {
            var t = i + 1;
            var to = "comment_id" + t;
            var obj = document.getElementById(to);
            var find = $(obj).val();
            var g = 'c' + find;
            var obj2 = document.getElementsByClassName(g);
            $(obj2).show(800);
        }
    })
});