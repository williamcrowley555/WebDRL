<?php
    include_once "header.php";

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

                        <button type="button" class="btn btn-primary" style="width: auto;" onclick="chamDiemRenLuyen();">Chấm điểm</button>

                    </div>
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
            HienThiThongTinVaDanhGia();

        </script>

        <!-- MDB -->
        <script type="text/javascript" src="../js/mdb.min.js"></script>

</body>

</html>