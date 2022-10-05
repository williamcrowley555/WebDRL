//load điểm rèn luyện của sinh viên
const maSo = getCookie("maSo");
var jwtCookie = getCookie("jwt");
if(maSo.length == 10) { //Nếu là sinh viên
    //var _input_MSSVTraCuu = $('#input_MSSVTraCuu').val();
    //console.log("MSSV: " + _input_MSSVTraCuu);
    TraCuuDiemRenLuyen(maSo);
} 
else if (maSo.length == 5) { // Nếu là cố vấn học tập
    $("#id_TraCuu").css('display','');
}

$('#input_MSSVTraCuu').on('keypress', function(event) {
    if (event.keyCode == 13) {
        TraCuuDiemRenLuyen($(this).val());
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

//------------------------------//
function TraCuuDiemRenLuyen(_input_MSSVTraCuu = '') {
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
                                        console.log("Loi thu 1");
                                        thongBaoLoi(errorMessage_tc3.responseJSON.message);
                                    },
                                });
    
                            }
            
                        });
                    },
                    error: function (errorMessage_tc3) {
                        $("#id_NoiDungKetQuaTraCuu").css('display','none');
                        $('#id_KhongTimThaySinhVien').css('display','');
                        $('#id_KhongTimThaySinhVien').append("\
                            <h5 style=\"text-transform: uppercase\">--- Các phiếu điểm rèn luyện của sinh viên ---</h5>\
                            <p class=\"text-center\"> Không tìm thấy phiếu điểm rèn luyện của sinh viên có mã sinh viên là " + _input_MSSVTraCuu +"</p>"
                        );
                    },
                });
    
            },
            error: function (errorMessage_tc3) {
                $("#id_NoiDungKetQuaTraCuu").css('display','none');
                $('#id_KhongTimThaySinhVien').css('display','');
                $('#id_KhongTimThaySinhVien').append("\
                    <h5 style=\"text-transform: uppercase\">--- Các phiếu điểm rèn luyện của sinh viên ---</h5>\
                    <p class=\"text-center\"> Không tìm thấy sinh viên có mã sinh viên là " + _input_MSSVTraCuu +"</p>"
                );
            },
        });
    }
}