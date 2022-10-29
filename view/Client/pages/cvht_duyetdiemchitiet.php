<?php
include_once "header.php";

if ($quyenNguoiDung != 'cvht') {
    echo "<script>history.go(-1)</script>";
}

if (!isset($_GET['maHocKy']) && !isset($_GET['maSinhVien'])) {
    echo "<script>window.location.href = 'cvht_duyetdiemrenluyen.php';</script>";
}

?>


<!-- Header -->
<header id="header" class="header">
    <div class="container">
        <div class="row">
            <h4 style="text-transform: uppercase;">Cố vấn học tập <br> Duyệt điểm rèn luyện</h4>
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

                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th scope="col"><strong>NỘI DUNG ĐÁNH GIÁ</strong></th>
                                        <th scope="col"><strong>Điểm tối đa</strong></th>
                                        <th scope="col"><strong>Điểm SV tự đánh giá</strong></th>
                                        <th scope="col"><strong>Điểm lớp đánh giá</strong></th>
                                        <th scope="col"><strong>Điểm nhận từ hoạt động</strong></th>
                                        <th scope="col"><strong>Minh chứng ngoài (nếu có) (ảnh .png, .jpg, .jpeg)</strong></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_noiDungDanhGia">

                                </tbody>


                            </table>


                        </div>

                        <button type="submit" class="btn btn-primary" style="width: auto;" onclick="return DuyetDiemRenLuyen();">Duyệt điểm</button>

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
                        <span style="font-weight: 700">Tiêu chí được cộng: </span><span id="id_thamgiahd_tieuChiDuocCong"></span>
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

    <!-- Custom scripts -->
    <script src="../js/cvht/cvht_duyetdiemchitiet.js"></script>

    <script>


    </script>

    <script>
        HienThiThongTinVaDanhGia();
        LoadThongTinSinhVienDanhGia();

        var diemTong_XepLoai = Number($('#CVHT_input_diemtongcong').val());
        $("#text_XepLoai").text(TinhXepLoai(diemTong_XepLoai));
        
        //Code tự tính điểm tổng cộng-------------------//
        let calDiemTongCong_SinhVien = 0;
        let calDiemTongCong = 0;
        let calDiemTongTieuChi1 = 0;
        let calDiemTongTieuChi1_SinhVien = 0;
        $("#tbody_noiDungDanhGia").find("input").each(function() {
            var tieuChi = this.id.slice(0, 8);
            var tieuChi_SinhVien = this.id.slice(0, 3);
            var idDiemTongTieuChi1 = this.id.slice(0, 17);
            var idDiemTongTieuChi1_SinhVien = this.id.slice(0, 12);


            if (tieuChi == 'CVHT_TC2' || tieuChi == 'CVHT_TC3') {
                if (this.value != null) {
                   // calDiemTongCong += Number(this.value);
                    calDiemTongTieuChi1 += Number(this.value);
                }
            }

            if (tieuChi_SinhVien == 'TC2' || tieuChi_SinhVien == 'TC3') {
                if (this.value != null) {
                    calDiemTongTieuChi1_SinhVien += Number(this.value);
                   //calDiemTongCong_SinhVien += Number(this.value);
                }
            }

            if (idDiemTongTieuChi1_SinhVien == 'TongCong_TC1') {
                // Thêm ở đây
                var diemToiDa_TC1_SinhVien = $('#' + this.id).attr('max-value');
                if (calDiemTongTieuChi1_SinhVien > diemToiDa_TC1_SinhVien) {
                    $('#' + this.id).val(diemToiDa_TC1_SinhVien);
                    calDiemTongCong_SinhVien += Number(diemToiDa_TC1_SinhVien);
                    calDiemTongTieuChi1_SinhVien = 0;
                } else {
                    $('#' + this.id).val(calDiemTongTieuChi1);
                    calDiemTongCong_SinhVien += Number(calDiemTongTieuChi1_SinhVien);
                    calDiemTongTieuChi1_SinhVien = 0;
                }
                // Hết thêm
            }

            if (idDiemTongTieuChi1 == 'CVHT_TongCong_TC1') {
                // Thêm ở đây
                var diemToiDa_TC1_CVHT = $('#' + this.id).attr('max-value');
                if (calDiemTongTieuChi1 > diemToiDa_TC1_CVHT) {
                    $('#' + this.id).val(diemToiDa_TC1_CVHT);
                    calDiemTongCong += Number(diemToiDa_TC1_CVHT);
                    calDiemTongTieuChi1 = 0;
                } else {
                    $('#' + this.id).val(calDiemTongTieuChi1);
                    calDiemTongCong += Number(calDiemTongTieuChi1);
                    calDiemTongTieuChi1 = 0;
                }

                //$('#' + this.id).val(calDiemTongTieuChi1);
                //calDiemTongTieuChi1 = 0;

            }
            
        });

        $("#input_diemtongcong").val(calDiemTongCong_SinhVien);
       
        //onchange
        $('#tbody_noiDungDanhGia').find("input").on('change', function() {
            let calDiemTongCong = 0;
            let calDiemTongTieuChi1 = 0;
            $("#tbody_noiDungDanhGia").find("input").each(function() {
                var tieuChi = this.id.slice(0, 8);

                var idDiemTongTieuChi1 = this.id.slice(0, 17);

                if (tieuChi == 'CVHT_TC2' || tieuChi == 'CVHT_TC3') {
                    if (this.value != null) {
                        calDiemTongCong += Number(this.value);
                        calDiemTongTieuChi1 += Number(this.value);
                    }
                }

                if (idDiemTongTieuChi1 == 'CVHT_TongCong_TC1') {
                    $('#' + this.id).val(calDiemTongTieuChi1);
                    calDiemTongTieuChi1 = 0;
                }


            });

            if (calDiemTongCong > 100){
			    $("#CVHT_input_diemtongcong").val(100);
            }else{
                $("#CVHT_input_diemtongcong").val(calDiemTongCong);
            }
           

            var diemTong_XepLoai = Number($('#CVHT_input_diemtongcong').val());

            $("#text_XepLoai").text(TinhXepLoai(diemTong_XepLoai));

        

        });
        //Code tự tính điểm tổng cộng-------------------//

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

            $('#CVHT_TC3_1').val('');
            $('#CVHT_TC3_2').val('');
            $('#CVHT_TC3_3').val('');
            $('#CVHT_TC3_4').val('');
            $('#CVHT_TC3_5').val('');
            $('#CVHT_TC3_6').val('');
            $('#CVHT_TC3_7').val('');

            //Hoc ky dang xet
            if ((TBCHocKyDangXet >= 3.60) && (TBCHocKyDangXet <= 4)) {
                $('#CVHT_TC3_1').val($('#CVHT_TC3_1').attr('max_value'));
                bac_HocKyDangXet = 4;
            }

            if ((TBCHocKyDangXet >= 3.20) && (TBCHocKyDangXet <= 3.59)) {
                $('#CVHT_TC3_2').val($('#CVHT_TC3_2').attr('max_value'));
                bac_HocKyDangXet = 3;
            }

            if ((TBCHocKyDangXet >= 2.50) && (TBCHocKyDangXet <= 3.19)) {
                $('#CVHT_TC3_3').val($('#CVHT_TC3_3').attr('max_value'));
                bac_HocKyDangXet = 2;
            }

            if ((TBCHocKyDangXet >= 2) && (TBCHocKyDangXet <= 2.49)) {
                $('#CVHT_TC3_4').val($('#CVHT_TC3_4').attr('max_value'));
                bac_HocKyDangXet = 1;
            }

            if (TBCHocKyDangXet < 2) {
                $('#CVHT_TC3_5').val($('#CVHT_TC3_5').attr('max_value'));
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
                $('#CVHT_TC3_6').val($('#CVHT_TC3_6').attr('max_value'));
            }

            if ((bac_HocKyDangXet - bac_HocKyTruoc) > 1) {
                $('#CVHT_TC3_6').val($('#CVHT_TC3_6').attr('max_value'));
            }


            //Kích hoạt sự kiên onchange manually vì value set bằng javascript kh hoạt động onchange
            input_TC3_1 = document.getElementById('CVHT_TC3_1');
            ev_TC3_1 = document.createEvent('Event');
            ev_TC3_1.initEvent('change', true, false);
            input_TC3_1.dispatchEvent(ev_TC3_1);

            input_TC3_2 = document.getElementById('CVHT_TC3_2');
            ev_TC3_2 = document.createEvent('Event');
            ev_TC3_2.initEvent('change', true, false);
            input_TC3_2.dispatchEvent(ev_TC3_2);

            input_TC3_3 = document.getElementById('CVHT_TC3_3');
            ev_TC3_3 = document.createEvent('Event');
            ev_TC3_3.initEvent('change', true, false);
            input_TC3_3.dispatchEvent(ev_TC3_3);

            input_TC3_4 = document.getElementById('CVHT_TC3_4');
            ev_TC3_4 = document.createEvent('Event');
            ev_TC3_4.initEvent('change', true, false);
            input_TC3_4.dispatchEvent(ev_TC3_4);

            input_TC3_5 = document.getElementById('CVHT_TC3_5');
            ev_TC3_5 = document.createEvent('Event');
            ev_TC3_5.initEvent('change', true, false);
            input_TC3_5.dispatchEvent(ev_TC3_5);


        }


        function DuyetDiemRenLuyen() {
            var url = new URL(window.location.href);
            var GET_MaHocKy = url.searchParams.get("maHocKy");
            var GET_MaSinhVien = url.searchParams.get("maSinhVien");
            var GET_MaLop = $('#text_MaLop').text();

            $("form#formDanhGiaDRL").on("submit", function(e) {
                e.preventDefault();


                Swal.fire({
                    title: 'Xác nhận duyệt điểm rèn luyện?',
                    showDenyButton: true,
                    confirmButtonText: 'Xác nhận',
                    denyButtonText: `Đóng`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (checkValidateInput()) {
                            var _inputMaSinhVien = GET_MaSinhVien;
                            var _inputDiemTBCHKTruoc = $("#inputTBCHocKyTruoc").val();
                            var _inputDiemTBCHKDangXet = $("#inputTBCHocKyDangXet").val();
                            var _inputMaHocKyDanhGia = $("#input_maHocKyDanhGia").val();
                            var _inputDiemTongCong = Number($('#input_diemtongcong').val());
                            var _inputXepLoai = '';


                            var _inputMaPhieuRenLuyen = "PRL" + _inputMaHocKyDanhGia + _inputMaSinhVien;
                            //vd: maPhieuRenLuyen = PRLHK121223118410262

                            _inputXepLoai = $("#text_XepLoai").text();
                            
                            var formData = new FormData(document.getElementById('formDanhGiaDRL'));
                            formData.append("maPhieuRenLuyen", _inputMaPhieuRenLuyen);
                            formData.append("maSinhVien", _inputMaSinhVien);
                            formData.append("maHocKyDanhGia", _inputMaHocKyDanhGia);
                            formData.append("xepLoai", _inputXepLoai);
                            formData.append("coVanDuyet", 1);
                            formData.append("khoaDuyet", 0);
                    
                     
                            //update phiếu rèn luyện trước
                            $.ajax({
                                url: urlapi_phieurenluyen_update,
                                async: false,
                                type: "POST",
                                contentType: false,
                                cache: false,
                                processData: false,
                                //dataType: "json",
                                data: formData,
                                headers: {
                                    Authorization: jwtCookie,
                                },
                                success: function(resultUpdate) {
                                
                                    $.ajax({
                                        url: urlapi_chamdiemrenluyen_read_maPhieuRenLuyen + _inputMaPhieuRenLuyen,
                                        async: false,
                                        type: "GET",
                                        contentType: "application/json;charset=utf-8",
                                        dataType: "json",
                                        headers: {
                                            Authorization: jwtCookie,
                                        },
                                        success: function(resultGET) {
                                            $.each(resultGET, function (index_GET) {
                                                for (var q = 0;q < resultGET[index_GET].length;q++) {
                                                    var maTieuChi3 = resultGET[index_GET][q].maTieuChi3;
                                                    var maTieuChi2 = resultGET[index_GET][q].maTieuChi2;
                                                    var diemSinhVienDanhGia = resultGET[index_GET][q].diemSinhVienDanhGia;
                                                    var maChamDiemRenLuyen = resultGET[index_GET][q].maChamDiemRenLuyen;
                                                    var ghiChu = resultGET[index_GET][q].ghiChu;

                                                    //Vòng lặp input để tạo các hàng giá trị của chamdiemrenluyen theo mã phiếu điểm rèn luyện
                                                    $("#tbody_noiDungDanhGia").find("input").each(function() {
                                                        if (this.value != "") {
                                                            var _inputDiemCoVanDanhGia = this.value;
                                                            var tieuChi = this.id.slice(0, 8);

                                                            //Chưa xử lý thêm ghi chú (thêm 1 switch case trước switch case tiêu chí này)
                                                            if (tieuChi == "CVHT_TC2") {
                                                                var _inputMaTieuChi2 = this.id.slice(9, this.id.length);

                                                                //Cập nhật row
                                                                if (maTieuChi2 === _inputMaTieuChi2 ){
                                                                        
                                                                    var stringFormIDTemp = "formDanhGiaDRL_TC2_" + _inputMaTieuChi2;

                                                                    var formData_TC2 = new FormData(document.getElementById(stringFormIDTemp));
                                                                    formData_TC2.append("maChamDiemRenLuyen", maChamDiemRenLuyen);
                                                                    formData_TC2.append("maPhieuRenLuyen", _inputMaPhieuRenLuyen);
                                                                    formData_TC2.append("maTieuChi3", 0);
                                                                    formData_TC2.append("maTieuChi2", _inputMaTieuChi2);
                                                                    formData_TC2.append("maSinhVien", _inputMaSinhVien);
                                                                    formData_TC2.append("diemSinhVienDanhGia", diemSinhVienDanhGia);
                                                                    formData_TC2.append("diemLopDanhGia", _inputDiemCoVanDanhGia);
                                                                    formData_TC2.append("diemKhoaDanhGia", null);
                                                                    formData_TC2.append("ghiChu", ghiChu);

                                                                    $.ajax({
                                                                        url: urlapi_chamdiemrenluyen_update,
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
                                                                        success: function(resultUpdate_ChamDiemRenLuyen) {
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
   
                                                            }

                                                            if (tieuChi == "CVHT_TC3"){
                                                                var _inputMaTieuChi3 = this.id.slice(9, this.id.length);

                                                                //Nếu đã có row rồi thì cập nhật cột diemLopDanhGia, ngược lại tạo row mới
                                                                if (maTieuChi3 === _inputMaTieuChi3 ){
                                                                        
                                                                    var stringFormIDTemp_2 = document.getElementById("formDanhGiaDRL_TC3_" + _inputMaTieuChi3);

                                                                    var formData_TC3 = new FormData(stringFormIDTemp_2);
                                                                    formData_TC3.append("maChamDiemRenLuyen", maChamDiemRenLuyen);
                                                                    formData_TC3.append("maPhieuRenLuyen", _inputMaPhieuRenLuyen);
                                                                    formData_TC3.append("maTieuChi3", _inputMaTieuChi3);
                                                                    formData_TC3.append("maTieuChi2", 0);
                                                                    formData_TC3.append("maSinhVien", _inputMaSinhVien);
                                                                    formData_TC3.append("diemSinhVienDanhGia", diemSinhVienDanhGia);
                                                                    formData_TC3.append("diemLopDanhGia", _inputDiemCoVanDanhGia);
                                                                    formData_TC3.append("diemKhoaDanhGia", null);
                                                                    formData_TC3.append("ghiChu", ghiChu);

                                                                    //console.log(dataPost_ChamDiemRenLuyen);

                                                                    $.ajax({
                                                                        url: urlapi_chamdiemrenluyen_update,
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
                                                            }

                                                        }

                                                    });

                                                
                                                }
                                            });
                                        

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


                                    Swal.fire({
                                        icon: "success",
                                        title: "Duyệt điểm rèn luyện thành công!",
                                        text: "Đang chuyển hướng...",
                                        timer: 2500,
                                        timerProgressBar: true,
                                    });

                                    window.setTimeout(function() {
                                        window.location.href = 'cvht_danhsachsinhvien.php?maLop=' + GET_MaLop;
                                    }, 2500);


                                },
                                error: function(errorMessage_tc3) {

                                    console.log(errorMessage_tc3.responseText);
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

            });

        }



        function TinhXepLoai(diemTong_XepLoai) {
            if (diemTong_XepLoai >= 90 && diemTong_XepLoai <= 100) {
                return 'Xuất sắc';
            }

            if (diemTong_XepLoai >= 80 && diemTong_XepLoai <= 89) {
                return 'Tốt';
            }

            if (diemTong_XepLoai >= 65 && diemTong_XepLoai <= 79) {
                return 'Khá';
            }

            if (diemTong_XepLoai >= 50 && diemTong_XepLoai <= 64) {
                return 'Trung bình';
            }

            if (diemTong_XepLoai >= 35 && diemTong_XepLoai <= 49) {
                return 'Yếu';
            }

            if (diemTong_XepLoai < 35) {
                return 'Kém';
            }
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
        $(document).on("click", ".btn_XemDanhSachHoatDong", function() {

            let thamgiahd_maTieuChi = $(this).attr('data-tieuchi-id');
            let thamgiahd_tenTieuChi = $(this).attr('data-tentieuchi');
            let thamgiahd_maHocKyDanhGia = $('#input_maHocKyDanhGia').val();
       
            $('#id_thamgiahd_tieuChiDuocCong').text(thamgiahd_tenTieuChi);

            LoadDanhSachHoatDongDaThamGia(thamgiahd_maHocKyDanhGia, thamgiahd_maTieuChi);


        })


    </script>

    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

    </body>

    </html>