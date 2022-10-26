function getThongTinPhieuRenLuyen(maPhieuRenLuyen) {
  // Reset phieuRenLuyen
  phieuRenLuyen = {
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

  // Sort tieuChiCap1 theo matc1 giảm dần
  phieuRenLuyen.tieuChiCap1.sort((a, b) => a.matc1 - b.matc1);

  // Sort tieuChiCap2 theo matc1 giảm dần
  phieuRenLuyen.tieuChiCap2.sort((a, b) => a.matc2 - b.matc2);

  // Lay thong tin sinh vien
  $.ajax({
    url: urlapi_sinhvien_details_read + phieuRenLuyen.thongTinPhieu.maSinhVien,
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

  // Lay thong tin hoc ky danh gia
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

  return phieuRenLuyen;
}

function isAllowedToScore(thongBaoDanhGia, userRole, validRoles) {
  var result = false;
  var today = new Date();

  if (validRoles.indexOf(userRole) >= 0) {
    if (userRole == "sinhvien") {
      if (
        typeof thongBaoDanhGia.ngaySinhVienDanhGia !== "undefined" &&
        typeof thongBaoDanhGia.ngaySinhVienKetThucDanhGia !== "undefined"
      ) {
        if (
          new Date(thongBaoDanhGia.ngaySinhVienDanhGia) <= today &&
          today <= new Date(thongBaoDanhGia.ngaySinhVienKetThucDanhGia)
        ) {
          result = true;
        }
      }
    } else if (userRole == "cvht") {
      if (
        typeof thongBaoDanhGia.ngayCoVanDanhGia !== "undefined" &&
        typeof thongBaoDanhGia.ngayCoVanKetThucDanhGia !== "undefined"
      ) {
        if (
          new Date(thongBaoDanhGia.ngayCoVanDanhGia) <= today &&
          today <= new Date(thongBaoDanhGia.ngayCoVanKetThucDanhGia)
        ) {
          result = true;
        }
      }
    } else if (userRole == "khoa") {
      if (
        typeof thongBaoDanhGia.ngayKhoaDanhGia !== "undefined" &&
        typeof thongBaoDanhGia.ngayKhoaKetThucDanhGia !== "undefined"
      ) {
        if (
          new Date(thongBaoDanhGia.ngayKhoaDanhGia) <= today &&
          today <= new Date(thongBaoDanhGia.ngayKhoaKetThucDanhGia)
        ) {
          result = true;
        }
      }
    }
  }

  return result;
}

//Load thông tin sinh viên lên phiếu
function LoadThongTinSinhVien(sinhVien, hocKyDanhGia, element) {
  var hoTenSinhVien = sinhVien.hoTenSinhVien;
  var ngaySinh = new Date(sinhVien.ngaySinh);
  var maLop = sinhVien.maLop;
  var he = sinhVien.he;
  var maKhoa = sinhVien.maKhoa;
  var tenKhoa = sinhVien.tenKhoa;
  var hocKyXet = hocKyDanhGia.hocKyXet;
  var namHocXet = hocKyDanhGia.namHocXet;

  $(element).empty();

  $(element).append(
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
                <input type='text' id='input_maHocKyDanhGia' value='" +
      hocKyDanhGia.maHocKyDanhGia +
      "' /></span>\
                </div>\
                </div>\
                "
  );
}

function createPhieuRenLuyenForm(
  tieuChiDanhGiaList,
  thongBaoDanhGia,
  element,
  userRole
) {
  if (tieuChiDanhGiaList) {
    var html = "";

    $(element).empty();

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
              (isAllowedToScore(thongBaoDanhGia, userRole, ["sinhvien"])
                ? ""
                : "disabled") +
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
              (isAllowedToScore(thongBaoDanhGia, userRole, ["cvht"])
                ? ""
                : "disabled") +
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
              (isAllowedToScore(thongBaoDanhGia, userRole, ["khoa"])
                ? ""
                : "disabled") +
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
                        <div class='box'>\
                        <a href='#' id='show_file_minhchung_TC2_" +
              tcc2.matc2 +
              "' target='_blank' style='display:none' ></a>\
                        <button type='button' class='btn btn-light btn_AnhMinhChung' data-bs-toggle='modal' data-bs-target='#AnhMinhChungModal' data-img-id='img_file_minhchung_TC2_" +
              tcc2.matc2 +
              "' ><img src='#' id='img_file_minhchung_TC2_" +
              tcc2.matc2 +
              "' width='100px' /></button>\
                        <form id='formDanhGiaDRL_TC2_" +
              tcc2.matc2 +
              "' method='post' enctype='multipart/form-data'>\
                        </form>\
                    </div>\
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
                "<br>Điểm TBC học kỳ trước: <input type='number' step='0.01' onchange='changeNumberHandle(this,4)' id='inputTBCHocKyTruoc' name='diemTrungBinhChungHKTruoc' style='width: 100px;margin-right: 30px;margin-bottom: 15px;' /><br>Điểm TBC học kỳ đang xét: <input type='number' step='0.01' onchange='changeNumberHandle(this,4)' id='inputTBCHocKyDangXet' name='diemTrungBinhChungHKXet' style='width: 100px;' /> </em></td>\
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
              }

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
                ) == 0 ||
                tcc3.noidung.localeCompare(
                  "c. Sinh viên năm thứ I, nếu có kết quả học tập HK I từ 2,00 trở lên"
                ) == 0
              ) {
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
                  (isAllowedToScore(thongBaoDanhGia, userRole, ["sinhvien"])
                    ? ""
                    : "disabled") +
                  " /></td>\
                      <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
                  tcc3.diem +
                  ")' max_value='" +
                  tcc3.diem +
                  "'  id='CVHT_TC3_" +
                  tcc3.matc3 +
                  "' " +
                  readonly_string +
                  (isAllowedToScore(thongBaoDanhGia, userRole, ["cvht"])
                    ? ""
                    : "disabled") +
                  " /></td>\
                      <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
                  tcc3.diem +
                  ")' max_value='" +
                  tcc3.diem +
                  "'  id='Khoa_TC3_" +
                  tcc3.matc3 +
                  "' " +
                  readonly_string +
                  (isAllowedToScore(thongBaoDanhGia, userRole, ["khoa"])
                    ? ""
                    : "disabled") +
                  " /></td>\
                      <td>\
                        <button type='button' class='btn btn-light btn_XemDanhSachHoatDong' style='color: black;width: max-content;' data-bs-toggle='modal' data-bs-target='#XemDanhSachHoatDongModal' data-tieuchi-id='TC3_" +
                  tcc3.matc3 +
                  "' data-tentieuchi='" +
                  tcc3.noidung +
                  "' >Danh sách</button>\
                      </td>\
                      <td>\
                      <div class='box'>\
                          <a href='#' id='show_file_minhchung_TC3_" +
                  tcc3.matc3 +
                  "' target='_blank' style='display: none' ></a>\
                          <button type='button' class='btn btn-light btn_AnhMinhChung' data-bs-toggle='modal' data-bs-target='#AnhMinhChungModal' data-img-id='img_file_minhchung_TC3_" +
                  tcc3.matc3 +
                  "' ><img src='#' id='img_file_minhchung_TC3_" +
                  tcc3.matc3 +
                  "' width='100px' /></button>\
                          <form id='formDanhGiaDRL_TC3_" +
                  tcc3.matc3 +
                  "' method='post' enctype='multipart/form-data'>\
                        </form>\
                        </div>\
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

    $(element).append(html);
  }
}
