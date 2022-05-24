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


//------------------------------//
function TraCuuDiemRenLuyen() {
    var _input_MSSVTraCuu = $('#input_MSSVTraCuu').val();

    if (_input_MSSVTraCuu == ''){
        thongBaoLoi('Vui lòng nhập mã số sinh viên!');
    }else{
        $.ajax({
            url: "../../../api/sinhvien/single_read.php?maSinhVien=" + _input_MSSVTraCuu,
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
                    url: "../../../api/phieurenluyen/read.php?maSinhVien=" + _input_MSSVTraCuu,
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
                                        var hocKyXet = result_HKDG.hocKyXet;
                                        var namHocXet = result_HKDG.namHocXet;
                                            

                                        $("#tbody_hocKyDanhGia").append("<tr>\
                                            <td>"+ hocKyXet +"</td>\
                                            <td>"+ namHocXet +"</td>\
                                            <td>"+ diemTongCong +"</td>\
                                            <td>"+ xepLoai +"</td>\
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
                        thongBaoLoi(errorMessage_tc3.responseJSON.message);
                    },
                });
    
            },
            error: function (errorMessage_tc3) {
              thongBaoLoi(errorMessage_tc3.responseJSON.message);
            },
        });
    }

    


    

    
}