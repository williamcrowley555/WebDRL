<?php
    include_once "header.php";

    if ($quyenNguoiDung != 'cvht'){
        echo "<script>history.go(-1)</script>";
    }

    if (!isset($_GET['maHocKy'])){
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

                    <form id='formDanhGiaDRL' method="post" enctype="multipart/form-data" >
                        <div class="form-outline mb-4">
                            <div class="row justify-content-center" style="padding-bottom: 30px;text-align: start;">

                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th scope="col"><strong>NỘI DUNG ĐÁNH GIÁ</strong></th>
                                            <th scope="col"><strong>Điểm tối đa</strong></th>
                                            <th scope="col"><strong>Điểm SV tự đánh giá</strong></th>
                                            <!-- <th scope="col"><strong>Điểm lớp đánh giá</strong></th> -->
                                            <th scope="col"><strong>Ghi chú</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_noiDungDanhGia">
                                        
                                    </tbody>


                                </table>


                            </div>

                            <button type="submit" class="btn btn-primary" style="width: auto;" onclick="return chamDiemRenLuyen();" >Chấm điểm</button>

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

        <script>
           

        </script>

        <script>
            HienThiThongTinVaDanhGia();

          

    
            function chamDiemRenLuyen() {

                $("form#formDanhGiaDRL").on("submit",function (e) {
                e.preventDefault();

                console.log("da vo day");

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
                
                    
                         var formData = new FormData(document.getElementById('formDanhGiaDRL'));
                         formData.append("maPhieuRenLuyen", _inputMaPhieuRenLuyen);
                         formData.append("maSinhVien", _inputMaSinhVien);
                         formData.append("maHocKyDanhGia", _inputMaHocKyDanhGia);

                        //Tạo phiếu rèn luyện trước
                        $.ajax({
                            url: "../../../api/phieurenluyen/create.php",
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

                                Swal.fire({
                                icon: "success",
                                title: "Chấm điểm rèn luyện thành công!",
                                text: "Đang chuyển hướng...",
                                timer: 2500,
                                timerProgressBar: true,
                                });
                                
                                window.setTimeout(function (){
                                window.location.href = 'chamdiem.php';
                                }, 2500);

                            
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
                
            });

            }
        </script>

        <!-- MDB -->
        <script type="text/javascript" src="../js/mdb.min.js"></script>

</body>

</html>