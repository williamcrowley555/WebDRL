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

function thongBaoLoi(message) {
  Swal.fire({
    icon: "error",
    title: "Lỗi",
    text: message,
    timer: 2000,
    timerProgressBar: true,
  });
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

function changeNumberHandle(val, number) {
  if (val.value != "") {
    if (isNaN(val.value) == false) {
      //console.log(val.value);

      if (number < 0) {
        if (Number(val.value) < number) {
          val.value = number;
        } else {
          if (Number(val.value) > 0) {
            val.value = 0;
          }
        }
      } else {
        if (Number(val.value) > number) {
          val.value = number;
        } else {
          if (Number(val.value) < 0) {
            val.value = 0;
          }
        }
      }
    } else {
      val.value = 0;
    }
  } else {
    val.value = 0;
  }
}

//---------------------------------------------//

function checkLoiDangNhap(message) {
  if (message.localeCompare("Vui lòng đăng nhập trước!") == 0) {
    deleteAllCookies();
    location.href = "login.php";
  }
}

var jwtCookie = getCookie("jwt");

//phieurenluyen//
function GetListPhieurenluyen(maLop, maHocKyDanhGia) {
  $("#id_tbodyPhieuRenLuyen tr").remove();

  if (maLop) {
    $.ajax({
      url:
        urlapi_phieurenluyen_read +
        `?maLop=${maLop}&maHocKyDanhGia=${maHocKyDanhGia}`,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: true,
      headers: { Authorization: jwtCookie },
      success: function (result) {
        $("#idPhanTrang").pagination({
          dataSource: result["phieurenluyen"],
          pageSize: 10,
          autoHidePrevious: true,
          autoHideNext: true,

          callback: function (data, pagination) {
            var htmlData = "";
            var count = 0;

            for (let i = 0; i < data.length; i++) {
              count += 1;
              var thongBaoDanhGia = {};

              // Lấy thông báo đánh giá
              $.ajax({
                url:
                  urlapi_thongbaodanhgia_single_read_MaHKDG +
                  data[i].maHocKyDanhGia,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                  Authorization: jwtCookie,
                },
                success: function (result_TBDG) {
                  thongBaoDanhGia = result_TBDG;
                },
                error: function (error) {},
              });

              htmlData +=
                "<tr>\
                                  <td class='cell'>" +
                data[i].soThuTu +
                "</td>\
                                  <td class='cell'><span class='truncate'>" +
                data[i].maPhieuRenLuyen +
                "</span></td>\
                                  <td class='cell'>" +
                data[i].maSinhVien +
                "</td>\
                                  <td class='cell'>" +
                data[i].maHocKyDanhGia +
                "</td>\
                                  <td class='cell'>" +
                data[i].diemTongCong +
                "</td>\
                                  <td class='cell'>" +
                data[i].xepLoai +
                "</td>\
                                  <td class='cell'>" +
                SetTrangThaiDuyet(data[i].coVanDuyet) +
                "</td>\
                                  <td class='cell'>" +
                SetTrangThaiDuyet(data[i].khoaDuyet) +
                "</td>\
                                  <td class='cell'>\
                                    <button type='button' data-bs-toggle='modal' data-bs-target='#ModalXemVaDuyet' class='btn btn-secondary btn_XemVaDuyet' style='color: white;margin: 5px;' data-id='" +
                data[i].maPhieuRenLuyen +
                "' data-mssv-id='" +
                data[i].maSinhVien +
                "' data-mahocky-id='" +
                data[i].maHocKyDanhGia +
                "' >" +
                (isAllowedToScore(thongBaoDanhGia, getCookie("quyen"), ["khoa"])
                  ? "Xem chi tiết và duyệt"
                  : "Xem chi tiết") +
                "</button>\
                  <form action='http://localhost/WebDRL/mpdf/export_phieuRenLuyen.php' method='POST' class='d-inline form_exportPDFPhieuRenLuyen'>\
                    <input type='hidden' name='data' class='data' />\
                    <button type='submit' class='btn' style='color: white;background: #c04f4f;margin: 5px;'><img src='assets/images/icons/pdf.png' width='17px' /><span style='margin-left: 5px;'>Xuất phiếu</span> </button>\
                  </form>\
                  </td>\
                </tr>";
            }

            $("#id_tbodyPhieuRenLuyen").html(htmlData);
          },
        });
      },
      error: function (errorMessage) {
        checkLoiDangNhap(errorMessage.responseJSON.message);

        thongBaoLoi(errorMessage.responseJSON.message);
      },
    });
  } else {
    thongBaoLoi("Không tìm thấy kết quả!");
  }
}

