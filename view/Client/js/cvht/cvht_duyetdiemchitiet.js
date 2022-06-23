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

function changeNumberHandle(val, number) {
  if (val.value != "") {
    if (isNaN(val.value) == false) {
      //console.log(val.value);

      if (number < 0) {
        if (Number(val.value) < number) {
          val.value = number;
        } else {
          if (Number(val.value) > 0) {
            val.value = 0;
          }
        }
      } else {
        if (Number(val.value) > number) {
          val.value = number;
        } else {
          if (Number(val.value) < 0) {
            val.value = 0;
          }
        }
      }

      
    } else {
      val.value = 0;
    }
  } else {
    val.value = 0;
  }
}


var jwtCookie = getCookie("jwt");

var url = new URL(window.location.href);
var GET_MaHocKy = url.searchParams.get("maHocKy");

var GET_MaSinhVien = url.searchParams.get("maSinhVien");


//-----------------------------------------//
function HienThiThongTinVaDanhGia() {
    var checkMaHocKyHopLe = 0;  

    if (GET_MaHocKy != null){
      if (GET_MaHocKy.trim() != ''){
        
        $.ajax({
          url: urlapi_thongbaodanhgia_read,
          async: false,
          type: "GET",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          headers: {
            Authorization: jwtCookie,
          },
          success: function (result_ThongBaoDanhGia) {
            
            $.each(result_ThongBaoDanhGia, function (index_TBDG) {
              for (var q = 0;q < result_ThongBaoDanhGia[index_TBDG].length;q++) {
                var maHocKy_TBDG = result_ThongBaoDanhGia[index_TBDG][q].maHocKyDanhGia;
  
                if (GET_MaHocKy === maHocKy_TBDG){
                  checkMaHocKyHopLe++;
                  var ngayCoVanDanhGia = new Date(result_ThongBaoDanhGia[index_TBDG][q].ngayCoVanDanhGia);
                  var ngayCoVanKetThucDanhGia = new Date(result_ThongBaoDanhGia[index_TBDG][q].ngayCoVanKetThucDanhGia);
          
                  //lấy ngày hiện tại
                  var today = new Date();
                  var ngayHienTai = new Date(today.getFullYear() +"-" +(today.getMonth() + 1) +"-" +today.getDate());
          
                  //thời gian hiện tại nằm trong khoảng thời gian học kỳ còn mở chấm
                  if (ngayHienTai.getTime() >= ngayCoVanDanhGia.getTime() 
                  && ngayHienTai.getTime() <= ngayCoVanKetThucDanhGia.getTime()) 
                  {
                    
                      //vẫn còn trong thời gian mở chấm nên giữ nguyên page
                      getThongTinNguoiDung();
                      getTieuChiDanhGia();
                      
                  }else{
                      window.location.href = 'cvht_duyetdiemrenluyen.php';
                  }
  
                }
  
              }


              if (checkMaHocKyHopLe == 0){
                window.location.href = 'cvht_duyetdiemrenluyen.php';
              }
              
            });


          },
          error: function (errorMessage_tc3) {
            thongBaoLoi(errorMessage_tc3.responseText);
          },
        });
      }else{
        window.location.href = 'cvht_duyetdiemrenluyen.php';
      }


    }else{
     
      window.location.href = 'cvht_duyetdiemrenluyen.php';
    }
}



