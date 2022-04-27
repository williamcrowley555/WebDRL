

function Login() {
    var _inputLogin_MSSV = $('#inputLogin_MSSV').val();
    var _inputLogin_MatKhau = $('#inputLogin_MatKhau').val();

    if (_inputLogin_MSSV == '' || _inputLogin_MatKhau == '') {
        alert('Vui lòng điền thông tin!');
    } else {
        var objLogin = {
            taiKhoan: _inputLogin_MSSV,
            matKhau: _inputLogin_MatKhau
        };
        
        $.ajax({
            url: "http://localhost/WebDRL/api/auth/login.php",
            data: JSON.stringify(objLogin),
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: false,
            success: function (result) {
                console.log(result);
                var quyen = result['0']['quyen'];
                
                switch (quyen) {
                    case 'sinhvien':{
                        deleteAllCookies();
                        
                        document.cookie = 'taiKhoan=' + result['0']['maSinhVien'];
                        document.cookie = 'hoTen=' + result['0']['hoTenSinhVien'];
                        document.cookie = 'quyen=' + quyen;
                        document.cookie = 'jwt=' + result['jwt'];
                
                        alert('Sinh viên');

                        window.location.href = "sinhvien/sinhvien_chamdiem.html";
                        break;
                    }
                         
                    case 'covanhoctap':{
                            alert('Cố vấn học tập');
                            break;
                    }
                   
                    case 'khoa':{
                            alert('Khoa');
                            break;
                    }
                   
                
                    default:{
                        alert('Not found');
                        break;
                    }
                       
                }
                
                
               
            },
            error: function (errorMessage) {
                alert(errorMessage.responseText);
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





