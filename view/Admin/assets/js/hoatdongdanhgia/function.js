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
                                <td class='cell'>" + data[i].thoiGianBatDauHoatDong + "</td>\
                                <td class='cell'>" + data[i].thoiGianKetThucHoatDong + "</td>\
                                <td class='cell'><img src='"+ data[i].maQRDiaDiem +"' style='width: 35%;' /></td>\
                                <td class='cell'><a class='btn bg-warning' href='#' style='color: white;'>Chỉnh sửa</a></td>\
                                </tr>";
                        
                        },
                        error: function (errorMessage) {
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
                                <td class='cell'>" + data[i].thoiGianBatDauHoatDong + "</td>\
                                <td class='cell'>" + data[i].thoiGianKetThucHoatDong + "</td>\
                                <td class='cell'><img src='"+ data[i].maQRDiaDiem +"' style='width: 35%;' /></td>\
                                <td class='cell'><a class='btn bg-warning' href='#' style='color: white;'>Chỉnh sửa</a></td>\
                                </tr>";
                
                        },
                        error: function (errorMessage) {
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
    
    var _input_TenHoatDong = $('#input_TenHoatDong').val();
    var _input_DiemNhanDuoc = $('#input_DiemNhanDuoc').val();
    var _input_DiaDiemHoatDong = $('#input_DiaDiemHoatDong').val();
    var _input_ThoiGianBatDau = $('#input_ThoiGianBatDau').val();
    var _input_ThoiGianKetThuc = $('#input_ThoiGianKetThuc').val();

    if (_input_TenHoatDong == '' || _input_DiemNhanDuoc == '' ||  _input_DiaDiemHoatDong == '' || 
    _input_ThoiGianBatDau == '' || _input_ThoiGianKetThuc == ''  ){
        thongBaoLoi("Vui lòng nhập đầy đủ thông tin!");

    }else{

        var dataPost = {
            

        }


    }



}
