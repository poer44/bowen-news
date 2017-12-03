$(document).ready(function () {
    $("#myAlert").hide();
    var i = GetQueryString('sort');
    if (i == null) {
        $('#s').text("全部");
    }
    else if (i == "1") {
        $('#s').text("头条");
    }
    else if (i == '2') {
        $('#s').text("科技");
    }
    else if (i == '3') {
        $('#s').text("福建");
    }
    else if (i == '4') {
        $('#s').text("国际");
    }
    else if (i == '5') {
        $('#s').text("旅游");
    }
    else if (i == '6') {
        $('#s').text("游戏");
    }
    else if (i == '7') {
        $('#s').text("Banner");
    }
})
//全选
document.getElementById("checkAll").onclick = function () {
    var ids = document.getElementsByName("id[]");
    for (var i in ids) {
        ids[i].checked = true;
    }
    return true;
};
//反选
document.getElementById("checkReverse").onclick = function () {
    var ids = document.getElementsByName("id[]");
    for (var i in ids) {
        ids[i].checked = false;
    }
    return true;
};
//判断选择
function checked() {
    var ids = document.getElementsByName("id[]");
    var lock = 1;
    for (var i in ids) {
        if (ids[i].checked) {
            lock = 0;
        }
    }
    if (lock == 0) {
        var conf=confirm('确定要删除选中的内容吗？');
        if(conf==true){
            return true;
        }
        else{
            return false;
        }
    }
    else {
        $("#myAlert").removeClass("alert-success");
        $("#myAlert").addClass("alert-warning");
        $("#myAlert").html("<strong>警告！</strong>您未选中任何内容。");
        $("#myAlert").show();
        return false;
    }
}
function GetQueryString(name) {//正则表达式获取地址栏参数
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]);
    return null;
}

