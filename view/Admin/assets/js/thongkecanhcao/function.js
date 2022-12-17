var tableThongKeTitle = [
    "STT",
    "Mã số sinh viên",
    "Họ tên sinh viên",
    "Ngày sinh",
    "Lớp",
    "Tốt nghiệp",
    "Số lần xếp loại yếu, kém",
    "Số lần xếp loại yếu, kém liên tiếp",
];

function getCookie(cName) {
    const name = cName + "=";
    const cDecoded = decodeURIComponent(document.cookie); //to be careful
    const cArr = cDecoded.split("; ");
    let res;
    cArr.forEach((val) => {
        if (val.indexOf(name) === 0) res = val.substring(name.length);
    });
    return res;
}

function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}

var jwtCookie = getCookie("jwt");

function ThongBaoLoi(message) {
    Swal.fire({
        icon: "error",
        title: "Lỗi",
        text: message,
        timer: 2000,
        timerProgressBar: true,
        showCloseButton: true,
    });
}

function presentNotification(iconType, titleNotification, textNotifiaction) {
    Swal.fire({
        icon: iconType,
        title: titleNotification,
        text: textNotifiaction,
        timer: 2000,
        timerProgressBar: true,
    });
}

function checkLoiDangNhap(message) {
    if (message.localeCompare("Vui lòng đăng nhập trước!") == 0) {
        deleteAllCookies();
        location.href = "login.php";
    }
}

function thongBaoLoiComboboxKhoa() {
    presentNotification("error", "Lỗi", "Lỗi load combobox khoa!");
}

function thongBaoLoiComboboxLop() {
    presentNotification("error", "Lỗi", "Lỗi load combobox lớp!");
}

function callReadAPI(urlAPI, notification) {
    var returnData = null;
    $.ajax({
        url: urlAPI,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result) {
            returnData = result;
        },
        error: function (errorMessage) {
            notification();
        },
    });
    return returnData;
}

function loadCombobox(urlAPI, selector, thongBaoLoiCombobox) {
    $(selector).empty();
    var htmlData = "";
    if(urlAPI == urlapi_khoa_read)
        htmlData += "<option value='none'> --- Chọn khoa --- </option>";
    else
        htmlData += "<option value='none'> --- Chọn lớp --- </option>";
    var result = callReadAPI(urlAPI, thongBaoLoiCombobox);
    console.log(result);
    if(result == null)
        return;
    console.log(result);
    $.each(result, function(index) {
        for (var i=0;i<result[index].length;i++) {
            if(urlAPI == urlapi_khoa_read)
                htmlData += "<option value='" + result[index][i].maKhoa + "'>" 
                    + result[index][i].tenKhoa + "</option>";
            else
                htmlData += "<option value='" + result[index][i].maLop + "'>" 
                    + result[index][i].maLop + "</option>";
            
        }
    });
    $(selector).append(htmlData);
}