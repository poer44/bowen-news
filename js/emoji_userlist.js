$().ready(function () {
    $('#emojilogin').hide();
    var arr = {news_id: $('#news_id').val(),user_id:$('#user_id').val()};
    $.ajax({
        type: "post",
        data: arr,
        url: "../ajax/emoji_getuserlist.php",
        success: function (data) {
           if(data=='likelock'){
               $('#prelike').val("lock");
               $(".support").find("span").html("您已点赞！("+$('#likecount').val()+")");
           }
           else if(data=='hatelock'){
               $('#prehate').val("lock");
               $(".dislike").find("span").html("您已踩过！("+$('#hatecount').val()+")");
           }
           else if(data=='bothlock'){
               $('#prelike').val("lock");
               $(".support").find("span").html("您已点赞！("+$('#likecount').val()+")");
               $('#prehate').val("lock");
               $(".dislike").find("span").html("您已踩过！("+$('#hatecount').val()+")");
           }
        }
    })
});