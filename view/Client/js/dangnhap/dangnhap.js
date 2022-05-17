//Login
function Login(inputLogin_MSSV, inputLogin_MatKhau) {
  var _inputLogin_MSSV = inputLogin_MSSV;
  var _inputLogin_MatKhau = inputLogin_MatKhau;

  if (_inputLogin_MSSV == "" || _inputLogin_MatKhau == "") {
    Swal.fire({
      icon: "error",
      title: "Lỗi đăng nhập",
      text: "Vui lòng điền đầy đủ thông tin!",
      timer: 3000,
      timerProgressBar: true,
    });
  } else {
    var objLogin = {
      taiKhoan: _inputLogin_MSSV,
      matKhau: _inputLogin_MatKhau,
    };

    $.ajax({
      url: "http://localhost/WebDRL/api/auth/login.php",
      data: JSON.stringify(objLogin),
      type: "POST",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: false,
      success: function (result) {
        //console.log(result);

        //deleteAllCookies();

        document.cookie= "jwt = " + result["jwt"];

        Swal.fire({
            icon: "success",
            title: "Đăng nhập thành công!",
            timer: 1000,
            timerProgressBar: true,
            showConfirmButton: false,
        });
        
        
        
         setTimeout(function () {
            $("#formDieuHuongDangNhap").append("<input type='text' id='jwt' name='jwt' value='" + result["jwt"] + "'>");
            $("form#formDieuHuongDangNhap").submit();
         }, 1000);

      },
      error: function (errorMessage) {
        Swal.fire({
          icon: "error",
          title: "Lỗi đăng nhập",
          text: errorMessage.responseText,
          timer: 3000,
          timerProgressBar: true,
        });
      },
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
