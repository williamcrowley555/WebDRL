var jwtCookie = getCookie("jwt");

loadAvatarByQuyen();

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

function loadAvatarByQuyen() {
    let quyen = getCookie("quyen");
    if(quyen == "sinhvien") {
        loadAvatar(urlapi_sinhvien_single_read, quyen);
    } else if (quyen == "cvht") {
        loadAvatar(urlapi_cvht_single_read, quyen);
    }
}

function loadAvatar(urlApi, quyen) {
    maSo = getCookie("maSo");
    $.ajax({
        url: urlApi + maSo,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function(result_data) {
            if(result_data.anhDaiDien == "null") {
                $("#avatar").attr("src", "../../../user-images/default/user.png");
                return;
            }

            if(quyen == "sinhvien") {
                $("#avatar").attr("src",  '../../../user-images/sinhvien/' + maSo + '/user-avatar/' + result_data.anhDaiDien);
            } else {
                console.log("Chay doi avatar cvht");
                $("#avatar").attr("src",  '../../../user-images/cvht/' + maSo + '/user-avatar/' + result_data.anhDaiDien);
            }
        },
        error: function(errorMessage) {
            Swal.fire({
                icon: "error",
                title: "Lỗi",
                text: errorMessage.responseJSON.message,
                timerProgressBar: true
            });
        },
    });
}