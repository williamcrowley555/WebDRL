var tableTitle = [
  "STT",
  "Mã số sinh viên",
  "Họ tên sinh viên",
  "Ngày sinh",
  "Email",
  "Số điện thoại",
  "Hệ",
  "Lớp",
  "Tốt nghiệp",
];

var listXetTotNghiep = {};
var listXetTotNghiepTimKiem = {};

var tableKetQuaHocTapTitle = ["STT", "Học kỳ - Năm học", "Điểm hệ 4"];

var tableContent = [];

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

function presentNotification(iconType, titleNotification, textNotifiaction) {
  Swal.fire({
    icon: iconType,
    title: titleNotification,
    text: textNotifiaction,
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

function checkLoiDangNhap(message) {
  if (message.localeCompare("Vui lòng đăng nhập trước!") == 0) {
    deleteAllCookies();
    location.href = "login.php";
  }
}

var jwtCookie = getCookie("jwt");

//Sinh viên//
function GetListSinhVien(maKhoa, maLop) {
  if (maKhoa != null) {
    if (maKhoa == "tatcakhoa") {
      $("#id_tbodySinhVien tr").remove();
      $.ajax({
        url: urlapi_sinhvien_read_maLop + (maLop ? maLop : ""),
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: { Authorization: jwtCookie },
        success: function (result) {
          //$("#id_tbodySinhVien").find("tr").remove();

          tableContent = result["sinhvien"];

          $("#idPhanTrang").pagination({
            dataSource: result["sinhvien"],
            pageSize: 10,
            autoHidePrevious: true,
            autoHideNext: true,

            callback: function (data, pagination) {
              var htmlData = "";
              var countSinhVien = 0;

              for (let i = 0; i < data.length; i++) {
                countSinhVien += 1;

                htmlData +=
                  "<tr>\
                  <td class='cell'>" +
                  data[i].soThuTu +
                  "</td>\
                  <td class='cell'><span class='truncate'>" +
                  data[i].maSinhVien +
                  "</span></td>\
                  <td class='cell'>" +
                  data[i].hoTenSinhVien +
                  "</td>\
                  <td class='cell'>" +
                  data[i].ngaySinh +
                  "</td>\
                  <td class='cell'>" +
                  data[i].he +
                  "</td>\
                  <td class='cell'>" +
                  data[i].email +
                  "</td>\
                  <td class='cell'>" +
                  data[i].sdt +
                  "</td>\
                  <td class='cell'>" +
                  data[i].maLop +
                  "</td>\
                  <td class='cell'>" +
                  (data[i].totNghiep == 1
                    ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Đã tốt nghiệp</span>"
                    : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Chưa tốt nghiệp</span>") +
                  "</td>\
                  <td class='cell'><button type='button' id='id_btnReset' class='m-2 btn btn-info btn_DatLaiMatKhau_SinhVien' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white; min-width: 137px;' data-id='" +
                  data[i].maSinhVien +
                  "' >Đặt lại mật khẩu</button>\
                  <button class='m-2 btn bg-warning btn_ChinhSua_SinhVien' style='color: white; min-width: 95px;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                  data[i].maSinhVien +
                  "' >Chỉnh sửa</button>\
                  <button class='m-2 btn app-btn-primary btn_QuanLyDiemTrungBinhHocKy_SinhVien' style='color: white;' data-bs-toggle='modal' data-bs-target='#QuanLyDiemTrungBinhHocKyModal' data-id = '" +
                  data[i].maSinhVien +
                  "' >Quản lý điểm trung bình</button>\
                </td>\
                                    </tr>";
              }

              $("#id_tbodySinhVien").html(htmlData);
            },
          });
        },
        error: function (errorMessage) {
          checkLoiDangNhap(errorMessage.responseJSON.message);

          tableContent = [];
          var htmlData = "";
          $("#id_tbodySinhVien").html(htmlData);
          $("#idPhanTrang").empty();

          htmlData += "<tr>\
                          <td colspan='8' class='text-center'>\
                              <p class='mt-4'>Không tìm thấy kết quả.</p>\
                          </td>\
                      </tr>"
          $("#tbodyQuanTriVien").append(htmlData);

          //ThongBaoLoi(errorMessage.responseJSON.message);
        },
        statusCode: {
          403: function (xhr) {
            //deleteAllCookies();
            //location.href = 'login.php';
          },
        },
      });
    } else {
      if (maLop != null) {
        if (maLop == "tatcalop") {
          $("#id_tbodySinhVien tr").remove();

          $.ajax({
            url: urlapi_sinhvien_read_maKhoa + maKhoa,
            async: false,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            headers: { Authorization: jwtCookie },
            success: function (result_AllSinhVien) {
              tableContent = result_AllSinhVien["sinhvien"];

              var result_SVALL = result_AllSinhVien["sinhvien"];

              $("#idPhanTrang").pagination({
                dataSource: result_SVALL,
                pageSize: 10,
                autoHidePrevious: true,
                autoHideNext: true,

                callback: function (data, pagination) {
                  var htmlData = "";
                  var countSinhVien = 0;
                  // htmlData = "<tr></tr>"
                  for (let i = 0; i < data.length; i++) {
                    countSinhVien += 1;

                    htmlData +=
                      "<tr>\
                      <td class='cell'>" +
                      data[i].soThuTu +
                      "</td>\
                      <td class='cell'><span class='truncate'>" +
                      data[i].maSinhVien +
                      "</span></td>\
                      <td class='cell'>" +
                      data[i].hoTenSinhVien +
                      "</td>\
                      <td class='cell'>" +
                      data[i].ngaySinh +
                      "</td>\
                      <td class='cell'>" +
                      data[i].he +
                      "</td>\
                      <td class='cell'>" +
                      data[i].email +
                      "</td>\
                      <td class='cell'>" +
                      data[i].sdt +
                      "</td>\
                      <td class='cell'>" +
                      data[i].maLop +
                      "</td>\
                      <td class='cell'>" +
                      (data[i].totNghiep == 1
                        ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Đã tốt nghiệp</span>"
                        : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Chưa tốt nghiệp</span>") +
                      "</td>\
                      <td class='cell'><button  type='button' id='id_btnReset' class='m-2 btn btn-info btn_DatLaiMatKhau_SinhVien' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white; min-width: 137px;' data-id='" +
                        data[i].maSinhVien +
                        "' >Đặt lại mật khẩu</button>\
                        <button class='m-2 btn bg-warning btn_ChinhSua_SinhVien' style='color: white; min-width: 95px;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                        data[i].maSinhVien +
                        "' >Chỉnh sửa</button>\
                        <button class='m-2 btn app-btn-primary btn_QuanLyDiemTrungBinhHocKy_SinhVien' style='color: white;' data-bs-toggle='modal' data-bs-target='#QuanLyDiemTrungBinhHocKyModal' data-id = '" +
                        data[i].maSinhVien +
                        "' >Quản lý điểm trung bình</button>\
                      </td>\
                    </tr>";
                  }

                  $("#id_tbodySinhVien").html(htmlData);
                },
              });
            },
            error: function (errorMessage) {
              checkLoiDangNhap(errorMessage.responseJSON.message);

              tableContent = [];
              var htmlData = "";
              $("#id_tbodySinhVien").html(htmlData);
              $("#idPhanTrang").empty();

              htmlData += "<tr>\
                              <td colspan='10' class='text-center'>\
                                  <p class='mt-4'>Không tìm thấy kết quả.</p>\
                              </td>\
                          </tr>"
              $("#id_tbodySinhVien").append(htmlData);

              //ThongBaoLoi(errorMessage.responseJSON.message);
            },
            statusCode: {
              403: function (xhr) {
                //deleteAllCookies();
                //location.href = 'login.php';
              },
            },
          });
        } else {
          $("#id_tbodySinhVien tr").remove();
          $.ajax({
            url: urlapi_sinhvien_read_maKhoa + maKhoa + "&maLop=" + maLop,
            async: false,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            headers: { Authorization: jwtCookie },
            success: function (result_SV) {
              tableContent = result_SV["sinhvien"];

              $("#idPhanTrang").pagination({
                dataSource: result_SV["sinhvien"],
                pageSize: 10,
                autoHidePrevious: true,
                autoHideNext: true,

                callback: function (data, pagination) {
                  var htmlData = "";
                  var countSinhVien = 0;
                  // htmlData = "<tr></tr>"
                  for (let i = 0; i < data.length; i++) {
                    countSinhVien += 1;

                    htmlData +=
                      "<tr>\
                        <td class='cell'>" +
                      data[i].soThuTu +
                      "</td>\
                        <td class='cell'><span class='truncate'>" +
                      data[i].maSinhVien +
                      "</span></td>\
                        <td class='cell'>" +
                      data[i].hoTenSinhVien +
                      "</td>\
                        <td class='cell'>" +
                      data[i].ngaySinh +
                      "</td>\
                        <td class='cell'>" +
                      data[i].he +
                      "</td>\
                        <td class='cell'>" +
                      data[i].email +
                      "</td>\
                        <td class='cell'>" +
                      data[i].sdt +
                      "</td>\
                        <td class='cell'>" +
                      data[i].maLop +
                      "</td>\
                        <td class='cell'>" +
                      (data[i].totNghiep == 1
                        ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Đã tốt nghiệp</span>"
                        : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Chưa tốt nghiệp</span>") +
                      "</td>\
                      <td class='cell'><button  type='button' id='id_btnReset' class='m-2 btn btn-info btn_DatLaiMatKhau_SinhVien' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white; min-width: 137px;' data-id='" +
                        data[i].maSinhVien +
                        "' >Đặt lại mật khẩu</button>\
                        <button class='m-2 btn bg-warning btn_ChinhSua_SinhVien' style='color: white; min-width: 95px;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                        data[i].maSinhVien +
                        "' >Chỉnh sửa</button>\
                        <button class='m-2 btn app-btn-primary btn_QuanLyDiemTrungBinhHocKy_SinhVien' style='color: white;' data-bs-toggle='modal' data-bs-target='#QuanLyDiemTrungBinhHocKyModal' data-id = '" +
                        data[i].maSinhVien +
                        "' >Quản lý điểm trung bình</button>\
                      </td>\
                      </tr>";
                  }

                  $("#id_tbodySinhVien").html(htmlData);
                },
              });
            },
            error: function (errorMessage) {
              checkLoiDangNhap(errorMessage.responseJSON.message);

              tableContent = [];
              var htmlData = "";
              $("#id_tbodySinhVien").html(htmlData);
              $("#idPhanTrang").empty();

              htmlData += "<tr>\
                              <td colspan='10' class='text-center'>\
                                  <p class='mt-4'>Không tìm thấy kết quả.</p>\
                              </td>\
                          </tr>"
              $("#id_tbodySinhVien").append(htmlData);

              //ThongBaoLoi(errorMessage.responseJSON.message);
            },
            statusCode: {
              403: function (xhr) {
                //deleteAllCookies();
                //location.href = 'login.php';
              },
            },
          });
        }
      } else {
        $("#id_tbodySinhVien tr").remove();
        $.ajax({
          url: urlapi_sinhvien_read_maKhoa + maKhoa,
          async: false,
          type: "GET",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          headers: { Authorization: jwtCookie },
          success: function (result) {
            tableContent = result["sinhvien"];

            $("#idPhanTrang").pagination({
              dataSource: result["sinhvien"],
              pageSize: 10,
              autoHidePrevious: true,
              autoHideNext: true,

              callback: function (data, pagination) {
                var htmlData = "";
                var countSinhVien = 0;

                for (let i = 0; i < data.length; i++) {
                  countSinhVien += 1;

                  htmlData +=
                    "<tr>\
                  <td class='cell'>" +
                    data[i].soThuTu +
                    "</td>\
                  <td class='cell'><span class='truncate'>" +
                    data[i].maSinhVien +
                    "</span></td>\
                  <td class='cell'>" +
                    data[i].hoTenSinhVien +
                    "</td>\
                  <td class='cell'>" +
                    data[i].ngaySinh +
                    "</td>\
                  <td class='cell'>" +
                    data[i].he +
                    "</td>\
                  <td class='cell'>" +
                    data[i].email +
                    "</td>\
                  <td class='cell'>" +
                    data[i].sdt +
                    "</td>\
                  <td class='cell'>" +
                    data[i].maLop +
                    "</td>\
                  <td class='cell'>" +
                    (data[i].totNghiep == 1
                      ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Đã tốt nghiệp</span>"
                      : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Chưa tốt nghiệp</span>") +
                    "</td>\
                    <td class='cell'><button  type='button' id='id_btnReset' class='m-2 btn btn-info btn_DatLaiMatKhau_SinhVien' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white; min-width: 137px;' data-id='" +
                      data[i].maSinhVien +
                      "' >Đặt lại mật khẩu</button>\
                      <button class='m-2 btn bg-warning btn_ChinhSua_SinhVien' style='color: white; min-width: 95px;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                      data[i].maSinhVien +
                      "' >Chỉnh sửa</button>\
                      <button class='m-2 btn app-btn-primary btn_QuanLyDiemTrungBinhHocKy_SinhVien' style='color: white;' data-bs-toggle='modal' data-bs-target='#QuanLyDiemTrungBinhHocKyModal' data-id = '" +
                      data[i].maSinhVien +
                      "' >Quản lý điểm trung bình</button>\
                    </td>\
                                    </tr>";
                }

                $("#id_tbodySinhVien").html(htmlData);
              },
            });
          },
          error: function (errorMessage) {
            checkLoiDangNhap(errorMessage.responseJSON.message);

            tableContent = [];
            var htmlData = "";
            $("#id_tbodySinhVien").html(htmlData);
            $("#idPhanTrang").empty();

            htmlData += "<tr>\
                              <td colspan='10' class='text-center'>\
                                  <p class='mt-4'>Không tìm thấy kết quả.</p>\
                              </td>\
                          </tr>"
              $("#id_tbodySinhVien").append(htmlData);

            //ThongBaoLoi(errorMessage.responseJSON.message);
          },
          statusCode: {
            403: function (xhr) {
              //deleteAllCookies();
              //location.href = 'login.php';
            },
          },
        });
      }
    }
  }
}

function TimKiemSinhVien(maSinhVien) {
  $("#id_tbodySinhVien tr").remove();

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
      error: function (errorMessage) {
      },
    });
  }

  $.ajax({
    url: urlapi_sinhvien_read_mssv + maSinhVien + paramMaKhoa,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: { Authorization: jwtCookie },
    success: function (result) {
      tableContent = result["sinhvien"];

      $("#idPhanTrang").pagination({
        dataSource: result["sinhvien"],
        pageSize: 10,
        autoHidePrevious: true,
        autoHideNext: true,

        callback: function (data, pagination) {
          var htmlData = "";
          var countSinhVien = 0;

          for (let i = 0; i < data.length; i++) {
            countSinhVien += 1;

            htmlData +=
              "<tr>\
                  <td class='cell'>" +
              data[i].soThuTu +
              "</td>\
                  <td class='cell'><span class='truncate'>" +
              data[i].maSinhVien +
              "</span></td>\
                  <td class='cell'>" +
              data[i].hoTenSinhVien +
              "</td>\
                  <td class='cell'>" +
              data[i].ngaySinh +
              "</td>\
                  <td class='cell'>" +
              data[i].he +
              "</td>\
                  <td class='cell'>" +
              data[i].email +
              "</td>\
                  <td class='cell'>" +
              data[i].sdt +
              "</td>\
                  <td class='cell'>" +
              data[i].maLop +
              "</td>\
                  <td class='cell'>" +
              (data[i].totNghiep == 1
                ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Đã tốt nghiệp</span>"
                : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Chưa tốt nghiệp</span>") +
              "</td>\
              <td class='cell'><button type='button' id='id_btnReset' class='m-2 btn btn-info btn_DatLaiMatKhau_SinhVien' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white; min-width: 137px;' data-id='" +
              data[i].maSinhVien +
              "' >Đặt lại mật khẩu</button>\
              <button class='m-2 btn bg-warning btn_ChinhSua_SinhVien' style='color: white; min-width: 95px;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
              data[i].maSinhVien +
              "' >Chỉnh sửa</button>\
              <button class='m-2 btn app-btn-primary btn_QuanLyDiemTrungBinhHocKy_SinhVien' style='color: white;' data-bs-toggle='modal' data-bs-target='#QuanLyDiemTrungBinhHocKyModal' data-id = '" +
              data[i].maSinhVien +
              "' >Quản lý điểm trung bình</button>\
            </td>\
                                    </tr>";
          }

          $("#id_tbodySinhVien").html(htmlData);
        },
      });
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      tableContent = [];
      var htmlData = "";
      $("#id_tbodySinhVien").html(htmlData);
      $("#idPhanTrang").empty();

      htmlData += "<tr>\
                      <td colspan='10' class='text-center'>\
                          <p class='mt-4'>Không tìm thấy kết quả.</p>\
                      </td>\
                  </tr>"
      $("#id_tbodySinhVien").append(htmlData);
    },
    statusCode: {
      403: function (xhr) {
        //deleteAllCookies();
        //location.href = 'login.php';
      },
    },
  });
}

function LoadComboBoxThongTinKhoa_SinhVien(selector) {
  //Load khoa
  $.ajax({
    url: urlapi_khoa_read,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_Khoa) {
      $(selector).find("option").remove();

      if (getCookie("quyen") == "admin" || getCookie("quyen") == "ctsv") {
        $(selector).append(
          "<option selected value='tatcakhoa'>Tất cả khoa</option>"
        );
      }

      $.each(result_Khoa, function (index_Khoa) {
        for (var p = 0; p < result_Khoa[index_Khoa].length; p++) {
          if (getCookie("quyen") == "admin" || getCookie("quyen") == "ctsv") {
            $(selector).append(
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
              $(selector).append(
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

      if (getCookie("quyen") == "khoa") {
        $("#select_Khoa").trigger("change");
      }
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);
      if (selector === "#select_Khoa") {
        tableContent = [];
        var htmlData = "";
        $("#id_tbodySinhVien").html(htmlData);
        $("#idPhanTrang").empty();

        htmlData += "<tr>\
                        <td colspan='10' class='text-center'>\
                            <p class='mt-4'>Không tìm thấy kết quả.</p>\
                        </td>\
                    </tr>"
        $("#id_tbodySinhVien").append(htmlData);
      }
    },
  });
}

function LoadComboBoxThongTinLopTheoKhoa(maKhoa, selector) {
  if (maKhoa != "tatcakhoa") {
    //$("#select_Lop").find("option").remove();
    $(selector).find("option").remove();
    //Load khoa
    $.ajax({
      url: urlapi_lop_read_maKhoa + maKhoa,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: false,
      headers: { Authorization: jwtCookie },
      success: function (result_Lop) {
        $(selector).append(
          "<option selected value='tatcalop'>Tất cả lớp</option>"
        );

        $.each(result_Lop, function (index_Lop) {
          for (var p = 0; p < result_Lop[index_Lop].length; p++) {
            // $("#select_Lop")
            $(selector).append(
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
        if (selector == "#select_Lop") {
          tableContent = [];
          var htmlData = "";
          $("#id_tbodySinhVien").html(htmlData);
          $("#idPhanTrang").empty();

          htmlData += "<tr>\
                          <td colspan='10' class='text-center'>\
                              <p class='mt-4'>Không tìm thấy kết quả.</p>\
                          </td>\
                      </tr>"
          $("#id_tbodySinhVien").append(htmlData);
        }
      },
    });
  } else {
    //LoadComboBoxThongTinKhoa();
    $(selector).find("option").remove();
  }
}

function LoadComboBoxThongTinLop_SinhVien() {
  //Load lớp
  $.ajax({
    url: urlapi_lop_read,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_Lop) {
      $("#select_Lop_Add").find("option").remove();
      $("#edit_select_Lop").find("option").remove();
      $("#select_lop_import").find("option").remove();

      $.each(result_Lop, function (index_Lop) {
        for (var p = 0; p < result_Lop[index_Lop].length; p++) {
          $("#edit_select_Lop").append(
            "<option value='" +
              result_Lop[index_Lop][p].maLop +
              "'>" +
              result_Lop[index_Lop][p].maLop +
              "</option>"
          );

          $("#select_Lop_Add").append(
            "<option value='" +
              result_Lop[index_Lop][p].maLop +
              "'>" +
              result_Lop[index_Lop][p].maLop +
              "</option>"
          );

          $("#select_lop_import").append(
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

function ThemMoi_SinhVien() {
  var _input_MaSinhVien = $("#input_MaSinhVien").val();
  var _input_HoTenSinhVien = $("#input_HoTenSinhVien").val();
  var _input_NgaySinh = $("#input_NgaySinh").val();
  var _input_Email = $("#input_Email").val();
  var _input_sdt = $("#input_sdt").val();
  var _input_MaLop = $("#select_Lop_Add option:selected").val();
  var _select_He_Add = $("#select_He_Add option:selected").text();
  var _select_TotNghiep_Add = $("#select_TotNghiep_Add option:selected").val();

  if (
    _input_MaSinhVien == "" ||
    _input_HoTenSinhVien == "" ||
    _input_NgaySinh == "" ||
    _input_Email == "" ||
    _input_sdt == ""
  ) {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {
    var dataPost = {
      maSinhVien: _input_MaSinhVien,
      hoTenSinhVien: _input_HoTenSinhVien,
      ngaySinh: _input_NgaySinh,
      email: _input_Email,
      sdt: _input_sdt,
      maLop: _input_MaLop,
      matKhauSinhVien: _input_MaSinhVien,
      he: _select_He_Add,
      totNghiep: _select_TotNghiep_Add,
    };

    $.ajax({
      url: urlapi_sinhvien_create,
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
          text: "Sinh viên mã số " + _input_MaSinhVien + " đã được tạo!",
          timer: 2000,
          timerProgressBar: true,
        });

        setTimeout(() => {
          GetListSinhVien($("#select_Khoa").val(), $("#select_Lop").val());
        }, 2000);

        $("#input_MaSinhVien").val("");
        $("#input_HoTenSinhVien").val("");
        $("#input_NgaySinh").val("");
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

function DatLaiMatKhau_SinhVien() {
  var maSinhVien_Update = $("#input_MaSinhVien_Update").val();

  var _input_MatKhauMoi = $("#input_MatKhauMoi").val();
  var _input_NhapLaiMatKhauMoi = $("#input_NhapLaiMatKhauMoi").val();

  if (_input_MatKhauMoi == "" || _input_NhapLaiMatKhauMoi == "") {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {
    if (_input_MatKhauMoi != _input_NhapLaiMatKhauMoi) {
      ThongBaoLoi("Nhập lại mật khẩu không khớp với mật khẩu! Mời nhập lại!");
    } else {
      $.ajax({
        url: urlapi_sinhvien_single_read + maSinhVien_Update,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_SV) {
          var _input_MaSinhVien = result_SV.maSinhVien;
          var _input_hoTenSinhVien = result_SV.hoTenSinhVien;
          var _input_ngaySinh = result_SV.ngaySinh;
          var _input_email = result_SV.email;
          var _input_sdt = result_SV.sdt;
          var _input_he = result_SV.he;
          var _input_maLop = result_SV.maLop;
          var _input_totNghiep = result_SV.totNghiep;

          var dataPost_Update = {
            maSinhVien: _input_MaSinhVien,
            hoTenSinhVien: _input_hoTenSinhVien,
            ngaySinh: _input_ngaySinh,
            email: _input_email,
            sdt: _input_sdt,
            he: _input_he,
            maLop: _input_maLop,
            matKhauSinhVien: _input_MatKhauMoi,
            totNghiep: _input_totNghiep,
          };

          $.ajax({
            url: urlapi_sinhvien_update,
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            data: JSON.stringify(dataPost_Update),
            async: false,
            headers: { Authorization: jwtCookie },
            success: function (result_Create) {
              $("#DatLaiMatKhauModal").modal("hide");

              Swal.fire({
                icon: "success",
                title: "Đặt lại mật khẩu thành công!",
                text: "",
                timer: 2000,
                timerProgressBar: true,
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

          // Delete token cua sinh VIEN
          $.ajax({
            url: urlapi_logout_client,
            data: JSON.stringify({ maSo: maSinhVien_Update }),
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: false,
            success: function (result) {},
            error: function (errorMessage) {},
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
  }
}

function LoadThongTinChinhSua_SinhVien(maSinhVien) {
  $.ajax({
    url: urlapi_sinhvien_single_read + maSinhVien,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_data) {
      $("#edit_input_TenSinhVien").val(result_data.hoTenSinhVien);

      var _edit_select_Lop = document.getElementById("edit_select_Lop");

      for (var i = 0; i < _edit_select_Lop.options.length; i++) {
        if (_edit_select_Lop.options[i].value === result_data.maLop) {
          _edit_select_Lop.options[i].selected = true;
        }
      }

      var _edit_select_He = document.getElementById("edit_select_He");
      for (var i = 0; i < _edit_select_He.options.length; i++) {
        if (_edit_select_He.options[i].value === result_data.he) {
          _edit_select_He.options[i].selected = true;
        }
      }

      var _edit_input_NgaySinh = document.getElementById("edit_input_NgaySinh");
      _edit_input_NgaySinh.value = result_data.ngaySinh;

      //load searchable field
      var edit_select_Lop = document.querySelector("#edit_select_Lop");

      dselect(edit_select_Lop, {
        search: true,
      });

      var edit_select_He = document.querySelector("#edit_select_He");

      $("#edit_input_Email").val(result_data.email);
      $("#edit_input_sdt").val(result_data.sdt);
      $("#edit_select_TotNghiep").val(result_data.totNghiep);

      dselect(edit_select_He, {
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

function ChinhSua_SinhVien() {
  var _edit_input_MaSinhVien = $("#edit_input_MaSinhVien").val();
  var _edit_input_TenSinhVien = $("#edit_input_TenSinhVien").val();
  var _edit_input_NgaySinh = $("#edit_input_NgaySinh").val();
  var _edit_input_Email = $("#edit_input_Email").val();
  var _edit_input_sdt = $("#edit_input_sdt").val();
  var _edit_select_Lop = $("#edit_select_Lop option:selected").val();
  var _edit_select_He = $("#edit_select_He option:selected").text();
  var _edit_select_TotNghiep = $(
    "#edit_select_TotNghiep option:selected"
  ).val();

  if (
    _edit_input_MaSinhVien == "" ||
    _edit_input_TenSinhVien == "" ||
    _edit_input_NgaySinh == "" ||
    _edit_input_Email == "" ||
    _edit_input_sdt == ""
  ) {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {
    var dataPost = {
      maSinhVien: _edit_input_MaSinhVien,
      hoTenSinhVien: _edit_input_TenSinhVien,
      ngaySinh: _edit_input_NgaySinh,
      email: _edit_input_Email,
      sdt: _edit_input_sdt,
      he: _edit_select_He,
      maLop: _edit_select_Lop,
      totNghiep: _edit_select_TotNghiep,
    };

    $.ajax({
      url: urlapi_sinhvien_update,
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
            "Chỉnh sửa thành công sinh viên mã số " +
            _edit_input_MaSinhVien +
            "!",
          text: "",
          timer: 2000,
          timerProgressBar: true,
        });

        $.ajax({
          url: urlapi_logout_client,
          data: JSON.stringify({ maSo: _edit_input_MaSinhVien }),
          type: "POST",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          async: false,
          success: function (result) {},
          error: function (errorMessage) {},
        });

        setTimeout(() => {
          GetListSinhVien($("#select_Khoa").val(), $("#select_Lop").val());
        }, 2000);
      },
      error: function (errorMessage) {
        //checkLoiDangNhap(errorMessage.responseJSON.message);

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

function LoadComboBoxHocKyVaNamHoc() {
  $.ajax({
    url: urlapi_hockydanhgia_read,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },

    success: function (result_data) {
      $("#select_Quanlydiemtrungbinhhocky").find("option").remove();
      $.each(result_data, function (index_HocKy) {
        for (var i = 0; i < result_data[index_HocKy].length; i++) {
          $("#select_Quanlydiemtrungbinhhocky").append(
            "<option value='" +
              result_data[index_HocKy][i].maHocKyDanhGia +
              "'>Học kỳ: " +
              result_data[index_HocKy][i].hocKyXet +
              " - Năm học: " +
              result_data[index_HocKy][i].namHocXet +
              "</option>"
          );
        }
      });
    },

    error: function () {
      console.log("Loi load combobox nam hoc");
      return;
    },
  });
}

function getHTMLOptionText(selected) {
  return selected.options[selected.selectedIndex].text;
}

function NhapDiemHe4() {
  var maSinhVien_GPA = $("#input_MaSinhVien_GPA").val();
  var maHocKyDanhGia = $(
    "#select_Quanlydiemtrungbinhhocky option:selected"
  ).val();
  var GPA = $("#input_DiemTrungBinh").val();
  var maDiemTrungBinh = maSinhVien_GPA + maHocKyDanhGia;

  var dataPost = {
    maDiemTrungBinh: maDiemTrungBinh,
    diem: GPA,
    maHocKyDanhGia: maHocKyDanhGia,
    maSinhVien: maSinhVien_GPA,
  };

  //Lưu điểm trung bình hệ 4 vào database
  $.ajax({
    url: urlapi_diemtrungbinhhe4_create,
    type: "POST",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    data: JSON.stringify(dataPost),
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_update) {
      $("#QuanLyDiemTrungBinhHocKyModal").modal("hide");

      Swal.fire({
        icon: "success",
        title: "Nhập điểm thành công sinh viên mã số " + maSinhVien_GPA + "!",
        text: "",
        timer: 2000,
        timerProgressBar: true,
      });

      setTimeout(() => {
        LoadDiemHe4(maSinhVien_GPA);
      }, 2000);
    },
    error: function (errorMessage) {
      Swal.fire({
        icon: "error",
        title: "Lỗi",
        text: errorMessage.responseJSON.message,
        timerProgressBar: true,
      });
    },
  });
}

function LoadDiemHe4(maSinhVien) {
  $.ajax({
    url: urlapi_diemtrungbinhhe4_read_MaSV + maSinhVien,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_data) {
      $("#id_tbodyKetQuaHocTap tr").remove();
      var htmlData = "";

      $.each(result_data, function (index) {
        for (var i = 0; i < result_data[index].length; i++) {
          $.ajax({
            url:
              urlapi_hockydanhgia_single_read +
              result_data[index][i].maHocKyDanhGia,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: false,
            headers: { Authorization: jwtCookie },
            success: function (result_HKDG) {
              htmlData +=
                "<tr>\
                <td class='cell'>" +
                result_data[index][i].soThuTu +
                "</td>\
                <td class='cell'> Học kì: " +
                result_HKDG.hocKyXet +
                " - Năm học: " +
                result_HKDG.namHocXet +
                "</td>\
                <td class='cell'>" +
                result_data[index][i].diem +
                "</td>\
                <td class='cell'>\
                  <button class='btn bg-warning btn_ChinhSua_DiemHe4' style='color: white;' data-idMSSV = '" +
                result_data[index][i].maSinhVien +
                "' data-idMaHKDG='" +
                result_data[index][i].maHocKyDanhGia +
                "' >Chỉnh sửa</button>\
                  <div class='edit-confirmation' style='display:none'>\
                    <button class='btn app-btn-primary btn_XacNhanChinhSua_DiemHe4' style='color: white;' data-idMSSV = '" +
                result_data[index][i].maSinhVien +
                "' data-idMaHKDG='" +
                result_data[index][i].maHocKyDanhGia +
                "'>Xác nhận</button>\
                    <button class='btn bg-danger btn_HuyChinhSua_DiemHe4 ml-2' style='color: white;' data-idMSSV = '" +
                result_data[index][i].maSinhVien +
                "' data-idMaHKDG='" +
                result_data[index][i].maHocKyDanhGia +
                "'>Hủy</button>\
                  </div>\
                </td></tr>";
            },
            error: function () {},
          });
        }
      });

      $("#id_tbodyKetQuaHocTap").html(htmlData);
    },
    error: function (errorMessage) {
      $("#id_tbodyKetQuaHocTap tr").remove();
      var htmlData =
        '\
        <tr>\
          <td colspan="4">\
          <p class="text-center">Không tìm thấy kết quả của mssv: ' +
        +maSinhVien +
        "</p>\
        </td>\
        <tr>";
      $("#id_tbodyKetQuaHocTap").html(htmlData);
    },
  });
}

function updateDiemHe4(maSinhVien, maHocKyDanhGia, diem) {
  var dataPost_Update = {
    maDiemTrungBinh: maSinhVien + maHocKyDanhGia,
    diem: diem,
    maHocKyDanhGia: maHocKyDanhGia,
    maSinhVien: maSinhVien,
  };

  $.ajax({
    url: urlapi_diemtrungbinhhe4_update,
    type: "POST",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    data: JSON.stringify(dataPost_Update),
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_Create) {
      LoadDiemHe4(maSinhVien);

      Swal.fire({
        icon: "success",
        title: "Cập nhật điểm thành công cho sinh viên có mã là " + maSinhVien,
        text: "",
        timer: 2000,
        timerProgressBar: true,
      });
    },
    error: function (errorMessage) {
      //checkLoiDangNhap(errorMessage.responseJSON.message);
      LoadDiemHe4(maSinhVien);

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

function getListXetTotNghiep(maLop) {
  $.ajax({
    url: urlapi_sinhvien_read_maLop + maLop,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: { Authorization: jwtCookie },
    success: function (result_data) {
      listXetTotNghiep = result_data;
    },
    error: function () {
      console.log("Loi load list xet tot nghiep");
    },
  });
}

function viewCheckBox() {
  $("#listXetTotNghiep").empty();
  htmlData = "";
  $.each(listXetTotNghiep, function (index) {
    for (let i = 0; i < listXetTotNghiep[index].length; i++) {
      if (listXetTotNghiep[index][i].totNghiep == 0) {
        htmlData +=
          "\
                            <input type='checkbox' onclick='changeCheckBox(this)' dataXetTotNghiep ='" +
          listXetTotNghiep[index][i].maSinhVien +
          "' /> " +
          listXetTotNghiep[index][i].maSinhVien +
          " - " +
          listXetTotNghiep[index][i].hoTenSinhVien +
          " <br />";
      } else {
        htmlData +=
          "\
                            <input type='checkbox' onclick='changeCheckBox(this)' dataXetTotNghiep ='" +
          listXetTotNghiep[index][i].maSinhVien +
          "' checked /> " +
          listXetTotNghiep[index][i].maSinhVien +
          " - " +
          listXetTotNghiep[index][i].hoTenSinhVien +
          " <br />";
      }
    }
  });
  $("#listXetTotNghiep").html(htmlData);
}

function searchCheckBox() {
  var searchText = $("#input_TimKiem_XetTotNghiep").val().toUpperCase();
  var htmlData = "";
  $.each(listXetTotNghiep, function (index) {
    for (let i = 0; i < listXetTotNghiep[index].length; i++) {
      if (
        listXetTotNghiep[index][i].maSinhVien.includes(searchText) ||
        listXetTotNghiep[index][i].hoTenSinhVien.includes(searchText)
      ) {
        if (listXetTotNghiep[index][i].totNghiep == 0) {
          htmlData +=
            "\
                                <input type='checkbox' onclick='changeCheckBox(this)' dataxettotnghiep ='" +
            listXetTotNghiep[index][i].maSinhVien +
            "' /> " +
            listXetTotNghiep[index][i].maSinhVien +
            " - " +
            listXetTotNghiep[index][i].hoTenSinhVien +
            " <br />";
        } else {
          htmlData +=
            "\
                                <input type='checkbox' onclick='changeCheckBox(this)' dataxettotnghiep ='" +
            listXetTotNghiep[index][i].maSinhVien +
            "' checked /> " +
            listXetTotNghiep[index][i].maSinhVien +
            " - " +
            listXetTotNghiep[index][i].hoTenSinhVien +
            " <br />";
        }
      }
    }
  });
  $("#listXetTotNghiep").empty();
  $("#listXetTotNghiep").html(htmlData);
}

function changeCheckBox(checkbox) {
  var maSinhVienXetTotNghiep = $(checkbox).attr("dataxettotnghiep");
  $.each(listXetTotNghiep, function (index) {
    for (let i = 0; i < listXetTotNghiep[index].length; i++) {
      if (listXetTotNghiep[index][i].maSinhVien == maSinhVienXetTotNghiep) {
        listXetTotNghiep[index][i].totNghiep =
          listXetTotNghiep[index][i].totNghiep == 0 ? 1 : 0;
      }
    }
  });
}

function selectAllCheckBox() {
  $.each(listXetTotNghiep, function (index) {
    for (let i = 0; i < listXetTotNghiep[index].length; i++) {
      listXetTotNghiep[index][i].totNghiep = 1;
    }
  });
  viewCheckBox();
}

function deselectAllCheckBox() {
  $.each(listXetTotNghiep, function (index) {
    for (let i = 0; i < listXetTotNghiep[index].length; i++) {
      listXetTotNghiep[index][i].totNghiep = 0;
    }
  });
  viewCheckBox();
}

function luuXetTotNghiep() {
  $.each(listXetTotNghiep, function (index) {
    for (let i = 0; i < listXetTotNghiep[index].length; i++) {
      var dataPost_Update = {
        maSinhVien: listXetTotNghiep[index][i].maSinhVien,
        totNghiep: Number(listXetTotNghiep[index][i].totNghiep),
      };

      $.ajax({
        url: urlapi_sinhvien_update_xettotnghiep,
        type: "POST",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        data: JSON.stringify(dataPost_Update),
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_Create) {
          presentNotification(
            "success",
            "Thành công",
            "Update xét tốt nghiệp thành công!"
          );

          $.ajax({
            url: urlapi_logout_client,
            data: JSON.stringify({ maSo: listXetTotNghiep[index][i].maSinhVien }),
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: false,
            success: function (result) {},
            error: function (errorMessage) {},
          });

          setTimeout(() => {
            GetListSinhVien($("#select_Khoa").val(), $("#select_Lop").val());
          }, 2000);
        },
        error: function (errorMessage) {
          presentNotification(
            "error",
            "Thất bại",
            "Update xét tốt nghiệp thất bại!"
          );
        },
      });
    }
  });
}
