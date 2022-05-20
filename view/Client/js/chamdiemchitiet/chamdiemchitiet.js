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

function changeNumberHandle(val, number)
{
  if (Number(val.value) > number)
  {
    val.value = number
  }
}

var jwtCookie = getCookie("jwt");

//Show tiêu chí đánh giá
function getTieuChiDanhGia() {
    //Ajax tieuchicap1
    $.ajax({
        url: "../../../api/tieuchicap1/read.php",
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

                $("#tbody_noiDungDanhGia").append("<tr>\
                <td style='font-weight: bold;'>" +result[index][i].noidung + "</td>\
                <td></td>\
                <td></td>\
                </tr>");

            //Ajax tieuchicap2
            $.ajax({
                url: "../../../api/tieuchicap2/read.php",
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
                            if (result[index][i].matc1 === result_tc2[index_tc2][k].matc1) {
                            
                                if (result_tc2[index_tc2][k].diemtoida != 0) {
                                    $("#tbody_noiDungDanhGia").append("<tr>\
                                        <td><em>" + result_tc2[index_tc2][k].noidung +"</em></td>\
                                        <td><em>" +result_tc2[index_tc2][k].diemtoida +"đ</em></td>\
                                        <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this,"+ result_tc2[index_tc2][k].diemtoida +")' id='TC2_" + result_tc2[index_tc2][k].matc2 +"' /></td>\
                                        <td><input type='text' style='width: 100px;'  id='ghiChuTC2_" + result_tc2[index_tc2][k].matc2 +"' /></td>\
                                    </tr>");
                                    
                                } else {
                                    if (result_tc2[index_tc2][k].noidung == "1.Kết quả học tập: ") {
                                        $("#tbody_noiDungDanhGia").append("<tr>\
                                            <td><em>" + result_tc2[index_tc2][k].noidung +"<br>Điểm TBC học kỳ trước: <input type='number' id='inputTBCHocKyTruoc' style='width: 100px;margin-right: 30px' />Điểm TBC học kỳ đang xét: <input type='number' id='inputTBCHocKyDangXet' style='width: 100px;' /> </em></td>\
                                            <td></td>\
                                            <td></td>\
                                            <td></td>\
                                            </tr>"
                                    );
                                    } else {
                                        $("#tbody_noiDungDanhGia").append("<tr>\
                                            <td><em>" + result_tc2[index_tc2][k].noidung +"</em></td>\
                                            <td></td>\
                                            <td></td>\
                                            <td></td>\
                                            </tr>"
                                        );
                                    }
                                }

                                //Ajax tieuchicap3
                                $.ajax({
                                    url: "../../../api/tieuchicap3/read.php",
                                    async: false,
                                    type: "GET",
                                    contentType: "application/json;charset=utf-8",
                                    dataType: "json",
                                    headers: {
                                        Authorization: jwtCookie,
                                    },
                                    success: function (result_tc3) {
                                        $.each(result_tc3, function (index_tc3) {
                                        for (var p = 0;p < result_tc3[index_tc3].length;p++) {
                                            if (result_tc2[index_tc2][k].matc2 ===result_tc3[index_tc3][p].matc2) {
                                            // console.log(result_tc3[index_tc3][p].noidung);

                                            $("#tbody_noiDungDanhGia").append("<tr>\
                                                <td>" +result_tc3[index_tc3][p].noidung +"</span></td>\
                                                <td><em>" + result_tc3[index_tc3][p].diem + "đ</em></td>\
                                                <td><input type='number' style='width: 100px;' onchange='changeNumberHandle(this,"+ result_tc3[index_tc3][k].diem +")' id='TC3_" + result_tc3[index_tc3][p].matc3 + "' /></td>\
                                                <td><input type='text' style='width: 100px;'  id='ghiChuTC3_" + result_tc3[index_tc3][p].matc3 + "' /></td>\
                                                </tr>");

                                            }
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
                "<tr>\
                <td style='font-weight: bold;' >Cộng: </span>\
                </td>\
                <td><em></em></td>\
                <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this,"+ result[index][i].diemtoida +")' id='TC1_" + result[index][i].matc1 +"' /></td>\
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
            <td><input type='number' style='width: 100px' onchange='changeNumberHandle(this, 100)' id='input_diemtongcong' /></td>\
            <td></td>\
        </tr>"
    );

    $("#tbody_noiDungDanhGia").append(
        "<tr>\
            <td style='font-weight: bold;' >FILE MINH CHỨNG ĐÍNH KÈM (NẾU CÓ): </span>\
            <input type='file' id='input_fileDinhKem' />\
            </td>\
        </tr>"
    );


}

function getThongTinNguoiDung() {
  if (getCookie("maSo") != null) {
    var maSo = getCookie("maSo");

    $.ajax({
      url: "../../../api/sinhvien/single_read.php?maSinhVien=" + maSo,
      async: false,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      headers: {
        Authorization: jwtCookie,
      },
      success: function (result) {
        var hoTenSinhVien = result["hoTenSinhVien"];
        var ngaySinh = result["ngaySinh"];
        var maLop = result["maLop"];
        var he = result["he"];

        $.ajax({
          url: "../../../api/lop/single_read.php?maLop=" + maLop,
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
              url: "../../../api/khoa/single_read.php?maKhoa=" + maKhoa,
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
                  url: "../../../api/thongbaodanhgia/read.php",
                  async: false,
                  type: "GET",
                  contentType: "application/json;charset=utf-8",
                  dataType: "json",
                  headers: {
                    Authorization: jwtCookie,
                  },
                  success: function (result_ThongBaoDanhGia) {
                    $.each(result_ThongBaoDanhGia, function (index_TBDG) {
                      for (
                        var q = 0;
                        q < result_ThongBaoDanhGia[index_TBDG].length;
                        q++
                      ) {
                        var ngaySVDanhGia = new Date(
                          result_ThongBaoDanhGia[index_TBDG][
                            q
                          ].ngaySinhVienDanhGia
                        );
                        var ngaySVKetThucDanhGia = new Date(
                          result_ThongBaoDanhGia[index_TBDG][
                            q
                          ].ngaySinhVienKetThucDanhGia
                        );

                        //lấy ngày hiện tại
                        var today = new Date();
                        var ngayHienTai = new Date(
                          today.getFullYear() +
                            "-" +
                            (today.getMonth() + 1) +
                            "-" +
                            today.getDate()
                        );

                        //thời gian hiện tại nằm trong khoảng thời gian học kỳ còn mở chấm
                        if (
                          ngayHienTai.toLocaleDateString() >=
                            ngaySVDanhGia.toLocaleDateString() &&
                          ngayHienTai.toLocaleDateString() <=
                            ngaySVKetThucDanhGia.toLocaleDateString()
                        ) {
                          var input_maHocKyDanhGia =
                            result_ThongBaoDanhGia[index_TBDG][q]
                              .maHocKyDanhGia;

                          $.ajax({
                            url:
                              "../../../api/hockydanhgia/single_read.php?maHocKyDanhGia=" +
                              input_maHocKyDanhGia,
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

                              $("#part_thongTinSinhVien").append(
                                "\
                                                                <div class='row'>\
                                                                    <div class='col'>\
                                                                        <span style='font-weight: bold;'>Họ tên: </span>" +
                                  hoTenSinhVien +
                                  "\
                                                                    </div>\
                                                                    <div class='col'>\
                                                                        <span style='font-weight: bold;'>Mã số sinh viên: </span>" +
                                  maSo +
                                  "\
                                                                    </div>\
                                                                    <div class='col'>\
                                                                        <span style='font-weight: bold;'>Ngày sinh: </span>" +
                                  ngaySinh +
                                  "\
                                                                    </div>\
                                                                    <div class='col'>\
                                                                        <span style='font-weight: bold;'>Lớp: </span>" +
                                  maLop +
                                  "\
                                                                    </div>\
                                                                </div>\
                                                                <div class='row'>\
                                                                    <div class='col'>\
                                                                        <span style='font-weight: bold;'>Khoa: </span>" +
                                  tenKhoa +
                                  "\
                                                                    </div>\
                                                                    <div class='col'>\
                                                                        <span style='font-weight: bold;'>Hệ: </span>" +
                                  he +
                                  "\
                                                                    </div>\
                                                                    <div class='col'>\
                                                                        <span style='font-weight: bold;'>Học kỳ: </span>" +
                                  input_hocKyXet +
                                  "\
                                                                    </div>\
                                                                    <div class='col'>\
                                                                        <span style='font-weight: bold;'>Năm học: </span>" +
                                  input_namHocXet +
                                  "\
                                                                    </div>\
                                                                    <div class='col' style='display: none;'>\
                                                                        <input type='text' id='input_maHocKyDanhGia' value='" +
                                  input_maHocKyDanhGia +
                                  "' /></span>\
                                                                    </div>\
                                                                </div>\
                                                            "
                              );
                            },
                            error: function (errorMessage_tc3) {
                              thongBaoLoi(errorMessage_tc3.responseText);
                            },
                          });
                        }
                      }
                    });
                  },
                  error: function (errorMessage_tc3) {
                    thongBaoLoi(errorMessage_tc3.responseText);
                  },
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
    var _input_diemtongcong = $('#input_diemtongcong').val();

    if (_inputTBCHocKyTruoc == ''){
      thongBaoLoi("Vui lòng nhập điểm TBC học kỳ trước.");
      return false;
    }

    if (_inputTBCHocKyDangXet == ''){
      thongBaoLoi("Vui lòng nhập điểm TBC học kỳ đang xét.");
      return false;
    }

    if (_input_diemtongcong == ''){
      thongBaoLoi("Vui lòng nhập điểm TỔNG CỘNG cuối cùng.");
      return false;
    }
    
    
    return true;
      
   

}


//Chấm điểm rèn luyện
function chamDiemRenLuyen() {

  Swal.fire({
    title: 'Xác nhận chấm điểm rèn luyện?',
    showDenyButton: true,
    confirmButtonText: 'Xác nhận',
    denyButtonText: `Đóng`,
  }).then((result) => {
    if (result.isConfirmed) {
      if (checkValidateInput()){
        var _inputMaSinhVien = getCookie("maSo");
        var _inputDiemTBCHKTruoc = $("#inputTBCHocKyTruoc").val();
        var _inputDiemTBCHKDangXet = $("#inputTBCHocKyDangXet").val();
        var _inputMaHocKyDanhGia = $("#input_maHocKyDanhGia").val();
        var _inputDiemTongCong = $('#input_diemtongcong').val();
    
        var _inputMaPhieuRenLuyen = "PRL" + _inputMaHocKyDanhGia + _inputMaSinhVien;
        //vd: maPhieuRenLuyen = PRLHK121223118410262
    
        var dataPost_PhieuRenLuyen = {
            maPhieuRenLuyen: _inputMaPhieuRenLuyen,
            xepLoai: null,
            diemTongCong: _inputDiemTongCong,
            maSinhVien: _inputMaSinhVien,
            diemTrungBinhChungHKTruoc: _inputDiemTBCHKTruoc,
            diemTrungBinhChungHKXet: _inputDiemTBCHKDangXet,
            maHocKyDanhGia: $("#input_maHocKyDanhGia").val(),
            coVanDuyet: null,
            khoaDuyet: null,
            fileDinhKem: null
        };
    
        //Tạo phiếu rèn luyện trước
        $.ajax({
            url: "../../../api/phieurenluyen/create.php",
            async: false,
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            data: JSON.stringify(dataPost_PhieuRenLuyen),
            headers: {
                Authorization: jwtCookie,
            },
            success: function (resultCreate) {
                //console.log(resultCreate);
    
                //Vòng lặp input để tạo các hàng giá trị của chamdiemrenluyen theo mã phiếu điểm rèn luyện
                $("#tbody_noiDungDanhGia").find("input").each(function () {
                    if (this.value != "") {
                        var _inputDiemSVDanhGia = this.value;
                        var tieuChi = this.id.slice(0, 3);
    
                        //Chưa xử lý thêm ghi chú (thêm 1 switch case trước switch case tiêu chí này)
                        switch (tieuChi) {
                            case "TC2": {
                                var _inputMaTieuChi2 = this.id.slice(4, this.id.length);
    
                                var dataPost_ChamDiemRenLuyen = {
                                    maPhieuRenLuyen: _inputMaPhieuRenLuyen,
                                    maTieuChi3: null,  
                                    maTieuChi2: _inputMaTieuChi2,
                                    maSinhVien: _inputMaSinhVien,
                                    diemSinhVienDanhGia: _inputDiemSVDanhGia,
                                    diemLopDanhGia: null,
                                    ghiChu: null
                                };
    
                                //console.log(dataPost_ChamDiemRenLuyen);
    
                                $.ajax({
                                url: "../../../api/chamdiemrenluyen/create.php",
                                    async: false,
                                    type: "POST",
                                    contentType: "application/json;charset=utf-8",
                                    dataType: "json",
                                    data: JSON.stringify(dataPost_ChamDiemRenLuyen),
                                    headers: {
                                        Authorization: jwtCookie,
                                    },
                                    success: function (resultCreate_ChamDiemRenLuyen) {
                                        //console.log(resultCreate_ChamDiemRenLuyen);
                                    },
                                    error: function (errorMessage) {
                                        Swal.fire({
                                        icon: "error",
                                        title: "Lỗi",
                                        text: errorMessage.responseText,
                                        //timer: 5000,
                                        timerProgressBar: true,
                                        });
                                    },
                                });
    
                                break;
                            }
    
                            case "TC3": {
                                var _inputMaTieuChi3 = this.id.slice(4, this.id.length);
    
                                var dataPost_ChamDiemRenLuyen = {
                                    maPhieuRenLuyen: _inputMaPhieuRenLuyen,
                                    maTieuChi3: _inputMaTieuChi3,
                                    maSinhVien: _inputMaSinhVien,
                                    diemSinhVienDanhGia: _inputDiemSVDanhGia,
                                    maTieuChi2: null,
                                    ghiChu: null,
                                    diemLopDanhGia: null
    
                                };
    
                                //console.log(dataPost_ChamDiemRenLuyen);
                         
                                $.ajax({
                                url: "../../../api/chamdiemrenluyen/create.php",
                                    async: false,
                                    type: "POST",
                                    contentType: "application/json;charset=utf-8",
                                    dataType: "json",
                                    data: JSON.stringify(dataPost_ChamDiemRenLuyen),
                                    headers: {
                                        Authorization: jwtCookie,
                                    },
                                    success: function (resultCreate_ChamDiemRenLuyen) {
                                        //console.log(resultCreate_ChamDiemRenLuyen);
                                    },
                                    error: function (errorMessage) {
                                        Swal.fire({
                                        icon: "error",
                                        title: "Lỗi",
                                        text: errorMessage.responseText,
                                        //timer: 5000,
                                        timerProgressBar: true,
                                        });
                                    },
                                });
    
                                break;
                            }
    
                            default: {
                                break;
                            }
                        }
    
                    }
                });

                Swal.fire('Chấm điểm rèn luyện thành công!', '', 'success');
            },
            error: function (errorMessage_tc3) {
                Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    text: errorMessage_tc3.responseText,
                    //timer: 5000,
                    timerProgressBar: true,
                });
            },
        });
      
    
      }


      
    }
  })

  


    
}


function Test(){



}
