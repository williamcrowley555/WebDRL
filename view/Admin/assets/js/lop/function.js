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


//Lớp//
function GetListLop() {

    if (getCookie("jwt")!= null){
        var jwtCookie = getCookie("jwt");

        $.ajax({
            url: "http://localhost/WebDRL/api/lop/read.php",
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: false,
            headers: { 'Authorization': jwtCookie },
            success: function(result) {
                
                $('#idPhanTrang').pagination({
                    dataSource: result['lop'],
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
                                <td class='cell'><span class='truncate'>"+ data[i].maLop +"</span></td>\
                                <td class='cell'>"+ data[i].tenLop +"</td>\
                                <td class='cell'>"+ data[i].maKhoa +"</td>\
                                <td class='cell'>"+ data[i].maCoVanHocTap +"</td>\
                                <td class='cell'>"+ data[i].maKhoaHoc +"</td>\
                                <td class='cell'><a class='btn bg-warning' href='#' style='color: white;'>Chỉnh sửa</a></td>\
                                </tr>";
                           
                        }

                       $("#id_tbodyLop").html(htmlData);
                    }

                });

            },
            error: function(errorMessage) {
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
                   // deleteAllCookies();

                    //location.href = 'login.php';
                }
            }
        });

    }

}