var jwtCookie = getCookie("jwt");
var maSinhVien = getCookie("maSo");

var tableTitle = [
    "STT",
    "Mã số sinh viên",
    "Họ tên sinh viên",
    "Học kỳ",
    "Năm học",
    "Điểm"
];

function redirectPage() {
    // Kiểm tra chức năng nhập điểm hệ 4 được mở hay không?
    var isUnlock = isNhapDiemUnlock();
    if(!isUnlock) {
        window.history.back();
        return;
    }

    // Kiểm tra quyền cố vấn học tập có vào được hay không?
    if(quyen == "cvht") {
        window.history.back();

    }

    // Kiểm tra quyền sinh viên có vào được hay không?
    if(quyen == "sinhvien") {
        isUnlock = isUnlockForSinhVien();
        if(!isUnlock) {
            isUnlock = isUnlockForSinhVien("lop");
            if(!isUnlock) {
                window.history.back();
                return;
            }
        }
    }
}

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

function ThongBaoLoi(message) {
    Swal.fire({
        icon: "error",
        title: "Lỗi",
        text: message,
        timer: 5000,
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

function getSingleReadAPI(urlAPI) {
    // urlapi_sinhvien_single_read
    var returnResult = null;
    $.ajax({
        url: urlAPI,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function(result) {
            returnResult = result;
        },
        error: function() {},
    });
    return returnResult;
}

function loadThongTinSinhVien() {
    var result_sinhvien = getSingleReadAPI(urlapi_sinhvien_single_read + maSinhVien);
    var result_lop = getSingleReadAPI(urlapi_lop_single_read + result_sinhvien.maLop);
    var result_khoa = getSingleReadAPI(urlapi_khoa_single_read + result_lop.maKhoa);
    var result_cvht = getSingleReadAPI(urlapi_covanhoctap_single_read + result_lop.maCoVanHocTap);
    $("#information-card_maSinhVien").text(result_sinhvien.maSinhVien);
    $("#information-card_hoTenSinhVien").text(result_sinhvien.hoTenSinhVien);
    $("#information-card_lop").text(result_sinhvien.maLop);
    $("#information-card_tenKhoa").text(result_khoa.tenKhoa);
    $("#information-card_hoTenCoVan").text(result_cvht.hoTenCoVan);
    $("#information-card_maCoVanHocTap").text("(" + result_cvht.maCoVanHocTap + ")");
}

function isUnlockForSinhVien(quyenLop = null) {
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
            if(quyenLop != null)
                if(result_CN_Quyen.maQuyen == quyenLop)
                    isUnlock = true;
            if(result_CN_Quyen.maQuyen == quyen)
                isUnlock = true;
        },
        error: function (){}
    });
    return isUnlock;
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

function getReadAPI(urlAPI) {
    var returnResult = null;
    $.ajax({
        url: urlAPI,
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {Authorization: jwtCookie,},
        success: function(result) {
            returnResult = result;
        },
        error: function (){}
    });
    return returnResult;
}

function getHtmlDataUnlockGPA(result) {
    var htmlData = "";
    var result_sinhvien = getReadAPI(urlapi_sinhvien_single_read + maSinhVien);
    $.each(result, function(index) {
        for (var p=0;p<result[index].length;p++) {
            htmlData += "<tr>\
                            <td> " + result[index][p].soThuTu + " </td>\
                            <td> " + result_sinhvien.maSinhVien + " </td>\
                            <td> " + result_sinhvien.hoTenSinhVien + " </td>\
                            <td> " + result[index][p].hocKyXet + " </td>\
                            <td> " + result[index][p].namHocXet + " </td>\
                            <td>  </td>\
                            <td>" + 
                                "<button type='button' class='btn btn-success btn_NhapDiem_DiemHe4' data-id='"+ result_sinhvien.maSinhVien + "' style='color: white;'>" +
                                    "Nhập điểm" +
                                "</button>" +
                                "<div class='edit-confirmation' style='display:none'>\
                                    <button class='btn btn-primary btn_XacNhanNhapDiem_DiemHe4' style='color: white;' data-idMSSV = '" + result_sinhvien.maSinhVien + "' data-idMaHKDG='" + result[index][p].maHocKyDanhGia +
                                        "' data-hocKyXet='" + result[index][p].hocKyXet + "' data-namHocXet='" + result[index][p].namHocXet + "'> Xác nhận</button>\
                                    <button class='btn bg-danger btn_HuyChinhSua_DiemHe4 ml-2' style='color: white;' data-idMSSV = '" + result_sinhvien.maSinhVien + "' data-idMaHKDG='" + result[index][p].maHocKyDanhGia + "'>Hủy</button>\
                                </div>"+
                            "</td>\
                        </tr>";
        }
    });
    
    return htmlData;
}

function getHtmlDataUnlockLop() {
    var htmlData = "";
    var result_lop = getReadAPI(urlapi_sinhvien_read_mssv + maSinhVien);
    var result = getReadAPI(urlapi_lopmonhapdiemhe4_read_maLop + result_lop["sinhvien"][0].maLop);
    var result_diemhe4 = getReadAPI(urlapi_diemtrungbinhhe4_read_MaSV + maSinhVien);
    var result_sinhvien = getReadAPI(urlapi_sinhvien_single_read + maSinhVien);
    $.each(result, function(index) {
        for(var i = 0; i<result[index].length ;i++) {
            var maHocKyMoArr = result[index][i].maHocKyMo.split("-");
            var hocKy = maHocKyMoArr[0];
            var namHocTruoc = maHocKyMoArr[1];
            var namHocSau = maHocKyMoArr[2];
            var maHocKyDanhGiaTemp = "HK" + hocKy + namHocTruoc.slice(-2) + namHocSau.slice(-2);
            var isSuaDiem = false;
            console.log("maHocKyDanhGiaTemp = " + maHocKyDanhGiaTemp);
            $.each(result_diemhe4, function(index_diemhe4) {
                for(var j = 0; j<result_diemhe4[index_diemhe4].length ;j++) {
                    if(maHocKyDanhGiaTemp == result_diemhe4[index_diemhe4][j].maHocKyDanhGia) {
                        console.log("Chay if");
                        result[index][i].diem =  result_diemhe4[index_diemhe4][j].diem;
                        result[index][i].hocKyXet = hocKy;
                        result[index][i].namHocXet = namHocTruoc + "-" + namHocSau;
                        result[index][i].hanhDong = "suaDiem";
                        result[index][i].hoTenSinhVien = result_sinhvien.hoTenSinhVien;
                        result[index][i].maSinhVien = result_sinhvien.maSinhVien;
                        result[index][i].maHocKyDanhGia = maHocKyDanhGiaTemp;
                        isSuaDiem = true;
                    }
                }
            });
            if(!isSuaDiem) {
                result[index][i].hocKyXet = hocKy;
                result[index][i].namHocXet = namHocTruoc + "-" + namHocSau;
                result[index][i].hanhDong = "chamDiem";
                result[index][i].hoTenSinhVien = result_sinhvien.hoTenSinhVien;
                result[index][i].maSinhVien = result_sinhvien.maSinhVien;
                result[index][i].maHocKyDanhGia = maHocKyDanhGiaTemp;
            }
        }
    });
    
    $.each(result, function(index) {
        for (var p=0;p<result[index].length;p++) {
            console.log(result[index][p].hanhDong);
            htmlData += "<tr>\
                            <td> " + result[index][p].soThuTu + " </td>\
                            <td> " + result[index][p].maSinhVien + " </td>\
                            <td> " + result[index][p].hoTenSinhVien + " </td>\
                            <td> " + result[index][p].hocKyXet + " </td>\
                            <td> " + result[index][p].namHocXet + " </td>";    
            if(result[index][p].hanhDong == "chamDiem")
                htmlData += "<td> </td>" +
                            "<td>" + 
                                "<button type='button' class='btn btn-success btn_NhapDiem_DiemHe4' data-id='"+ result[index][p].maSinhVien + "' style='color: white;'>" +
                                    "Nhập điểm" +
                                "</button>" +
                                "<div class='edit-confirmation' style='display:none'>\
                                    <button class='btn btn-primary btn_XacNhanNhapDiem_DiemHe4' style='color: white;' data-idMSSV = '" + result[index][p].maSinhVien + "' data-idMaHKDG='" + result[index][p].maHocKyDanhGia +
                                        "' data-hocKyXet='" + result[index][p].hocKyXet + "' data-namHocXet='" + result[index][p].namHocXet + "'>Xác nhận</button>\
                                    <button class='btn bg-danger btn_HuyChinhSua_DiemHe4 ml-2' style='color: white;' data-idMSSV = '" + result[index][p].maSinhVien + "' data-idMaHKDG='" + result[index][p].maHocKyDanhGia + "'>Hủy</button>\
                                </div>"+
                            "</td>";
                
            if(result[index][p].hanhDong == "suaDiem")
                htmlData += "<td>" + result[index][p].diem + "</td>" +
                            "<td>" + 
                                "<button type='button' class='btn btn-warning btn_ChinhSua_DiemHe4' data-id='"+ result[index][p].maSinhVien + "' style='color: white;'>" +
                                    "Chỉnh sửa" +
                                "</button>" +
                                "<div class='edit-confirmation' style='display:none'>\
                                    <button class='btn btn-primary btn_XacNhanChinhSua_DiemHe4' style='color: white;' data-idMSSV = '" + result[index][p].maSinhVien + "' data-idMaHKDG='" + result[index][p].maHocKyDanhGia +
                                    "' data-hocKyXet='" + result[index][p].hocKyXet + "' data-namHocXet='" + result[index][p].namHocXet + "'> Xác nhận</button>\
                                    <button class='btn bg-danger btn_HuyChinhSua_DiemHe4 ml-2' style='color: white;' data-idMSSV = '" + result[index][p].maSinhVien + "' data-idMaHKDG='" + result[index][p].maHocKyDanhGia + "'>Hủy</button>\
                                </div>"+
                            "</td>";
            htmlData += "</tr>";
        }
    });
    return htmlData;
}

function getHtmlDataGPA(result_GPA_unlock, result_GPA) {
    var htmlData = "";
    var result_sinhvien = getReadAPI(urlapi_sinhvien_single_read + maSinhVien);
    // Kiểm tra điểm của sinh viên có được mở hay không. Nếu không mở -> xem điểm. Nếu mở -> sửa điểm.
    console.log("--- 2 ---");
    console.log(result_GPA);
    $.each(result_GPA, function(index_GPA) {
        for (var p_GPA=0;p_GPA<result_GPA[index_GPA].length;p_GPA++) {
            var isInGPA = false;
            $.each(result_GPA_unlock, function(index_GPA_unlock) {
                for (var p_GPA_unlock=0;p_GPA_unlock<result_GPA_unlock[index_GPA_unlock].length;p_GPA_unlock++) {
                    console.log(result_GPA[index_GPA][p_GPA].maHocKyDanhGia + " | " + result_GPA_unlock[index_GPA_unlock][p_GPA_unlock].maHocKyDanhGia);
                    if(result_GPA[index_GPA][p_GPA].maHocKyDanhGia == result_GPA_unlock[index_GPA_unlock][p_GPA_unlock].maHocKyDanhGia) {
                        isInGPA = true;
                    }                    
                }
            });
            if(isInGPA)
                result_GPA[index_GPA][p_GPA].hanhDong = "suaDiem";
            else
                result_GPA[index_GPA][p_GPA].hanhDong = "xemDiem";

        }
    });

    console.log("--- 3 ---");
    console.log(result_GPA);

    // Kiểm tra điểm được mở có tồn tại trong điểm của sinh viên không. Nếu mở -> chấm điểm.
    $.each(result_GPA_unlock, function(index_GPA_unlock) {
        for (var p_GPA_unlock=0;p_GPA_unlock<result_GPA_unlock[index_GPA_unlock].length;p_GPA_unlock++) {
            var isInGPA = false;
            $.each(result_GPA, function(index_GPA) {
                for (var p_GPA=0;p_GPA<result_GPA[index_GPA].length;p_GPA++) {
                    console.log("Mã mở = " + result_GPA_unlock[index_GPA_unlock][p_GPA_unlock].maHocKyDanhGia + " | " + "Mã sv = " + result_GPA[index_GPA][p_GPA].maHocKyDanhGia);
                    console.log("hanh dong GPA = " + result_GPA[index_GPA][p_GPA].hanhDong);

                    if(result_GPA_unlock[index_GPA_unlock][p_GPA_unlock].maHocKyDanhGia == result_GPA[index_GPA][p_GPA].maHocKyDanhGia
                        && result_GPA[index_GPA][p_GPA].hanhDong == "suaDiem"
                    ) {
                        isInGPA = true;
                        console.log("abc");
                        
                    } 
                }
            });
            if(!isInGPA)
                result_GPA_unlock[index_GPA_unlock][p_GPA_unlock].hanhDong = "chamDiem";
            else
                result_GPA_unlock[index_GPA_unlock][p_GPA_unlock].hanhDong = "xemDiem";
        }
    });

    console.log("--- Diem duoc mo ---");
    console.log(result_GPA_unlock);

    console.log("--- 4 ---");
    console.log(result_GPA);

    //Lấy điểm được mở bỏ vào điểm của sinh viên
    $.each(result_GPA_unlock, function(index_GPA_unlock) {
        for (var p_GPA_unlock=0;p_GPA_unlock<result_GPA_unlock[index_GPA_unlock].length;p_GPA_unlock++) {
            if(result_GPA_unlock[index_GPA_unlock][p_GPA_unlock].hanhDong == "chamDiem") {
                result_GPA["diemtrungbinhhe4"].push(result_GPA_unlock[index_GPA_unlock][p_GPA_unlock]);
            }
                
        }
    });

    // $.each(result_GPA, function(index_GPA) {
    //     for (var p_GPA=0;p_GPA<result_GPA[index_GPA].length;p_GPA++) {
    //         // console.log(result_GPA[index_GPA][p_GPA].maHocKyDanhGia);
    //     }
    // });

    console.log("--- 5 ---");
    console.log(result_GPA);

    //Sort điểm của sinh viên theo học kỳ giảm dần
    // result_GPA["diemtrungbinhhe4"].sort((a, b) => {sortGPA(a ,b)});
    result_GPA["diemtrungbinhhe4"].sort();
    sortObject(result_GPA["diemtrungbinhhe4"], "namHocXet", true);
    //sortObject(result_GPA["diemtrungbinhhe4"], "hocKyXet", true);

    console.log("--- 6 ---");
    console.log(result_GPA);

    // // Lưu điểm vào htmlData
    $.each(result_GPA, function(index_GPA) {
        for (var p_GPA=0;p_GPA<result_GPA[index_GPA].length;p_GPA++) {
            console.log(result_GPA[index_GPA][p_GPA].hanhDong);
            htmlData += "<tr>\
                            <td> " + (p_GPA + 1) + " </td>\
                            <td> " + result_sinhvien.maSinhVien + " </td>\
                            <td> " + result_sinhvien.hoTenSinhVien + " </td>\
                            <td> " + result_GPA[index_GPA][p_GPA].hocKyXet + " </td>\
                            <td> " + result_GPA[index_GPA][p_GPA].namHocXet + " </td>";
            if(result_GPA[index_GPA][p_GPA].hanhDong == "xemDiem") 
                htmlData += "<td>" + result_GPA[index_GPA][p_GPA].diem + "</td>\
                            <td></td>";
                
            if(result_GPA[index_GPA][p_GPA].hanhDong == "chamDiem")
                htmlData += "<td> </td>" +
                            "<td>" + 
                                "<button type='button' class='btn btn-success btn_NhapDiem_DiemHe4' data-id='"+ result_sinhvien.maSinhVien + "' style='color: white;'>" +
                                    "Nhập điểm" +
                                "</button>" +
                                "<div class='edit-confirmation' style='display:none'>\
                                    <button class='btn btn-primary btn_XacNhanNhapDiem_DiemHe4' style='color: white;' data-idMSSV = '" + result_sinhvien.maSinhVien + "' data-idMaHKDG='" + result_GPA[index_GPA][p_GPA].maHocKyDanhGia +
                                        "' data-hocKyXet='" + result_GPA[index_GPA][p_GPA].hocKyXet + "' data-namHocXet='" + result_GPA[index_GPA][p_GPA].namHocXet + "'>Xác nhận</button>\
                                    <button class='btn bg-danger btn_HuyChinhSua_DiemHe4 ml-2' style='color: white;' data-idMSSV = '" + result_sinhvien.maSinhVien + "' data-idMaHKDG='" + result_GPA[index_GPA][p_GPA].maHocKyDanhGia + "'>Hủy</button>\
                                </div>"+
                            "</td>";
                
            if(result_GPA[index_GPA][p_GPA].hanhDong == "suaDiem")
                htmlData += "<td>" + result_GPA[index_GPA][p_GPA].diem + "</td>" +
                            "<td>" + 
                                "<button type='button' class='btn btn-warning btn_ChinhSua_DiemHe4' data-id='"+ result_sinhvien.maSinhVien + "' style='color: white;'>" +
                                    "Chỉnh sửa" +
                                "</button>" +
                                "<div class='edit-confirmation' style='display:none'>\
                                    <button class='btn btn-primary btn_XacNhanChinhSua_DiemHe4' style='color: white;' data-idMSSV = '" + result_sinhvien.maSinhVien + "' data-idMaHKDG='" + result_GPA[index_GPA][p_GPA].maHocKyDanhGia +
                                    "' data-hocKyXet='" + result_GPA[index_GPA][p_GPA].hocKyXet + "' data-namHocXet='" + result_GPA[index_GPA][p_GPA].namHocXet + "'> Xác nhận</button>\
                                    <button class='btn bg-danger btn_HuyChinhSua_DiemHe4 ml-2' style='color: white;' data-idMSSV = '" + result_sinhvien.maSinhVien + "' data-idMaHKDG='" + result_GPA[index_GPA][p_GPA].maHocKyDanhGia + "'>Hủy</button>\
                                </div>"+
                            "</td>";
            htmlData += "</tr>";
        }
    });
    return htmlData;
}

function loadGPAToTable() {
    $("#tbody_BangDiemXemTruoc tr").remove();
    var htmlData = "";
    var result_GPA_unlock = null;
    var result_GPA = null;

    // Nếu học kỳ không mở và sinh viên chưa có bất kỳ điểm nào -> Không tìm thấy kết quả.
    var isUnlock = isNhapDiemUnlock();
    var isUnlockSinhVien = isUnlockForSinhVien();
    var isUnlockLop = isUnlockForSinhVien("lop");
    var isHavingGPA = isGetAPISuccess(urlapi_diemtrungbinhhe4_read_MaSV + maSinhVien);
    if(!isUnlock && !isHavingGPA) {
        htmlData += "<tr>\
                        <td colspan='7'>\
                            <p class='mt-4 text-center'>Không tìm thấy kết quả.</p>\
                        </td>\
                    </tr>"
        $("#tbody_BangDiemXemTruoc").append(htmlData);
        return;
    }

    if(isUnlockSinhVien) {
        // Nếu học kỳ mở nhưng sinh viên chưa có bất kỳ điểm nào -> Hiện chấm điểm cho học kỳ đang mở
        if(isUnlock && !isHavingGPA) {
            result_GPA_unlock = getReadAPI(urlapi_chucnang_hockydanhgia_details_read +
                    "?maChucNang=" + CHUC_NANG_NHAP_DIEM_HE_4);
            console.log(result_GPA_unlock);
            //result_GPA_unlock["chucnang_hockydanhgia"].sort((a, b) => {sortGPA(a ,b)});
            // result_GPA_unlock["chucnang_hockydanhgia"].sort();
            sortObject(result_GPA_unlock["chucnang_hockydanhgia"], "namHocXet", true);
            //sortObject(result_GPA_unlock["chucnang_hockydanhgia"], "hocKyXet", true);
            htmlData = getHtmlDataUnlockGPA(result_GPA_unlock);
            $("#tbody_BangDiemXemTruoc").append(htmlData);
            return;
        }

        //Nếu học kỳ mở và sinh viên đã có dữ liệu điểm -> Hiện chấm điểm hoặc chỉnh sửa cho học kỳ mở, hiện xem cho học kỳ khác.
        if(isUnlock && isHavingGPA) {
            result_GPA_unlock = getReadAPI(urlapi_chucnang_hockydanhgia_details_read +
                    "?maChucNang=" + CHUC_NANG_NHAP_DIEM_HE_4);
            result_GPA = getReadAPI(urlapi_diemtrungbinhhe4_read_MaSV + maSinhVien);
            console.log("--- 1 ---");
            console.log(result_GPA);
            htmlData = getHtmlDataGPA(result_GPA_unlock, result_GPA);
            $("#tbody_BangDiemXemTruoc").append(htmlData);
            return;
        }
        return;
    }

    if(isUnlockLop) {
        htmlData = getHtmlDataUnlockLop();
        $("#tbody_BangDiemXemTruoc").append(htmlData);
        return;
    }
}
function postDiemHe4(maSinhVien, maHocKyDanhGia, diem, urlAPI, namHocXet, hocKyXet) {
    var dataPost_Update = {
        maDiemTrungBinh: maSinhVien + maHocKyDanhGia,
        diem: diem,
        maHocKyDanhGia: maHocKyDanhGia,
        maSinhVien: maSinhVien,
    };

    $.ajax({
        url: urlAPI,
        // urlapi_diemtrungbinhhe4_update,
        type: "POST",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        data: JSON.stringify(dataPost_Update),
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_Create) {
            if(urlAPI == urlapi_diemtrungbinhhe4_update)
                presentNotification("success", "Thành công", "Cập nhật điểm học kỳ " + hocKyXet + " - năm học " + namHocXet + " thành công!" );
            else
                presentNotification("success", "Thành công", "Lưu điểm học kỳ " + hocKyXet + " - năm học " + namHocXet + " thành công!" );
        },
        error: function (errorMessage) {
            //presentNotification("error", "Lỗi", errorMessage.responseJSON.message);
            if(urlAPI == urlapi_diemtrungbinhhe4_update)
                presentNotification("error", "Thất bại", "Cập nhật điểm học kỳ " + hocKyXet + " - năm học " + namHocXet + " thất bại!" );
            else
                presentNotification("error", "Thất bại", "Lưu điểm học kỳ " + hocKyXet + " - năm học " + namHocXet + " thất bại!" );
        },
    });
}

