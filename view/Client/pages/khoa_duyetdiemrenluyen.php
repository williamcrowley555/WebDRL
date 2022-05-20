<?php
    include_once "header.php";

    if ($quyenNguoiDung != 'khoa'){
        echo "<script>history.go(-1)</script>";
    }
?>
 

    <!-- Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <h3 style="text-transform: uppercase;">Khoa <br> Duyệt điểm rèn luyện</h3>
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
                        <div class="row justify-content-center" style="padding-bottom: 30px;">
                            <div class="col-4">
                               <span style="font-weight: bold;">Họ tên cán bộ khoa: </span> Nguyễn Thị B
                            </div>
                            <div class="col-4">
                                <span style="font-weight: bold;">Khoa: </span> Công nghệ thông tin
                            </div>
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

    
    <!-- Custom scripts -->
    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

</body>

</html>