//------------------------------------------------//
//Show tiêu chí đánh giá
function getTieuChiDanhGia() {
    //Ajax tieuchicap1
    $.ajax({
      url: urlapi_tieuchicap1_read,
      async: false,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      headers: {
        Authorization: jwtCookie,
      },
      success: function (result) {
        $.each(result, function (index) {
          for (var i = 0; i < result[index].length; i++) {
            //console.log(result[index][i].noidung);
  
            $("#tbody_noiDungDanhGia").append(
              "<tr>\
                  <td style='font-weight: bold;'>" +
                result[index][i].noidung +
                "</td>\
                  <td></td>\
                  <td></td>\
                  <td></td>\
                  <td></td>\
                  <td></td>\
                  </tr>"
            );
  
            //Ajax tieuchicap2
            $.ajax({
              url: urlapi_tieuchicap2_read,
              async: false,
              type: "GET",
              contentType: "application/json;charset=utf-8",
              dataType: "json",
              headers: {
                Authorization: jwtCookie,
              },
              success: function (result_tc2) {
                $.each(result_tc2, function (index_tc2) {
                  for (var k = 0; k < result_tc2[index_tc2].length; k++) {
                    if (
                      result[index][i].matc1 === result_tc2[index_tc2][k].matc1
                    ) {
                      if (result_tc2[index_tc2][k].diemtoida != 0) {
                        var min_value_tc2 = 0;
                        //get min value
                        if (result_tc2[index_tc2][k].diemtoida > 0) {
                          min_value_tc2 = 0;
                        } else {
                          min_value_tc2 = result_tc2[index_tc2][k].diemtoida;
                        }
  
                        $("#tbody_noiDungDanhGia").append(
                          "<tr>\
                            <td><em>" + result_tc2[index_tc2][k].noidung + "</em></td>\
                            <td><em>" + result_tc2[index_tc2][k].diemtoida + "đ</em></td>\
                            <td>\
                              <input type='number' style='width: 100px;' onchange='changeNumberHandle(this," + result_tc2[index_tc2][k].diemtoida + ")' max_value='" + result_tc2[index_tc2][k].diemtoida + "'    \
                              min='" + min_value_tc2 + "' id='TC2_" + result_tc2[index_tc2][k].matc2 + "' disabled/> \
                            </td>\
                            <td>\
                              <input type='number' style='width: 100px;' onchange='changeNumberHandle(this," + result_tc2[index_tc2][k].diemtoida + ")' max_value='" + result_tc2[index_tc2][k].diemtoida + "'    \
                              min='" + min_value_tc2 + "' id='CVHT_TC2_" + result_tc2[index_tc2][k].matc2 + "' /> \
                            </td>\
                            <td>\
                              <button type='button' class='btn btn-light btn_XemDanhSachHoatDong' style='color: black;width: max-content;' data-bs-toggle='modal' data-bs-target='#XemDanhSachHoatDongModal' data-tieuchi-id='TC2_" + result_tc2[index_tc2][k].matc2 + "' data-tentieuchi='"+ result_tc2[index_tc2][k].noidung +"' >Danh sách</button>\
                            </td>\
                            <td>\
                            <div class='box'>\
                            <a href='#' id='show_file_minhchung_TC2_"+ result_tc2[index_tc2][k].matc2 +"' target='_blank' ></a>\
                            <form id='formDanhGiaDRL_TC2_"+ result_tc2[index_tc2][k].matc2 +"' method='post' enctype='multipart/form-data'>\
                              <input type='file' id='file_minhchung_TC2_"+ result_tc2[index_tc2][k].matc2 +"' name='fileMinhChung' class='inputfile inputfile-1' accept='.png,.jpg,.jpeg' data-multiple-caption='{count} files selected' >\
                              <label for='file_minhchung_TC2_"+ result_tc2[index_tc2][k].matc2 +"'><svg xmlns='http://www.w3.org/2000/svg' width='20' height='17' viewBox='0 0 20 17'><path d='M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z'></path></svg> <span>Chọn tệp…</span></label>\
                            </form>\
                          </div>\
                            </td>\
                          </tr>"
                        );
  
                        // <td><input type='text' style='width: 100px;'  id='ghiChuTC2_" + result_tc2[index_tc2][k].matc2 +"' /></td>\
                      } else {
                        if (
                          result_tc2[index_tc2][k].noidung ==
                          "1.Kết quả học tập: "
                        ) {
                          $("#tbody_noiDungDanhGia").append(
                            "<tr>\
                                              <td><em>" +
                              result_tc2[index_tc2][k].noidung +
                              "<br>Điểm TBC học kỳ trước: <input type='number' step='0.01' onchange='changeNumberHandle(this,4)' id='inputTBCHocKyTruoc' name='diemTrungBinhChungHKTruoc' style='width: 100px;margin-right: 30px;margin-bottom: 15px;' /><br>Điểm TBC học kỳ đang xét: <input type='number' step='0.01' onchange='changeNumberHandle(this,4)' id='inputTBCHocKyDangXet' name='diemTrungBinhChungHKXet' style='width: 100px;' /> </em></td>\
                                              <td></td>\
                                              <td></td>\
                                              <td></td>\
                                              <td></td>\
                                              <td><a href='#' id='show_file_minhchung_TC2_"+ result_tc2[index_tc2][k].matc2 +"' target='_blank' ></a>\
                                              <form id='formDanhGiaDRL_TC2_"+ result_tc2[index_tc2][k].matc2 +"' method='post' enctype='multipart/form-data'></form></td>\
                                              </tr>"
                          );
                        } else {
                          $("#tbody_noiDungDanhGia").append(
                            "<tr>\
                                              <td><em>" +
                              result_tc2[index_tc2][k].noidung +
                              "</em></td>\
                                              <td></td>\
                                              <td></td>\
                                              <td></td>\
                                              <td></td>\
                                              <td> <a href='#' id='show_file_minhchung_TC2_"+ result_tc2[index_tc2][k].matc2 +"' target='_blank' ></a>\
                                              <form id='formDanhGiaDRL_TC2_"+ result_tc2[index_tc2][k].matc2 +"' method='post' enctype='multipart/form-data'></form></td>\
                                              </tr>"
                          );
                        }
                      }
  
                      //Ajax tieuchicap3
                      $.ajax({
                        url: urlapi_tieuchicap3_read,
                        async: false,
                        type: "GET",
                        contentType: "application/json;charset=utf-8",
                        dataType: "json",
                        headers: {
                          Authorization: jwtCookie,
                        },
                        success: function (result_tc3) {
                          $.each(result_tc3, function (index_tc3) {
                            for (
                              var p = 0;
                              p < result_tc3[index_tc3].length;
                              p++
                            ) {
                              if (
                                result_tc2[index_tc2][k].matc2 ===
                                result_tc3[index_tc3][p].matc2
                              ) {
                                // console.log(result_tc3[index_tc3][p].noidung);
  
                                var min_value = 0;
                                var disabled_string = "";
                                //get min value
                                if (result_tc3[index_tc3][p].diem > 0) {
                                  min_value = 0;
                                } else {
                                  min_value = result_tc3[index_tc3][p].diem;
                                }
  
                                if (
                                  (result_tc3[index_tc3][p].noidung.localeCompare("a. Điểm trung bình chung học kì từ  3,60 đến 4,00") == 0)  ||
                                  (result_tc3[index_tc3][p].noidung.localeCompare("b. Điểm trung bình chung học kì từ  3,20 đến 3,59") == 0) ||
                                  (result_tc3[index_tc3][p].noidung.localeCompare("c. Điểm trung bình chung học kì từ  2,50 đến 3,19") == 0) ||
                                  (result_tc3[index_tc3][p].noidung.localeCompare("d. Điểm trung bình chung học kì từ  2,00 đến 2,49") == 0) ||
                                  (result_tc3[index_tc3][p].noidung.localeCompare("đ. Điểm trung bình chung học kì  dưới 2,00") == 0) ||
                                  (result_tc3[index_tc3][p].noidung.localeCompare("a. Kết quả học tập tăng một bậc so với học kỳ trước,  ĐTBCHK từ  2,00 trở lên") == 0) ||
                                  (result_tc3[index_tc3][p].noidung.localeCompare("b. Kết quả học tập tăng hai bậc so với học kỳ trước,  ĐTBCHK từ  2,00 trở lên") == 0) 
                           
                                ) {
                                  disabled_string = "readonly";
                                }
  
                                if (
                                  (result_tc3[index_tc3][p].noidung.localeCompare("a. Điểm trung bình chung học kì từ  3,60 đến 4,00") == 0)  ||
                                  (result_tc3[index_tc3][p].noidung.localeCompare("b. Điểm trung bình chung học kì từ  3,20 đến 3,59") == 0) ||
                                  (result_tc3[index_tc3][p].noidung.localeCompare("c. Điểm trung bình chung học kì từ  2,50 đến 3,19") == 0) ||
                                  (result_tc3[index_tc3][p].noidung.localeCompare("d. Điểm trung bình chung học kì từ  2,00 đến 2,49") == 0) ||
                                  (result_tc3[index_tc3][p].noidung.localeCompare("đ. Điểm trung bình chung học kì  dưới 2,00") == 0) ||
                                  (result_tc3[index_tc3][p].noidung.localeCompare("a. Kết quả học tập tăng một bậc so với học kỳ trước,  ĐTBCHK từ  2,00 trở lên") == 0) ||
                                  (result_tc3[index_tc3][p].noidung.localeCompare("b. Kết quả học tập tăng hai bậc so với học kỳ trước,  ĐTBCHK từ  2,00 trở lên") == 0) ||
                                  (result_tc3[index_tc3][p].noidung.localeCompare("c. Sinh viên năm thứ I, nếu có kết quả học tập HK I từ 2,00 trở lên") == 0) 
                                ) {
                          
  
                                  $("#tbody_noiDungDanhGia").append(
                                    "<tr>\
                                                    <td>" +
                                      result_tc3[index_tc3][p].noidung +
                                      "</span></td>\
                                                    <td><em>" +
                                      result_tc3[index_tc3][p].diem +
                                      "đ</em></td>\
                                                    <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
                                      result_tc3[index_tc3][p].diem +
                                      ")' max_value='" +
                                      result_tc3[index_tc3][p].diem+
                                      "'  id='TC3_" +
                                      result_tc3[index_tc3][p].matc3 +
                                      "' " +
                                      disabled_string +
                                      " disabled/></td>\
                                      <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
                                      result_tc3[index_tc3][p].diem +
                                      ")' max_value='" +
                                      result_tc3[index_tc3][p].diem+
                                      "'  id='CVHT_TC3_" +
                                      result_tc3[index_tc3][p].matc3 +
                                      "' " +
                                      disabled_string +
                                      " /></td>\
                                      <td></td>\
                                      <td> <a href='#' id='show_file_minhchung_TC3_"+ result_tc3[index_tc3][p].matc3 +"' target='_blank' ></a>\
                                      <form id='formDanhGiaDRL_TC3_"+ result_tc3[index_tc3][p].matc3 +"' method='post' enctype='multipart/form-data'></form>\</td>\
                                                    </tr>"
                                  );
                                }else{
                                  $("#tbody_noiDungDanhGia").append(
                                    "<tr>\
                                                    <td>" +
                                      result_tc3[index_tc3][p].noidung +
                                      "</span></td>\
                                                    <td><em>" +
                                      result_tc3[index_tc3][p].diem +
                                      "đ</em></td>\
                                                    <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
                                      result_tc3[index_tc3][p].diem +
                                      ")' max_value='" +
                                      result_tc3[index_tc3][p].diem+
                                      "'  id='TC3_" +
                                      result_tc3[index_tc3][p].matc3 +
                                      "' " +
                                      disabled_string +
                                      "  disabled /></td>\
                                      <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this," +
                                      result_tc3[index_tc3][p].diem +
                                      ")' max_value='" +
                                      result_tc3[index_tc3][p].diem+
                                      "'  id='CVHT_TC3_" +
                                      result_tc3[index_tc3][p].matc3 +
                                      "' " +
                                      disabled_string +
                                      " /></td>\
                                      <td>\
                                        <button type='button' class='btn btn-light btn_XemDanhSachHoatDong' style='color: black;width: max-content;' data-bs-toggle='modal' data-bs-target='#XemDanhSachHoatDongModal' data-tieuchi-id='TC3_" + result_tc3[index_tc3][p].matc3 + "' data-tentieuchi='"+ result_tc3[index_tc3][p].noidung +"' >Danh sách</button>\
                                      </td>\
                                      <td>\
                                      <div class='box'>\
                                          <a href='#' id='show_file_minhchung_TC3_"+ result_tc3[index_tc3][p].matc3 +"' target='_blank' ></a>\
                                          <form id='formDanhGiaDRL_TC3_"+ result_tc3[index_tc3][p].matc3 +"' method='post' enctype='multipart/form-data'>\
                                          <input type='file' name='fileMinhChung' id='file_minhchung_TC3_"+ result_tc3[index_tc3][p].matc3 +"' class='inputfile inputfile-1' accept='.png,.jpg,.jpeg' data-multiple-caption='{count} files selected' >\
                                          <label for='file_minhchung_TC3_"+ result_tc3[index_tc3][p].matc3 +"'><svg xmlns='http://www.w3.org/2000/svg' width='20' height='17' viewBox='0 0 20 17'><path d='M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z'></path></svg> <span>Chọn tệp…</span></label>\
                                        </form>\
                                        </div>\
                                    </td>\
                                        </tr>"
                                  );
                                }
  
  
                                
                              }
  
                              // <td><input type='text' style='width: 100px;'  id='ghiChuTC3_" + result_tc3[index_tc3][p].matc3 + "' /></td>\
                            }
                          });
                        },
                        error: function (errorMessage_tc3) {
                          thongBaoLoi(errorMessage_tc3.responseText);
                        },
                      });
                    }
                  }
                });
              },
              error: function (errorMessage_tc2) {
                thongBaoLoi(errorMessage_tc2.responseText);
              },
            });
  
            $("#tbody_noiDungDanhGia").append(
              "<tr style='background: darkseagreen;' >\
                  <td style='font-weight: bold;' >Cộng: </span>\
                  </td>\
                  <td><em></em></td>\
                  <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this," +
                result[index][i].diemtoida +
                ")' max-value='" +
                result[index][i].diemtoida +
                "' min='0' max='" +
                result[index][i].diemtoida +
                "' id='TongCong_TC1_" +
                result[index][i].matc1 +
                "' disabled/></td>\
                <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this," +
                result[index][i].diemtoida +
                ")' max-value='" +
                result[index][i].diemtoida +
                "' min='0' max='" +
                result[index][i].diemtoida +
                "' id='CVHT_TongCong_TC1_" +
                result[index][i].matc1 +
                "' disabled/></td>\
                <td></td>\
                <td></td>\
                  </tr>"
            );
          }
        });
      },
      error: function (errorMessage) {
        thongBaoLoi(errorMessage.responseText);
      },
    });
  
    $("#tbody_noiDungDanhGia").append(
      "<tr>\
              <td style='font-weight: bold;' >ĐIỂM TỔNG CỘNG (tối đa không quá 100 điểm): </span>\
              </td>\
              <td><em></em></td>\
              <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this, 100)' id='input_diemtongcong' readonly='true'/></td>\
              <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this, 100)' id='CVHT_input_diemtongcong' name='diemTongCong' readonly='true'/></td>\
              <td></td>\
              <td></td>\
              </tr>"
    );

    $("#tbody_noiDungDanhGia").append(
        "<tr>\
            <td style='font-weight: bold;' ></td>\
            <td></td>\
            <td style='font-weight: bold;text-transform: uppercase;' colspan='2' >Xếp loại: <span id='text_XepLoai' ></span></td>\
            <td style='font-weight: bold;'  ><span></span></td>\
        </tr>"
    );


}

