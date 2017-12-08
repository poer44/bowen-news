function newsview_del(comid,uid) {
    var arr={comment_id:comid,uid:uid};
    $.ajax({
        type:"get",
        url:"ajax/delcomment.php",
        data:arr,
        success:function () {
            var k='c'+comid;
            var obj=document.getElementsByClassName(k);
            $(obj).hide(800);
            $('#hidden').val($('#hidden').val()-1);
            $('#comt').text("评论列表\("+$('#hidden').val()+"\)");
            $('#changecommeg').show();
        }
    })
}
function user_homedel(comid,uid) {
    var arr = {"comment_id": comid,"uid":uid};
    $.ajax({
        type: "get",
        url: "ajax/delcomment.php",
        data: arr,
        success: function (data) {
                var k = 'c' + comid;
                var obj = document.getElementsByClassName(k);
                $('#alert').show();
                $(obj).remove();
        }
    })
}
function admin_del(comid) {
    var url='../ajax/delcomment.php?comment_id='+comid;
    $.get(url, function (data, status) {
        if (status == "success") {
            if(data=="success"){
                var k='c'+comid;
                var obj=document.getElementsByClassName(k);
                $('#alert').show();
                $(obj).hide(800);
                $(obj).remove();
            }
        }
    });
}