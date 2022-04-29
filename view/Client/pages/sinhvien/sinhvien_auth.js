function getCookie(cName) {
    const name = cName + "=";
    const cDecoded = decodeURIComponent(document.cookie); //to be careful
    const cArr = cDecoded .split('; ');
    let res;
    cArr.forEach(val => {
        if (val.indexOf(name) === 0) res = val.substring(name.length);
    })
    return res;
}


window.setInterval(checkCookie, 1000);

function checkCookie(){
    if (getCookie('jwt')==null){
        window.location.href = "../home_dangnhap.html";
    }else{
       // console.log(getCookie('jwt'));
    }
}





