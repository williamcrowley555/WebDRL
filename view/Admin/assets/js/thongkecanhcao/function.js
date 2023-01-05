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

var tableThongKeYeuTitle = [
    "STT",
    "Mã số sinh viên",
    "Họ tên sinh viên",
    "Ngày sinh",
    "Lớp",
    "Tốt nghiệp",
    "Số lần xếp loại yếu",
    "Số lần xếp loại yếu liên tiếp"
];

var tableThongKeKemTitle = [
    "STT",
    "Mã số sinh viên",
    "Họ tên sinh viên",
    "Ngày sinh",
    "Lớp",
    "Tốt nghiệp",
    "Số lần xếp loại kém",
    "Số lần xếp loại kém liên tiếp"
];

var tableDanhSachPhieuRenLuyen = [
    "STT",
    "Mã phiếu",
    "Điểm tổng cộng",
    "Học kỳ",
    "Năm học",
    "Xếp loại",    
];

var tableTitle = null;

var tableThongKeCanhCao = null;
var tmpTableThongKeCanhCao = [];

var maLopToanCuc = null;
var maKhoaToanCuc = null;
var exportType = null;

function getMaLopToanCuc(maLop) {
    maLopToanCuc = maLop;
}

function getMaKhoaToanCuc(maKhoa) {
    maKhoaToanCuc = maKhoa;
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
    if(result == null)
        return;
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

function getSoLanYeuLienTiep(result) {
    var soLanYeuLienTiep = 0;
    var hocKyXet = null;
    var hocKyXetTiepTheo = null;
    var namHocXet = null;
    var namHocTruoc = null;
    var namHocTruocTiepTheo = null;
    var namHocSau = null;
    var namHocSauTiepTheo = null;
    var namHocXetTiepTheo = null;
    var namHocArr = null;

    $.each(result, function(index) {
        for (var i=0;i<result[index].length;i++) {
            if(result[index][i].diemTongCong < 50 && result[index][i].diemTongCong >= 35) {
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
                        if(result[index2][j].namHocXet == namHocXetTiepTheo
                            &&
                            result[index2][j].hocKyXet == hocKyXetTiepTheo
                            &&
                            result[index2][j].diemTongCong < 50
                            &&
                            result[index2][j].diemTongCong >= 35)

                            soLanYeuLienTiep++;
                    }
                });
            }
        }
    });

    return soLanYeuLienTiep;
}

