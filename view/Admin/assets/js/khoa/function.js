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

//Khoa//
function GetListKhoa() {
  if (getCookie("jwt") != null) {
    var jwtCookie = getCookie("jwt");

    $.ajax({
      url: urlapi_khoa_read,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: true,
      headers: { Authorization: jwtCookie },
      success: function (result) {
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
                                <td class='cell'><button class='btn btn-info' id='btn_DatLaiMatKhau' style='color: white;' data-id='" +
                data[i].maKhoa +
                "' >Đặt lại mật khẩu</button></td>\
                                <td class='cell'>\
                                    <button class='btn bg-warning btn_ChinhSua' style='color: white;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                data[i].maKhoa +
                "' data-tenKhoa = '" +
                data[i].tenKhoa +
                "' >Chỉnh sửa</button>\
                                </td>\
                                </tr>";
            }

            $("#id_tbodyKhoa").html(htmlData);
          },
        });
      },
      error: function (errorMessage) {
        checkLoiDangNhap(errorMessage.responseJSON.message);

        console.log(errorMessage.responseJSON.message);
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

function DatLaiMatKhau() {}

function ChinhSua() {
  var _edit_input_MaKhoa = $("#edit_input_MaKhoa").val();
  var _edit_input_TenKhoa = $("#edit_input_TenKhoa").val();
  if (_edit_input_MaKhoa == "" || _edit_input_TenKhoa == "") {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {
    var dataPost = {
      maKhoa: _edit_input_MaKhoa,
      tenKhoa: _edit_input_TenKhoa,
      taiKhoanKhoa: taiKhoanKhoa,
      matKhauKhoa: matKhauKhoa,
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
          title: "Chỉnh sửa thành công kha mã khoa " + _edit_input_MaKhoa + "!",
          text: "",
          timer: 2000,
          timerProgressBar: true,
        });

        setTimeout(() => {
          GetListLop("tatcakhoa");
        }, 2000);
      },
      error: function (errorMessage) {
        checkLoiDangNhap(errorMessage.responseJSON.message);

        Swal.fire({
          icon: "error",
          title: "Lỗi",
          text: errorMessage.responseText,
          //timer: 5000,
          timerProgressBar: true,
        });
      },
    });
  }
}
