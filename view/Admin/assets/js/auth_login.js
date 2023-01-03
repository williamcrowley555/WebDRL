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

window.setInterval(checkCookie, 500);

function checkCookie() {
  if (getCookie("jwt") != null) {
    switch (getCookie("quyen")) {
      case "ctsv": {
        setTimeout(function () {
          location.href = "index.php";
        }, 100);

        break;
      }

      default: {
        break;
      }
    }
  }
}

function Login() {
  var _inputLogin_taiKhoan = $("#inputLogin_taiKhoan").val();
  var _inputLogin_matKhau = $("#inputLogin_matKhau").val();

  if (_inputLogin_taiKhoan == "" || _inputLogin_matKhau == "") {
    Swal.fire({
      icon: "error",
      title: "Lỗi đăng nhập",
      text: "Vui lòng điền đầy đủ thông tin!",
      timer: 3000,
      timerProgressBar: true,
    });
  } else {
    var objLogin = {
      taiKhoan: _inputLogin_taiKhoan,
      matKhau: _inputLogin_matKhau,
    };

    $.ajax({
      url: urlapi_login_admin,
      data: JSON.stringify(objLogin),
      type: "POST",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: false,
      success: function (result) {
        var quyen = result["0"]["quyen"];

        switch (quyen) {
          case "superadmin": {
            // deleteAllCookies();

            document.cookie = "taiKhoan=" + result["0"]["taiKhoan"];
            document.cookie = "hoTen=" + result["0"]["hoTen"];
            document.cookie = "quyen=" + quyen;
            document.cookie = "jwt=" + result["jwt"];

            Swal.fire({
              icon: "success",
              title: "Đăng nhập thành công",
              text: "",
              timer: 3000,
              timerProgressBar: true,
            });

            setTimeout(function () {
              window.location.href = "index.php";
            }, 2000);
            break;
          }

          case "admin": {
            // deleteAllCookies();

            document.cookie = "taiKhoan=" + result["0"]["taiKhoan"];
            document.cookie = "hoTen=" + result["0"]["hoTen"];
            document.cookie = "quyen=" + quyen;
            document.cookie = "jwt=" + result["jwt"];

            Swal.fire({
              icon: "success",
              title: "Đăng nhập thành công",
              text: "",
              timer: 3000,
              timerProgressBar: true,
            });

            setTimeout(function () {
              window.location.href = "index.php";
            }, 2000);
            break;
          }

          case "ctsv": {
            // deleteAllCookies();

            document.cookie = "taiKhoan=" + result["0"]["taiKhoan"];
            document.cookie = "hoTenNhanVien=" + result["0"]["hoTenNhanVien"];
            document.cookie = "quyen=" + quyen;
            document.cookie = "jwt=" + result["jwt"];

            Swal.fire({
              icon: "success",
              title: "Đăng nhập thành công",
              text: "",
              timer: 3000,
              timerProgressBar: true,
            });

            setTimeout(function () {
              window.location.href = "index.php";
            }, 2000);
            break;
          }

          case "khoa": {
            // deleteAllCookies();

            document.cookie = "taiKhoan=" + result["0"]["taiKhoanKhoa"];
            document.cookie = "hoTenNhanVien=" + result["0"]["tenKhoa"];
            document.cookie = "quyen=" + quyen;
            document.cookie = "jwt=" + result["jwt"];

            Swal.fire({
              icon: "success",
              title: "Đăng nhập thành công",
              text: "",
              timer: 3000,
              timerProgressBar: true,
            });

            setTimeout(function () {
              window.location.href = "index.php";
            }, 2000);
            break;
          }

          default: {
            window.location.href = "login.php";
            break;
          }
        }
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