function updateDiemHe4(maSinhVien, maHocKyDanhGia, diem, chucNang, namHocXet, hocKyXet, maHocKyMo = null) {
    //Kiểm tra hệ thống còn mở cho nhập điểm hay không?
    var isUnlock = isNhapDiemUnlock();
    if(!isUnlock) {
        presentNotification("error", "Lỗi", "Hệ thống đã đóng chức năng nhập và chỉnh sửa điểm!");
        return;
    }

    // Kiểm tra quyền sinh viên được nhập điểm hay không?
    var isUnlockSinhVien = isUnlockForSinhVien();
    var isUnlockLop = isUnlockForSinhVien("lop");
    if(isUnlockSinhVien) {
        //Kiểm tra học kỳ còn cho phép nhập điểm hay không?
        isUnlock = isGetAPISuccess(urlapi_chucnang_hockydanhgia_single_details_read +
            "?maChucNang=" + CHUC_NANG_NHAP_DIEM_HE_4 + "&maHocKyDanhGia=" + maHocKyDanhGia);
        if(!isUnlock) {
            presentNotification("error", "Lỗi", "Hệ thống không cho sinh viên nhập và chỉnh sửa điểm!");
            return;
        }

        if(chucNang == "chinhSua")
            postDiemHe4(maSinhVien, maHocKyDanhGia, diem, urlapi_diemtrungbinhhe4_update, namHocXet, hocKyXet);
        else
            postDiemHe4(maSinhVien, maHocKyDanhGia, diem, urlapi_diemtrungbinhhe4_create, namHocXet, hocKyXet);
    } else if(isUnlockLop) {
        
        var result_lop = getSingleReadAPI(urlapi_sinhvien_single_read + maSinhVien);
        console.log("maLop = " + result_lop.maLop + " | " + "maHocKyMo = " + maHocKyMo);
        isUnlock = isGetAPISuccess(urlapi_lopmonhapdiemhe4_read + "?maLop=" + result_lop.maLop + "&maHocKyMo=" + maHocKyMo);
        if(isUnlock) {
            console.log("chay trong nay");
            if(chucNang == "chinhSua")
                postDiemHe4(maSinhVien, maHocKyDanhGia, diem, urlapi_diemtrungbinhhe4_update, namHocXet, hocKyXet);
            else
                postDiemHe4(maSinhVien, maHocKyDanhGia, diem, urlapi_diemtrungbinhhe4_create, namHocXet, hocKyXet);
        }
    } else
        presentNotification("error", "Lỗi", "Hệ thống không cho phép sinh viên nhập và chỉnh sửa điểm!");

}

function isGPA(inputElement, min, max) {
    if (inputElement.value < min) {
        inputElement.value = min;
    } else if (inputElement.value > max) {
        inputElement.value = max;
    }
};

function sortGPA(a, b) {
    console.log("chay sort");
    let fa = a.namHocXet.toLowerCase();
    let fb = b.namHocXet.toLowerCase();
    let fc = Number(a.hocKyXet);
    let fd = Number(b.hocKyXet);

    if (fa < fb)
        return -1;
    if (fa > fb)
        return 1;
    return 0;
}

function sortObject(object, prop, asc) {
    object.sort(function (a, b) {
        if (asc) {
        return a[prop] > b[prop] ? 1 : a[prop] < b[prop] ? -1 : 0;
        } else {
        return b[prop] > a[prop] ? 1 : b[prop] < a[prop] ? -1 : 0;
        }
    });

    return object;
}