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

function sortObject(object, prop, asc) {
  object.sort(function (a, b) {
    if (asc) {
      return a[prop] > b[prop] ? 1 : a[prop] < b[prop] ? -1 : 0;
    } else {
      return b[prop] > a[prop] ? 1 : b[prop] < a[prop] ? -1 : 0;
    }
  });

  return object;
}

//phieurenluyen//
function GetListPhieurenluyen(maLop, maHocKyDanhGia) {
  $("#id_tbodyPhieuRenLuyen tr").remove();
  var htmlData = "";

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
        sortObject(result["phieurenluyen"], "coVanDuyet", false);
        sortObject(result["phieurenluyen"], "khoaDuyet", true);

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
                (isAllowedToScore(thongBaoDanhGia, getCookie("quyen"), [
                  "khoa",
                ]) && data[i].coVanDuyet == 1
                  ? "Xem chi tiết và duyệt"
                  : "Xem chi tiết") +
                "</button>\
                <button type='button' data-bs-toggle='modal' data-bs-target='#ModalExportPRL' class='btn btn_XuatPRL' style='color: white;background: #c04f4f;margin: 5px;' data-id='" +
                data[i].maPhieuRenLuyen +
                "' ><img src='assets/images/icons/pdf.png' width='17px' /><span style='margin-left: 5px;'>Xuất phiếu</span></button>\
                  </td>\
                </tr>";
            }

            $("#id_tbodyPhieuRenLuyen").html(htmlData);
          },
        });
      },
      error: function (errorMessage) {
        checkLoiDangNhap(errorMessage.responseJSON.message);
        htmlData +=
          "<tr>\
                        <td colspan='9' class='text-center'>\
                            <p class='mt-4'>Không tìm thấy kết quả.</p>\
                        </td>\
                    </tr>";
        $("#id_tbodyPhieuRenLuyen").append(htmlData);
        //thongBaoLoi(errorMessage.responseJSON.message);
      },
    });
  } else {
    htmlData +=
      "<tr>\
                    <td colspan='9' class='text-center'>\
                        <p class='mt-4'>Không tìm thấy kết quả.</p>\
                    </td>\
                </tr>";
    $("#id_tbodyPhieuRenLuyen").append(htmlData);
    //thongBaoLoi("Không tìm thấy kết quả");
  }
}

function TimKiemPhieuRenLuyen(maSinhVien) {
  $("#id_tbodyPhieuRenLuyen tr").remove();
  var htmlData = "";

  var paramMaKhoa = "";

  if (getCookie("quyen") == "khoa") {
    $.ajax({
      url: urlapi_khoa_single_read_taiKhoanKhoa + getCookie("taiKhoan"),
      async: false,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      headers: {
        Authorization: jwtCookie,
      },
      success: function (result_Khoa) {
        paramMaKhoa += "&maKhoa_quyen=" + result_Khoa["maKhoa"];
      },
      error: function (errorMessage) {},
    });
  }

  $.ajax({
    url: urlapi_phieurenluyen_read_MaSV + maSinhVien + paramMaKhoa,
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
              (isAllowedToScore(thongBaoDanhGia, getCookie("quyen"), [
                "khoa",
              ]) && data[i].coVanDuyet == 1
                ? "Xem chi tiết và duyệt"
                : "Xem chi tiết") +
              "</button>\
              <button type='button' data-bs-toggle='modal' data-bs-target='#ModalExportPRL' class='btn btn_XuatPRL' style='color: white;background: #c04f4f;margin: 5px;' data-id='" +
              data[i].maPhieuRenLuyen +
              "' ><img src='assets/images/icons/pdf.png' width='17px' /><span style='margin-left: 5px;'>Xuất phiếu</span></button>\
                </td>\
              </tr>";
          }

          $("#id_tbodyPhieuRenLuyen").html(htmlData);
        },
      });
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      htmlData +=
        "<tr>\
                      <td colspan='9' class='text-center'>\
                          <p class='mt-4'>Không tìm thấy kết quả.</p>\
                      </td>\
                  </tr>";
      $("#id_tbodyPhieuRenLuyen").append(htmlData);

      //thongBaoLoi(errorMessage.responseJSON.message);
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
          if (getCookie("quyen") == "superadmin" || getCookie("quyen") == "admin" || getCookie("quyen") == "ctsv") {
            $("#select_Khoa").append(
              "<option value='" +
                result_Khoa[index_Khoa][p].maKhoa +
                "'>" +
                result_Khoa[index_Khoa][p].tenKhoa +
                "</option>"
            );
          } else if (getCookie("quyen") == "khoa") {
            if (
              result_Khoa[index_Khoa][p].taiKhoanKhoa == getCookie("taiKhoan")
            ) {
              $("#select_Khoa").append(
                "<option value='" +
                  result_Khoa[index_Khoa][p].maKhoa +
                  "'>" +
                  result_Khoa[index_Khoa][p].tenKhoa +
                  "</option>"
              );
            }
          }
        }
      });
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      var htmlData =
        "<tr>\
                        <td colspan='9' class='text-center'>\
                            <p class='mt-4'>Không tìm thấy kết quả.</p>\
                        </td>\
                    </tr>";
      $("#id_tbodyPhieuRenLuyen").append(htmlData);

      // Swal.fire({
      //   icon: "error",
      //   title: "Lỗi",
      //   text: errorMessage.responseText,
      //   //timer: 5000,
      //   timerProgressBar: true,
      // });
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