function getThongTinNguoiDung() {
  if (GET_MaSinhVien != null) {
 
    $.ajax({
      url: urlapi_sinhvien_single_read + GET_MaSinhVien,
      async: false,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      headers: {
        Authorization: jwtCookie,
      },
      success: function (result) {
        var hoTenSinhVien = result["hoTenSinhVien"];
        var ngaySinh = new Date(result["ngaySinh"]);
        var maLop = result["maLop"];
        var he = result["he"];

        $.ajax({
          url: urlapi_lop_single_read + maLop,
          async: false,
          type: "GET",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          headers: {
            Authorization: jwtCookie,
          },
          success: function (result_Lop) {
            var maKhoa = result_Lop["maKhoa"];

            $.ajax({
              url: urlapi_khoa_single_read + maKhoa,
              async: false,
              type: "GET",
              contentType: "application/json;charset=utf-8",
              dataType: "json",
              headers: {
                Authorization: jwtCookie,
              },
              success: function (result_Khoa) {
                var tenKhoa = result_Khoa["tenKhoa"];

                
                    $.ajax({
                        url: urlapi_hockydanhgia_single_read + GET_MaHocKy,
                        async: false,
                        type: "GET",
                        contentType: "application/json;charset=utf-8",
                        dataType: "json",
                        headers: {
                            Authorization: jwtCookie,
                        },
                        success: function (result_HKDG) {
                            var input_hocKyXet = result_HKDG.hocKyXet;
                            var input_namHocXet = result_HKDG.namHocXet;
  
                            $("#part_thongTinSinhVien").append("\<div class='row'>\
                                <div class='col'>\
                                <span style='font-weight: bold;'>Họ tên: </span>" + hoTenSinhVien + "\</div>\
                                <div class='col'>\
                                <span style='font-weight: bold;'>Mã số sinh viên: </span>" + GET_MaSinhVien + "\
                                </div>\
                                <div class='col'>\
                                <span style='font-weight: bold;'>Ngày sinh: </span>" + ngaySinh.toLocaleDateString() + "\
                                </div>\
                                <div class='col'>\
                                <span style='font-weight: bold;'>Lớp: </span><span id='text_MaLop'>" + maLop +"</span>\
                                </div>\
                                </div>\
                                <div class='row'>\
                                <div class='col'>\
                                <span style='font-weight: bold;'>Khoa: </span>" + tenKhoa + "\
                                </div>\
                                <div class='col'>\
                                <span style='font-weight: bold;'>Hệ: </span>" + he + "\
                                </div>\
                                <div class='col'>\
                                <span style='font-weight: bold;'>Học kỳ: </span>" + input_hocKyXet + "\
                                </div>\
                                <div class='col'>\
                                <span style='font-weight: bold;'>Năm học: </span>" + input_namHocXet + "\
                                </div>\
                                <div class='col' style='display: none;'>\
                                <input type='text' id='input_maHocKyDanhGia' value='" +GET_MaHocKy +"' /></span>\
                                </div>\
                                </div>\
                                ");
                              },
                              error: function (errorMessage_tc3) {
                                thongBaoLoi(errorMessage_tc3.responseText);
                              },
                            });
                  }
                      
              
            });
              
          },
          error: function (errorMessage) {
            thongBaoLoi(errorMessage.responseText);
          },
        });
      },
      error: function (errorMessage) {
        thongBaoLoi(errorMessage.responseText);
      },
    });
  }
}

