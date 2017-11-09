$().ready(function () {
    if ($('#state').val() == "正常") {
        $('#unlock').hide();
        $('#lock').show();
        $("#statediv").css("background-color", "#449d44");
    }
    else if ($('#state').val() == "维护") {
        $('#lock').hide();
        $('#unlock').show();
        $("#statediv").css("background-color", "#c9302c");
    }
})

function lock() {
    $.ajax({
        url: "../ajax/weblock.php",
        success: function (data) {
            if (data == "lock") {
                $('#lock').hide();
                $('#unlock').show();
                $("#statediv").css("background-color", "#c9302c");
                $("#statespan").text("维护");
            }
            else if (data == "unlock") {
                $('#unlock').hide();
                $('#lock').show();
                $("#statediv").css("background-color", "#449d44");
                $("#statespan").text("正常");
            }
        }
    })
}