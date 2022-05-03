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

window.setInterval(checkCookie, 1000);

function checkCookie(){
    if (getCookie("jwt")== null){
        window.location.href = 'login.php';
    
    } 
}



function GetListSinhVien() {

    if (getCookie("jwt")!= null){
        var jwtCookie = getCookie("jwt");

        $.ajax({
            url: "http://localhost/WebDRL/api/sinhvien/read.php",
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: false,
            headers: { 'Authorization': jwtCookie },
            
            success: function(result) {
                console.log(result);
    
                var countSinhVien = 0;
        
                $.each(result['sinhvien'], function(index) {
                    countSinhVien += 1;
            
                    $('#id_tbodySinhVien').append("<tr>\
                        <td class='cell'>"+ countSinhVien +"</td>\
                        <td class='cell'><span class='truncate'>"+ result['sinhvien'][index].maSinhVien +"</span></td>\
                        <td class='cell'>"+ result['sinhvien'][index].hoTenSinhVien +"</td>\
                        <td class='cell'>"+ result['sinhvien'][index].ngaySinh +"</td>\
                        <td class='cell'>"+ result['sinhvien'][index].he +"</td>\
                        <td class='cell'>"+ result['sinhvien'][index].maLop +"</td>\
                        <td class='cell'><a class='btn-sm app-btn-secondary' href='#'>Đặt lại mật khẩu</a></td>\
                        </tr>");
                    
                
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


    
}


function Login() {
    var _inputLogin_taiKhoan = $('#inputLogin_taiKhoan').val();
    var _inputLogin_MatKhau = $('#inputLogin_MatKhau').val();

    if (_inputLogin_taiKhoan == '' || _inputLogin_MatKhau == '') {
        Swal.fire({
            icon: 'error',
            title: 'Lỗi đăng nhập',
            text: 'Vui lòng điền đầy đủ thông tin!',
            timer: 3000,
            timerProgressBar: true
        })
    } else {
        var objLogin = {
            taiKhoan: _inputLogin_taiKhoan,
            matKhau: _inputLogin_MatKhau
        };
        
        $.ajax({
            url: "http://localhost/WebDRL/api/auth/login_admin.php",
            data: JSON.stringify(objLogin),
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: false,
            success: function (result) {
                console.log(result);
                var quyen = result['0']['quyen'];
                
                switch (quyen) {
                    case 'ctsv':{
                        deleteAllCookies();
                        
                        document.cookie = 'taiKhoan=' + result['0']['taiKhoan'];
                        document.cookie = 'hoTenNhanVien=' + result['0']['hoTenNhanVien'];
                        document.cookie = 'quyen=' + quyen;
                        document.cookie = 'jwt=' + result['jwt'];
                
                       
                        Swal.fire({
                            icon: 'success',
                            title: 'Đăng nhập thành công!',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        })

                        setTimeout(function() {
                            window.location.href = "sinhvien/sinhvien_chamdiem.html";
                        }, 5000);
                        break;

                    }
                         
                    
                    default:{
                        window.location.href = "login.php";
                        break;
                    }
                       
                }
                
                
               
            },
            error: function (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi đăng nhập',
                    text: errorMessage.responseText,
                    timer: 3000,
                    timerProgressBar: true
                })
            
            }
        });


        
    }
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
