var jwtCookie = getCookie("jwt");

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

function presentNotification(iconType, titleNotification, textNotifiaction) {
    Swal.fire({
        icon: iconType,
        title: titleNotification,
        text: textNotifiaction,
        timer: 2000,
        timerProgressBar: true,
    });
}

function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#blah').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}

function loadThongTinTaiKhoanByQuyen() {
  let quyen = getCookie("quyen");
  if (quyen == "sinhvien") {
    loadThongTinTaiKhoan(urlapi_sinhvien_single_read, quyen);
  } else {
    loadThongTinTaiKhoan(urlapi_cvht_single_read, quyen);
  }
}

function loadThongTinTaiKhoan(urlApi, quyen) {
  let maSo = getCookie("maSo");
    
  $.ajax({
      url: urlApi + maSo,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",
      async: false,
      headers: { Authorization: jwtCookie },
      success: function (result_data) {
          console.log(result_data);

          //$("#imgInp").text(result_data.hoTenSinhVien);
            if(quyen == "sinhvien") {
                $("#taikhoan_hovaten").text(result_data.hoTenSinhVien);
                $("#taikhoan_maso_title").text("Mã số sinh viên");
                $("#taikhoan_maso").text(result_data.maSinhVien);
                $("#input_taikhoan_sdt").val(result_data.sdt);
                if(result_data.sdt == null) {
                    $("#taikhoan_sdt").text("Chưa có dữ liệu");
                } else {
                    $("#taikhoan_sdt").text(result_data.sdt);
                }
            } else if(quyen == "cvht") {
                $("#taikhoan_hovaten").text(result_data.hoTenCoVan);
                $("#taikhoan_maso_title").text("Mã cố vấn");
                $("#taikhoan_maso").text(result_data.maCoVanHocTap);
                $("#input_taikhoan_sdt").val(result_data.soDienThoai);
                if(result_data.soDienThoai == null) {
                    $("#taikhoan_sdt").text("Chưa có dữ liệu");
                } else {
                    $("#taikhoan_sdt").text(result_data.soDienThoai);
                }
            }
            $("#taikhoan_email").val(result_data.email);
            $("#input_taikhoan_email").val(result_data.email);

            //"null"
            if(result_data.anhDaiDien == null) {
                $("#blah").attr("src", '../../../user-images/default/user.png');
            } else if(quyen == "sinhvien") {
                $("#blah").attr("src",  '../../../user-images/sinhvien/' + maSo + '/user-avatar/' + result_data.anhDaiDien);
            } else if(quyen == "cvht"){
                $("#blah").attr("src",  '../../../user-images/cvht/' + maSo + '/user-avatar/' + result_data.anhDaiDien);
            }
            
            if(result_data.email == null) {
                $("#taikhoan_email").text("Chưa có dữ liệu");
            } else {
                $("#taikhoan_email").text(result_data.email);
            }
      },
      error: function(errorMessage) {
          console.log("Loi load thong tin tai khoan");
      }
  });
    
}

function changePasswordByQuyen() {
    var quyen = getCookie("quyen");
    if(quyen == "sinhvien") {
        changePassword(urlapi_sinhvien_single_read, urlapi_sinhvien_update_matKhau, quyen);
    } else {
        changePassword(urlapi_cvht_single_read, urlapi_cvht_update_matKhau, quyen);
    }
}

