var tableThongKeTitle = [
    "STT",
    "Mã số sinh viên",
    "Họ tên sinh viên",
    "Ngày sinh",
    "Lớp",
    "Tốt nghiệp",
    "Số lần xếp loại yếu, kém",
    "Số lần xếp loại yếu, kém liên tiếp",
    "Tình trạng",
];

var tableDanhSachPhieuRenLuyen = [
    "STT",
    "Mã phiếu",
    "Điểm tổng cộng",
    "Học kỳ",
    "Năm học",
    "Xếp loại",    
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

function thongBaoLoiRong() {}

function thongBaoLoiComboboxKhoa() {
    presentNotification("error", "Lỗi", "Lỗi load combobox khoa!");
}

function thongBaoLoiComboboxLop() {
    presentNotification("error", "Lỗi", "Bạn chưa chọn khoa hoặc khoa chưa tồn tại lớp!");
}

function thongBaoLoiTableThongKe() {
    presentNotification("error", "Lỗi", "Lỗi load table thống kê!");
}

function thongBaoLoiGetPhieuRenLuyen() {
    presentNotification("error", "Lỗi", "Lỗi get thông tin phiếu rèn luyện!");
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
        htmlData += "<option value='tatcalop'> Tất cả lớp </option>";
    var result = callReadAPI(urlAPI, thongBaoLoiCombobox);
    // console.log(result);
    if(result == null)
        return;
    // console.log(result);
    $.each(result, function(index) {
        for (var i=0;i<result[index].length;i++) {
            if(urlAPI == urlapi_khoa_read){
                if(getCookie("quyen") != "khoa") {
                    htmlData += "<option value='" + result[index][i].maKhoa + "'>" 
                        + result[index][i].tenKhoa + "</option>";
                } else {
                    if (result[index][i].taiKhoanKhoa == getCookie("taiKhoan")) {
                        htmlData += "<option value='" + result[index][i].maKhoa + "'>" 
                            + result[index][i].tenKhoa + "</option>";
                    }
                }
            }
                
            else
                htmlData += "<option value='" + result[index][i].maLop + "'>" 
                    + result[index][i].maLop + "</option>";
            
        }
    });
    $(selector).append(htmlData);
}

function getSoLanYeuKemLienTiep(result) {
    var soLanYeuKemLienTiep = 0;
    var hocKyXet = null;
    var hocKyXetTiepTheo = null;
    var namHocXet = null;
    var namHocTruoc = null;
    var namHocTruocTiepTheo = null;
    var namHocSau = null;
    var namHocSauTiepTheo = null;
    var namHocXetTiepTheo = null;
    var namHocArr = null;

    // console.log(result);

    $.each(result, function(index) {
        for (var i=0;i<result[index].length;i++) {
            if(result[index][i].diemTongCong < 50) {
                //console.log(result[index][i].namHocXet);
                hocKyXet = Number(result[index][i].hocKyXet);
                hocKyXetTiepTheo = hocKyXet + 1;
                if(hocKyXetTiepTheo > 2) {
                    hocKyXetTiepTheo = 1;
                    namHocArr = result[index][i].namHocXet.split("-");
                    namHocTruoc = Number(namHocArr[0]);
                    namHocTruocTiepTheo = namHocTruoc + 1;
                    namHocSau = Number(namHocArr[1]);
                    namHocSauTiepTheo = namHocSau + 1;
                    namHocXetTiepTheo = namHocTruocTiepTheo + "-" + namHocSauTiepTheo;
                } else {
                    hocKyXetTiepTheo = 2;
                    namHocXetTiepTheo = result[index][i].namHocXet;
                }
                //hocKyXetTiepTheo = (hocKyXetTiepTheo > 2) ? 1 : 2;
                

                $.each(result, function(index2) {
                    for (var j=0;j<result[index2].length;j++) {
                        // console.log(result[index][i].maSinhVien + ": " + result[index][i].diemTongCong + "-" + result[index2][j].diemTongCong + " | " + soLanYeuKemLienTiep);
                        // console.log("hoc ky tiep theo: " + hocKyXetTiepTheo + " | nam hoc tiep theo: " + namHocXetTiepTheo);
                        if(result[index2][j].namHocXet == namHocXetTiepTheo
                            &&
                            result[index2][j].hocKyXet == hocKyXetTiepTheo
                            &&
                            result[index2][j].diemTongCong < 50)

                            soLanYeuKemLienTiep++;
                    }
                });
            }
        }
    });

    return soLanYeuKemLienTiep;
}

function loadTableThongKe() {
    $("#tbodyThongKe tr").remove();
    var maLop = $("#select_Lop").find('option:selected').val();
    var maKhoa = $("#select_Khoa").find('option:selected').val();
    var result = null;
    var hocKyXet = null;
    var namHocXet = null;
    var soThuTuYeuKem = null;
    var soLanYeuKemLienTiep = null;
    if(maLop == null) {
        presentNotification("error", "Lỗi", "Không tìm thấy lớp để thống kê!");
        return;
    }
    if(maLop == "tatcalop") {
        result = callReadAPI(urlapi_thongkecanhcao_readAll + "?maKhoa=" + maKhoa, thongBaoLoiRong);
        if(result == null) {
            var htmlData = "<tr>\
                                <td colspan='9' class='text-center'>\
                                    <p class='mt-4'>Không tìm thấy kết quả.</p>\
                                </td>\
                            </tr>";
            $("#tbodyThongKe").html(htmlData);            
        } else {
            $.each(result, function(index) {
                for (var i=0;i<result[index].length;i++) {
                    var result_phieuRenLuyen = callReadAPI(urlapi_phieurenluyen_details_read_MaSV + result[index][i].maSinhVien, thongBaoLoiGetPhieuRenLuyen);
                    soLanYeuKemLienTiep = getSoLanYeuKemLienTiep(result_phieuRenLuyen);
                    result[index][i].soLanYeuKemLienTiep = soLanYeuKemLienTiep;
                    if(soLanYeuKemLienTiep >=2) 
                        result[index][i].tinhTrang = "Đình chỉ học";
                    else if(soLanYeuKemLienTiep == 1)
                        result[index][i].tinhTrang = "Tạm ngưng học 1 học kỳ";
                        else if(soLanYeuKemLienTiep == 0 && result[index][i].soLanYeuKem > 0)
                            result[index][i].tinhTrang = "Cảnh cáo điểm rèn luyện";
                            else
                                result[index][i].tinhTrang = "";
                }
            });
    
            $("#idPhanTrangThongKe").pagination({
                dataSource: result["sinhvien"],
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
                                        <td>" + data[i].ngaySinh + "</td>\
                                        <td>" + data[i].maLop + "</td>\
                                        <td>" + (Number(data[i].totNghiep) == 0 ? "Chưa tốt nghiệp" : "Đã tốt nghiệp") + "</td>\
                                        <td>" + data[i].soLanYeuKem + "</td>\
                                        <td>" + data[i].soLanYeuKemLienTiep + " </td>\
                                        <td>" + data[i].tinhTrang + " </td>\
                                        <td>\
                                            <button type='button' class='btn btn-success btn_xemChiTiet' style='color: white;'\
                                            data-bs-toggle='modal' data-bs-target='#danhSachPhieuDiemRenLuyenModal'\
                                            data-id='" + data[i].maSinhVien + "' data-hoten='" + 
                                                data[i].hoTenSinhVien + "'> Danh sách phiếu rèn luyện </button>\
                                        </td>\
                                    </tr>";
                        
                    }
    
                    $("#tbodyThongKe").html(htmlData);
                },
            });
        }
        return;
    }
    result = callReadAPI(urlapi_thongkecanhcao_read + "?maLop=" + maLop, thongBaoLoiRong);
    // var htmlData = "";
    
    // console.log(result);
    if(result != null) {
        $.each(result, function(index) {
            for (var i=0;i<result[index].length;i++) {
                var result_phieuRenLuyen = callReadAPI(urlapi_phieurenluyen_details_read_MaSV + result[index][i].maSinhVien, thongBaoLoiGetPhieuRenLuyen);
                soLanYeuKemLienTiep = getSoLanYeuKemLienTiep(result_phieuRenLuyen);
                result[index][i].soLanYeuKemLienTiep = soLanYeuKemLienTiep;
                // console.log("Số lần điểm yếu kém liên tiếp của sinh viên " + result[index][i].maSinhVien + " là: " + soLanYeuKemLienTiep);
            }
        });
    
        var result_KhongYeuKem = callReadAPI(urlapi_thongkecanhcao_khongyeukem_read + "?maLop=" + maLop, thongBaoLoiRong);
        soThuTuYeuKem = result["sinhvien"].length;
        // console.log(result);
        if(result_KhongYeuKem != null) {
            $.each(result_KhongYeuKem, function(index) {
                for (var i=0;i<result_KhongYeuKem[index].length;i++) {
                    soThuTuYeuKem++;
                    result_KhongYeuKem[index][i].soThuTu = soThuTuYeuKem;
                    result_KhongYeuKem[index][i].soLanYeuKem = 0;
                    result_KhongYeuKem[index][i].soLanYeuKemLienTiep = 0;
                }
            });
            $.each(result_KhongYeuKem, function(index_KhongYeuKem) {
                for (var i=0;i<result_KhongYeuKem[index_KhongYeuKem].length;i++) {
                    result["sinhvien"].push(result_KhongYeuKem[index_KhongYeuKem][i]);
                }
            });
            
        }

        $.each(result, function(index) {
            for (var i=0;i<result[index].length;i++) {
                if(result[index][i].soLanYeuKemLienTiep >=2) 
                    result[index][i].tinhTrang = "Đình chỉ học";
                else if(result[index][i].soLanYeuKemLienTiep == 1)
                    result[index][i].tinhTrang = "Tạm ngưng học 1 học kỳ";
                    else if(result[index][i].soLanYeuKemLienTiep == 0 && result[index][i].soLanYeuKem > 0)
                        result[index][i].tinhTrang = "Cảnh cáo điểm rèn luyện";
                        else
                            result[index][i].tinhTrang = "";
            }
        });
        

        $("#idPhanTrangThongKe").pagination({
            dataSource: result["sinhvien"],
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
                                    <td>" + data[i].ngaySinh + "</td>\
                                    <td>" + data[i].maLop + "</td>\
                                    <td>" + (Number(data[i].totNghiep) == 0 ? "Chưa tốt nghiệp" : "Đã tốt nghiệp") + "</td>\
                                    <td>" + data[i].soLanYeuKem + "</td>\
                                    <td>" + data[i].soLanYeuKemLienTiep + " </td>\
                                    <td>" + data[i].tinhTrang + " </td>\
                                    <td>\
                                        <button type='button' class='btn btn-success btn_xemChiTiet' style='color: white;'\
                                        data-bs-toggle='modal' data-bs-target='#danhSachPhieuDiemRenLuyenModal'\
                                        data-id='" + data[i].maSinhVien + "' data-hoten='" + 
                                            data[i].hoTenSinhVien + "'> Danh sách phiếu rèn luyện </button>\
                                    </td>\
                                </tr>";
                    
                }

                $("#tbodyThongKe").html(htmlData);
            },
        });
    
        
    } else {
        var result = callReadAPI(urlapi_thongkecanhcao_khongyeukem_read + "?maLop=" + maLop, thongBaoLoiRong);
        if(result == null) {
            var htmlData = "<tr>\
                            <td colspan='9' class='text-center'>\
                                <p class='mt-4'>Không tìm thấy kết quả.</p>\
                            </td>\
                        </tr>";
            $("#tbodyThongKe").append(htmlData);
            return;
        }
        $.each(result, function(index) {
            for (var i=0;i<result[index].length;i++) {
                result[index][i].soLanYeuKem = 0;
                result[index][i].soLanYeuKemLienTiep = 0;
                result[index][i].tinhTrang = "";
            }
        });

        $("#idPhanTrangThongKe").pagination({
            dataSource: result["sinhvien"],
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
                                    <td>" + data[i].ngaySinh + "</td>\
                                    <td>" + data[i].maLop + "</td>\
                                    <td>" + (Number(data[i].totNghiep) == 0 ? "Chưa tốt nghiệp" : "Đã tốt nghiệp") + "</td>\
                                    <td>" + data[i].soLanYeuKem + "</td>\
                                    <td>" + data[i].soLanYeuKemLienTiep + " </td>\
                                    <td>" + data[i].tinhTrang + " </td>\
                                    <td>\
                                        <button type='button' class='btn btn-success btn_xemChiTiet' style='color: white;'\
                                        data-bs-toggle='modal' data-bs-target='#danhSachPhieuDiemRenLuyenModal'\
                                        data-id='" + data[i].maSinhVien + "' data-hoten='" + 
                                            data[i].hoTenSinhVien + "'> Danh sách phiếu rèn luyện </button>\
                                    </td>\
                                </tr>";
                    
                }

                $("#tbodyThongKe").html(htmlData);
            },
        });

        // $.each(result, function(index) {
        //     for (var i=0;i<result[index].length;i++) {
        //         htmlData += "<tr> \
        //                         <td>" + (i+1) + "</td>\
        //                         <td>" + result[index][i].maSinhVien + "</td>\
        //                         <td>" + result[index][i].hoTenSinhVien + "</td>\
        //                         <td>" + result[index][i].ngaySinh + "</td>\
        //                         <td>" + result[index][i].maLop + "</td>\
        //                         <td>" + (Number(result[index][i].totNghiep) == 0 ? "Chưa tốt nghiệp" : "Đã tốt nghiệp") + "</td>\
        //                         <td>" + result[index][i].soLanYeuKem + "</td>\
        //                         <td>" + result[index][i].soLanYeuKemLienTiep + " </td>\
        //                         <td>\
        //                             <button type='button' class='btn btn-success btn_xemChiTiet' style='color: white;'\
        //                             data-bs-toggle='modal' data-bs-target='#danhSachPhieuDiemRenLuyenModal'\
        //                             data-id='" + result[index][i].maSinhVien + "' data-hoten='"+ result[index][i].hoTenSinhVien
        //                                 +"'> Danh sách phiếu rèn luyện </button>\
        //                         </td>\
        //                     </tr>";
        //     }
        // });
    
        // $("#tbodyThongKe").append(htmlData);
    }
    
    
    //     return;
    // $.each(result, function(index) {
    //     for (var i=0;i<result[index].length;i++) {
    //         htmlData += "<tr> \
    //                         <td>" + soThuTuTiepTheo + "</td>\
    //                         <td>" + result[index][i].maSinhVien + "</td>\
    //                         <td>" + result[index][i].hoTenSinhVien + "</td>\
    //                         <td>" + result[index][i].ngaySinh + "</td>\
    //                         <td>" + result[index][i].maLop + "</td>\
    //                         <td>" + (Number(result[index][i].totNghiep) == 0 ? "Chưa tốt nghiệp" : "Đã tốt nghiệp") + "</td>\
    //                         <td>" + 0 + "</td>\
    //                         <td>" + 0 + " </td>\
    //                         <td>\
    //                             <button type='button' class='btn btn-success btn_xemChiTiet' style='color: white;'\
    //                             data-bs-toggle='modal' data-bs-target='#danhSachPhieuDiemRenLuyenModal'\
    //                             data-id='"
    //                                 + result[index][i].maSinhVien + "'> Xem chi tiết </button>\
    //                         </td>\
    //                     </tr>";
    //         soThuTuTiepTheo++;
    //     }
    // });
    // $("#tbodyThongKe").append(htmlData);
}

