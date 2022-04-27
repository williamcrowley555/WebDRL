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

if (getCookie("jwt")!= null){
    switch (getCookie("quyen")) {
        case "sinhvien": {
          window.location.href = "sinhvien/sinhvien_chamdiem.html";
          break;
        }
      
        case "covanhoctap": {
          //window.location.href = "/sinhvien_chamdiem.html";
          break;
        }
      
        case "khoa": {
          //window.location.href = "/sinhvien_chamdiem.html";
          break;
        }
      
        default:
          break;
      }
}

