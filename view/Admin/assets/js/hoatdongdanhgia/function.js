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


//hoatdongdanhgia//
function GetListHoatdongdanhgia() {

    if (getCookie("jwt")!= null){
        var jwtCookie = getCookie("jwt");

        $.ajax({
            url: "../../api/hoatdongdanhgia/read.php",
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: true,
            headers: { 'Authorization': jwtCookie },
            success: function(result) {
                
                $('#idPhanTrang').pagination({
                    dataSource: result['hoatdongdanhgia'],
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
                                <td class='cell'><span class='truncate'>"+ data[i].maHoatDong +"</span></td>\
                                <td class='cell'>"+ data[i].tenHoatDong +"</td>\
                                <td class='cell'>"+ data[i].diemNhanDuoc +"</td>\
                                <td class='cell'>"+ data[i].thoiGianBatDauHoatDong +"</td>\
                                <td class='cell'>"+ data[i].thoiGianKetThucHoatDong +"</td>\
                                <td class='cell'><a class='btn bg-warning' href='#' style='color: white;'>Đặt lại mật khẩu</a></td>\
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
    
            }
        });

    }

}