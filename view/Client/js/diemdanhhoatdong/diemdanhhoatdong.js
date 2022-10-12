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

function thongBaoLoi(message) {
  Swal.fire({
    icon: "error",
    title: "Lỗi",
    text: message,
    //timer: 5000,
    timerProgressBar: true,
  });
}

var jwtCookie = getCookie("jwt");

var url = new URL(window.location.href);
var GET_maHoatDong = url.searchParams.get("maHoatDong");

//-------------------------------------
function HienThiThongTin() {
  if (GET_maHoatDong != null) {
    if (GET_maHoatDong.trim() != "") {
      $.ajax({
        url: urlapi_hoatdongdanhgia_single_read + GET_maHoatDong,
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {
          Authorization: jwtCookie,
        },
        success: function (result_HoatDongDanhGia) {
          var thoiGianBatDauHoatDong = new Date(
            result_HoatDongDanhGia.thoiGianBatDauHoatDong
          );
          var thoiGianKetThucHoatDong = new Date(
            result_HoatDongDanhGia.thoiGianKetThucHoatDong
          );

          //lấy ngày hiện tại
          var today = new Date();

          if (
            today.getTime() >= thoiGianBatDauHoatDong.getTime() &&
            today.getTime() <= thoiGianKetThucHoatDong.getTime()
          ) {
            //vẫn còn trong thời gian
            getThongTinHoatDong();
            //http://localhost/WebDRL/view/Client/pages/diemdanhhoatdong.php?maHoatDong=12
          } else {
            Swal.fire({
              icon: "error",
              title: "Hoạt động chưa mở hoặc đã kết thúc!",
              text: "Đang chuyển hướng...",
              timer: 5000,
              timerProgressBar: true,
            });

            window.setTimeout(function () {
              window.location.href = "tracuuhoatdongthamgia.php";
            }, 5000);
          }
        },
        error: function (errorMessage_tc3) {
          thongBaoLoi(errorMessage_tc3.responseJSON.message);
        },
      });
    } else {
      window.location.href = "tracuuhoatdongthamgia.php";
    }
  } else {
    window.location.href = "tracuuhoatdongthamgia.php";
  }
}

