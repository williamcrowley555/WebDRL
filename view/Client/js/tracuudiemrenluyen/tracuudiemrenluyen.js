//load điểm rèn luyện của sinh viên
const maSinhVien = getCookie("maSo");
var jwtCookie = getCookie("jwt");

$.ajax({
    url: urlapi_sinhvien_single_read + maSinhVien,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
        Authorization: jwtCookie,
    },
    success: function (result_SV) {
        var hoTenSinhVien = result_SV.hoTenSinhVien;

        $.ajax({
            url: urlapi_phieurenluyen_read_MaSV + maSinhVien,
            async: false,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            headers: {
                Authorization: jwtCookie,
            },
            success: function (result_TraCuu) {
                $('#text_MaSo').text(maSinhVien);
                $('#text_HoTen').text(hoTenSinhVien);

                $("#id_NoiDungKetQuaTraCuu").css('display','');

                $("#tbody_hocKyDanhGia").find('tr').remove();


                $.each(result_TraCuu, function (index_tc) {
                    for (var p = 0;p < result_TraCuu[index_tc].length;p++) {
                        var diemTongCong = result_TraCuu[index_tc][p].diemTongCong;
                        var xepLoai = result_TraCuu[index_tc][p].xepLoai;
                        var maHocKyDanhGia = result_TraCuu[index_tc][p].maHocKyDanhGia;
                        var coVanDuyet = result_TraCuu[index_tc][p].coVanDuyet;
                        var khoaDuyet = result_TraCuu[index_tc][p].khoaDuyet;

                        if (coVanDuyet == 0) {
                            covanDuyet = "<span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span>";
                        }else{
                            covanDuyet = "<span class='badge badge-success' style='color: black;font-size: inherit;'>Đã duyệt</span>";
                        }

                        if (khoaDuyet == 0) {
                            khoaDuyet = "<span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span>";
                        }else{
                            khoaDuyet = "<span class='badge badge-success' style='color: black;font-size: inherit;'>Đã duyệt</span>";
                        }

                        $.ajax({
                            url: urlapi_hockydanhgia_single_read + maHocKyDanhGia,
                            async: false,
                            type: "GET",
                            contentType: "application/json;charset=utf-8",
                            dataType: "json",
                            headers: {
                                Authorization: jwtCookie,
                            },
                            success: function (result_HKDG) {
                                var hocKyXet = result_HKDG.hocKyXet;
                                var namHocXet = result_HKDG.namHocXet;
                                    

                                $("#tbody_hocKyDanhGia").append("<tr>\
                                    <td>"+ hocKyXet +"</td>\
                                    <td>"+ namHocXet +"</td>\
                                    <td>"+ diemTongCong +"</td>\
                                    <td>"+ xepLoai +"</td>\
                                    <td>"+ covanDuyet +"</td>\
                                    <td>"+ khoaDuyet +"</td>\
                                    <td><a href='xemdiemchitiet.php?maHocKy="+ maHocKyDanhGia +"&maSinhVien="+ maSinhVien +"' ><button type='button' class='btn btn-light' style='color: black;'> Xem chi tiết</button></a>\</td>\
                                </tr>");
                            
                                    
                                        
                            },
                            error: function (errorMessage_tc3) {
                                thongBaoLoi(errorMessage_tc3.responseJSON.message);
                            },
                        });

                    }
    
                });
            },
            error: function (errorMessage_tc3) {
                thongBaoInfo(errorMessage_tc3.responseJSON.message);
            },
        });

    },
    error: function (errorMessage_tc3) {
        thongBaoInfo(errorMessage_tc3.responseJSON.message);
    },
});


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

function thongBaoInfo(message){
    Swal.fire({
      icon: "info",
      title: "Thông báo",
      text: message,
      //timer: 5000,
      timerProgressBar: true,
    });
}

