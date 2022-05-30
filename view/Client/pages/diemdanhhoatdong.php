<?php
    
    if (!isset($_GET['maHoatDong'])){
        echo "<script>window.location.href = 'tracuuhoatdongthamgia.php';</script>";
    }
    $previousLink = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    //Dùng để lưu lại page vào cookie điều hướng ngược lại sau khi đăng nhập
    setCookie('previousPage', $previousLink);

    
    include_once "header.php";

    if ($quyenNguoiDung != 'sinhvien'){
        echo "<script>history.go(-1)</script>";
    }
    

?>


    <!-- Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <h3 style="text-transform: uppercase;">Điểm danh/check-in hoạt động</h3>
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
                   
                    <div class="form-outline mb-4">
                        <h6 style="text-transform: uppercase; text-align: left;">--Thông tin hoạt động--</h6>
                        <div class="list-group justify-content-center" style="padding-bottom: 30px;text-align: start;" id="part_thongTinHoatDong">
                           
                        </div>    

                    </div>

                    <div class="form-outline mb-4">
                        <h6 style="text-transform: uppercase; text-align: left;">--Phần điểm danh--</h6>
                        <div id="part_DiemDanh" >
                            <!-- Thời gian điểm danh còn lại:  -->
                            <p><span style='text-transform: uppercase;font-weight: bold;font-size: large' id="text_thoiGianDiemDanh" ></span></p>
                            <p style="font-size: x-large;font-weight: bold" id="text_Timer"></p>
                            <p style="font-size: x-large;font-weight: bold;" id="text_TrangThaiDiemDanh"></p>
                            
                        </div>
                        
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
        <script src="../js/diemdanhhoatdong/diemdanhhoatdong.js"></script>
        
        <!-- Custom scripts -->
       
        <script>
            HienThiThongTin();

            checkDiemDanh();
            
        </script>

        <!-- MDB -->
        <script type="text/javascript" src="../js/mdb.min.js"></script>

</body>

</html>