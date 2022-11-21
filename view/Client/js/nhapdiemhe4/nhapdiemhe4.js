var tableTitle = [
    "STT",
    "Mã số sinh viên",
    "Họ tên sinh viên",
    "Điểm"
];

var listDiem = "";

var jwtCookie = getCookie("jwt");

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

function loadComboBoxHocKyVaNamHoc() {
    var htmlData = "<option value='none'> -- Chọn học kỳ - năm học --</option>";
    $.ajax({
        url: urlapi_hockydanhgia_read,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result) {
            $("#select_hocKy_namHoc").find("option").remove();
            $.each(result, function (index) {
                for (var p = 0; p < result[index].length; p++) {
                    htmlData +=
                        "<option value='" +
                        result[index][p].maHocKyDanhGia +
                        "'>" +
                        "Học kỳ: " +
                        result[index][p].hocKyXet +
                        " - Năm học: " +
                        result[index][p].namHocXet +
                        "</option>";
                }
            });
            $("#select_hocKy_namHoc").append(htmlData);
        },
        error: function (errorMessage) {
            checkLoiDangNhap(errorMessage.responseJSON.message);
            presentNotification("error", "Lỗi", errorMessage.responseJSON.message);
        },
    });
}

function loadComboBoxLopTheoMaCVHT(maSo) {
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
            $("#select_lop").find("option").remove();
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
            $("#select_lop").append(htmlData);
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