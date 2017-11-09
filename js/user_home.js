$(function () {
    $('#imgview').hide();
    $('#changepicmeg').hide();
    $('#changecommeg').hide();
});
$('#input-b1').fileinput({
    language: 'zh', //设置语言
    uploadUrl: "ajax/userpic_upload.php", //上传的地址
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['jpg', 'png', 'gif', 'bmp'],
    maxFileSize: 2000,
    maxFileCount: 1,
    showCaption: false,
    autoReplace: true,
    showClose: false,
    browseClass: "btn btn-primary", //按钮样式
    previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
    msgFilesTooMany: "只能上传一张图片！"
});
$("#input-b1").on("fileuploaded", function (event, data, previewId, index) {
    $.each(data.response, function () {
        $('.view').attr("src", this);
        $('#imgsrc').val(this);
    });
    $("#imginput").hide();
    $("#imgview").show();
});

function doUpload() {
    var lock = $('#btnlock').val();
    if (lock == '0') {
        var imgsrc = $('#imgsrc').val();
        var oldimg = $('#oldimg').val();
        if (imgsrc == '0') {
            $('#changepicmeg').removeClass("alert-success");
            $('#changepicmeg').addClass("alert-danger");
            $("#changepicmeg").text("请先上传图片！");
            $('#changepicmeg').show();
        }
        else {
            var arr = {"oldimg": oldimg, "imgsrc": imgsrc};
            $.ajax({
                type: "post",
                url: 'ajax/update_userpic.php',
                data: arr,
                success: function (data) {
                    if (data == 'success') {
                        $('#userlogo').attr('src', imgsrc);
                        $('#userpic').attr('src', imgsrc);
                        $('#changepicmeg').removeClass("alert-danger");
                        $('#changepicmeg').addClass("alert-success");
                        $("#changepicmeg").text("修改成功");
                        $('#changepicmeg').show();
                        $('#btnlock').val("1");
                    }
                }
            });
        }
    }
    else {
    }
}
