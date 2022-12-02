var tableTitle = [
  "STT",
  "Mã cố vấn học tập",
  "Họ tên cố vấn",
  "Số điện thoại",
  "Email",
  "Mã khoa",
];

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

function checkLoiDangNhap(message) {
  if (message.localeCompare("Vui lòng đăng nhập trước!") == 0) {
    deleteAllCookies();
    location.href = "login.php";
  }
}

function ThongBaoLoi(message) {
  Swal.fire({
    icon: "error",
    title: "Lỗi",
    text: message,
    timer: 5000,
    timerProgressBar: true,
    showCloseButton: true,
  });
}

var jwtCookie = getCookie("jwt");

//Cố vấn học tập//
function GetListCVHT(maKhoa) {
  var htmlData = "";
  if (getCookie("jwt") != null) {
    $("#id_tbodyData tr").remove();

    if (maKhoa != null) {
      if (maKhoa == "tatcakhoa") {
        $.ajax({
          url: urlapi_covanhoctap_read,
          type: "GET",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          async: false,
          headers: { Authorization: jwtCookie },
          success: function (result) {
            tableContent = result["covanhoctap"];

            $("#idPhanTrang").pagination({
              dataSource: result["covanhoctap"],
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
                    data[i].maCoVanHocTap +
                    "</span></td>\
                                    <td class='cell'>" +
                    data[i].hoTenCoVan +
                    "</td>\
                                    <td class='cell'>" +
                    data[i].soDienThoai +
                    "</td>\
                                    <td class='cell'>" +
                    data[i].email +
                    "</td>\
                                    <td class='cell'>" +
                    data[i].maKhoa +
                    "</td>\
                                    <td class='cell'><button type=button' class='btn btn-info btn_DatLaiMatKhau_CVHT' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white;' data-id='" +
                    data[i].maCoVanHocTap +
                    "' >Đặt lại mật khẩu</button></td>\
                            <td class='cell'>\
                            <button class='btn bg-warning btn_ChinhSua_CVHT' style='color: white;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                    data[i].maCoVanHocTap +
                    "' >Chỉnh sửa</button>\
                          </td>\
                                    </tr>";
                }

                $("#id_tbodyData").html(htmlData);
              },
            });
          },
          error: function (errorMessage) {
            checkLoiDangNhap(errorMessage.responseJSON.message);

            tableContent = [];
            $("#idPhanTrang").empty();
            htmlData += "<tr>\
                            <td colspan='7' class='text-center'>\
                                <p class='mt-4'>Không tìm thấy kết quả.</p>\
                            </td>\
                        </tr>"
            $("#id_tbodyData").append(htmlData);
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
        $.ajax({
          url: urlapi_cvht_read_maKhoa + maKhoa,
          type: "GET",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          async: false,
          headers: { Authorization: jwtCookie },
          success: function (result) {
            tableContent = result["covanhoctap"];

            $("#idPhanTrang").pagination({
              dataSource: result["covanhoctap"],
              pageSize: 10,
              autoHidePrevious: true,
              autoHideNext: true,

              callback: function (data, pagination) {
                var htmlData = "";
                var count = 0;

                for (let i = 0; i < data.length; i++) {
                  count += 1;

                  htmlData +=
                    "<tr>\
                                    <td class='cell'>" +
                    data[i].soThuTu +
                    "</td>\
                                    <td class='cell'><span class='truncate'>" +
                    data[i].maCoVanHocTap +
                    "</span></td>\
                                    <td class='cell'>" +
                    data[i].hoTenCoVan +
                    "</td>\
                                    <td class='cell'>" +
                    data[i].soDienThoai +
                    "</td>\
                                    <td class='cell'>" +
                    data[i].email +
                    "</td>\
                                    <td class='cell'><button type=button' class='btn btn-info btn_DatLaiMatKhau_CVHT' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white;' data-id='" +
                    data[i].maCoVanHocTap +
                    "' >Đặt lại mật khẩu</button></td>\
                            <td class='cell'>\
                            <button class='btn bg-warning btn_ChinhSua_CVHT' style='color: white;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                    data[i].maCoVanHocTap +
                    "' >Chỉnh sửa</button>\
                          </td>\
                                    </tr>";
                }

                $("#id_tbodyData").html(htmlData);
              },
            });
          },
          error: function (errorMessage) {
            checkLoiDangNhap(errorMessage.responseJSON.message);

            tableContent = [];
            $("#idPhanTrang").empty();
            htmlData += "<tr>\
                            <td colspan='7' class='text-center'>\
                                <p class='mt-4'>Không tìm thấy kết quả.</p>\
                            </td>\
                        </tr>"
            $("#id_tbodyData").append(htmlData);
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

function TimKiemCoVanHocTap(maCVHT) {
  $("#id_tbodyData tr").remove();
  $.ajax({
    url: urlapi_cvht_read_maCVHT + maCVHT,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: { Authorization: jwtCookie },
    success: function (result) {
      tableContent = result["covanhoctap"];

      $("#idPhanTrang").pagination({
        dataSource: result["covanhoctap"],
        pageSize: 10,
        autoHidePrevious: true,
        autoHideNext: true,

        callback: function (data, pagination) {
          var htmlData = "";
          var count = 0;

          for (let i = 0; i < data.length; i++) {
            count += 1;

            htmlData +=
              "<tr>\
                              <td class='cell'>" +
              data[i].soThuTu +
              "</td>\
                              <td class='cell'><span class='truncate'>" +
              data[i].maCoVanHocTap +
              "</span></td>\
                              <td class='cell'>" +
              data[i].hoTenCoVan +
              "</td>\
                              <td class='cell'>" +
              data[i].soDienThoai +
              "</td>\
                              <td class='cell'>" +
              data[i].email +
              "</td>\
                              <td class='cell'>" +
              data[i].maKhoa +
              "</td>\
                              <td class='cell'><button type=button' class='btn btn-info btn_DatLaiMatKhau_CVHT' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white;' data-id='" +
              data[i].maCoVanHocTap +
              "' >Đặt lại mật khẩu</button></td>\
                      <td class='cell'>\
                      <button class='btn bg-warning btn_ChinhSua_CVHT' style='color: white;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
              data[i].maCoVanHocTap +
              "' >Chỉnh sửa</button>\
                    </td>\
                              </tr>";
          }

          $("#id_tbodyData").html(htmlData);
        },
      });
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      tableContent = [];
      var htmlData = "";
      $("#id_tbodyData").html(htmlData);
      $("#idPhanTrang").empty();
      htmlData += "<tr>\
                      <td colspan='7' class='text-center'>\
                          <p class='mt-4'>Không tìm thấy kết quả.</p>\
                      </td>\
                  </tr>"
      $("#id_tbodyData").append(htmlData);

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

function LoadComboBoxThongTinKhoa_CVHT() {
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
      $("#select_Khoa_Add").find("option").remove();
      $("#select_Khoa_Edit").find("option").remove();
      $("#select_khoa_import").find("option").remove();

      if (getCookie("quyen") == "admin" || getCookie("quyen") == "ctsv") {
        $("#select_Khoa").append(
          "<option selected value='tatcakhoa'>Tất cả khoa</option>"
        );
      }

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

            $("#select_Khoa_Add").append(
              "<option value='" +
                result_Khoa[index_Khoa][p].maKhoa +
                "'>" +
                result_Khoa[index_Khoa][p].tenKhoa +
                "</option>"
            );

            $("#select_Khoa_Edit").append(
              "<option value='" +
                result_Khoa[index_Khoa][p].maKhoa +
                "'>" +
                result_Khoa[index_Khoa][p].tenKhoa +
                "</option>"
            );

            $("#select_khoa_import").append(
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

              $("#select_Khoa_Add").append(
                "<option value='" +
                  result_Khoa[index_Khoa][p].maKhoa +
                  "'>" +
                  result_Khoa[index_Khoa][p].tenKhoa +
                  "</option>"
              );

              $("#select_Khoa_Edit").append(
                "<option value='" +
                  result_Khoa[index_Khoa][p].maKhoa +
                  "'>" +
                  result_Khoa[index_Khoa][p].tenKhoa +
                  "</option>"
              );

              $("#select_khoa_import").append(
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

      tableContent = [];
      var htmlData = "";
      $("#id_tbodyData").html(htmlData);
      $("#idPhanTrang").empty();
    },
  });
}

function ThemCVHT() {
  if (getCookie("jwt") != null) {
    var _inputMaCoVanHocTap = $("#inputMaCoVanHocTap").val();
    var _inputTenCoVanHocTap = $("#inputTenCoVanHocTap").val();
    var _inputSoDienThoai = $("#inputSoDienThoai").val();
    var _select_Khoa_Add = $("#select_Khoa_Add option:selected").val();
    var _inputMatKhauMoi = $("#inputMatKhauMoi").val();
    var _inputNhapLaiMatKhau = $("#inputNhapLaiMatKhau").val();

    if (
      _inputMaCoVanHocTap == "" ||
      _inputTenCoVanHocTap == "" ||
      _inputSoDienThoai == "" ||
      _inputMatKhauMoi == "" ||
      _inputNhapLaiMatKhau == ""
    ) {
      Swal.fire({
        icon: "error",
        title: "Lỗi",
        text: "Vui lòng nhập đầy đủ thông tin!",
        timer: 5000,
        timerProgressBar: true,
        showCloseButton: true,
      });
    } else {
      if (_inputMatKhauMoi != _inputNhapLaiMatKhau) {
        Swal.fire({
          icon: "error",
          title: "Lỗi",
          text: "Mật khẩu và xác nhận mật khẩu phải giống nhau!",
          timer: 5000,
          timerProgressBar: true,
          showCloseButton: true,
        });
      } else {
        var postData = {
          maCoVanHocTap: _inputMaCoVanHocTap,
          hoTenCoVan: _inputTenCoVanHocTap,
          soDienThoai: _inputSoDienThoai,
          maKhoa: _select_Khoa_Add,
          matKhauTaiKhoanCoVan: _inputMatKhauMoi,
        };

        $.ajax({
          url: urlapi_covanhoctap_create,
          type: "POST",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          async: true,
          headers: { Authorization: jwtCookie },
          data: JSON.stringify(postData),
          success: function (result) {
            Swal.fire({
              icon: "success",
              title: "Thêm thành công",
              text: result.responseText,
              timer: 2000,
              timerProgressBar: true,
            });

            //ẩn modal thêm
            $("#AddModal").modal("toggle");

            //reset các input
            $("#inputMaCoVanHocTap").val("");
            $("#inputTenCoVanHocTap").val("");
            $("#inputSoDienThoai").val("");
            $("#inputMatKhauMoi").val("");
            $("#inputNhapLaiMatKhau").val("");

            //load lại danh sách
            GetListCVHT($("#select_Khoa").val());
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
          statusCode: {
            403: function (xhr) {},
          },
        });
      }
    }
  }
}

function DatLaiMatKhau_CVHT() {
  var maCoVanHocTap_Update = $("#input_CoVanHocTap_Update").val();

  var _input_MatKhauMoi = $("#input_MatKhauMoi").val();
  var _input_NhapLaiMatKhauMoi = $("#input_NhapLaiMatKhauMoi").val();

  if (_input_MatKhauMoi == "" || _input_NhapLaiMatKhauMoi == "") {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {
    if (_input_MatKhauMoi != _input_NhapLaiMatKhauMoi) {
      ThongBaoLoi("Nhập lại mật khẩu không khớp với mật khẩu! Mời nhập lại!");
    } else {
      $.ajax({
        url: urlapi_covanhoctap_single_read + maCoVanHocTap_Update,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_SV) {
          var _input_MaCoVanHocTap = result_SV.maCoVanHocTap;
          var _input_HoTenCoVan = result_SV.hoTenCoVan;
          var _input_SoDienThoai = result_SV.soDienThoai;
          var _input_email = result_SV.email;
          var _input_maKhoa = result_SV.maKhoa;

          var dataPost_Update = {
            maCoVanHocTap: _input_MaCoVanHocTap,
            hoTenCoVan: _input_HoTenCoVan,
            soDienThoai: _input_SoDienThoai,
            email: _input_email,
            matKhauTaiKhoanCoVan: _input_MatKhauMoi,
            maKhoa: _input_maKhoa,
          };

          $.ajax({
            url: urlapi_covanhoctap_update,
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
                title:
                  "Đặt lại mật khẩu thành công Cố vấn học tập mã " +
                  _input_MaCoVanHocTap +
                  "!",
                text: "",
                timer: 2000,
                timerProgressBar: true,
              });


              setTimeout(() => {
                GetListCVHT("tatcakhoa");
              }, 2000);

              $("#input_MatKhauMoi").val("");
              $("#input_NhapLaiMatKhauMoi").val("");

              $.ajax({
                url: urlapi_logout_client,
                data: JSON.stringify({ maSo: _input_MaCoVanHocTap }),
                type: "POST",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                async: false,
                success: function (result) {console.log("thanh cong");},
                error: function (errorMessage) {console.log("that bai");},
              });
            },
            error: function (errorMessage) {
              checkLoiDangNhap(errorMessage.responseJSON.message);
            },
          });
        },
        error: function (errorMessage) {
          checkLoiDangNhap(errorMessage.responseJSON.message);
        },
      });
    }
  }
}

function LoadThongTinChinhSua_CVHT(maCVHT) {
  $.ajax({
    url: urlapi_cvht_single_read + maCVHT,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_data) {
      $("#edit_input_TenCVHT").val(result_data.hoTenCoVan);
      $("#edit_input_sdt").val(result_data.soDienThoai);
      $("#edit_input_email").val(result_data.email);

      var select_Khoa_Edit = document.getElementById("select_Khoa_Edit");
      for (var i = 0; i < select_Khoa_Edit.options.length; i++) {
        if (select_Khoa_Edit.options[i].value === result_data.maKhoa) {
          select_Khoa_Edit.options[i].selected = true;
        }
      }
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

function ChinhSua_CVHT() {
  var edit_input_MaCVHT = $("#edit_input_MaCVHT").val().trim();
  var edit_input_TenCVHT = $("#edit_input_TenCVHT").val().trim();
  var edit_input_sdt = $("#edit_input_sdt").val().trim();
  var edit_input_email = $("#edit_input_email").val().trim();
  var _select_Khoa_Edit = $("#select_Khoa_Edit option:selected").val().trim();

  if (
    edit_input_MaCVHT == "" ||
    edit_input_TenCVHT == "" ||
    edit_input_sdt == "" ||
    edit_input_email == ""
  ) {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {
    var dataPost = {
      maCoVanHocTap: edit_input_MaCVHT,
      hoTenCoVan: edit_input_TenCVHT,
      soDienThoai: edit_input_sdt,
      email: edit_input_email,
      maKhoa: _select_Khoa_Edit,
    };

    console.log(dataPost);

    $.ajax({
      url: urlapi_covanhoctap_update,
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
            "Chỉnh sửa thành công Cố vấn học tập mã " + edit_input_MaCVHT + "!",
          text: "",
          timer: 2000,
          timerProgressBar: true,
        });

        setTimeout(() => {
          GetListCVHT($("#select_Khoa").val());
        }, 2000);
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
