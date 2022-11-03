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

var url = new URL(window.location.href);
var GET_MaLop = url.searchParams.get("maLop");

if (GET_MaLop != null || GET_MaHocKy.trim() != "") {
  $("#text_Lop").text(GET_MaLop);
}

//Check mã lớp hợp lệ
$.ajax({
  url: urlapi_lop_single_read + GET_MaLop,
  async: false,
  type: "GET",
  contentType: "application/json;charset=utf-8",
  dataType: "json",
  headers: {
    Authorization: jwtCookie,
  },
  success: function (result) {
    //hợp lệ
  },
  error: function (errorMessage) {
    window.location.href = "tracuudiemrenluyen.php";
  },
});

//--------------------------------//
function LoadComboBoxHocKy() {
  $.ajax({
    url: urlapi_hockydanhgia_read,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result_HKDG) {
      if (result_HKDG != null) {
        $("#select_HocKyDanhGia").find("option").remove();

        $.each(result_HKDG, function (index) {
          for (var p = 0; p < result_HKDG[index].length; p++) {
            var hocKyXet = result_HKDG[index][p].hocKyXet;
            var namHocXet = result_HKDG[index][p].namHocXet;
            var maHocKyDanhGia = result_HKDG[index][p].maHocKyDanhGia;

            $("#select_HocKyDanhGia").append(
              "<option value='" +
                maHocKyDanhGia +
                "'>Học kỳ " +
                hocKyXet +
                " - " +
                namHocXet +
                "</option>"
            );
          }
        });
      }
    },
    error: function (errorMessage) {
      thongBaoLoi(errorMessage.responseText);
    },
  });
}

