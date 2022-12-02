var tableKhieuNaiTitle = [
  "STT",
  "Mã khiếu nại",
  "Mã phiếu rèn luyện",
  "Mã sinh viên",
  "Họ tên sinh viên",
  "Mã lớp",
  "Trạng thái",
  "Thời gian khiếu nại",
];

var tableKhieuNaiContent = [];

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

function LoadComboBoxThongTinKhoa_KhieuNai() {
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
          if (getCookie("quyen") == "admin" || getCookie("quyen") == "ctsv") {
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

function LoadComboBoxThongTinKhoaHoc_KhieuNai() {
  //Load khoa
  $.ajax({
    url: urlapi_khoahoc_read,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_KhoaHoc) {
      $("#select_KhoaHoc").find("option").remove();

      $.each(result_KhoaHoc, function (index_KhoaHoc) {
        for (var p = 0; p < result_KhoaHoc[index_KhoaHoc].length; p++) {
          $("#select_KhoaHoc").append(
            "<option value='" +
              result_KhoaHoc[index_KhoaHoc][p].maKhoaHoc +
              "'>" +
              "Khóa " +
              result_KhoaHoc[index_KhoaHoc][p].maKhoaHoc.substring(1) +
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
        //timer: 5000,
        timerProgressBar: true,
      });
    },
  });
}

function LoadComboBoxThongTinHocKyDanhGia_KhieuNai() {
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
        //timer: 5000,
        timerProgressBar: true,
      });
    },
  });
}

function toDateTimeString(strDate) {
  var date = new Date(strDate);

  return (
    date.getDate() +
    "-" +
    (date.getMonth() + 1) +
    "-" +
    date.getFullYear() +
    " " +
    date.getHours() +
    ":" +
    date.getMinutes() +
    ":" +
    date.getSeconds() +
    (date.getHours() >= 12 ? " CH" : " SA")
  );
}

function timeSinceBadge(strDate) {
  var bits = strDate.split(/\D/);
  var date = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4], bits[5]);

  var seconds = Math.floor((new Date() - date) / 1000);

  var interval = seconds / 31536000;

  if (interval > 1) {
    return (
      "<span class='badge bg-danger' style='color: white;font-size: inherit;'>" +
      Math.floor(interval) +
      " năm trước</span>"
    );
  }
  interval = seconds / 2592000;
  if (interval > 1) {
    return (
      "<span class='badge bg-danger' style='color: white;font-size: inherit;'>" +
      Math.floor(interval) +
      " tháng trước</span>"
    );
  }
  interval = seconds / 86400;
  if (interval > 1) {
    return (
      "<span class='badge bg-warning' style='color: white;font-size: inherit;'>" +
      Math.floor(interval) +
      " ngày trước</span>"
    );
  }
  interval = seconds / 3600;
  if (interval > 1) {
    return (
      "<span class='badge bg-dark' style='color: white;font-size: inherit;'>" +
      Math.floor(interval) +
      " tiếng trước</span>"
    );
  }
  interval = seconds / 60;
  if (interval > 1) {
    return (
      "<span class='badge bg-secondary' style='color: white;font-size: inherit;'>" +
      Math.floor(interval) +
      " phút trước</span>"
    );
  }
  return (
    "<span class='badge bg-secondary' style='color: white;font-size: inherit;'>" +
    Math.floor(seconds) +
    " giây trước</span>"
  );
}