function getThongTinHoatDong() {
  $.ajax({
    url: urlapi_hoatdongdanhgia_single_read + GET_maHoatDong,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result_DanhGia) {
      var maTieuChi2 = result_DanhGia.maTieuChi2;
      var maTieuChi3 = result_DanhGia.maTieuChi3;
      var maKhoa = result_DanhGia.maKhoa;
      var tenHoatDong = result_DanhGia.tenHoatDong;
      var diemNhanDuoc = result_DanhGia.diemNhanDuoc;
      var diaDiemDienRaHoatDong = result_DanhGia.diaDiemDienRaHoatDong;
      var maQRDiaDiem = result_DanhGia.maQRDiaDiem;
      var thoiGianBatDauHoatDong = new Date(
        result_DanhGia.thoiGianBatDauHoatDong
      );
      var thoiGianKetThucHoatDong = new Date(
        result_DanhGia.thoiGianKetThucHoatDong
      );
      var maHocKyDanhGia = result_DanhGia.maHocKyDanhGia;
      var thoiGianBatDauDiemDanh = new Date(
        result_DanhGia.thoiGianBatDauDiemDanh
      );

      $.ajax({
        url: urlapi_hockydanhgia_single_read + maHocKyDanhGia,
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {
          Authorization: jwtCookie,
        },
        success: function (result_HKDG) {
          var hocKyXet = result_HKDG.hocKyXet;
          var namHocXet = result_HKDG.namHocXet;

          $.ajax({
            url: urlapi_khoa_single_read + maKhoa,
            async: false,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            headers: {
              Authorization: jwtCookie,
            },
            success: function (result_Khoa) {
              var tenKhoa = result_Khoa.tenKhoa;
              var tenTieuChi = "";

              //Tiêu chí 2
              if (maTieuChi2 != 0) {
                $.ajax({
                  url: urlapi_tieuchicap2_single_read + maTieuChi2,
                  async: false,
                  type: "GET",
                  contentType: "application/json;charset=utf-8",
                  dataType: "json",
                  headers: {
                    Authorization: jwtCookie,
                  },
                  success: function (result_TC2) {
                    tenTieuChi = result_TC2.noidung;
                  },
                  error: function (errorMessage) {
                    thongBaoLoi(errorMessage.responseJSON.message);
                  },
                });
              }

              //Tiêu chí 3
              if (maTieuChi3 != 0) {
                $.ajax({
                  url: urlapi_tieuchicap3_single_read + maTieuChi3,
                  async: false,
                  type: "GET",
                  contentType: "application/json;charset=utf-8",
                  dataType: "json",
                  headers: {
                    Authorization: jwtCookie,
                  },
                  success: function (result_TC3) {
                    tenTieuChi = result_TC3.noidung;
                  },
                  error: function (errorMessage) {
                    thongBaoLoi(errorMessage.responseJSON.message);
                  },
                });
              }

              $("#part_thongTinHoatDong").append(
                "\
                            <div class='list-group-item list-group-item-action' >\
                              <span style='font-weight: bold;' >Mã hoạt động: </span><span id='input_MaHoatDong' >" +
                  GET_maHoatDong +
                  "</span> \
                            </div>\
                            <div class='list-group-item list-group-item-action' >\
                              <span style='font-weight: bold;'>Tên hoạt động: </span>" +
                  tenHoatDong +
                  "\
                            </div>\
                            <div class='list-group-item list-group-item-action' >\
                                  <span style='font-weight: bold;'>Khoa tổ chức: </span>" +
                  tenKhoa +
                  "\
                            </div>\
                            <div class='list-group-item list-group-item-action' >\
                                <span style='font-weight: bold;'>Học kỳ áp dụng: </span>" +
                  hocKyXet +
                  " - Năm học: " +
                  namHocXet +
                  "\
                            </div>\
                            <div class='list-group-item list-group-item-action' >\
                                <span style='font-weight: bold;'>Điểm nhận được: </span>" +
                  diemNhanDuoc +
                  "\
                            </div>\
                            <div class='list-group-item list-group-item-action' >\
                                <span style='font-weight: bold;'>Mục được cộng điểm: </span>" +
                  tenTieuChi +
                  "\
                            </div>\
                            <div class='list-group-item list-group-item-action' >\
                                <span style='font-weight: bold;'>Địa điểm diễn ra hoạt động: </span>" +
                  diaDiemDienRaHoatDong +
                  "\
                            </div>\
                            <div class='list-group-item list-group-item-action' >\
                                <span style='font-weight: bold;'>Thời gian bắt đầu: </span>" +
                  thoiGianBatDauHoatDong.toLocaleString() +
                  "\
                            </div>\
                            <div class='list-group-item list-group-item-action' >\
                                <span style='font-weight: bold;'>Thời gian kết thúc: </span>" +
                  thoiGianKetThucHoatDong.toLocaleString() +
                  "\
                            </div>\
                            <div class='list-group-item list-group-item-action' >\
                                <span style='font-weight: bold;'>Mã QR: </span><img src='" +
                  maQRDiaDiem +
                  "' width='15%' />\
                            </div>"
              );

              //Set countdown thời gian điểm danh
              if (isNaN(Date.parse(thoiGianBatDauDiemDanh))) {
                $("#text_thoiGianDiemDanh").text(
                  "Ban tổ chức chưa mở thời gian điểm danh!"
                );
                //$("#btn_DiemDanh").remove();
              } else {
                //Thêm 5 phút từ lúc nhấn nút bắt đầu điểm danh
                var countDownDate = new Date(
                  thoiGianBatDauDiemDanh.setMinutes(
                    thoiGianBatDauDiemDanh.getMinutes() + 5
                  )
                ).getTime();

                $("#part_DiemDanh").append(
                  "<button type='button' class='btn btn-warning' style='width: auto;color: white;font-size: x-large;' id='btn_DiemDanh' onclick='return DiemDanh()' >\
                            Điểm danh</button>"
                );

                setCountDownDiemDanh(countDownDate);
              }
            },
            error: function (errorMessage) {
              thongBaoLoi(errorMessage.responseJSON.message);
            },
          });
        },
        error: function (errorMessage) {
          thongBaoLoi(errorMessage.responseJSON.message);
        },
      });
    },
    error: function (errorMessage) {
      //Không tìm thấy mã hoạt động thì chuyển về trang tra cứu
      console.log(errorMessage.responseJSON.message);
      window.location.href = "tracuuhoatdongthamgia.php";
    },
  });
}

