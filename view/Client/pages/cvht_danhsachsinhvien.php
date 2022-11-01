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
                    
                    <div class="row g-3 align-items-center" style='margin-bottom: 15px;'>
                        <div class="col-auto">
                            <label class="col-form-label" style="color:#223150; font-weight: 900;text-transform: uppercase;">Chọn học kỳ: </label>
                        </div>
                        <div class="col-auto">
                            <select class="form-select" aria-label="Default select example" style="width: auto;" id="select_HocKyDanhGia">
                            
                            </select>
                        </div>

                    </div>

                    <div class="col-auto" style="float: left; margin-bottom: 15px;">
                            <span style="color:#223150; font-weight: 900;text-transform: uppercase;">Thời gian cố vấn đánh giá: </span>
                            <span id="text_ngayCoVanKetThucDanhGia"  style='font-size: large;'></span>
                    </div>
                    
                    <table class="table align-middle mb-0 bg-white table-hover">
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
                               
                              
                            </tbody>
                    </table>

                    <p id='text_ketQuaTimKiem' style="color: black; text-transform: uppercase;padding-top: 10px;" ></p>
                    
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

    <script>
        LoadComboBoxHocKy();

        var url = new URL(window.location.href);
        var GET_MaLop = url.searchParams.get("maLop");


        function HienThiThongTin() {
            var getMaHocKyDanhGiaOption = $('#select_HocKyDanhGia option:selected').val();

            $.ajax({
                url: "../../../api/thongbaodanhgia/single_read.php?maHocKyDanhGia=" + getMaHocKyDanhGiaOption,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                    Authorization: jwtCookie,
                },
                success: function (result_HKDG) {
                    var ngayCoVanDanhGia = new Date(result_HKDG.ngayCoVanDanhGia);
                    var ngayCoVanKetThucDanhGia = new Date(result_HKDG.ngayCoVanKetThucDanhGia);
                    $('#text_ngayCoVanKetThucDanhGia').text(ngayCoVanDanhGia.toLocaleDateString() + " - " + ngayCoVanKetThucDanhGia.toLocaleDateString());
                   
                },
                error: function (errorMessage) {
                    thongBaoLoi(errorMessage.responseText);
                },
            });


            $('#tbody_DanhSachDiemTheoKy').find('tr').remove();
            getDanhSachDRLSinhVienLopTheoHocKy(GET_MaLop, getMaHocKyDanhGiaOption );
        }

        HienThiThongTin();

        $('#select_HocKyDanhGia').on('change', function() {
            HienThiThongTin();
        });
       
        

    </script>

    <!-- Custom scripts -->
    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

</body>

</html>