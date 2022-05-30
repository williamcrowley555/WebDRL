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


//Lớp//
function GetListLop(maKhoa) {

    if (maKhoa == 'tatcakhoa'){
        $("#id_tbodyLop tr").remove();

        $.ajax({
            url: "../../api/lop/read.php",
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: true,
            headers: { 'Authorization': jwtCookie },
            success: function(result) {
                
                $('#idPhanTrang').pagination({
                    dataSource: result['lop'],
                    pageSize: 10,
                    autoHidePrevious: true,
                    autoHideNext: true,
                   
                    callback: function (data, pagination) {
                        var htmlData ="";
                        var count = 0;
                        
                        for (let i = 0; i< data.length; i++){
                            count += 1;
                            
                            htmlData += "<tr>\
                                <td class='cell'>"+ data[i].soThuTu +"</td>\
                                <td class='cell'><span class='truncate'>"+ data[i].maLop +"</span></td>\
                                <td class='cell'>"+ data[i].tenLop +"</td>\
                                <td class='cell'>"+ data[i].maKhoa +"</td>\
                                <td class='cell'>"+ data[i].maCoVanHocTap +"</td>\
                                <td class='cell'>"+ data[i].maKhoaHoc +"</td>\
                                <td class='cell'><a class='btn bg-warning' href='#' style='color: white;'>Chỉnh sửa</a></td>\
                                </tr>";
                           
                        }

                       $("#id_tbodyLop").append(htmlData);
                    }

                });

            },
            error: function(errorMessage) {
              checkLoiDangNhap(errorMessage.responseJSON.message);

                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: errorMessage.responseText,
                    //timer: 5000,
                    timerProgressBar: true
                })
    
            }
        });


    }else{

        $("#id_tbodyLop tr").remove();

        $.ajax({
            url: "../../api/lop/read.php?maKhoa=" + maKhoa,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: true,
            headers: { 'Authorization': jwtCookie },
            success: function(result) {
                
                $('#idPhanTrang').pagination({
                    dataSource: result['lop'],
                    pageSize: 10,
                    autoHidePrevious: true,
                    autoHideNext: true,
                   
                    callback: function (data, pagination) {
                        var htmlData ="";
                        var count = 0;
                        
                        for (let i = 0; i< data.length; i++){
                            count += 1;
                            
                            htmlData += "<tr>\
                                <td class='cell'>"+ data[i].soThuTu +"</td>\
                                <td class='cell'><span class='truncate'>"+ data[i].maLop +"</span></td>\
                                <td class='cell'>"+ data[i].tenLop +"</td>\
                                <td class='cell'>"+ data[i].maKhoa +"</td>\
                                <td class='cell'>"+ data[i].maCoVanHocTap +"</td>\
                                <td class='cell'>"+ data[i].maKhoaHoc +"</td>\
                                <td class='cell'><a class='btn bg-warning' href='#' style='color: white;'>Chỉnh sửa</a></td>\
                                </tr>";
                           
                        }

                       $("#id_tbodyLop").append(htmlData);
                    }

                });

            },
            error: function(errorMessage) {
              checkLoiDangNhap(errorMessage.responseJSON.message);

                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: errorMessage.responseText,
                    //timer: 5000,
                    timerProgressBar: true
                })
    
            }
        });


    }

        
}



function TimKiemLop(maLop) {
    $("#id_tbodyLop tr").remove();
  
    $.ajax({
      url: "../../api/lop/single_read.php?maLop=" + maLop,
      async: false,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      headers: { Authorization: jwtCookie },
      success: function (result_Lop) {
        var htmlData = "";
  
        htmlData += "<tr>\
            <td class='cell'>1</td>\
            <td class='cell'><span class='truncate'>"+ result_Lop.maLop +"</span></td>\
            <td class='cell'>"+ result_Lop.tenLop +"</td>\
            <td class='cell'>"+ result_Lop.maKhoa +"</td>\
            <td class='cell'>"+ result_Lop.maCoVanHocTap +"</td>\
            <td class='cell'>"+ result_Lop.maKhoaHoc +"</td>\
            <td class='cell'><a class='btn bg-warning' href='#' style='color: white;'>Chỉnh sửa</a></td>\
        </tr>"
  
        $("#id_tbodyLop").append(htmlData);
  
      },
      error: function (errorMessage) {
        checkLoiDangNhap(errorMessage.responseJSON.message);

        var htmlData = "";
  
        $("#id_tbodyLop").append(htmlData);
      },
      statusCode: {
        403: function (xhr) {
          //deleteAllCookies();
          //location.href = 'login.php';
        },
      },
    });
  }


function LoadComboBoxThongTinKhoa() {
    //Load khoa
    $.ajax({
      url: "../../api/khoa/read.php",
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: false,
      headers: { Authorization: jwtCookie },
      success: function (result_Khoa) {
        $("#select_Khoa").find("option").remove();
  
        $("#select_Khoa").append(
          "<option selected value='tatcakhoa'>Tất cả khoa</option>"
        );
  
        $.each(result_Khoa, function (index_Khoa) {
          for (var p = 0; p < result_Khoa[index_Khoa].length; p++) {
            $("#select_Khoa").append(
              "<option value='" +
                result_Khoa[index_Khoa][p].maKhoa +
                "'>" +
                result_Khoa[index_Khoa][p].tenKhoa +
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
          text: errorMessage.responseText,
          //timer: 5000,
          timerProgressBar: true,
        });
      },
    });

}



