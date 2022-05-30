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


//Cố vấn học tập//
function GetListCVHT() {

    if (getCookie("jwt")!= null){
        var jwtCookie = getCookie("jwt");

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
                                <td class='cell'><button type=button' class='btn btn-info' style='color: white;' >Đặt lại mật khẩu</button></td>\
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
        var jwtCookie = getCookie("jwt");

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




