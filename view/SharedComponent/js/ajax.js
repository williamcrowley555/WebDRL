function getAjax(urlAPI,successCallBack,errorCallBack) {
    $.ajax({
        url: urlAPI,
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {
            Authorization: jwtCookie,
        },
        success: function(result) {
            successCallBack();
        },
        error: function() {
            errorCallBack();
        },
        complete: function() {
            return;
        }
    });
}