<?php
    include_once "header.php";
?>

    <!-- Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <h3 style="text-transform: uppercase;">Quản lý tài khoản</h3>
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container -->
    </header>
    <!-- end of header -->

    <div class="container-xl pt-3 p-md-3">
        <div class="row gy-4">
            <div class="col-3 col-lg-3"></div>
            <div class="col-6 col-lg-6">
                <div class="shadow-sm d-flex flex-column align-items-start" style="background: white;">
                    <div class="p-3 border-bottom-0">
                        <div class="row align-items-center gx-3">
                            
                            <div class="col-auto">
                                <div class="app-icon-holder">
                                    <img src='../images/edit-account.png'>
                                </div>
                                <!--//icon-holder-->
                            </div>
                            <!--//col-->

                            <div class="col-auto">
                                <h4 class="app-card-title">Thông tin tài khoản</h4>
                            </div>
                            <!--//col-->
                        </div>
                        <!--//row-->
                    </div>

                    <!--//app-card-header-->
                    <div class="app-card-body px-4 w-100">
                        <div class="item border-bottom py-3">
                            <div class="row justify-content-between align-items-center">
                                <form action="" id="ProfileForm">
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label mb-2"><strong>Ảnh đại diện</strong></div>
                                                <div class="item-data" style='clip-path: circle();'><img class="profile-image" id="blah" src="../account-images/user.png" width="100px"></div>
                                                <input type="file" accept="image/*" id="imgInp" style="display: none;"/>
                                            </div>
                                            <!--//col-->
                                            <div class="col text-end">
                                                <button type="button" class="btn bg-warning btn_Profile_Edit" style="color: white;">Chỉnh sửa</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--//col-->
                                    <!--//item-->
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label"><strong>Họ và tên</strong></div>
                                                <div class="item-data" id="taikhoan_hovaten"></div>
                                            </div>
                                            <!--//col-->
                                        </div>
                                        <!--//row-->
                                    </div>
                                    <!--//item-->
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <div class="item-label"><strong id="taikhoan_maso_title"></strong></div>
                                                <div class="item-data" id="taikhoan_maso"></div>
                                            </div>
                                            <!--//col-->
                                        </div>
                                        <!--//row-->
                                    </div>
                                    <!--//item-->
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto form-group">
                                                <div class="item-label"><strong>Email</strong></div>
                                                <div class="item-data" id="taikhoan_email"></div>
                                                <input class="form-control" id="input_taikhoan_email" style="outline: none; border: none; display: none;" value=""/>
                                                <span class="invalid-feedback position-relative"></span>
                                            </div>
                                            <!--//col-->
                                            <div class="col text-end">
                                                <button type="button" class="btn bg-warning btn_Profile_Edit" style="color: white;">Chỉnh sửa</button>
                                            </div>
                                            <!--//col-->
                                        </div>
                                        <!--//row-->
                                    </div>
                                    <!--//item-->
                                    <div class="item border-bottom py-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto form-group">
                                                <div class="item-label"><strong>Số điện thoại</strong></div>
                                                <div class="item-data" id="taikhoan_sdt"></div>
                                                <input class="form-control" type="tel" id="input_taikhoan_sdt" style="outline: none; border: none; display: none;" value=""/>
                                                <span class="invalid-feedback position-relative"></span>
                                            </div>
                                            <!--//col-->
                                            <div class="col text-end">
                                                <button type="button" class="btn bg-warning btn_Profile_Edit" style="color: white;">Chỉnh sửa</button>
                                            </div>
                                            <!--//col-->
                                        </div>
                                        <!--//row-->
                                    </div>
                                    <!--//item-->
                                    <!-- Thêm style="display: none;" vào div dưới-->
                                    <div class="item py-3">
                                        <div class="row justify-content-center align-items-center" id="groupButtons">
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-success me-3" id="btn_Luu_EditProfile">Lưu chỉnh sửa</button>
                                                <button type="button" class="btn btn-danger" id="btn_Huy_EditProfile">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--//item-->
                    </div>
                    <!--//app-card-body-->
                </div>
                <!--//app-card-->
            </div>
            <!--//col-->

            <!-- Thêm card mới dưới ở đây -->

        <div>
        <!-- End of row gy-4 -->

        <div class="row gy-4">
            <div class="col-3 col-lg-3"></div>
            <div class="col-6 col-lg-6">
                <div class="shadow-sm d-flex flex-column align-items-start" style="background: white;">
                    <div class="app-card-body px-4 p-2 w-100">
                        <div class="item p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <img src='../images/password-reset.png'>
                                    </div>
                                    <!--//icon-holder-->
                                </div>
                                <!--//col-->

                                <div class="col-auto">
                                    <h4 class="app-card-title">Đổi mật khẩu</h4>
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                    </div>
                

                    <!--Test    -->
                    <div class="app-card-body px-4 p-2 w-100">
                        <div class="item py-3">
                            <div class="row align-items-center">
                                <form action="" id="ChangePasswordForm">
                                    <div class="form-group border-bottom pb-3">
                                        <div class="item-label"><strong>Mật khẩu hiện tại</strong></div>
                                        <input type="password" name="matKhauHienTai" class="form-control mb-0" id="input_MatKhauHienTai" placeholder="Nhập mật khẩu hiện tại...">
                                        <span class="invalid-feedback position-relative"></span>
                                    </div>
                        
                                    <div class="form-group border-bottom pb-3">
                                        <div class="item-label"><strong>Mật khẩu mới</strong></div>
                                        <input type="password" name="matKhauMoi" class="form-control mb-0" id="input_MatKhauMoi" placeholder="Nhập mật khẩu hiện tại...">
                                        <span class="invalid-feedback position-relative"></span>
                                    </div>

                                    <div class="form-group border-bottom pb-3">
                                        <div class="item-label"><strong>Xác nhận mật khẩu mới</strong></div>
                                        <input type="password" name="matKhauMoi" class="form-control mb-0" id="input_XacNhanMatKhauMoi" placeholder="Xác nhận mật khẩu mới...">
                                        <span class="invalid-feedback position-relative"></span>
                                    </div>

                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-auto">
                                            <button type="submit"class="btn btn-success">Lưu chỉnh sửa</button>
                                        </div>
                                    </div>
                                    <!--//row-->
                                </form>
                            </div>
                            <!--//row-->
                        </div>
                        <!--//item-->
                    </div>
                    <!--//app-card-body-->
                </div>
                <!--//app-card-->
            </div>
            <!--//col-->
        <div>
        <!-- End of row gy-4 -->
    </div>
    <!-- End of container -->
    <!-- Footer -->
    <div class="footer">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">


                </div>
                <!-- end of col -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container -->
    </div>
    <!-- end of footer -->

    <!-- Scripts -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Bootstrap framework -->
    <script src="../js/swiper.min.js"></script>
    <!-- Swiper for image and text sliders -->
    <script src="../js/scripts.js"></script>
    
    <!-- Form Validator -->
    <script src="../../Admin/assets/js/validator.js"></script>

    <!-- Custom scripts -->
    <script src="../js/taikhoan/taikhoan.js"></script>
        
    <script>
        loadThongTinTaiKhoanByQuyen();
        $("#ChangePasswordForm #input_MatKhauHienTai").val("");
      	$("#ChangePasswordForm #input_MatKhauHienTai").removeClass("is-invalid");
		$("#ChangePasswordForm #input_MatKhauMoi").val("");
      	$("#ChangePasswordForm #input_MatKhauMoi").removeClass("is-invalid");
      	$("#ChangePasswordForm #XacNhanMatKhauMoi").val("");
      	$("#ChangePasswordForm #XacNhanMatKhauMoi").removeClass("is-invalid");

        $("#groupButtons").hide();

        Validator({
            form: '#ChangePasswordForm',
            formGroupSelector: '.form-group',
            errorSelector: '.invalid-feedback',
            rules: [
                Validator.isRequired('#input_MatKhauHienTai'),
                Validator.isRequired('#input_MatKhauMoi'),
                Validator.isRequired('#input_XacNhanMatKhauMoi'),
                Validator.minLength('#input_MatKhauMoi', 5, "Mật khẩu phải có tối thiểu 5 ký tự"),
                Validator.isConfirmed('#input_XacNhanMatKhauMoi', function() {
                    return document.querySelector('#ChangePasswordForm #input_MatKhauMoi').value;
                }, 'Mật khẩu nhập lại không chính xác'),
            ],
            onSubmit: changePasswordByQuyen
        })

        Validator({
            form: '#ProfileForm',
            formGroupSelector: '.form-group',
            errorSelector: '.invalid-feedback',
            rules: [
                Validator.isEmail('#input_taikhoan_email'),
                Validator.isPhoneNumber('#input_taikhoan_sdt'),
            ],
            onSubmit: updateProfileByQuyen
        })

        // $(document).on("click", ".btn_ChinhSua_Email", function() {
        //     $("#taikhoan_email").hide();
        //     $("#input_taikhoan_email").val($("#taikhoan_email").text());
        //     $("#input_taikhoan_email").show();
        //     document.getElementById("input_taikhoan_email").focus();
        // })

        $("#ProfileForm").find(".btn_Profile_Edit").on("click", function(e){
            var inputElement = $(e.target).closest(".row").find("input");
            if(inputElement.attr('type') == 'file') {
                inputElement.trigger('click');
            } else {
                $(e.target).hide();
                $(e.target).closest(".row").find(".item-data").hide();
                inputElement.val(
                    $(e.target).closest(".row").find(".item-data").text()
                );
                inputElement.show();
                inputElement.focus();
            }
        })

        $("#ProfileForm").find("#imgInp").on("change", function(e){
            $("#groupButtons").show();
        })

        $(document).on("click", "#btn_Huy_EditProfile", function() {
            $("#ProfileForm").find(".item .btn_Profile_Edit").show();
            $("#ProfileForm").find(".item .col-auto .item-data").show();
            $("#ProfileForm").find(".item .col-auto input").hide();
            $("#groupButtons").hide();
        })

        // Xem hình preview trước khi upload
        $("#imgInp").on("change", function() {
            $fileName = $('input[type=file]')[0].files[0].name;
            $fileExtension = $fileName.split('.').pop();
            if ($fileExtension == 'png' || $fileExtension == 'jpg' || $fileExtension == 'jpeg') {
                readURL(this);
                console.log($('input[type=file]')[0].files[0]);
            } else {
                presentNotification("error", "Lỗi", "File tải lên phải là dạng ảnh!");
            }
        });

        $("#btn_Luu_EditProfile").on("click", function() {  
            $("#ProfileForm").find(".item .btn_Profile_Edit").show();
            $("#ProfileForm").find(".item .col-auto .item-data").show();
            $("#ProfileForm").find(".item .col-auto input").hide();
        });
    </script>
</html>