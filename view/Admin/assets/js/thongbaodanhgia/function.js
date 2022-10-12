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

//hoatdongdanhgia//
function GetListThongBaoDanhGia() {
  if (getCookie("jwt") != null) {
    var jwtCookie = getCookie("jwt");

    $("#id_tbodyLop tr").remove();

    $.ajax({
      url: urlapi_thongbaodanhgia_read,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: true,
      headers: { Authorization: jwtCookie },
      success: function (result) {
        $("#idPhanTrang").pagination({
          dataSource: result["thongbaodanhgia"],
          pageSize: 10,
          autoHidePrevious: true,
          autoHideNext: true,

          callback: function (data, pagination) {
            var htmlData = "";
            var count = 0;

            for (let i = 0; i < data.length; i++) {
              count += 1;

              //Ajax load học kỳ
              $.ajax({
                url: urlapi_hockydanhgia_single_read + data[i].maHocKyDanhGia,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                async: false,
                headers: { Authorization: jwtCookie },
                success: function (result_HKDG) {
                  htmlData +=
                    "<tr >\
                                <td class='cell'>" +
                    data[i].soThuTu +
                    "</td>\
                                <td class='cell'><span class='truncate'>" +
                    data[i].maThongBao +
                    "</span></td>\
                                <td class='cell'>" +
                    data[i].ngayThongBao +
                    "</td>\
                                <td class='cell'>" +
                    result_HKDG.hocKyXet +
                    " - " +
                    result_HKDG.namHocXet +
                    "</td>\
                                <td class='cell' style='font-weight: 500;' >" +
                    data[i].ngaySinhVienDanhGia +
                    "</td>\
                                <td class='cell'>" +
                    data[i].ngaySinhVienKetThucDanhGia +
                    "</td>\
                                <td class='cell' style='font-weight: 500;' >" +
                    data[i].ngayCoVanDanhGia +
                    "</td>\
                                <td class='cell'>" +
                    data[i].ngayCoVanKetThucDanhGia +
                    "</td>\
                                <td class='cell' style='font-weight: 500;' >" +
                    data[i].ngayKhoaDanhGia +
                    "</td>\
                                <td class='cell'>" +
                    data[i].ngayKhoaKetThucDanhGia +
                    "</td>\
                                <td class='cell'>\
                                    <button class='btn bg-warning btn_ChinhSua_ThongBaoDanhGia' style='color: white;margin: 5px;width: max-content;' data-id='" +
                    data[i].maThongBao +
                    "' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' >Chỉnh sửa</button>\
                                    <button class='btn bg-danger btn_Xoa_ThongBaoDanhGia' style='color: white;width: max-content;margin: 5px;' data-id='" +
                    data[i].maThongBao +
                    "' >Xóa</button>\
                                </td>\
                                </tr>";
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

            $("#id_tbodyLop").html(htmlData);
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

function ThemMoi() {
  var _select_HocKyXet = $("#select_HocKyXet option:selected").val();
  var _input_NamHocXet =
    $("#input_NamHocBatDau").val() + "-" + $("#input_NamHocKetThuc").val();
  var _input_NgayThongBao = $("#input_NgayThongBao").val();
  var _input_NgaySinhVienDanhGia = $("#input_NgaySinhVienDanhGia").val();
  var _input_NgaySinhVienKetThucDanhGia = $(
    "#input_NgaySinhVienKetThucDanhGia"
  ).val();
  var _input_NgayCoVanDanhGia = $("#input_NgayCoVanDanhGia").val();
  var _input_NgayCoVanKetThucDanhGia = $(
    "#input_NgayCoVanKetThucDanhGia"
  ).val();
  var _input_NgayKhoaDanhGia = $("#input_NgayKhoaDanhGia").val();
  var _input_NgayKhoaKetThucDanhGia = $("#input_NgayKhoaKetThucDanhGia").val();

  if (
    _select_HocKyXet == "" ||
    _input_NamHocXet == "" ||
    _input_NgayThongBao == "" ||
    _input_NgaySinhVienDanhGia == "" ||
    _input_NgaySinhVienKetThucDanhGia == "" ||
    _input_NgayCoVanDanhGia == "" ||
    _input_NgayCoVanKetThucDanhGia == "" ||
    _input_NgayKhoaDanhGia == "" ||
    _input_NgayKhoaKetThucDanhGia == ""
  ) {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {
    //regex namHocXet
    let regex = /[0-9]+-[0-9]+/i;

    if (regex.test(_input_NamHocXet)) {
      var _input_MaHocKyDanhGia =
        "HK" +
        _select_HocKyXet +
        _input_NamHocXet.split("-")[0].slice(2, 4) +
        _input_NamHocXet.split("-")[1].slice(2, 4);

      // Check có thông báo nào đã có maHocKyDanhGia này chưa
      $.ajax({
        url: urlapi_thongbaodanhgia_single_read_MaHKDG + _input_MaHocKyDanhGia,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_thongBaoCheck) {
          ThongBaoLoi(
            `Thông báo đánh giá cho HK${_select_HocKyXet} - Năm học: ${_input_NamHocXet} đã tồn tại! \nVui lòng nhập lại!`
          );
        },
        error: function (errorMessage) {
          //check học kỳ tồn tại chưa trước
          $.ajax({
            url: urlapi_hockydanhgia_single_read + _input_MaHocKyDanhGia,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: false,
            headers: { Authorization: jwtCookie },
            success: function (result_HKDG) {},
            error: function (errorMessage) {
              var dataPost_HocKyDanhGia = {
                maHocKyDanhGia: _input_MaHocKyDanhGia,
                hocKyXet: _select_HocKyXet,
                namHocXet: _input_NamHocXet,
              };

              //tạo học kỳ đánh giá trước
              $.ajax({
                url: urlapi_hockydanhgia_create,
                type: "POST",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                data: JSON.stringify(dataPost_HocKyDanhGia),
                async: false,
                headers: { Authorization: jwtCookie },
                success: function (result_CreateHKDG) {},
                error: function (errorMessage) {
                  //checkLoiDangNhap(errorMessage.responseJSON.message);

                  Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    text: errorMessage.responseJSON.message,
                    //timer: 5000,
                    timerProgressBar: true,
                  });

                  return;
                },
              });
            },
            complete() {
              var dataPost_ThongBaoDanhGia = {
                maHocKyDanhGia: _input_MaHocKyDanhGia,
                ngayThongBao: _input_NgayThongBao,
                ngaySinhVienDanhGia: _input_NgaySinhVienDanhGia,
                ngaySinhVienKetThucDanhGia: _input_NgaySinhVienKetThucDanhGia,
                ngayCoVanDanhGia: _input_NgayCoVanDanhGia,
                ngayCoVanKetThucDanhGia: _input_NgayCoVanKetThucDanhGia,
                ngayKhoaDanhGia: _input_NgayKhoaDanhGia,
                ngayKhoaKetThucDanhGia: _input_NgayKhoaKetThucDanhGia,
              };

              $.ajax({
                url: urlapi_thongbaodanhgia_create,
                type: "POST",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                data: JSON.stringify(dataPost_ThongBaoDanhGia),
                async: false,
                headers: { Authorization: jwtCookie },
                success: function (result_CreateTBDG) {
                  Swal.fire({
                    icon: "success",
                    title: "Tạo thành công!",
                    text: "",
                    timer: 2000,
                    timerProgressBar: true,
                  });

                  setTimeout(function () {
                    GetListThongBaoDanhGia();
                  }, 2000);

                  $("#select_HocKyXet").val("1").change();
                  $("#input_NamHocBatDau").val("");
                  $("#input_NamHocKetThuc").val("");
                  $("#input_NgayThongBao").val("");
                  $("#input_NgaySinhVienDanhGia").val("");
                  $("#input_NgaySinhVienKetThucDanhGia").val("");
                  $("#input_NgayCoVanDanhGia").val("");
                  $("#input_NgayCoVanKetThucDanhGia").val("");
                  $("#input_NgayKhoaDanhGia").val("");
                  $("#input_NgayKhoaKetThucDanhGia").val("");
                },
                error: function (errorMessage) {
                  //checkLoiDangNhap(errorMessage.responseJSON.message);

                  Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    text: errorMessage.responseText,
                    //timer: 5000,
                    timerProgressBar: true,
                  });
                },
              });
            },
          });
        },
      });
    } else {
      ThongBaoLoi("Định dạng năm học không đúng! Định dạng ví dụ: 2021-2022");
    }
  }
}

function LoadThongTinChinhSua_ThongBaoDanhGia(maThongBao) {
  $.ajax({
    url: urlapi_thongbaodanhgia_single_read_MaThongBao + maThongBao,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_data) {
      $.ajax({
        url: urlapi_hockydanhgia_single_read + result_data.maHocKyDanhGia,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_HKDG) {
          $("#edit_input_HocKyNamHocXet").val(
            `Học kỳ: ${result_HKDG.hocKyXet} - Năm học: ${result_HKDG.namHocXet}`
          );
        },
        error: function (errorMessage) {
          checkLoiDangNhap(errorMessage.responseJSON.message);
        },
        complete: function () {
          $("#edit_input_NgayThongBao").val(result_data.ngayThongBao);
          $("#edit_input_NgaySinhVienDanhGia").val(
            result_data.ngaySinhVienDanhGia
          );
          $("#edit_input_NgaySinhVienKetThucDanhGia").val(
            result_data.ngaySinhVienKetThucDanhGia
          );
          $("#edit_input_NgayCoVanDanhGia").val(result_data.ngayCoVanDanhGia);
          $("#edit_input_NgayCoVanKetThucDanhGia").val(
            result_data.ngayCoVanKetThucDanhGia
          );
          $("#edit_input_NgayKhoaDanhGia").val(result_data.ngayKhoaDanhGia);
          $("#edit_input_NgayKhoaKetThucDanhGia").val(
            result_data.ngayKhoaKetThucDanhGia
          );

          var _edit_input_NgaySinh = document.getElementById(
            "edit_input_NgayThongBao"
          );
          _edit_input_NgaySinh.value = result_data.ngayThongBao;
        },
      });
    },
    error: function (errorMessage) {
      // checkLoiDangNhap(errorMessage.responseJSON.message);

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

function ChinhSua_ThongBaoDanhGia() {
  var _edit_input_MaThongBao = $("#edit_input_MaThongBao").val();
  var _edit_input_NgayThongBao = $("#edit_input_NgayThongBao").val();
  var _edit_input_NgaySinhVienDanhGia = $(
    "#edit_input_NgaySinhVienDanhGia"
  ).val();
  var _edit_input_NgaySinhVienKetThucDanhGia = $(
    "#edit_input_NgaySinhVienKetThucDanhGia"
  ).val();
  var _edit_input_NgayCoVanDanhGia = $("#edit_input_NgayCoVanDanhGia").val();
  var _edit_input_NgayCoVanKetThucDanhGia = $(
    "#edit_input_NgayCoVanKetThucDanhGia"
  ).val();
  var _edit_input_NgayKhoaDanhGia = $("#edit_input_NgayKhoaDanhGia").val();
  var _edit_input_NgayKhoaKetThucDanhGia = $(
    "#edit_input_NgayKhoaKetThucDanhGia"
  ).val();

  if (
    _edit_input_MaThongBao == "" ||
    _edit_input_NgayThongBao == "" ||
    _edit_input_NgaySinhVienDanhGia == "" ||
    _edit_input_NgaySinhVienKetThucDanhGia == "" ||
    _edit_input_NgayCoVanDanhGia == "" ||
    _edit_input_NgayCoVanKetThucDanhGia == "" ||
    _edit_input_NgayKhoaDanhGia == "" ||
    _edit_input_NgayKhoaKetThucDanhGia == ""
  ) {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {
    $.ajax({
      url:
        urlapi_thongbaodanhgia_single_read_MaThongBao + _edit_input_MaThongBao,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: false,
      headers: { Authorization: jwtCookie },
      success: function (result_data) {
        var dataPost_ThongBaoDanhGia = {
          maThongBao: _edit_input_MaThongBao,
          maHocKyDanhGia: result_data.maHocKyDanhGia,
          ngayThongBao: _edit_input_NgayThongBao,
          ngaySinhVienDanhGia: _edit_input_NgaySinhVienDanhGia,
          ngaySinhVienKetThucDanhGia: _edit_input_NgaySinhVienKetThucDanhGia,
          ngayCoVanDanhGia: _edit_input_NgayCoVanDanhGia,
          ngayCoVanKetThucDanhGia: _edit_input_NgayCoVanKetThucDanhGia,
          ngayKhoaDanhGia: _edit_input_NgayKhoaDanhGia,
          ngayKhoaKetThucDanhGia: _edit_input_NgayKhoaKetThucDanhGia,
        };

        $.ajax({
          url: urlapi_thongbaodanhgia_update,
          type: "POST",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          data: JSON.stringify(dataPost_ThongBaoDanhGia),
          async: false,
          headers: { Authorization: jwtCookie },
          success: function (result_TBDG) {
            $("#ChinhSuaModal").modal("hide");

            Swal.fire({
              icon: "success",
              title:
                "Chỉnh sửa thành công thông báo mã " +
                _edit_input_MaThongBao +
                "!",
              text: "",
              timer: 2000,
              timerProgressBar: true,
            });

            setTimeout(function () {
              GetListThongBaoDanhGia();
            }, 2000);
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
}

function XoaThongBaoDanhGia(maThongBao) {
  Swal.fire({
    title: "Xác nhận xóa thông báo đánh giá mã  " + maThongBao + " ?",
    showDenyButton: true,
    confirmButtonText: "Xác nhận",
    denyButtonText: `Đóng`,
  }).then((result) => {
    if (result.isConfirmed) {
      var dataPost_ThongBaoDanhGia = {
        maThongBao: maThongBao,
        kichHoat: "0",
      };

      $.ajax({
        url: urlapi_thongbaodanhgia_update_kichHoat,
        type: "POST",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        data: JSON.stringify(dataPost_ThongBaoDanhGia),
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_TBDG) {
          Swal.fire({
            icon: "success",
            title: "Xóa thông báo đánh giá mã " + maThongBao + " thành công!",
            text: "",
            timer: 2000,
            timerProgressBar: true,
          });

          setTimeout(function () {
            GetListThongBaoDanhGia();
          }, 2000);
        },
        error: function (errorMessage) {
          //checkLoiDangNhap(errorMessage.responseJSON.message);

          Swal.fire({
            icon: "error",
            title: "Lỗi",
            text: "Xóa thông báo đánh giá mã " + maThongBao + " thất bại!",
            //timer: 5000,
            timerProgressBar: true,
          });
        },
      });
    }
  });
}
