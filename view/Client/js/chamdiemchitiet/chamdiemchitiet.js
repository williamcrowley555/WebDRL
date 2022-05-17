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

var jwtCookie = getCookie('jwt');


//Show tiêu chí đánh giá
function getTieuChiDanhGia(){

    //Ajax tieuchicap1
    $.ajax({
        url: "../../../api/tieuchicap1/read.php",
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {
            'Authorization': jwtCookie
        },
        success: function(result) {

            $.each(result, function(index) {

                for (var i = 0;i < result[index].length;i++){
                    //console.log(result[index][i].noidung);

                    $('#tbody_noiDungDanhGia').append("<tr>\
                            <td style='font-weight: bold;'>" + result[index][i].noidung + "</td>\
                            <td></td>\
                            <td></td>\
                            <td></td>\
                        </tr>");

                    //Ajax tieuchicap2
                    $.ajax({
                        url: "../../../api/tieuchicap2/read.php",
                        async: false,
                        type: "GET",
                        contentType: "application/json;charset=utf-8",
                        dataType: "json",
                        headers: {
                            'Authorization': jwtCookie
                        },
                        success: function(result_tc2) {
                        $.each(result_tc2, function(index_tc2){
                                
                                for (var k = 0;k < result_tc2[index_tc2].length;k++){
                                    if ((result[index][i].matc1) === (result_tc2[index_tc2][k].matc1)){
                                        //console.log(result_tc2[index_tc2][k].noidung);

                                        if ((result_tc2[index_tc2][k].diemtoida) != 0){
                                            $('#tbody_noiDungDanhGia').append("<tr>\
                                                <td><em>" + result_tc2[index_tc2][k].noidung + "</em></td>\
                                                <td><em>"+ result_tc2[index_tc2][k].diemtoida +"đ</em></td>\
                                                <td><input type='text' id='form12' /></td>\
                                                <td><input type='text' id='form12' disabled /></td>\
                                                <td><input type='text' id='form12' disabled /></td>\
                                            </tr>");
                                        }else{
                                            $('#tbody_noiDungDanhGia').append("<tr>\
                                                <td><em>" + result_tc2[index_tc2][k].noidung + "</em></td>\
                                                <td></td>\
                                                <td></td>\
                                                <td></td>\
                                            </tr>");
                                        }
                                        
                                        
                                        //Ajax tieuchicap3
                                        $.ajax({
                                            url: "../../../api/tieuchicap3/read.php",
                                            async: false,
                                            type: "GET",
                                            contentType: "application/json;charset=utf-8",
                                            dataType: "json",
                                            headers: {
                                                'Authorization': jwtCookie
                                            },
                                            success: function(result_tc3) {
                                                $.each(result_tc3, function(index_tc3){
                                                    for (var p = 0;p < result_tc3[index_tc3].length;p++){
                                                        if ((result_tc2[index_tc2][k].matc2) === (result_tc3[index_tc3][p].matc2)){
                                                           // console.log(result_tc3[index_tc3][p].noidung);

                                                            $('#tbody_noiDungDanhGia').append("<tr>\
                                                                <td>\
                                                                " + result_tc3[index_tc3][p].noidung + "</span>\
                                                                </td>\
                                                                <td><em>"+ result_tc3[index_tc3][p].diem +"đ</em></td>\
                                                                <td><input type='text' id='form12' /></td>\
                                                                <td><input type='text' id='form12' disabled /></td>\
                                                                <td><input type='text' id='form12' disabled /></td>\
                                                            </tr>");
                                                            
                                                        }

                                                    }
                                                })
                                                
                                            },
                                            error: function(errorMessage_tc3) {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Lỗi',
                                                    text: errorMessage_tc3.responseText,
                                                    timer: 5000,
                                                    timerProgressBar: true
                                                })

                                            }
                                        });
                                    }

                                }
                        })
                            
                        },
                        error: function(errorMessage_tc2) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi',
                                text: errorMessage_tc2.responseText,
                                timer: 5000,
                                timerProgressBar: true
                            })

                        }
                    });
                }
                
            })  

        },
        error: function(errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: errorMessage.responseText,
                timer: 5000,
                timerProgressBar: true
            })

        }
    });
}



function getThongTinNguoiDung() {
    if (getCookie('maSo') != null){
        var maSo = getCookie('maSo');
        
        $.ajax({
            url: "../../../api/sinhvien/single_read.php?maSinhVien=" + maSo,
            async: false,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            headers: {
                'Authorization': jwtCookie
            },
            success: function(result) {
                var hoTenSinhVien = result['hoTenSinhVien'];
                var ngaySinh = result['ngaySinh'];
                var maLop = result['maLop'];
                var he = result['he'];
               
                $.ajax({
                    url: "../../../api/lop/single_read.php?maLop=" + maLop,
                    async: false,
                    type: "GET",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json",
                    headers: {
                        'Authorization': jwtCookie
                    },
                    success: function(result_Lop) {
                        var maKhoa = result_Lop['maKhoa'];
                       
                        $.ajax({
                            url: "../../../api/khoa/single_read.php?maKhoa=" + maKhoa,
                            async: false,
                            type: "GET",
                            contentType: "application/json;charset=utf-8",
                            dataType: "json",
                            headers: {
                                'Authorization': jwtCookie
                            },
                            success: function(result_Khoa) {
                                var tenKhoa = result_Khoa['tenKhoa'];
                               
                                $("#part_thongTinSinhVien").append("\
                                    <div class='row'>\
                                        <div class='col'>\
                                            <span style='font-weight: bold;'>Họ tên: </span>"+ hoTenSinhVien +"\
                                        </div>\
                                        <div class='col'>\
                                            <span style='font-weight: bold;'>Mã số sinh viên: </span>"+ maSo +"\
                                        </div>\
                                        <div class='col'>\
                                            <span style='font-weight: bold;'>Ngày sinh: </span>"+ ngaySinh +"\
                                        </div>\
                                        <div class='col'>\
                                            <span style='font-weight: bold;'>Lớp: </span>"+ maLop +"\
                                        </div>\
                                    </div>\
                                    <div class='row'>\
                                        <div class='col'>\
                                            <span style='font-weight: bold;'>Khoa: </span>"+ tenKhoa +"\
                                        </div>\
                                        <div class='col'>\
                                            <span style='font-weight: bold;'>Hệ: </span>"+ he +"\
                                        </div>\
                                        <div class='col'>\
                                            <span style='font-weight: bold;'>Học kỳ: </span>1\
                                        </div>\
                                        <div class='col'>\
                                            <span style='font-weight: bold;'>Năm học: </span>2021-2022\
                                        </div>\
                                    </div>\
                                ");
                
                            },
                            error: function(errorMessage) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi',
                                    text: errorMessage.responseText,
                                    timer: 5000,
                                    timerProgressBar: true
                                })
                
                            }
                        });
        
                    },
                    error: function(errorMessage) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: errorMessage.responseText,
                            timer: 5000,
                            timerProgressBar: true
                        })
        
                    }
                });

            },
            error: function(errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: errorMessage.responseText,
                    timer: 5000,
                    timerProgressBar: true
                })

            }
        });


    }

}
