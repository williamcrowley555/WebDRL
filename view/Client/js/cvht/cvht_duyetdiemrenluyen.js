//helpers
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

function thongBaoLoi(message){
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: message,
      //timer: 5000,
      timerProgressBar: true,
    });
}

var jwtCookie = getCookie("jwt");



//set họ tên và mã số từ cookie
if (getCookie('hoTen') != null){
    var hoTen = getCookie('hoTen');
    $('#text_HoTen').text(getCookie('hoTen'));
}

if (getCookie('maSo') != null){
    var maSo = getCookie('maSo');
    $('#text_MaSo').text(getCookie('maSo'));
}




//--------------------------------//
// function lấy thông tin thông báo đánh giá, học kỳ đánh giá
function getThongTinLopCoVan() {
    
    $.ajax({
        url: "../../../api/lop/read.php?maCoVanHocTap=" + maSo,
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {
            Authorization: jwtCookie,
        },
        success: function (result) {
            $.each(result, function (index) {
                for (var p = 0;p < result[index].length;p++) {
                    var maKhoa = result[index][p].maKhoa;
                    var maLop = result[index][p].maLop;
                    var tenLop = result[index][p].tenLop;
                    var maKhoaHoc = result[index][p].maKhoaHoc;
                    
                    $.ajax({
                        url: "../../../api/khoa/single_read.php?maKhoa=" + maKhoa,
                        async: false,
                        type: "GET",
                        contentType: "application/json;charset=utf-8",
                        dataType: "json",
                        headers: {
                            Authorization: jwtCookie,
                        },
                        success: function (result_Khoa) {
                            if (result_Khoa != null) {
                                var tenKhoa = result_Khoa.tenKhoa;
                               
                                $("#tbody_DanhSachLop").append("<tr>\
                                    <td>"+ result[index][p].soThuTu +"</td>\
                                    <td><p class='fw-normal mb-1'>" + maLop + "</p></td>\
                                    <td><p class='fw-normal mb-1'>" + tenLop +"</p></td>\
                                    <td><p class='fw-normal mb-1'>" + maKhoaHoc +"</p></td>\
                                    <td><p class='fw-normal mb-1'>" + tenKhoa +"</p></td>\
                                    <td>\
                                        <a href='cvht_danhsachsinhvien.php?maLop="+ maLop +"' ><button type='button' class='btn btn-light' style='color: black;'>Xem danh sách</button></a>\
                                    </td>\
                                </tr>");
                                    
                               
                            }
                                    
                           
                        },
                        error: function (errorMessage) {
                          thongBaoLoi(errorMessage.responseText);
                        },
                    });

            
                }
            });
        },
        error: function (errorMessage) {
          thongBaoLoi(errorMessage.responseText);
        },
    });

}

