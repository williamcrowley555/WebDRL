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

function ThongBaoLoi(message) {
  Swal.fire({
    icon: "error",
    title: "Lỗi",
    text: message,
    //timer: 5000,
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

//tieuchidanhgia//
function GetListTieuChi(tieuChi) {
  if (getCookie("jwt") != null) {
    var jwtCookie = getCookie("jwt");
    $.ajax({
      url: host_domain_url + "/" + tieuChi + "/read.php",
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: true,
      headers: { Authorization: jwtCookie },
      success: function (result) {
        $("#idPhanTrang").pagination({
          dataSource: result[tieuChi],
          pageSize: 10,
          autoHidePrevious: true,
          autoHideNext: true,

          callback: function (data, pagination) {
            var htmlData = "";
            var count = 0;

            if (tieuChi == "tieuchicap1") {
              for (let i = 0; i < data.length; i++) {
                count += 1;

                htmlData +=
                  "<tr>\
                                    <td class='cell'>" +
                  data[i].soThuTu +
                  "</td>\
                                    <td class='cell'><span class='truncate'>" +
                  data[i].matc1 +
                  "</span></td>\
                                    <td class='cell'>" +
                  data[i].noidung +
                  "</td>\
                                    <td class='cell'>" +
                  data[i].diemtoida +
                  "</td>\
                  <td class='cell'>\
                  <button class='btn bg-warning btn_ChinhSua' style='color: white;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                  data[i].matc1 +
                  "' >Chỉnh sửa</button>\
                </td>\
                                    </tr>";
              }
            } else if (tieuChi == "tieuchicap2") {
              for (let i = 0; i < data.length; i++) {
                count += 1;

                htmlData +=
                  "<tr>\
                                <td class='cell'>" +
                  data[i].soThuTu +
                  "</td>\
                                <td class='cell'><span class='truncate'>" +
                  data[i].matc2 +
                  "</span></td>\
                                <td class='cell'>" +
                  data[i].noidung +
                  "</td>\
                                <td class='cell'>" +
                  data[i].diemtoida +
                  "</td>\
                  <td class='cell'>\
                  <button class='btn bg-warning btn_ChinhSua' style='color: white;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                  data[i].matc2 +
                  "' >Chỉnh sửa</button>\
                </td>                                </tr>";
              }
            } else if (tieuChi == "tieuchicap3") {
              for (let i = 0; i < data.length; i++) {
                count += 1;

                htmlData +=
                  "<tr>\
                                <td class='cell'>" +
                  data[i].soThuTu +
                  "</td>\
                                <td class='cell'><span class='truncate'>" +
                  data[i].matc3 +
                  "</span></td>\
                                <td class='cell'>" +
                  data[i].noidung +
                  "</td>\
                                <td class='cell'>" +
                  data[i].diem +
                  "</td>\
                  <td class='cell'>\
                  <button class='btn bg-warning btn_ChinhSua' style='color: white;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                  data[i].matc3 +
                  "' >Chỉnh sửa</button>\
                </td>                                </tr>";
              }
            }

            $("#id_tbodyLop").html(htmlData);
          },
        });
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
function LoadComboBoxThongTinLopTheoKhoa(maKhoa) {
  if (maKhoa != "tatcakhoa") {
    //Load khoa
    $.ajax({
      url: urlapi_lop_read_maKhoa + maKhoa,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: false,
      headers: { Authorization: jwtCookie },
      success: function (result_Lop) {
        $("#select_Lop").find("option").remove();

        $("#select_Lop").append(
          "<option selected value='tatcalop'>Tất cả lớp</option>"
        );

        $.each(result_Lop, function (index_Lop) {
          for (var p = 0; p < result_Lop[index_Lop].length; p++) {
            $("#select_Lop").append(
              "<option value='" +
                result_Lop[index_Lop][p].maLop +
                "'>" +
                result_Lop[index_Lop][p].maLop +
                "</option>"
            );
          }
        });
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
  } else {
    LoadComboBoxThongTinKhoa();
    $("#select_Lop").find("option").remove();
  }
}

function LoadThongTinChinhSua(maTieuChi) {
  $.ajax({
    url: urlapi_lop_single_read + maLop,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_data) {
      $("#edit_input_TenLop").val(result_data.tenLop);

      var edit_select_CVHT_Add = document.getElementById(
        "edit_select_CVHT_Add"
      );
      for (var i = 0; i < edit_select_CVHT_Add.options.length; i++) {
        if (
          edit_select_CVHT_Add.options[i].value === result_data.maCoVanHocTap
        ) {
          edit_select_CVHT_Add.options[i].selected = true;
        }
      }

      var edit_select_Khoa_Add = document.getElementById(
        "edit_select_Khoa_Add"
      );
      for (var i = 0; i < edit_select_Khoa_Add.options.length; i++) {
        if (edit_select_Khoa_Add.options[i].value === result_data.maKhoa) {
          edit_select_Khoa_Add.options[i].selected = true;
        }
      }

      var edit_select_KhoaHoc_Add = document.getElementById(
        "edit_select_KhoaHoc_Add"
      );
      for (var i = 0; i < edit_select_KhoaHoc_Add.options.length; i++) {
        if (
          edit_select_KhoaHoc_Add.options[i].value === result_data.maKhoaHoc
        ) {
          edit_select_KhoaHoc_Add.options[i].selected = true;
        }
      }
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

function ChinhSua() {
  var _edit_input_MaLop = $("#edit_input_MaLop").val();
  var _edit_input_TenLop = $("#edit_input_TenLop").val();
  var _edit_select_Khoa_Add = $("#edit_select_Khoa_Add option:selected").val();
  var _edit_select_CVHT_Add = $("#edit_select_CVHT_Add option:selected").val();
  var _edit_select_KhoaHoc_Add = $(
    "#edit_select_KhoaHoc_Add option:selected"
  ).val();

  if (_edit_input_MaLop == "" || _edit_input_MaLop == "") {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {
    var dataPost = {
      maLop: _edit_input_MaLop,
      tenLop: _edit_input_TenLop,
      maKhoa: _edit_select_Khoa_Add,
      maCoVanHocTap: _edit_select_CVHT_Add,
      maKhoaHoc: _edit_select_KhoaHoc_Add,
    };

    $.ajax({
      url: urlapi_lop_update,
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
          title: "Chỉnh sửa thành công lớp mã lớp " + _edit_input_MaLop + "!",
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