function TimKiemPhieuRenLuyen(maPhieuRenLuyen) {
  $("#id_tbodyPhieuRenLuyen tr").remove();

  $.ajax({
    url: urlapi_phieurenluyen_read_MaPhieuRenLuyen + maPhieuRenLuyen,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: true,
    headers: { Authorization: jwtCookie },
    success: function (result) {
      $("#idPhanTrang").pagination({
        dataSource: result["phieurenluyen"],
        pageSize: 10,
        autoHidePrevious: true,
        autoHideNext: true,

        callback: function (data, pagination) {
          var htmlData = "";
          var count = 0;

          for (let i = 0; i < data.length; i++) {
            count += 1;
            var thongBaoDanhGia = {};

            // Lấy thông báo đánh giá
            $.ajax({
              url:
                urlapi_thongbaodanhgia_single_read_MaHKDG +
                data[i].maHocKyDanhGia,
              async: false,
              type: "GET",
              contentType: "application/json;charset=utf-8",
              dataType: "json",
              headers: {
                Authorization: jwtCookie,
              },
              success: function (result_TBDG) {
                thongBaoDanhGia = result_TBDG;
              },
              error: function (error) {},
            });

            htmlData +=
              "<tr>\
                                  <td class='cell'>" +
              data[i].soThuTu +
              "</td>\
                                  <td class='cell'><span class='truncate'>" +
              data[i].maPhieuRenLuyen +
              "</span></td>\
                                  <td class='cell'>" +
              data[i].maSinhVien +
              "</td>\
                                  <td class='cell'>" +
              data[i].maHocKyDanhGia +
              "</td>\
                                  <td class='cell'>" +
              data[i].diemTongCong +
              "</td>\
                                  <td class='cell'>" +
              data[i].xepLoai +
              "</td>\
                                  <td class='cell'>" +
              SetTrangThaiDuyet(data[i].coVanDuyet) +
              "</td>\
                                  <td class='cell'>" +
              SetTrangThaiDuyet(data[i].khoaDuyet) +
              "</td>\
                                  <td class='cell'>\
                                    <button type='button' data-bs-toggle='modal' data-bs-target='#ModalXemVaDuyet' class='btn btn-secondary btn_XemVaDuyet' style='color: white;margin: 5px;' data-id='" +
              data[i].maPhieuRenLuyen +
              "' data-mssv-id='" +
              data[i].maSinhVien +
              "' data-mahocky-id='" +
              data[i].maHocKyDanhGia +
              "' >" +
              (isAllowedToScore(thongBaoDanhGia, getCookie("quyen"), ["khoa"])
                ? "Xem chi tiết"
                : "Xem chi tiết và duyệt") +
              "</button>\
                                    <a class='btn' href='#' style='color: white;background: #c04f4f;margin: 5px;'><img src='assets/images/icons/pdf.png' width='17px' /><span style='margin-left: 5px;'>Xuất phiếu</span> </a>\
                                  </td>\
                                  </tr>";
          }

          $("#id_tbodyPhieuRenLuyen").html(htmlData);
        },
      });
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      thongBaoLoi(errorMessage.responseJSON.message);
    },
  });
}

function SetTrangThaiDuyet(value) {
  var trangThaiDuyet = "";
  if (value == 1) {
    trangThaiDuyet =
      "<span class='badge bg-success' style='color: white;font-size: inherit;'>Đã duyệt</span>";
  } else {
    if (value == 0) {
      trangThaiDuyet =
        "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Chưa duyệt</span>";
    }
  }

  return trangThaiDuyet;
}