function getDanhSachDRLSinhVienLopTheoHocKy(maLop, maHocKyDanhGia) {
  //Ajax sinh vien
  $.ajax({
    url: urlapi_sinhvien_read_maLop + maLop,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result_SV) {
      $("#text_ketQuaTimKiem").text("");

      $.each(result_SV, function (index) {
        for (var p = 0; p < result_SV[index].length; p++) {
          var soThuTu = result_SV[index][p].soThuTu;
          var maSinhVien = result_SV[index][p].maSinhVien;
          var hoTenSinhVien = result_SV[index][p].hoTenSinhVien;
          var ngaySinhSV = result_SV[index][p].ngaySinh;

          //Ajax phieurenluyen
          $.ajax({
            url:
              urlapi_phieurenluyen_single_read_MaHKDG_MaSV +
              maHocKyDanhGia +
              "&maSinhVien=" +
              maSinhVien +
              "",
            async: false,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            headers: {
              Authorization: jwtCookie,
            },
            success: function (result_PRL) {
              //Nếu tìm thấy thì xử lý ở đây ngược lại xử lý ở error
              //coVanDuyet = 0 thì đã chấm nhưng cố vấn chưa duyệt, ngược lại = 1 là đã duyệt
              $.ajax({
                url: urlapi_thongbaodanhgia_single_read_MaHKDG + maHocKyDanhGia,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                  Authorization: jwtCookie,
                },
                success: function (result_HKDG) {
                  var ngayCoVanDanhGia = new Date(result_HKDG.ngayCoVanDanhGia);
                  ngayCoVanDanhGia.setHours(0, 0, 0, 0);

                  var ngayCoVanKetThucDanhGia = new Date(
                    result_HKDG.ngayCoVanKetThucDanhGia
                  );
                  ngayCoVanKetThucDanhGia.setHours(23, 59, 59, 999);

                  var today = new Date();
                  var ngayHienTai = new Date(
                    today.getFullYear() +
                      "-" +
                      (today.getMonth() + 1) +
                      "-" +
                      today.getDate()
                  );

                  if (
                    ngayHienTai.getTime() >= ngayCoVanDanhGia.getTime() &&
                    ngayHienTai.getTime() <= ngayCoVanKetThucDanhGia.getTime()
                  ) {
                    if (result_PRL.coVanDuyet == 0) {
                      $("#tbody_DanhSachDiemTheoKy").append(
                        "<tr>\
                                                <td>" +
                          soThuTu +
                          "</td>\
                                                <td><p class='fw-normal mb-1'>" +
                          maSinhVien +
                          "</p></td>\
                                                <td><p class='fw-normal mb-1'>" +
                          hoTenSinhVien +
                          "</p></td>\
                                                <td><p class='fw-normal mb-1'>" +
                          new Date(ngaySinhSV).toLocaleDateString() +
                          "</p></td>\
                                                <td><span class='badge badge-success' style='color: black;font-size: smaller;'>Đã chấm</span></td>\
                                                <td><span class='badge badge-warning' style='color: black;font-size: smaller;'>Chưa duyệt</span></td>\
                                                <td>" +
                          result_PRL.diemTongCong +
                          "</td>\
                                                <td>" +
                          result_PRL.xepLoai +
                          "</td>\
                                                <td>\
                                                    <a href='chamdiemchitiet.php?maSinhVien=" +
                          maSinhVien +
                          "&maHocKy=" +
                          maHocKyDanhGia +
                          "' ><button type='button' class='btn btn-primary' style='color: white;width: max-content;'>Xem và duyệt</button></a>\
                                                </td>\
                                            </tr>"
                      );
                    } else {
                      $("#tbody_DanhSachDiemTheoKy").append(
                        "<tr>\
                                                <td>" +
                          soThuTu +
                          "</td>\
                                                <td><p class='fw-normal mb-1'>" +
                          maSinhVien +
                          "</p></td>\
                                                <td><p class='fw-normal mb-1'>" +
                          hoTenSinhVien +
                          "</p></td>\
                                                <td><p class='fw-normal mb-1'>" +
                          new Date(ngaySinhSV).toLocaleDateString() +
                          "</p></td>\
                                                <td><span class='badge badge-success' style='color: black;font-size: smaller;'>Đã chấm</span></td>\
                                                <td><span class='badge badge-success' style='color: black;font-size: smaller;'>Đã duyệt</span></td>\
                                                <td>" +
                          result_PRL.diemTongCong +
                          "</td>\
                                                <td>" +
                          result_PRL.xepLoai +
                          "</td>\
                                                <td>\
                                                    <a href='chamdiemchitiet.php?maSinhVien=" +
                          maSinhVien +
                          "&maHocKy=" +
                          maHocKyDanhGia +
                          "' ><button type='button' class='btn btn-warning' style='color: black;width: max-content;'>Duyệt lại</button></a>\
                                                </td>\
                                             </tr>"
                      );
                    }
                  } else {
                    if (result_PRL.coVanDuyet == 0) {
                      $("#tbody_DanhSachDiemTheoKy").append(
                        "<tr>\
                                                <td>" +
                          soThuTu +
                          "</td>\
                                                <td><p class='fw-normal mb-1'>" +
                          maSinhVien +
                          "</p></td>\
                                                <td><p class='fw-normal mb-1'>" +
                          hoTenSinhVien +
                          "</p></td>\
                                                <td><p class='fw-normal mb-1'>" +
                          new Date(ngaySinhSV).toLocaleDateString() +
                          "</p></td>\
                                                <td><span class='badge badge-success' style='color: black;font-size: smaller;'>Đã chấm</span></td>\
                                                <td><span class='badge badge-success' style='color: black;font-size: smaller;'>Chưa duyệt</span></td>\
                                                <td>" +
                          result_PRL.diemTongCong +
                          "</td>\
                                                <td>" +
                          result_PRL.xepLoai +
                          "</td>\
                                                <td>\
                                                    <a href='chamdiemchitiet.php?maHocKy=" +
                          maHocKyDanhGia +
                          "&maSinhVien=" +
                          maSinhVien +
                          "' ><button type='button' class='btn btn-light' style='color: black;width: max-content;'>Xem chi tiết</button></a>\
                                                </td>\
                                             </tr>"
                      );
                    } else {
                      $("#tbody_DanhSachDiemTheoKy").append(
                        "<tr>\
                                                <td>" +
                          soThuTu +
                          "</td>\
                                                <td><p class='fw-normal mb-1'>" +
                          maSinhVien +
                          "</p></td>\
                                                <td><p class='fw-normal mb-1'>" +
                          hoTenSinhVien +
                          "</p></td>\
                                                <td><p class='fw-normal mb-1'>" +
                          new Date(ngaySinhSV).toLocaleDateString() +
                          "</p></td>\
                                                <td><span class='badge badge-success' style='color: black;font-size: smaller;'>Đã chấm</span></td>\
                                                <td><span class='badge badge-success' style='color: black;font-size: smaller;'>Đã duyệt</span></td>\
                                                <td>" +
                          result_PRL.diemTongCong +
                          "</td>\
                                                <td>" +
                          result_PRL.xepLoai +
                          "</td>\
                                                <td>\
                                                    <a href='chamdiemchitiet.php?maHocKy=" +
                          maHocKyDanhGia +
                          "&maSinhVien=" +
                          maSinhVien +
                          "' ><button type='button' class='btn btn-light' style='color: black;width: max-content;'>Xem chi tiết</button></a>\
                                                </td>\
                                             </tr>"
                      );
                    }
                  }
                },
                error: function (errorMessage) {
                  thongBaoLoi(errorMessage.responseText);
                },
              });
            },
            error: function (errorMessage) {
              $("#tbody_DanhSachDiemTheoKy").append(
                "<tr>\
                                    <td>" +
                  soThuTu +
                  "</td>\
                                    <td><p class='fw-normal mb-1'>" +
                  maSinhVien +
                  "</p></td>\
                                    <td><p class='fw-normal mb-1'>" +
                  hoTenSinhVien +
                  "</p></td>\
                                    <td><p class='fw-normal mb-1'>" +
                  new Date(ngaySinhSV).toLocaleDateString() +
                  "</p></td>\
                                    <td><span class='badge badge-warning' style='color: black;font-size: smaller;'>Chưa chấm</span></td>\
                                    <td><span class='badge badge-warning' style='color: black;font-size: smaller;'>Chưa duyệt</span></td>\
                                    <td></td>\
                                    <td></td>\
                                    <td>\
                                    </td>\
                                </tr>"
              );
            },
          });
        }
      });
    },
    error: function (errorMessage) {
      $("#text_ketQuaTimKiem").text("Không tìm thấy kết quả!");
    },
  });
}
