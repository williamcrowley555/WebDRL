//helpers
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

function thongBaoLoi(message){
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: message,
      //timer: 5000,
      timerProgressBar: true,
    });
}

var jwtCookie = getCookie("jwt");


var url = new URL(window.location.href);
var GET_MaLop = url.searchParams.get("maLop");

if (GET_MaLop != null || GET_MaHocKy.trim() != ''){
    $('#text_Lop').text(GET_MaLop);
}









//--------------------------------//






