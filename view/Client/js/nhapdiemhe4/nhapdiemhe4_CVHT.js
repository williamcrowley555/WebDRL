var tableTitle = [
    "STT",
    "Mã số sinh viên",
    "Họ tên sinh viên",
    "Điểm"
];

var tableDanhSachDiemHe4Title = [
    "STT",
    "Mã số sinh viên",
    "Họ tên sinh viên",
    "Điểm",
    "Lớp"
];

var tableDanhSachLopTitle = [
    "STT",
    "Mã lớp",
    "Tên lớp",
    "Mã khoa"
];

var listDiem = "";

var jwtCookie = getCookie("jwt");

function redirectPage() {
    // Kiểm tra chức năng nhập điểm hệ 4 được mở hay không?
    var isUnlock = isNhapDiemUnlock();
    if(!isUnlock) {
        window.history.back();
        return;
    }

    // Kiểm tra quyền cố vấn học tập có vào được hay không?
    if(quyen == "cvht") {
        isUnlock = isUnlockForCVHT("lop");
        if(!isUnlock) {
            isUnlock = isUnlockForCVHT();
            if(!isUnlock) {
                window.history.back();
                return;
            }
        }
    }

    // Kiểm tra quyền sinh viên có vào được hay không?
    if(quyen == "sinhvien") {
        window.history.back();
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

function getHocKyVaNamHoc(urlAPI) {
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

function loadComboBoxHocKyVaNamHoc(selector) {
    // Kiểm tra lấy được học kỳ và năm học được mở hay không?
    var isSuccess = isGetAPISuccess(urlapi_chucnang_hockydanhgia_details_read 
        + "?maChucNang=" + CHUC_NANG_NHAP_DIEM_HE_4);
    if (!isSuccess) {
        presentNotification("error", "Lỗi", "Lỗi load combobox học kỳ và năm học!");
        return;
    }

    // Lưu thông tin vào htmlData
    var htmlData = "<option selected disabled value='none'> -- Chọn học kỳ - năm học --</option>";
    var result = null;
    // Kiểm tra lưu combobox vào selector nào?
    if(selector == "#select_hocKy_namHoc") {
        result = getHocKyVaNamHoc(urlapi_chucnang_hockydanhgia_details_read 
            + "?maChucNang=" + CHUC_NANG_NHAP_DIEM_HE_4);
        sortObject(result["chucnang_hockydanhgia"], "namHocXet", true);
    } else
        result = getHocKyVaNamHoc(urlapi_hockydanhgia_read);
    $.each(result, function(index) {
        for(var p=0;p<result[index].length;p++) {
            htmlData +="<option value='" + result[index][p].maHocKyDanhGia + "'>" +
                            "Học kỳ: " + result[index][p].hocKyXet + " - Năm học: " + result[index][p].namHocXet +
                        "</option>";
        }
    });

    // Gắn htmlData lên combobox
    $(selector).find("option").remove();
    $(selector).append(htmlData);
}

function loadComboBoxLopTheoMaCVHT(page, maSo) {
    var htmlData = "<option selected disabled value='none'> -- Chọn lớp -- </option>";
    $.ajax({
        url: urlapi_lop_read_maCVHT + maSo,
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {
            Authorization: jwtCookie,
        },
        success: function (result) {
            if(page == "nhapdiem") {
                $("#select_lop").find("option").remove();
            } else {
                $("#select_lop_xemdiem").find("option").remove();
            }
            
            $.each(result, function (index) {
                for (var p = 0; p < result[index].length; p++) {
                    htmlData +=
                        "<option value='" +
                        result[index][p].maLop +
                        "'>" +
                        result[index][p].maLop +
                        "</option>";
                }
            });

            if(page == "nhapdiem") {
                $("#select_lop").append(htmlData);
            } else {
                $("#select_lop_xemdiem").append(htmlData);
            }
        },
        error: function (errorMessage) {
          thongBaoLoi(errorMessage.responseJSON.message);
        },
    });
}

function createBangDiemXemTruoc(formData) {
    $.ajax({
        url: host_domain_url + '/phpspreadsheet/import/import_GPA_CVHT.php',
        type: "POST",
        data: formData,
        processData: false, 
        contentType: false,
        enctype: 'multipart/form-data',
        mimeType: 'multipart/form-data',
        success: function (result) {
            console.log("success");
            var htmlData = "";
            $("#bangDiemXemTruoc").show();
            result = JSON.parse(result);
            console.log("result = " + result.array);
            
            if(result.success == true) {
                $("#btnLuu").show();
                listDiem = result.array;
            } else {
                if(result.message != null) {
                    presentNotification("error", "Lỗi", result.message);
                    $("#import_file").val("");
                    return;
                } else
                    $("#loiXemTruoc").show();
            }
            
            $.each(result.array, function(index){
                for (var p = 0; p < result.array[index].length; p++) {
                    if(result.array[index][p].loi == "") {
                        htmlData += "<tr>\
                                        <td class='cell'>" + result.array[index][p].soThuTu + " </td>\
                                        <td class='cell'>" + result.array[index][p].maSinhVien + " </td>\
                                        <td class='cell'>" + result.array[index][p].hoTenSinhVien + " </td>\
                                        <td class='cell'>" + result.array[index][p].diem + " </td>\
                                        <td class='cell'>" + result.array[index][p].loi + " </td>\
                                    </tr>";
                    } else {
                         htmlData += "<tr>\
                                        <td class='cell' style='color: red;'>" + result.array[index][p].soThuTu + " </td>\
                                        <td class='cell' style='color: red;'>" + result.array[index][p].maSinhVien + " </td>\
                                        <td class='cell' style='color: red;'>" + result.array[index][p].hoTenSinhVien + " </td>\
                                        <td class='cell' style='color: red;'>" + result.array[index][p].diem + " </td>\
                                        <td class='cell' style='color: red;'>" + result.array[index][p].loi + " </td>\
                                    </tr>";
                    }
                }
            })

            $("#tbody_BangDiemXemTruoc").append(htmlData);
        },
        error: function (errorMessage) {
            console.log("error");
        }
    });
}

function luuDiem(maHocKyDanhGia) {
    //Kiểm tra hệ thống còn mở cho nhập điểm hay không?
    var isUnlock = isNhapDiemUnlock();
    if(!isUnlock) {
        presentNotification("error", "Lỗi", "Hệ thống đã đóng chức năng nhập và chỉnh sửa điểm!");
        return;
    }

    // Kiểm tra quyền cố vấn học tập được nhập điểm hay không?
    isUnlock = isUnlockForCVHT();
    if(!isUnlock) {
        presentNotification("error", "Lỗi", "Hệ thống không cho phép cố vấn học tập nhập và chỉnh sửa điểm!");
        return;
    }

    //Kiểm tra học kỳ còn cho phép nhập điểm hay không?
    isUnlock = isGetAPISuccess(urlapi_chucnang_hockydanhgia_single_details_read +
        "?maChucNang=" + CHUC_NANG_NHAP_DIEM_HE_4 + "&maHocKyDanhGia=" + maHocKyDanhGia);
    if(!isUnlock) {
        presentNotification("error", "Lỗi", "Hệ thống không cho phép cố vấn học tập nhập và chỉnh sửa điểm!");
        return;
    }

    $.each(listDiem, function(index){
        for (var p = 0; p < listDiem[index].length; p++) {
            var dataPost = {
                maDiemTrungBinh: listDiem[index][p].maSinhVien + "" + maHocKyDanhGia,
                diem: listDiem[index][p].diem,
                maHocKyDanhGia: maHocKyDanhGia,
                maSinhVien: listDiem[index][p].maSinhVien
            };
            $.ajax({
                url: urlapi_diemtrungbinhhe4_create,
                type: "POST",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                data: JSON.stringify(dataPost),
                async: false,
                headers: { Authorization: jwtCookie },
                success: function (result_update) {
                    $("#tbody_BangDiemXemTruoc tr").remove();
                    $("#btnLuu").hide();
                    $("#import_file").val("");
                    presentNotification("success", "Thành công", "Lưu điểm thành công!");
                },
                error: function (errorMessage) {
                    console.log("Loi");
                    $("#tbody_BangDiemXemTruoc tr").remove();
                    $("#btnLuu").hide();
                    $("#import_file").val("");
                    presentNotification("error", "Thất bại", "Lưu điểm thất bại!");
                },
            });
        }
    });
}

function showNhapDiemElements() {
    $("#selector_nhapdiem").show();
    $("#luuy_nhapdiem").show();
    $("#tbody_BangDiemXemTruoc tr").remove();
    $("#bangDiemXemTruoc").show();
    $("#import_file").val("");
    $("#loiXemTruoc").hide();
    $("#btnLuu").hide();
    loadComboBoxHocKyVaNamHoc("#select_hocKy_namHoc");
    loadComboBoxLopTheoMaCVHT("nhapdiem", maSo);
}

function hideNhapDiemElements() {
    $("#selector_nhapdiem").hide();
    $("#luuy_nhapdiem").hide();
    $("#bangDiemXemTruoc").hide();
    $("#loiXemTruoc").hide();
    $("#btnLuu").hide();
    $("#idPhanTrang").empty();
}

function showXemDiemElements() {
    $("#selector_xemdiem").show();
    $("#danhsachdiemhe4").show();
    $("#tbody_danhSachDiemHe4 tr").remove();
    loadComboBoxHocKyVaNamHoc("#select_hocKy_namHoc_xemdiem");
    loadComboBoxLopTheoMaCVHT("xemdiem", maSo);
}

function hideXemDiemElements() {
    $("#selector_xemdiem").hide();
    $("#danhsachdiemhe4").hide();
}

function showMoLopElements() {
    $("#selector_molop").show();
    $("#danhsachlop").show();
    $("#tbody_danhSachLop tr").remove();
    $("#select_hocKy_namHoc_molop").find("option").remove();
    var isUnlock = isUnlockForCVHT("lop");
    if(isUnlock) {
        var htmlData = "<option selected disabled value='none'> -- Chọn học kỳ - năm học --</option>";
        var result = null;
        result = getHocKyVaNamHoc(urlapi_chucnang_hockydanhgia_details_read 
            + "?maChucNang=" + CHUC_NANG_NHAP_DIEM_HE_4);
        sortObject(result["chucnang_hockydanhgia"], "namHocXet", true);
        $.each(result, function(index) {
            for(var p=0;p<result[index].length;p++) {
                htmlData +="<option value='" + result[index][p].maHocKyDanhGia + "'>" +
                                "Học kỳ: " + result[index][p].hocKyXet + " - Năm học: " + result[index][p].namHocXet +
                            "</option>";
            }
        });
        // Gắn htmlData lên combobox
        $("#select_hocKy_namHoc_molop").append(htmlData);
    } else {
        presentNotification("error", "Lỗi", "Quyền lớp chưa mở để load combobox!");
    }
    
}

function hideMoLopElements() {
    $("#selector_molop").hide();
    $("#danhsachlop").hide();
    $("#idPhanTrangDanhSachLop").empty();
}

function showRadioNhapDiem() {
    $("#radio_nhapdiem").show();
    $("#label_nhapdiem").show();
}

function hideRadioNhapDiem() {
    $("#radio_nhapdiem").hide();
    $("#label_nhapdiem").hide();
}

function showRadioXemDiem() {
    $("#radio_xemdiem").show();
    $("#label_xemdiem").show();
}

function hideRadioXemDiem() {
    $("#radio_xemdiem").hide();
    $("#label_xemdiem").hide();
}

function showRadioMoLop() {
    $("#radio_molop").show();
    $("#label_molop").show();
}

function hideRadioMoLop() {
    $("#radio_molop").hide();
    $("#label_molop").hide();
}

function showUnlockCVHTAndLopElements() {
    $("#radio_nhapdiem").prop("checked", true);
    hideXemDiemElements();
    hideMoLopElements();
    showNhapDiemElements();

    showRadioNhapDiem();
    showRadioXemDiem();
    showRadioMoLop();
}

function showUnlockLopElements() {
    $("#radio_molop").prop("checked", true);
    hideXemDiemElements();
    hideNhapDiemElements();
    showMoLopElements();

    hideRadioNhapDiem();
    hideRadioXemDiem();
    showRadioMoLop();
}

function showUnlockCVHTElements() {
    $("#radio_nhapdiem").prop("checked", true);
    hideMoLopElements();
    hideXemDiemElements();
    showNhapDiemElements();
    
    hideRadioMoLop();
    showRadioNhapDiem();
    showRadioXemDiem();
}

function checkExistGPAByClass(maLop, maHocKyDanhGia) {
    var isExisted = false;
    $.ajax({
        url: urlapi_diemtrungbinhhe4_read + "?maLop=" + maLop + "&maHocKyDanhGia=" + maHocKyDanhGia,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function() {
            isExisted = true;
        },
        error: function() {
            isExisted = false;
        }
    });
    return isExisted;
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

function getListGPAByClassAndSemester(maLop, maHocKyDanhGia) {
    var listGPA = null;
    $.ajax({
        url: urlapi_diemtrungbinhhe4_read + "?maLop=" + maLop + "&maHocKyDanhGia=" + maHocKyDanhGia,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function(result) {
            listGPA = result;
        },
    });
    return listGPA;
}

function getListGPANotHaveGradeByClassAndSemester(maLop, maHocKyDanhGia) {
    var listGPA = null;
    $.ajax({
        url: urlapi_diemtrungbinhhe4_read_NotHaveGrade + "?maLop=" + maLop + "&maHocKyDanhGia=" + maHocKyDanhGia,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function(result) {
            listGPA = result;
        },
    });
    return listGPA;
}

function loadGPAToTable(maLop, maHocKyDanhGia) {
    $("#tbody_danhSachDiemHe4 tr").remove();
    var soThuTuTiepTheo = null;
    var htmlData = "";
    // var isExisted = checkExistGPAByClass(maLop, maHocKyDanhGia);
    // if(!isExisted) {
    //     htmlData += "<tr>\
    //                     <td colspan='6'>\
    //                         <p class='mt-4'>Không tìm thấy kết quả.</p>\
    //                     </td>\
    //                 </tr>"
    //     $("#tbody_danhSachDiemHe4").append(htmlData);
    //     return;
    // }

    var isEditable = isGetAPISuccess(urlapi_chucnang_hockydanhgia_single_details_read +
        "?maChucNang=" + CHUC_NANG_NHAP_DIEM_HE_4 + "&maHocKyDanhGia=" + maHocKyDanhGia);
    // var listGPA = getListGPAByClassAndSemester(maLop, maHocKyDanhGia);
    var result = getListGPAByClassAndSemester(maLop, maHocKyDanhGia);
    if(result != null) {
        var result_khongCoDiem = getListGPANotHaveGradeByClassAndSemester(maLop, maHocKyDanhGia);
        console.log(result_khongCoDiem);
        if(result_khongCoDiem != null) {
            soThuTuTiepTheo = result["diemtrungbinhhe4"].length;
            $.each(result_khongCoDiem, function(index){
                for (var p = 0; p < result_khongCoDiem[index].length; p++) {
                    soThuTuTiepTheo++;
                    result_khongCoDiem[index][p].soThuTu = soThuTuTiepTheo;
                    result_khongCoDiem[index][p].diem = "Chưa có điểm";
                }
            });
            $.each(result_khongCoDiem, function(index){
                for (var p = 0; p < result_khongCoDiem[index].length; p++) {
                    result["diemtrungbinhhe4"].push(result_khongCoDiem[index][p]);
                }
            });
        }

        $("#idPhanTrang").pagination({
            dataSource: result["diemtrungbinhhe4"],
            pageSize: 10,
            autoHidePrevious: true,
            autoHideNext: true,

            callback: function (data, pagination) {
                var htmlData = "";
                var count = 0;

                for (let i = 0; i < data.length; i++) {
                    count += 1;
                    htmlData += "<tr> \
                                    <td>" + data[i].soThuTu + "</td>\
                                    <td>" + data[i].maSinhVien + "</td>\
                                    <td>" + data[i].hoTenSinhVien + "</td>\
                                    <td>" + data[i].diem + "</td>\
                                    <td>" + maLop + "</td>";
                    if(data[i].diem == "Chưa có điểm") {
                        htmlData += "<td></td>\
                                </tr>";
                    } else {
                        if(isEditable)
                        htmlData+= "<td>" + 
                                        "<button type='button' class='btn btn-warning btn_ChinhSua_DiemHe4' data-id='"+ data[i].maSinhVien + "' style='color: white;'>" +
                                            "Chỉnh sửa" +
                                        "</button>" +
                                        "<div class='edit-confirmation' style='display:none'>\
                                            <button class='btn btn-primary btn_XacNhanChinhSua_DiemHe4' style='color: white;' data-idMSSV = '" + data[i].maSinhVien + "' data-idMaHKDG='" + maHocKyDanhGia + "'>Xác nhận</button>\
                                            <button class='btn bg-danger btn_HuyChinhSua_DiemHe4 ml-2' style='color: white;' data-idMSSV = '" + data[i].maSinhVien + "' data-idMaHKDG='" + maHocKyDanhGia + "'>Hủy</button>\
                                        </div>"+
                                    "</td>\
                                </tr>";
                        else
                            htmlData+= "<td></td>\
                                    </tr>";
                    }
                    
                    
                }
                $("#tbody_danhSachDiemHe4").html(htmlData);
            },
        });
    } else {
        result = getListGPANotHaveGradeByClassAndSemester(maLop, maHocKyDanhGia);
        $.each(result, function(index){
            for (var p = 0; p < result[index].length; p++) {
                result[index][p].diem = "Chưa có điểm";
            }
        });
        $("#idPhanTrang").pagination({
            dataSource: result["diemtrungbinhhe4"],
            pageSize: 10,
            autoHidePrevious: true,
            autoHideNext: true,

            callback: function (data, pagination) {
                var htmlData = "";
                var count = 0;

                for (let i = 0; i < data.length; i++) {
                    count += 1;
                    htmlData += "<tr> \
                                    <td>" + data[i].soThuTu + "</td>\
                                    <td>" + data[i].maSinhVien + "</td>\
                                    <td>" + data[i].hoTenSinhVien + "</td>\
                                    <td>" + data[i].diem + "</td>\
                                    <td>" + maLop + "</td>\
                                    <td> </td>\
                                </tr>";
                }
                $("#tbody_danhSachDiemHe4").html(htmlData);
            },
        });
    }
}

function updateDiemHe4(maSinhVien, maHocKyDanhGia, diem) {
    //Kiểm tra hệ thống còn mở cho nhập điểm hay không?
    var isUnlock = isNhapDiemUnlock();
    if(!isUnlock) {
        presentNotification("error", "Lỗi", "Hệ thống đã đóng chức năng nhập và chỉnh sửa điểm!");
        return;
    }

    // Kiểm tra quyền cố vấn học tập được nhập điểm hay không?
    isUnlock = isUnlockForCVHT();
    if(!isUnlock) {
        presentNotification("error", "Lỗi", "Hệ thống không cho phép cố vấn học tập nhập và chỉnh sửa điểm!");
        return;
    }

    //Kiểm tra học kỳ còn cho phép nhập điểm hay không?
    isUnlock = isGetAPISuccess(urlapi_chucnang_hockydanhgia_single_details_read +
        "?maChucNang=" + CHUC_NANG_NHAP_DIEM_HE_4 + "&maHocKyDanhGia=" + maHocKyDanhGia);
    if(!isUnlock) {
        presentNotification("error", "Lỗi", "Hệ thống không cho phép cố vấn học tập nhập và chỉnh sửa điểm!");
        return;
    }

    var dataPost_Update = {
        maDiemTrungBinh: maSinhVien + maHocKyDanhGia,
        diem: diem,
        maHocKyDanhGia: maHocKyDanhGia,
        maSinhVien: maSinhVien,
    };

    $.ajax({
        url: urlapi_diemtrungbinhhe4_update,
        type: "POST",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        data: JSON.stringify(dataPost_Update),
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_Create) {

        Swal.fire({
            icon: "success",
            title: "Cập nhật điểm thành công cho sinh viên có mã là " + maSinhVien,
            text: "",
            timer: 2000,
            timerProgressBar: true,
        });
        },
        error: function (errorMessage) {
        //checkLoiDangNhap(errorMessage.responseJSON.message);
        

        Swal.fire({
            icon: "error",
            title: "Lỗi",
            text: errorMessage.responseJSON.message,
            //timer: 5000,
            timerProgressBar: true,
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

function isUnlockForCVHT(quyenLop = null) {
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
            if(result_CN_Quyen.maQuyen == quyen)
                isUnlock = true;
        },
        error: function (){}
    });
    return isUnlock;
}

function loadDanhSachLop(maSo) {
    $("#tbody_danhSachLop tr").remove();
    var maHocKyDanhGia = $("#select_hocKy_namHoc_molop").find(":selected").val();
    var result_hocKy = callGetAPI(urlapi_hockydanhgia_single_read + maHocKyDanhGia);
    var maHocKyMo = result_hocKy.hocKyXet + "-" + result_hocKy.namHocXet;
    var result = callGetAPI(urlapi_lop_read_maCVHT + maSo);
    if(result == null) {
        presentNotification("error", "Lỗi", "Cố vấn học tập chưa quản lý bất kì lớp nào!");
        return;
    }

    $.each(result, function(index) {
        for (var i = 0; i < result[index].length; i++) {
            isSuccess = isGetAPISuccess(urlapi_lopmonhapdiemhe4_read + "?maLop="
                + result[index][i].maLop + "&maHocKyMo=" + maHocKyMo);
            if(isSuccess)
                result[index][i].hanhDong = "khoaNhapDiem";
            else
                result[index][i].hanhDong = "moKhoaNhapDiem";
        }
    });

    console.log(result);

    $("#idPhanTrangDanhSachLop").pagination({
        dataSource: result["lop"],
        pageSize: 10,
        autoHidePrevious: true,
        autoHideNext: true,

        callback: function (data, pagination) {
            var htmlData = "";
            var count = 0;

            for (let i = 0; i < data.length; i++) {
                count += 1;
                htmlData += "<tr>\
                                <td> " + count + "</td>\
                                <td> " + data[i].maLop + "</td>\
                                <td> " + data[i].tenLop + "</td>\
                                <td> " + data[i].maKhoa + "</td>"
                if(data[i].hanhDong == "moKhoaNhapDiem")
                    htmlData += "<td>\
                                    <button type='button' class='btn btn-success btn_MoNhapDiem' data-malop='" + data[i].maLop + "'>\
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-unlock' viewBox='0 0 16 16'>\
                                            <path d='M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z'/>\
                                        </svg>\
                                        Mở nhập điểm\
                                    </button>\
                                </td>\
                            <tr>"
                else
                    htmlData += "<td>\
                                    <button type='button' class='btn btn-danger btn_KhoaNhapDiem' data-malop='" + data[i].maLop + "'>\
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-lock' viewBox='0 0 16 16'>\
                                            <path d='M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z'/>\
                                        </svg>\
                                        Khóa nhập điểm\
                                    </button>\
                                </td>\
                            <tr>";

            }

            $("#tbody_danhSachLop").html(htmlData);
        },
    });   
}

function khoaHoacMoNhapDiem(urlAPI, maLop, maHocKyMo) {
    //urlapi_lopmochamdiemhe4_create
    var dataPost = {
        maLop: maLop,
        maHocKyMo: maHocKyMo
    }

    $.ajax({
        url: urlAPI,
        type: "POST",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        data: JSON.stringify(dataPost),
        async: false,
        headers: { Authorization: jwtCookie },
        success: function(result) {
            var maSo = getCookie("maSo");
            loadDanhSachLop(maSo);
            if(urlAPI == urlapi_lopmonhapdiemhe4_create)
                presentNotification("success", "Thành công", "Mở nhập điểm cho lớp " + maLop + " thành công!");
            else
                presentNotification("success", "Thành công", "Khóa nhập điểm cho lớp " + maLop + " thành công!");
                
        },
        error: function () {
            if(urlAPI == urlapi_lopmonhapdiemhe4_create)
                presentNotification("error", "Lỗi", "Mở nhập điểm thất bại!");
            else
                presentNotification("error", "Lỗi", "Khóa nhập điểm thất bại!");
        }
    });   
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