<?php
    include_once "header.php";

    if ($quyenNguoiDung != 'sinhvien'){
      echo "<script>history.go(-1)</script>";
    }
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

    <div class="container">
        <div class="row gy-4">
            <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                <div class="app-card-header p-3 border-bottom-0">
					<div class="row align-items-center gx-3">
						<div class="col-auto">
							<div class="app-icon-holder">
                                <!-- add icon -->
                            </div>
                        </div>
                        <div class="col-auto">
							<h4 class="app-card-title">Thông tin tài khoản</h4>
						</div>
                    </div>
                </div>
            </div>
        </div>
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

    <!-- Custom scripts -->
    <script src="../js/taikhoan/taikhoan.js"></script>
</html>