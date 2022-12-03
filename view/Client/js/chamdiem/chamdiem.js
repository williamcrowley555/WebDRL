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

function getThongTinSinhVien(maSinhVien) {
  var sinhVienInfo = null;

  $.ajax({
    url: urlapi_sinhvien_details_read + maSinhVien,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result) {
      sinhVienInfo = result;
    },
    error: function (error) {},
  });

  return sinhVienInfo;
}

function isActiveFunctionality(maChucNang, maHocKyDanhGia, maQuyen) {
  var result = false;

  // Kiểm tra chức năng khiếu nại điểm rèn luyện có được mở?
  $.ajax({
    url: urlapi_chucnang_single_read_maChucNang + maChucNang,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result_CN) {
      if (result_CN.kichHoat == 1) {
        // Kiểm tra học kỳ đang xét được áp dụng cho chức năng?
        $.ajax({
          url:
            urlapi_chucnang_hockydanhgia_single_details_read +
            `?maChucNang=${maChucNang}&maHocKyDanhGia=${maHocKyDanhGia}`,
          async: false,
          type: "GET",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          headers: {
            Authorization: jwtCookie,
          },
          success: function (result_CN_HKDG) {
            if (result_CN_HKDG.maHocKyDanhGia == maHocKyDanhGia) {
              // Kiểm tra quyền đang xét được áp dụng cho chức năng?
              $.ajax({
                url:
                  urlapi_chucnang_quyen_single_details_read +
                  `?maChucNang=${maChucNang}&maQuyen=${maQuyen}`,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                  Authorization: jwtCookie,
                },
                success: function (result_CN_Quyen) {
                  if (result_CN_Quyen.maQuyen == maQuyen) {
                    result = true;
                  }
                },
                error: function (error_CN_Quyen) {},
              });
            }
          },
          error: function (error_CN_HKDG) {},
        });
      }
    },
    error: function (error_CN) {},
  });

  return result;
}

function createKhieuNaiButton(
  ngayKhieuNai,
  ngayKetThucKhieuNai,
  maHocKyDanhGia
) {
  var html = "<td></td>";

  var today = new Date();
  var ngayHienTai = new Date(
    today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate()
  );

  $.ajax({
    url:
      urlapi_khieunai_single_read +
      `?maSinhVien=${getCookie("maSo")}&maHocKyDanhGia=${maHocKyDanhGia}`,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result) {
      html =
        "<td><button type='button' class='btn btn-dark btn_XemLaiKhieuNai' data-bs-toggle='modal' data-bs-target='#KhieuNaiModal' data-maHocKy='" +
        maHocKyDanhGia +
        "' style='color: white;width: max-content;'> Xem lại khiếu nại</button></td>";
    },
    error: function (error) {
      if (
        isActiveFunctionality(
          CHUC_NANG_KHIEU_NAI_DIEM_REN_LUYEN,
          maHocKyDanhGia,
          getCookie("quyen")
        ) ||
        (ngayHienTai.getTime() >= ngayKhieuNai.getTime() &&
          ngayHienTai.getTime() <= ngayKetThucKhieuNai.getTime())
      ) {
        html =
          "<td><button type='button' class='btn btn-dark btn_KhieuNai' data-bs-toggle='modal' data-bs-target='#KhieuNaiModal' data-maHocKy='" +
          maHocKyDanhGia +
          "' style='color: white;width: max-content;'> Khiếu nại</button></td>";
      }
    },
  });

  return html;
}