function getSoLanKemLienTiep(result) {
    var soLanKemLienTiep = 0;
    var hocKyXet = null;
    var hocKyXetTiepTheo = null;
    var namHocXet = null;
    var namHocTruoc = null;
    var namHocTruocTiepTheo = null;
    var namHocSau = null;
    var namHocSauTiepTheo = null;
    var namHocXetTiepTheo = null;
    var namHocArr = null;

    $.each(result, function(index) {
        for (var i=0;i<result[index].length;i++) {
            if(result[index][i].diemTongCong < 35) {
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
                        if(result[index2][j].namHocXet == namHocXetTiepTheo
                            &&
                            result[index2][j].hocKyXet == hocKyXetTiepTheo
                            &&
                            result[index2][j].diemTongCong < 35)

                            soLanKemLienTiep++;
                    }
                });
            }
        }
    });

    return soLanKemLienTiep;
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

    $.each(result, function(index) {
        for (var i=0;i<result[index].length;i++) {
            if(result[index][i].diemTongCong < 50) {
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

function filterTableYeu() {
    var maLop = maLopToanCuc;
    var maKhoa = maKhoaToanCuc;
    var soLanYeuLienTiep = null;
    var result = null;
    if(maLop == "tatcalop") {
        result = callReadAPI(urlapi_thongkecanhcao_readAllYeu + "?maKhoa=" + maKhoa, thongBaoLoiRong);
        $.each(result, function(index) {
            for (var i=0;i<result[index].length;i++) {
                var result_phieuRenLuyen = callReadAPI(urlapi_phieurenluyen_details_read_MaSV + result[index][i].maSinhVien, thongBaoLoiGetPhieuRenLuyen);
                soLanYeuLienTiep = getSoLanYeuLienTiep(result_phieuRenLuyen);
                result[index][i].soLanYeuLienTiep = soLanYeuLienTiep;
            }
        });
    } else {
        result = callReadAPI(urlapi_thongkecanhcao_readYeu + "?maLop=" + maLop, thongBaoLoiRong);
        $.each(result, function(index) {
            for (var i=0;i<result[index].length;i++) {
                var result_phieuRenLuyen = callReadAPI(urlapi_phieurenluyen_details_read_MaSV + result[index][i].maSinhVien, thongBaoLoiGetPhieuRenLuyen);
                soLanYeuLienTiep = getSoLanYeuLienTiep(result_phieuRenLuyen);
                result[index][i].soLanYeuLienTiep = soLanYeuLienTiep;
            }
        });
    }
    return result;
}

function filterTableKem() {
    var maLop = maLopToanCuc;
    var maKhoa = maKhoaToanCuc;
    var soLanKemLienTiep = null;
    var result = null;
    if(maLop == "tatcalop") {
        result = callReadAPI(urlapi_thongkecanhcao_readAllKem + "?maKhoa=" + maKhoa, thongBaoLoiRong);
        $.each(result, function(index) {
            for (var i=0;i<result[index].length;i++) {
                var result_phieuRenLuyen = callReadAPI(urlapi_phieurenluyen_details_read_MaSV + result[index][i].maSinhVien, thongBaoLoiGetPhieuRenLuyen);
                soLanKemLienTiep = getSoLanKemLienTiep(result_phieuRenLuyen);
                result[index][i].soLanKemLienTiep = soLanKemLienTiep;
            }
        });
    } else {
        result = callReadAPI(urlapi_thongkecanhcao_readKem + "?maLop=" + maLop, thongBaoLoiRong);
        $.each(result, function(index) {
            for (var i=0;i<result[index].length;i++) {
                var result_phieuRenLuyen = callReadAPI(urlapi_phieurenluyen_details_read_MaSV + result[index][i].maSinhVien, thongBaoLoiGetPhieuRenLuyen);
                soLanKemLienTiep = getSoLanKemLienTiep(result_phieuRenLuyen);
                result[index][i].soLanKemLienTiep = soLanKemLienTiep;
            }
        });
    }
    return result;
}

function loadFilterTableThongKeCanhCao(trangThai) {
    tmpTableThongKeCanhCao = [];
    $("#tableThongKe>thead>tr").empty();
    $("#idPhanTrangThongKe").empty();
    if(trangThai == "all") {
        tableThongKeTitle.forEach(function(title, index) {
            $("#tableThongKe>thead>tr").append(`<th class='cell'>${title}</th>`);
    
            if(index == tableThongKeTitle.length - 1) {
                $("#tableThongKe>thead>tr").append(`<th class='cell' width='150'>Hành động</th>`);
            }
        });

        result = tableThongKeCanhCao;
        exportType = "all";
        tableTitle = tableThongKeTitle;

        $.each(result, function(index) {
            for (let i=0;i<result[index].length;i++) {
                tmpTableThongKeCanhCao.push({
                    soThuTu: result[index][i].soThuTu,
                    maSinhVien: result[index][i].maSinhVien,
                    hoTenSinhVien: result[index][i].hoTenSinhVien,
                    ngaySinh: result[index][i].ngaySinh,
                    maLop: result[index][i].maLop,
                    totNghiep: (Number(result[index][i].totNghiep) == 0 ? "Chưa tốt nghiệp" : "Đã tốt nghiệp"),
                    soLanYeuKem: result[index][i].soLanYeuKem,
                    soLanYeuKemLienTiep: result[index][i].soLanYeuKemLienTiep,
                });
            }
        });

        if(result == null) {
            var htmlData = "<tr>\
                                <td colspan='9' class='text-center'>\
                                    <p class='mt-4'>Không tìm thấy kết quả.</p>\
                                </td>\
                            </tr>";
            $("#tbodyThongKe").html(htmlData);
            return;
        }

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
                                    <td>\
                                        <button type='button' class='btn btn-success btn_xemChiTiet' style='color: white;'\
                                        data-bs-toggle='modal' data-bs-target='#danhSachPhieuDiemRenLuyenModal'\
                                        data-id='" + data[i].maSinhVien + "' data-hoten='" + 
                                            data[i].hoTenSinhVien + "' + data-prl='all'> Danh sách phiếu rèn luyện </button>\
                                    </td>\
                                </tr>";
                    
                }

                $("#tbodyThongKe").html(htmlData);
            },
        });
        return;
    }

    if(trangThai == "yeu") {
        tableThongKeYeuTitle.forEach(function(title, index) {
            $("#tableThongKe>thead>tr").append(`<th class='cell'>${title}</th>`);
    
            if(index == tableThongKeYeuTitle.length - 1) {
                $("#tableThongKe>thead>tr").append(`<th class='cell' width='150'>Hành động</th>`);
            }
        });

        result = filterTableYeu();
        exportType = "yeu";
        tableTitle = tableThongKeYeuTitle;

        $.each(result, function(index) {
            for (let i=0;i<result[index].length;i++) {
                tmpTableThongKeCanhCao.push({
                    soThuTu: result[index][i].soThuTu,
                    maSinhVien: result[index][i].maSinhVien,
                    hoTenSinhVien: result[index][i].hoTenSinhVien,
                    ngaySinh: result[index][i].ngaySinh,
                    maLop: result[index][i].maLop,
                    totNghiep: (Number(result[index][i].totNghiep) == 0 ? "Chưa tốt nghiệp" : "Đã tốt nghiệp"),
                    soLanYeu: result[index][i].soLanYeu,
                    soLanYeuLienTiep: result[index][i].soLanYeuLienTiep,
                });
            }
        });

        if(result == null) {
            var htmlData = "<tr>\
                                <td colspan='9' class='text-center'>\
                                    <p class='mt-4'>Không tìm thấy kết quả.</p>\
                                </td>\
                            </tr>";
            $("#tbodyThongKe").html(htmlData);
            return;
        }

        $("#tbodyThongKe tr").remove();

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
                                    <td>" + data[i].soLanYeu + "</td>\
                                    <td>" + data[i].soLanYeuLienTiep + " </td>\
                                    <td>\
                                        <button type='button' class='btn btn-success btn_xemChiTiet' style='color: white;'\
                                        data-bs-toggle='modal' data-bs-target='#danhSachPhieuDiemRenLuyenModal'\
                                        data-id='" + data[i].maSinhVien + "' data-hoten='" + 
                                            data[i].hoTenSinhVien + "' + data-prl='yeu'> Danh sách phiếu rèn luyện </button>\
                                    </td>\
                                </tr>";
                    
                }

                $("#tbodyThongKe").html(htmlData);
            },
        });
        return;
    }

    if(trangThai == "kem") {
        tableThongKeKemTitle.forEach(function(title, index) {
            $("#tableThongKe>thead>tr").append(`<th class='cell'>${title}</th>`);
    
            if(index == tableThongKeKemTitle.length - 1) {
                $("#tableThongKe>thead>tr").append(`<th class='cell' width='150'>Hành động</th>`);
            }
        });
        
        result = filterTableKem();
        exportType = "kem";
        tableTitle = tableThongKeKemTitle;

        $.each(result, function(index) {
            for (let i=0;i<result[index].length;i++) {
                tmpTableThongKeCanhCao.push({
                    soThuTu: result[index][i].soThuTu,
                    maSinhVien: result[index][i].maSinhVien,
                    hoTenSinhVien: result[index][i].hoTenSinhVien,
                    ngaySinh: result[index][i].ngaySinh,
                    maLop: result[index][i].maLop,
                    totNghiep: (Number(result[index][i].totNghiep) == 0 ? "Chưa tốt nghiệp" : "Đã tốt nghiệp"),
                    soLanKem: result[index][i].soLanKem,
                    soLanKemLienTiep: result[index][i].soLanKemLienTiep,
                });
            }
        });

        if(result == null) {
            var htmlData = "<tr>\
                                <td colspan='9' class='text-center'>\
                                    <p class='mt-4'>Không tìm thấy kết quả.</p>\
                                </td>\
                            </tr>";
            $("#tbodyThongKe").html(htmlData);
            return;
        }

        $("#tbodyThongKe tr").remove();

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
                                    <td>" + data[i].soLanKem + "</td>\
                                    <td>" + data[i].soLanKemLienTiep + " </td>\
                                    <td>\
                                        <button type='button' class='btn btn-success btn_xemChiTiet' style='color: white;'\
                                        data-bs-toggle='modal' data-bs-target='#danhSachPhieuDiemRenLuyenModal'\
                                        data-id='" + data[i].maSinhVien + "' data-hoten='" + 
                                            data[i].hoTenSinhVien + "' + data-prl='kem'> Danh sách phiếu rèn luyện </button>\
                                    </td>\
                                </tr>";
                    
                }

                $("#tbodyThongKe").html(htmlData);
            },
        });
        return;
    }
}

