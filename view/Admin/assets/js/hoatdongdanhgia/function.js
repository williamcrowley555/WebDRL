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

//hoatdongdanhgia//
function GetListHoatdongdanhgia() {
  if (getCookie("jwt") != null) {
    var jwtCookie = getCookie("jwt");

    $("#id_tbodyLop tr").remove();
    $.ajax({
      url: urlapi_hoatdongdanhgia_read,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: true,
      headers: { Authorization: jwtCookie },
      success: function (result) {
        $("#idPhanTrang").pagination({
          dataSource: result["hoatdongdanhgia"],
          pageSize: 10,
          autoHidePrevious: true,
          autoHideNext: true,

          callback: function (data, pagination) {
            var htmlData = "";
            var count = 0;

            for (let i = 0; i < data.length; i++) {
              count += 1;

              htmlData +=
                "<tr >\
                                <td class='cell'>" +
                data[i].soThuTu +
                "</td>\
                                <td class='cell'><span class='truncate'>" +
                data[i].maHoatDong +
                "</span></td>\
                                <td class='cell'>" +
                data[i].tenHoatDong +
                "</td>\
                                <td class='cell'>" +
                data[i].maKhoa +
                "</td>\
                                <td class='cell'>" +
                data[i].noiDungTieuChi +
                "</td>\
                                <td class='cell'>" +
                data[i].diemNhanDuoc +
                "</td>\
                                <td class='cell'>" +
                data[i].diaDiemDienRaHoatDong +
                "</td>\
                                <td class='cell'>" +
                data[i].maHocKyDanhGia +
                "</td>\
                                <td class='cell'>" +
                data[i].thoiGianBatDauHoatDong +
                "</td>\
                                <td class='cell'>" +
                data[i].thoiGianKetThucHoatDong +
                "</td>\
                                <td class='cell'>" +
                data[i].thoiGianBatDauDiemDanh +
                "</td>\
                                <td class='cell'><img src='" +
                data[i].maQRDiaDiem +
                "' style='width: 50%;' /></td>\
                                <td class='cell'>\
                                    <button type='button' class='btn_DanhSachThamGia btn' style='color: white;width: max-content;margin: 5px;background: #656566;'  data-id='" +
                data[i].maHoatDong +
                "' data-name-id='" +
                data[i].tenHoatDong +
                "' data-bs-toggle='modal' data-bs-target='#DanhSachThamGiaModal' >Danh sách tham gia</button>\
                                    <button type='button' class='btn_BatDauDiemDanh btn' style='color: white;width: max-content;margin: 5px;background: dodgerblue;'  data-id='" +
                data[i].maHoatDong +
                "' >Bắt đầu điểm danh</button>\
                                    <button type='button' class='btn bg-warning btn_ChinhSua_HoatDong' style='color: white;width: max-content;margin: 5px;'  data-id='" +
                data[i].maHoatDong +
                "'  data-bs-toggle='modal' data-bs-target='#ChinhSuaModal'>Chỉnh sửa</button>\
                                </td>\
                                </tr>";
            }

            $("#id_tbodyLop").html(htmlData);
          },
        });
      },
      error: function (errorMessage) {
        checkLoiDangNhap(errorMessage.responseJSON.message);

        var htmlData = "";
        $("#id_tbodyLop").html(htmlData);
        $("#idPhanTrang").empty();

        ThongBaoLoi(errorMessage.responseJSON.message);
      },
    });
  }
}

