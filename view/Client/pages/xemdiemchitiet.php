<?php
include_once "header.php";

if (!isset($_GET['maHocKy']) && !isset($_GET['maSinhVien'])) {
    echo "<script>window.location.href = 'tracuudiemrenluyen.php';</script>";
}

?>


<!-- Header -->
<header id="header" class="header">
    <div class="container">
        <div class="row">
            <h4 style="text-transform: uppercase;">Xem phiếu điểm rèn luyện</h4>
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
                                        <th scope="col"><strong>Ghi chú</strong></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_noiDungDanhGia">

                                </tbody>


                            </table>


                        </div>

                        
                    </div>
                </form>

            </div>
        </div>
        <!-- end of row -->
    </div>

    <!-- end of container -->


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
    <script src="../js/xemdiemchitiet/xemdiemchitiet.js"></script>

    <script>


    </script>

    <script>
        HienThiThongTinVaDanhGia();
        LoadThongTinSinhVienDanhGia();

       // var diemTong_XepLoai = Number($('#CVHT_input_diemtongcong').val());
        //$("#text_XepLoai").text(TinhXepLoai(diemTong_XepLoai));
        
        //Code tự tính điểm tổng cộng-------------------//
        let calDiemTongCong_SinhVien = 0;
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
                   calDiemTongCong_SinhVien += Number(this.value);
                }
            }

            if (idDiemTongTieuChi1_SinhVien == 'TongCong_TC1') {
                $('#' + this.id).val(calDiemTongTieuChi1_SinhVien);
                calDiemTongTieuChi1_SinhVien = 0;
            }

            if (idDiemTongTieuChi1 == 'CVHT_TongCong_TC1') {
                $('#' + this.id).val(calDiemTongTieuChi1);
                calDiemTongTieuChi1 = 0;
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

            $('#CVHT_input_diemtongcong').val(calDiemTongCong);

            
            var diemTong_XepLoai = Number($('#CVHT_input_diemtongcong').val());

            $("#text_XepLoai").text(TinhXepLoai(diemTong_XepLoai));

        

        });
        //Code tự tính điểm tổng cộng-------------------//



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
                                url: "../../../api/phieurenluyen/update.php",
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
                                        url: "../../../api/chamdiemrenluyen/read.php?maPhieuRenLuyen=" + _inputMaPhieuRenLuyen,
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


                                                    //Vòng lặp input để tạo các hàng giá trị của chamdiemrenluyen theo mã phiếu điểm rèn luyện
                                                    $("#tbody_noiDungDanhGia").find("input").each(function() {
                                                        if (this.value != "") {
                                                            var _inputDiemDanhGia = this.value;
                                                            var tieuChi = this.id.slice(0, 8);

                                                            //Chưa xử lý thêm ghi chú (thêm 1 switch case trước switch case tiêu chí này)
                                                            if (tieuChi == "CVHT_TC2") {
                                                                var _inputMaTieuChi2 = this.id.slice(9, this.id.length);

                                                                //Cập nhật row
                                                                if (maTieuChi2 === _inputMaTieuChi2 ){
                                                                        
                                                                    var dataPost_ChamDiemRenLuyen = {
                                                                        maChamDiemRenLuyen: maChamDiemRenLuyen,
                                                                        maPhieuRenLuyen: _inputMaPhieuRenLuyen,
                                                                        maTieuChi3: null,
                                                                        maTieuChi2: _inputMaTieuChi2,
                                                                        maSinhVien: _inputMaSinhVien,
                                                                        diemSinhVienDanhGia: diemSinhVienDanhGia,
                                                                        diemLopDanhGia: _inputDiemDanhGia,
                                                                        ghiChu: null
                                                                    };


                                                                    $.ajax({
                                                                        url: "../../../api/chamdiemrenluyen/update.php",
                                                                        async: false,
                                                                        type: "POST",
                                                                        contentType: "application/json;charset=utf-8",
                                                                        dataType: "json",
                                                                        data: JSON.stringify(dataPost_ChamDiemRenLuyen),
                                                                        headers: {
                                                                            Authorization: jwtCookie,
                                                                        },
                                                                        success: function(resultCreate_ChamDiemRenLuyen) {
                                                                            //console.log(resultCreate_ChamDiemRenLuyen);
                                                                        },
                                                                        error: function(errorMessage) {
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

                                                            if (tieuChi == "CVHT_TC3"){
                                                                var _inputMaTieuChi3 = this.id.slice(9, this.id.length);

                                                                //Nếu đã có row rồi thì cập nhật cột diemLopDanhGia, ngược lại tạo row mới
                                                                if (maTieuChi3 === _inputMaTieuChi3 ){
                                                                        
                                                                    var dataPost_ChamDiemRenLuyen = {
                                                                        maChamDiemRenLuyen: maChamDiemRenLuyen,
                                                                        maPhieuRenLuyen: _inputMaPhieuRenLuyen,
                                                                        maTieuChi3: _inputMaTieuChi3,
                                                                        maTieuChi2: null,
                                                                        maSinhVien: _inputMaSinhVien,
                                                                        diemSinhVienDanhGia: diemSinhVienDanhGia,
                                                                        diemLopDanhGia: _inputDiemDanhGia,
                                                                        ghiChu: null
                                                                    };

                                                                    $.ajax({
                                                                        url: "../../../api/chamdiemrenluyen/update.php",
                                                                        async: false,
                                                                        type: "POST",
                                                                        contentType: "application/json;charset=utf-8",
                                                                        dataType: "json",
                                                                        data: JSON.stringify(dataPost_ChamDiemRenLuyen),
                                                                        headers: {
                                                                            Authorization: jwtCookie,
                                                                        },
                                                                        success: function(resultCreate_ChamDiemRenLuyen) {
                                                                            //console.log(resultCreate_ChamDiemRenLuyen);
                                                                        },
                                                                        error: function(errorMessage) {
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

                                                        }

                                                    });

                                                
                                                }
                                            });
                                        

                                        },
                                        error: function(errorMessage) {
                                            Swal.fire({
                                                icon: "error",
                                                title: "Lỗi",
                                                text: errorMessage.responseText,
                                                //timer: 5000,
                                                timerProgressBar: true,
                                            });
                                        },
                                    });


                                    Swal.fire({
                                        icon: "success",
                                        title: "Chấm điểm rèn luyện thành công!",
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
    </script>

    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

    </body>

    </html>