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

function checkLoiDangNhap(message) {
    if ( message.localeCompare("Vui lòng đăng nhập trước!") == 0 ){
        deleteAllCookies();
        location.href = 'login.php';
    }
}

var jwtCookie = getCookie("jwt");


//Cố vấn học tập//
function GetListCVHT() {

    if (getCookie("jwt")!= null){
        

        $.ajax({
            url: "../../api/covanhoctap/read.php",
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: false,
            headers: { 'Authorization': jwtCookie },
            success: function(result) {
                
                $('#idPhanTrang').pagination({
                    dataSource: result['covanhoctap'],
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
                                <td class='cell'><span class='truncate'>"+ data[i].maCoVanHocTap +"</span></td>\
                                <td class='cell'>"+ data[i].hoTenCoVan +"</td>\
                                <td class='cell'>"+ data[i].soDienThoai +"</td>\
                                <td class='cell'><button type=button' class='btn btn-info btn_DatLaiMatKhau' data-bs-toggle='modal' data-bs-target='#DatLaiMatKhauModal' style='color: white;' data-id='" + data[i].maCoVanHocTap +
                        "' >Đặt lại mật khẩu</button></td>\
                                </tr>";
                           
                        }

                       $("#id_tbodyData").html(htmlData);
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
                
    
            },
            statusCode: {
                403: function(xhr) {
                    //deleteAllCookies();

                    //location.href = 'login.php';
                }
            }
        });

    }

}



function ThemCVHT() {
    
    if (getCookie("jwt")!= null){
 
        var _inputMaCoVanHocTap = $('#inputMaCoVanHocTap').val();
        var _inputTenCoVanHocTap = $('#inputTenCoVanHocTap').val();
        var _inputSoDienThoai = $('#inputSoDienThoai').val();
        var _inputMatKhauMoi = $('#inputMatKhauMoi').val();
        var _inputNhapLaiMatKhau = $('#inputNhapLaiMatKhau').val();
        

        if (_inputMaCoVanHocTap == '' || _inputTenCoVanHocTap == '' || _inputSoDienThoai == '' || 
            _inputMatKhauMoi == '' || _inputNhapLaiMatKhau == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng nhập đầy đủ thông tin!',
                    timer: 5000,
                    timerProgressBar: true,
                    showCloseButton: true
                })
        }else{
            if (_inputMatKhauMoi != _inputNhapLaiMatKhau){
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Mật khẩu và xác nhận mật khẩu phải giống nhau!',
                    timer: 5000,
                    timerProgressBar: true,
                    showCloseButton: true
                })
            }else{
                var postData = {
                    maCoVanHocTap: _inputMaCoVanHocTap,
                    hoTenCoVan: _inputTenCoVanHocTap,
                    soDienThoai: _inputSoDienThoai,
                    matKhauTaiKhoanCoVan: _inputMatKhauMoi
                };

                console.log(postData);
        
                $.ajax({
                    url: "../../api/covanhoctap/create.php",
                    type: "POST",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json",
                    async: true,
                    headers: { 'Authorization': jwtCookie },
                    data: JSON.stringify(postData),
                    success: function(result) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thêm thành công',
                            text: result.responseText,
                            timer: 2000,
                            timerProgressBar: true
                        })

                        //ẩn modal thêm
                        $('#AddModal').modal('toggle');

                        //reset các input
                        $('#inputMaCoVanHocTap').val('');
                        $('#inputTenCoVanHocTap').val('');
                        $('#inputSoDienThoai').val('');
                        $('#inputMatKhauMoi').val('');
                        $('#inputNhapLaiMatKhau').val('');

                        //load lại danh sách 
                        GetListCVHT();
                        
        
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
            
                    },
                    statusCode: {
                        403: function(xhr) {
                            
                        }
                    }
                });

            }

        }

    }

}




function DatLaiMatKhau() {
    var maCoVanHocTap_Update = $('#input_CoVanHocTap_Update').val();
  
    var _input_MatKhauMoi = $('#input_MatKhauMoi').val();
    var _input_NhapLaiMatKhauMoi = $('#input_NhapLaiMatKhauMoi').val();
  
    if (_input_MatKhauMoi == '' || _input_NhapLaiMatKhauMoi == '') {
      ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
    }else{
      if (_input_MatKhauMoi != _input_NhapLaiMatKhauMoi){
        ThongBaoLoi("Nhập lại mật khẩu không khớp với mật khẩu! Mời nhập lại!");
      }else{
  
        $.ajax({
          url: "../../api/covanhoctap/single_read.php?maCoVanHocTap=" + maCoVanHocTap_Update,
          type: "GET",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          async: false,
          headers: { Authorization: jwtCookie },
          success: function (result_SV) {
            var _input_MaCoVanHocTap = result_SV.maCoVanHocTap;
            var _input_HoTenCoVan = result_SV.hoTenCoVan;
            var _input_SoDienThoai = result_SV.soDienThoai;
           
           var dataPost_Update = {
              maCoVanHocTap:  _input_MaCoVanHocTap,
              hoTenCoVan: _input_HoTenCoVan,
              soDienThoai: _input_SoDienThoai,
              matKhauTaiKhoanCoVan: _input_MatKhauMoi
  
           }
          
  
           $.ajax({
            url: "../../api/covanhoctap/update.php",
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            data: JSON.stringify(dataPost_Update),
            async: false,
            headers: { Authorization: jwtCookie },
            success: function (result_Create) {
              $('#DatLaiMatKhauModal').modal('hide');
              
              Swal.fire({
                icon: "success",
                title: "Đặt lại mật khẩu thành công!",
                text: '',
                timer: 2000,
                timerProgressBar: true,
              });
      
              setTimeout(() => {
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
  
   
    
  
  }




