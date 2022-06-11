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

function thongBaoLoi(message) {
  Swal.fire({
    icon: "error",
    title: "Lỗi",
    text: message,
    //timer: 5000,
    timerProgressBar: true,
  });
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



//---------------------------------------------//

function checkLoiDangNhap(message) {
  if ( message.localeCompare("Vui lòng đăng nhập trước!") == 0 ){
      deleteAllCookies();
      location.href = 'login.php';
  }
}


var jwtCookie = getCookie("jwt");

//phieurenluyen//
function GetListPhieurenluyen() {

    $("#id_tbodyPhieuRenLuyen tr").remove();

        $.ajax({
            url: urlapi_phieurenluyen_read,
            type: "GET",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            async: true,
            headers: { 'Authorization': jwtCookie },
            success: function(result) {
                
                $('#idPhanTrang').pagination({
                    dataSource: result['phieurenluyen'],
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
                                <td class='cell'><span class='truncate'>"+ data[i].maPhieuRenLuyen +"</span></td>\
                                <td class='cell'>"+ data[i].maSinhVien +"</td>\
                                <td class='cell'>"+ data[i].maHocKyDanhGia +"</td>\
                                <td class='cell'>"+ data[i].diemTongCong +"</td>\
                                <td class='cell'>"+ data[i].xepLoai +"</td>\
                                <td class='cell'>"+ SetTrangThaiDuyet(data[i].coVanDuyet) +"</td>\
                                <td class='cell'>"+ SetTrangThaiDuyet(data[i].khoaDuyet) +"</td>\
                                <td class='cell'><a href='"+ data[i].fileDinhKem +"' >"+ data[i].fileDinhKem.substring(data[i].fileDinhKem.lastIndexOf('/') + 1) +"</a></td>\
                                <td class='cell'>\
                                  <button type='button' data-bs-toggle='modal' data-bs-target='#ModalXemVaDuyet' class='btn btn-secondary btn_XemVaDuyet' style='color: white;margin: 5px;' data-id='" + data[i].maPhieuRenLuyen +
                                  "' data-mssv-id='"+ data[i].maSinhVien +"' data-mahocky-id='"+ data[i].maHocKyDanhGia +"' >Xem chi tiết và duyệt</button>\
                                  <a class='btn' href='#' style='color: white;background: #c04f4f;margin: 5px;'><img src='assets/images/icons/pdf.png' width='17px' /><span style='margin-left: 5px;'>Xuất phiếu</span> </a>\
                                </td>\
                                </tr>";
                           
                        }

                       $("#id_tbodyPhieuRenLuyen").html(htmlData);
                    }

                });

            },
            error: function(errorMessage) {
              checkLoiDangNhap(errorMessage.responseJSON.message);

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

function SetTrangThaiDuyet(value) {
  var trangThaiDuyet = '';
  if (value == 1){
    trangThaiDuyet = "<span class='badge bg-success' style='color: white;font-size: inherit;'>Đã duyệt</span>";
  }else{
    if (value == 0){
      trangThaiDuyet = "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Chưa duyệt</span>";
    }
  }
  
  return trangThaiDuyet;


}


function LoadComboBoxThongTinKhoa() {
    //Load khoa
    $.ajax({
      url: urlapi_khoa_read,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: false,
      headers: { Authorization: jwtCookie },
      success: function (result_Khoa) {
        $("#select_Khoa").find("option").remove();
  
        $("#select_Khoa").append(
          "<option selected value='tatcakhoa'>Tất cả khoa</option>"
        );
  
        $.each(result_Khoa, function (index_Khoa) {
          for (var p = 0; p < result_Khoa[index_Khoa].length; p++) {
            $("#select_Khoa").append(
              "<option value='" +
                result_Khoa[index_Khoa][p].maKhoa +
                "'>" +
                result_Khoa[index_Khoa][p].tenKhoa +
                "</option>"
            );
          }
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
                          <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this,"+ result_tc2[index_tc2][k].diemtoida +")' id='TC2_" + result_tc2[index_tc2][k].matc2 +"' disabled/></td>\
                          <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this,"+ result_tc2[index_tc2][k].diemtoida +")' id='CVHT_TC2_" + result_tc2[index_tc2][k].matc2 +"' /></td>\
                          <td></td>\
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
                            "<br>Điểm TBC học kỳ trước: <input type='number' step='0.01' onchange='changeNumberHandle(this,4)' id='inputTBCHocKyTruoc' name='diemTrungBinhChungHKTruoc' style='width: 100px;margin-right: 30px' />Điểm TBC học kỳ đang xét: <input type='number' step='0.01' onchange='changeNumberHandle(this,4)' id='inputTBCHocKyDangXet' name='diemTrungBinhChungHKXet' style='width: 100px;' /> </em></td>\
                                            <td></td>\
                                            <td></td>\
                                            <td></td>\
                                            <td></td>\
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
                                disabled_string = "disabled";
                              }

                              //console.log(result_tc3[index_tc3][p].noidung);

                              $("#tbody_noiDungDanhGia").append(
                                "<tr>\
                                    <td>" +result_tc3[index_tc3][p].noidung +"</span></td>\
                                    <td><em>" +result_tc3[index_tc3][p].diem +"đ</em></td>\
                                    <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this,"+ result_tc3[index_tc3][p].diem +")' id='TC3_" + result_tc3[index_tc3][p].matc3 + "' disabled /></td>\
                                    <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this,"+ result_tc3[index_tc3][p].diem +")' id='CVHT_TC3_" + result_tc3[index_tc3][p].matc3 + "' /></td>\
                                    <td></td>\
                                 </tr>"
                              );
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
                <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this,"+ result[index][i].diemtoida +")' id='TongCong_TC1_" + result[index][i].matc1 +"' disabled/></td>\
                <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this,"+ result[index][i].diemtoida +")' id='CVHT_TongCong_TC1_" + result[index][i].matc1 +"' /></td>\
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
            <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this, 100)' id='input_diemtongcong'  disabled/></td>\
            <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this, 100)' id='CVHT_input_diemtongcong' name='diemTongCong' /></td>\
        </tr>"
  );

  $("#tbody_noiDungDanhGia").append(
    "<tr>\
            <td style='font-weight: bold;' >FILE MINH CHỨNG ĐÍNH KÈM (NẾU CÓ): </span>\
            <a href='#' id='input_fileDinhKem' name='fileDinhKem' ></a>\
            <br> <span>Chỉ nhận file định dạng .zip và .rar (file nén)</span>\
            </td>\
            <td style='font-weight: bold;text-transform: uppercase;' colspan='2' >Xếp loại: <span id='text_XepLoai' ></span></td>\
            <td style='font-weight: bold;'  ><span></span></td>\
        </tr>"
  );
}


//Load thông tin sinh viên lên phiếu
function getThongTinNguoiDung(GET_MaSinhVien, GET_MaHocKy) {

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
                          
                            $("#part_thongTinSinhVien").empty();

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



//Load thông tin sinh viên đã đánh giá
function LoadThongTinSinhVienDanhGia(maPhieuRenLuyen) {
    
  $.ajax({
      url: urlapi_phieurenluyen_single_read + maPhieuRenLuyen,
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
         var coVanDuyet = result_PRL.coVanDuyet;
         var fileDinhKem = result_PRL.fileDinhKem;
         var fileDinhKem_Name = fileDinhKem.substring(fileDinhKem.lastIndexOf('/') + 1);
        
         console.log(xepLoai);

         $.ajax({
          url: urlapi_chamdiemrenluyen_read_maPhieuRenLuyen + maPhieuRenLuyen,
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
            //$("#input_diemtongcong").val(diemTongCong);
            if (coVanDuyet == 1){
              $("#CVHT_input_diemtongcong").val(diemTongCong);
            }
            
            $("#text_XepLoai").text(xepLoai);
            $("#input_fileDinhKem").text(fileDinhKem_Name);
            $("#input_fileDinhKem").attr("href", fileDinhKem);


            $.each(result_CD, function (index_cd) {
              for (var p = 0;p < result_CD[index_cd].length;p++) {
                var maTieuChi2 = result_CD[index_cd][p].maTieuChi2;
                var maTieuChi3 = result_CD[index_cd][p].maTieuChi3;
                var diemSinhVienDanhGia = result_CD[index_cd][p].diemSinhVienDanhGia;
                var diemLopDanhGia = result_CD[index_cd][p].diemLopDanhGia;

                $('#tbody_noiDungDanhGia').find('input').each(function () {
                    var tieuChi = this.id.slice(0, 3);
                    var maTieuChi = this.id.slice(4,9);

                    if (tieuChi == 'TC2'){
                      if (maTieuChi2 == maTieuChi){
                        $("#" + this.id).val(diemSinhVienDanhGia);
                        
                        if (diemLopDanhGia != 0){
                          $("#CVHT_" + this.id).val(diemLopDanhGia);
                        }else{
                          $("#CVHT_" + this.id).val(0);
                        }
                        
                      }
                    }

                    if (tieuChi == 'TC3'){
                      if (maTieuChi3 == maTieuChi){
                        $("#" + this.id).val(diemSinhVienDanhGia);

                        if (diemLopDanhGia != 0){
                          $("#CVHT_" + this.id).val(diemLopDanhGia);
                        }else{
                          $("#CVHT_" + this.id).val(0);
                        }
                      }
                    }
          
                });


              }
            });
  
          },
          error: function (errorMessage_tc3) {
            thongBaoLoi(errorMessage_tc3.responseJSON.message);
          },
        });

       
      },
      error: function (errorMessage_tc3) {
        thongBaoLoi(errorMessage_tc3.responseJSON.message);
      },
  });



}


