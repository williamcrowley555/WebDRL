<?php
    include_once "header.php";

    if ($quyenNguoiDung != 'cvht'){
        echo "<script>history.go(-1)</script>";
    }

    if (!isset($_GET['maLop'])){
        echo "<script>window.location.href = 'cvht_duyetdiemrenluyen.php';</script>";
    }else{
        if ($_GET['maLop'] == null){
            echo "<script>window.location.href = 'cvht_duyetdiemrenluyen.php';</script>";
        }
    }
?>
 

    <!-- Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <h4 style="text-transform: uppercase;">Danh sách sinh viên<br> Lớp: <span id="text_Lop"></span></h4>
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
                   
                    <h6 style="text-align: left;text-transform: uppercase;">Danh sách điểm rèn luyện theo học kỳ</h6>
                    
                    
                    <table class="table align-middle mb-0 bg-white table-striped">
                        <p style="text-align: left;font-weight: bold;color: #223150;margin-top: revert;">Học kỳ: 1 - Năm học: 2021-2022</p>
                            <thead class="bg-light">
                              <tr>
                                <th>STT</th>
                                <th>Mã sinh viên</th>
                                <th>Họ tên sinh viên</th>
                                <th>Ngày sinh</th>
                                <th>Trạng thái chấm điểm</th>
                                <th>Trạng thái duyệt</th>
                                <th>Điểm</th>
                                <th>Xếp loại</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="tbody_DanhSachDiemTheoKy" >
                            <tr>
                                    <td>1</td>
                                    <td><p class='fw-normal mb-1'>3118410262</p></td>
                                    <td><p class='fw-normal mb-1'>Nguyễn Thương Mến</p></td>
                                    <td><p class='fw-normal mb-1'>20/1/2000</p></td>
                                    <td><span class='badge badge-success' style='color: black;font-size: smaller;'>Đã chấm</span></td>
                                    <td><span class='badge badge-success' style='color: black;font-size: smaller;'>Đã duyệt</span></td>
                                    <td>53</td>
                                    <td>Trung bình</td>
                                    <td>
                                        <a href='cvht_danhsachsinhvien.php?maLop="+ maLop +"' ><button type='button' class='btn btn-light' style='color: black;'>Xem chi tiết</button></a>
                                    </td>
                                </tr>
                              
                            </tbody>
                    </table>

                    <table class="table align-middle mb-0 bg-white table-striped">
                        <p style="text-align: left;font-weight: bold;color: #223150;margin-top: revert;">Học kỳ: 2 - Năm học: 2021-2022</p>
                            <thead class="bg-light">
                              <tr>
                                <th>STT</th>
                                <th>Mã sinh viên</th>
                                <th>Họ tên sinh viên</th>
                                <th>Ngày sinh</th>
                                <th>Trạng thái chấm điểm</th>
                                <th>Trạng thái duyệt</th>
                                <th>Điểm</th>
                                <th>Xếp loại</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="tbody_DanhSachDiemTheoKy" >
                            <tr>
                                    <td>1</td>
                                    <td><p class='fw-normal mb-1'>3118410262</p></td>
                                    <td><p class='fw-normal mb-1'>Nguyễn Thương Mến</p></td>
                                    <td><p class='fw-normal mb-1'>20/1/2000</p></td>
                                    <td><span class='badge badge-warning' style='color: black;font-size: smaller;'>Chưa chấm</span></td>
                                    <td><span class='badge badge-warning' style='color: black;font-size: smaller;'>Chưa duyệt</span></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href='cvht_danhsachsinhvien.php?maLop="+ maLop +"' ><button type='button' class='btn btn-primary' style='color: white;'>Xem và duyệt</button></a>
                                    </td>
                                </tr>
                              
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

    <script src="../js/cvht/cvht_danhsachsinhvien.js" ></script>


    <!-- Custom scripts -->
    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

</body>

</html>