function LoadComboBoxThongTinKhoa() {
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

function LoadComboBoxThongTinLopTheoKhoa(maKhoa) {
  if (maKhoa != "tatcakhoa") {
    $("#select_Lop").find("option").remove();
    //Load khoa
    $.ajax({
      url: urlapi_lop_read_maKhoa + maKhoa,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: false,
      headers: { Authorization: jwtCookie },
      success: function (result_Lop) {
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

        tableContent = [];
        var htmlData = "";
        $("#id_tbody_DanhSachThamGiaHoatDong").html(htmlData);
        $("#idPhanTrang").empty();
      },
    });
  } else {
    //LoadComboBoxThongTinKhoa();
    $("#select_Lop").find("option").remove();
  }
}

function LoadComboBoxThongTinHocKyDanhGia() {
  //Load HocKyDanhGia
  $.ajax({
    url: urlapi_hockydanhgia_read,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result) {
      $("#select_HocKyDanhGia").find("option").remove();

      $.each(result, function (index) {
        for (var p = 0; p < result[index].length; p++) {
          $("#select_HocKyDanhGia").append(
            "<option value='" +
              result[index][p].maHocKyDanhGia +
              "'>" +
              "Học kỳ: " +
              result[index][p].hocKyXet +
              " - Năm học: " +
              result[index][p].namHocXet +
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
        text: errorMessage.responseJSON.message,
        timerProgressBar: true,
      });
    },
  });
}

function checkValidateInput() {
  var _inputTBCHocKyTruoc = $("#inputTBCHocKyTruoc").val();
  var _inputTBCHocKyDangXet = $("#inputTBCHocKyDangXet").val();
  var _input_diemtongcong = $("#CVHT_input_diemtongcong").val();

  if (_input_diemtongcong == "") {
    thongBaoLoi("Vui lòng nhập điểm TỔNG CỘNG cuối cùng.");
    return false;
  }

  if (_input_diemtongcong > 100) {
    thongBaoLoi("Điểm tổng cộng không quá 100! Mời nhập lại!");
    return false;
  }

  if (_inputTBCHocKyTruoc != null) {
    if (isNaN(parseFloat(_inputTBCHocKyTruoc))) {
      thongBaoLoi("Điểm trung bình chung phải là số! Mời nhập lại!");
      return false;
    } else {
      if (parseFloat(_inputTBCHocKyTruoc) > 4) {
        thongBaoLoi("Điểm trung bình chung phải nhỏ hơn 4 (hệ 4)!");
        return false;
      }
    }
  }

  if (_inputTBCHocKyDangXet != null) {
    if (isNaN(parseFloat(_inputTBCHocKyDangXet))) {
      thongBaoLoi("Điểm trung bình chung phải là số! Mời nhập lại!");
      return false;
    } else {
      if (parseFloat(_inputTBCHocKyTruoc) > 4) {
        thongBaoLoi("Điểm trung bình chung phải nhỏ hơn 4 (hệ 4)!");
        return false;
      }
    }
  }

  return true;
}

//------------------------------------------------//
//Show tiêu chí đánh giá
// function getTieuChiDanhGia() {
//   //Ajax tieuchicap1
//   $.ajax({
//     url: urlapi_tieuchicap1_read,
//     async: false,
//     type: "GET",
//     contentType: "application/json;charset=utf-8",
//     dataType: "json",
//     headers: {
//       Authorization: jwtCookie,
//     },
//     success: function (result) {
//       $.each(result, function (index) {
//         for (var i = 0; i < result[index].length; i++) {
//           //console.log(result[index][i].noidung);

//           $("#tbody_noiDungDanhGia").append(
//             "<tr>\
//                 <td style='font-weight: bold;'>" +
//               result[index][i].noidung +
//               "</td>\
//                 <td></td>\
//                 <td></td>\
//                 <td></td>\
//                 <td></td>\
//                 <td></td>\
//                 <td></td>\
//                 </tr>"
//           );

//           //Ajax tieuchicap2
//           $.ajax({
//             url: urlapi_tieuchicap2_read,
//             async: false,
//             type: "GET",
//             contentType: "application/json;charset=utf-8",
//             dataType: "json",
//             headers: {
//               Authorization: jwtCookie,
//             },
//             success: function (result_tc2) {
//               $.each(result_tc2, function (index_tc2) {
//                 for (var k = 0; k < result_tc2[index_tc2].length; k++) {
//                   if (
//                     result[index][i].matc1 === result_tc2[index_tc2][k].matc1
//                   ) {
//                     if (result_tc2[index_tc2][k].diemtoida != 0) {
//                       var min_value_tc2 = 0;
//                       //get min value
//                       if (result_tc2[index_tc2][k].diemtoida > 0) {
//                         min_value_tc2 = 0;
//                       } else {
//                         min_value_tc2 = result_tc2[index_tc2][k].diemtoida;
//                       }

//                       $("#tbody_noiDungDanhGia").append(
//                         "<tr>\
//                           <td><em>" +
//                           result_tc2[index_tc2][k].noidung +
//                           "</em></td>\
//                           <td><em>" +
//                           result_tc2[index_tc2][k].diemtoida +
//                           "đ</em></td>\
//                           <td>\
//                             <input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
//                           result_tc2[index_tc2][k].diemtoida +
//                           ")' max_value='" +
//                           result_tc2[index_tc2][k].diemtoida +
//                           "'    \
//                             min='" +
//                           min_value_tc2 +
//                           "' id='TC2_" +
//                           result_tc2[index_tc2][k].matc2 +
//                           "' disabled/> \
//                           </td>\
//                           <td>\
//                             <input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
//                           result_tc2[index_tc2][k].diemtoida +
//                           ")' max_value='" +
//                           result_tc2[index_tc2][k].diemtoida +
//                           "'    \
//                             min='" +
//                           min_value_tc2 +
//                           "' id='CVHT_TC2_" +
//                           result_tc2[index_tc2][k].matc2 +
//                           "' disabled/> \
//                           </td>\
//                           <td>\
//                           <input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
//                           result_tc2[index_tc2][k].diemtoida +
//                           ")' max_value='" +
//                           result_tc2[index_tc2][k].diemtoida +
//                           "'    \
//                             min='" +
//                           min_value_tc2 +
//                           "' id='Khoa_TC2_" +
//                           result_tc2[index_tc2][k].matc2 +
//                           "' /> \
//                           </td>\
//                           <td>\
//                             <button type='button' class='btn btn-light btn_XemDanhSachHoatDong' style='color: black;width: max-content;' data-bs-toggle='modal' data-bs-target='#XemDanhSachHoatDongModal' data-tieuchi-id='TC2_" +
//                           result_tc2[index_tc2][k].matc2 +
//                           "' data-tentieuchi='" +
//                           result_tc2[index_tc2][k].noidung +
//                           "' >Danh sách</button>\
//                           </td>\
//                           <td>\
//                           <div class='box'>\
//                           <a href='#' id='show_file_minhchung_TC2_" +
//                           result_tc2[index_tc2][k].matc2 +
//                           "' target='_blank' style='display:none' ></a>\
//                           <button type='button' class='btn btn-light btn_AnhMinhChung' data-bs-toggle='modal' data-bs-target='#AnhMinhChungModal' data-img-id='img_file_minhchung_TC2_" +
//                           result_tc2[index_tc2][k].matc2 +
//                           "' ><img src='#' id='img_file_minhchung_TC2_" +
//                           result_tc2[index_tc2][k].matc2 +
//                           "' width='100px' /></button>\
//                           <form id='formDanhGiaDRL_TC2_" +
//                           result_tc2[index_tc2][k].matc2 +
//                           "' method='post' enctype='multipart/form-data'>\
//                           </form>\
//                         </div>\
//                           </td>\
//                         </tr>"
//                       );

//                       // <td><input type='text' style='width: 100px;'  id='ghiChuTC2_" + result_tc2[index_tc2][k].matc2 +"' /></td>\
//                     } else {
//                       if (
//                         result_tc2[index_tc2][k].noidung ==
//                         "1.Kết quả học tập: "
//                       ) {
//                         $("#tbody_noiDungDanhGia").append(
//                           "<tr>\
//                                             <td><em>" +
//                             result_tc2[index_tc2][k].noidung +
//                             "<br>Điểm TBC học kỳ trước: <input type='number' step='0.01' onchange='changeNumberHandle(this,4)' id='inputTBCHocKyTruoc' name='diemTrungBinhChungHKTruoc' style='width: 100px;margin-right: 30px;margin-bottom: 15px;' /><br>Điểm TBC học kỳ đang xét: <input type='number' step='0.01' onchange='changeNumberHandle(this,4)' id='inputTBCHocKyDangXet' name='diemTrungBinhChungHKXet' style='width: 100px;' /> </em></td>\
//                                             <td></td>\
//                                             <td></td>\
//                                             <td></td>\
//                                             <td></td>\
//                                             <td></td>\
//                                             <td><a href='#' id='show_file_minhchung_TC2_" +
//                             result_tc2[index_tc2][k].matc2 +
//                             "' target='_blank' ></a>\
//                                             <form id='formDanhGiaDRL_TC2_" +
//                             result_tc2[index_tc2][k].matc2 +
//                             "' method='post' enctype='multipart/form-data'></form></td>\
//                                             </tr>"
//                         );
//                       } else {
//                         $("#tbody_noiDungDanhGia").append(
//                           "<tr>\
//                                             <td><em>" +
//                             result_tc2[index_tc2][k].noidung +
//                             "</em></td>\
//                                             <td></td>\
//                                             <td></td>\
//                                             <td></td>\
//                                             <td></td>\
//                                             <td></td>\
//                                             <td> <a href='#' id='show_file_minhchung_TC2_" +
//                             result_tc2[index_tc2][k].matc2 +
//                             "' target='_blank' ></a>\
//                                             <form id='formDanhGiaDRL_TC2_" +
//                             result_tc2[index_tc2][k].matc2 +
//                             "' method='post' enctype='multipart/form-data'></form></td>\
//                                             </tr>"
//                         );
//                       }
//                     }

//                     //Ajax tieuchicap3
//                     $.ajax({
//                       url: urlapi_tieuchicap3_read,
//                       async: false,
//                       type: "GET",
//                       contentType: "application/json;charset=utf-8",
//                       dataType: "json",
//                       headers: {
//                         Authorization: jwtCookie,
//                       },
//                       success: function (result_tc3) {
//                         $.each(result_tc3, function (index_tc3) {
//                           for (
//                             var p = 0;
//                             p < result_tc3[index_tc3].length;
//                             p++
//                           ) {
//                             if (
//                               result_tc2[index_tc2][k].matc2 ===
//                               result_tc3[index_tc3][p].matc2
//                             ) {
//                               // console.log(result_tc3[index_tc3][p].noidung);

//                               var min_value = 0;
//                               var disabled_string = "";
//                               //get min value
//                               if (result_tc3[index_tc3][p].diem > 0) {
//                                 min_value = 0;
//                               } else {
//                                 min_value = result_tc3[index_tc3][p].diem;
//                               }

//                               if (
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "a. Điểm trung bình chung học kì từ  3,60 đến 4,00"
//                                 ) == 0 ||
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "b. Điểm trung bình chung học kì từ  3,20 đến 3,59"
//                                 ) == 0 ||
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "c. Điểm trung bình chung học kì từ  2,50 đến 3,19"
//                                 ) == 0 ||
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "d. Điểm trung bình chung học kì từ  2,00 đến 2,49"
//                                 ) == 0 ||
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "đ. Điểm trung bình chung học kì  dưới 2,00"
//                                 ) == 0 ||
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "a. Kết quả học tập tăng một bậc so với học kỳ trước,  ĐTBCHK từ  2,00 trở lên"
//                                 ) == 0 ||
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "b. Kết quả học tập tăng hai bậc so với học kỳ trước,  ĐTBCHK từ  2,00 trở lên"
//                                 ) == 0
//                               ) {
//                                 disabled_string = "readonly";
//                               }

//                               if (
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "a. Điểm trung bình chung học kì từ  3,60 đến 4,00"
//                                 ) == 0 ||
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "b. Điểm trung bình chung học kì từ  3,20 đến 3,59"
//                                 ) == 0 ||
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "c. Điểm trung bình chung học kì từ  2,50 đến 3,19"
//                                 ) == 0 ||
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "d. Điểm trung bình chung học kì từ  2,00 đến 2,49"
//                                 ) == 0 ||
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "đ. Điểm trung bình chung học kì  dưới 2,00"
//                                 ) == 0 ||
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "a. Kết quả học tập tăng một bậc so với học kỳ trước,  ĐTBCHK từ  2,00 trở lên"
//                                 ) == 0 ||
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "b. Kết quả học tập tăng hai bậc so với học kỳ trước,  ĐTBCHK từ  2,00 trở lên"
//                                 ) == 0 ||
//                                 result_tc3[index_tc3][p].noidung.localeCompare(
//                                   "c. Sinh viên năm thứ I, nếu có kết quả học tập HK I từ 2,00 trở lên"
//                                 ) == 0
//                               ) {
//                                 $("#tbody_noiDungDanhGia").append(
//                                   "<tr>\
//                                                   <td>" +
//                                     result_tc3[index_tc3][p].noidung +
//                                     "</span></td>\
//                                                   <td><em>" +
//                                     result_tc3[index_tc3][p].diem +
//                                     "đ</em></td>\
//                                                   <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
//                                     result_tc3[index_tc3][p].diem +
//                                     ")' max_value='" +
//                                     result_tc3[index_tc3][p].diem +
//                                     "'  id='TC3_" +
//                                     result_tc3[index_tc3][p].matc3 +
//                                     "' " +
//                                     disabled_string +
//                                     " disabled/></td>\
//                                     <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
//                                     result_tc3[index_tc3][p].diem +
//                                     ")' max_value='" +
//                                     result_tc3[index_tc3][p].diem +
//                                     "'  id='CVHT_TC3_" +
//                                     result_tc3[index_tc3][p].matc3 +
//                                     "' " +
//                                     disabled_string +
//                                     " disabled/></td>\
//                                     <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
//                                     result_tc3[index_tc3][p].diem +
//                                     ")' max_value='" +
//                                     result_tc3[index_tc3][p].diem +
//                                     "'  id='Khoa_TC3_" +
//                                     result_tc3[index_tc3][p].matc3 +
//                                     "' " +
//                                     disabled_string +
//                                     " disabled/></td>\
//                                     <td></td>\
//                                     <td> <a href='#' id='show_file_minhchung_TC3_" +
//                                     result_tc3[index_tc3][p].matc3 +
//                                     "' target='_blank' style='display:none' ></a>\
//                                     <form id='formDanhGiaDRL_TC3_" +
//                                     result_tc3[index_tc3][p].matc3 +
//                                     "' method='post' enctype='multipart/form-data'></form></td>\
//                                                   </tr>"
//                                 );
//                               } else {
//                                 $("#tbody_noiDungDanhGia").append(
//                                   "<tr>\
//                                                   <td>" +
//                                     result_tc3[index_tc3][p].noidung +
//                                     "</span></td>\
//                                                   <td><em>" +
//                                     result_tc3[index_tc3][p].diem +
//                                     "đ</em></td>\
//                                                   <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
//                                     result_tc3[index_tc3][p].diem +
//                                     ")' max_value='" +
//                                     result_tc3[index_tc3][p].diem +
//                                     "'  id='TC3_" +
//                                     result_tc3[index_tc3][p].matc3 +
//                                     "' " +
//                                     disabled_string +
//                                     "  disabled /></td>\
//                                     <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
//                                     result_tc3[index_tc3][p].diem +
//                                     ")' max_value='" +
//                                     result_tc3[index_tc3][p].diem +
//                                     "'  id='CVHT_TC3_" +
//                                     result_tc3[index_tc3][p].matc3 +
//                                     "' " +
//                                     disabled_string +
//                                     " disabled/></td>\
//                                     <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
//                                     result_tc3[index_tc3][p].diem +
//                                     ")' max_value='" +
//                                     result_tc3[index_tc3][p].diem +
//                                     "'  id='Khoa_TC3_" +
//                                     result_tc3[index_tc3][p].matc3 +
//                                     "' " +
//                                     disabled_string +
//                                     " /></td>\
//                                     <td>\
//                                       <button type='button' class='btn btn-light btn_XemDanhSachHoatDong' style='color: black;width: max-content;' data-bs-toggle='modal' data-bs-target='#XemDanhSachHoatDongModal' data-tieuchi-id='TC3_" +
//                                     result_tc3[index_tc3][p].matc3 +
//                                     "' data-tentieuchi='" +
//                                     result_tc3[index_tc3][p].noidung +
//                                     "' >Danh sách</button>\
//                                     </td>\
//                                     <td>\
//                                     <div class='box'>\
//                                         <a href='#' id='show_file_minhchung_TC3_" +
//                                     result_tc3[index_tc3][p].matc3 +
//                                     "' target='_blank' style='display: none' ></a>\
//                                         <button type='button' class='btn btn-light btn_AnhMinhChung' data-bs-toggle='modal' data-bs-target='#AnhMinhChungModal' data-img-id='img_file_minhchung_TC3_" +
//                                     result_tc3[index_tc3][p].matc3 +
//                                     "' ><img src='#' id='img_file_minhchung_TC3_" +
//                                     result_tc3[index_tc3][p].matc3 +
//                                     "' width='100px' /></button>\
//                                         <form id='formDanhGiaDRL_TC3_" +
//                                     result_tc3[index_tc3][p].matc3 +
//                                     "' method='post' enctype='multipart/form-data'>\
//                                       </form>\
//                                       </div>\
//                                   </td>\
//                                       </tr>"
//                                 );
//                               }
//                             }

//                             // <td><input type='text' style='width: 100px;'  id='ghiChuTC3_" + result_tc3[index_tc3][p].matc3 + "' /></td>\
//                           }
//                         });
//                       },
//                       error: function (errorMessage_tc3) {
//                         thongBaoLoi(errorMessage_tc3.responseText);
//                       },
//                     });
//                   }
//                 }
//               });
//             },
//             error: function (errorMessage_tc2) {
//               thongBaoLoi(errorMessage_tc2.responseText);
//             },
//           });

//           $("#tbody_noiDungDanhGia").append(
//             "<tr style='background: darkseagreen;' >\
//                 <td style='font-weight: bold;' >Cộng: </span>\
//                 </td>\
//                 <td><em></em></td>\
//                 <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this," +
//               result[index][i].diemtoida +
//               ")' max-value='" +
//               result[index][i].diemtoida +
//               "' min='0' max='" +
//               result[index][i].diemtoida +
//               "' id='TongCong_TC1_" +
//               result[index][i].matc1 +
//               "' disabled/></td>\
//               <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this," +
//               result[index][i].diemtoida +
//               ")' max-value='" +
//               result[index][i].diemtoida +
//               "' min='0' max='" +
//               result[index][i].diemtoida +
//               "' id='CVHT_TongCong_TC1_" +
//               result[index][i].matc1 +
//               "' disabled/></td>\
//               <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this," +
//               result[index][i].diemtoida +
//               ")' max-value='" +
//               result[index][i].diemtoida +
//               "' min='0' max='" +
//               result[index][i].diemtoida +
//               "' id='Khoa_TongCong_TC1_" +
//               result[index][i].matc1 +
//               "' disabled/></td>\
//               <td></td>\
//               <td></td>\
//                 </tr>"
//           );
//         }
//       });
//     },
//     error: function (errorMessage) {
//       thongBaoLoi(errorMessage.responseText);
//     },
//   });

//   $("#tbody_noiDungDanhGia").append(
//     "<tr>\
//             <td style='font-weight: bold;' >ĐIỂM TỔNG CỘNG (tối đa không quá 100 điểm): </span>\
//             </td>\
//             <td><em></em></td>\
//             <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this, 100)' id='input_diemtongcong' readonly='true' /></td>\
//             <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this, 100)' id='CVHT_input_diemtongcong'  readonly='true' /></td>\
//             <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this, 100)' id='Khoa_input_diemtongcong' name='diemTongCong' readonly='true' /></td>\
//             <td></td>\
//             <td></td>\
//             </tr>"
//   );

//   $("#tbody_noiDungDanhGia").append(
//     "<tr>\
//           <td style='font-weight: bold;text-transform: uppercase;font-size: 18px;'  >ĐIỂM: <span id='text_diemTongCong' ></span></td>\
//           <td></td>\
//           <td style='font-weight: bold;text-transform: uppercase;' colspan='2' >Xếp loại: <span id='text_XepLoai' ></span></td>\
//           <td></td>\
//           <td style='font-weight: bold;'  ><span></span></td>\
//       </tr>"
//   );
// }

//Load thông tin sinh viên đã đánh giá
function LoadThongTinSinhVienDanhGia(GET_MaSinhVien, GET_MaHocKy) {
  var maPhieuRenLuyen = "PRL" + GET_MaHocKy + GET_MaSinhVien;

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
      var xepLoai = result_PRL.xepLoai;
      var diemTongCong = result_PRL.diemTongCong;
      var diemTrungBinhChungHKTruoc = result_PRL.diemTrungBinhChungHKTruoc;
      var diemTrungBinhChungHKXet = result_PRL.diemTrungBinhChungHKXet;
      var coVanDuyet = result_PRL.coVanDuyet;
      var khoaDuyet = result_PRL.khoaDuyet;

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
          $("#inputTBCHocKyTruoc").val(diemTrungBinhChungHKTruoc);
          $("#inputTBCHocKyDangXet").val(diemTrungBinhChungHKXet);

          $("#text_XepLoai").text(xepLoai);
          $("#text_diemTongCong").text(diemTongCong);

          $.each(result_CD, function (index_cd) {
            for (var p = 0; p < result_CD[index_cd].length; p++) {
              var maTieuChi2 = result_CD[index_cd][p].maTieuChi2;
              var maTieuChi3 = result_CD[index_cd][p].maTieuChi3;
              var diemSinhVienDanhGia =
                result_CD[index_cd][p].diemSinhVienDanhGia;
              var diemLopDanhGia = result_CD[index_cd][p].diemLopDanhGia;
              var diemKhoaDanhGia = result_CD[index_cd][p].diemKhoaDanhGia;

              var fileMinhChung = result_CD[index_cd][p].fileMinhChung;
              var fileMinhChung_Name = fileMinhChung.substring(
                fileMinhChung.lastIndexOf("/") + 1
              );

              $("#tbody_noiDungDanhGia")
                .find("input")
                .each(function () {
                  var tieuChi = this.id.slice(0, 3);
                  var maTieuChi = this.id.slice(4, 9);

                  if (tieuChi == "TC2") {
                    if (maTieuChi2 == maTieuChi) {
                      $("#" + this.id).val(diemSinhVienDanhGia);

                      $("#show_file_minhchung_" + this.id).text(
                        fileMinhChung_Name
                      );
                      $("#show_file_minhchung_" + this.id).attr(
                        "href",
                        fileMinhChung
                      );

                      $("#img_file_minhchung_" + this.id).attr(
                        "src",
                        fileMinhChung
                      );

                      $("#CVHT_" + this.id).val(diemLopDanhGia);

                      // if (diemLopDanhGia != 0){
                      //   $("#Khoa_" + this.id).val(diemLopDanhGia);
                      // }else{
                      //   $("#Khoa_" + this.id).val(diemKhoaDanhGia);
                      // }

                      if (khoaDuyet == 0) {
                        $("#Khoa_" + this.id).val(diemLopDanhGia);
                      } else {
                        $("#Khoa_" + this.id).val(diemKhoaDanhGia);
                      }
                    }
                  }

                  if (tieuChi == "TC3") {
                    if (maTieuChi3 == maTieuChi) {
                      $("#" + this.id).val(diemSinhVienDanhGia);

                      $("#show_file_minhchung_" + this.id).text(
                        fileMinhChung_Name
                      );
                      $("#show_file_minhchung_" + this.id).attr(
                        "href",
                        fileMinhChung
                      );

                      $("#img_file_minhchung_" + this.id).attr(
                        "src",
                        fileMinhChung
                      );

                      $("#CVHT_" + this.id).val(diemLopDanhGia);

                      // if (diemLopDanhGia != 0){
                      //   $("#Khoa_" + this.id).val(diemLopDanhGia);
                      // }else{
                      //   $("#Khoa_" + this.id).val(diemKhoaDanhGia);
                      // }

                      if (khoaDuyet == 0) {
                        $("#Khoa_" + this.id).val(diemLopDanhGia);
                      } else {
                        $("#Khoa_" + this.id).val(diemKhoaDanhGia);
                      }
                    }
                  }
                });
            }
          });
        },
        error: function (errorMessage_tc3) {
          thongBaoLoi(errorMessage_tc3.responseText);
        },
      });
    },
    error: function (errorMessage_tc3) {
      thongBaoLoi(errorMessage_tc3.responseText);
    },
  });
}

