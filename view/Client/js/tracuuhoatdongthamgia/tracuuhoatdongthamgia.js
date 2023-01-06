// const maSo = getCookie("maSo");
var jwtCookie = getCookie("jwt");
if(maSo.length == 10) { //Nếu là sinh viên
    TraCuuHoatDong(maSo);
} 
else if (maSo.length == 5) { // Nếu là cố vấn học tập
     $("#id_TraCuu").css('display','');
}

 $('#input_MSSVTraCuu').on('keypress', function(event) {
     if (event.keyCode == 13) {
         TraCuuHoatDong($(this).val());
    }
})

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

var jwtCookie = getCookie("jwt");


//------------------------------//
function TraCuuHoatDong(_input_MSSVTraCuu = '') {
    $('#tbody_hocKyDanhGia').empty();
    $('#id_KhongTimThaySinhVien').empty();

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
                    url: urlapi_thamgiahoatdong_read_MaSV + _input_MSSVTraCuu,
                    async: false,
                    type: "GET",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json",
                    headers: {
                        Authorization: jwtCookie,
                    },
                    success: function (result_ThamGiaHoatDong) {
                        $('#text_MaSo').text(_input_MSSVTraCuu);
                        $('#text_HoTen').text(hoTenSinhVien);


                        $("#id_NoiDungKetQuaTraCuu").css('display','');

                        $("#tbody_hocKyDanhGia").find('tr').remove();


                        $.each(result_ThamGiaHoatDong, function (index_tc) {
                            for (var p = 0;p < result_ThamGiaHoatDong[index_tc].length;p++) {
                                var maHoatDong = result_ThamGiaHoatDong[index_tc][p].maHoatDong;
                                
    
                                $.ajax({
                                    url: urlapi_hoatdongdanhgia_single_read + maHoatDong,
                                    async: false,
                                    type: "GET",
                                    contentType: "application/json;charset=utf-8",
                                    dataType: "json",
                                    headers: {
                                        Authorization: jwtCookie,
                                    },
                                    success: function (result_HDDG) {
                                        var tenHoatDong = result_HDDG.tenHoatDong;
                                        var diemNhanDuoc = result_HDDG.diemNhanDuoc;
                                        var diaDiemDienRaHoatDong = result_HDDG.diaDiemDienRaHoatDong;
                                        var maHocKyDanhGia = result_HDDG.maHocKyDanhGia;
                                        var thoiGianBatDauHoatDong = result_HDDG.thoiGianBatDauHoatDong;
                                        var thoiGianKetThucHoatDong = result_HDDG.thoiGianKetThucHoatDong;
                                        var maQRDiaDiem = result_HDDG.maQRDiaDiem;
                                            
                                        
                                        $.ajax({
                                            url: urlapi_hockydanhgia_single_read + maHocKyDanhGia,
                                            async: false,
                                            type: "GET",
                                            contentType: "application/json;charset=utf-8",
                                            dataType: "json",
                                            headers: {
                                                Authorization: jwtCookie,
                                            },
                                            success: function (result_HocKyDanhGia) {
                                                var hocKyXet = result_HocKyDanhGia.hocKyXet;
                                                var namHocXet = result_HocKyDanhGia.namHocXet;
                                               

                                                $("#tbody_hocKyDanhGia").append("<tr>\
                                                    <td>"+ maHoatDong +"</td>\
                                                    <td>"+ tenHoatDong +"</td>\
                                                    <td>"+ hocKyXet + " - "+ namHocXet +"</td>\
                                                    <td>"+ diemNhanDuoc +"</td>\
                                                    <td>"+ diaDiemDienRaHoatDong +"</td>\
                                                    <td>"+ thoiGianBatDauHoatDong +"</td>\
                                                    <td>"+ thoiGianKetThucHoatDong +"</td>\
                                                    <td><img src='"+ maQRDiaDiem +"' width='60px' /></td>\
                                                    <td>\
                                                        <button type='button' class='btn btn-light btn_XemChiTiet' style='color: black;width: max-content;' data-bs-toggle='modal' data-bs-target='#XemChiTietModal' data-id='"+ maHoatDong +"' data-qrimage-id='"+ maQRDiaDiem +"' > Xem chi tiết</button>\
                                                    </td>\
                                                </tr>");

                                                        
                                            },
                                            error: function (errorMessage_tc3) {
                                                thongBaoLoi(errorMessage_tc3.responseJSON.message);
                                            },
                                        });


                                                
                                    },
                                    error: function (errorMessage_tc3) {
                                        
                                        //thongBaoLoi(errorMessage_tc3.responseJSON.message);
                                    },
                                });
    
                            }
            
                        });
                    },
                    error: function (errorMessage_tc3) {
                        $("#id_NoiDungKetQuaTraCuu").css('display','none');
                        $('#id_KhongTimThaySinhVien').css('display','');
                        $('#id_KhongTimThaySinhVien').append("\
                            <h5 style=\"text-transform: uppercase\">--- Các hoạt động của sinh viên ---</h5>\
                            <p class=\"text-center\"> Không tìm thấy hoạt động tham gia của sinh viên có mã sinh viên là " + _input_MSSVTraCuu +"</p>"
                        );
                        //thongBaoInfo(errorMessage_tc3.responseJSON.message);
                    },
                });
    
            },
            error: function (errorMessage_tc3) {
                $("#id_NoiDungKetQuaTraCuu").css('display','none');
                $('#id_KhongTimThaySinhVien').css('display','');
                $('#id_KhongTimThaySinhVien').append("\
                    <h5 style=\"text-transform: uppercase\">--- Các hoạt động tham gia của sinh viên ---</h5>\
                    <p class=\"text-center\"> Không tìm thấy sinh viên có mã sinh viên là " + _input_MSSVTraCuu +"</p>"
                );
                //thongBaoInfo(errorMessage_tc3.responseJSON.message);
            },
        });
    }

    
    
}



