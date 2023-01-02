var jwtCookie = getCookie("jwt");
var quyen = getCookie("quyen");
var maSo = getCookie("maSo");

loadAvatarByQuyen();
if(quyen == "cvht")
    showNhapDiemInMenu("#nhapdiem_cvht");
else
    showNhapDiemInMenu("#nhapdiem_sinhvien");

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
    $.ajax({
        url: urlApi + maSo,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function(result_data) {
            //"null"
            if(result_data.anhDaiDien == null) {
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

function isNhapDiemUnlock() {
    var isUnlock = false;
    $.ajax({
        url: urlapi_chucnang_single_read_maChucNang + CHUC_NANG_NHAP_DIEM_HE_4,
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {Authorization: jwtCookie,},
        success: function(result_CN) {
            if(result_CN.kichHoat == 1)
                isUnlock = true;
        },
        error: function (){}
    });
    return isUnlock;
}

function isUnlockForQuyen(quyenLop = null) {
    var isUnlock = false;
    $.ajax({
        url: urlapi_chucnang_quyen_single_details_read + "?maChucNang=" + 
            CHUC_NANG_NHAP_DIEM_HE_4 + "&maQuyen=" + ((quyenLop == null) ? quyen : quyenLop),
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {Authorization: jwtCookie,},
        success: function(result_CN_Quyen) {
            // Nếu là quyền lớp, chỉ mở nhập điểm cho cvht
            if(quyenLop != null)
                if(result_CN_Quyen.maQuyen == quyenLop)
                    isUnlock = true;

            // Mở nhập điểm cho tài khoản có quyền tương ứng 
            if(result_CN_Quyen.maQuyen == quyen)
                isUnlock = true;
        },
        error: function (errorMessage){}
    });
    return isUnlock;
}

function callGetAPI(urlAPI) {
    var list = null;
    $.ajax({
        url: urlAPI,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function(result) {
            list = result;
        },
    });
    return list;
}

function isGetAPISuccess(urlAPI) {
    var isSuccess = false;
    $.ajax({
        url: urlAPI,
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {Authorization: jwtCookie,},
        success: function(result) {
            isSuccess = true;
        },
        error: function (){}
    });
    return isSuccess;
}

function showNhapDiemInMenu(selector) {
    // Kiểm tra chức năng nhập điểm hệ 4 được mở hay không?
    var isUnlock = isNhapDiemUnlock();
    if(!isUnlock) {
        $(selector).hide();
        return;
    }

    // Kiểm tra quyền lớp có được mở cho cố vấn học tập hay không?
    if(quyen == "cvht") {
        isUnlock = isUnlockForQuyen("lop");
        if(isUnlock) {
            $(selector).show();
            return;
        }
    }
    
    //Kiểm tra quyền lớp có được mở cho sinh viên hay không?
    if(quyen == "sinhvien") {
        isUnlock = isUnlockForQuyen("lop");
        if(isUnlock) {
            var result = callGetAPI(urlapi_sinhvien_read_mssv + maSo);
            console.log(result["sinhvien"][0].maLop);
            var isSuccess = isGetAPISuccess(urlapi_lopmonhapdiemhe4_read_maLop + result["sinhvien"][0].maLop);
            console.log(isSuccess);
            if(isSuccess) {
                $(selector).show();
                return;
            }
        }
    }

    // Kiểm tra quyền của tài khoản có được nhập điểm hay không?
    isUnlock = isUnlockForQuyen();
    if(!isUnlock) {
        $(selector).hide();
        return;
    }

    $(selector).show();

}