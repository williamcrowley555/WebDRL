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
  if ( message.localeCompare("Vui lòng đăng nhập trước!") == 0 ){
      deleteAllCookies();
      location.href = 'login.php';
  }
}


var jwtCookie = getCookie("jwt");

//Sinh viên//
function GetListSinhVien(maKhoa, maLop) {
  if (maKhoa != null) {
    if (maKhoa == "tatcakhoa") {
      $("#id_tbodySinhVien tr").remove();
      $.ajax({
        url: "../../api/sinhvien/read.php",
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: { Authorization: jwtCookie },
        success: function (result) {
          $("#id_tbodySinhVien").find("tr").remove();

          $("#idPhanTrang").pagination({
            dataSource: result["sinhvien"],
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
                  data[i].maLop +
                  "</td>\
                  <td class='cell'><button type=button' class='btn btn-info' style='color: white;' >Đặt lại mật khẩu</button></td>\
                                    </tr>";
              }

              $("#id_tbodySinhVien").append(htmlData);
            },
          });
        },
        error: function (errorMessage) {
          checkLoiDangNhap(errorMessage.responseJSON.message);

          Swal.fire({
            icon: "error",
            title: "Lỗi",
            text: errorMessage.responseText,
            timer: 5000,
            timerProgressBar: true,
          });
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
            url: "../../api/lop/read.php?maKhoa=" + maKhoa,
            async: false,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            headers: { Authorization: jwtCookie },
            success: function (result_Lop) {
              $.each(result_Lop, function (index_Lop) {
                for (var p = 0; p < result_Lop[index_Lop].length; p++) {
                  var get_maLop = result_Lop[index_Lop][p].maLop;

                  $.ajax({
                    url: "../../api/sinhvien/read.php?maLop=" + get_maLop,
                    async: false,
                    type: "GET",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json",
                    headers: { Authorization: jwtCookie },
                    success: function (result_SV) {
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
                              data[i].maLop +
                              "</td>\
                              <td class='cell'><button type=button' class='btn btn-info' style='color: white;' >Đặt lại mật khẩu</button></td>\
                                                                    </tr>";
                          }

                          $("#id_tbodySinhVien").append(htmlData);
                        },
                      });
                    },
                    error: function (errorMessage) {
                      checkLoiDangNhap(errorMessage.responseJSON.message);

                      Swal.fire({
                        icon: "error",
                        title: "Lỗi",
                        text: errorMessage.responseJSON.message,
                        timer: 5000,
                        timerProgressBar: true,
                      });
                    },
                    statusCode: {
                      403: function (xhr) {
                        //deleteAllCookies();
                        //location.href = 'login.php';
                      },
                    },
                  });
                }
              });
            },
            error: function (errorMessage) {
              checkLoiDangNhap(errorMessage.responseJSON.message);

              Swal.fire({
                icon: "error",
                title: "Lỗi",
                text: errorMessage.responseJSON.message,
                timer: 5000,
                timerProgressBar: true,
              });
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
            url: "../../api/sinhvien/read.php?maLop=" + maLop,
            async: false,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            headers: { Authorization: jwtCookie },
            success: function (result_SV) {
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
                      data[i].maLop +
                      "</td>\
                      <td class='cell'><button type=button' class='btn btn-info' style='color: white;' >Đặt lại mật khẩu</button></td>\
                                                    </tr>";
                  }

                  $("#id_tbodySinhVien").append(htmlData);
                },
              });
            },
            error: function (errorMessage) {
              checkLoiDangNhap(errorMessage.responseJSON.message);

              Swal.fire({
                icon: "error",
                title: "Lỗi",
                text: errorMessage.responseJSON.message,
                timer: 5000,
                timerProgressBar: true,
              });
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
}

function TimKiemSinhVien(maSinhVien) {
  $("#id_tbodySinhVien tr").remove();

  $.ajax({
    url: "../../api/sinhvien/single_read.php?maSinhVien=" + maSinhVien,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: { Authorization: jwtCookie },
    success: function (result_SV) {
      var htmlData = "";

      htmlData +=
        "<tr><td class='cell'>1</td>\
        <td class='cell'><span class='truncate'>" + result_SV.maSinhVien + "</span></td>\
        <td class='cell'>" + result_SV.hoTenSinhVien + "</td>\
        <td class='cell'>" + result_SV.ngaySinh + "</td>\
        <td class='cell'>" + result_SV.he + "</td>\
        <td class='cell'>" + result_SV.maLop + "</td>\
        <td class='cell'><button type=button' class='btn btn-info' style='color: white;' >Đặt lại mật khẩu</button></td>\
        </tr>";

      $("#id_tbodySinhVien").append(htmlData);

    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      var htmlData = "";

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

function LoadComboBoxThongTinKhoa() {
  //Load khoa
  $.ajax({
    url: "../../api/khoa/read.php",
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_Khoa) {
      $("#select_Khoa").find("option").remove();

      $("#select_Khoa").append(
        "<option selected value='tatcakhoa'>Tất cả khoa</option>"
      );

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
        text: errorMessage.responseJSON.message,
        //timer: 5000,
        timerProgressBar: true,
      });
    },
  });
}

function LoadComboBoxThongTinLopTheoKhoa(maKhoa) {
  if (maKhoa != "tatcakhoa") {
    //Load khoa
    $.ajax({
      url: "../../api/lop/read.php?maKhoa=" + maKhoa,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: false,
      headers: { Authorization: jwtCookie },
      success: function (result_Lop) {
        $("#select_Lop").find("option").remove();

        $("#select_Lop").append(
          "<option selected value='tatcalop'>Tất cả lớp</option>"
        );

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
        
        Swal.fire({
          icon: "error",
          title: "Lỗi",
          text: errorMessage.responseJSON.message,
          //timer: 5000,
          timerProgressBar: true,
        });
      },
    });
  } else {
    LoadComboBoxThongTinKhoa();
    $("#select_Lop").find("option").remove();
  }
}