function TimKiemHoatDong(maHD) {
  $("#id_tbodyLop tr").remove();
  $.ajax({
    url: urlapi_hoatdongdanhgia_read_maHD + maHD,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: true,
    headers: { Authorization: jwtCookie },
    success: function (result) {
      $("#idPhanTrang").pagination({
        dataSource: result["hoatdongdanhgia"],
        pageSize: 10,
        autoHidePrevious: true,
        autoHideNext: true,

        callback: function (data, pagination) {
          var htmlData = "";
          var count = 0;

          for (let i = 0; i < data.length; i++) {
            count += 1;

            htmlData +=
              "<tr >\
                              <td class='cell'>" +
              data[i].soThuTu +
              "</td>\
                              <td class='cell'><span class='truncate'>" +
              data[i].maHoatDong +
              "</span></td>\
                              <td class='cell'>" +
              data[i].tenHoatDong +
              "</td>\
                              <td class='cell'>" +
              data[i].maKhoa +
              "</td>\
                              <td class='cell'>" +
              data[i].noiDungTieuChi +
              "</td>\
                              <td class='cell'>" +
              data[i].diemNhanDuoc +
              "</td>\
                              <td class='cell'>" +
              data[i].diaDiemDienRaHoatDong +
              "</td>\
                              <td class='cell'>" +
              data[i].maHocKyDanhGia +
              "</td>\
                              <td class='cell'>" +
              data[i].thoiGianBatDauHoatDong +
              "</td>\
                              <td class='cell'>" +
              data[i].thoiGianKetThucHoatDong +
              "</td>\
                              <td class='cell'>" +
              data[i].thoiGianBatDauDiemDanh +
              "</td>\
                              <td class='cell'><img src='" +
              data[i].maQRDiaDiem +
              "' style='width: 50%;' /></td>\
                              <td class='cell'>\
                                  <button type='button' class='btn_DanhSachThamGia btn' style='color: white;width: max-content;margin: 5px;background: #656566;'  data-id='" +
              data[i].maHoatDong +
              "' data-name-id='" +
              data[i].tenHoatDong +
              "' data-bs-toggle='modal' data-bs-target='#DanhSachThamGiaModal' >Danh sách tham gia</button>\
                                  <button type='button' class='btn_BatDauDiemDanh btn' style='color: white;width: max-content;margin: 5px;background: dodgerblue;'  data-id='" +
              data[i].maHoatDong +
              "' >Bắt đầu điểm danh</button>\
                                  <button type='button' class='btn bg-warning btn_ChinhSua_HoatDong' style='color: white;width: max-content;margin: 5px;'  data-id='" +
              data[i].maHoatDong +
              "'  data-bs-toggle='modal' data-bs-target='#ChinhSuaModal'>Chỉnh sửa</button>\
                              </td>\
                              </tr>";
          }

          $("#id_tbodyLop").html(htmlData);
        },
      });
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      var htmlData = "";
      $("#id_tbodyLop").html(htmlData);
      $("#idPhanTrang").empty();

      ThongBaoLoi(errorMessage.responseJSON.message);
    },
  });
}

function LocHoatDong(from, to) {
  if (from && to) {
    $.ajax({
      url: urlapi_hoatdongdanhgia_read + `?from=${from}&to=${to}`,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: true,
      headers: { Authorization: jwtCookie },
      success: function (result) {
        $("#id_tbodyLop tr").remove();

        $("#idPhanTrang").pagination({
          dataSource: result["hoatdongdanhgia"],
          pageSize: 10,
          autoHidePrevious: true,
          autoHideNext: true,

          callback: function (data, pagination) {
            var htmlData = "";
            var count = 0;

            for (let i = 0; i < data.length; i++) {
              count += 1;

              htmlData +=
                "<tr >\
                              <td class='cell'>" +
                data[i].soThuTu +
                "</td>\
                              <td class='cell'><span class='truncate'>" +
                data[i].maHoatDong +
                "</span></td>\
                              <td class='cell'>" +
                data[i].tenHoatDong +
                "</td>\
                              <td class='cell'>" +
                data[i].maKhoa +
                "</td>\
                              <td class='cell'>" +
                data[i].noiDungTieuChi +
                "</td>\
                              <td class='cell'>" +
                data[i].diemNhanDuoc +
                "</td>\
                              <td class='cell'>" +
                data[i].diaDiemDienRaHoatDong +
                "</td>\
                              <td class='cell'>" +
                data[i].maHocKyDanhGia +
                "</td>\
                              <td class='cell'>" +
                data[i].thoiGianBatDauHoatDong +
                "</td>\
                              <td class='cell'>" +
                data[i].thoiGianKetThucHoatDong +
                "</td>\
                              <td class='cell'>" +
                data[i].thoiGianBatDauDiemDanh +
                "</td>\
                              <td class='cell'><img src='" +
                data[i].maQRDiaDiem +
                "' style='width: 50%;' /></td>\
                              <td class='cell'>\
                                  <button type='button' class='btn_DanhSachThamGia btn' style='color: white;width: max-content;margin: 5px;background: #656566;'  data-id='" +
                data[i].maHoatDong +
                "' data-name-id='" +
                data[i].tenHoatDong +
                "' data-bs-toggle='modal' data-bs-target='#DanhSachThamGiaModal' >Danh sách tham gia</button>\
                                  <button type='button' class='btn_BatDauDiemDanh btn' style='color: white;width: max-content;margin: 5px;background: dodgerblue;'  data-id='" +
                data[i].maHoatDong +
                "' >Bắt đầu điểm danh</button>\
                                  <button type='button' class='btn bg-warning btn_ChinhSua_HoatDong' style='color: white;width: max-content;margin: 5px;'  data-id='" +
                data[i].maHoatDong +
                "'  data-bs-toggle='modal' data-bs-target='#ChinhSuaModal'>Chỉnh sửa</button>\
                              </td>\
                              </tr>";
            }

            $("#id_tbodyLop").html(htmlData);
          },
        });
      },
      error: function (errorMessage) {
        checkLoiDangNhap(errorMessage.responseJSON.message);

        ThongBaoLoi(errorMessage.responseJSON.message);
      },
    });
  }
}

