var jwtCookie = getCookie("jwt");

var tableQuanTriVienTitle = [
    "STT",
    "Tài khoản",
    "Họ tên người dùng",
    "Email",
    "Số điện thoại",
    "Quyền",
    "Trạng thái",
];

var tableQuanTriVienContent = [];

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

function checkLoiDangNhap(message) {
    if (message.localeCompare("Vui lòng đăng nhập trước!") == 0) {
        deleteAllCookies();
        location.href = "login.php";
    }
}

function loadComboBoxSelectRole() {
    $("#select_Role option").remove();
    $("#select_Role").append("\
        <option value='tatcaquyen'> Tất cả quyền </option>\
        <option value='admin'> Admin </option>\
        <option value='ctsv'> Cộng tác sinh viên </option>");   
}

function getListQuanTriVien(maQuyen) {
    if (maQuyen != null) {
        if (maQuyen == "tatcaquyen") {
            var htmlData = "";
            var countQuanTriVien = 0;
            $("#id_tbodyQuanTriVien tr").remove();
            $.ajax({
                url: urlapi_admin_read,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: { Authorization: jwtCookie },
                success: function (result) {
                    tableContent = result["admin"];
                    $("#idPhanTrang").pagination({
                        dataSource: result["admin"],
                        pageSize: 5,
                        autoHidePrevious: true,
                        autoHideNext: true,

                        callback: function (data, pagination) {
                            for (let i = 0; i < data.length; i++) {
                            countQuanTriVien += 1;
                            htmlData +=
                                "<tr>\
                                <td class='cell'>" +
                                data[i].soThuTu +
                                "</td>\
                                <td class='cell'><span class='truncate'>" +
                                data[i].taiKhoan +
                                "</span></td>\
                                <td class='cell'>" +
                                data[i].hoTen +
                                "</td>\
                                <td class='cell'>" +
                                data[i].email +
                                "</td>\
                                <td class='cell'>" +
                                data[i].soDienThoai +
                                "</td>\
                                <td class='cell'>" +
                                data[i].quyen +
                                "</td>\
                                <td class='cell'>" +
                                (data[i].kichHoat == 1
                                ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Kích hoạt</span>"
                                : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Vô hiệu hóa</span>") +
                                "</td>\
                                <td class='cell'><button  type='button' id='id_btnReset' class='btn btn-info btn_DatLaiMatKhau_QuanTriVien' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white; min-width: 137px;' data-id='" +
                                data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                                "' >Đặt lại mật khẩu</button></td>\
                                <td class='cell'>\
                                <button class='btn bg-warning btn_ChinhSua_QuanTriVien' style='color: white; min-width: 95px;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                                data[i].id +  "' data-quyen='" + data[i].quyen +
                                "' >Chỉnh sửa</button>\
                                <td class='cell'>" +
                                (data[i].kichHoat == "0"
                                ? "<button class='btn bg-success btn_KichHoat_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                                data[i].id +  "' data-quyen='" + data[i].quyen +
                                "'>Kích hoạt</button>"
                                : "<button class='btn bg-danger btn_VoHieuHoa_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                                data[i].id +  "' data-quyen='" + data[i].quyen +
                                "'>Vô hiệu hóa</button>") +
                                "</td>\
                                                </tr>";
                            }
                        },
                    });
                },
                error: function (errorMessage) {
                    checkLoiDangNhap(errorMessage.responseJSON.message);

                    tableContent = [];
                    $("#tbodyQuanTriVien").html(htmlData);
                    $("#idPhanTrang").empty();

                    ThongBaoLoi(errorMessage.responseJSON.message);
                },
                statusCode: {
                    403: function (xhr) {
                    //deleteAllCookies();
                    //location.href = 'login.php';
                    },
                },
            });
            $.ajax({
                url: urlapi_ctsv_read,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: { Authorization: jwtCookie },
                success: function (result_SV) {
                    tableContent = result_SV["phongcongtacsinhvien"];

                    $("#idPhanTrang").pagination({
                    dataSource: result_SV["phongcongtacsinhvien"],
                    pageSize: 5,
                    autoHidePrevious: true,
                    autoHideNext: true,

                    callback: function (data, pagination) {
                        // htmlData = "<tr></tr>"
                        for (let i = 0; i < data.length; i++) {
                        countQuanTriVien += 1;

                        htmlData +=
                            "<tr>\
                            <td class='cell'>" +
                            countQuanTriVien +
                            "</td>\
                            <td class='cell'><span class='truncate'>" +
                            data[i].taiKhoan +
                            "</span></td>\
                            <td class='cell'>" +
                            data[i].hoTenNhanVien +
                            "</td>\
                            <td class='cell'>" +
                            data[i].email +
                            "</td>\
                            <td class='cell'>" +
                            data[i].sodienthoai +
                            "</td>\
                            <td class='cell'>" +
                            data[i].quyen +
                            "</td>\
                            <td class='cell'>" +
                            (data[i].kichHoat == 1 ? 
                            "<span class='badge bg-success' style='color: white;font-size: inherit;'>Kích hoạt</span>"
                            : 
                            "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Vô hiệu hóa</span>"
                            ) +
                            "</td>\
                            <td class='cell'><button  type='button' id='id_btnReset' class='btn btn-info btn_DatLaiMatKhau_QuanTriVien' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white; min-width: 137px;' data-id='" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "' >Đặt lại mật khẩu</button></td>\
                            <td class='cell'>\
                            <button class='btn bg-warning btn_ChinhSua_QuanTriVien' style='color: white; min-width: 95px;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "' >Chỉnh sửa</button>\
                            <td class='cell'>" +
                            (data[i].kichHoat == "0"
                            ? "<button class='btn bg-success btn_KichHoat_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "'>Kích hoạt</button>"
                            : "<button class='btn bg-danger btn_VoHieuHoa_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "'>Vô hiệu hóa</button>") +
                            "</td>\
                            </tr>";
                        }

                        $("#tbodyQuanTriVien").html(htmlData);
                    },
                    });
                },
                error: function (errorMessage) {
                    checkLoiDangNhap(errorMessage.responseJSON.message);

                    tableContent = [];
                    var htmlData = "";
                    $("#tbodyQuanTriVien").html(htmlData);
                    $("#idPhanTrang").empty();

                    ThongBaoLoi(errorMessage.responseJSON.message);
                },
                statusCode: {
                    403: function (xhr) {
                    //deleteAllCookies();
                    //location.href = 'login.php';
                    },
                },
            });
        } else if (maQuyen == "admin") {
            $("#id_tbodyQuanTriVien tr").remove();
            $.ajax({
                url: urlapi_admin_read,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: { Authorization: jwtCookie },
                success: function (result) {
                    tableContent = result["admin"];

                    $("#idPhanTrang").pagination({
                    dataSource: result["admin"],
                    pageSize: 10,
                    autoHidePrevious: true,
                    autoHideNext: true,

                    callback: function (data, pagination) {
                        var htmlData = "";
                        var countQuanTriVien = 0;

                        for (let i = 0; i < data.length; i++) {
                        countQuanTriVien += 1;

                        htmlData +=
                            "<tr>\
                            <td class='cell'>" +
                            data[i].soThuTu +
                            "</td>\
                            <td class='cell'><span class='truncate'>" +
                            data[i].taiKhoan +
                            "</span></td>\
                            <td class='cell'>" +
                            data[i].hoTen +
                            "</td>\
                            <td class='cell'>" +
                            data[i].email +
                            "</td>\
                            <td class='cell'>" +
                            data[i].soDienThoai +
                            "</td>\
                            <td class='cell'>" +
                            data[i].quyen +
                            "</td>\
                            <td class='cell'>" +
                            (data[i].kichHoat == 1
                            ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Kích hoạt</span>"
                            : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Vô hiệu hóa</span>") +
                            "</td>\
                            <td class='cell'><button  type='button' id='id_btnReset' class='btn btn-info btn_DatLaiMatKhau_QuanTriVien' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white; min-width: 137px;' data-id='" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "' >Đặt lại mật khẩu</button></td>\
                            <td class='cell'>\
                            <button class='btn bg-warning btn_ChinhSua_QuanTriVien' style='color: white; min-width: 95px;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "' >Chỉnh sửa</button>\
                            <td class='cell'>" +
                            (data[i].kichHoat == "0"
                            ? "<button class='btn bg-success btn_KichHoat_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                            data[i].id + "' data-quyen='" + data[i].quyen +
                            "'>Kích hoạt</button>"
                            : "<button class='btn bg-danger btn_VoHieuHoa_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                            data[i].id + "' data-quyen='" + data[i].quyen +
                            "'>Vô hiệu hóa</button>") +
                            "</td>\
                                            </tr>";
                        }

                        $("#tbodyQuanTriVien").html(htmlData);
                    },
                });
            },
            error: function (errorMessage) {
                checkLoiDangNhap(errorMessage.responseJSON.message);

                tableContent = [];
                var htmlData = "";
                $("#tbodyQuanTriVien").html(htmlData);
                $("#idPhanTrang").empty();

                ThongBaoLoi(errorMessage.responseJSON.message);
            },
            statusCode: {
                403: function (xhr) {
                //deleteAllCookies();
                //location.href = 'login.php';
                },
            },
            });
        } else {
            $("#tbody_QuanTriVien tr").remove();
            $.ajax({
                url: urlapi_ctsv_read,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: { Authorization: jwtCookie },
                success: function (result_SV) {
                    tableContent = result_SV["phongcongtacsinhvien"];

                    $("#idPhanTrang").pagination({
                    dataSource: result_SV["phongcongtacsinhvien"],
                    pageSize: 10,
                    autoHidePrevious: true,
                    autoHideNext: true,

                    callback: function (data, pagination) {
                        var htmlData = "";
                        var countCTSV = 0;
                        // htmlData = "<tr></tr>"
                        for (let i = 0; i < data.length; i++) {
                        countCTSV += 1;

                        htmlData +=
                            "<tr>\
                            <td class='cell'>" +
                            data[i].soThuTu +
                            "</td>\
                            <td class='cell'><span class='truncate'>" +
                            data[i].taiKhoan +
                            "</span></td>\
                            <td class='cell'>" +
                            data[i].hoTenNhanVien +
                            "</td>\
                            <td class='cell'>" +
                            data[i].email +
                            "</td>\
                            <td class='cell'>" +
                            data[i].sodienthoai +
                            "</td>\
                            <td class='cell'>" +
                            data[i].quyen +
                            "</td>\
                            <td class='cell'>" +
                            (data[i].kichHoat == 1 ? 
                            "<span class='badge bg-success' style='color: white;font-size: inherit;'>Kích hoạt</span>"
                            : 
                            "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Vô hiệu hóa</span>"
                            ) +
                            "</td>\
                            <td class='cell'><button  type='button' id='id_btnReset' class='btn btn-info btn_DatLaiMatKhau_QuanTriVien' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white; min-width: 137px;' data-id='" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "' >Đặt lại mật khẩu</button></td>\
                            <td class='cell'>\
                            <button class='btn bg-warning btn_ChinhSua_QuanTriVien' style='color: white; min-width: 95px;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "' >Chỉnh sửa</button>\
                            <td class='cell'>" +
                            (data[i].kichHoat == "0"
                            ? "<button class='btn bg-success btn_KichHoat_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "'>Kích hoạt</button>"
                            : "<button class='btn bg-danger btn_VoHieuHoa_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "'>Vô hiệu hóa</button>") +
                            "</td>\
                            </tr>";
                        }

                        $("#tbodyQuanTriVien").html(htmlData);
                    },
                    });
                },
                error: function (errorMessage) {
                    checkLoiDangNhap(errorMessage.responseJSON.message);

                    tableContent = [];
                    var htmlData = "";
                    $("#tbodyQuanTriVien").html(htmlData);
                    $("#idPhanTrang").empty();

                    ThongBaoLoi(errorMessage.responseJSON.message);
                },
                statusCode: {
                    403: function (xhr) {
                    //deleteAllCookies();
                    //location.href = 'login.php';
                    },
                },
            });
        }
    }
}

function timKiemQuanTriVien(searchText, maQuyen) {
    var isSuccessAdmin = true;
    var isSuccessCTSV = true;
    if (maQuyen != null) {
        if (maQuyen == "tatcaquyen") {
            var htmlData = "";
            var countQuanTriVien = 0;
            $("#id_tbodyQuanTriVien tr").remove();
            $.ajax({
                url: urlapi_admin_read_searchText + searchText,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: { Authorization: jwtCookie },
                success: function (result) {
                    tableContent = result["admin"];
                    $("#idPhanTrang").pagination({
                        dataSource: result["admin"],
                        pageSize: 5,
                        autoHidePrevious: true,
                        autoHideNext: true,

                        callback: function (data, pagination) {
                            for (let i = 0; i < data.length; i++) {
                            countQuanTriVien += 1;
                            htmlData +=
                                "<tr>\
                                <td class='cell'>" +
                                data[i].soThuTu +
                                "</td>\
                                <td class='cell'><span class='truncate'>" +
                                data[i].taiKhoan +
                                "</span></td>\
                                <td class='cell'>" +
                                data[i].hoTen +
                                "</td>\
                                <td class='cell'>" +
                                data[i].email +
                                "</td>\
                                <td class='cell'>" +
                                data[i].soDienThoai +
                                "</td>\
                                <td class='cell'>" +
                                data[i].quyen +
                                "</td>\
                                <td class='cell'>" +
                                (data[i].kichHoat == 1
                                ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Kích hoạt</span>"
                                : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Vô hiệu hóa</span>") +
                                "</td>\
                                <td class='cell'><button  type='button' id='id_btnReset' class='btn btn-info btn_DatLaiMatKhau_QuanTriVien' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white; min-width: 137px;' data-id='" +
                                data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                                "' >Đặt lại mật khẩu</button></td>\
                                <td class='cell'>\
                                <button class='btn bg-warning btn_ChinhSua_QuanTriVien' style='color: white; min-width: 95px;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                                data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                                "' >Chỉnh sửa</button>\
                                <td class='cell'>" +
                                (data[i].kichHoat == "0"
                                ? "<button class='btn bg-success btn_KichHoat_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                                data[i].id + "' data-quyen='" + data[i].quyen +
                                "'>Kích hoạt</button>"
                                : "<button class='btn bg-danger btn_VoHieuHoa_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                                data[i].id + "' data-quyen='" + data[i].quyen +
                                "'>Vô hiệu hóa</button>") +
                                "</td>\
                                                </tr>";
                            }
                        },
                    });
                },
                error: function (errorMessage) {
                    checkLoiDangNhap(errorMessage.responseJSON.message);

                    tableContent = [];
                    $("#tbodyQuanTriVien").html(htmlData);
                    $("#idPhanTrang").empty();
                    isSuccessAdmin = false;

                    //ThongBaoLoi(errorMessage.responseJSON.message);
                },
                statusCode: {
                    403: function (xhr) {
                    //deleteAllCookies();
                    //location.href = 'login.php';
                    },
                },
            });
            $.ajax({
                url: urlapi_ctsv_read_searchText + searchText,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: { Authorization: jwtCookie },
                success: function (result_SV) {
                    tableContent = result_SV["phongcongtacsinhvien"];

                    $("#idPhanTrang").pagination({
                    dataSource: result_SV["phongcongtacsinhvien"],
                    pageSize: 5,
                    autoHidePrevious: true,
                    autoHideNext: true,

                    callback: function (data, pagination) {
                        for (let i = 0; i < data.length; i++) {
                        countQuanTriVien += 1;

                        htmlData +=
                            "<tr>\
                            <td class='cell'>" +
                            countQuanTriVien +
                            "</td>\
                            <td class='cell'><span class='truncate'>" +
                            data[i].taiKhoan +
                            "</span></td>\
                            <td class='cell'>" +
                            data[i].hoTenNhanVien +
                            "</td>\
                            <td class='cell'>" +
                            data[i].email +
                            "</td>\
                            <td class='cell'>" +
                            data[i].sodienthoai +
                            "</td>\
                            <td class='cell'>" +
                            data[i].quyen +
                            "</td>\
                            <td class='cell'>" +
                            (data[i].kichHoat == 1 ? 
                            "<span class='badge bg-success' style='color: white;font-size: inherit;'>Kích hoạt</span>"
                            : 
                            "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Vô hiệu hóa</span>"
                            ) +
                            "</td>\
                            <td class='cell'><button  type='button' id='id_btnReset' class='btn btn-info btn_DatLaiMatKhau_QuanTriVien' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white; min-width: 137px;' data-id='" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "' >Đặt lại mật khẩu</button></td>\
                            <td class='cell'>\
                            <button class='btn bg-warning btn_ChinhSua_QuanTriVien' style='color: white; min-width: 95px;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "' >Chỉnh sửa</button>\
                            <td class='cell'>" +
                            (data[i].kichHoat == "0"
                            ? "<button class='btn bg-success btn_KichHoat_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                            data[i].id + "' data-quyen='" + data[i].quyen +
                            "'>Kích hoạt</button>"
                            : "<button class='btn bg-danger btn_VoHieuHoa_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                            data[i].id + "' data-quyen='" + data[i].quyen +
                            "'>Vô hiệu hóa</button>") +
                            "</td>\
                            </tr>";
                        }
                    },
                    });
                },
                error: function (errorMessage) {
                    checkLoiDangNhap(errorMessage.responseJSON.message);
                    isSuccessCTSV = false;
                    tableContent = [];
                    var htmlData = "";
                    $("#tbodyQuanTriVien").html(htmlData);
                    $("#idPhanTrang").empty();
                },
                statusCode: {
                    403: function (xhr) {
                    //deleteAllCookies();
                    //location.href = 'login.php';
                    },
                },
            });
            $("#tbodyQuanTriVien").html(htmlData);
            if(!isSuccessAdmin && !isSuccessCTSV) {
                ThongBaoLoi("Không tìm thấy kết quả!");
            }
        } else if (maQuyen == "admin") {
            $("#id_tbodyQuanTriVien tr").remove();
            $.ajax({
                url: urlapi_admin_read_searchText + searchText,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: { Authorization: jwtCookie },
                success: function (result) {
                    tableContent = result["admin"];

                    $("#idPhanTrang").pagination({
                    dataSource: result["admin"],
                    pageSize: 10,
                    autoHidePrevious: true,
                    autoHideNext: true,

                    callback: function (data, pagination) {
                        var htmlData = "";
                        var countQuanTriVien = 0;

                        for (let i = 0; i < data.length; i++) {
                        countQuanTriVien += 1;

                        htmlData +=
                            "<tr>\
                            <td class='cell'>" +
                            data[i].soThuTu +
                            "</td>\
                            <td class='cell'><span class='truncate'>" +
                            data[i].taiKhoan +
                            "</span></td>\
                            <td class='cell'>" +
                            data[i].hoTen +
                            "</td>\
                            <td class='cell'>" +
                            data[i].email +
                            "</td>\
                            <td class='cell'>" +
                            data[i].soDienThoai +
                            "</td>\
                            <td class='cell'>" +
                            data[i].quyen +
                            "</td>\
                            <td class='cell'>" +
                            (data[i].kichHoat == 1
                            ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Kích hoạt</span>"
                            : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Vô hiệu hóa</span>") +
                            "</td>\
                            <td class='cell'><button  type='button' id='id_btnReset' class='btn btn-info btn_DatLaiMatKhau_QuanTriVien' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white; min-width: 137px;' data-id='" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "' >Đặt lại mật khẩu</button></td>\
                            <td class='cell'>\
                            <button class='btn bg-warning btn_ChinhSua_QuanTriVien' style='color: white; min-width: 95px;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "' >Chỉnh sửa</button>\
                            <td class='cell'>" +
                            (data[i].kichHoat == "0"
                            ? "<button class='btn bg-success btn_KichHoat_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                            data[i].id + "' data-quyen='" + data[i].quyen +
                            "'>Kích hoạt</button>"
                            : "<button class='btn bg-danger btn_VoHieuHoa_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                            data[i].id + "' data-quyen='" + data[i].quyen +
                            "'>Vô hiệu hóa</button>") +
                            "</td>\
                                            </tr>";
                        }

                        $("#tbodyQuanTriVien").html(htmlData);
                    },
                });
            },
            error: function (errorMessage) {
                checkLoiDangNhap(errorMessage.responseJSON.message);

                tableContent = [];
                var htmlData = "";
                
                $("#tbodyQuanTriVien").html(htmlData);
                $("#idPhanTrang").empty();
                ThongBaoLoi(errorMessage.responseJSON.message);
            },
            statusCode: {
                403: function (xhr) {
                //deleteAllCookies();
                //location.href = 'login.php';
                },
            },
            });
        } else {
            $("#tbodyQuanTriVien tr").remove();
            $.ajax({
                url: urlapi_ctsv_read_searchText + searchText,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: { Authorization: jwtCookie },
                success: function (result_SV) {
                    tableContent = result_SV["phongcongtacsinhvien"];

                    $("#idPhanTrang").pagination({
                    dataSource: result_SV["phongcongtacsinhvien"],
                    pageSize: 10,
                    autoHidePrevious: true,
                    autoHideNext: true,

                    callback: function (data, pagination) {
                        var htmlData = "";
                        var countCTSV = 0;
                        // htmlData = "<tr></tr>"
                        for (let i = 0; i < data.length; i++) {
                        countCTSV += 1;

                        htmlData +=
                            "<tr>\
                            <td class='cell'>" +
                            data[i].soThuTu +
                            "</td>\
                            <td class='cell'><span class='truncate'>" +
                            data[i].taiKhoan +
                            "</span></td>\
                            <td class='cell'>" +
                            data[i].hoTenNhanVien +
                            "</td>\
                            <td class='cell'>" +
                            data[i].email +
                            "</td>\
                            <td class='cell'>" +
                            data[i].sodienthoai +
                            "</td>\
                            <td class='cell'>" +
                            data[i].quyen +
                            "</td>\
                            <td class='cell'>" +
                            (data[i].kichHoat == 1 ? 
                            "<span class='badge bg-success' style='color: white;font-size: inherit;'>Kích hoạt</span>"
                            : 
                            "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Vô hiệu hóa</span>"
                            ) +
                            "</td>\
                            <td class='cell'><button  type='button' id='id_btnReset' class='btn btn-info btn_DatLaiMatKhau_QuanTriVien' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white; min-width: 137px;' data-id='" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "' >Đặt lại mật khẩu</button></td>\
                            <td class='cell'>\
                            <button class='btn bg-warning btn_ChinhSua_QuanTriVien' style='color: white; min-width: 95px;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                            data[i].taiKhoan + "' data-quyen='" + data[i].quyen +
                            "' >Chỉnh sửa</button>\
                            <td class='cell'>" +
                            (data[i].kichHoat == "0"
                            ? "<button class='btn bg-success btn_KichHoat_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                            data[i].id + "' data-quyen='" + data[i].quyen +
                            "'>Kích hoạt</button>"
                            : "<button class='btn bg-danger btn_VoHieuHoa_QuanTriVien' style='color: white;width: max-content; margin: 5px;' data-id = '" +
                            data[i].id + "' data-quyen='" + data[i].quyen +
                            "'>Vô hiệu hóa</button>") +
                            "</td>\
                            </tr>";
                        }

                        $("#tbodyQuanTriVien").html(htmlData);
                    },
                    });
                },
                error: function (errorMessage) {
                    checkLoiDangNhap(errorMessage.responseJSON.message);

                    tableContent = [];
                    var htmlData = "";
                    $("#tbodyQuanTriVien").html(htmlData);
                    $("#idPhanTrang").empty();

                    ThongBaoLoi(errorMessage.responseJSON.message);
                },
                statusCode: {
                    403: function (xhr) {
                    //deleteAllCookies();
                    //location.href = 'login.php';
                    },
                },
            });
        }
    }
}

function themMoiQuanTriVien() {
    var _input_taikhoan = $("#input_quantrivien_taikhoan").val();
    var _input_HoTenNguoiDung = $("#input_quantrivien_hotennguoidung").val();
    var _input_Email = $("#input_quantrivien_email").val();
    var _input_sdt = $("#input_quantrivien_sdt").val();
    var _input_quyen = $("#select_quyen_add option:selected").val();
    var _select_kichhoat = $("#select_kichhoat_add option:selected").val();

    if(_input_quyen == "admin") {
        var dataPost = {
            taiKhoan: _input_taikhoan,
            hoTen: _input_HoTenNguoiDung,
            email: _input_Email,
            soDienThoai: _input_sdt,
            quyen: _input_quyen,
            matKhau: _input_taikhoan,
            kichHoat: _select_kichhoat,
        };

        $.ajax({
            url: urlapi_admin_create,
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            data: JSON.stringify(dataPost),
            async: false,
            headers: { Authorization: jwtCookie },
            success: function (result_Create) {
                $("#AddModal").modal("hide");
        
                Swal.fire({
                    icon: "success",
                    title: "Tạo thành công!",
                    text: "Quản trị viên có tài khoản là " + _input_taikhoan + " đã được tạo!",
                    timer: 2000,
                    timerProgressBar: true,
                });
        
                setTimeout(() => {
                    getListQuanTriVien($("#select_Role").val());
                }, 2000);
    
                $("#input_quantrivien_taikhoan").val("");
                $("#input_quantrivien_hotennguoidung").val("");
                $("#input_quantrivien_email").val("");
                $("#input_quantrivien_sdt").val("");
            },
            error: function (errorMessage) {
                checkLoiDangNhap(errorMessage.responseJSON.message);
                Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    text: errorMessage.responseJSON.message,
                    //timer: 5000,
                    timerProgressBar: true,
                });
            },
        });
    } else {
        var dataPost = {
            taiKhoan: _input_taikhoan,
            hoTenNhanVien: _input_HoTenNguoiDung,
            email: _input_Email,
            sodienthoai: _input_sdt,
            quyen: _input_quyen,
            matKhau: _input_taikhoan,
            kichHoat: _select_kichhoat,
        };

        $.ajax({
            url: urlapi_ctsv_create,
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            data: JSON.stringify(dataPost),
            async: false,
            headers: { Authorization: jwtCookie },
            success: function (result_Create) {
                $("#AddModal").modal("hide");
        
                Swal.fire({
                    icon: "success",
                    title: "Tạo thành công!",
                    text: "Quản trị viên có tài khoản là " + _input_taikhoan + " đã được tạo!",
                    timer: 2000,
                    timerProgressBar: true,
                });
        
                setTimeout(() => {
                    getListQuanTriVien($("#select_Role").val());
                }, 2000);
    
                $("#input_quantrivien_taikhoan").val("");
                $("#input_quantrivien_hotennguoidung").val("");
                $("#input_quantrivien_email").val("");
                $("#input_quantrivien_sdt").val("");
            },
            error: function (errorMessage) {
                checkLoiDangNhap(errorMessage.responseJSON.message);
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
}

function datLaiMatKhauQuanTriVien() {
    var taiKhoan_Update = $("#input_MaTaiKhoan_Update").val();
    var quyen_Update = $("#input_Quyen_Update").val();
    var _input_MatKhauMoi = $("#input_MatKhauMoi").val();
    var _input_NhapLaiMatKhauMoi = $("#input_NhapLaiMatKhauMoi").val();
  
    var dataPost_Update = {
        taiKhoan: taiKhoan_Update,
        matKhau: _input_MatKhauMoi
    };

    if(quyen_Update == "Admin") {
        $.ajax({
            url: urlapi_admin_update_matkhau,
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            data: JSON.stringify(dataPost_Update),
            async: false,
            headers: { Authorization: jwtCookie },
            success: function (result_Create) {
                $("#DatLaiMatKhauModal").modal("hide");
                Swal.fire({
                    icon: "success",
                    title: "Đặt lại mật khẩu thành công!",
                    text: "",
                    timer: 2000,
                    timerProgressBar: true,
                });
            },
            error: function (errorMessage) {
                checkLoiDangNhap(errorMessage.responseJSON.message);
                Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    text: errorMessage.responseJSON.message,
                    //timer: 5000,
                    timerProgressBar: true,
                });
            },
        });
    } else {
        $.ajax({
            url: urlapi_ctsv_update_matkhau,
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            data: JSON.stringify(dataPost_Update),
            async: false,
            headers: { Authorization: jwtCookie },
            success: function (result_Create) {
                $("#DatLaiMatKhauModal").modal("hide");
                Swal.fire({
                    icon: "success",
                    title: "Đặt lại mật khẩu thành công!",
                    text: "",
                    timer: 2000,
                    timerProgressBar: true,
                });
            },
            error: function (errorMessage) {
                checkLoiDangNhap(errorMessage.responseJSON.message);
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
}

function loadThongTinChinhSuaQuanTriVien(taiKhoan, quyen) {
    if(quyen == "admin") {
        $.ajax({
            url: urlapi_admin_single_read + taiKhoan,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: false,
            headers: { Authorization: jwtCookie },
            success: function (result_data) {
                console.log("hello 1");
                $("#edit_input_taikhoan").val(result_data.taiKhoan);
                $("#edit_input_hotennguoidung").val(result_data.hoTen);
                $("#edit_input_email").val(result_data.email);
                $("#edit_input_sdt").val(result_data.soDienThoai);
                $("#edit_input_quyen").val(result_data.quyen);
            },
            error: function (errorMessage) {
                //checkLoiDangNhap(errorMessage.responseJSON.message);
                Swal.fire({
                icon: "info",
                title: "Thông báo",
                text: errorMessage.responseJSON.message,
                //timer: 5000,
                timerProgressBar: true,
                });
            },
        });
    } else {
        $.ajax({
            url: urlapi_ctsv_single_read + taiKhoan,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: false,
            headers: { Authorization: jwtCookie },
            success: function (result_data) {
                $("#edit_input_taikhoan").val(result_data.taiKhoan);
                $("#edit_input_hotennguoidung").val(result_data.hoTenNhanVien);
                $("#edit_input_email").val(result_data.email);
                $("#edit_input_sdt").val(result_data.sodienthoai);
                $("#edit_input_quyen").val(result_data.quyen);
            },
            error: function (errorMessage) {
                //checkLoiDangNhap(errorMessage.responseJSON.message);
                Swal.fire({
                icon: "info",
                title: "Thông báo",
                text: errorMessage.responseJSON.message,
                //timer: 5000,
                timerProgressBar: true,
                });
            },
        });
    }
}

function chinhSuaQuanTriVien() {
    var _edit_input_taikhoan = $("#edit_input_taikhoan").val();
    var _edit_input_hoten = $("#edit_input_hotennguoidung").val();
    var _edit_input_email = $("#edit_input_email").val();
    var _edit_input_sdt = $("#edit_input_sdt").val();
    var _edit_input_quyen = $("#edit_input_quyen").val();

    if(_edit_input_quyen == "admin") {
        var dataPost = {
            taiKhoan: _edit_input_taikhoan,
            hoTen: _edit_input_hoten,
            email: _edit_input_email,
            soDienThoai: _edit_input_sdt,
        };

        $.ajax({
            url: urlapi_admin_update,
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            data: JSON.stringify(dataPost),
            async: false,
            headers: { Authorization: jwtCookie },
            success: function (result_update) {
                $("#ChinhSuaModal").modal("hide");

                Swal.fire({
                    icon: "success",
                    title: "Thành công",
                    text: "Chỉnh sửa quản trị viên thành công!",
                    timer: 2000,
                    timerProgressBar: true,
                });

                setTimeout(() => {
                    getListQuanTriVien($("#select_Role").val());
                }, 2000);
            },
            error: function (errorMessage) {
                //checkLoiDangNhap(errorMessage.responseJSON.message);

                Swal.fire({
                icon: "error",
                title: "Lỗi",
                text: errorMessage.responseJSON.message,
                timerProgressBar: true,
                });
            },
        });
    } else {
        var dataPost = {
            taiKhoan: _edit_input_taikhoan,
            hoTenNhanVien: _edit_input_hoten,
            email: _edit_input_email,
            sodienthoai: _edit_input_sdt,
        };

        $.ajax({
            url: urlapi_ctsv_update,
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            data: JSON.stringify(dataPost),
            async: false,
            headers: { Authorization: jwtCookie },
            success: function (result_update) {
                $("#ChinhSuaModal").modal("hide");

                Swal.fire({
                    icon: "success",
                    title: "Thành công",
                    text: "Chỉnh sửa quản trị viên thành công!",
                    timer: 2000,
                    timerProgressBar: true,
                });

                setTimeout(() => {
                    getListQuanTriVien($("#select_Role").val());
                }, 2000);
            },
            error: function (errorMessage) {
                //checkLoiDangNhap(errorMessage.responseJSON.message);

                Swal.fire({
                icon: "error",
                title: "Lỗi",
                text: errorMessage.responseJSON.message,
                timerProgressBar: true,
                });
            },
        });
    }   
}

function kichHoatQuanTriVien(taiKhoan, quyen) {
    Swal.fire({
        title: `Xác nhận kích hoạt quản trị viên này?`,
        showDenyButton: true,
        confirmButtonText: "Xác nhận",
        denyButtonText: `Đóng`,
    }).then((result) => {
        if(result.isConfirmed) {
            if(quyen == "admin") {
                var dataPost = {
                    id: taiKhoan,
                    kichHoat: "1"
                };
                $.ajax({
                    url: urlapi_admin_update_kichhoat,
                    type: "POST",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json",
                    data: JSON.stringify(dataPost),
                    async: false,
                    headers: { Authorization: jwtCookie },
                    success: function (result_update) {
                        Swal.fire({
                            icon: "success",
                            title: "Kích hoạt quản trị viên thành công!",
                            text: "",
                            timer: 2000,
                            timerProgressBar: true,
                        });
            
                        setTimeout(() => {
                            getListQuanTriVien($("#select_Role").val());
                        }, 2000);
                    },
                    error: function (errorMessage) {
                        checkLoiDangNhap(errorMessage.responseJSON.message);
            
                        Swal.fire({
                            icon: "error",
                            title: "Lỗi",
                            text: errorMessage.responseJSON.message,
                            //timer: 5000,
                            timerProgressBar: true,
                        });
                    },
                });
            } else {
                var dataPost = {
                    taiKhoan: taiKhoan,
                    kichHoat: "1"
                };
                $.ajax({
                    url: urlapi_ctsv_update_kichhoat,
                    type: "POST",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json",
                    data: JSON.stringify(dataPost),
                    async: false,
                    headers: { Authorization: jwtCookie },
                    success: function (result_update) {
                        Swal.fire({
                            icon: "success",
                            title: "Kích hoạt hóa quản trị viên thành công!",
                            text: "",
                            timer: 2000,
                            timerProgressBar: true,
                        });
            
                        setTimeout(() => {
                            getListQuanTriVien($("#select_Role").val());
                        }, 2000);
                    },
                    error: function (errorMessage) {
                        checkLoiDangNhap(errorMessage.responseJSON.message);
            
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
        }
    });
}


function voHieuHoaQuanTriVien(taiKhoan, quyen) {
    Swal.fire({
        title: `Xác nhận vô hiệu hóa quản trị viên này?`,
        showDenyButton: true,
        confirmButtonText: "Xác nhận",
        denyButtonText: `Đóng`,
    }).then((result) => {
        if(result.isConfirmed) {
            if(quyen == "admin") {
                var dataPost = {
                    id: taiKhoan,
                    kichHoat: "0"
                };
                $.ajax({
                    url: urlapi_admin_update_kichhoat,
                    type: "POST",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json",
                    data: JSON.stringify(dataPost),
                    async: false,
                    headers: { Authorization: jwtCookie },
                    success: function (result_update) {
                        Swal.fire({
                            icon: "success",
                            title: "Vô hiệu hóa quản trị viên thành công!",
                            text: "",
                            timer: 2000,
                            timerProgressBar: true,
                        });
            
                        setTimeout(() => {
                            getListQuanTriVien($("#select_Role").val());
                        }, 2000);
                    },
                    error: function (errorMessage) {
                        checkLoiDangNhap(errorMessage.responseJSON.message);
            
                        Swal.fire({
                            icon: "error",
                            title: "Lỗi",
                            text: errorMessage.responseJSON.message,
                            //timer: 5000,
                            timerProgressBar: true,
                        });
                    },
                });
            } else {
                var dataPost = {
                    taiKhoan: taiKhoan,
                    kichHoat: "0"
                };
                $.ajax({
                    url: urlapi_ctsv_update_kichhoat,
                    type: "POST",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json",
                    data: JSON.stringify(dataPost),
                    async: false,
                    headers: { Authorization: jwtCookie },
                    success: function (result_update) {
                        Swal.fire({
                            icon: "success",
                            title: "Vô hiệu hóa quản trị viên thành công!",
                            text: "",
                            timer: 2000,
                            timerProgressBar: true,
                        });
            
                        setTimeout(() => {
                            getListQuanTriVien($("#select_Role").val());
                        }, 2000);
                    },
                    error: function (errorMessage) {
                        checkLoiDangNhap(errorMessage.responseJSON.message);
            
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
        }
    });
}