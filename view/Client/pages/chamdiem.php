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
                        
                        <div class="row justify-content-center" style="padding-bottom: 20px;">
                            <div class="col-6">
                               <span style="font-weight: bold;">Họ tên sinh viên: </span><span id="text_HoTen" ></span>
                            </div>
                            <div class="col-4">
                                <span style="font-weight: bold;">Mã số sinh viên: </span><span id="text_MaSo"></span> 
                            </div>
                        </div>

                        <div class="row justify-content-center" style="padding-bottom: 30px;">
                            <div class="col-6">
                               <span style="font-weight: bold;">Họ tên cố vấn: </span><span id="text_HoTenCoVan" ></span> (<span id="text_MaCoVan" ></span>)
                            </div>
                            <div class="col-4">
                                <span style="font-weight: bold;">Lớp: </span><span id="text_maLop"></span> 
                            </div>
                        </div>

                        <table class="table align-middle mb-0 bg-white table-hover">
                            <thead class="bg-light">
                                <tr>
                                <th>Học kỳ</th>
                                <th>Năm học</th>
                                <th>Trạng thái chấm</th>
                                <th>Cố vấn duyệt</th>
                                <th>Khoa duyệt</th>
                                <th>Điểm</th>
                                <th>Xếp loại</th>
                                <th>Ngày bắt đầu chấm</th>
                                <th>Ngày kết thúc chấm</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody id="tbody_hocKyDanhGia" >
                                
                            </tbody>
                        </table>
                    </div>  
                </div>

                <form action='http://localhost/WebDRL/mpdf/export_mauPhieuRenLuyen.php' method='POST' id='formDownloadMauPhieuRenLuyen' class='text-center pb-2'>
                    <input type='hidden' name='data' class='data' />
                    <p>Tải về mẫu phiếu rèn luyện <button type='submit' class='btn btn-link bg-white p-0' style='outline: none; box-shadow: none;'>tại đây</button></p>
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

    <script src="../js/chamdiem/chamdiem.js"></script>

    <script>
        getThongTinHocKyDanhGia();

        $(document).on("submit", "#formDownloadMauPhieuRenLuyen", function(e) {
            var phieuRenLuyen = {
                tieuChiCap1: [],
                tieuChiCap2: [],
                tieuChiCap3: []
            };
            
            // Tiêu chí cấp 1
            $.ajax({
                url: urlapi_tieuchicap1_read_kichHoat + "1",
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                    Authorization: jwtCookie,
                },
                success: function (result_TCC1) {
                    result_TCC1["tieuchicap1"].forEach(function (tcc1) {
                        delete tcc1.soThuTu;
                        phieuRenLuyen.tieuChiCap1.push(tcc1);
                    });
                },
                error: function (error) {},
            });
            
            // Tiêu chí cấp 2
            $.ajax({
                url: urlapi_tieuchicap2_read_kichHoat + "1",
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                    Authorization: jwtCookie,
                },
                success: function (result_TCC2) {
                    result_TCC2["tieuchicap2"].forEach(function (tcc2) {
                        delete tcc2.soThuTu;
                        phieuRenLuyen.tieuChiCap2.push(tcc2);
                    });
                },
                error: function (error) {},
            });
            
            // Tiêu chí cấp 3
            $.ajax({
                url: urlapi_tieuchicap3_read_kichHoat + "1",
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                    Authorization: jwtCookie,
                },
                success: function (result_TCC3) {
                    result_TCC3["tieuchicap3"].forEach(function (tcc3) {
                        delete tcc3.soThuTu;
                        phieuRenLuyen.tieuChiCap3.push(tcc3);
                    });
                },
                error: function (error) {},
            });

            $(this).children('.data').val(
                JSON.stringify(phieuRenLuyen)
            );

            return true;
    })
    </script>
    
    <!-- Custom scripts -->
    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

</body>

</html>