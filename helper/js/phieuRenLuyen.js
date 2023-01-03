const roleSinhVien = "sinhvien";
const roleCVHT = "cvht";
const roleKhoa = "khoa";

const phieuRenLuyenTitle = [
  "NỘI DUNG ĐÁNH GIÁ",
  "Điểm tối đa",
  "Điểm SV tự đánh giá",
  "Điểm lớp đánh giá",
  "Điểm Khoa đánh giá",
  "Điểm nhận từ hoạt động",
  "Minh chứng ngoài (nếu có)",
];

function alertError(message) {
  Swal.fire({
    icon: "error",
    title: "Lỗi",
    text: message,
    timer: 2000,
    timerProgressBar: true,
  });
}

function getPhieuRenLuyenTitle() {
  return phieuRenLuyenTitle;
}

function getThongTinPhieuRenLuyen(maPhieuRenLuyen) {
  // Reset phieuRenLuyen
  var phieuRenLuyen = {
    thongTinPhieu: {},
    sinhVien: {},
    hocKyDanhGia: {},
    thongBaoDanhGia: {},
    diemTieuChiCap2: [],
    diemTieuChiCap3: [],
    tieuChiCap1: [],
    tieuChiCap2: [],
    tieuChiCap3: [],
  };

  if (maPhieuRenLuyen) {
    // Lấy thông tin phiếu rèn luyện
    $.ajax({
      url: urlapi_phieurenluyen_single_read + maPhieuRenLuyen,
      async: false,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      headers: {
        Authorization: jwtCookie,
      },
      success: function (result_PRL) {
        phieuRenLuyen.thongTinPhieu = result_PRL;
      },
      error: function (error) {},
    });

    // Lấy điểm tiêu chí cấp 2 & 3 của phiếu rèn luyện
    $.ajax({
      url: urlapi_chamdiemrenluyen_read_maPhieuRenLuyen + maPhieuRenLuyen,
      async: false,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      headers: {
        Authorization: jwtCookie,
      },
      success: function (result_CD) {
        result_CD["ChamDiemRenLuyen"].forEach(function (result) {
          if (result.maTieuChi2 != 0) {
            phieuRenLuyen.diemTieuChiCap2.push(result);

            // Lưu tiêu chí cấp 2
            $.ajax({
              url: urlapi_tieuchicap2_single_read + result.maTieuChi2,
              async: false,
              type: "GET",
              contentType: "application/json;charset=utf-8",
              dataType: "json",
              headers: {
                Authorization: jwtCookie,
              },
              success: function (result_TCC2) {
                delete result_TCC2.soThuTu;
                phieuRenLuyen.tieuChiCap2.push(result_TCC2);
              },
              error: function (error) {},
            });
          } else if (result.maTieuChi3 != 0) {
            phieuRenLuyen.diemTieuChiCap3.push(result);

            // Lưu tiêu chí cấp 3
            $.ajax({
              url: urlapi_tieuchicap3_single_read + result.maTieuChi3,
              async: false,
              type: "GET",
              contentType: "application/json;charset=utf-8",
              dataType: "json",
              headers: {
                Authorization: jwtCookie,
              },
              success: function (result_TCC3) {
                delete result_TCC3.soThuTu;
                phieuRenLuyen.tieuChiCap3.push(result_TCC3);
              },
              error: function (error) {},
            });
          }
        });
      },
      error: function (error) {},
    });

    // Lấy các tiêu chí cấp 2 có trong phieuRenLuyen
    var tieuChiCap2List = phieuRenLuyen.diemTieuChiCap2.map(function (
      tieuChiCap2
    ) {
      return tieuChiCap2.maTieuChi2;
    });

    // Lấy các tiêu chí cấp 1 theo tieuChiCap2List
    $.ajax({
      url: urlapi_tieuchicap1_read_matc2 + tieuChiCap2List,
      async: false,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      headers: {
        Authorization: jwtCookie,
      },
      success: function (result_TCC1) {
        result_TCC1["tieuchicap1"].forEach(function (result) {
          delete result.soThuTu;
          phieuRenLuyen.tieuChiCap1.push(result);
        });
      },
      error: function (error) {},
    });

    // Lấy các tiêu chí cấp 3 có trong phieuRenLuyen
    var tieuChiCap3List = phieuRenLuyen.diemTieuChiCap3.map(function (
      tieuChiCap3
    ) {
      return tieuChiCap3.maTieuChi3;
    });

    // Lấy các tiêu chí cấp 1 theo tieuChiCap3List
    $.ajax({
      url: urlapi_tieuchicap1_read_matc3 + tieuChiCap3List,
      async: false,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      headers: {
        Authorization: jwtCookie,
      },
      success: function (result_TCC1) {
        result_TCC1["tieuchicap1"].forEach(function (result) {
          var duplicateTCC1 = phieuRenLuyen.tieuChiCap1.find(
            (tcc1) => tcc1.matc1 == result.matc1
          );

          if (!duplicateTCC1) {
            delete result.soThuTu;
            phieuRenLuyen.tieuChiCap1.push(result);
          }
        });
      },
      error: function (error) {},
    });

    // Lấy các tiêu chí cấp 2 theo tieuChiCap3List
    $.ajax({
      url: urlapi_tieuchicap2_read_matc3 + tieuChiCap3List,
      async: false,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      headers: {
        Authorization: jwtCookie,
      },
      success: function (result_TCC2) {
        result_TCC2["tieuchicap2"].forEach(function (result) {
          var duplicateTCC2 = phieuRenLuyen.tieuChiCap2.find(
            (tcc2) => tcc2.matc2 == result.matc2
          );

          if (!duplicateTCC2) {
            delete result.soThuTu;
            phieuRenLuyen.tieuChiCap2.push(result);
          }
        });
      },
      error: function (error) {},
    });

    // Sort tieuChiCap1 theo matc1 tăng dần
    phieuRenLuyen.tieuChiCap1.sort((a, b) => a.matc1 - b.matc1);

    // Sort tieuChiCap2 theo matc2 tăng dần
    phieuRenLuyen.tieuChiCap2.sort((a, b) => a.matc2 - b.matc2);

    // Sort tieuChiCap3 theo matc3 tăng dần
    phieuRenLuyen.tieuChiCap3.sort((a, b) => a.matc3 - b.matc3);

    // Lấy thông tin sinh viên
    $.ajax({
      url:
        urlapi_sinhvien_details_read + phieuRenLuyen.thongTinPhieu.maSinhVien,
      async: false,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      headers: {
        Authorization: jwtCookie,
      },
      success: function (result) {
        phieuRenLuyen.sinhVien = result;
      },
      error: function (error) {},
    });

    // Lấy thông tin học kỳ đánh giá
    $.ajax({
      url:
        urlapi_hockydanhgia_single_read +
        phieuRenLuyen.thongTinPhieu.maHocKyDanhGia,
      async: false,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      headers: {
        Authorization: jwtCookie,
      },
      success: function (result_HKDG) {
        phieuRenLuyen.hocKyDanhGia = result_HKDG;
      },
      error: function (error) {},
    });

    // Lấy thông báo đánh giá
    $.ajax({
      url:
        urlapi_thongbaodanhgia_single_read_MaHKDG +
        phieuRenLuyen.thongTinPhieu.maHocKyDanhGia,
      async: false,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      headers: {
        Authorization: jwtCookie,
      },
      success: function (result_TBDG) {
        phieuRenLuyen.thongBaoDanhGia = result_TBDG;
      },
      error: function (error) {},
    });
  }

  return phieuRenLuyen;
}