//Kiểm tra hợp lệ trước khi thêm phiếu điểm rèn luyện
function checkValidateInput(){
    var _inputTBCHocKyTruoc = $('#inputTBCHocKyTruoc').val();
    var _inputTBCHocKyDangXet = $('#inputTBCHocKyDangXet').val();
    var _input_diemtongcong = $('#CVHT_input_diemtongcong').val();

   
    if (_input_diemtongcong == ''){
      thongBaoLoi("Vui lòng nhập điểm TỔNG CỘNG cuối cùng.");
      return false;
    }

    if (_input_diemtongcong > 100){
      thongBaoLoi("Điểm tổng cộng không quá 100! Mời nhập lại!");
      return false;
    }

    if (_inputTBCHocKyTruoc != null){
      if (isNaN(parseFloat(_inputTBCHocKyTruoc))){
        thongBaoLoi("Điểm trung bình chung phải là số! Mời nhập lại!");
        return false;
      }else{
        if (parseFloat(_inputTBCHocKyTruoc) > 4){
          thongBaoLoi("Điểm trung bình chung phải nhỏ hơn 4 (hệ 4)!");
          return false;
        }
      }
    }

    if (_inputTBCHocKyDangXet != null){
      if (isNaN(parseFloat(_inputTBCHocKyDangXet))){
        thongBaoLoi("Điểm trung bình chung phải là số! Mời nhập lại!");
        return false;
      }else{
        if (parseFloat(_inputTBCHocKyTruoc) > 4){
          thongBaoLoi("Điểm trung bình chung phải nhỏ hơn 4 (hệ 4)!");
          return false;
        }
      }
    }

    
    return true;
      
   

}


  //Load thông tin sinh viên đã đánh giá
  function LoadThongTinSinhVienDanhGia() {
    var maPhieuRenLuyen = "PRL" + GET_MaHocKy + GET_MaSinhVien;
  
    $.ajax({
      url:
      urlapi_phieurenluyen_single_read +
        maPhieuRenLuyen,
      async: false,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      headers: {
        Authorization: jwtCookie,
      },
      success: function (result_PRL) {
  
        var xepLoai = result_PRL.xepLoai;
        var diemTongCong = result_PRL.diemTongCong;
        var diemTrungBinhChungHKTruoc = result_PRL.diemTrungBinhChungHKTruoc;
        var diemTrungBinhChungHKXet = result_PRL.diemTrungBinhChungHKXet;
        
  
        $.ajax({
          url:
          urlapi_chamdiemrenluyen_read_maPhieuRenLuyen +
            maPhieuRenLuyen,
          async: false,
          type: "GET",
          contentType: "application/json;charset=utf-8",
          dataType: "json",
          headers: {
            Authorization: jwtCookie,
          },
          success: function (result_CD) {
            $("#inputTBCHocKyTruoc").val(diemTrungBinhChungHKTruoc);
            $("#inputTBCHocKyDangXet").val(diemTrungBinhChungHKXet);
            $("#input_diemtongcong").val(diemTongCong);
            $("#CVHT_input_diemtongcong").val(diemTongCong);
            $("#text_XepLoai").text(xepLoai);
            
  
            $.each(result_CD, function (index_cd) {
              for (var p = 0; p < result_CD[index_cd].length; p++) {
  
                var maTieuChi2 = result_CD[index_cd][p].maTieuChi2;
                var maTieuChi3 = result_CD[index_cd][p].maTieuChi3;
                var diemSinhVienDanhGia = result_CD[index_cd][p].diemSinhVienDanhGia;
                var diemLopDanhGia = result_CD[index_cd][p].diemLopDanhGia;
  
                var fileMinhChung = result_CD[index_cd][p].fileMinhChung;
                var fileMinhChung_Name = fileMinhChung.substring(
                  fileMinhChung.lastIndexOf("/") + 1
                );
  
                
                $("#tbody_noiDungDanhGia")
                  .find("input")
                  .each(function () {
                    var tieuChi = this.id.slice(0, 3);
                    var maTieuChi = this.id.slice(4, 9);
  
                    if (tieuChi == "TC2") {
                      if (maTieuChi2 == maTieuChi) {
                        $("#" + this.id).val(diemSinhVienDanhGia);
  
                        $("#show_file_minhchung_"+ this.id).text(fileMinhChung_Name);
                        $("#show_file_minhchung_"+ this.id).attr("href", fileMinhChung);
  
                        if (diemLopDanhGia != 0) {
                          $("#CVHT_" + this.id).val(diemLopDanhGia);
                        } else {
                          $("#CVHT_" + this.id).val(diemSinhVienDanhGia);
                        }
                      }
                    }
  
                    if (tieuChi == "TC3") {
                      if (maTieuChi3 == maTieuChi) {
                        $("#" + this.id).val(diemSinhVienDanhGia);
  
                        $("#show_file_minhchung_"+ this.id).text(fileMinhChung_Name);
                        $("#show_file_minhchung_"+ this.id).attr("href", fileMinhChung);
  
                     
  
                        if (diemLopDanhGia != 0) {
                          $("#CVHT_" + this.id).val(diemLopDanhGia);
                        } else {
                          $("#CVHT_" + this.id).val(diemSinhVienDanhGia);
                        }
                      }
                    }
                  });
              }
            });
          },
          error: function (errorMessage_tc3) {
            window.location.href = 'cvht_duyetdiemrenluyen.php'; //nếu chưa chấm thì kh được phép vào trang chamlaichitiet
            thongBaoLoi(errorMessage_tc3.responseText);
          },
        });
  
      },
      error: function (errorMessage_tc3) {
        thongBaoLoi(errorMessage_tc3.responseText);
      },
    });
  }



  //hàm dùng khi onclick modal