function loadTableThongKe() {
    tmpTableThongKeCanhCao = [];
    $("#tbodyThongKe tr").remove();
    $("#idPhanTrangThongKe").empty();
    var maLop = maLopToanCuc;
    var maKhoa = maKhoaToanCuc;
    var result = null;
    var hocKyXet = null;
    var namHocXet = null;
    var soThuTuYeuKem = null;
    var soLanYeuKemLienTiep = null;
    if(maLop == null) {
        presentNotification("error", "Lỗi", "Không tìm thấy lớp để thống kê!");
        return;
    }

    $("#select_TrangThai").empty();
    $("#select_TrangThai").append("<option value='all' selected>Tất cả</option>\
                                <option value='yeu'>Yếu</option>\
                                <option value='kem'>Kém</option>");

    if(maLop == "tatcalop") {
        result = callReadAPI(urlapi_thongkecanhcao_readAll + "?maKhoa=" + maKhoa, thongBaoLoiRong);
        tableThongKeCanhCao = result;
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
                }
            });

            tableThongKeCanhCao = result;
            exportType = "all";
            tableTitle = tableThongKeTitle;

            $.each(result, function(index) {
                for (let i=0;i<result[index].length;i++) {
                    tmpTableThongKeCanhCao.push({
                        soThuTu: result[index][i].soThuTu,
                        maSinhVien: result[index][i].maSinhVien,
                        hoTenSinhVien: result[index][i].hoTenSinhVien,
                        ngaySinh: result[index][i].ngaySinh,
                        maLop: result[index][i].maLop,
                        totNghiep: (Number(result[index][i].totNghiep) == 0 ? "Chưa tốt nghiệp" : "Đã tốt nghiệp"),
                        soLanYeuKem: result[index][i].soLanYeuKem,
                        soLanYeuKemLienTiep: result[index][i].soLanYeuKemLienTiep,
                    });
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
                                        <td>\
                                            <button type='button' class='btn btn-success btn_xemChiTiet' style='color: white;'\
                                            data-bs-toggle='modal' data-bs-target='#danhSachPhieuDiemRenLuyenModal'\
                                            data-id='" + data[i].maSinhVien + "' data-hoten='" + 
                                                data[i].hoTenSinhVien + "' + data-prl='all'> Danh sách phiếu rèn luyện </button>\
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
    
    if(result != null) {
        $.each(result, function(index) {
            for (var i=0;i<result[index].length;i++) {
                var result_phieuRenLuyen = callReadAPI(urlapi_phieurenluyen_details_read_MaSV + result[index][i].maSinhVien, thongBaoLoiGetPhieuRenLuyen);
                soLanYeuKemLienTiep = getSoLanYeuKemLienTiep(result_phieuRenLuyen);
                result[index][i].soLanYeuKemLienTiep = soLanYeuKemLienTiep;
            }
        });
    
        var result_KhongYeuKem = callReadAPI(urlapi_thongkecanhcao_khongyeukem_read + "?maLop=" + maLop, thongBaoLoiRong);
        soThuTuYeuKem = result["sinhvien"].length;
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

    
        tableThongKeCanhCao = result;
        exportType = "all";
        tableTitle = tableThongKeTitle;
        
        $.each(result, function(index) {
            for (let i=0;i<result[index].length;i++) {
                tmpTableThongKeCanhCao.push({
                    soThuTu: result[index][i].soThuTu,
                    maSinhVien: result[index][i].maSinhVien,
                    hoTenSinhVien: result[index][i].hoTenSinhVien,
                    ngaySinh: result[index][i].ngaySinh,
                    maLop: result[index][i].maLop,
                    totNghiep: (Number(result[index][i].totNghiep) == 0 ? "Chưa tốt nghiệp" : "Đã tốt nghiệp"),
                    soLanYeuKem: result[index][i].soLanYeuKem,
                    soLanYeuKemLienTiep: result[index][i].soLanYeuKemLienTiep,
                });
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
                                    <td>\
                                        <button type='button' class='btn btn-success btn_xemChiTiet' style='color: white;'\
                                        data-bs-toggle='modal' data-bs-target='#danhSachPhieuDiemRenLuyenModal'\
                                        data-id='" + data[i].maSinhVien + "' data-hoten='" + 
                                            data[i].hoTenSinhVien + "' + data-prl='all'> Danh sách phiếu rèn luyện </button>\
                                    </td>\
                                </tr>";
                    
                }

                $("#tbodyThongKe").html(htmlData);
            },
        });
    
        
    } else {
        var result = callReadAPI(urlapi_thongkecanhcao_khongyeukem_read + "?maLop=" + maLop, thongBaoLoiRong);
        tableThongKeCanhCao = result;
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
            }
        });

        tableThongKeCanhCao = result;
        exportType = "all";
        tableTitle = tableThongKeTitle;

        $.each(result, function(index) {
            for (let i=0;i<result[index].length;i++) {
                tmpTableThongKeCanhCao.push({
                    soThuTu: result[index][i].soThuTu,
                    maSinhVien: result[index][i].maSinhVien,
                    hoTenSinhVien: result[index][i].hoTenSinhVien,
                    ngaySinh: result[index][i].ngaySinh,
                    maLop: result[index][i].maLop,
                    totNghiep: (Number(result[index][i].totNghiep) == 0 ? "Chưa tốt nghiệp" : "Đã tốt nghiệp"),
                    soLanYeuKem: result[index][i].soLanYeuKem,
                    soLanYeuKemLienTiep: result[index][i].soLanYeuKemLienTiep,
                });
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
                                    <td>\
                                        <button type='button' class='btn btn-success btn_xemChiTiet' style='color: white;'\
                                        data-bs-toggle='modal' data-bs-target='#danhSachPhieuDiemRenLuyenModal'\
                                        data-id='" + data[i].maSinhVien + "' data-hoten='" + 
                                            data[i].hoTenSinhVien + "' + data-prl='all'> Danh sách phiếu rèn luyện </button>\
                                    </td>\
                                </tr>";
                    
                }

                $("#tbodyThongKe").html(htmlData);
            },
        });
    }
    
}

function loadDanhSachPhieuRenLuyen(maSinhVien, hienThi) {
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
                if(hienThi == "all") {
                    if(result[index][i].diemTongCong < 50)
                        style = " style='color: red;'";
                    else
                        style = "";
                } else if(hienThi == "yeu") {
                    if(result[index][i].diemTongCong < 50 && result[index][i].diemTongCong >=35)
                        style = " style='color: red;'";
                    else
                        style = "";
                } else {
                    if(result[index][i].diemTongCong < 35)
                        style = " style='color: red;'";
                    else
                        style = "";
                }
                
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