function setCountDownDiemDanh(countDownDate) {
  var myfunc = setInterval(function () {
    var now = new Date().getTime();
    var timeleft = countDownDate - now;

    // Calculating the days, hours, minutes and seconds left
    //var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
    //var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);

    // Result is output to the specific element
    document.getElementById("text_thoiGianDiemDanh").innerHTML =
      "Thời gian điểm danh còn lại:";
    document.getElementById("text_Timer").innerHTML =
      ("0" + minutes).slice(-2) + ":" + ("0" + seconds).slice(-2);

    // Display the message when countdown is over
    if (timeleft < 0) {
      clearInterval(myfunc);
      document.getElementById("text_Timer").innerHTML = "";
      document.getElementById("text_thoiGianDiemDanh").style.color = "red";
      document.getElementById("text_thoiGianDiemDanh").innerHTML =
        "Đã hết thời gian điểm danh!";
      $("#btn_DiemDanh").remove();
    }
  }, 1000);
}

function DiemDanh() {
  var _text_thoiGianDiemDanh = $("#text_thoiGianDiemDanh").text();

  if (_text_thoiGianDiemDanh != "Đã hết thời gian điểm danh!") {
    var _maSinhVienThamGia = getCookie("maSo");

    if (_maSinhVienThamGia) {
      $.ajax({
        url: urlapi_sinhvien_single_read + _maSinhVienThamGia,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_data) {
          var _temp_thoiGianBatDauDiemDanh_others = new Date();

          var _temp_thoiGianBatDauDiemDanh = new Date().toLocaleDateString();

          var _str_temp_TGBD = _temp_thoiGianBatDauDiemDanh.split("/");

          var year_temp = _str_temp_TGBD[2];
          var month_temp = _str_temp_TGBD[1];
          var day_temp = _str_temp_TGBD[0];

          var _thoiGianDiemDanh =
            year_temp +
            "-" +
            month_temp +
            "-" +
            day_temp +
            " " +
            _temp_thoiGianBatDauDiemDanh_others.toTimeString().split(" ")[0];

          var dataPost = {
            maHoatDong: GET_maHoatDong,
            maSinhVienThamGia: _maSinhVienThamGia,
            thoiGianDiemDanh: _thoiGianDiemDanh,
          };

          $.ajax({
            url: urlapi_thamgiahoatdong_create,
            async: false,
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            data: JSON.stringify(dataPost),
            headers: {
              Authorization: jwtCookie,
            },
            success: function (result_TGHD) {
              Swal.fire({
                icon: "success",
                title: "Điểm danh thành công!",
                text: "",
                timer: 5000,
                timerProgressBar: true,
              });

              $("#btn_DiemDanh").remove();

              $("#text_TrangThaiDiemDanh").text("Đã điểm danh!");
            },
            error: function (errorMessage) {
              thongBaoLoi(errorMessage.responseText);
            },
          });
        },
        error: function (errorMessage) {
          //checkLoiDangNhap(errorMessage.responseJSON.message);

          thongBaoLoi("Phần điểm danh chỉ dành cho sinh viên!");
        },
      });
    } else {
      return;
    }
  } else {
    $("#btn_DiemDanh").remove();
    thongBaoLoi("Đã hết thời gian điểm danh!");
  }
}

function checkDiemDanh() {
  var _maSinhVienThamGia = getCookie("maSo");

  $.ajax({
    url:
      urlapi_thamgiahoatdong_single_read +
      GET_maHoatDong +
      "&maSinhVienThamGia=" +
      _maSinhVienThamGia,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result_TG) {
      $("#btn_DiemDanh").remove();
      $("#text_TrangThaiDiemDanh").text("Đã điểm danh!");
    },
    error: function (errorMessage) {
      $("#text_TrangThaiDiemDanh").text("Chưa điểm danh!");
    },
  });
}