function LoadDanhSachHoatDongDaThamGia(maHocKyDanhGia, maTieuChi) {
  var tieuChi_sliced_truoc = maTieuChi.slice(0, 3);
  var tieuChi_sliced_value = maTieuChi.slice(4, maTieuChi.length);
  var maSinhVien = GET_MaSinhVien;

  $('#id_tbody_DanhSachThamGiaHoatDong tr').remove();
  $.ajax({
    url: urlapi_thamgiahoatdong_read_MaSV + maSinhVien,
    async: false,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    dataType: "json",
    headers: {
      Authorization: jwtCookie,
    },
    success: function (result_CD) {
     
      $.each(result_CD, function (index_cd) {
        for (var p = 0; p < result_CD[index_cd].length; p++) {

          var thamgiahd_maHoatDong = result_CD[index_cd][p].maHoatDong;
         
          $.ajax({
            url: urlapi_hoatdongdanhgia_single_read + thamgiahd_maHoatDong,
            async: false,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            headers: {
              Authorization: jwtCookie,
            },
            success: function (result_hoatdongdanhgia) {
             
              if (result_hoatdongdanhgia.maHocKyDanhGia == maHocKyDanhGia){

                if(tieuChi_sliced_truoc == 'TC2'){
                    if (tieuChi_sliced_value == result_hoatdongdanhgia.maTieuChi2){
                        $('#id_tbody_DanhSachThamGiaHoatDong').append("<tr>\
                        <td>"+ thamgiahd_maHoatDong +"</td>\
                        <td>"+ result_hoatdongdanhgia.tenHoatDong +"</td>\
                        <td>"+ result_hoatdongdanhgia.diemNhanDuoc +"</td>\
                      </tr>");
                    }

                }

                if (tieuChi_sliced_truoc == 'TC3'){
                  if (tieuChi_sliced_value == result_hoatdongdanhgia.maTieuChi3){
                      $('#id_tbody_DanhSachThamGiaHoatDong').append("<tr>\
                      <td>"+ thamgiahd_maHoatDong +"</td>\
                      <td>"+ result_hoatdongdanhgia.tenHoatDong +"</td>\
                      <td>"+ result_hoatdongdanhgia.diemNhanDuoc +"</td>\
                    </tr>");
                  }

                }

                
              }
              
              
            },
            error: function (errorMessage_tc3) {
              thongBaoLoi(errorMessage_tc3.responseText);
            },
          });


        }
      });

    },
    error: function (errorMessage_tc3) {
      $('#id_tbody_DanhSachThamGiaHoatDong').append("<tr>\
      <td colspan='4' style='text-align:center'>Không tìm thấy kết quả.</td>\
      </tr>");

      //thongBaoLoi(errorMessage_tc3.responseText);
    },
  });


  
}