//hàm dùng khi onclick modal
function LoadDanhSachHoatDongDaThamGia(maHocKyDanhGia, maTieuChi) {
  var tieuChi_sliced_truoc = maTieuChi.slice(0, 3);
  var tieuChi_sliced_value = maTieuChi.slice(4, maTieuChi.length);
  var maSinhVien = $("#text_maSV").text();

  $("#id_tbody_DanhSachThamGiaHoatDong tr").remove();
  $.ajax({
    url: urlapi_thamgiahoatdong_read_MaSV + maSinhVien,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result_CD) {
      $.each(result_CD, function (index_cd) {
        for (var p = 0; p < result_CD[index_cd].length; p++) {
          var thamgiahd_maHoatDong = result_CD[index_cd][p].maHoatDong;

          $.ajax({
            url: urlapi_hoatdongdanhgia_single_read + thamgiahd_maHoatDong,
            async: false,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            headers: {
              Authorization: jwtCookie,
            },
            success: function (result_hoatdongdanhgia) {
              if (result_hoatdongdanhgia.maHocKyDanhGia == maHocKyDanhGia) {
                if (tieuChi_sliced_truoc == "TC2") {
                  if (
                    tieuChi_sliced_value == result_hoatdongdanhgia.maTieuChi2
                  ) {
                    $("#id_tbody_DanhSachThamGiaHoatDong").append(
                      "<tr>\
                        <td>" +
                        thamgiahd_maHoatDong +
                        "</td>\
                        <td>" +
                        result_hoatdongdanhgia.tenHoatDong +
                        "</td>\
                        <td>" +
                        result_hoatdongdanhgia.diemNhanDuoc +
                        "</td>\
                      </tr>"
                    );
                  }
                }

                if (tieuChi_sliced_truoc == "TC3") {
                  if (
                    tieuChi_sliced_value == result_hoatdongdanhgia.maTieuChi3
                  ) {
                    $("#id_tbody_DanhSachThamGiaHoatDong").append(
                      "<tr>\
                      <td>" +
                        thamgiahd_maHoatDong +
                        "</td>\
                      <td>" +
                        result_hoatdongdanhgia.tenHoatDong +
                        "</td>\
                      <td>" +
                        result_hoatdongdanhgia.diemNhanDuoc +
                        "</td>\
                    </tr>"
                    );
                  }
                }
              }
            },
            error: function (errorMessage_tc3) {
              thongBaoLoi(errorMessage_tc3.responseText);
            },
          });
        }
      });
    },
    error: function (errorMessage_tc3) {
      $("#id_tbody_DanhSachThamGiaHoatDong").append(
        "<tr>\
      <td colspan='4' style='text-align:center'>Không tìm thấy kết quả.</td>\
      </tr>"
      );

      //thongBaoLoi(errorMessage_tc3.responseText);
    },
  });
}
