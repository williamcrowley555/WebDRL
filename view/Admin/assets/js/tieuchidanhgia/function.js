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

function ThongBaoLoi(message) {
  Swal.fire({
    icon: "error",
    title: "Lỗi",
    text: message,
    //timer: 5000,
    timerProgressBar: true,
    showCloseButton: true,
  });
}

function checkLoiDangNhap(message) {
  if (message.localeCompare("Vui lòng đăng nhập trước!") == 0) {
    deleteAllCookies();
    location.href = "login.php";
  }
}

//tieuchidanhgia//
function GetListTieuChi(tieuChi) {
  if (getCookie("jwt") != null) {
    var jwtCookie = getCookie("jwt");
    $.ajax({
      url: host_domain_url + "/" + tieuChi + "/read.php",
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: true,
      headers: { Authorization: jwtCookie },
      success: function (result) {
        $("#idPhanTrang").pagination({
          dataSource: result[tieuChi],
          pageSize: 10,
          autoHidePrevious: true,
          autoHideNext: true,

          callback: function (data, pagination) {
            var htmlData = "";
            var count = 0;

            if (tieuChi == "tieuchicap1") {
              for (let i = 0; i < data.length; i++) {
                count += 1;

                htmlData +=
                  "<tr>\
                                    <td class='cell'>" +
                  data[i].soThuTu +
                  "</td>\
                                    <td class='cell'><span class='truncate'>" +
                  data[i].matc1 +
                  "</span></td>\
                                    <td class='cell'>" +
                  data[i].noidung +
                  "</td>\
                                    <td class='cell'>" +
                  data[i].diemtoida +
                  "</td>\
                  <td class='cell'></td>\
                  <td class='cell'>\
                  <button class='btn bg-warning btn_ChinhSua_TieuChiDanhGia' style='color: white;width: max-content;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                  data[i].matc1 +
                  "' data-tieuchicap = '"+ tieuChi +"' data-tentieuchi = '"+ data[i].noidung +"' data-diem = '"+ data[i].diemtoida +"' data-tieuchicaptren='' >Chỉnh sửa</button>\
                </td>\
                                    </tr>";
              }
            } else if (tieuChi == "tieuchicap2") {
              for (let i = 0; i < data.length; i++) {
                count += 1;

                htmlData +=
                  "<tr>\
                                <td class='cell'>" +
                  data[i].soThuTu +
                  "</td>\
                                <td class='cell'><span class='truncate'>" +
                  data[i].matc2 +
                  "</span></td>\
                                <td class='cell'>" +
                  data[i].noidung +
                  "</td>\
                                <td class='cell'>" +
                  data[i].diemtoida +
                  "</td>\
                  <td class='cell'>Tiêu chí 1 - Mã: " +
                  data[i].matc1 +
                  "</td>\
                  <td class='cell'>\
                  <button class='btn bg-warning btn_ChinhSua_TieuChiDanhGia' style='color: white;width: max-content;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                  data[i].matc2 +
                  "' data-tieuchicap = '"+ tieuChi +"' data-tentieuchi = '"+ data[i].noidung +"' data-diem = '"+ data[i].diemtoida +"' data-tieuchicaptren = '"+  data[i].matc1 +"'   >Chỉnh sửa</button>\
                </td>                                </tr>";
              }
            } else if (tieuChi == "tieuchicap3") {
              for (let i = 0; i < data.length; i++) {
                count += 1;

                htmlData +=
                  "<tr>\
                                <td class='cell'>" +
                  data[i].soThuTu +
                  "</td>\
                                <td class='cell'><span class='truncate'>" +
                  data[i].matc3 +
                  "</span></td>\
                                <td class='cell'>" +
                  data[i].noidung +
                  "</td>\
                                <td class='cell'>" +
                  data[i].diem +
                  "</td>\
                  <td class='cell'>Tiêu chí 2 - Mã: " +
                  data[i].matc2 +
                  "</td>\
                  <td class='cell'>\
                  <button class='btn bg-warning btn_ChinhSua_TieuChiDanhGia' style='color: white;width: max-content;' data-bs-toggle='modal' data-bs-target='#ChinhSuaModal' data-id = '" +
                  data[i].matc3 +
                  "' data-tieuchicap = '"+ tieuChi +"' data-tentieuchi = '"+ data[i].noidung +"' data-diem = '"+ data[i].diem +"'  data-tieuchicaptren = '"+  data[i].matc3 +"'  >Chỉnh sửa</button>\
                </td>                                </tr>";
              }
            }

            $("#id_tbodyLop").html(htmlData);
          },
        });
      },
      error: function (errorMessage) {
        checkLoiDangNhap(errorMessage.responseJSON.message);

        Swal.fire({
          icon: "error",
          title: "Lỗi",
          text: errorMessage.responseText,
          //timer: 5000,
          timerProgressBar: true,
        });
      },
    });
  }
}