function GetListKhieuNai(maKhoa, maKhoaHoc, maHocKyDanhGia) {
  var htmlData = "";
  $("#tbodyKhieuNai tr").remove();

  $.ajax({
    url:
      urlapi_khieunai_read +
      `?maKhoa=${maKhoa}&maKhoaHoc=${maKhoaHoc}&maHocKyDanhGia=${maHocKyDanhGia}`,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: true,
    headers: { Authorization: jwtCookie },
    success: function (result) {
      tableKhieuNaiContent = result["khieunai"];

      $("#idPhanTrangKhieuNai").pagination({
        dataSource: result["khieunai"],
        pageSize: 10,
        autoHidePrevious: true,
        autoHideNext: true,
        callback: function (data, pagination) {
          
          var count = 0;

          for (let i = 0; i < data.length; i++) {
            count += 1;

            htmlData +=
              "<tr>\
                                <td class='cell'>" +
              data[i].soThuTu +
              "</td>\
                                <td class='cell'><span class='truncate'>" +
              data[i].maKhieuNai +
              "</span></td>\
                                <td class='cell'>" +
              data[i].maPhieuRenLuyen +
              "</td>\
                                <td class='cell'>" +
              data[i].maSinhVien +
              "</td>\
                                <td class='cell'>" +
              data[i].hoTenSinhVien +
              "</td>\
                                <td class='cell'>" +
              data[i].maLop +
              "</td>\
                                <td class='cell'>" +
              (data[i].trangThai == 1
                ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Chấp thuận</span>"
                : data[i].trangThai == -1
                ? "<span class='badge bg-danger' style='color: white;font-size: inherit;'>Từ chối</span>"
                : "<span class='badge bg-info' style='color: white;font-size: inherit;'>Đang chờ duyệt</span>") +
              "</td>\
                                <td class='cell'>" +
              (data[i].trangThai == 0
                ? timeSinceBadge(data[i].thoiGianKhieuNai)
                : toDateTimeString(data[i].thoiGianKhieuNai)) +
              "</td>\
                                <td class='cell'>\
                                  <button class='btn btn-secondary btn_XemChiTiet' style='color: white;' data-bs-toggle='modal' data-bs-target='#XemChiTietModal' data-id = '" +
              data[i].maKhieuNai +
              "' >Xem chi tiết</button>\
                                  <button class='btn btn-info btn_PheDuyet' style='color: white;' data-bs-toggle='modal' data-bs-target='#PheDuyetModal' data-id = '" +
              data[i].maKhieuNai +
              "' >Phê duyệt</button>\
              </td>\
                                </tr>";
          }

          $("#tbodyKhieuNai").html(htmlData);
        },
      });
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      tableKhieuNaiContent = [];

      $("#idPhanTrangKhieuNai").empty();

      htmlData += "<tr>\
                      <td colspan='9' class='text-center'>\
                          <p class='mt-4'>Không tìm thấy kết quả.</p>\
                      </td>\
                  </tr>"
      $("#tbodyKhieuNai").append(htmlData);

      //ThongBaoLoi(errorMessage.responseJSON.message);
    },
  });

  $("#select_TrangThai").val("all");
}

function TimKiemKhieuNai(maSinhVien) {
  var htmlData = "";
  $("#tbodyKhieuNai tr").remove();

  $.ajax({
    url: urlapi_khieunai_read_maSinhVien + maSinhVien,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: true,
    headers: { Authorization: jwtCookie },
    success: function (result) {
      tableKhieuNaiContent = result["khieunai"];

      $("#idPhanTrangKhieuNai").pagination({
        dataSource: result["khieunai"],
        pageSize: 10,
        autoHidePrevious: true,
        autoHideNext: true,
        callback: function (data, pagination) {
          
          var count = 0;

          for (let i = 0; i < data.length; i++) {
            count += 1;

            htmlData +=
              "<tr>\
                                <td class='cell'>" +
              data[i].soThuTu +
              "</td>\
                                <td class='cell'><span class='truncate'>" +
              data[i].maKhieuNai +
              "</span></td>\
                                <td class='cell'>" +
              data[i].maPhieuRenLuyen +
              "</td>\
                                <td class='cell'>" +
              data[i].maSinhVien +
              "</td>\
                                <td class='cell'>" +
              data[i].hoTenSinhVien +
              "</td>\
                                <td class='cell'>" +
              data[i].maLop +
              "</td>\
                                <td class='cell'>" +
              (data[i].trangThai == 1
                ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Chấp thuận</span>"
                : data[i].trangThai == -1
                ? "<span class='badge bg-danger' style='color: white;font-size: inherit;'>Từ chối</span>"
                : "<span class='badge bg-info' style='color: white;font-size: inherit;'>Đang chờ duyệt</span>") +
              "</td>\
                                <td class='cell'>" +
              (data[i].trangThai == 0
                ? timeSinceBadge(data[i].thoiGianKhieuNai)
                : toDateTimeString(data[i].thoiGianKhieuNai)) +
              "</td>\
                                <td class='cell'>\
                                  <button class='btn btn-secondary btn_XemChiTiet' style='color: white; width: max-content;' data-bs-toggle='modal' data-bs-target='#XemChiTietModal' data-id = '" +
              data[i].maKhieuNai +
              "' >Xem chi tiết</button>\
                                  <button class='btn btn-info btn_PheDuyet' style='color: white; width: max-content;' data-bs-toggle='modal' data-bs-target='#PheDuyetModal' data-id = '" +
              data[i].maKhieuNai +
              "' >Phê duyệt</button>\
              </td>\
                                </tr>";
          }

          $("#tbodyKhieuNai").html(htmlData);
        },
      });
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      tableKhieuNaiContent = [];

      $("#idPhanTrangKhieuNai").empty();

      htmlData += "<tr>\
                      <td colspan='9' class='text-center'>\
                          <p class='mt-4'>Không tìm thấy kết quả.</p>\
                      </td>\
                  </tr>"
      $("#tbodyKhieuNai").append(htmlData);

      //ThongBaoLoi(errorMessage.responseJSON.message);
    },
  });

  $("#select_TrangThai").val("all");
}

