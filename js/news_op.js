$().ready(function () {
    $('#imgview').hide();
})
var editor;
KindEditor.ready(function (K) {
    editor = K.create('#editor_id', {
        resizeType: 0,
        pasteType: 1,
        useContextmenu: false,
        allowFileUpload: false,
        allowFileManager: false,
        allowImageRemote: false,
        newlineTag: 'br',
        afterBlur: function () {
            this.sync();
        },
        items: ['undo', 'redo', '|', 'justifyleft', 'justifycenter', 'justifyright',
            'bold', 'italic', 'underline', 'strikethrough', 'emoticons', '|', 'link', 'unlink', 'fullscreen']
    });
});

function setContent(str) {
    str = str.replace(/<\/?[^>]*>/g, '');          //去除HTML tag
    str.value = str.replace(/[ | ]*\n/g, '\n');    //去除行尾空白
    $("#title").val(str);
}
function addnews() {
    var title = $('#title').val();
    var content = $('#editor_id').val();
    var sortid = $('#sortid').val();
    var imgsrc = $('#imgsrc').val();
    if (title == "") {
        alert('请输入标题');
    }
    else if (content == "") {
        alert('请输入内容');
    }
    else if (imgsrc == 0) {
        alert('请插入图片');
    }
    else {
        var arr = {title: title, content: content, sortid: sortid, imgsrc: imgsrc};
        $.ajax({
            type: "post",
            data: arr,
            url: "../ajax/admin_addnews.php",
            success: function (data) {
                if(data=="success") {
                    alert('添加新闻成功！');
                    javascript:history.go(-1);
                    window.location.reload();
                }
            }
        })
    }
}
function editnews() {
    var id = $('#id').val();
    var title = $('#title').val();
    var content = $('#editor_id').val();
    var sortid = $('#sortid').val();
    var imgsrc = $('#imgsrc').val();
    var oldimgsrc=$('#oldimgsrc').val();
    if (title == "") {
        alert('请输入标题');
    }
    else if (content == "") {
        alert('请输入内容');
    }
    else {
        var arr = {id:id,title: title, content: content, sortid: sortid, imgsrc: imgsrc,oldimgsrc:oldimgsrc};
        $.ajax({

            type: "post",
            data: arr,
            url: "../ajax/admin_editnews.php",
            success: function (data) {
                if(data=="success") {
                    alert('编辑新闻成功！');
                    window.location.href="../manage/admin_newsmanage.php?p=1";
                }
            }
        })
    }
}
$('#input-b1').fileinput({
    language: 'zh', //设置语言
    uploadUrl: "../ajax/admin_addnewspic.php", //上传的地址
    allowedPreviewTypes: ['image'],
    allowedFileExtensions: ['jpg', 'png', 'gif', 'bmp','jpeg'],
    maxFileSize: 2000,
    maxFileCount: 1,
    showCaption: false,
    autoReplace: true,
    showClose:false,
    browseClass: "btn btn-primary", //按钮样式
    previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
    msgFilesTooMany: "只能上传一张图片！"
});
$("#input-b1").on("fileuploaded", function (event, data, previewId, index) {
    $.each(data.response, function () {
        var a="../"+this;
        $('#view').attr("src", a);
        $('#imgsrc').val(this);
    })
    $('#imgview').show();
    $("#imginput").hide();
})