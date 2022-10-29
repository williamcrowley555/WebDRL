function storeActivities() {
    var allActivitiesArr = {};
    var activities1Arr = {};
    var activities2Arr = {};
    var activities3Arr = {};

    $.ajax({
        url: urlapi_tieuchicap1_read,
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {
            Authorization: jwtCookie,
        },
        
        success: function(result_data) {
            $.each(result_data, function(index) {

            });
        },

        error: function() {
            console.log("Loi load tieu chi 1");
        }
    });
}

function sumTrainingPointByPermisson(permission) {
    switch (permission) {
        case "SinhVien":
            sumTrainingPoint("");
            break;
        case "CVHT":
            sumTrainingPoint(permission);
            break;
        case "Khoa":
            sumTrainingPoint(permission);
            break;
    }
}

function sumTrainingPoint(permission) {
    $("#tbody_noiDungDanhGia").find("input").each(function() {
        console.log("id = " + this.id);
    });
}