function like() {
    var likecount = parseInt($('#likecount').val()) + 1;
    var news_id = parseInt($('#news_id').val());
    var user = $('#user_id').val();
    if ($('#prelike').val() == "0") {
        var arr = {"like": likecount, "id": news_id, "user": user};
        $.ajax({
            type: "get",
            data: arr,
            url: "ajax/emoji.php",
            success: function (data) {
                if (data == "1") {
                    $('#prelike').val("lock");
                    $(".support").find("span").html("您已点赞！(" + likecount + ")");
                }
                else if (data == "0") {
                    $('#prelike').val("lock");
                    $(".support").find("span").html("您已点赞！(" + likecount + ")");
                }
                else if (data == "login") {
                    $("#emojilogin").show();
                }
            }
        })
    }
}

function hate() {
    var hatecount = parseInt($('#hatecount').val()) + 1;
    var news_id = parseInt($('#news_id').val());
    var user = $('#user_id').val();
    if ($('#prehate').val() == "0") {
        var arr = {"hate": hatecount, "id": news_id, "user": user};
        $.ajax({
            type: "get",
            url: "ajax/emoji.php",
            data: arr,
            success: function (data) {
                if (data == "1") {
                    $('#prehate').val("lock");
                    $(".dislike").find("span").html("您已踩过！(" + hatecount + ")");
                }
                else if (data == "0") {
                    $('#prelike').val("lock");
                    $(".dislike").find("span").html("您已踩过！(" + hatecount + ")");
                }
                else if (data == "login") {
                    $("#emojilogin").show();
                }
            }
        })

    }
}

function commentempty() {
    var com = $('#editor_id').val();
    if (com == "") {
        alert('请输入评论内容');
        return false;
    }
    else {
        return true;
    }
}

function reply(comid) {
    var ruser = 'recev' + comid;
    var obj1 = document.getElementById(ruser);
    var recev_user = $(obj1).val();
    var suser = 'send' + comid;
    var obj2 = document.getElementById(suser);
    var send_user = $(obj2).val();
    var tred = 'red' + comid;
    var obj3 = document.getElementById(tred);
    var red = $(obj3).val();
    red = red.replace(/</g, '&lt;');
    red = red.replace(/>/g, '&gt;');
    var tcomid = 'comid' + comid;
    var obj4 = document.getElementById(tcomid);
    var comid = $(obj4).val();
    $('#replydetails').html("回复：" + recev_user + "<br>");
    $('#recev_user').val(recev_user);
    $('#comid').val(comid);
    $('#red').val(red);
    $('#send_user').val(send_user);
}

$('#replybtn').click(function () {
    var replys = $('#editor_id2').val();
    var send_user = $('#send_user').val();
    var recev_user = $('#recev_user').val();
    var comid = $('#comid').val();
    var red = $('#red').val();
    if (replys == "") {
        alert('请输入回复内容');
    }
    else {
        var news_id = $('#news_id').val();
        var precom = $('#precom').val();
        var arr = {
            news_id: news_id,
            comid: comid,
            recev_user: recev_user,
            send_user: send_user,
            replys: replys,
            red: red,
            precom: precom
        };
        $.ajax({
            data: arr,
            type: "post",
            async: true,
            url: "ajax/reply.php",
            success: function (data) {
                location.reload();
                var h = $(document).height() - $(window).height();
                $(document).scrollTop(h);
            }
        });
    }
})
var editor;
KindEditor.ready(function (K) {
    editor = K.create('#editor_id,#editor_id2', {
        width: "100%",
        designMode: true,
        resizeType: 0,
        pasteType: 1,
        useContextmenu: false,
        allowFileUpload: false,
        allowFileManager: false,
        afterBlur: function () {
            this.sync();
        },
        items: [],
        newlineTag: 'br'
    })
})

$().ready(function () {
    $('#c_btn').hide();
    var slider = new SliderUnlock("#slider", {}, function () {
        success:$('#c_btn').show();
        $('#slider').hide();
    });
    slider.init();
});