function LoadChiTietHoatDong(maHoatDong, maQRDiaDiem) {
    
    $.ajax({
        url: urlapi_hoatdongdanhgia_single_read + maHoatDong,
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {
            Authorization: jwtCookie,
        },
        success: function (result_HoatDongDanhGia) {
            var maTieuChi2 = result_HoatDongDanhGia.maTieuChi2;
            var maTieuChi3 = result_HoatDongDanhGia.maTieuChi3;
           

            if (maTieuChi2 != 0){
                $.ajax({
                    url: urlapi_tieuchicap2_single_read + maTieuChi2,
                    async: false,
                    type: "GET",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json",
                    headers: {
                        Authorization: jwtCookie,
                    },
                    success: function (result_tc2) {
                       $('#input_TieuChiCongDiem').text(result_tc2.noidung);

                       $('#input_QRHoatDong').attr('src',maQRDiaDiem);
                                
                    },
                    error: function (errorMessage_tc3) {
                        thongBaoLoi(errorMessage_tc3.responseJSON.message);
                    },
                });
            }

            if (maTieuChi3 != 0){
                $.ajax({
                    url: urlapi_tieuchicap3_single_read + maTieuChi3,
                    async: false,
                    type: "GET",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json",
                    headers: {
                        Authorization: jwtCookie,
                    },
                    success: function (result_tc3) {
                        $('#input_TieuChiCongDiem').text(result_tc3.noidung);
                        
                        $('#input_QRHoatDong').attr('src',maQRDiaDiem);
                                
                    },
                    error: function (errorMessage_tc3) {
                        thongBaoLoi(errorMessage_tc3.responseJSON.message);
                    },
                });
            }
                    
        },
        error: function (errorMessage_tc3) {
            thongBaoLoi(errorMessage_tc3.responseJSON.message);
        },
    });


}
