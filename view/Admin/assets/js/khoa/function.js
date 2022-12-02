var tableTitle = ["STT", "Mã khoa", "Tên khoa", "Tài khoản khoa"];

var tableContent = [];

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

function checkLoiDangNhap(message) {
  if (message.localeCompare("Vui lòng đăng nhập trước!") == 0) {
    deleteAllCookies();
    location.href = "login.php";
  }
}

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

var jwtCookie = getCookie("jwt");

//Khoa//
function GetListKhoa() {
  $("#id_tbodyKhoa tr").remove();
  $.ajax({
    url: urlapi_khoa_read,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result) {
      tableContent = result["khoa"];

      $("#idPhanTrang").pagination({
        dataSource: result["khoa"],
        pageSize: 10,
        autoHidePrevious: true,
        autoHideNext: true,

        callback: function (data, pagination) {
          var htmlData = "";
          var count = 0;

          for (let i = 0; i < data.length; i++) {
            count += 1;

            htmlData +=
              "<tr>\
              <td class='cell'>" +
              data[i].soThuTu +
              "</td>\
              <td class='cell'><span class='truncate' id='field_maKhoa' >" +
              data[i].maKhoa +
              "</span></td>\
              <td class='cell'>" +
              data[i].tenKhoa +
              "</td>\
              <td class='cell'>" +
              data[i].taiKhoanKhoa +
              "</td>\
              <td class='cell'>\
                <button class='btn btn-info btn_DatLaiMatKhau_Khoa' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white;' data-id='" +
              data[i].maKhoa +
              "' >Đặt lại mật khẩu</button>\
                <button class='btn bg-warning btn_ChinhSua_Khoa' style='color: white;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
              data[i].maKhoa +
              "' data-tenKhoa = '" +
              data[i].tenKhoa +
              "' >Chỉnh sửa</button></td>\
              </tr>";
          }

          $("#id_tbodyKhoa").html(htmlData);
        },
      });
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      tableContent = [];

      var htmlData = "";
      $("#id_tbodyKhoa").html(htmlData);
      $("#idPhanTrang").empty();
      htmlData += "<tr>\
									<td colspan='5' class='text-center'>\
										<p class='mt-4'>Không tìm thấy kết quả.</p>\
									</td>\
								</tr>"
			$("#id_tbodyKhoa").append(htmlData);


      ThongBaoLoi(errorMessage.responseJSON.message);
    },
  });
}

function TimKiemKhoa(maKhoa) {
  $("#id_tbodyKhoa tr").remove();
  $.ajax({
    url: urlapi_khoa_read_maKhoa + maKhoa,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: { Authorization: jwtCookie },
    success: function (result) {
      tableContent = result["khoa"];

      $("#idPhanTrang").pagination({
        dataSource: result["khoa"],
        pageSize: 10,
        autoHidePrevious: true,
        autoHideNext: true,

        callback: function (data, pagination) {
          var htmlData = "";
          var count = 0;

          for (let i = 0; i < data.length; i++) {
            count += 1;

            htmlData +=
              "<tr>\
              <td class='cell'>" +
              data[i].soThuTu +
              "</td>\
              <td class='cell'><span class='truncate' id='field_maKhoa' >" +
              data[i].maKhoa +
              "</span></td>\
              <td class='cell'>" +
              data[i].tenKhoa +
              "</td>\
              <td class='cell'>" +
              data[i].taiKhoanKhoa +
              "</td>\
              <td class='cell'>\
                <button class='btn btn-info btn_DatLaiMatKhau_Khoa' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white;' data-id='" +
              data[i].maKhoa +
              "' >Đặt lại mật khẩu</button>\
                <button class='btn bg-warning btn_ChinhSua_Khoa' style='color: white;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
              data[i].maKhoa +
              "' data-tenKhoa = '" +
              data[i].tenKhoa +
              "' >Chỉnh sửa</button></td>\
              </tr>";
          }

          $("#id_tbodyKhoa").html(htmlData);
        },
      });
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      tableContent = [];

      var htmlData = "";
      $("#id_tbodyKhoa").html(htmlData);
      $("#idPhanTrang").empty();

      htmlData += "<tr>\
									<td colspan='5' class='text-center'>\
										<p class='mt-4'>Không tìm thấy kết quả.</p>\
									</td>\
								</tr>"
			$("#id_tbodyKhoa").append(htmlData);

      //ThongBaoLoi(errorMessage.responseJSON.message);
    },
    statusCode: {
      403: function (xhr) {
        //deleteAllCookies();
        //location.href = 'login.php';
      },
    },
  });
}

