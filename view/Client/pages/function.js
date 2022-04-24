

function Login() {
    var _inputLogin_MSSV = $('#inputLogin_MSSV').val();
    var _inputLogin_MatKhau = $('#inputLogin_MatKhau').val();

    if (_inputLogin_MSSV == '' || _inputLogin_MatKhau == '') {
        console.log('empty data');
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
                
                if (quyen == 'sinhvien'){
                    document.cookie = "jwt=1;maSinhVien=sinhvien";
                    // document.cookie = "jwt="+ result['jwt'] +
                    //             ";maSinhVien=" + result['0']['maSinhVien'] +
                    //             ";hoTenSinhVien ="+ result['0']['hoTenSinhVien'] +  
                    //             ";quyen ="+ quyen +";";

                    //window.location.href = "sinhvien/sinhvien_chamdiem.html";
                }
                


               
            },
            error: function (errorMessage) {
                alert(errorMessage.responseText);
            }
        });
    }
}
