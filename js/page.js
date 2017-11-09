function GetQueryString(name) {//正则表达式获取地址栏参数
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]);
    return null;
}

$(document).ready(function () {
    var i = GetQueryString('p');
    var sp = parseInt(i) + 1;
    $(".pagination li:nth-child(" + sp + ")").addClass("active");
});