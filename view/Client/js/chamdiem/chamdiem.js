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
    $('#text_HoTen').text(getCookie('hoTen'));
}

if (getCookie('maSo') != null){
    $('#text_MaSo').text(getCookie('maSo'));
}

// function lấy thông tin thông báo đánh giá, học kỳ đánh giá
function getThongTinHocKyDanhGia() {
    
    $.ajax({
        url: "../../../api/thongbaodanhgia/read.php",
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
                    var ngaySinhVienDanhGia = new Date(result[index][p].ngaySinhVienDanhGia);
                    var ngaySinhVienKetThucDanhGia = new Date(result[index][p].ngaySinhVienKetThucDanhGia);
                    var maHocKyDanhGia = result[index][p].maHocKyDanhGia;

                    //lấy ngày hiện tại
                    var today = new Date();
                    var ngayHienTai = new Date((today.getFullYear()) +"-" +(today.getMonth() +1) + "-" + (today.getDate()));

                    $.ajax({
                        url: "../../../api/hockydanhgia/single_read.php?maHocKyDanhGia=" + maHocKyDanhGia,
                        async: false,
                        type: "GET",
                        contentType: "application/json;charset=utf-8",
                        dataType: "json",
                        headers: {
                            Authorization: jwtCookie,
                        },
                        success: function (result_HKDG) {
                            if (result_HKDG != null) {
                                var maHocKyDanhGia_HKDG = result_HKDG.maHocKyDanhGia;
                                var hocKyXet_HKDG = result_HKDG.hocKyXet;
                                var namHocXet_HKDG = result_HKDG.namHocXet;

                                //trường hợp đang trong thời gian học kỳ mở chấm và ngược lại
                                if (ngayHienTai.getTime() >= ngaySinhVienDanhGia.getTime()
                                && ngayHienTai.getTime() <= ngaySinhVienKetThucDanhGia.getTime()
                                ){
                                        
                                    //kiểm tra xem có tồn tại phiếu rèn luyện chưa, nếu có = đã chấm 
                                    $.ajax({
                                        url: "../../../api/phieurenluyen/single_read.php?maHocKyDanhGia="+ maHocKyDanhGia_HKDG +"&maSinhVien=" + getCookie('maSo'),
                                        async: false,
                                        type: "GET",
                                        contentType: "application/json;charset=utf-8",
                                        dataType: "json",
                                        headers: {
                                            Authorization: jwtCookie,
                                        },
                                        success: function (resultRead) {
                                            if (resultRead != null) {
                                                $("#tbody_hocKyDanhGia").append("<tr><td><p class='fw-normal mb-1'>" + hocKyXet_HKDG + "</p></td>\
                                                    <td><p class='fw-normal mb-1'>" + namHocXet_HKDG +"</p></td>\
                                                    <td><span class='badge badge-success' style='color: black;'>Đã chấm</span></td>\
                                                    <td>\
                                                        <button type='button' class='btn btn-warning' style='color: white;'>Chấm lại</button>\
                                                    </td>\
                                                </tr>");
                                            }
                                        },
                                        error: function (errorMessage) {
                                            $("#tbody_hocKyDanhGia").append("<tr><td><p class='fw-normal mb-1'>" + hocKyXet_HKDG + "</p></td>\
                                                <td><p class='fw-normal mb-1'>" + namHocXet_HKDG +"</p></td>\
                                                <td><span class='badge badge-primary' style='color: black;'>Đang mở chấm</span></td>\
                                                <td>\
                                                    <a href='chamdiemchitiet.php?maHocKy="+ maHocKyDanhGia_HKDG +"' ><button type='button' class='btn btn-info' style='color: white;'>Chấm điểm</button></a>\
                                                </td>\
                                            </tr>");
                                        },
                                    });
                             
                                    
                                        
                                }else{
                                    $("#tbody_hocKyDanhGia").append("<tr><td><p class='fw-normal mb-1'>" + hocKyXet_HKDG + "</p></td>\
                                        <td><p class='fw-normal mb-1'>" + namHocXet_HKDG +"</p></td>\
                                        <td><span class='badge badge-success' style='color: black;'>Đã chấm</span></td>\
                                        <td>\
                                        <a href='xembangdiemrenluyen.php?"+ maHocKyDanhGia_HKDG +"' ><button type='button' class='btn btn-light' style='color: black;'> Xem chi tiết</button></a>\
                                            </td>\
                                    </tr>");
                                }

                              
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