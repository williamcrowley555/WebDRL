var tableTitle = [
  "STT",
  "Mã chức năng",
  "Tên chức năng",
  "Trạng thái",
  "Mô tả",
];

var tableContent = [];

var quyenChucNang = [
    {
        maQuyen: "sinhvien",
        tenQuyen: "Sinh viên",
        maChucNang: [
            CHUC_NANG_CHAM_DIEM_REN_LUYEN,
            CHUC_NANG_KHIEU_NAI_DIEM_REN_LUYEN,
            CHUC_NANG_NHAP_DIEM_HE_4
        ]
    },
    {
        maQuyen: "cvht",
        tenQuyen: "Cố vấn học tập",
        maChucNang: [
            CHUC_NANG_CHAM_DIEM_REN_LUYEN,
            CHUC_NANG_NHAP_DIEM_HE_4
        ]
    },
    {
        maQuyen: "khoa",
        tenQuyen: "Khoa",
        maChucNang: [
            CHUC_NANG_CHAM_DIEM_REN_LUYEN
        ]
    },
    {
        maQuyen: "lop",
        tenQuyen: "Lớp",
        maChucNang: [
            CHUC_NANG_NHAP_DIEM_HE_4
        ]
    }
];

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

//Chức năng//
function GetListChucNang() {
  $("#id_tbodyChucNang tr").remove();

  $.ajax({
    url: urlapi_chucnang_read,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: true,
    headers: { Authorization: jwtCookie },
    success: function (result) {
      tableContent = result["chucNang"];

      $("#idPhanTrang").pagination({
        dataSource: result["chucNang"],
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
              data[i].maChucNang +
              "</span></td>\
                                  <td class='cell'>" +
              data[i].tenChucNang +
              "</td>\
                                  <td class='cell'>" +
              (data[i].kichHoat == 1
                ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Kích hoạt</span>"
                : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Vô hiệu hóa</span>") +
              "</td>\
                                  <td class='cell'>" +
              data[i].moTa +
              "</td>\
                                  <td class='cell'>\
                                    <button class='btn bg-info btn_Custom_ChucNang' style='color: white;' data-bs-toggle='modal' data-bs-target='#CustomFunctionalityModal' data-id = '" +
              data[i].maChucNang +
              "' >Tùy chỉnh</button>\
                                  </td>\
                                </tr>";
          }

          $("#id_tbodyChucNang").html(htmlData);
        },
      });
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      tableContent = [];

      $("#idPhanTrang").empty();

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

function LoadComboBoxThongTinHocKyDanhGia_CaiDat() {
  $("#custom_select_HocKyDanhGia").find("option").remove();

  //Load Quyen
  $.ajax({
    url: urlapi_hockydanhgia_read,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result) {
      $.each(result, function (index) {
        for (var p = 0; p < result[index].length; p++) {
          $("#custom_select_HocKyDanhGia").append(
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
    },
  });
}

function LoadComboBoxThongTinQuyen_CaiDat(maChucNang) {
    $("#custom_select_Quyen").find("option").remove();

  //Load Quyen
    var options = quyenChucNang.reduce(function(filtered, quyen) {
        if (quyen.maChucNang.includes(parseInt(maChucNang))) {
            filtered.push({label: quyen.tenQuyen, value: quyen.maQuyen});
        }
        return filtered;
    }, []);

    document.querySelector('#custom_select_Quyen').setOptions(options);
}

function LoadThongTinTuyChinh_ChucNang(maChucNang) {
  $.ajax({
    url: urlapi_chucnang_single_read_maChucNang + maChucNang,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result_data) {
      $("#custom_input_TenChucNang").val(result_data.tenChucNang);
      $("#custom_check_active").prop(
        "checked",
        result_data.kichHoat == 0 ? false : true
      );

      var custom_select_HocKyDanhGia = document.getElementById(
        "custom_select_HocKyDanhGia"
      );

      $.ajax({
        url:
          urlapi_chucnang_hockydanhgia_details_read +
          `?maChucNang=${maChucNang}`,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_HKDG) {
          var selectedHKDG = result_HKDG["chucnang_hockydanhgia"].map(function (
            HKDG
          ) {
            return HKDG.maHocKyDanhGia;
          });

          document
            .getElementById("custom_select_HocKyDanhGia")
            .setValue(selectedHKDG);
        },
        error: function (errorMessage_HKDG) {
          document.getElementById("custom_select_HocKyDanhGia").setValue([]);
        },
      });

      $.ajax({
        url: urlapi_chucnang_quyen_details_read + `?maChucNang=${maChucNang}`,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_Quyen) {
          var selectedQuyen = result_Quyen["chucnang_quyen"].map(function (
            quyen
          ) {
            return quyen.maQuyen;
          });

          document
            .getElementById("custom_select_Quyen")
            .setValue(selectedQuyen);
        },
        error: function (errorMessage_Quyen) {
          document.getElementById("custom_select_Quyen").setValue([]);
        },
      });
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      ThongBaoLoi(errorMessage.responseJSON.message);

      $("#CustomFunctionalityModal").modal("hide");
    },
  });
}

function TuyChinh_ChucNang() {
  var _custom_input_MaChucNang = $("#custom_input_MaChucNang").val();
  var _custom_select_HocKyDanhGia = $("#custom_select_HocKyDanhGia").val();
  var _custom_select_Quyen = $("#custom_select_Quyen").val();
  var _custom_check_active = $("#custom_check_active").prop("checked")
    ? "1"
    : "0";

  var dataPost = {
    maChucNang: _custom_input_MaChucNang,
    kichHoat: _custom_check_active,
  };

  $.ajax({
    url: urlapi_chucnang_update_kichHoat,
    type: "POST",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    data: JSON.stringify(dataPost),
    async: false,
    headers: { Authorization: jwtCookie },
    success: function () {
      // Cập nhật học kỳ - năm học áp dụng của chức năng
      dataPost = {
        maChucNang: _custom_input_MaChucNang,
        maHocKyDanhGia: _custom_select_HocKyDanhGia,
      };

      $.ajax({
        url: urlapi_chucnang_hockydanhgia_update,
        type: "POST",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        data: JSON.stringify(dataPost),
        async: false,
        headers: { Authorization: jwtCookie },
        success: function () {
          // Cập nhật đối tượng áp dụng của chức năng
          dataPost = {
            maChucNang: _custom_input_MaChucNang,
            maQuyen: _custom_select_Quyen,
          };

          $.ajax({
            url: urlapi_chucnang_quyen_update,
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            data: JSON.stringify(dataPost),
            async: false,
            headers: { Authorization: jwtCookie },
            success: function () {
              Swal.fire({
                icon: "success",
                title:
                  "Chỉnh sửa thành công chức năng mã " +
                  _custom_input_MaChucNang +
                  "!",
                text: "",
                timer: 2000,
                timerProgressBar: true,
              });

              $("#CustomFunctionalityModal").modal("hide");
            },
            error: function (errorMessage_CN_Q) {
              console.log(errorMessage_CN_Q.responseText);
              checkLoiDangNhap(errorMessage_CN_Q.responseJSON.message);

              ThongBaoLoi(errorMessage_CN_Q.responseJSON.message);
            },
          });
        },
        error: function (errorMessage_CN_HKDG) {
          console.log(errorMessage_CN_HKDG.responseText);
          checkLoiDangNhap(errorMessage_CN_HKDG.responseJSON.message);

          ThongBaoLoi(errorMessage_CN_HKDG.responseJSON.message);
        },
      });
    },
    error: function (errorMessage_CN) {
      checkLoiDangNhap(errorMessage_CN.responseJSON.message);

      ThongBaoLoi(errorMessage_CN.responseJSON.message);
    },
  });

  setTimeout(() => {
    GetListChucNang();
  }, 2000);
}
