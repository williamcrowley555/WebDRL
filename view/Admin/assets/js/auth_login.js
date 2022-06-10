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

function checkCookie(){
  if (getCookie("jwt")!= null){
    switch (getCookie('quyen')) {
        case "ctsv": {
            setTimeout(function() {
                location.href = "index.php";
            }, 100);
            
            break;
        }
      
        default:{
            break;
        }
          
      }
    }
}


function Login() {
    var _inputLogin_taiKhoan = $('#inputLogin_taiKhoan').val();
    var _inputLogin_matKhau = $('#inputLogin_matKhau').val();

    if (_inputLogin_taiKhoan == '' || _inputLogin_matKhau == '') {
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
            matKhau: _inputLogin_matKhau
        };
        
        $.ajax({
            url: urlapi_login_admin,
            data: JSON.stringify(objLogin),
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: false,
            success: function (result) {
                var quyen = result['0']['quyen'];
                
                switch (quyen) {
                    case 'ctsv':{
                       // deleteAllCookies();
                        
                        document.cookie = 'taiKhoan=' + result['0']['taiKhoan'];
                        document.cookie = 'hoTenNhanVien=' + result['0']['hoTenNhanVien'];
                        document.cookie = 'quyen=' + quyen;
                        document.cookie = 'jwt=' + result['jwt'];
                
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal.stopTimer)
                              toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                          })
                          
                          Toast.fire({
                            icon: 'success',
                            title: 'Đăng nhập thành công'
                          })
                       
                        setTimeout(function() {
                            location.href = "index.php";
                        }, 2000);
                        break;

                    }
                         
                    
                    default:{
                        window.location.href = "login.php";
                        break;
                    }
                       
                }
                
                
               
            },
            error: function (errorMessage) {
                console.log(errorMessage.responseText);
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