function LoadThongTinThemMoi() {
  //Load khoa
  $.ajax({
    url: urlapi_khoa_read,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_Khoa) {
      $("#select_Khoa").find("option").remove();

      $.each(result_Khoa, function (index_Khoa) {
        for (var p = 0; p < result_Khoa[index_Khoa].length; p++) {
          $("#select_Khoa").append(
            "<option value='" +
              result_Khoa[index_Khoa][p].maKhoa +
              "'>" +
              result_Khoa[index_Khoa][p].tenKhoa +
              "</option>"
          );
          $("#edit_select_Khoa").append(
            "<option value='" +
              result_Khoa[index_Khoa][p].maKhoa +
              "'>" +
              result_Khoa[index_Khoa][p].tenKhoa +
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

  //Load tiêu chí
  $.ajax({
    url: urlapi_tieuchicap2_read,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_TC2) {
      $("#select_TieuChi").find("option").remove();

      $.each(result_TC2, function (index_TC2) {
        for (var p = 0; p < result_TC2[index_TC2].length; p++) {
          if (result_TC2[index_TC2][p].diemtoida > 0) {
            $("#select_TieuChi").append(
              "<option value='TC2_" +
                result_TC2[index_TC2][p].matc2 +
                "'>" +
                result_TC2[index_TC2][p].noidung +
                "</option>"
            );
            $("#edit_select_TieuChi").append(
              "<option value='TC2_" +
                result_TC2[index_TC2][p].matc2 +
                "'>" +
                result_TC2[index_TC2][p].noidung +
                "</option>"
            );
          }
        }
      });

      //Load tiêu chí
      $.ajax({
        url: urlapi_tieuchicap3_read,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_TC3) {
          $.each(result_TC3, function (index_TC3) {
            for (var k = 0; k < result_TC3[index_TC3].length; k++) {
              if (result_TC3[index_TC3][k].diem > 0) {
                $("#select_TieuChi").append(
                  "<option value='TC3_" +
                    result_TC3[index_TC3][k].matc3 +
                    "'>" +
                    result_TC3[index_TC3][k].noidung +
                    "</option>"
                );
                $("#edit_select_TieuChi").append(
                  "<option value='TC3_" +
                    result_TC3[index_TC3][k].matc3 +
                    "'>" +
                    result_TC3[index_TC3][k].noidung +
                    "</option>"
                );
              }
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

  //Load học kỳ áp dụng
  $.ajax({
    url: urlapi_hockydanhgia_read,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_HocKy) {
      $("#select_HocKyDanhGia").find("option").remove();

      $.each(result_HocKy, function (index_HocKy) {
        for (var b = 0; b < result_HocKy[index_HocKy].length; b++) {
          $("#select_HocKyDanhGia").append(
            "<option value='" +
              result_HocKy[index_HocKy][b].maHocKyDanhGia +
              "'> " +
              result_HocKy[index_HocKy][b].hocKyXet +
              " - " +
              result_HocKy[index_HocKy][b].namHocXet +
              "</option>"
          );
          $("#edit_select_HocKyDanhGia").append(
            "<option value='" +
              result_HocKy[index_HocKy][b].maHocKyDanhGia +
              "'> " +
              result_HocKy[index_HocKy][b].hocKyXet +
              " - " +
              result_HocKy[index_HocKy][b].namHocXet +
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
}

function ThemMoi_HoatDong() {
  var _input_MaHocKy = $("#select_HocKyDanhGia option:selected").val();
  var _input_TenHoatDong = $("#input_TenHoatDong").val();
  var _input_MaKhoa = $("#select_Khoa option:selected").val();
  var _input_MaTieuChi = $("#select_TieuChi option:selected").val();
  var _input_DiemNhanDuoc = $("#input_DiemNhanDuoc").val();
  var _input_DiaDiemHoatDong = $("#input_DiaDiemHoatDong").val();
  var _input_ThoiGianBatDau = $("#input_ThoiGianBatDau").val();
  var _input_ThoiGianKetThuc = $("#input_ThoiGianKetThuc").val();

  if (
    _input_TenHoatDong == "" ||
    _input_DiemNhanDuoc == "" ||
    _input_DiaDiemHoatDong == "" ||
    _input_ThoiGianBatDau == "" ||
    _input_ThoiGianKetThuc == ""
  ) {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {
    //Lấy mã hoạt động max + 1 để dùng cho tạo url hoạt động đánh giá
    $.ajax({
      url: urlapi_hoatdongdanhgia_read,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: false,
      headers: { Authorization: jwtCookie },
      success: function (result) {
        var maxID_MaHoatDong = 0;
        $.each(result, function (index) {
          for (var b = 0; b < result[index].length; b++) {
            //Mã hoạt động ví dụ: HD1
            if (
              Number(
                result[index][b].maHoatDong.slice(
                  2,
                  result[index][b].maHoatDong.length
                )
              ) > Number(maxID_MaHoatDong)
            ) {
              maxID_MaHoatDong = Number(
                result[index][b].maHoatDong.slice(
                  2,
                  result[index][b].maHoatDong.length
                )
              );
            }
          }
        });

        var maHoatDongNew = "HD" + (Number(maxID_MaHoatDong) + Number(1));

        var maTieuChi_sliced = _input_MaTieuChi.slice(0, 3);
        var _value_maTieuChi = _input_MaTieuChi.slice(
          4,
          _input_MaTieuChi.length
        );

        //http://localhost/WebDRL/view/Client/pages/diemdanhhoatdong.php?maHoatDong=HD1
        var currentDomainURL =
          window.location.protocol + "//" + window.location.hostname;
        var urlCreate =
          currentDomainURL +
          "/WebDRL/view/Client/pages/diemdanhhoatdong.php?maHoatDong=" +
          maHoatDongNew;

        //Tạo hoạt động đánh giá
        if (maTieuChi_sliced == "TC2") {
          var dataPost = {
            maHoatDong: maHoatDongNew,
            maTieuChi2: _value_maTieuChi,
            maTieuChi3: null,
            maHocKyDanhGia: _input_MaHocKy,
            tenHoatDong: _input_TenHoatDong,
            maKhoa: _input_MaKhoa,
            diemNhanDuoc: _input_DiemNhanDuoc,
            diaDiemDienRaHoatDong: _input_DiaDiemHoatDong,
            thoiGianBatDauHoatDong: _input_ThoiGianBatDau,
            thoiGianKetThucHoatDong: _input_ThoiGianKetThuc,
            thoiGianBatDauDiemDanh: null,
            url: urlCreate,
          };

          $.ajax({
            url: urlapi_hoatdongdanhgia_create,
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
                text: "",
                timer: 2000,
                timerProgressBar: true,
              });

              setTimeout(function () {
                GetListHoatdongdanhgia();
              }, 2000);

              $("#input_TenHoatDong").val("");
              $("#input_DiemNhanDuoc").val("");
              $("#input_DiaDiemHoatDong").val("");
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

        if (maTieuChi_sliced == "TC3") {
          var dataPost = {
            maHoatDong: maHoatDongNew,
            maTieuChi2: null,
            maTieuChi3: _value_maTieuChi,
            maHocKyDanhGia: _input_MaHocKy,
            tenHoatDong: _input_TenHoatDong,
            maKhoa: _input_MaKhoa,
            diemNhanDuoc: _input_DiemNhanDuoc,
            diaDiemDienRaHoatDong: _input_DiaDiemHoatDong,
            thoiGianBatDauHoatDong: _input_ThoiGianBatDau,
            thoiGianKetThucHoatDong: _input_ThoiGianKetThuc,
            thoiGianBatDauDiemDanh: null,
            url: urlCreate,
          };

          $.ajax({
            url: urlapi_hoatdongdanhgia_create,
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
                text: "",
                timer: 2000,
                timerProgressBar: true,
              });

              setTimeout(function () {
                GetListHoatdongdanhgia();
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
      },
      error: function (errorMessage) {
        checkLoiDangNhap(errorMessage.responseJSON.message);

        //Trường hợp database trắng, chưa có hoạt động nào//--
        if (errorMessage.responseJSON.message == "Không tìm thấy dữ liệu.") {
          var maHoatDongNew = "HD1";

          var maTieuChi_sliced = _input_MaTieuChi.slice(0, 3);
          var _value_maTieuChi = _input_MaTieuChi.slice(
            4,
            _input_MaTieuChi.length
          );

          //http://localhost/WebDRL/view/Client/pages/diemdanhhoatdong.php?maHoatDong=HD1
          var currentDomainURL =
            window.location.protocol + "//" + window.location.hostname;
          var urlCreate =
            currentDomainURL +
            "/WebDRL/view/Client/pages/diemdanhhoatdong.php?maHoatDong=" +
            maHoatDongNew;

          //Tạo hoạt động đánh giá
          if (maTieuChi_sliced == "TC2") {
            var dataPost = {
              maHoatDong: maHoatDongNew,
              maTieuChi2: _value_maTieuChi,
              maTieuChi3: null,
              maHocKyDanhGia: _input_MaHocKy,
              tenHoatDong: _input_TenHoatDong,
              maKhoa: _input_MaKhoa,
              diemNhanDuoc: _input_DiemNhanDuoc,
              diaDiemDienRaHoatDong: _input_DiaDiemHoatDong,
              thoiGianBatDauHoatDong: _input_ThoiGianBatDau,
              thoiGianKetThucHoatDong: _input_ThoiGianKetThuc,
              thoiGianBatDauDiemDanh: null,
              url: urlCreate,
            };

            $.ajax({
              url: urlapi_hoatdongdanhgia_create,
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
                  text: "",
                  timer: 2000,
                  timerProgressBar: true,
                });

                setTimeout(function () {
                  GetListHoatdongdanhgia();
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

          if (maTieuChi_sliced == "TC3") {
            var dataPost = {
              maHoatDong: maHoatDongNew,
              maTieuChi2: null,
              maTieuChi3: _value_maTieuChi,
              maHocKyDanhGia: _input_MaHocKy,
              tenHoatDong: _input_TenHoatDong,
              maKhoa: _input_MaKhoa,
              diemNhanDuoc: _input_DiemNhanDuoc,
              diaDiemDienRaHoatDong: _input_DiaDiemHoatDong,
              thoiGianBatDauHoatDong: _input_ThoiGianBatDau,
              thoiGianKetThucHoatDong: _input_ThoiGianKetThuc,
              thoiGianBatDauDiemDanh: null,
              url: urlCreate,
            };

            $.ajax({
              url: urlapi_hoatdongdanhgia_create,
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
                  text: "",
                  timer: 2000,
                  timerProgressBar: true,
                });

                setTimeout(function () {
                  GetListHoatdongdanhgia();
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
        } else {
          Swal.fire({
            icon: "error",
            title: "Lỗi",
            text: errorMessage.responseJSON.message,
            //timer: 5000,
            timerProgressBar: true,
          });
        }
      },
    });
  }
}

function DiemDanhHoatDong(input_MaHoatDong) {
  Swal.fire({
    title:
      "Xác nhận bắt đầu điểm danh hoạt động mã  " + input_MaHoatDong + " ?",
    showDenyButton: true,
    confirmButtonText: "Xác nhận",
    denyButtonText: `Đóng`,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: urlapi_hoatdongdanhgia_single_read + input_MaHoatDong,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result) {
          //lấy ngày hiện tại
          var today = new Date();

          if (
            today.getTime() >=
              new Date(result.thoiGianBatDauHoatDong).getTime() &&
            today.getTime() <=
              new Date(result.thoiGianKetThucHoatDong).getTime()
          ) {
            //vẫn còn trong thời gian
            var _input_maTieuChi3 = result.maTieuChi3;
            var _input_maTieuChi2 = result.maTieuChi2;
            var _input_maKhoa = result.maKhoa;
            var _input_tenHoatDong = result.tenHoatDong;
            var _input_diemNhanDuoc = result.diemNhanDuoc;
            var _input_diaDiemDienRaHoatDong = result.diaDiemDienRaHoatDong;
            var _input_maHocKyDanhGia = result.maHocKyDanhGia;
            var _input_thoiGianBatDauHoatDong = result.thoiGianBatDauHoatDong;
            var _input_thoiGianKetThucHoatDong = result.thoiGianKetThucHoatDong;

            var _temp_maQRDiaDiem = result.maQRDiaDiem.split("/");
            //lấy tên của ảnh từ url
            var _input_maQRDiaDiem =
              _temp_maQRDiaDiem[_temp_maQRDiaDiem.length - 1];

            var _temp_thoiGianBatDauDiemDanh_others = new Date();

            var _temp_thoiGianBatDauDiemDanh = new Date().toLocaleDateString();

            var _str_temp_TGBD = _temp_thoiGianBatDauDiemDanh.split("/");

            var year_temp = _str_temp_TGBD[2];
            var month_temp = _str_temp_TGBD[1];
            var day_temp = _str_temp_TGBD[0];

            //lấy thời gian hiện tại, convert Datetime JS sang MySQL datetime
            var _input_thoiGianBatDauDiemDanh =
              year_temp +
              "-" +
              month_temp +
              "-" +
              day_temp +
              " " +
              _temp_thoiGianBatDauDiemDanh_others.toTimeString().split(" ")[0];

            var dataPost = {
              maHoatDong: input_MaHoatDong,
              maTieuChi3: _input_maTieuChi3,
              maTieuChi2: _input_maTieuChi2,
              maKhoa: _input_maKhoa,
              tenHoatDong: _input_tenHoatDong,
              diemNhanDuoc: _input_diemNhanDuoc,
              diaDiemDienRaHoatDong: _input_diaDiemDienRaHoatDong,
              maHocKyDanhGia: _input_maHocKyDanhGia,
              maQRDiaDiem: _input_maQRDiaDiem,
              thoiGianBatDauHoatDong: _input_thoiGianBatDauHoatDong,
              thoiGianKetThucHoatDong: _input_thoiGianKetThucHoatDong,
              thoiGianBatDauDiemDanh: _input_thoiGianBatDauDiemDanh,
            };

            // Điểm danh
            $.ajax({
              url: urlapi_hoatdongdanhgia_update,
              type: "POST",
              contentType: "application/json;charset=utf-8",
              dataType: "json",
              data: JSON.stringify(dataPost),
              async: false,
              headers: { Authorization: jwtCookie },
              success: function (result_Create) {
                Swal.fire({
                  icon: "success",
                  title: "Bắt đầu điểm danh thành công!",
                  text:
                    "Hoạt động  " + input_MaHoatDong + " đã bắt đầu điểm danh!",
                  timer: 2500,
                  timerProgressBar: true,
                });

                setTimeout(function () {
                  GetListHoatdongdanhgia();
                }, 2500);
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
          } else {
            ThongBaoLoi("Hoạt động chưa mở hoặc đã kết thúc!");
          }
        },
        error: function (errorMessage) {
          //checkLoiDangNhap(errorMessage.responseJSON.message);

          ThongBaoLoi(errorMessage.responseJSON.message);
        },
      });
    }
  });
}

function LoadDanhSachThamGia(maHoatDong) {
  $("#id_tbody_DanhSachThamGia tr").remove();

  $.ajax({
    url: urlapi_thamgiahoatdong_read_MaHD + maHoatDong,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_data) {
      $.each(result_data, function (index_data) {
        for (var b = 0; b < result_data[index_data].length; b++) {
          var soThuTuSV = result_data[index_data][b].soThuTu;
          var maSinhVienThamGia = result_data[index_data][b].maSinhVienThamGia;
          var thoiGianDiemDanh = result_data[index_data][b].thoiGianDiemDanh;

          $.ajax({
            url: urlapi_sinhvien_single_read + maSinhVienThamGia,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: false,
            headers: { Authorization: jwtCookie },
            success: function (result_data_sv) {
              var tenSinhVienThamGia = result_data_sv.hoTenSinhVien;

              $("#id_tbody_DanhSachThamGia").append(
                "<tr>\
                                <td>" +
                  soThuTuSV +
                  "</td>\
                                <td>" +
                  maSinhVienThamGia +
                  "</td>\
                                <td>" +
                  tenSinhVienThamGia +
                  "</td>\
                                <td>" +
                  thoiGianDiemDanh +
                  "</td>\
                            </tr>"
              );
            },
            error: function (errorMessage) {
              //checkLoiDangNhap(errorMessage.responseJSON.message);
            },
          });
        }
      });

      $("#DSSV_text_TongSoSVThamGia").text(result_data.itemCount);
    },
    error: function (errorMessage) {
      //checkLoiDangNhap(errorMessage.responseJSON.message);
      $("#DSSV_text_TongSoSVThamGia").text("0");

      $("#id_tbody_DanhSachThamGia").append(
        '<tr>\
                <td colspan=4 style="text-align:center">Không tìm thấy kết quả.</td>\
            </tr>'
      );
    },
  });
}

function LoadThongTinChinhSua_HoatDong(maHoatDong) {
  $.ajax({
    url: urlapi_hoatdongdanhgia_single_read + maHoatDong,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_data) {
      //Hiển thị học kỳ áp dụng
      $.ajax({
        url: urlapi_hockydanhgia_single_read + result_data.maHocKyDanhGia,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_HocKy) {
          $("#edit_select_HocKyDanhGia").find("option").remove();

          $("#edit_select_HocKyDanhGia").append(
            "<option value='" +
              result_HocKy.maHocKyDanhGia +
              "' selected> " +
              result_HocKy.hocKyXet +
              " - " +
              result_HocKy.namHocXet +
              "</option>"
          );
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

      $("#edit_input_TenHoatDong").val(result_data.tenHoatDong);

      var _edit_select_Khoa = document.getElementById("edit_select_Khoa");

      for (var i = 0; i < _edit_select_Khoa.options.length; i++) {
        if (_edit_select_Khoa.options[i].value === result_data.maKhoa) {
          _edit_select_Khoa.options[i].selected = true;
        }
      }

      var _edit_select_TieuChi = document.getElementById("edit_select_TieuChi");
      for (var i = 0; i < _edit_select_TieuChi.options.length; i++) {
        if (
          _edit_select_TieuChi.options[i].value ===
            "TC2_" + result_data.maTieuChi2 ||
          _edit_select_TieuChi.options[i].value ===
            "TC3_" + result_data.maTieuChi3
        ) {
          _edit_select_TieuChi.options[i].selected = true;
        }
      }

      $("#edit_input_DiemNhanDuoc").val(result_data.diemNhanDuoc);
      $("#edit_input_DiaDiemHoatDong").val(result_data.diaDiemDienRaHoatDong);
      $("#edit_input_ThoiGianBatDau").val(result_data.thoiGianBatDauHoatDong);
      $("#edit_input_ThoiGianKetThuc").val(result_data.thoiGianKetThucHoatDong);

      dselect(_edit_select_Khoa, {
        search: true,
      });

      dselect(_edit_select_TieuChi, {
        search: true,
      });
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

function ChinhSua_HoatDong() {
  var _edit_input_MaHoatDong = $("#edit_input_MaHoatDong").val();
  var _edit_input_TenHoatDong = $("#edit_input_TenHoatDong").val();
  var _edit_select_Khoa = $("#edit_select_Khoa option:selected").val();
  var _edit_select_TieuChi = $("#edit_select_TieuChi option:selected").val();
  var _edit_input_DiemNhanDuoc = $("#edit_input_DiemNhanDuoc").val();
  var _edit_input_DiaDiemHoatDong = $("#edit_input_DiaDiemHoatDong").val();
  var _edit_input_ThoiGianBatDau = $("#edit_input_ThoiGianBatDau").val();
  var _edit_input_ThoiGianKetThuc = $("#edit_input_ThoiGianKetThuc").val();

  if (
    _edit_input_TenHoatDong == "" ||
    _edit_input_DiemNhanDuoc == "" ||
    _edit_input_DiaDiemHoatDong == "" ||
    _edit_input_ThoiGianBatDau == "" ||
    _edit_input_ThoiGianKetThuc == ""
  ) {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {
    $.ajax({
      url: urlapi_hoatdongdanhgia_single_read + _edit_input_MaHoatDong,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: false,
      headers: { Authorization: jwtCookie },
      success: function (result_data) {
        var _edit_maTieuChi_sliced = _edit_select_TieuChi.slice(0, 3);
        var _edit_value_maTieuChi = _edit_select_TieuChi.slice(
          4,
          _edit_select_TieuChi.length
        );

        //Tạo hoạt động đánh giá
        if (_edit_maTieuChi_sliced == "TC2") {
          var dataPost = {
            maHoatDong: _edit_input_MaHoatDong,
            maTieuChi2: _edit_value_maTieuChi,
            maTieuChi3: null,
            maHocKyDanhGia: result_data.maHocKyDanhGia,
            tenHoatDong: _edit_input_TenHoatDong,
            maKhoa: _edit_select_Khoa,
            diemNhanDuoc: _edit_input_DiemNhanDuoc,
            diaDiemDienRaHoatDong: _edit_input_DiaDiemHoatDong,
            thoiGianBatDauHoatDong: _edit_input_ThoiGianBatDau,
            thoiGianKetThucHoatDong: _edit_input_ThoiGianKetThuc,
            thoiGianBatDauDiemDanh: result_data.thoiGianBatDauDiemDanh,
          };

          $.ajax({
            url: urlapi_hoatdongdanhgia_update,
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
                title:
                  "Chỉnh sửa thành công hoạt động mã " +
                  _edit_input_MaHoatDong +
                  " !",
                text: "",
                timer: 2000,
                timerProgressBar: true,
              });

              setTimeout(function () {
                GetListHoatdongdanhgia();
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

        if (maTieuChi_sliced == "TC3") {
          var dataPost = {
            maHoatDong: _edit_input_MaHoatDong,
            maTieuChi2: null,
            maTieuChi3: _edit_value_maTieuChi,
            maHocKyDanhGia: result_data.maHocKyDanhGia,
            tenHoatDong: _edit_input_TenHoatDong,
            maKhoa: _edit_select_Khoa,
            diemNhanDuoc: _edit_input_DiemNhanDuoc,
            diaDiemDienRaHoatDong: _edit_input_DiaDiemHoatDong,
            thoiGianBatDauHoatDong: _edit_input_ThoiGianBatDau,
            thoiGianKetThucHoatDong: _edit_input_ThoiGianKetThuc,
            thoiGianBatDauDiemDanh: result_data.thoiGianBatDauDiemDanh,
          };

          $.ajax({
            url: urlapi_hoatdongdanhgia_update,
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
                title:
                  "Chỉnh sửa thành công hoạt động mã " +
                  _edit_input_MaHoatDong +
                  " !",
                text: "",
                timer: 2000,
                timerProgressBar: true,
              });

              setTimeout(function () {
                GetListHoatdongdanhgia();
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
