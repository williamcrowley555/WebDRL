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
    //timer: 5000,
    timerProgressBar: true,
    showCloseButton: true,
  });
}


function checkLoiDangNhap(message) {
    if ( message.localeCompare("Vui lòng đăng nhập trước!") == 0 ){
        deleteAllCookies();
        location.href = 'login.php';
    }
}


//hoatdongdanhgia//
function GetListHoatdongdanhgia() {
  if (getCookie("jwt") != null) {
    var jwtCookie = getCookie("jwt");

    $.ajax({
      url: "../../api/hoatdongdanhgia/read.php",
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: true,
      headers: { Authorization: jwtCookie },
      success: function (result) {
        $("#idPhanTrang").pagination({
          dataSource: result["hoatdongdanhgia"],
          pageSize: 10,
          autoHidePrevious: true,
          autoHideNext: true,

          callback: function (data, pagination) {
            var htmlData = "";
            var count = 0;

            for (let i = 0; i < data.length; i++) {
                count += 1;

                //Ajax load tiêu chí
                if (data[i].maTieuChi2 != 0){

                    $.ajax({
                        url: "../../api/tieuchicap2/single_read.php?matc2=" + data[i].maTieuChi2,
                        type: "GET",
                        contentType: "application/json;charset=utf-8",
                        dataType: "json",
                        async: false,
                        headers: { 'Authorization': jwtCookie },
                        success: function (result_tieuchi2) {
                            
                            htmlData +=
                                "<tr>\
                                <td class='cell'>" + data[i].soThuTu + "</td>\
                                <td class='cell'><span class='truncate'>" + data[i].maHoatDong + "</span></td>\
                                <td class='cell'>" + data[i].tenHoatDong + "</td>\
                                <td class='cell'>" + data[i].maKhoa + "</td>\
                                <td class='cell'>" + result_tieuchi2.noidung + "</td>\
                                <td class='cell'>" + data[i].diemNhanDuoc + "</td>\
                                <td class='cell'>" + data[i].diaDiemDienRaHoatDong + "</td>\
                                <td class='cell'>" + data[i].maHocKyDanhGia + "</td>\
                                <td class='cell'>" + data[i].thoiGianBatDauHoatDong + "</td>\
                                <td class='cell'>" + data[i].thoiGianKetThucHoatDong + "</td>\
                                <td class='cell'>" + data[i].thoiGianBatDauDiemDanh + "</td>\
                                <td class='cell'><img src='"+ data[i].maQRDiaDiem +"' style='width: 40%;' /></td>\
                                <td class='cell'>\
                                    <a class='btn' href='#' style='color: white;width: max-content;margin: 5px;background: dodgerblue;'>Bắt đầu điểm danh</a>\
                                    <a class='btn bg-warning' href='#' style='color: white;margin: 5px;'>Chỉnh sửa</a>\
                                </td>\
                                </tr>";
                        
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
                    });

                }


                if (data[i].maTieuChi3 != 0){

                    $.ajax({
                        url: "../../api/tieuchicap3/single_read.php?matc3=" + data[i].maTieuChi3,
                        type: "GET",
                        contentType: "application/json;charset=utf-8",
                        dataType: "json",
                        async: false,
                        headers: { 'Authorization': jwtCookie },
                        success: function (result_tieuchi3) {
                           
                            htmlData +=
                                "<tr>\
                                <td class='cell'>" + data[i].soThuTu + "</td>\
                                <td class='cell'><span class='truncate'>" + data[i].maHoatDong + "</span></td>\
                                <td class='cell'>" + data[i].tenHoatDong + "</td>\
                                <td class='cell'>" + data[i].maKhoa + "</td>\
                                <td class='cell'>" + result_tieuchi3.noidung + "</td>\
                                <td class='cell'>" + data[i].diemNhanDuoc + "</td>\
                                <td class='cell'>" + data[i].diaDiemDienRaHoatDong + "</td>\
                                <td class='cell'>" + data[i].maHocKyDanhGia + "</td>\
                                <td class='cell'>" + data[i].thoiGianBatDauHoatDong + "</td>\
                                <td class='cell'>" + data[i].thoiGianKetThucHoatDong + "</td>\
                                <td class='cell'>" + data[i].thoiGianBatDauDiemDanh + "</td>\
                                <td class='cell'><img src='"+ data[i].maQRDiaDiem +"' style='width: 40%;' /></td>\
                                <td class='cell'>\
                                    <a class='btn' href='#' style='color: white;width: max-content;margin: 5px;background: dodgerblue;'>Bắt đầu điểm danh</a>\
                                    <a class='btn bg-warning' href='#' style='color: white;margin: 5px;'>Chỉnh sửa</a>\
                                </td>\
                                </tr>";
                
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
                    });

                }

                
                



                
            }

            $("#id_tbodyLop").html(htmlData);
          },
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
}





function LoadThongTinThemMoi() {

    //Load khoa
    $.ajax({
        url: "../../api/khoa/read.php",
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { 'Authorization': jwtCookie },
        success: function (result_Khoa) {
            $('#select_Khoa').find('option').remove();

            $.each(result_Khoa, function (index_Khoa) {
                for (var p = 0; p < result_Khoa[index_Khoa].length; p++) {
                    
                    $('#select_Khoa').append("<option value='"+ result_Khoa[index_Khoa][p].maKhoa +"'>"+ result_Khoa[index_Khoa][p].tenKhoa +"</option>");

                }
            });

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
    });


    //Load tiêu chí
    $.ajax({
        url: "../../api/tieuchicap2/read.php",
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { 'Authorization': jwtCookie },
        success: function (result_TC2) {
            $('#select_TieuChi').find('option').remove();

            $.each(result_TC2, function (index_TC2) {
                for (var p = 0; p < result_TC2[index_TC2].length; p++) {
                    
                    if (result_TC2[index_TC2][p].diemtoida > 0){
                        $('#select_TieuChi').append("<option value='TC2_"+ result_TC2[index_TC2][p].matc2 +"'>"+ result_TC2[index_TC2][p].noidung +"</option>");
                    }
        
                }
            });

            //Load tiêu chí
            $.ajax({
                url: "../../api/tieuchicap3/read.php",
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                async: false,
                headers: { 'Authorization': jwtCookie },
                success: function (result_TC3) {
           
                    $.each(result_TC3, function (index_TC3) {
                        for (var k = 0; k < result_TC3[index_TC3].length; k++) {
                            
                            if (result_TC3[index_TC3][k].diem > 0){
                                $('#select_TieuChi').append("<option value='TC3_"+ result_TC3[index_TC3][k].matc3 +"'>"+ result_TC3[index_TC3][k].noidung +"</option>");
                            }
                
                        }
                    });
                    
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
            });
            
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
    });


    //Load học kỳ áp dụng
    $.ajax({
        url: "../../api/hockydanhgia/read.php",
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { 'Authorization': jwtCookie },
        success: function (result_HocKy) {
            $('#select_HocKyDanhGia').find('option').remove();

            $.each(result_HocKy, function (index_HocKy) {
                for (var b = 0; b < result_HocKy[index_HocKy].length; b++) {
                    
                    $('#select_HocKyDanhGia').append("<option value='"+ result_HocKy[index_HocKy][b].maHocKyDanhGia +"'> "+ result_HocKy[index_HocKy][b].hocKyXet + " - "+ result_HocKy[index_HocKy][b].namHocXet +"</option>");

                }
            });

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
    });

}







function ThemMoi() {
    
    var _input_MaHocKy = $('#select_HocKyDanhGia option:selected').val();
    var _input_TenHoatDong = $('#input_TenHoatDong').val();
    var _input_MaKhoa = $('#select_Khoa option:selected').val();
    var _input_MaTieuChi = $('#select_TieuChi option:selected').val();
    var _input_DiemNhanDuoc = $('#input_DiemNhanDuoc').val();
    var _input_DiaDiemHoatDong = $('#input_DiaDiemHoatDong').val();
    var _input_ThoiGianBatDau = $('#input_ThoiGianBatDau').val();
    var _input_ThoiGianKetThuc = $('#input_ThoiGianKetThuc').val();

    if (_input_TenHoatDong == '' || _input_DiemNhanDuoc == '' ||  _input_DiaDiemHoatDong == '' || 
    _input_ThoiGianBatDau == '' || _input_ThoiGianKetThuc == ''  ){
        ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");

    }else{

        //Lấy mã hoạt động max + 1 để dùng cho tạo url hoạt động đánh giá
        $.ajax({
            url: "../../api/hoatdongdanhgia/read.php",
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: false,
            headers: { 'Authorization': jwtCookie },
            success: function (result) {
                var maxID_MaHoatDong = 0;
                $.each(result, function (index) {
                    for (var b = 0; b < result[index].length; b++) {
                        //Mã hoạt động ví dụ: HD1
                        if ((result[index][b].maHoatDong).slice(2,3) > maxID_MaHoatDong ){
                            maxID_MaHoatDong = (result[index][b].maHoatDong).slice(2,3);
                        }
                    }
                });

                var maHoatDongNew = "HD" + (Number(maxID_MaHoatDong) + 1);

                var maTieuChi_sliced = _input_MaTieuChi.slice(0,3);
                var _value_maTieuChi = _input_MaTieuChi.slice(4,_input_MaTieuChi.length);


                 //http://localhost/WebDRL/view/Client/pages/diemdanhhoatdong.php?maHoatDong=HD1
                var currentDomainURL = window.location.protocol + '//' + window.location.hostname;
                var urlCreate = currentDomainURL + "/WebDRL/view/Client/pages/diemdanhhoatdong.php?maHoatDong=" + maHoatDongNew;

                //Tạo hoạt động đánh giá
                if (maTieuChi_sliced == 'TC2'){
                    var dataPost = {
                        maHoatDong: maHoatDongNew,
                        maTieuChi2: _value_maTieuChi,
                        maTieuChi3: null,
                        maHocKyDanhGia: _input_MaHocKy,
                        tenHoatDong: _input_TenHoatDong,
                        maKhoa: _input_MaKhoa,
                        diemNhanDuoc: _input_DiemNhanDuoc,
                        diaDiemDienRaHoatDong: _input_DiaDiemHoatDong,
                        thoiGianBatDauHoatDong: _input_ThoiGianBatDau,
                        thoiGianKetThucHoatDong: _input_ThoiGianKetThuc,
                        thoiGianBatDauDiemDanh: null,
                        url: urlCreate
                    }

                    //console.log(dataPost);

                    $.ajax({
                        url: "../../api/hoatdongdanhgia/create.php",
                        type: "POST",
                        contentType: "application/json;charset=utf-8",
                        dataType: "json",
                        data: JSON.stringify(dataPost),
                        async: false,
                        headers: { 'Authorization': jwtCookie },
                        success: function (result_Create) {
                            $('#AddModal').modal('hide');

                            Swal.fire({
                                icon: "success",
                                title: "Tạo thành công!",
                                text: '',
                                timer: 3000,
                                timerProgressBar: true,
                            });

                            setTimeout(function(){
                                location.reload();
                            }, 3000);

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
        
                if (maTieuChi_sliced == 'TC3'){
                    var dataPost = {
                        maHoatDong: maHoatDongNew,
                        maTieuChi2: null,
                        maTieuChi3: _value_maTieuChi,
                        maHocKyDanhGia: _input_MaHocKy,
                        tenHoatDong: _input_TenHoatDong,
                        maKhoa: _input_MaKhoa,
                        diemNhanDuoc: _input_DiemNhanDuoc,
                        diaDiemDienRaHoatDong: _input_DiaDiemHoatDong,
                        thoiGianBatDauHoatDong: _input_ThoiGianBatDau,
                        thoiGianKetThucHoatDong: _input_ThoiGianKetThuc,
                        thoiGianBatDauDiemDanh: null,
                        url: urlCreate
                    }

                    //console.log(dataPost);

                    $.ajax({
                        url: "../../api/hoatdongdanhgia/create.php",
                        type: "POST",
                        contentType: "application/json;charset=utf-8",
                        dataType: "json",
                        data: JSON.stringify(dataPost),
                        async: false,
                        headers: { 'Authorization': jwtCookie },
                        success: function (result_Create) {
                            $('#AddModal').modal('hide');

                            Swal.fire({
                                icon: "success",
                                title: "Tạo thành công!",
                                text: '',
                                timer: 2000,
                                timerProgressBar: true,
                            });

                            setTimeout(function(){
                                location.reload();
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
