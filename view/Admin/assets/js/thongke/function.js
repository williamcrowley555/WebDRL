Chart.defaults.global.animation.duration = 2000;

var bieuDoRenLuyen;

var tableLopTitle = [
  "STT",
  "Mã lớp",
  "Tên lớp",
  "Sỉ số lớp",
  "Số lượng sinh viên đã chấm",
  "Số lượng cố vấn đã duyệt",
  "Số lượng khoa đã duyệt",
  "Tình trạng",
];

var tableSinhVienTitle = [
  "STT",
  "Mã số sinh viên",
  "Họ tên sinh viên",
  "Ngày sinh",
  "Điểm",
  "Xếp loại",
  "Sinh viên chấm",
  "Cố vấn duyệt",
  "Khoa duyệt",
];

var tableLopContent = [];
var tableSinhVienContent = [];
var tmpTableSinhVienContent = [];

var selectedClass = {};

var chartData = {
  soLuongXuatSac: 0,
  soLuongTot: 0,
  soLuongKha: 0,
  soLuongTrungBinh: 0,
  soLuongYeu: 0,
  soLuongKem: 0,
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

function LoadComboBoxThongTinKhoa_ThongKe() {
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

      $("#select_Khoa").append(
        "<option selected disabled value>--- Chọn khoa ---</option>"
      );

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

function LoadComboBoxThongTinKhoaHoc_ThongKe() {
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

      $("#select_KhoaHoc").append(
        "<option selected disabled value>--- Chọn khóa học ---</option>"
      );

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

function LoadComboBoxThongTinHocKyDanhGia_ThongKe() {
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

      $("#select_HocKyDanhGia").append(
        "<option selected disabled value>--- Chọn học kỳ đánh giá ---</option>"
      );

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

function resetChartData() {
  chartData = {
    soLuongXuatSac: 0,
    soLuongTot: 0,
    soLuongKha: 0,
    soLuongTrungBinh: 0,
    soLuongYeu: 0,
    soLuongKem: 0,
  };
}

function xepLoaiKetQuaRenLuyenCounter(data, diem) {
  if (diem >= 90 && diem <= 100) {
    data.soLuongXuatSac++;
  } else if (diem >= 80 && diem <= 89) {
    data.soLuongTot++;
  } else if (diem >= 65 && diem <= 79) {
    data.soLuongKha++;
  } else if (diem >= 50 && diem <= 64) {
    data.soLuongTrungBinh++;
  } else if (diem >= 35 && diem <= 49) {
    data.soLuongYeu++;
  } else if (diem < 35) {
    data.soLuongKem++;
  }
}

function setBarChartConfig(chartData) {
  return {
    type: "bar",
    data: {
      labels: ["Xuất sắc", "Tốt", "Khá", "Trung bình", "Yếu", "Kém"],
      datasets: [
        {
          label: "Sinh viên",
          backgroundColor: "rgba(29, 28, 229,0.8)",
          hoverBackgroundColor: "rgba(29, 28, 229,1)",
          data: [
            chartData.soLuongXuatSac,
            chartData.soLuongTot,
            chartData.soLuongKha,
            chartData.soLuongTrungBinh,
            chartData.soLuongYeu,
            chartData.soLuongKem,
          ],
        },
      ],
    },
    options: {
      responsive: true,
      legend: {
        position: "bottom",
        align: "end",
      },

      tooltips: {
        mode: "index",
        intersect: false,
        titleMarginBottom: 10,
        bodySpacing: 10,
        xPadding: 16,
        yPadding: 16,
        borderColor: "#e7e9ed",
        borderWidth: 1,
        backgroundColor: "#fff",
        bodyFontColor: "#252930",
        titleFontColor: "#252930",
        callbacks: {
          label: function (tooltipItem, data) {
            return tooltipItem.value;
          },
        },
      },
      scales: {
        xAxes: [
          {
            display: true,
            gridLines: {
              drawBorder: false,
              color: "#e7e9ed",
            },
          },
        ],
        yAxes: [
          {
            display: true,
            gridLines: {
              drawBorder: false,
              color: "#e7e9ed",
            },
            ticks: {
              beginAtZero: true,
              userCallback: function (value, index, values) {
                return value;
              },
            },
          },
        ],
      },
    },
  };
}

function initializeBarChart(element, chartData) {
  if (bieuDoRenLuyen) {
    bieuDoRenLuyen.destroy();
  }

  bieuDoRenLuyen = new Chart(
    element.getContext("2d"),
    setBarChartConfig(chartData)
  );
}

function ThongKeLop(maKhoa, maKhoaHoc, maHocKyDanhGia) {
  $("#tbodyLop tr").remove();
  var htmlData = "";

  $.ajax({
    url: urlapi_lop_read + `?maKhoa=${maKhoa}&maKhoaHoc=${maKhoaHoc}`,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: true,
    headers: { Authorization: jwtCookie },
    success: function (result) {
      $("#idPhanTrangLop").pagination({
        dataSource: result["lop"],
        pageSize: 10,
        autoHidePrevious: true,
        autoHideNext: true,

        callback: function (data, pagination) {
          var htmlData = "";
          var count = 0;

          for (let i = 0; i < data.length; i++) {
            count += 1;

            $.ajax({
              url:
                urlapi_thongkelop_read +
                `?maLop=${data[i].maLop}&maHocKyDanhGia=${maHocKyDanhGia}`,
              type: "GET",
              contentType: "application/json;charset=utf-8",
              dataType: "json",
              async: false,
              headers: { Authorization: jwtCookie },
              success: function (result_ThongKe) {
                tableLopContent.push({
                  soThuTu: data[i].soThuTu,
                  maLop: data[i].maLop,
                  tenLop: data[i].tenLop,
                  siSo: result_ThongKe.siSo,
                  sinhVienCham: result_ThongKe.sinhVienCham,
                  coVanDaDuyet: result_ThongKe.coVanDaDuyet,
                  khoaDaDuyet: result_ThongKe.khoaDaDuyet,
                });

                htmlData +=
                  "<tr>\
                                      <td class='cell'>" +
                  data[i].soThuTu +
                  "</td>\
                                      <td class='cell'><span class='truncate'>" +
                  data[i].maLop +
                  "</span></td>\
                                      <td class='cell'>" +
                  data[i].tenLop +
                  "</td>\
                                      <td class='cell'>" +
                  result_ThongKe.siSo +
                  "</td>\
                                      <td class='cell'>" +
                  result_ThongKe.sinhVienCham +
                  "/" +
                  result_ThongKe.siSo +
                  "</td>\
                                      <td class='cell'>" +
                  result_ThongKe.coVanDaDuyet +
                  "/" +
                  result_ThongKe.siSo +
                  "</td>\
                                      <td class='cell'>" +
                  result_ThongKe.khoaDaDuyet +
                  "/" +
                  result_ThongKe.siSo +
                  "</td>\
                                      <td class='cell'>" +
                  (result_ThongKe.khoaDaDuyet == result_ThongKe.siSo
                    ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Hoàn thành</span>"
                    : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Chưa hoàn thành</span>") +
                  "</td>\
                                      <td class='cell'>\
                                        <button class='btn btn-info btn_XemChiTiet' style='color: white;' data-id='" +
                  data[i].maLop +
                  "' hocKy-id='" +
                  maHocKyDanhGia +
                  "'>Xem chi tiết</button>\
                                      </td>\
                  </tr>";
              },
              error: function (error) {},
            });
          }

          $("#tbodyLop").html(htmlData);
        },
      });
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      tableLopContent = [];

      $("#idPhanTrangLop").empty();

      htmlData +=
        "<tr>\
									<td colspan='9' class='text-center'>\
										<p class='mt-4'>Không tìm thấy kết quả.</p>\
									</td>\
								</tr>";
      $("#tbodyLop").append(htmlData);

      //ThongBaoLoi(errorMessage.responseJSON.message);
    },
  });
}

function ThongKeSinhVien(maLop, maHocKyDanhGia) {
  var htmlData = "";
  $("#tabSinhVien #classInfo").empty();
  $("#tbodySinhVien tr").remove();

  $("#select_FilterColumn").val("");
  $("#select_FilterOption").empty();

  // Hiển thị thông tin lớp
  $.ajax({
    url: urlapi_lop_details_read + maLop,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result) {
      selectedClass = result;

      classInfoData = `<div class="col-md-7">
                          <p class="fw-bold">Mã lớp: <span class="fw-normal">${result.maLop}</span></p>
                          <p class="fw-bold">Tên lớp: <span class="fw-normal">${result.tenLop}</span></p>
                          <p class="fw-bold">Khoa: <span class="fw-normal">${result.maKhoa} - ${result.tenKhoa}</span></p>
                        </div>
                        <div class="col-md-5">
                          <p class="fw-bold">Cố vấn học tập: <span class="fw-normal">${result.maCoVanHocTap} - ${result.hoTenCoVan}</span></p>
                          <p class="fw-bold">Mã khóa học: <span class="fw-normal">${result.maKhoaHoc}</span></p>
                        </div>`;

      $("#tabSinhVien #classInfo").append(classInfoData);
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      classInfoData = `<div class="col-md-7">
                          <p class="fw-bold">Mã lớp: <span class="fw-normal">Không tìm thấy dữ liệu</span></p>
                          <p class="fw-bold">Tên lớp: <span class="fw-normal">Không tìm thấy dữ liệu</span></p>
                          <p class="fw-bold">Mã khoa: <span class="fw-normal">Không tìm thấy dữ liệu</span></p>
                        </div>
                        <div class="col-md-5">
                          <p class="fw-bold">Mã cố vấn học tập: <span class="fw-normal">Không tìm thấy dữ liệu</span></p>
                          <p class="fw-bold">Mã khóa học: <span class="fw-normal">Không tìm thấy dữ liệu</span></p>
                        </div>`;

      $("#tabSinhVien #classInfo").append(classInfoData);
    },
  });

  $("#tabSinhVien .hoc-ky-danh-gia").text(
    "Kết quả điểm rèn luyện " +
      $(`#select_HocKyDanhGia option[value='${maHocKyDanhGia}']`).text()
  );

  resetChartData();

  // Hiển thị danh sách sinh viên kèm kết quả đrl trong lớp
  $.ajax({
    url:
      urlapi_thongkesinhvien_read +
      `?maLop=${maLop}&maHocKyDanhGia=${maHocKyDanhGia}`,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    async: false,
    headers: { Authorization: jwtCookie },
    success: function (result) {
      tableSinhVienContent = result["sinhvien"];
      tmpTableSinhVienContent = tableSinhVienContent;
      selectedClass = { ...selectedClass, siSo: result["itemCount"] };

      $("#tabSinhVien #classInfo .col-md-5").append(
        `<p class="fw-bold">Sỉ số lớp: <span class="fw-normal">${result["itemCount"]}</span></p>`
      );

      $("#formExportKetQuaDRL .data").attr(
        "file-name",
        `ket_qua_drl_lop_${tmpTableSinhVienContent[0].maLop}_${maHocKyDanhGia}`
      );

      result["sinhvien"].forEach(function (data) {
        xepLoaiKetQuaRenLuyenCounter(chartData, Number(data.diemTongCong));
      });

      $("#idPhanTrangSinhVien").pagination({
        dataSource: result["sinhvien"],
        pageSize: 10,
        autoHidePrevious: true,
        autoHideNext: true,

        callback: function (data, pagination) {
          var htmlData = "";

          for (let i = 0; i < data.length; i++) {
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
              data[i].diemTongCong +
              "</td>\
                  <td class='cell'>" +
              data[i].xepLoai +
              "</td>\
              <td class='cell'>" +
              (data[i].sinhVienCham == "1"
                ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Đã chấm</span>"
                : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Chưa chấm</span>") +
              "</td>\
              <td class='cell'>" +
              (data[i].coVanDuyet == "1"
                ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Đã duyệt</span>"
                : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Chưa duyệt</span>") +
              "</td>\
              <td class='cell'>" +
              (data[i].khoaDuyet == "1"
                ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Đã duyệt</span>"
                : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Chưa duyệt</span>") +
              "</td>\
                </tr>";
          }

          $("#tbodySinhVien").html(htmlData);
        },
      });
    },
    error: function (errorMessage) {
      checkLoiDangNhap(errorMessage.responseJSON.message);

      tableSinhVienContent = [];
      tmpTableSinhVienContent = [];
      selectedClass = {};

      $("#tabSinhVien #classInfo .col-md-5").append(
        `<p class="fw-bold">Sỉ số lớp: <span class="fw-normal">0</span></p>`
      );

      $("#idPhanTrangSinhVien").empty();
      htmlData +=
        "<tr>\
									<td colspan='9' class='text-center'>\
										<p class='mt-4'>Không tìm thấy kết quả.</p>\
									</td>\
								</tr>";
      $("#tbodySinhVien").append(htmlData);

      ThongBaoLoi(errorMessage.responseJSON.message);
    },
  });

  initializeBarChart(document.getElementById("bieuDoRenLuyen"), chartData);
}