// function lấy thông tin thông báo đánh giá, học kỳ đánh giá
function getThongTinHocKyDanhGia() {
  $("#tbody_hocKyDanhGia").empty();

  sinhVienInfo = getThongTinSinhVien(getCookie("maSo"));

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

          var ngayKhieuNai = new Date(result[index][p].ngayKhieuNai);
          ngayKhieuNai.setHours(0, 0, 0, 0);

          var ngayKetThucKhieuNai = new Date(
            result[index][p].ngayKetThucKhieuNai
          );
          ngayKetThucKhieuNai.setHours(23, 59, 59, 999);

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

                // Trường hợp đang trong thời gian học kỳ mở chấm hoặc chức năng chấm điểm rèn luyện được mở
                if (
                  isActiveFunctionality(
                    CHUC_NANG_CHAM_DIEM_REN_LUYEN,
                    maHocKyDanhGia_HKDG,
                    getCookie("quyen")
                  ) ||
                  (ngayHienTai.getTime() >= ngaySinhVienDanhGia.getTime() &&
                    ngayHienTai.getTime() <=
                      ngaySinhVienKetThucDanhGia.getTime())
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
                      $("#tbody_hocKyDanhGia").append(
                        "<tr><td><p class='fw-normal mb-1'>" +
                          hocKyXet_HKDG +
                          "</p></td>\
                                          <td><p class='fw-normal mb-1'>" +
                          namHocXet_HKDG +
                          "</p></td>\
                                          <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã chấm</span></td>\
                                          <td>" +
                          (resultRead.coVanDuyet == 0
                            ? `<span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span>`
                            : `<span class='badge badge-warning' style='color: black;font-size: inherit;'>Đã duyệt</span>`) +
                          "</td>\
                                          <td>" +
                          (resultRead.khoaDuyet == 0
                            ? `<span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span>`
                            : `<span class='badge badge-warning' style='color: black;font-size: inherit;'>Đã duyệt</span>`) +
                          "</td>\
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
                                          </td>" +
                          createKhieuNaiButton(
                            ngayKhieuNai,
                            ngayKetThucKhieuNai,
                            maHocKyDanhGia_HKDG
                          ) +
                          "</tr>"
                      );
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
                                                <td colspan='2'>" +
                          (sinhVienInfo != null && sinhVienInfo.totNghiep == 0
                            ? "<a href='chamdiemchitiet.php?maHocKy=" +
                              maHocKyDanhGia_HKDG +
                              "' ><button type='button' class='btn btn-info' style='color: white;width: max-content;'>Chấm điểm</button></a>"
                            : "<span>Sinh viên đã tốt nghiệp</span>") +
                          "</td>\
                                            </tr>"
                      );
                    },
                  });
                }
                // Trường hợp không nằm trong thời gian học kỳ mở chấm và chức năng chấm điểm rèn luyện không được mở?
                else {
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
                        $("#tbody_hocKyDanhGia").append(
                          "<tr><td><p class='fw-normal mb-1'>" +
                            hocKyXet_HKDG +
                            "</p></td>\
                                            <td><p class='fw-normal mb-1'>" +
                            namHocXet_HKDG +
                            "</p></td>\
                                            <td><span class='badge badge-success' style='color: black;font-size: inherit;'>Đã chấm</span></td>\
                                            <td>" +
                            (resultRead.coVanDuyet == 0
                              ? `<span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span>`
                              : `<span class='badge badge-warning' style='color: black;font-size: inherit;'>Đã duyệt</span>`) +
                            "</td>\
                                            <td>" +
                            (resultRead.khoaDuyet == 0
                              ? `<span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span>`
                              : `<span class='badge badge-warning' style='color: black;font-size: inherit;'>Đã duyệt</span>`) +
                            "</td>\
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
                                            </td>" +
                            createKhieuNaiButton(
                              ngayKhieuNai,
                              ngayKetThucKhieuNai,
                              maHocKyDanhGia_HKDG
                            ) +
                            "</tr>"
                        );
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
                                                <td colspan='2'>\
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

function GuiKhieuNai() {
  // Lấy thông báo đánh giá
  $.ajax({
    url:
      urlapi_thongbaodanhgia_single_read_MaHKDG + $("#khieuNai_maHocKy").val(),
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result_TBDG) {
      var ngayHienTai = new Date();

      var ngayKhieuNai = new Date(result_TBDG.ngayKhieuNai);
      ngayKhieuNai.setHours(0, 0, 0, 0);

      var ngayKetThucKhieuNai = new Date(result_TBDG.ngayKetThucKhieuNai);
      ngayKetThucKhieuNai.setHours(23, 59, 59, 999);

      // Trường hợp đang trong thời gian học kỳ mở khiếu nại hoặc chức năng khiếu nại điểm rèn luyện được mở
      if (
        isActiveFunctionality(
          CHUC_NANG_KHIEU_NAI_DIEM_REN_LUYEN,
          $("#khieuNai_maHocKy").val(),
          getCookie("quyen")
        ) ||
        (ngayHienTai.getTime() >= ngayKhieuNai.getTime() &&
          ngayHienTai.getTime() <= ngayKetThucKhieuNai.getTime())
      ) {
        var formData = new FormData(document.getElementById("form_khieu_nai"));

        $.ajax({
          url:
            urlapi_phieurenluyen_single_read_MaHKDG_MaSV +
            $("#khieuNai_maHocKy").val() +
            "&maSinhVien=" +
            getCookie("maSo"),
          async: false,
          type: "GET",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          headers: {
            Authorization: jwtCookie,
          },
          success: function (result_PRL) {
            formData.append("maPhieuRenLuyen", result_PRL.maPhieuRenLuyen);
            formData.append("maSinhVien", result_PRL.maSinhVien);

            $.ajax({
              url:
                urlapi_khieunai_single_read +
                "?maSinhVien=" +
                getCookie("maSo") +
                "&maHocKyDanhGia=" +
                $("#khieuNai_maHocKy").val(),
              async: false,
              async: false,
              type: "GET",
              contentType: "application/json;charset=utf-8",
              dataType: "json",
              headers: {
                Authorization: jwtCookie,
              },
              success: function (result_Read_KN) {
                thongBaoLoi("Bạn đã gửi khiếu nại cho phiếu rèn luyện này!");
              },
              error: function (error_Read_KN) {
                $.ajax({
                  url: urlapi_khieunai_create,
                  async: false,
                  type: "POST",
                  data: formData,
                  processData: false,
                  contentType: false,
                  cache: false,
                  enctype: "multipart/form-data",
                  mimeType: "multipart/form-data",
                  headers: { Authorization: jwtCookie },
                  success: function (result_Create_KN) {
                    Swal.fire({
                      icon: "success",
                      title: "Thành công",
                      text: "Gửi khiếu nại thành công!",
                      timer: 2000,
                      timerProgressBar: true,
                    });

                    getThongTinHocKyDanhGia();
                  },
                  error: function (error_Create_KN) {
                    thongBaoLoi(error.responseJSON.message);
                  },
                });
              },
            });
          },
          error: function (error_PRL) {
            thongBaoLoi("Không tìm thấy phiếu rèn luyện để khiếu nại!");
          },
          complete: function () {
            $("#KhieuNaiModal").find(".btn-close").trigger("click");
            $("#form_khieu_nai").trigger("reset");
            $("#images").empty();
            $("#num-of-files").val("Không có file được chọn");
          },
        });
      }
      // Trường hợp không nằm trong thời gian học kỳ mở khiếu nại hoặc chức năng khiếu nại điểm rèn luyện không được mở
      else {
        thongBaoLoi("Rất tiếc! Đã nằm ngoài thời gian khiếu nại!");
      }
    },
    error: function (error) {},
  });
}