function DatLaiMatKhau_Khoa() {
  var _DLMK_maKhoa = $("#input_MaKhoa_DLMK").val();

  var _input_MatKhauMoi = $("#input_MatKhauMoi").val();
  var _input_NhapLaiMatKhauMoi = $("#input_NhapLaiMatKhau").val();

  if (
    (_DLMK_maKhoa == "") | (_input_MatKhauMoi == "") ||
    _input_NhapLaiMatKhauMoi == ""
  ) {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {
    if (_input_MatKhauMoi != _input_NhapLaiMatKhauMoi) {
      ThongBaoLoi("Nhập lại mật khẩu không khớp với mật khẩu! Mời nhập lại!");
    } else {
      $.ajax({
        url: urlapi_khoa_single_read + _DLMK_maKhoa,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_Khoa) {
          var _input_maKhoa = result_Khoa.maKhoa;
          var _input_tenKhoa = result_Khoa.tenKhoa;
          var _input_taiKhoanKhoa = result_Khoa.taiKhoanKhoa;

          var dataPost_Update = {
            maKhoa: _input_maKhoa,
            tenKhoa: _input_tenKhoa,
            taiKhoanKhoa: _input_taiKhoanKhoa,
            matKhauKhoa: _input_NhapLaiMatKhauMoi,
          };

          $.ajax({
            url: urlapi_khoa_update,
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
                title:
                  "Đặt lại mật khẩu thành công Khoa mã " + _input_maKhoa + "!",
                text: "",
                timer: 2000,
                timerProgressBar: true,
              });

              setTimeout(() => {
                GetListKhoa();
              }, 2000);

              $("#input_MatKhauMoi").val("");
              $("#input_NhapLaiMatKhau").val("");
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
}

function ChinhSua_Khoa() {
  var _edit_input_MaKhoa = $("#edit_input_MaKhoa").val();
  var _edit_input_TenKhoa = $("#edit_input_TenKhoa").val();

  if (_edit_input_MaKhoa == "" || _edit_input_TenKhoa == "") {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {
    var dataPost = {
      maKhoa: _edit_input_MaKhoa,
      tenKhoa: _edit_input_TenKhoa,
    };

    $.ajax({
      url: urlapi_khoa_update,
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
          title: "Chỉnh sửa thành công khoa với mã " + _edit_input_MaKhoa + "!",
          text: "",
          timer: 2000,
          timerProgressBar: true,
        });

        setTimeout(() => {
          GetListKhoa();
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

function ThemMoi_Khoa() {
  var _add_input_MaKhoa = $("#add_input_MaKhoa").val();
  var _add_input_TenKhoa = $("#add_input_TenKhoa").val();
  var _add_input_TaiKhoanKhoa = $("#add_input_TaiKhoanKhoa").val();
  var _add_input_MatKhau = $("#add_input_MatKhau").val();
  var _add_input_NhapLaiMatKhau = $("#add_input_NhapLaiMatKhau").val();

  if (
    _add_input_MaKhoa == "" ||
    _add_input_TenKhoa == "" ||
    _add_input_TaiKhoanKhoa == "" ||
    _add_input_MatKhau == "" ||
    _add_input_NhapLaiMatKhau == ""
  ) {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {
    if (_add_input_MatKhau != _add_input_NhapLaiMatKhau) {
      ThongBaoLoi("Mật khẩu và nhập lại mật khẩu phải giống nhau!");
    } else {
      var dataPost = {
        maKhoa: _add_input_MaKhoa,
        tenKhoa: _add_input_TenKhoa,
        taiKhoanKhoa: _add_input_TaiKhoanKhoa,
        matKhauKhoa: _add_input_MatKhau,
      };

      $.ajax({
        url: urlapi_khoa_create,
        type: "POST",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        data: JSON.stringify(dataPost),
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_update) {
          $("#AddModal").modal("hide");

          Swal.fire({
            icon: "success",
            title: "Thêm thành công Khoa mã  " + _add_input_MaKhoa + "!",
            text: "",
            timer: 2000,
            timerProgressBar: true,
          });

          setTimeout(() => {
            GetListKhoa();
          }, 2000);

          $("#add_input_MaKhoa").val("");
          $("#add_input_TenKhoa").val("");
          $("#add_input_TaiKhoanKhoa").val("");
          $("#add_input_MatKhau").val("");
          $("#add_input_NhapLaiMatKhau").val("");
        },
        error: function (errorMessage) {
          checkLoiDangNhap(errorMessage.responseJSON.message);

          ThongBaoLoi(errorMessage.responseJSON.message);
        },
      });
    }
  }
}
