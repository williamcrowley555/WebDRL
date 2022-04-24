
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
            success: function (result) {
                console.log(result);
                console.log(result['0']['quyen']);
                document.cookie = "jwt="+ result['jwt'] +"";
               
                if (result['0']['quyen'] == 'sinhvien'){
                    window.location.href = "sinhvien/sinhvien_chamdiem.html";
                }
               
            },
            error: function (errorMessage) {
                alert(errorMessage.responseText);
            }
        });
    }
}