//------------------------------//
function TraCuuDiemRenLuyen() {
    var _input_MSSVTraCuu = $('#input_MSSVTraCuu').val();

    if (_input_MSSVTraCuu == ''){
        thongBaoLoi('Vui lòng nhập mã số sinh viên!');
    }else{
        $.ajax({
            url: urlapi_sinhvien_single_read + _input_MSSVTraCuu,
            async: false,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            headers: {
                Authorization: jwtCookie,
            },
            success: function (result_SV) {
                var hoTenSinhVien = result_SV.hoTenSinhVien;

                $.ajax({
                    url: urlapi_phieurenluyen_read_MaSV + _input_MSSVTraCuu,
                    async: false,
                    type: "GET",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json",
                    headers: {
                        Authorization: jwtCookie,
                    },
                    success: function (result_TraCuu) {
                        $('#text_MaSo').text(_input_MSSVTraCuu);
                        $('#text_HoTen').text(hoTenSinhVien);

                        $("#id_NoiDungKetQuaTraCuu").css('display','');

                        $("#tbody_hocKyDanhGia").find('tr').remove();


                        $.each(result_TraCuu, function (index_tc) {
                            for (var p = 0;p < result_TraCuu[index_tc].length;p++) {
                                var diemTongCong = result_TraCuu[index_tc][p].diemTongCong;
                                var xepLoai = result_TraCuu[index_tc][p].xepLoai;
                                var maHocKyDanhGia = result_TraCuu[index_tc][p].maHocKyDanhGia;
                                var coVanDuyet = result_TraCuu[index_tc][p].coVanDuyet;
                                var khoaDuyet = result_TraCuu[index_tc][p].khoaDuyet;

                                if (coVanDuyet == 0) {
                                    covanDuyet = "<span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span>";
                                }else{
                                    covanDuyet = "<span class='badge badge-success' style='color: black;font-size: inherit;'>Đã duyệt</span>";
                                }

                                if (khoaDuyet == 0) {
                                    khoaDuyet = "<span class='badge badge-warning' style='color: black;font-size: inherit;'>Chưa duyệt</span>";
                                }else{
                                    khoaDuyet = "<span class='badge badge-success' style='color: black;font-size: inherit;'>Đã duyệt</span>";
                                }
    
                                $.ajax({
                                    url: urlapi_hockydanhgia_single_read + maHocKyDanhGia,
                                    async: false,
                                    type: "GET",
                                    contentType: "application/json;charset=utf-8",
                                    dataType: "json",
                                    headers: {
                                        Authorization: jwtCookie,
                                    },
                                    success: function (result_HKDG) {
                                        var hocKyXet = result_HKDG.hocKyXet;
                                        var namHocXet = result_HKDG.namHocXet;
                                            

                                        $("#tbody_hocKyDanhGia").append("<tr>\
                                            <td>"+ hocKyXet +"</td>\
                                            <td>"+ namHocXet +"</td>\
                                            <td>"+ diemTongCong +"</td>\
                                            <td>"+ xepLoai +"</td>\
                                            <td>"+ covanDuyet +"</td>\
                                            <td>"+ khoaDuyet +"</td>\
                                            <td><a href='xemdiemchitiet.php?maHocKy="+ maHocKyDanhGia +"&maSinhVien="+ _input_MSSVTraCuu +"' ><button type='button' class='btn btn-light' style='color: black;'> Xem chi tiết</button></a>\</td>\
                                        </tr>");
                                    
                                            
                                                
                                    },
                                    error: function (errorMessage_tc3) {
                                        thongBaoLoi(errorMessage_tc3.responseJSON.message);
                                    },
                                });
    
                            }
            
                        });
                    },
                    error: function (errorMessage_tc3) {
                        thongBaoInfo(errorMessage_tc3.responseJSON.message);
                    },
                });
    
            },
            error: function (errorMessage_tc3) {
                thongBaoInfo(errorMessage_tc3.responseJSON.message);
            },
        });
    }

    function TraCuuDiemRenLuyen2() {
        
        
    }


    

    
}