function loadDanhSachPhieuRenLuyen(maSinhVien) {
    $("#tbodyDanhSachPhieuRenLuyen tr").remove();
    var result = callReadAPI(urlapi_phieurenluyen_details_read_MaSV + maSinhVien, thongBaoLoiRong);
    var htmlData = "";
    if(result == null) {
        htmlData += "<tr>\
                        <td colspan='9' class='text-center'>\
                            <p class='mt-4'>Không tìm thấy kết quả.</p>\
                        </td>\
                    </tr>"
    } else {
        var style = "";
        $.each(result, function(index) {
            for (var i=0;i<result[index].length;i++) {
                if(result[index][i].diemTongCong < 50)
                    style = " style='color: red;'";
                else
                    style = "";
                htmlData += "<tr> \
                                <td" + style + ">" + result[index][i].soThuTu + "</td>\
                                <td" + style + ">" + result[index][i].maPhieuRenLuyen + "</td>\
                                <td" + style + ">" + result[index][i].diemTongCong + "</td>\
                                <td" + style + ">" + result[index][i].hocKyXet + "</td>\
                                <td" + style + ">" + result[index][i].namHocXet + "</td>\
                                <td" + style + ">" + result[index][i].xepLoai + "</td>\
                            </tr>";
            }
        });
    }
    
    $("#tbodyDanhSachPhieuRenLuyen").append(htmlData);
}