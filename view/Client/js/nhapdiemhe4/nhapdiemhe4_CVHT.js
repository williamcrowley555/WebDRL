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
        isUnlock = isUnlockForCVHT();
        if(!isUnlock) {
            window.history.back();
            return;
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
    var htmlData = "<option value='none'> -- Chọn học kỳ - năm học --</option>";
    var result = null;
    // Kiểm tra lưu combobox vào selector nào?
    if(selector == "#select_hocKy_namHoc")
        result = getHocKyVaNamHoc(urlapi_chucnang_hockydanhgia_details_read 
            + "?maChucNang=" + CHUC_NANG_NHAP_DIEM_HE_4,);
    else
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
    var htmlData = "<option value='none'> -- Chọn lớp -- </option>";
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

function getListGPAByClassAndSemester(maLop, maHocKyDanhGia) {
    var listGPA = "";
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

function loadGPAToTable(maLop, maHocKyDanhGia) {
    $("#tbody_danhSachDiemHe4 tr").remove();

    var htmlData = "";
    var isExisted = checkExistGPAByClass(maLop, maHocKyDanhGia);
    if(!isExisted) {
        htmlData += "<tr>\
                        <td colspan='6'>\
                            <p class='mt-4'>Không tìm thấy kết quả.</p>\
                        </td>\
                    </tr>"
        $("#tbody_danhSachDiemHe4").append(htmlData);
        return;
    }

    var isEditable = isGetAPISuccess(urlapi_chucnang_hockydanhgia_single_details_read +
        "?maChucNang=" + CHUC_NANG_NHAP_DIEM_HE_4 + "&maHocKyDanhGia=" + maHocKyDanhGia);
    var listGPA = getListGPAByClassAndSemester(maLop, maHocKyDanhGia);

    $.each(listGPA, function(index){
        for (var p = 0; p < listGPA[index].length; p++) {
            htmlData += "<tr>\
                            <td>" + listGPA[index][p].soThuTu + "</td>\
                            <td>" + listGPA[index][p].maSinhVien + "</td>\
                            <td>" + listGPA[index][p].hoTenSinhVien + "</td>\
                            <td>" + listGPA[index][p].diem + "</td>\
                            <td>" + maLop + "</td>";
            if(isEditable)
                htmlData+= "<td>" + 
                                "<button type='button' class='btn btn-warning btn_ChinhSua_DiemHe4' data-id='"+ listGPA[index][p].maSinhVien + "' style='color: white;'>" +
                                    "Chỉnh sửa" +
                                "</button>" +
                                "<div class='edit-confirmation' style='display:none'>\
                                    <button class='btn btn-primary btn_XacNhanChinhSua_DiemHe4' style='color: white;' data-idMSSV = '" + listGPA[index][p].maSinhVien + "' data-idMaHKDG='" + maHocKyDanhGia + "'>Xác nhận</button>\
                                    <button class='btn bg-danger btn_HuyChinhSua_DiemHe4 ml-2' style='color: white;' data-idMSSV = '" + listGPA[index][p].maSinhVien + "' data-idMaHKDG='" + maHocKyDanhGia + "'>Hủy</button>\
                                </div>"+
                            "</td>\
                        </tr>";
            else
                htmlData+= "<td></td>\
                        </tr>";
        }
    });
    $("#tbody_danhSachDiemHe4").append(htmlData);
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

function isUnlockForCVHT() {
    var isUnlock = false;
    $.ajax({
        url: urlapi_chucnang_quyen_single_details_read + "?maChucNang=" + 
            CHUC_NANG_NHAP_DIEM_HE_4 + "&maQuyen=" + quyen,
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {Authorization: jwtCookie,},
        success: function(result_CN_Quyen) {
            if(result_CN_Quyen.maQuyen == quyen)
                isUnlock = true;
        },
        error: function (){}
    });
    return isUnlock;
}