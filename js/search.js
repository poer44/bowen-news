    function search_check() {
        if ($('#search').val() == "") {
            return false;
        }
        else {
            return true;
        }
    }
$('#search').bind('input propertychange', function () {
    var formData = new FormData($("#ss")[0]);
    $.ajax({
        url: 'ajax/news_search.php',
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            var advjson = JSON.parse(data);
            $('#advice').empty();
            $.each(advjson, function (key, val) {
                $('#advice').append('<option value=' + val.title + '>');
            });
        },
        error: function (data) {
        }
    });
});

