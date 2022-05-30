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


//Khoa//
function GetListKhoa() {

    if (getCookie("jwt")!= null){
        var jwtCookie = getCookie("jwt");

        $.ajax({
            url: "../../api/khoa/read.php",
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: true,
            headers: { 'Authorization': jwtCookie },
            success: function(result) {
                
                $('#idPhanTrang').pagination({
                    dataSource: result['khoa'],
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
                                <td class='cell'><span class='truncate' id='field_maKhoa' >"+ data[i].maKhoa +"</span></td>\
                                <td class='cell'>"+ data[i].tenKhoa +"</td>\
                                <td class='cell'><button class='btn btn-info' id='btn_DatLaiMatKhau' style='color: white;' data-id='"+ data[i].maKhoa +"' >Đặt lại mật khẩu</button></td>\
                                </tr>";
                           
                        }

                       $("#id_tbodyKhoa").append(htmlData);
                    }

                });

            },
            error: function(errorMessage) {
                checkLoiDangNhap(errorMessage.responseJSON.message);
                
                console.log(errorMessage.responseJSON.message);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: errorMessage.responseJSON.message,
                    //timer: 5000,
                    timerProgressBar: true
                })
    
            }
        });

    }

}


function DatLaiMatKhau() {
    
    



}
