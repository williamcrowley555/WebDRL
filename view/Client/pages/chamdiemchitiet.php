<?php
include_once "header.php";

if ($quyenNguoiDung != 'sinhvien') {
    echo "<script>history.go(-1)</script>";
}

if (!isset($_GET['maHocKy'])) {
    echo "<script>window.location.href = 'chamdiem.php';</script>";
}

?>


<!-- Header -->
<header id="header" class="header">
    <div class="container">
        <div class="row">
            <h3 style="text-transform: uppercase;">Chấm điểm rèn luyện</h3>
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container -->
</header>
<!-- end of header -->
<!-- end of header -->


<div style="width: 100%;">
    <div class="container">
        <div class="row" style="margin: 0 auto;text-align: center;background: white;border-radius: 10px;">
            <div style="padding: 48px;">
                <h6 style="text-transform: uppercase; text-align: left;">--Thông tin sinh viên--</h6>
                <div class="form-outline mb-4">
                    <div class="row justify-content-center" style="padding-bottom: 30px;text-align: start;" id="part_thongTinSinhVien">


                    </div>

                </div>

                <h6 style="text-transform: uppercase; text-align: left;">--PHIẾU ĐÁNH GIÁ ĐIỂM RÈN LUYỆN--</h6>

                <form id='formDanhGiaDRL' method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <div class="row justify-content-center" style="padding-bottom: 30px;text-align: start;">

                            <table class="table table-hover table-bordered" id="tablePhieuRenLuyen">
                                <thead>
                                    <tr style="text-align: center;">
                                    </tr>
                                </thead>
                                <tbody id="tbody_noiDungDanhGia">

                                </tbody>


                            </table>


                        </div>

                        <button type="submit" class="btn btn-primary" style="width: auto;" onclick="return chamDiemRenLuyen();">Chấm điểm</button>

                    </div>
                </form>

            </div>
        </div>
        <!-- end of row -->
    </div>

    <!-- end of container -->


    <!-- Modal xem danh sách hoạt động-->
    <div class="modal fade" id="XemDanhSachHoatDongModal" tabindex="-1" aria-labelledby="XemDanhSachHoatDongModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Danh sách hoạt động đã tham gia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div>
                    <span style="font-weight: 700" >Tiêu chí được cộng: </span><span id="id_thamgiahd_tieuChiDuocCong" ></span>
                    </div>
                    
                    <hr>
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left table-hover">
                            <thead>
                                <tr>
                                    <th class="cell">Mã hoạt động</th>
                                    <th class="cell">Tên hoạt động</th>
                                    <th class="cell">Điểm nhận được</th>
                                </tr>
                            </thead>
                            <tbody id="id_tbody_DanhSachThamGiaHoatDong">
                                

                                <!-- <tr>
                                    <td colspan="4" style="text-align:center">Không tìm thấy kết quả.</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>


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
    <!-- end of footer -->


    <!-- Back To Top Button -->
    <button onclick="topFunction()" id="myBtn">
        <img src="../images/up-arrow.png" alt="alternative">
    </button>
    <!-- end of back to top button -->

    <!-- Scripts -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Bootstrap framework -->
    <script src="../js/swiper.min.js"></script>
    <!-- Swiper for image and text sliders -->
    <script src="../js/scripts.js"></script>

    <!-- Phieu Ren Luyen Helper JS -->
    <script src="../../../helper/js/phieuRenLuyen.js"></script>

    <!-- Custom scripts -->
    <script src="../js/chamdiemchitiet/chamdiemchitiet.js"></script>

    <script>

        getPhieuRenLuyenTitle().forEach(function(title) {
            $("#tablePhieuRenLuyen>thead>tr").append(`<th scope="col"><strong>${title}</strong></th>`);
        });
            
        HienThiThongTinVaDanhGia();

        var loadhoatdongtruoc_maHocKyDanhGia = $('#input_maHocKyDanhGia').val();
        var loadhoatdongtruoc_maSinhVien = getCookie("maSo");
        // LoadDiemNhanDuocCuaHoatDong_LenForm(loadhoatdongtruoc_maHocKyDanhGia, loadhoatdongtruoc_maSinhVien);


        //Code tự tính điểm tổng cộng
        let calDiemTongCong = 0;
        let calDiemTongTieuChi1 = 0;
        $("#tbody_noiDungDanhGia").find("input").each(function() {
            var tieuChi = this.id.slice(0, 3);
            var idDiemTongTieuChi1_SinhVien = this.id.slice(0, 12);

            if (tieuChi == 'TC2' || tieuChi == 'TC3') {
                if (this.value != null) {
                    calDiemTongCong += Number(this.value);
                    calDiemTongTieuChi1 += Number(this.value);
                }
            }

            if (idDiemTongTieuChi1_SinhVien == 'TongCong_TC1') {
                $('#' + this.id).val(calDiemTongTieuChi1);
                calDiemTongTieuChi1 = 0;
            }

            if (calDiemTongCong <= 100) {
                $('#input_diemtongcong').val(calDiemTongCong);
            }

        });

        //onchange
        $('#tbody_noiDungDanhGia').find("input").on('change', function() {
            let calDiemTongCong = 0;
            let calDiemTongTieuChi1 = 0;
            $("#tbody_noiDungDanhGia").find("input").each(function() {
                var tieuChi = this.id.slice(0, 3);

                var idDiemTongTieuChi1_SinhVien = this.id.slice(0, 12);

                if (tieuChi == 'TC2' || tieuChi == 'TC3') {
                    if (this.value != null) {
                        calDiemTongTieuChi1 += Number(this.value);
                    }
                }

                if (idDiemTongTieuChi1_SinhVien == 'TongCong_TC1') {
                    var diemToiDa_TC1 = $('#' + this.id).attr('max-value');

                    if (calDiemTongTieuChi1 > diemToiDa_TC1) {
                        $('#' + this.id).val(diemToiDa_TC1);
                        calDiemTongTieuChi1 = 0;
                    } else {
                        $('#' + this.id).val(calDiemTongTieuChi1);
                        calDiemTongTieuChi1 = 0;
                    }

                    calDiemTongCong += Number(this.value);

                }


            });

            if (calDiemTongCong <= 100) {
                $('#input_diemtongcong').val(calDiemTongCong);
            }else{
                $('#input_diemtongcong').val(100);
            }


        });


        $('#inputTBCHocKyDangXet').on('change', function() {
            TuDongDienDiemTBC();

        });

        $('#inputTBCHocKyTruoc').on('change', function() {
            TuDongDienDiemTBC();

        });



        function TuDongDienDiemTBC() {
            var TBCHocKyDangXet = $('#inputTBCHocKyDangXet').val();
            var TBCHocKyTruoc = $('#inputTBCHocKyTruoc').val();
            var bac_HocKyDangXet = 0;
            var bac_HocKyTruoc = 0;

            $('#TC3_1').val('');
            $('#TC3_2').val('');
            $('#TC3_3').val('');
            $('#TC3_4').val('');
            $('#TC3_5').val('');
            $('#TC3_6').val('');
            $('#TC3_7').val('');

            //Hoc ky dang xet
            if ((TBCHocKyDangXet >= 3.60) && (TBCHocKyDangXet <= 4)) {
                $('#TC3_1').val($('#TC3_1').attr('max_value'));
                bac_HocKyDangXet = 4;
            }

            if ((TBCHocKyDangXet >= 3.20) && (TBCHocKyDangXet <= 3.59)) {
                $('#TC3_2').val($('#TC3_2').attr('max_value'));
                bac_HocKyDangXet = 3;
            }

            if ((TBCHocKyDangXet >= 2.50) && (TBCHocKyDangXet <= 3.19)) {
                $('#TC3_3').val($('#TC3_3').attr('max_value'));
                bac_HocKyDangXet = 2;
            }

            if ((TBCHocKyDangXet >= 2) && (TBCHocKyDangXet <= 2.49)) {
                $('#TC3_4').val($('#TC3_4').attr('max_value'));
                bac_HocKyDangXet = 1;
            }

            if (TBCHocKyDangXet < 2) {
                $('#TC3_5').val($('#TC3_5').attr('max_value'));
            }




            //Hoc ky truoc//
            if ((TBCHocKyTruoc >= 3.60) && (TBCHocKyTruoc <= 4)) {
                bac_HocKyTruoc = 4;
            }

            if ((TBCHocKyTruoc >= 3.20) && (TBCHocKyTruoc <= 3.59)) {
                bac_HocKyTruoc = 3;
            }

            if ((TBCHocKyTruoc >= 2.50) && (TBCHocKyTruoc <= 3.19)) {
                bac_HocKyTruoc = 2;
            }

            if ((TBCHocKyTruoc >= 2) && (TBCHocKyTruoc <= 2.49)) {
                bac_HocKyTruoc = 1;
            }

            //console.log(bac_HocKyDangXet + "---" + bac_HocKyTruoc)
            //So sanh bac
            if ((bac_HocKyDangXet - bac_HocKyTruoc) == 1) {
                $('#TC3_6').val($('#TC3_6').attr('max_value'));
            }

            if ((bac_HocKyDangXet - bac_HocKyTruoc) > 1) {
                $('#TC3_7').val($('#TC3_7').attr('max_value'));
            }


            //Kích hoạt sự kiên onchange manually vì value set bằng javascript kh hoạt động onchange
            input_TC3_1 = document.getElementById('TC3_1');
            ev_TC3_1 = document.createEvent('Event');
            ev_TC3_1.initEvent('change', true, false);
            input_TC3_1.dispatchEvent(ev_TC3_1);

            input_TC3_2 = document.getElementById('TC3_2');
            ev_TC3_2 = document.createEvent('Event');
            ev_TC3_2.initEvent('change', true, false);
            input_TC3_2.dispatchEvent(ev_TC3_2);

            input_TC3_3 = document.getElementById('TC3_3');
            ev_TC3_3 = document.createEvent('Event');
            ev_TC3_3.initEvent('change', true, false);
            input_TC3_3.dispatchEvent(ev_TC3_3);

            input_TC3_4 = document.getElementById('TC3_4');
            ev_TC3_4 = document.createEvent('Event');
            ev_TC3_4.initEvent('change', true, false);
            input_TC3_4.dispatchEvent(ev_TC3_4);

            input_TC3_5 = document.getElementById('TC3_5');
            ev_TC3_5 = document.createEvent('Event');
            ev_TC3_5.initEvent('change', true, false);
            input_TC3_5.dispatchEvent(ev_TC3_5);


        }




        function chamDiemRenLuyen() {

            $("form#formDanhGiaDRL").on("submit", function(e) {
                e.preventDefault();


                Swal.fire({
                    title: 'Xác nhận chấm điểm rèn luyện?',
                    showDenyButton: true,
                    confirmButtonText: 'Xác nhận',
                    denyButtonText: `Đóng`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (checkValidateInput()) {
                            var _inputMaSinhVien = getCookie("maSo");
                            var _inputDiemTBCHKTruoc = $("#inputTBCHocKyTruoc").val();
                            var _inputDiemTBCHKDangXet = $("#inputTBCHocKyDangXet").val();
                            var _inputMaHocKyDanhGia = $("#input_maHocKyDanhGia").val();
                            var _inputDiemTongCong = Number($('#input_diemtongcong').val());
                            var _inputXepLoai = '';


                            var _inputMaPhieuRenLuyen = "PRL" + _inputMaHocKyDanhGia + _inputMaSinhVien;
                            //vd: maPhieuRenLuyen = PRLHK121223118410262

                            if (_inputDiemTongCong >= 90 && _inputDiemTongCong <= 100) {
                                _inputXepLoai = 'Xuất sắc';
                            }

                            if (_inputDiemTongCong >= 80 && _inputDiemTongCong <= 89) {
                                _inputXepLoai = 'Tốt';
                            }

                            if (_inputDiemTongCong >= 65 && _inputDiemTongCong <= 79) {
                                _inputXepLoai = 'Khá';
                            }

                            if (_inputDiemTongCong >= 50 && _inputDiemTongCong <= 64) {
                                _inputXepLoai = 'Trung bình';
                            }

                            if (_inputDiemTongCong >= 35 && _inputDiemTongCong <= 49) {
                                _inputXepLoai = 'Yếu';
                            }

                            if (_inputDiemTongCong < 35) {
                                _inputXepLoai = 'Kém';
                            }



                            var formData = new FormData(document.getElementById('formDanhGiaDRL'));
                            formData.append("maPhieuRenLuyen", _inputMaPhieuRenLuyen);
                            formData.append("maSinhVien", _inputMaSinhVien);
                            formData.append("maHocKyDanhGia", _inputMaHocKyDanhGia);
                            formData.append("xepLoai", _inputXepLoai);


                            //Tạo phiếu rèn luyện trước
                            $.ajax({
                                url: urlapi_phieurenluyen_create,
                                data: formData,
                                async: false,
                                type: "POST",
                                contentType: false,
                                cache: false,
                                processData: false,
                                //dataType: "json",
                                headers: {
                                    Authorization: jwtCookie,
                                },
                                success: function(resultCreate) {
                                    //console.log(resultCreate);

                                    //Vòng lặp input để tạo các hàng giá trị của chamdiemrenluyen theo mã phiếu điểm rèn luyện
                                    $("#tbody_noiDungDanhGia").find("input").each(function() {
                                        //if (this.value != "") {
                                        var _inputDiemSVDanhGia = this.value;
                                        var tieuChi = this.id.slice(0, 3);

                                        //Chưa xử lý thêm ghi chú (thêm 1 switch case trước switch case tiêu chí này)
                                        if (tieuChi == "TC2"){
                                            var _inputMaTieuChi2 = this.id.slice(4, this.id.length);

                                            var stringFormIDTemp = "formDanhGiaDRL_"+ this.id;

                                            var formData_TC2 = new FormData(document.getElementById(stringFormIDTemp));
                                            formData_TC2.append("maPhieuRenLuyen", _inputMaPhieuRenLuyen);
                                            formData_TC2.append("maTieuChi3", 0);
                                            formData_TC2.append("maTieuChi2", _inputMaTieuChi2);
                                            formData_TC2.append("maSinhVien", _inputMaSinhVien);
                                            formData_TC2.append("diemSinhVienDanhGia", _inputDiemSVDanhGia);
                                            formData_TC2.append("diemLopDanhGia", null);
                                            formData_TC2.append("diemKhoaDanhGia", null);
                                            formData_TC2.append("ghiChu", "");


                                            $.ajax({
                                                url: urlapi_chamdiemrenluyen_create,
                                                data: formData_TC2,
                                                async: false,
                                                type: "POST",
                                                contentType: false,
                                                cache: false,
                                                processData: false,
                                                //dataType: "json",
                                                headers: {
                                                    Authorization: jwtCookie,
                                                },
                                                success: function(resultCreate_ChamDiemRenLuyen) {
                                                    //console.log(resultCreate_ChamDiemRenLuyen);
                                                },
                                                error: function(errorMessage) {
                                                    Swal.fire({
                                                        icon: "error",
                                                        title: "Thông báo",
                                                        text: errorMessage.responseText,
                                                        //timer: 5000,
                                                        timerProgressBar: true,
                                                    });
                                                },
                                            });

                                        }


                                        if (tieuChi == "TC3"){
                                            var _inputMaTieuChi3 = this.id.slice(4, this.id.length);

                                            var stringFormIDTemp_2 = document.getElementById("formDanhGiaDRL_"+ this.id);

                                            var formData_TC3 = new FormData(stringFormIDTemp_2);
                                            formData_TC3.append("maPhieuRenLuyen", _inputMaPhieuRenLuyen);
                                            formData_TC3.append("maTieuChi3", _inputMaTieuChi3);
                                            formData_TC3.append("maTieuChi2", 0);
                                            formData_TC3.append("maSinhVien", _inputMaSinhVien);
                                            formData_TC3.append("diemSinhVienDanhGia", _inputDiemSVDanhGia);
                                            formData_TC3.append("diemLopDanhGia", null);
                                            formData_TC3.append("diemKhoaDanhGia", null);
                                            formData_TC3.append("ghiChu", "");

                                            //console.log(dataPost_ChamDiemRenLuyen);

                                            $.ajax({
                                                url: urlapi_chamdiemrenluyen_create,
                                                data: formData_TC3,
                                                async: false,
                                                type: "POST",
                                                contentType: false,
                                                cache: false,
                                                processData: false,
                                                //dataType: "json",
                                                headers: {
                                                    Authorization: jwtCookie,
                                                },
                                                success: function(resultCreate_ChamDiemRenLuyen) {
                                                    //console.log(resultCreate_ChamDiemRenLuyen);
                                                },
                                                error: function(errorMessage) {
                                                    Swal.fire({
                                                        icon: "error",
                                                        title: "Thông báo",
                                                        text: errorMessage.responseText,
                                                        //timer: 5000,
                                                        timerProgressBar: true,
                                                    });
                                                },
                                            });
                                        }

                                        
                                    });

                                    Swal.fire({
                                        icon: "success",
                                        title: "Chấm điểm rèn luyện thành công!",
                                        text: "Đang chuyển hướng...",
                                        timer: 2500,
                                        timerProgressBar: true,
                                    });

                                    window.setTimeout(function() {
                                        window.location.href = 'chamdiem.php';
                                    }, 2500);


                                },
                                error: function(errorMessage_tc3) {

                                    console.log(errorMessage_tc3.responseJSON.message);
                                    Swal.fire({
                                        icon: "error",
                                        title: "Thông báo",
                                        text: errorMessage_tc3.responseJSON.message,
                                        //timer: 5000,
                                        timerProgressBar: true,
                                    });
                                },
                            });


                        }

                    }
                })

            });

        }



        function javascriptInputFile() {
            var inputs = document.querySelectorAll('.inputfile');
            Array.prototype.forEach.call(inputs, function(input) {
                var label = input.nextElementSibling,
                    labelVal = label.innerHTML;

                input.addEventListener('change', function(e) {
                    var fileName = '';
                    if (this.files && this.files.length > 1)
                        fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                    else
                        fileName = e.target.value.split('\\').pop();

                    if (fileName)
                        label.querySelector('span').innerHTML = fileName;
                    else
                        label.innerHTML = labelVal;
                });

                // Firefox bug fix
                input.addEventListener('focus', function() {
                    input.classList.add('has-focus');
                });
                input.addEventListener('blur', function() {
                    input.classList.remove('has-focus');
                });
            });
        }

        javascriptInputFile();

     
        //Xem danh sách hoạt động tham gia
        $(document).on("click", ".btn_XemDanhSachHoatDong" ,function() {

            let thamgiahd_maTieuChi = $(this).attr('data-tieuchi-id');
            let thamgiahd_tenTieuChi = $(this).attr('data-tentieuchi');
            let thamgiahd_maHocKyDanhGia = $('#input_maHocKyDanhGia').val();
            let thamgiahd_maSinhVien = getCookie("maSo");

            $('#id_thamgiahd_tieuChiDuocCong').text(thamgiahd_tenTieuChi);

            LoadDanhSachHoatDongDaThamGia(thamgiahd_maHocKyDanhGia, thamgiahd_maTieuChi, thamgiahd_maSinhVien);


        })


    </script>

    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

    </body>

    </html>