function isAllowedToScore(thongBaoDanhGia, userRole, validRoles) {
  var result = false;
  var today = new Date();

  // Kiểm tra chức năng chấm điểm rèn luyện có được mở?
  $.ajax({
    url: urlapi_chucnang_single_read_maChucNang + CHUC_NANG_CHAM_DIEM_REN_LUYEN,
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
            `?maChucNang=${CHUC_NANG_CHAM_DIEM_REN_LUYEN}&maHocKyDanhGia=${thongBaoDanhGia.maHocKyDanhGia}`,
          async: false,
          type: "GET",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          headers: {
            Authorization: jwtCookie,
          },
          success: function (result_CN_HKDG) {
            if (
              result_CN_HKDG.maHocKyDanhGia == thongBaoDanhGia.maHocKyDanhGia
            ) {
              // Kiểm tra quyền đang xét được áp dụng cho chức năng?
              $.ajax({
                url:
                  urlapi_chucnang_quyen_single_details_read +
                  `?maChucNang=${CHUC_NANG_CHAM_DIEM_REN_LUYEN}&maQuyen=${userRole}`,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                  Authorization: jwtCookie,
                },
                success: function (result_CN_Quyen) {
                  if (
                    result_CN_Quyen.maQuyen == userRole &&
                    validRoles.indexOf(userRole) >= 0
                  ) {
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

  if (!result) {
    if (validRoles.indexOf(userRole) >= 0) {
      if (userRole == roleSinhVien) {
        if (
          typeof thongBaoDanhGia.ngaySinhVienDanhGia !== "undefined" &&
          typeof thongBaoDanhGia.ngaySinhVienKetThucDanhGia !== "undefined"
        ) {
          var startDate = new Date(
            thongBaoDanhGia.ngaySinhVienDanhGia.split("-")
          );
          var endDate = new Date(
            thongBaoDanhGia.ngaySinhVienKetThucDanhGia.split("-")
          );

          startDate.setHours(0, 0, 0, 0);
          endDate.setHours(23, 59, 59, 999);

          if (startDate <= today && today <= endDate) {
            result = true;
          }
        }
      } else if (userRole == roleCVHT) {
        if (
          typeof thongBaoDanhGia.ngayCoVanDanhGia !== "undefined" &&
          typeof thongBaoDanhGia.ngayCoVanKetThucDanhGia !== "undefined"
        ) {
          var startDate = new Date(thongBaoDanhGia.ngayCoVanDanhGia.split("-"));
          var endDate = new Date(
            thongBaoDanhGia.ngayCoVanKetThucDanhGia.split("-")
          );

          startDate.setHours(0, 0, 0, 0);
          endDate.setHours(23, 59, 59, 999);

          if (startDate <= today && today <= endDate) {
            result = true;
          }
        }
      } else if (userRole == roleKhoa) {
        if (
          typeof thongBaoDanhGia.ngayKhoaDanhGia !== "undefined" &&
          typeof thongBaoDanhGia.ngayKhoaKetThucDanhGia !== "undefined"
        ) {
          var startDate = new Date(thongBaoDanhGia.ngayKhoaDanhGia.split("-"));
          var endDate = new Date(
            thongBaoDanhGia.ngayKhoaKetThucDanhGia.split("-")
          );

          startDate.setHours(0, 0, 0, 0);
          endDate.setHours(23, 59, 59, 999);

          if (startDate <= today && today <= endDate) {
            result = true;
          }
        }
      }
    }
  }

  return result;
}

//Set thông tin sinh viên lên phiếu
function setThongTinSinhVien(sinhVien, hocKyDanhGia, selector) {
  if (
    sinhVien != null &&
    !jQuery.isEmptyObject(sinhVien) &&
    hocKyDanhGia != null &&
    !jQuery.isEmptyObject(hocKyDanhGia)
  ) {
    var hoTenSinhVien = sinhVien.hoTenSinhVien;
    var ngaySinh = new Date(sinhVien.ngaySinh);
    var maLop = sinhVien.maLop;
    var he = sinhVien.he;
    var maKhoa = sinhVien.maKhoa;
    var tenKhoa = sinhVien.tenKhoa;
    var hocKyXet = hocKyDanhGia.hocKyXet;
    var namHocXet = hocKyDanhGia.namHocXet;

    $(selector).empty();

    $(selector).append(
      "<div class='row'>\
                  <div class='col'>\
                  <span style='font-weight: bold;'>Họ tên: </span>" +
        hoTenSinhVien +
        "</div>\
                  <div class='col'>\
                  <span style='font-weight: bold;' >Mã số sinh viên: </span><span id='text_maSV'>" +
        sinhVien.maSinhVien +
        "</span>\
                  </div>\
                  <div class='col'>\
                  <span style='font-weight: bold;'>Ngày sinh: </span>" +
        ngaySinh.toLocaleDateString() +
        "\
                  </div>\
                  <div class='col'>\
                  <span style='font-weight: bold;'>Lớp: </span><span id='text_MaLop'>" +
        maLop +
        "</span>\
                  </div>\
                  </div>\
                  <div class='row'>\
                  <div class='col'>\
                  <span style='font-weight: bold;'>Khoa: </span>" +
        maKhoa +
        " - " +
        tenKhoa +
        "\
                  </div>\
                  <div class='col'>\
                  <span style='font-weight: bold;'>Hệ: </span>" +
        he +
        "\
                  </div>\
                  <div class='col'>\
                  <span style='font-weight: bold;'>Học kỳ: </span>" +
        hocKyXet +
        "\
                  </div>\
                  <div class='col'>\
                  <span style='font-weight: bold;'>Năm học: </span>" +
        namHocXet +
        "\
                  </div>\
                  <div class='col' style='display: none;'>\
                  <input type='hidden' id='input_maHocKyDanhGia' value='" +
        hocKyDanhGia.maHocKyDanhGia +
        "' /></span>\
                  </div>\
                  </div>\
                  "
    );
  }
}

// Tự động điền điểm hoạt động mà sinh viên đã tham gia
function autoFillDiemHoatDong(maSinhVien, maHocKyDanhGia, selector) {
  $.ajax({
    url:
      urlapi_hoatdongdanhgia_read +
      "?maSinhVien=" +
      maSinhVien +
      "&maHocKyDanhGia=" +
      maHocKyDanhGia,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result_HD) {
      result_HD["hoatdongdanhgia"].forEach(function (hoatDong) {
        $(selector)
          .find("input")
          .each(function () {
            var tieuChi = this.id.slice(0, 3);
            var maTieuChi = this.id.slice(4, 9);
            var max_value = $(this).attr("max_value");

            if (tieuChi == "TC2") {
              if (hoatDong.maTieuChi2 == maTieuChi) {
                if (this.value != null) {
                  tongDiemHoatDong_TrenTieuChi =
                    Number(this.value) + Number(hoatDong.diemNhanDuoc);
                }

                if (Number(tongDiemHoatDong_TrenTieuChi) > Number(max_value)) {
                  $("#" + this.id).val(max_value);
                } else {
                  $("#" + this.id).val(tongDiemHoatDong_TrenTieuChi);
                }
              }
            }

            if (tieuChi == "TC3") {
              if (hoatDong.maTieuChi3 == maTieuChi) {
                if (this.value != null) {
                  tongDiemHoatDong_TrenTieuChi =
                    Number(this.value) + Number(hoatDong.diemNhanDuoc);
                }

                if (Number(tongDiemHoatDong_TrenTieuChi) > Number(max_value)) {
                  $("#" + this.id).val(max_value);
                } else {
                  $("#" + this.id).val(tongDiemHoatDong_TrenTieuChi);
                }
              }
            }
          });
      });
    },
    error: function (errorMessage_HD) {},
  });
}

function autoFillDiemKetQuaHocTap(
  maSinhVien,
  maHocKyDanhGia,
  userRole,
  isAllowedToScore,
  selector
) {
  selector += " ";

  // Tìm kiếm học kỳ trước
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
      var maHocKyDanhGiaTruoc = null;

      for (let i = 0; i < result_HKDG["hockydanhgia"].length; i++) {
        if (
          result_HKDG["hockydanhgia"][i].maHocKyDanhGia == maHocKyDanhGia &&
          i > 0
        ) {
          maHocKyDanhGiaTruoc =
            result_HKDG["hockydanhgia"][i - 1].maHocKyDanhGia;
        }
      }

      if (maHocKyDanhGiaTruoc != null) {
        // Lấy điểm trung bình hệ 4 của học kỳ trước
        $.ajax({
          url:
            urlapi_diemtrungbinhhe4_single_read +
            `?maSinhVien=${maSinhVien}&maHocKyDanhGia=${maHocKyDanhGiaTruoc}`,
          async: false,
          type: "GET",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          headers: {
            Authorization: jwtCookie,
          },
          success: function (result_DiemHe4) {
            $(selector + "#inputTBCHocKyTruoc").val(result_DiemHe4.diem);
          },
          error: function (error) {
            $(selector + "#inputTBCHocKyTruoc").val(0);
          },
        });
      } else {
        $(selector + "#inputTBCHocKyTruoc").val(0);
      }
    },
    error: function (error) {
      $(selector + "#inputTBCHocKyTruoc").val(0);
    },
  });

  // Lấy điểm trung bình hệ 4 của học kỳ đang xét
  $.ajax({
    url:
      urlapi_diemtrungbinhhe4_single_read +
      `?maSinhVien=${maSinhVien}&maHocKyDanhGia=${maHocKyDanhGia}`,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result_DiemHe4) {
      $(selector + "#inputTBCHocKyDangXet").val(result_DiemHe4.diem);
    },
    error: function (error) {
      $(selector + "#inputTBCHocKyDangXet").val(0);
    },
  });

  var TBCHocKyTruoc = $(selector + "#inputTBCHocKyTruoc").val();
  var TBCHocKyDangXet = $(selector + "#inputTBCHocKyDangXet").val();

  if (isAllowedToScore) {
    var bac_HocKyDangXet = 0;
    var bac_HocKyTruoc = 0;

    var idTC3_1;
    var idTC3_2;
    var idTC3_3;
    var idTC3_4;
    var idTC3_5;
    var idTC3_6;
    var idTC3_7;

    if (userRole == roleSinhVien) {
      idTC3_1 = "#TC3_1";
      idTC3_2 = "#TC3_2";
      idTC3_3 = "#TC3_3";
      idTC3_4 = "#TC3_4";
      idTC3_5 = "#TC3_5";
      idTC3_6 = "#TC3_6";
      idTC3_7 = "#TC3_7";
    } else if (userRole == roleCVHT) {
      idTC3_1 = "#CVHT_TC3_1";
      idTC3_2 = "#CVHT_TC3_2";
      idTC3_3 = "#CVHT_TC3_3";
      idTC3_4 = "#CVHT_TC3_4";
      idTC3_5 = "#CVHT_TC3_5";
      idTC3_6 = "#CVHT_TC3_6";
      idTC3_7 = "#CVHT_TC3_7";
    } else if (userRole == roleKhoa) {
      idTC3_1 = "#Khoa_TC3_1";
      idTC3_2 = "#Khoa_TC3_2";
      idTC3_3 = "#Khoa_TC3_3";
      idTC3_4 = "#Khoa_TC3_4";
      idTC3_5 = "#Khoa_TC3_5";
      idTC3_6 = "#Khoa_TC3_6";
      idTC3_7 = "#Khoa_TC3_7";
    }

    $(selector + idTC3_1).val("");
    $(selector + idTC3_2).val("");
    $(selector + idTC3_3).val("");
    $(selector + idTC3_4).val("");
    $(selector + idTC3_5).val("");
    $(selector + idTC3_6).val("");
    $(selector + idTC3_7).val("");

    // Bậc điểm học kỳ đang xét
    if (TBCHocKyDangXet >= 3.6 && TBCHocKyDangXet <= 4) {
      $(selector + idTC3_1).val($(selector + idTC3_1).attr("max_value"));
      bac_HocKyDangXet = 4;
    }

    if (TBCHocKyDangXet >= 3.2 && TBCHocKyDangXet <= 3.59) {
      $(selector + idTC3_2).val($(selector + idTC3_2).attr("max_value"));
      bac_HocKyDangXet = 3;
    }

    if (TBCHocKyDangXet >= 2.5 && TBCHocKyDangXet <= 3.19) {
      $(selector + idTC3_3).val($(selector + idTC3_3).attr("max_value"));
      bac_HocKyDangXet = 2;
    }

    if (TBCHocKyDangXet >= 2 && TBCHocKyDangXet <= 2.49) {
      $(selector + idTC3_4).val($(selector + idTC3_4).attr("max_value"));
      bac_HocKyDangXet = 1;
    }

    if (TBCHocKyDangXet < 2) {
      $(selector + idTC3_5).val($(selector + idTC3_5).attr("max_value"));
    }

    // Bậc điểm học kỳ trước
    if (TBCHocKyTruoc >= 3.6 && TBCHocKyTruoc <= 4) {
      bac_HocKyTruoc = 4;
    }

    if (TBCHocKyTruoc >= 3.2 && TBCHocKyTruoc <= 3.59) {
      bac_HocKyTruoc = 3;
    }

    if (TBCHocKyTruoc >= 2.5 && TBCHocKyTruoc <= 3.19) {
      bac_HocKyTruoc = 2;
    }

    if (TBCHocKyTruoc >= 2 && TBCHocKyTruoc <= 2.49) {
      bac_HocKyTruoc = 1;
    }

    //So sánh bậc
    if (bac_HocKyDangXet - bac_HocKyTruoc == 1) {
      $(selector + idTC3_6).val($(selector + idTC3_6).attr("max_value"));
    } else if (bac_HocKyDangXet - bac_HocKyTruoc > 1) {
      $(selector + idTC3_7).val($(selector + idTC3_7).attr("max_value"));
    }

    //Kích hoạt sự kiên onchange manually vì value set bằng javascript ko hoạt động onchange
    input_TC3_1 = document.getElementById("Khoa_TC3_1");
    ev_TC3_1 = document.createEvent("Event");
    ev_TC3_1.initEvent("change", true, false);
    input_TC3_1.dispatchEvent(ev_TC3_1);

    input_TC3_2 = document.getElementById("Khoa_TC3_2");
    ev_TC3_2 = document.createEvent("Event");
    ev_TC3_2.initEvent("change", true, false);
    input_TC3_2.dispatchEvent(ev_TC3_2);

    input_TC3_3 = document.getElementById("Khoa_TC3_3");
    ev_TC3_3 = document.createEvent("Event");
    ev_TC3_3.initEvent("change", true, false);
    input_TC3_3.dispatchEvent(ev_TC3_3);

    input_TC3_4 = document.getElementById("Khoa_TC3_4");
    ev_TC3_4 = document.createEvent("Event");
    ev_TC3_4.initEvent("change", true, false);
    input_TC3_4.dispatchEvent(ev_TC3_4);

    input_TC3_5 = document.getElementById("Khoa_TC3_5");
    ev_TC3_5 = document.createEvent("Event");
    ev_TC3_5.initEvent("change", true, false);
    input_TC3_5.dispatchEvent(ev_TC3_5);
  }
}

function rank(diemTongCong) {
  if (diemTongCong >= 90 && diemTongCong <= 100) {
    return "Xuất sắc";
  }

  if (diemTongCong >= 80 && diemTongCong <= 89) {
    return "Tốt";
  }

  if (diemTongCong >= 65 && diemTongCong <= 79) {
    return "Khá";
  }

  if (diemTongCong >= 50 && diemTongCong <= 64) {
    return "Trung bình";
  }

  if (diemTongCong >= 35 && diemTongCong <= 49) {
    return "Yếu";
  }

  if (diemTongCong < 35) {
    return "Kém";
  }

  return null;
}

function tinhTongDiem(userRole, isAllowedToScore, selector) {
  selector += " ";

  let calDiemTongTieuChi1_SinhVien = 0;
  let calDiemTongTieuChi1_CVHT = 0;
  let calDiemTongTieuChi1_Khoa = 0;

  let calDiemTongCong_SinhVien = 0;
  let calDiemTongCong_CVHT = 0;
  let calDiemTongCong_Khoa = 0;

  $(selector)
    .find("input")
    .each(function () {
      var tieuChi_SinhVien = this.id.slice(0, 3);
      var tieuChi = this.id.slice(0, 8);

      var idDiemTongTieuChi1_SinhVien = this.id.slice(0, 12);
      var idDiemTongTieuChi1 = this.id.slice(0, 17);

      if (tieuChi_SinhVien == "TC2" || tieuChi_SinhVien == "TC3") {
        if (this.value != null) {
          calDiemTongTieuChi1_SinhVien += Number(this.value);
        }
      }

      if (tieuChi == "CVHT_TC2" || tieuChi == "CVHT_TC3") {
        if (this.value != null) {
          calDiemTongTieuChi1_CVHT += Number(this.value);
        }
      }

      if (tieuChi == "Khoa_TC2" || tieuChi == "Khoa_TC3") {
        if (this.value != null) {
          calDiemTongTieuChi1_Khoa += Number(this.value);
        }
      }

      // Điểm tổng cộng tiêu chí 1 của sinh viên
      if (idDiemTongTieuChi1_SinhVien == "TongCong_TC1") {
        var diemToiDa_TC1 = $(selector + "#" + this.id).attr("max-value");

        if (calDiemTongTieuChi1_SinhVien > diemToiDa_TC1) {
          $(selector + "#" + this.id).val(diemToiDa_TC1);

          calDiemTongCong_SinhVien += Number(diemToiDa_TC1);
          calDiemTongTieuChi1_SinhVien = 0;
        } else {
          $(selector + "#" + this.id).val(calDiemTongTieuChi1_SinhVien);

          calDiemTongCong_SinhVien += Number(calDiemTongTieuChi1_SinhVien);
          calDiemTongTieuChi1_SinhVien = 0;
        }
      }

      // Điểm tổng cộng tiêu chí 1 của cvht
      if (idDiemTongTieuChi1 == "CVHT_TongCong_TC1") {
        var diemToiDa_TC1_CVHT = $(selector + "#" + this.id).attr("max-value");

        if (calDiemTongTieuChi1_CVHT > diemToiDa_TC1_CVHT) {
          $(selector + "#" + this.id).val(diemToiDa_TC1_CVHT);

          calDiemTongCong_CVHT += Number(diemToiDa_TC1_CVHT);
          calDiemTongTieuChi1_CVHT = 0;
        } else {
          $(selector + "#" + this.id).val(calDiemTongTieuChi1_CVHT);

          calDiemTongCong_CVHT += Number(calDiemTongTieuChi1_CVHT);
          calDiemTongTieuChi1_CVHT = 0;
        }
      }

      // Điểm tổng cộng tiêu chí 1 của khoa
      if (idDiemTongTieuChi1 == "Khoa_TongCong_TC1") {
        var diemToiDa_TC1_Khoa = $(selector + "#" + this.id).attr("max-value");

        if (calDiemTongTieuChi1_Khoa > diemToiDa_TC1_Khoa) {
          $(selector + "#" + this.id).val(diemToiDa_TC1_Khoa);

          calDiemTongCong_Khoa += Number(diemToiDa_TC1_Khoa);
          calDiemTongTieuChi1_Khoa = 0;
        } else {
          $(selector + "#" + this.id).val(calDiemTongTieuChi1_Khoa);

          calDiemTongCong_Khoa += Number(calDiemTongTieuChi1_Khoa);
          calDiemTongTieuChi1_Khoa = 0;
        }
      }
    });

  // Điểm tổng cộng của phiếu rèn luyện
  $(selector + "#input_diemtongcong").val(
    calDiemTongCong_SinhVien > 100 ? 100 : calDiemTongCong_SinhVien
  );
  $(selector + "#CVHT_input_diemtongcong").val(
    calDiemTongCong_CVHT > 100 ? 100 : calDiemTongCong_CVHT
  );
  $(selector + "#Khoa_input_diemtongcong").val(
    calDiemTongCong_Khoa > 100 ? 100 : calDiemTongCong_Khoa
  );

  if (isAllowedToScore) {
    var diemTong_XepLoai = 0;

    // Điểm tổng cộng đã chốt
    if (userRole == roleSinhVien) {
      $(selector + "#text_diemTongCong").text(
        calDiemTongCong_SinhVien > 100 ? 100 : calDiemTongCong_SinhVien
      );
      diemTong_XepLoai = Number($(selector + "#input_diemtongcong").val());
    } else if (userRole == roleCVHT) {
      $(selector + "#text_diemTongCong").text(
        calDiemTongCong_CVHT > 100 ? 100 : calDiemTongCong_CVHT
      );
      diemTong_XepLoai = Number($(selector + "#CVHT_input_diemtongcong").val());
    } else if (userRole == roleKhoa) {
      $(selector + "#text_diemTongCong").text(
        calDiemTongCong_Khoa > 100 ? 100 : calDiemTongCong_Khoa
      );
      diemTong_XepLoai = Number($(selector + "#Khoa_input_diemtongcong").val());
    }

    $(selector + "#text_XepLoai").text(rank(diemTong_XepLoai));
  }
}

function xuLyChamDiem(userRole, selector) {
  $(selector)
    .find("input")
    .on("change", function () {
      tinhTongDiem(userRole, true, selector);
    });
}

function createPhieuRenLuyenForm(
  tieuChiDanhGiaList,
  thongBaoDanhGia,
  userRole,
  selector
) {
  if (tieuChiDanhGiaList) {
    var html = "";

    $(selector).empty();

    var isAllowedToScore_SinhVien = isAllowedToScore(
      thongBaoDanhGia,
      userRole,
      [roleSinhVien]
    );
    var isAllowedToScore_CVHT = isAllowedToScore(thongBaoDanhGia, userRole, [
      roleCVHT,
    ]);
    var isAllowedToScore_Khoa = isAllowedToScore(thongBaoDanhGia, userRole, [
      roleKhoa,
    ]);

    // Tiêu chí 1
    tieuChiDanhGiaList.tieuChiCap1.forEach(function (tcc1) {
      html +=
        "<tr>\
                    <td style='font-weight: bold;'>" +
        tcc1.noidung +
        "</td>\
                    <td>" +
        (tcc1.diemtoida == 0 ? "" : tcc1.diemtoida + "đ") +
        "</td>\
            <td></td>\
            <td></td>\
            <td></td>\
            <td></td>\
            <td></td>\
        </tr>";

      // Tiêu chí 2
      tieuChiDanhGiaList.tieuChiCap2.forEach(function (tcc2) {
        if (tcc1.matc1 == tcc2.matc1) {
          if (tcc2.diemtoida != 0) {
            /**
             * Lấy min điểm có thể nhập cho 2 trường hợp:
             * diemtoida > 0 => tiêu chí được cộng điểm
             * diemtoida < 0 => tiêu chí vi phạm
             */

            var min_value_tc2 = 0;

            if (tcc2.diemtoida > 0) {
              min_value_tc2 = 0;
            } else {
              min_value_tc2 = tcc2.diemtoida;
            }

            html +=
              "<tr>\
                    <td><em>" +
              tcc2.noidung +
              "</em></td>\
                    <td><em>" +
              tcc2.diemtoida +
              "đ</em></td>\
                    <td>\
                        <input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
              tcc2.diemtoida +
              ")' max_value='" +
              tcc2.diemtoida +
              "'    \
                                    min='" +
              min_value_tc2 +
              "' id='TC2_" +
              tcc2.matc2 +
              "' " +
              (isAllowedToScore_SinhVien ? "" : "disabled") +
              "/> \
                    </td>\
                    <td>\
                        <input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
              tcc2.diemtoida +
              ")' max_value='" +
              tcc2.diemtoida +
              "'    \
                                    min='" +
              min_value_tc2 +
              "' id='CVHT_TC2_" +
              tcc2.matc2 +
              "' " +
              (isAllowedToScore_CVHT ? "" : "disabled") +
              "/> \
                    </td>\
                    <td>\
                        <input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
              tcc2.diemtoida +
              ")' max_value='" +
              tcc2.diemtoida +
              "'    \
                                    min='" +
              min_value_tc2 +
              "' id='Khoa_TC2_" +
              tcc2.matc2 +
              "' " +
              (isAllowedToScore_Khoa ? "" : "disabled") +
              "/> \
                    </td>\
                    <td>\
                        <button type='button' class='btn btn-light btn_XemDanhSachHoatDong' style='color: black;width: max-content;' data-bs-toggle='modal' data-bs-target='#XemDanhSachHoatDongModal' data-tieuchi-id='TC2_" +
              tcc2.matc2 +
              "' data-tentieuchi='" +
              tcc2.noidung +
              "' >Danh sách</button>\
                        </td>\
                        <td>\
                        <div class='box'>" +
              (isAllowedToScore_SinhVien || isAllowedToScore_CVHT
                ? "<a href='#' id='show_file_minhchung_TC2_" +
                  tcc2.matc2 +
                  "' target='_blank' ></a>\
                <form id='formDanhGiaDRL_TC2_" +
                  tcc2.matc2 +
                  "' method='post' enctype='multipart/form-data'>\
                  <input type='file' id='file_minhchung_TC2_" +
                  tcc2.matc2 +
                  "' name='fileMinhChung' class='inputfile inputfile-1' accept='.png,.jpg,.jpeg' data-multiple-caption='{count} files selected' >\
                  <label for='file_minhchung_TC2_" +
                  tcc2.matc2 +
                  "'>\
                    <svg xmlns='http://www.w3.org/2000/svg' width='20' height='17' viewBox='0 0 20 17'><path d='M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z'></path></svg>\
                    <span>Chọn tệp…</span>\
                  </label>\
                </form>"
                : "<a href='#' id='show_file_minhchung_TC2_" +
                  tcc2.matc2 +
                  "' target='_blank' style='display:none' ></a>\
                  <button type='button' class='btn btn-light btn_AnhMinhChung' data-bs-toggle='modal' data-bs-target='#AnhMinhChungModal' data-img-id='img_file_minhchung_TC2_" +
                  tcc2.matc2 +
                  "' ><img src='' id='img_file_minhchung_TC2_" +
                  tcc2.matc2 +
                  "' width='100px' /></button>\
                  <form id='formDanhGiaDRL_TC2_" +
                  tcc2.matc2 +
                  "' method='post' enctype='multipart/form-data'>\
                  </form>") +
              "</div>\
                        </td>\
                    </tr>";
          } else {
            if (
              tcc2.noidung
                .toLowerCase()
                .indexOf("Kết quả học tập".toLowerCase()) != -1
            ) {
              html +=
                "<tr>\
                                      <td><em>" +
                tcc2.noidung +
                "<br>Điểm TBC học kỳ trước: <input type='number' step='0.01' onchange='changeNumberHandle(this,4)' id='inputTBCHocKyTruoc' name='diemTrungBinhChungHKTruoc' style='width: 90px;margin-bottom: 15px;' disabled />\
                <br>Điểm TBC học kỳ đang xét: <input type='number' step='0.01' onchange='changeNumberHandle(this,4)' id='inputTBCHocKyDangXet' name='diemTrungBinhChungHKXet' style='width: 90px;' disabled />\
                                      </em></td>\
                                      <td></td>\
                                      <td></td>\
                                      <td></td>\
                                      <td></td>\
                                      <td></td>\
                                      <td><a href='#' id='show_file_minhchung_TC2_" +
                tcc2.matc2 +
                "' target='_blank' ></a>\
                                      <form id='formDanhGiaDRL_TC2_" +
                tcc2.matc2 +
                "' method='post' enctype='multipart/form-data'></form></td>\
                                      </tr>";
            } else {
              html +=
                "<tr>\
                                      <td><em>" +
                tcc2.noidung +
                "</em></td>\
                                      <td></td>\
                                      <td></td>\
                                      <td></td>\
                                      <td></td>\
                                      <td></td>\
                                      <td> <a href='#' id='show_file_minhchung_TC2_" +
                tcc2.matc2 +
                "' target='_blank' ></a>\
                                      <form id='formDanhGiaDRL_TC2_" +
                tcc2.matc2 +
                "' method='post' enctype='multipart/form-data'></form></td>\
                                      </tr>";
            }
          }

          // Tiêu chí 3
          tieuChiDanhGiaList.tieuChiCap3.forEach(function (tcc3) {
            if (tcc2.matc2 == tcc3.matc2) {
              var readonly_string = "";

              if (
                tcc3.noidung.localeCompare(
                  "a. Điểm trung bình chung học kì từ  3,60 đến 4,00"
                ) == 0 ||
                tcc3.noidung.localeCompare(
                  "b. Điểm trung bình chung học kì từ  3,20 đến 3,59"
                ) == 0 ||
                tcc3.noidung.localeCompare(
                  "c. Điểm trung bình chung học kì từ  2,50 đến 3,19"
                ) == 0 ||
                tcc3.noidung.localeCompare(
                  "d. Điểm trung bình chung học kì từ  2,00 đến 2,49"
                ) == 0 ||
                tcc3.noidung.localeCompare(
                  "đ. Điểm trung bình chung học kì  dưới 2,00"
                ) == 0 ||
                tcc3.noidung.localeCompare(
                  "a. Kết quả học tập tăng một bậc so với học kỳ trước,  ĐTBCHK từ  2,00 trở lên"
                ) == 0 ||
                tcc3.noidung.localeCompare(
                  "b. Kết quả học tập tăng hai bậc so với học kỳ trước,  ĐTBCHK từ  2,00 trở lên"
                ) == 0
              ) {
                readonly_string = "readonly";

                html +=
                  "<tr>\
                                    <td>" +
                  tcc3.noidung +
                  "</span></td>\
                                    <td><em>" +
                  tcc3.diem +
                  "đ</em></td>\
                                    <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
                  tcc3.diem +
                  ")' max_value='" +
                  tcc3.diem +
                  "'  id='TC3_" +
                  tcc3.matc3 +
                  "' " +
                  readonly_string +
                  " disabled/></td>\
                      <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
                  tcc3.diem +
                  ")' max_value='" +
                  tcc3.diem +
                  "'  id='CVHT_TC3_" +
                  tcc3.matc3 +
                  "' " +
                  readonly_string +
                  " disabled/></td>\
                      <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
                  tcc3.diem +
                  ")' max_value='" +
                  tcc3.diem +
                  "'  id='Khoa_TC3_" +
                  tcc3.matc3 +
                  "' " +
                  readonly_string +
                  " disabled/></td>\
                      <td></td>\
                      <td> <a href='#' id='show_file_minhchung_TC3_" +
                  tcc3.matc3 +
                  "' target='_blank' style='display:none' ></a>\
                      <form id='formDanhGiaDRL_TC3_" +
                  tcc3.matc3 +
                  "' method='post' enctype='multipart/form-data'></form></td>\
                                    </tr>";
              } else {
                html +=
                  "<tr>\
                                    <td>" +
                  tcc3.noidung +
                  "</span></td>\
                                    <td><em>" +
                  tcc3.diem +
                  "đ</em></td>\
                                    <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
                  tcc3.diem +
                  ")' max_value='" +
                  tcc3.diem +
                  "'  id='TC3_" +
                  tcc3.matc3 +
                  "' " +
                  readonly_string +
                  (isAllowedToScore_SinhVien ? "" : "disabled") +
                  " /></td>\
                      <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
                  tcc3.diem +
                  ")' max_value='" +
                  tcc3.diem +
                  "'  id='CVHT_TC3_" +
                  tcc3.matc3 +
                  "' " +
                  readonly_string +
                  (isAllowedToScore_CVHT ? "" : "disabled") +
                  " /></td>\
                      <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
                  tcc3.diem +
                  ")' max_value='" +
                  tcc3.diem +
                  "'  id='Khoa_TC3_" +
                  tcc3.matc3 +
                  "' " +
                  readonly_string +
                  (isAllowedToScore_Khoa ? "" : "disabled") +
                  " /></td>\
                      <td>\
                        <button type='button' class='btn btn-light btn_XemDanhSachHoatDong' style='color: black;width: max-content;' data-bs-toggle='modal' data-bs-target='#XemDanhSachHoatDongModal' data-tieuchi-id='TC3_" +
                  tcc3.matc3 +
                  "' data-tentieuchi='" +
                  tcc3.noidung +
                  "' >Danh sách</button>\
                      </td>\
                      <td>\
                      <div class='box'>" +
                  (isAllowedToScore_SinhVien || isAllowedToScore_CVHT
                    ? "<a href='#' id='show_file_minhchung_TC3_" +
                      tcc3.matc3 +
                      "' target='_blank' ></a>\
                        <form id='formDanhGiaDRL_TC3_" +
                      tcc3.matc3 +
                      "' method='post' enctype='multipart/form-data'>\
                          <input type='file' id='file_minhchung_TC3_" +
                      tcc3.matc3 +
                      "' name='fileMinhChung' class='inputfile inputfile-1' accept='.png,.jpg,.jpeg' data-multiple-caption='{count} files selected' >\
                          <label for='file_minhchung_TC3_" +
                      tcc3.matc3 +
                      "'>\
                            <svg xmlns='http://www.w3.org/2000/svg' width='20' height='17' viewBox='0 0 20 17'><path d='M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z'></path></svg>\
                            <span>Chọn tệp…</span>\
                          </label>\
                        </form>"
                    : "<a href='#' id='show_file_minhchung_TC3_" +
                      tcc3.matc3 +
                      "' target='_blank' style='display:none' ></a>\
                          <button type='button' class='btn btn-light btn_AnhMinhChung' data-bs-toggle='modal' data-bs-target='#AnhMinhChungModal' data-img-id='img_file_minhchung_TC3_" +
                      tcc3.matc3 +
                      "' ><img src='' id='img_file_minhchung_TC3_" +
                      tcc3.matc3 +
                      "' width='100px' /></button>\
                          <form id='formDanhGiaDRL_TC3_" +
                      tcc3.matc3 +
                      "' method='post' enctype='multipart/form-data'>\
                          </form>") +
                  "</div>\
                    </td>\
                        </tr>";
              }
            }
          });
        }
      });

      // Điểm tổng cộng của tiêu chí 1
      html +=
        "<tr style='background: darkseagreen;' >\
            <td style='font-weight: bold;' >Cộng: </span>\
            </td>\
            <td><em></em></td>\
            <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this," +
        tcc1.diemtoida +
        ")' max-value='" +
        tcc1.diemtoida +
        "' min='0' max='" +
        tcc1.diemtoida +
        "' id='TongCong_TC1_" +
        tcc1.matc1 +
        "' disabled/></td>\
          <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this," +
        tcc1.diemtoida +
        ")' max-value='" +
        tcc1.diemtoida +
        "' min='0' max='" +
        tcc1.diemtoida +
        "' id='CVHT_TongCong_TC1_" +
        tcc1.matc1 +
        "' disabled/></td>\
          <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this," +
        tcc1.diemtoida +
        ")' max-value='" +
        tcc1.diemtoida +
        "' min='0' max='" +
        tcc1.diemtoida +
        "' id='Khoa_TongCong_TC1_" +
        tcc1.matc1 +
        "' disabled/></td>\
          <td></td>\
          <td></td>\
            </tr>";
    });

    // Điểm tổng cộng của phiếu rèn luyện
    html +=
      "<tr>\
              <td style='font-weight: bold;' >ĐIỂM TỔNG CỘNG (tối đa không quá 100 điểm): </span>\
              </td>\
              <td><em></em></td>\
              <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this, 100)' id='input_diemtongcong' readonly='true' /></td>\
              <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this, 100)' id='CVHT_input_diemtongcong'  readonly='true' /></td>\
              <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this, 100)' id='Khoa_input_diemtongcong' name='diemTongCong' readonly='true' /></td>\
              <td></td>\
              <td></td>\
              </tr>";

    // Điểm tổng cộng đã chốt
    html +=
      "<tr>\
            <td style='font-weight: bold;text-transform: uppercase;font-size: 18px;'  >ĐIỂM: <span id='text_diemTongCong' ></span></td>\
            <td></td>\
            <td style='font-weight: bold;text-transform: uppercase;' colspan='2' >Xếp loại: <span id='text_XepLoai' ></span></td>\
            <td></td>\
            <td style='font-weight: bold;'  ><span></span></td>\
        </tr>";

    $(selector).append(html);

    /*
    Create lại phiếu rèn luyện mới sẽ tạo lại các input 
        => Các inputs này chưa được apply onChange event để xử lý chấm điểm
        => Call xuLyChamDiem() để apply lại onChange event để xử lý chấm điểm
    */
    xuLyChamDiem(userRole, selector);
  }
}

function setDiemPhieuRenLuyen(
  thongTinPhieu,
  diemTieuChiCap2 = [],
  diemTieuChiCap3 = [],
  thongBaoDanhGia,
  userRole,
  selector
) {
  selector += " ";

  // Phiếu rèn luyện mới (chưa có dữ liệu)
  if (diemTieuChiCap2.length == 0 && diemTieuChiCap3.length == 0) {
    autoFillDiemKetQuaHocTap(
      thongTinPhieu.maSinhVien,
      thongTinPhieu.maHocKyDanhGia,
      userRole,
      true,
      selector
    );

    // $(selector + "#inputTBCHocKyDangXet").on("change", function () {
    //   autoFillDiemKetQuaHocTap(
    //     thongTinPhieu.maSinhVien,
    //     thongTinPhieu.maHocKyDanhGia,
    //     userRole,
    //     true,
    //     selector
    //   );
    // });

    // $(selector + "#inputTBCHocKyTruoc").on("change", function () {
    //   autoFillDiemKetQuaHocTap(
    //     thongTinPhieu.maSinhVien,
    //     thongTinPhieu.maHocKyDanhGia,
    //     userRole,
    //     true,
    //     selector
    //   );
    // });

    autoFillDiemHoatDong(
      thongTinPhieu.maSinhVien,
      thongTinPhieu.maHocKyDanhGia,
      selector
    );

    tinhTongDiem(userRole, true, selector);
  }
  // Phiếu đã có điểm
  else {
    var isAllowedToScore_SinhVien = isAllowedToScore(
      thongBaoDanhGia,
      userRole,
      [roleSinhVien]
    );
    var isAllowedToScore_CVHT = isAllowedToScore(thongBaoDanhGia, userRole, [
      roleCVHT,
    ]);
    var isAllowedToScore_Khoa =
      isAllowedToScore(thongBaoDanhGia, userRole, [roleKhoa]) &&
      thongTinPhieu.coVanDuyet == 1;

    // $(selector + "#inputTBCHocKyTruoc").val(
    //   thongTinPhieu.diemTrungBinhChungHKTruoc
    // );
    // $(selector + "#inputTBCHocKyDangXet").val(
    //   thongTinPhieu.diemTrungBinhChungHKXet
    // );

    $(selector + "#text_diemTongCong").text(thongTinPhieu.diemTongCong);
    $(selector + "#text_XepLoai").text(thongTinPhieu.xepLoai);

    // Điểm tiêu chí cấp 2
    diemTieuChiCap2.forEach(function (diem) {
      var fileMinhChung_Name = diem.fileMinhChung.substring(
        diem.fileMinhChung.lastIndexOf("/") + 1
      );

      $(selector)
        .find("input")
        .each(function () {
          var tieuChi = this.id.slice(0, 3);
          var maTieuChi = this.id.slice(4, 9);

          if (tieuChi == "TC2") {
            if (diem.maTieuChi2 == maTieuChi) {
              // Hiện điểm sinh viên đánh giá
              $(selector + "#" + this.id).val(diem.diemSinhVienDanhGia);

              // Hiện điểm cố vấn học tập đánh giá
              if (isAllowedToScore_CVHT) {
                if (thongTinPhieu.coVanDuyet == 0) {
                  $(selector + "#CVHT_" + this.id).val(
                    diem.diemSinhVienDanhGia
                  );
                } else {
                  $(selector + "#CVHT_" + this.id).val(diem.diemLopDanhGia);
                }
              } else {
                $(selector + "#CVHT_" + this.id).val(diem.diemLopDanhGia);
              }

              // Hiện điểm khoa đánh giá
              if (isAllowedToScore_Khoa) {
                if (thongTinPhieu.khoaDuyet == 0) {
                  if (thongTinPhieu.coVanDuyet == 0) {
                    $(selector + "#Khoa_" + this.id).val(
                      diem.diemSinhVienDanhGia
                    );
                  } else {
                    $(selector + "#Khoa_" + this.id).val(diem.diemLopDanhGia);
                  }
                } else {
                  $(selector + "#Khoa_" + this.id).val(diem.diemKhoaDanhGia);
                }
              } else {
                $(selector + "#Khoa_" + this.id).val(diem.diemKhoaDanhGia);
                $(selector + "#Khoa_" + this.id).prop("disabled", true);
              }

              // Hiện file minh chứng
              $(selector + "#show_file_minhchung_" + this.id).text(
                fileMinhChung_Name.length > 10
                  ? fileMinhChung_Name.substring(0, 10) + "..."
                  : fileMinhChung_Name
              );
              $(selector + "#show_file_minhchung_" + this.id).attr(
                "href",
                diem.fileMinhChung
              );

              // Hiện ảnh minh chứng lên <td> tag
              if ($(selector + "#img_file_minhchung_" + this.id).length) {
                $(selector + "#img_file_minhchung_" + this.id).attr(
                  "src",
                  diem.fileMinhChung
                );
              }
            }
          }
        });
    });

    // Điểm tiêu chí cấp 3
    diemTieuChiCap3.forEach(function (diem) {
      var fileMinhChung_Name = diem.fileMinhChung.substring(
        diem.fileMinhChung.lastIndexOf("/") + 1
      );

      $(selector)
        .find("input")
        .each(function () {
          var tieuChi = this.id.slice(0, 3);
          var maTieuChi = this.id.slice(4, 9);

          if (tieuChi == "TC3") {
            if (diem.maTieuChi3 == maTieuChi) {
              // Hiện điểm sinh viên đánh giá
              $(selector + "#" + this.id).val(diem.diemSinhVienDanhGia);

              // Hiện điểm cố vấn học tập đánh giá
              if (isAllowedToScore_CVHT) {
                if (thongTinPhieu.coVanDuyet == 0) {
                  $(selector + "#CVHT_" + this.id).val(
                    diem.diemSinhVienDanhGia
                  );
                } else {
                  $(selector + "#CVHT_" + this.id).val(diem.diemLopDanhGia);
                }
              } else {
                $(selector + "#CVHT_" + this.id).val(diem.diemLopDanhGia);
              }

              // Hiện điểm khoa đánh giá
              if (isAllowedToScore_Khoa) {
                if (thongTinPhieu.khoaDuyet == 0) {
                  if (thongTinPhieu.coVanDuyet == 0) {
                    $(selector + "#Khoa_" + this.id).val(
                      diem.diemSinhVienDanhGia
                    );
                  } else {
                    $(selector + "#Khoa_" + this.id).val(diem.diemLopDanhGia);
                  }
                } else {
                  $(selector + "#Khoa_" + this.id).val(diem.diemKhoaDanhGia);
                }
              } else {
                $(selector + "#Khoa_" + this.id).val(diem.diemKhoaDanhGia);
                $(selector + "#Khoa_" + this.id).prop("disabled", true);
              }

              // Hiện file minh chứng
              $(selector + "#show_file_minhchung_" + this.id).text(
                fileMinhChung_Name
              );
              $(selector + "#show_file_minhchung_" + this.id).attr(
                "href",
                diem.fileMinhChung
              );

              $(selector + "#img_file_minhchung_" + this.id).attr(
                "src",
                diem.fileMinhChung
              );
            }
          }
        });
    });

    if (userRole == roleKhoa && thongTinPhieu.coVanDuyet == 0) {
      isAllowedToScore_Khoa;
    }

    autoFillDiemKetQuaHocTap(
      thongTinPhieu.maSinhVien,
      thongTinPhieu.maHocKyDanhGia,
      userRole,
      userRole == roleKhoa
        ? isAllowedToScore_Khoa
        : isAllowedToScore(thongBaoDanhGia, userRole, [
            roleSinhVien,
            roleCVHT,
            roleKhoa,
          ]),
      selector
    );

    tinhTongDiem(
      userRole,
      userRole == roleKhoa
        ? isAllowedToScore_Khoa
        : isAllowedToScore(thongBaoDanhGia, userRole, [
            roleSinhVien,
            roleCVHT,
            roleKhoa,
          ]),
      selector
    );
  }
}

function createFormDataDiemDanhGia(diemDanhGia) {
  var formData = new FormData(
    document.querySelector(diemDanhGia.idFormMinhChung)
  );

  formData.append("maChamDiemRenLuyen", diemDanhGia.maChamDiemRenLuyen);
  formData.append("maPhieuRenLuyen", diemDanhGia.maPhieuRenLuyen);
  formData.append("maTieuChi3", diemDanhGia.maTieuChi3);
  formData.append("maTieuChi2", diemDanhGia.maTieuChi2);
  formData.append("maSinhVien", diemDanhGia.maSinhVien);
  formData.append("diemSinhVienDanhGia", diemDanhGia.diemSinhVienDanhGia);
  formData.append("diemLopDanhGia", diemDanhGia.diemLopDanhGia);
  formData.append("diemKhoaDanhGia", diemDanhGia.diemKhoaDanhGia);
  formData.append("ghiChu", diemDanhGia.ghiChu);

  return formData;
}

function createDiemDanhGia(input, userRole, maPhieuRenLuyen, maSinhVien) {
  var formDataDiemDanhGia = null;

  if (userRole == roleSinhVien) {
    var _inputDiemSVDanhGia = input.value;
    var tieuChi = input.id.slice(0, 3);

    if (tieuChi == "TC2") {
      var _inputMaTieuChi2 = input.id.slice(4);
      var idFormMinhChung = "#formDanhGiaDRL_" + input.id;

      var diemDanhGiaMoi = {
        maPhieuRenLuyen: maPhieuRenLuyen,
        maTieuChi2: _inputMaTieuChi2,
        maTieuChi3: "0",
        maSinhVien: maSinhVien,
        diemSinhVienDanhGia: _inputDiemSVDanhGia,
        diemLopDanhGia: null,
        diemKhoaDanhGia: null,
        ghiChu: "",
        idFormMinhChung: idFormMinhChung,
      };

      formDataDiemDanhGia = createFormDataDiemDanhGia(diemDanhGiaMoi);
    } else if (tieuChi == "TC3") {
      var _inputMaTieuChi3 = input.id.slice(4);
      var idFormMinhChung = "#formDanhGiaDRL_" + input.id;

      var diemDanhGiaMoi = {
        maPhieuRenLuyen: maPhieuRenLuyen,
        maTieuChi2: "0",
        maTieuChi3: _inputMaTieuChi3,
        maSinhVien: maSinhVien,
        diemSinhVienDanhGia: _inputDiemSVDanhGia,
        diemLopDanhGia: null,
        diemKhoaDanhGia: null,
        ghiChu: "",
        idFormMinhChung: idFormMinhChung,
      };

      formDataDiemDanhGia = createFormDataDiemDanhGia(diemDanhGiaMoi);
    }
  }

  if (formDataDiemDanhGia != null) {
    // Create điểm
    $.ajax({
      url: urlapi_chamdiemrenluyen_create,
      data: formDataDiemDanhGia,
      async: false,
      type: "POST",
      contentType: false,
      cache: false,
      processData: false,
      headers: {
        Authorization: jwtCookie,
      },
      success: function (resultCreate_ChamDiemRenLuyen) {},
      error: function (error) {
        console.log("Lỗi tạo điểm đánh giá");
        alertError(error.responseText);
      },
    });
  }
}

function updateDiemDanhGia(input, userRole, diemDanhGiaCu) {
  var formDataDiemDanhGia = null;

  if (userRole == roleSinhVien) {
    var _inputDiemSVDanhGia = input.value;
    var tieuChi = input.id.slice(0, 3);

    if (tieuChi == "TC2") {
      var _inputMaTieuChi2 = input.id.slice(4);

      if (_inputMaTieuChi2 == diemDanhGiaCu.maTieuChi2) {
        var idFormMinhChung = "#formDanhGiaDRL_" + input.id;
        var diemDanhGiaMoi = {
          ...diemDanhGiaCu,
          diemSinhVienDanhGia: _inputDiemSVDanhGia,
          idFormMinhChung: idFormMinhChung,
        };

        formDataDiemDanhGia = createFormDataDiemDanhGia(diemDanhGiaMoi);
      }
    } else if (tieuChi == "TC3") {
      var _inputMaTieuChi3 = input.id.slice(4);

      if (_inputMaTieuChi3 == diemDanhGiaCu.maTieuChi3) {
        var idFormMinhChung = "#formDanhGiaDRL_" + input.id;
        var diemDanhGiaMoi = {
          ...diemDanhGiaCu,
          diemSinhVienDanhGia: _inputDiemSVDanhGia,
          idFormMinhChung: idFormMinhChung,
        };

        formDataDiemDanhGia = createFormDataDiemDanhGia(diemDanhGiaMoi);
      }
    }
  } else if (userRole == roleCVHT) {
    var _inputDiemLopDanhGia = input.value;
    var tieuChi = input.id.slice(0, 8);

    if (tieuChi == "CVHT_TC2") {
      var _inputMaTieuChi2 = input.id.slice(9);

      if (_inputMaTieuChi2 == diemDanhGiaCu.maTieuChi2) {
        var idFormMinhChung = "#formDanhGiaDRL_TC2_" + _inputMaTieuChi2;
        var diemDanhGiaMoi = {
          ...diemDanhGiaCu,
          diemLopDanhGia: _inputDiemLopDanhGia,
          idFormMinhChung: idFormMinhChung,
        };

        formDataDiemDanhGia = createFormDataDiemDanhGia(diemDanhGiaMoi);
      }
    } else if (tieuChi == "CVHT_TC3") {
      var _inputMaTieuChi3 = input.id.slice(9);

      if (_inputMaTieuChi3 == diemDanhGiaCu.maTieuChi3) {
        var idFormMinhChung = "#formDanhGiaDRL_TC3_" + _inputMaTieuChi3;
        var diemDanhGiaMoi = {
          ...diemDanhGiaCu,
          diemLopDanhGia: _inputDiemLopDanhGia,
          idFormMinhChung: idFormMinhChung,
        };

        formDataDiemDanhGia = createFormDataDiemDanhGia(diemDanhGiaMoi);
      }
    }
  } else if (userRole == roleKhoa) {
    var _inputDiemKhoaDanhGia = input.value;
    var tieuChi = input.id.slice(0, 8);

    if (tieuChi == "Khoa_TC2") {
      var _inputMaTieuChi2 = input.id.slice(9);

      if (_inputMaTieuChi2 == diemDanhGiaCu.maTieuChi2) {
        var idFormMinhChung = "#formDanhGiaDRL_TC2_" + _inputMaTieuChi2;
        var diemDanhGiaMoi = {
          ...diemDanhGiaCu,
          diemKhoaDanhGia: _inputDiemKhoaDanhGia,
          idFormMinhChung: idFormMinhChung,
        };

        formDataDiemDanhGia = createFormDataDiemDanhGia(diemDanhGiaMoi);
      }
    } else if (tieuChi == "Khoa_TC3") {
      var _inputMaTieuChi3 = input.id.slice(9);

      if (_inputMaTieuChi3 == diemDanhGiaCu.maTieuChi3) {
        var idFormMinhChung = "#formDanhGiaDRL_TC3_" + _inputMaTieuChi3;
        var diemDanhGiaMoi = {
          ...diemDanhGiaCu,
          diemKhoaDanhGia: _inputDiemKhoaDanhGia,
          idFormMinhChung: idFormMinhChung,
        };

        formDataDiemDanhGia = createFormDataDiemDanhGia(diemDanhGiaMoi);
      }
    }
  }

  if (formDataDiemDanhGia != null) {
    // Update điểm
    $.ajax({
      url: urlapi_chamdiemrenluyen_update,
      data: formDataDiemDanhGia,
      async: false,
      type: "POST",
      contentType: false,
      cache: false,
      processData: false,
      headers: {
        Authorization: jwtCookie,
      },
      success: function (resultUpdate_ChamDiemRenLuyen) {},
      error: function (error) {
        console.log("Lỗi update điểm đánh giá");
        alertError(error.responseText);
      },
    });

    return true;
  }

  return false;
}

function xuLyLuuDiemRenLuyen(
  phieuRenLuyen,
  userRole,
  selector,
  successCallback
) {
  selector += " ";

  $(selector).on("submit", function (e) {
    e.preventDefault();

    Swal.fire({
      title: "Xác nhận duyệt điểm rèn luyện?",
      showDenyButton: true,
      confirmButtonText: "Xác nhận",
      denyButtonText: `Đóng`,
    }).then((confirmation) => {
      if (confirmation.isConfirmed) {
        if (
          isAllowedToScore(phieuRenLuyen.thongBaoDanhGia, userRole, [
            roleSinhVien,
            roleCVHT,
            roleKhoa,
          ])
        ) {
          var maPhieuRenLuyen;
          var diemTBCHKTruoc = $("#inputTBCHocKyTruoc").val();
          var diemTBCHKDangXet = $("#inputTBCHocKyDangXet").val();

          var idInputDiemTongCong = "input_diemtongcong";

          if (userRole == roleCVHT) {
            idInputDiemTongCong = "CVHT_" + idInputDiemTongCong;
          } else if (userRole == roleKhoa) {
            idInputDiemTongCong = "Khoa_" + idInputDiemTongCong;
          }

          var diemTongCong = Number($("#" + idInputDiemTongCong).val());
          var xepLoai = rank(diemTongCong);

          var formDataPRL = new FormData(document.querySelector(selector));
          formDataPRL.append("maSinhVien", phieuRenLuyen.sinhVien.maSinhVien);
          formDataPRL.append(
            "maHocKyDanhGia",
            phieuRenLuyen.hocKyDanhGia.maHocKyDanhGia
          );
          formDataPRL.append("diemTrungBinhChungHKTruoc", diemTBCHKTruoc);
          formDataPRL.append("diemTrungBinhChungHKXet", diemTBCHKDangXet);
          formDataPRL.append("diemTongCong", diemTongCong);
          formDataPRL.append("xepLoai", xepLoai);

          // Phiếu không tồn tại => Sinh viên lần đầu chấm điểm
          if (
            typeof phieuRenLuyen.thongTinPhieu.maPhieuRenLuyen === "undefined"
          ) {
            if (userRole == roleSinhVien) {
              maPhieuRenLuyen =
                "PRL" +
                phieuRenLuyen.hocKyDanhGia.maHocKyDanhGia +
                phieuRenLuyen.sinhVien.maSinhVien;

              formDataPRL.append("maPhieuRenLuyen", maPhieuRenLuyen);

              //Tạo phiếu rèn luyện trước
              $.ajax({
                url: urlapi_phieurenluyen_create,
                data: formDataPRL,
                async: false,
                type: "POST",
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                  Authorization: jwtCookie,
                },
                success: function (resultCreate) {
                  phieuRenLuyen.thongTinPhieu = {
                    maPhieuRenLuyen: maPhieuRenLuyen,
                    xepLoai: xepLoai,
                    diemTongCong: diemTongCong,
                    maSinhVien: phieuRenLuyen.sinhVien.maSinhVien,
                    diemTrungBinhChungHKTruoc: diemTBCHKTruoc,
                    diemTrungBinhChungHKXet: diemTBCHKDangXet,
                    maHocKyDanhGia: phieuRenLuyen.hocKyDanhGia.maHocKyDanhGia,
                    coVanDuyet: 0,
                    khoaDuyet: 0,
                  };

                  // Tạo điểm đánh giá cho phiếu
                  $(selector)
                    .find("input")
                    .each(function () {
                      createDiemDanhGia(
                        this,
                        userRole,
                        maPhieuRenLuyen,
                        phieuRenLuyen.sinhVien.maSinhVien
                      );
                    });
                },
                error: function (error) {
                  console.log("Lỗi tạo điểm đánh giá");
                  alertError(error.responseJSON.message);
                  return;
                },
              });
            } else {
              alertError("Phiếu không tồn tại!");
              return;
            }
          }
          // Phiếu đã tồn tại
          else {
            formDataPRL.append(
              "maPhieuRenLuyen",
              phieuRenLuyen.thongTinPhieu.maPhieuRenLuyen
            );

            if (userRole == roleKhoa) {
              formDataPRL.append(
                "coVanDuyet",
                phieuRenLuyen.thongTinPhieu.coVanDuyet
              );
              formDataPRL.append("khoaDuyet", 1);
            } else if (userRole == roleCVHT) {
              formDataPRL.append("coVanDuyet", 1);
              formDataPRL.append(
                "khoaDuyet",
                phieuRenLuyen.thongTinPhieu.khoaDuyet
              );
            } else if (userRole == roleSinhVien) {
              formDataPRL.append(
                "coVanDuyet",
                phieuRenLuyen.thongTinPhieu.coVanDuyet
              );
              formDataPRL.append(
                "khoaDuyet",
                phieuRenLuyen.thongTinPhieu.khoaDuyet
              );
            }

            // Nếu khoa đã duyệt
            if (phieuRenLuyen.thongTinPhieu.khoaDuyet == 1) {
              // Nếu người đang chấm không phải khoa => Giữ điểm tổng cộng và xếp loại cũ
              if (userRole != roleKhoa) {
                formDataPRL.set(
                  "diemTongCong",
                  phieuRenLuyen.thongTinPhieu.diemTongCong
                );
                formDataPRL.set("xepLoai", phieuRenLuyen.thongTinPhieu.xepLoai);
              }
            }
            // Nếu cố vấn đã duyệt và khoa chưa duyệt
            else if (phieuRenLuyen.thongTinPhieu.coVanDuyet == 1) {
              // Nếu người đang chấm không phải cvht hoặc khoa => Giữ điểm tổng cộng và xếp loại cũ
              if (userRole != roleKhoa && userRole != roleCVHT) {
                formDataPRL.set(
                  "diemTongCong",
                  phieuRenLuyen.thongTinPhieu.diemTongCong
                );
                formDataPRL.set("xepLoai", phieuRenLuyen.thongTinPhieu.xepLoai);
              }
            }

            //Update phiếu rèn luyện trước
            $.ajax({
              url: urlapi_phieurenluyen_update,
              async: false,
              type: "POST",
              contentType: false,
              cache: false,
              processData: false,
              data: formDataPRL,
              headers: {
                Authorization: jwtCookie,
              },
              success: function (resultUpdate) {
                phieuRenLuyen.thongTinPhieu = {
                  maPhieuRenLuyen: phieuRenLuyen.thongTinPhieu.maPhieuRenLuyen,
                  xepLoai: xepLoai,
                  diemTongCong: diemTongCong,
                  maSinhVien: phieuRenLuyen.sinhVien.maSinhVien,
                  diemTrungBinhChungHKTruoc: diemTBCHKTruoc,
                  diemTrungBinhChungHKXet: diemTBCHKDangXet,
                  maHocKyDanhGia: phieuRenLuyen.hocKyDanhGia.maHocKyDanhGia,
                  coVanDuyet: userRole == roleCVHT ? 1 : 0,
                  khoaDuyet: userRole == roleKhoa ? 1 : 0,
                };
              },
              error: function (error) {
                console.log("Lỗi update phiếu");
                alertError(error.responseText);
                return;
              },
            });

            // Update điểm tiêu chí 2 & 3 vào phiếu
            var dsDiemDanhGiaCu = $.merge(
              phieuRenLuyen.diemTieuChiCap2,
              phieuRenLuyen.diemTieuChiCap3
            );

            if (dsDiemDanhGiaCu.length != 0) {
              dsDiemDanhGiaCu.forEach(function (diemDanhGia) {
                $(selector)
                  .find("input")
                  .each(function () {
                    var resultUpdate = updateDiemDanhGia(
                      this,
                      userRole,
                      diemDanhGia
                    );

                    // Dừng vòng lặp input khi đã update điểm tiêu chí của input cần tìm
                    if (resultUpdate) return false;
                  });
              });
            }
          }

          successCallback();
        } else {
          alertError("Rất tiếc! Đã hết thời gian đánh giá!");
          return;
        }
      }
    });
  });
}
