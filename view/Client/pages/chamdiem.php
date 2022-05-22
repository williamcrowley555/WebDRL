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
                    <div class="form-outline mb-4">
                        <div class="row justify-content-center" style="padding-bottom: 30px;">
                            <div class="col-4">
                               <span style="font-weight: bold;">Họ tên sinh viên: </span><span id="text_HoTen" ></span>
                            </div>
                            <div class="col-4">
                                <span style="font-weight: bold;">Mã số sinh viên: </span><span id="text_MaSo"></span> 
                            </div>
                          </div>

                          <table class="table align-middle mb-0 bg-white table-striped">
                            <thead class="bg-light">
                              <tr>
                                <th>Học kỳ</th>
                                <th>Năm học</th>
                                <th>Trạng thái</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="tbody_hocKyDanhGia" >
                              
                              
                            </tbody>
                          </table>

                          
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

    <script src="../js/chamdiem/chamdiem.js"></script>

    <script>
        getThongTinHocKyDanhGia();
    </script>
    
    <!-- Custom scripts -->
    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

</body>

</html>