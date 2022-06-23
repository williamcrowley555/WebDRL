<?php
    include_once "header.php";

    if ($quyenNguoiDung != 'cvht'){
        echo "<script>history.go(-1)</script>";
    }
?>
 

    <!-- Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <h3 style="text-transform: uppercase;">Cố vấn học tập <br> Duyệt điểm rèn luyện</h3>
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
                               <span style="font-weight: bold;">Họ tên cố vấn: </span><span id="text_HoTen" ></span>
                            </div>
                            <div class="col-4">
                                <span style="font-weight: bold;">Mã số: </span><span id="text_MaSo"></span> 
                            </div>
                        </div>
                    </div>
                    <h6 style="text-align: left">Danh sách lớp cố vấn</h6>
                    <table class="table align-middle mb-0 bg-white table-hover">
                            <thead class="bg-light">
                              <tr>
                                <th>STT</th>
                                <th>Mã lớp</th>
                                <th>Tên lớp</th>
                                <th>Khóa học</th>
                                <th>Tên khoa</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="tbody_DanhSachLop" >
                              
                              
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

    <script src="../js/cvht/cvht_duyetdiemrenluyen.js"></script>
    
    <script>
        getThongTinLopCoVan();
    </script>
    <!-- Custom scripts -->
    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

</body>

</html>