function changePassword(urlQuyen, urlUpdate, quyen) {
    var matKhauHienTai = $("#input_MatKhauHienTai").val();
    
    var objLogin = {
        taiKhoan: getCookie("maSo"), 
        matKhau: matKhauHienTai,
    };

    // Kiểm tra mật khẩu hiện tại
    $.ajax({
        url: urlQuyen + `${getCookie("maSo")}&matKhau=${matKhauHienTai}`,
        async: false,
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",
        headers: {
            Authorization: jwtCookie,
        },
        success: function (result) {
            // Update mật khẩu mới
            if(quyen == "sinhvien") {
                var dataPost_Update = {
                    maSinhVien: getCookie("maSo"),
                    matKhauSinhVien: $('#input_MatKhauMoi').val(),
                } 
            } else {
                var dataPost_Update = {
                    maCoVanHocTap: getCookie("maSo"),
                    matKhauTaiKhoanCoVan: $('#input_MatKhauMoi').val(),
                }
            }
            $.ajax({
            url: urlUpdate,
            type: "POST",
            contentType: "application/json;charset=utf-8",
            dataType: "json",
            data: JSON.stringify(dataPost_Update),
            async: false,
            headers: { Authorization: jwtCookie },
            success: function (result_Update) {
                $("#ChangePasswordForm #input_MatKhauHienTai").val("");
                $("#ChangePasswordForm #input_MatKhauMoi").val("");
                $("#ChangePasswordForm #input_XacNhanMatKhauMoi").val("");

                Swal.fire({
                icon: "success",
                title: "Thành công",
                text: "Đặt lại mật khẩu thành công!",
                timer: 2000,
                timerProgressBar: true,
                });
            },
            error: function (errorMessage) {
                Swal.fire({
                icon: "error",
                title: "Lỗi",
                text: "Cập nhật mật khẩu bị lỗi! Vui lòng thử lại sau!",
                timer: 2000,
                timerProgressBar: true,
                });
            },
            });
        },
        error: function (errorMessage) {
            Swal.fire({
            icon: "error",
            title: "Lỗi",
            text: "Mật khẩu hiện tại không chính xác!",
            timer: 3000,
            timerProgressBar: true,
            });
        },
    }); 
}

function updateProfileByQuyen() {
    var quyen = getCookie("quyen");   
    if(quyen == "sinhvien") {
        updateProfile(urlapi_sinhvien_update_taikhoan, quyen);
    } else if(quyen == "cvht") {
        updateProfile(urlapi_sinhvien_update_taikhoan, quyen);
    }
}

function updateProfile(urlApi, quyen) {
    var maSo = getCookie("maSo");
    var formData = new FormData();
    // Kiểm tra tồn tại ảnh đại diện
    formData.append('quyen', quyen);

    if (quyen == "sinhvien") {
        formData.append('maSinhVien', maSo);
    } else if (quyen == "cvht") {
        formData.append('maCoVanHocTap', maSo);
    }
    
    if($("#imgInp")[0].files.length === 0) {
        formData.append('anhDaiDien', null);
    } else {
        formData.append('anhDaiDien', $("#imgInp")[0].files[0]);
    }
    // Kiểm tra tồn tại email
    if($("#input_taikhoan_email").val() == "" || $("#input_taikhoan_email").val() == "Chưa có dữ liệu") {
        formData.append('email', null);
    } else {
        formData.append('email', $("#input_taikhoan_email").val());
    }
    // Kiểm tra tồn tại sdt
    if($("#input_taikhoan_sdt").val() == "" || $("#input_taikhoan_sdt").val() == "Chưa có dữ liệu") {
        formData.append('sdt', null);
    } if(quyen == "sinhvien") {
        formData.append('sdt', $("#input_taikhoan_sdt").val());
    } else if(quyen == "cvht") {
        formData.append('soDienThoai', $("#input_taikhoan_sdt").val());
    }
    for (const pair of formData.entries()) {
        console.log(`${pair[0]}, ${pair[1]}`);
    }

    $.ajax({
        url: urlApi + maSo,
        async: false,
        type: "POST",
        contentType: false,
        cache: false,
        processData: false,
        //dataType: "json",
        data: formData,
        headers: { Authorization: jwtCookie },
        success: function(result) {
            $("#groupButtons").hide();
            if(formData.get("anhDaiDien").name != null) {
                if(quyen == "sinhvien") {
                    $("#avatar").attr("src",  '../../../user-images/sinhvien/' + maSo + '/user-avatar/' + formData.get("anhDaiDien").name);
                } else {
                    $("#avatar").attr("src",  '../../../user-images/cvht/' + maSo + '/user-avatar/' + formData.get("anhDaiDien").name);
                }
            }
            
            loadThongTinTaiKhoanByQuyen()
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: "Cập nhật profile thành công!",
                timer: 3000,
                timerProgressBar: true
            });
        },
        error: function(errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi chỉnh sửa profile',
                text: errorMessage.responseJSON.message,
                timer: 3000,
                timerProgressBar: true
            });
        },
    });
}