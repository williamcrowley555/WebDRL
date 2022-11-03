//helpers
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

//set họ tên và mã số từ cookie
if (getCookie("hoTen") != null) {
  $("#text_HoTen").text(getCookie("hoTen"));
}

if (getCookie("maSo") != null) {
  $("#text_MaSo").text(getCookie("maSo"));

  getThongTinCoVanSinhVien(getCookie("maSo"));
}

function getThongTinCoVanSinhVien(maSinhVien) {
  $.ajax({
    url: urlapi_sinhvien_single_read + maSinhVien,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result_sv) {
      var maLop_sv = result_sv.maLop;

      $.ajax({
        url: urlapi_lop_single_read + maLop_sv,
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {
          Authorization: jwtCookie,
        },
        success: function (result_lop) {
          var maCoVanHocTap_lop = result_lop.maCoVanHocTap;

          $.ajax({
            url: urlapi_covanhoctap_single_read + maCoVanHocTap_lop,
            async: false,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            headers: {
              Authorization: jwtCookie,
            },
            success: function (result_cvht) {
              $("#text_maLop").text(maLop_sv);
              $("#text_HoTenCoVan").text(result_cvht.hoTenCoVan);
              $("#text_MaCoVan").text(result_cvht.maCoVanHocTap);
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
      thongBaoLoi(errorMessage.responseJSON.message);
    },
  });
}

// function lấy thông tin thông báo đánh giá, học kỳ đánh giá
function getThongTinHocKyDanhGia() {
  $.ajax({
    url: urlapi_thongbaodanhgia_read,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result) {
      $.each(result, function (index) {
        for (var p = 0; p < result[index].length; p++) {
          var ngaySinhVienDanhGia = new Date(
            result[index][p].ngaySinhVienDanhGia
          );
          ngaySinhVienDanhGia.setHours(0, 0, 0, 0);

          var ngaySinhVienKetThucDanhGia = new Date(
            result[index][p].ngaySinhVienKetThucDanhGia
          );
          ngaySinhVienKetThucDanhGia.setHours(23, 59, 59, 999);

          var maHocKyDanhGia = result[index][p].maHocKyDanhGia;

          //lấy ngày hiện tại
          var today = new Date();
          var ngayHienTai = new Date(
            today.getFullYear() +
              "-" +
              (today.getMonth() + 1) +
              "-" +
              today.getDate()
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
              if (result_HKDG != null) {
                var maHocKyDanhGia_HKDG = result_HKDG.maHocKyDanhGia;
                var hocKyXet_HKDG = result_HKDG.hocKyXet;
                var namHocXet_HKDG = result_HKDG.namHocXet;

                //trường hợp đang trong thời gian học kỳ mở chấm và ngược lại
                if (
                  ngayHienTai.getTime() >= ngaySinhVienDanhGia.getTime() &&
                  ngayHienTai.getTime() <= ngaySinhVienKetThucDanhGia.getTime()
                ) {
                  //kiểm tra xem có tồn tại phiếu rèn luyện chưa, nếu có = đã chấm
                  $.ajax({
                    url:
                      urlapi_phieurenluyen_single_read_MaHKDG_MaSV +
                      maHocKyDanhGia_HKDG +
                      "&maSinhVien=" +
                      getCookie("maSo"),
                    async: false,
                    type: "GET",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json",
                    headers: {
                      Authorization: jwtCookie,
                    },
                    success: function (resultRead) {
                      if (resultRead.coVanDuyet == 0) {
                        if (resultRead.khoaDuyet == 0) {
                          $("#tbody_hocKyDanhGia").append(
                            "<tr><td><p class='fw-normal mb-1'>" +
                              hocKyXet_HKDG +
                              "</p></td>\
                                                        <td><p class='fw-normal mb-1'>" +
                              namHocXet_HKDG +
                              "</p></td>\
                                                        <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã chấm</span></td>\
                                                        <td><span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span></td>\
                                                        <td><span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span></td>\
                                                        <td><p class='fw-normal mb-1'>" +
                              resultRead.diemTongCong +
                              "</p></td>\
                                                        <td><p class='fw-normal mb-1'>" +
                              resultRead.xepLoai +
                              "</p></td>\
                                                        <td><span>" +
                              ngaySinhVienDanhGia.toLocaleDateString() +
                              "</span></td>\
                                                        <td><span>" +
                              ngaySinhVienKetThucDanhGia.toLocaleDateString() +
                              "</span></td>\
                                                        <td>\
                                                            <a href='chamdiemchitiet.php?maHocKy=" +
                              maHocKyDanhGia_HKDG +
                              "' ><button type='button' class='btn btn-warning' style='color: white;width: max-content;'>Chấm lại</button></a>\
                                                        </td>\
                                                    </tr>"
                          );
                        } else {
                          $("#tbody_hocKyDanhGia").append(
                            "<tr><td><p class='fw-normal mb-1'>" +
                              hocKyXet_HKDG +
                              "</p></td>\
                                                        <td><p class='fw-normal mb-1'>" +
                              namHocXet_HKDG +
                              "</p></td>\
                                                        <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã chấm</span></td>\
                                                        <td><span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span></td>\
                                                        <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã duyệt</span></td>\
                                                        <td><p class='fw-normal mb-1'>" +
                              resultRead.diemTongCong +
                              "</p></td>\
                                                        <td><p class='fw-normal mb-1'>" +
                              resultRead.xepLoai +
                              "</p></td>\
                                                        <td><span>" +
                              ngaySinhVienDanhGia.toLocaleDateString() +
                              "</span></td>\
                                                        <td><span>" +
                              ngaySinhVienKetThucDanhGia.toLocaleDateString() +
                              "</span></td>\
                                                        <td>\
                                                            <a href='chamdiemchitiet.php?maHocKy=" +
                              maHocKyDanhGia_HKDG +
                              "' ><button type='button' class='btn btn-warning' style='color: white;width: max-content;'>Chấm lại</button></a>\
                                                        </td>\
                                                    </tr>"
                          );
                        }
                      } else {
                        if (resultRead.khoaDuyet == 0) {
                          $("#tbody_hocKyDanhGia").append(
                            "<tr><td><p class='fw-normal mb-1'>" +
                              hocKyXet_HKDG +
                              "</p></td>\
                                                    <td><p class='fw-normal mb-1'>" +
                              namHocXet_HKDG +
                              "</p></td>\
                                                    <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã chấm</span></td>\
                                                    <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã duyệt</span></td>\
                                                    <td><span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span></td>\
                                                    <td><p class='fw-normal mb-1'>" +
                              resultRead.diemTongCong +
                              "</p></td>\
                                                    <td><p class='fw-normal mb-1'>" +
                              resultRead.xepLoai +
                              "</p></td>\
                                                    <td><span>" +
                              ngaySinhVienDanhGia.toLocaleDateString() +
                              "</span></td>\
                                                    <td><span>" +
                              ngaySinhVienKetThucDanhGia.toLocaleDateString() +
                              "</span></td>\
                                                    <td>\
                                                    <a href='chamdiemchitiet.php?maHocKy=" +
                              maHocKyDanhGia_HKDG +
                              "' ><button type='button' class='btn btn-warning' style='color: white;width: max-content;'>Chấm lại</button></a>\
                                                    </td>\
                                                </tr>"
                          );
                        } else {
                          $("#tbody_hocKyDanhGia").append(
                            "<tr><td><p class='fw-normal mb-1'>" +
                              hocKyXet_HKDG +
                              "</p></td>\
                                                    <td><p class='fw-normal mb-1'>" +
                              namHocXet_HKDG +
                              "</p></td>\
                                                    <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã chấm</span></td>\
                                                    <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã duyệt</span></td>\
                                                    <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã duyệt</span></td>\
                                                    <td><p class='fw-normal mb-1'>" +
                              resultRead.diemTongCong +
                              "</p></td>\
                                                    <td><p class='fw-normal mb-1'>" +
                              resultRead.xepLoai +
                              "</p></td>\
                                                    <td><span>" +
                              ngaySinhVienDanhGia.toLocaleDateString() +
                              "</span></td>\
                                                    <td><span>" +
                              ngaySinhVienKetThucDanhGia.toLocaleDateString() +
                              "</span></td>\
                                                    <td>\
                                                        <a href='chamdiemchitiet.php?maHocKy=" +
                              maHocKyDanhGia_HKDG +
                              "' ><button type='button' class='btn btn-warning' style='color: white;width: max-content;'>Chấm lại</button></a>\
                                                    </td>\
                                                </tr>"
                          );
                        }
                      }
                    },
                    error: function (errorMessage) {
                      $("#tbody_hocKyDanhGia").append(
                        "<tr><td><p class='fw-normal mb-1'>" +
                          hocKyXet_HKDG +
                          "</p></td>\
                                                <td><p class='fw-normal mb-1'>" +
                          namHocXet_HKDG +
                          "</p></td>\
                                                <td><span class='badge badge-warning' style='color: black;font-size: inherit;'>Đang mở chấm</span></td>\
                                                <td></td>\
                                                <td></td>\
                                                <td></td>\
                                                <td></td>\
                                                <td><span>" +
                          ngaySinhVienDanhGia.toLocaleDateString() +
                          "</span></td>\
                                                <td><span>" +
                          ngaySinhVienKetThucDanhGia.toLocaleDateString() +
                          "</span></td>\
                                                <td>\
                                                    <a href='chamdiemchitiet.php?maHocKy=" +
                          maHocKyDanhGia_HKDG +
                          "' ><button type='button' class='btn btn-info' style='color: white;width: max-content;'>Chấm điểm</button></a>\
                                                </td>\
                                            </tr>"
                      );
                    },
                  });
                } else {
                  //kiểm tra xem có tồn tại phiếu rèn luyện chưa, nếu có = đã chấm
                  $.ajax({
                    url:
                      urlapi_phieurenluyen_single_read_MaHKDG_MaSV +
                      maHocKyDanhGia_HKDG +
                      "&maSinhVien=" +
                      getCookie("maSo"),
                    async: false,
                    type: "GET",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json",
                    headers: {
                      Authorization: jwtCookie,
                    },
                    success: function (resultRead) {
                      if (resultRead != null) {
                        if (resultRead.coVanDuyet == 0) {
                          if (resultRead.khoaDuyet == 0) {
                            $("#tbody_hocKyDanhGia").append(
                              "<tr><td><p class='fw-normal mb-1'>" +
                                hocKyXet_HKDG +
                                "</p></td>\
                                                            <td><p class='fw-normal mb-1'>" +
                                namHocXet_HKDG +
                                "</p></td>\
                                                            <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã chấm</span></td>\
                                                            <td><span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span></td>\
                                                            <td><span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span></td>\
                                                            <td><p class='fw-normal mb-1'>" +
                                resultRead.diemTongCong +
                                "</p></td>\
                                                            <td><p class='fw-normal mb-1'>" +
                                resultRead.xepLoai +
                                "</p></td>\
                                                            <td><span>" +
                                ngaySinhVienDanhGia.toLocaleDateString() +
                                "</span></td>\
                                                            <td><span>" +
                                ngaySinhVienKetThucDanhGia.toLocaleDateString() +
                                "</span></td>\
                                                            <td>\
                                                            <a href='chamdiemchitiet.php?maHocKy=" +
                                maHocKyDanhGia_HKDG +
                                "' ><button type='button' class='btn btn-light' style='color: black;width: max-content;'> Xem chi tiết</button></a>\
                                                            </td>\
                                                        </tr>"
                            );
                          } else {
                            $("#tbody_hocKyDanhGia").append(
                              "<tr><td><p class='fw-normal mb-1'>" +
                                hocKyXet_HKDG +
                                "</p></td>\
                                                            <td><p class='fw-normal mb-1'>" +
                                namHocXet_HKDG +
                                "</p></td>\
                                                            <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã chấm</span></td>\
                                                            <td><span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span></td>\
                                                            <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã duyệt</span></td>\
                                                            <td><p class='fw-normal mb-1'>" +
                                resultRead.diemTongCong +
                                "</p></td>\
                                                            <td><p class='fw-normal mb-1'>" +
                                resultRead.xepLoai +
                                "</p></td>\
                                                            <td><span>" +
                                ngaySinhVienDanhGia.toLocaleDateString() +
                                "</span></td>\
                                                            <td><span>" +
                                ngaySinhVienKetThucDanhGia.toLocaleDateString() +
                                "</span></td>\
                                                            <td>\
                                                            <a href='chamdiemchitiet.php?maHocKy=" +
                                maHocKyDanhGia_HKDG +
                                "' ><button type='button' class='btn btn-light' style='color: black;width: max-content;'> Xem chi tiết</button></a>\
                                                            </td>\
                                                        </tr>"
                            );
                          }
                        } else {
                          if (resultRead.khoaDuyet == 0) {
                            $("#tbody_hocKyDanhGia").append(
                              "<tr><td><p class='fw-normal mb-1'>" +
                                hocKyXet_HKDG +
                                "</p></td>\
                                                        <td><p class='fw-normal mb-1'>" +
                                namHocXet_HKDG +
                                "</p></td>\
                                                        <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã chấm</span></td>\
                                                        <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã duyệt</span></td>\
                                                        <td><span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span></td>\
                                                        <td><p class='fw-normal mb-1'>" +
                                resultRead.diemTongCong +
                                "</p></td>\
                                                        <td><p class='fw-normal mb-1'>" +
                                resultRead.xepLoai +
                                "</p></td>\
                                                        <td><span>" +
                                ngaySinhVienDanhGia.toLocaleDateString() +
                                "</span></td>\
                                                        <td><span>" +
                                ngaySinhVienKetThucDanhGia.toLocaleDateString() +
                                "</span></td>\
                                                        <td>\
                                                        <a href='chamdiemchitiet.php?maHocKy=" +
                                maHocKyDanhGia_HKDG +
                                "' ><button type='button' class='btn btn-light' style='color: black;width: max-content;'> Xem chi tiết</button></a>\
                                                        </td>\
                                                    </tr>"
                            );
                          } else {
                            $("#tbody_hocKyDanhGia").append(
                              "<tr><td><p class='fw-normal mb-1'>" +
                                hocKyXet_HKDG +
                                "</p></td>\
                                                        <td><p class='fw-normal mb-1'>" +
                                namHocXet_HKDG +
                                "</p></td>\
                                                        <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã chấm</span></td>\
                                                        <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã duyệt</span></td>\
                                                        <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã duyệt</span></td>\
                                                        <td><p class='fw-normal mb-1'>" +
                                resultRead.diemTongCong +
                                "</p></td>\
                                                        <td><p class='fw-normal mb-1'>" +
                                resultRead.xepLoai +
                                "</p></td>\
                                                        <td><span>" +
                                ngaySinhVienDanhGia.toLocaleDateString() +
                                "</span></td>\
                                                        <td><span>" +
                                ngaySinhVienKetThucDanhGia.toLocaleDateString() +
                                "</span></td>\
                                                        <td>\
                                                        <a href='chamdiemchitiet.php?maHocKy=" +
                                maHocKyDanhGia_HKDG +
                                "' ><button type='button' class='btn btn-light' style='color: black;width: max-content;'> Xem chi tiết</button></a>\
                                                        </td>\
                                                    </tr>"
                            );
                          }
                        }
                      }
                    },
                    error: function (errorMessage) {
                      $("#tbody_hocKyDanhGia").append(
                        "<tr><td><p class='fw-normal mb-1'>" +
                          hocKyXet_HKDG +
                          "</p></td>\
                                                <td><p class='fw-normal mb-1'>" +
                          namHocXet_HKDG +
                          "</p></td>\
                                                <td><span class='badge badge-danger' style='color: black;font-size: inherit;'>Chưa chấm</span></td>\
                                                <td></td>\
                                                <td></td>\
                                                <td></td>\
                                                <td></td>\
                                                <td><span>" +
                          ngaySinhVienDanhGia.toLocaleDateString() +
                          "</span></td>\
                                                <td><span>" +
                          ngaySinhVienKetThucDanhGia.toLocaleDateString() +
                          "</span></td>\
                                                <td>\
                                                    <span>Ngoài thời gian chấm, liên hệ phòng Công tác sinh viên</span>\
                                                </td>\
                                            </tr>"
                      );
                    },
                  });
                }
              }
            },
            error: function (errorMessage) {
              thongBaoLoi(errorMessage.responseText);
            },
          });
        }
      });
    },
    error: function (errorMessage) {
      thongBaoLoi(errorMessage.responseText);
    },
  });
}