function LoadThongTinPheDuyet(maKhieuNai) {
  $("#edit_input_MaKhieuNai").val(maKhieuNai);

  $.ajax({
    url: urlapi_khieunai_single_read + `?maKhieuNai=${maKhieuNai}`,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result_KN) {
      if (result_KN.trangThai != 0) {
        $(
          "input[name=trangThai][value=" + result_KN.trangThai + "]",
          "#PheDuyetForm"
        )
          .attr("checked", true)
          .trigger("click");
      } else {
        $("input[name=trangThai]", "#PheDuyetForm").prop("checked", false);
        $("#edit_textarea_LoiNhan").parent().hide();
        $("#edit_textarea_LyDoTuChoi").parent().hide();
      }

      if (result_KN.loiNhan) {
        $("#edit_textarea_LoiNhan").val(result_KN.loiNhan);
      } else {
        $("#edit_textarea_LoiNhan").val("");
      }

      if (result_KN.lyDoTuChoi) {
        $("#edit_textarea_LyDoTuChoi").val(result_KN.lyDoTuChoi);
      } else {
        $("#edit_textarea_LyDoTuChoi").val("");
      }
    },
    error: function (error_KN) {
      $("#PheDuyetModal").find(".btn-close").trigger("click");
      ThongBaoLoi(error_KN.responseJSON.message);
    },
  });
}

function sendEmailApprovalNotification(maKhieuNai) {
  var formData = new FormData();
  formData.append("maKhieuNai", maKhieuNai);

  $.ajax({
    url:
      host_domain_url + "/phpmailer/send_email/sendEmailPheDuyetKhieuNai.php",
    async: true,
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (result) {
      result = JSON.parse(result);

      if (!result.success) {
        ThongBaoLoi(result.message);
      }
    },
  });
}

function pheDuyet() {
  const _edit_input_MaKhieuNai = $("#edit_input_MaKhieuNai").val();
  const _trangThai = $("input[name=trangThai]:checked", "#PheDuyetForm").val();

  if (_trangThai) {
    var _edit_textarea_LoiNhan = $("#edit_textarea_LoiNhan").val();
    var _edit_textarea_LyDoTuChoi = $("#edit_textarea_LyDoTuChoi").val();
    var _edit_checkBox_guiEmail = $("#edit_checkBox_guiEmail").is(":checked")
      ? 1
      : 0;

    var dataPost = {
      maKhieuNai: _edit_input_MaKhieuNai,
      trangThai: _trangThai,
      loiNhan: _edit_textarea_LoiNhan,
      lyDoTuChoi: _edit_textarea_LyDoTuChoi,
    };

    $.ajax({
      url: urlapi_khieunai_update_trangThai,
      type: "POST",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      data: JSON.stringify(dataPost),
      async: false,
      headers: { Authorization: jwtCookie },
      success: function (result_update) {
        $("#PheDuyetModal").modal("hide");

        Swal.fire({
          icon: "success",
          title:
            "Phê duyệt thành công khiếu nại mã: " +
            _edit_input_MaKhieuNai +
            "!",
          text: "",
          timer: 2000,
          timerProgressBar: true,
        });

        setTimeout(() => {
          GetListKhieuNai(
            $("#select_Khoa").val(),
            $("#select_KhoaHoc").val(),
            $("#select_HocKyDanhGia").val()
          );
        }, 2000);

        if (_edit_checkBox_guiEmail == 1) {
          sendEmailApprovalNotification(_edit_input_MaKhieuNai);
        }
      },
      error: function (errorMessage) {
        checkLoiDangNhap(errorMessage.responseJSON.message);

        ThongBaoLoi(errorMessage.responseJSON.message);
      },
      complete: function () {
        $("#edit_checkBox_guiEmail").prop("checked", true);
      },
    });
  } else {
    ThongBaoLoi("Vui lòng chọn trạng thái phê duyệt!");
  }
}