function LoadTieuChiCapTren_ChinhSuaModal(CapTieuChi, get_tieuchicaptren) {
  
  switch (CapTieuChi) {
    case "tieuchicap1":{
      $('#edit_select_TieuChiCapTren option').empty();
      break;
    }

    case "tieuchicap2":{
      $('#edit_select_TieuChiCapTren option').remove();
      $.ajax({
        url: urlapi_tieuchicap1_read,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_read) {
          $.each(result_read, function (index_read) {
            for (var p = 0; p < result_read[index_read].length; p++) {
              $('#edit_select_TieuChiCapTren').append("<option value='"+ result_read[index_read][p].matc1 +"'>"+ result_read[index_read][p].noidung +"</option>");
            }
          })
          
          $('#edit_select_TieuChiCapTren').val(get_tieuchicaptren);
        
        },
        error: function (errorMessage) {
          checkLoiDangNhap(errorMessage.responseJSON.message);
  
          Swal.fire({
            icon: "error",
            title: "Lỗi",
            text: errorMessage.responseJSON.message,
            //timer: 5000,
            timerProgressBar: true,
          });
        },
      });


      break;
    }

    case "tieuchicap3":{

      $('#edit_select_TieuChiCapTren option').remove();
      $.ajax({
        url: urlapi_tieuchicap2_read,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        async: false,
        headers: { Authorization: jwtCookie },
        success: function (result_read) {
          $.each(result_read, function (index_read) {
            for (var p = 0; p < result_read[index_read].length; p++) {
              $('#edit_select_TieuChiCapTren').append("<option value='"+ result_read[index_read][p].matc2 +"'>"+ result_read[index_read][p].noidung +"</option>");
            }
          })
          
          $('#edit_select_TieuChiCapTren').val(get_tieuchicaptren);
        },
        error: function (errorMessage) {
          checkLoiDangNhap(errorMessage.responseJSON.message);
  
          Swal.fire({
            icon: "error",
            title: "Lỗi",
            text: errorMessage.responseJSON.message,
            //timer: 5000,
            timerProgressBar: true,
          });
        },
      });


      break;
    }
      

  
    default:
      break;
  }


}


function ChinhSua_TieuChiDanhGia() {
  var _edit_input_captieuchi = $("#edit_input_CapTieuChi").val();
  var _edit_input_matieuchi = $("#edit_input_MaTieuChi").val();
  var _edit_input_tentieuchi = $("#edit_input_TenTieuChi").val();
  var _edit_input_diem = $("#edit_input_Diem").val();
  var _edit_select_TieuChiCapTren = $("#edit_select_TieuChiCapTren option:selected").val();


  if (_edit_input_captieuchi == "" || _edit_input_matieuchi == "" || _edit_input_tentieuchi == "" || _edit_input_diem == "") {
    ThongBaoLoi("Vui lòng nhập đầy đủ thông tin!");
  } else {

    switch (_edit_input_captieuchi) {
      case "tieuchicap1":{

        var dataPost = {
          matc1: _edit_input_matieuchi,
          noidung: _edit_input_tentieuchi,
          diemtoida: _edit_input_diem
        };

        $.ajax({
          url: urlapi_tieuchicap1_update,
          type: "POST",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          data: JSON.stringify(dataPost),
          async: false,
          headers: { Authorization: jwtCookie },
          success: function (result_update) {
            $("#ChinhSuaModal").modal("hide");
    
            Swal.fire({
              icon: "success",
              title: "Chỉnh sửa tiêu chí thành công!",
              text: "",
              timer: 2000,
              timerProgressBar: true,
            });
    
            setTimeout(() => {
              GetListTieuChi(_edit_input_captieuchi);
            }, 2000);
          },
          error: function (errorMessage) {
            checkLoiDangNhap(errorMessage.responseJSON.message);
    
            Swal.fire({
              icon: "error",
              title: "Lỗi",
              text: errorMessage.responseJSON.message,
              //timer: 5000,
              timerProgressBar: true,
            });
          },
        });


        break;
      }

      case "tieuchicap2":{

        var dataPost = {
          matc2: _edit_input_matieuchi,
          noidung: _edit_input_tentieuchi,
          diemtoida: _edit_input_diem,
          matc1: _edit_select_TieuChiCapTren
        };

        $.ajax({
          url: urlapi_tieuchicap2_update,
          type: "POST",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          data: JSON.stringify(dataPost),
          async: false,
          headers: { Authorization: jwtCookie },
          success: function (result_update) {
            $("#ChinhSuaModal").modal("hide");
    
            Swal.fire({
              icon: "success",
              title: "Chỉnh sửa tiêu chí thành công!",
              text: "",
              timer: 2000,
              timerProgressBar: true,
            });
    
            setTimeout(() => {
              GetListTieuChi(_edit_input_captieuchi);
            }, 2000);
          },
          error: function (errorMessage) {
            checkLoiDangNhap(errorMessage.responseJSON.message);
    
            Swal.fire({
              icon: "error",
              title: "Lỗi",
              text: errorMessage.responseJSON.message,
              //timer: 5000,
              timerProgressBar: true,
            });
          },
        });


        break;
      }


      case "tieuchicap3":{

        var dataPost = {
          matc3: _edit_input_matieuchi,
          noidung: _edit_input_tentieuchi,
          diem: _edit_input_diem,
          matc2: _edit_select_TieuChiCapTren
        };

        $.ajax({
          url: urlapi_tieuchicap3_update,
          type: "POST",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          data: JSON.stringify(dataPost),
          async: false,
          headers: { Authorization: jwtCookie },
          success: function (result_update) {
            $("#ChinhSuaModal").modal("hide");
    
            Swal.fire({
              icon: "success",
              title: "Chỉnh sửa tiêu chí thành công!",
              text: "",
              timer: 2000,
              timerProgressBar: true,
            });
    
            setTimeout(() => {
              GetListTieuChi(_edit_input_captieuchi);
            }, 2000);
          },
          error: function (errorMessage) {
            checkLoiDangNhap(errorMessage.responseJSON.message);
    
            Swal.fire({
              icon: "error",
              title: "Lỗi",
              text: errorMessage.responseJSON.message,
              //timer: 5000,
              timerProgressBar: true,
            });
          },
        });


        break;
      }

      
        
      default:
        break;
    }


    
  }
}
