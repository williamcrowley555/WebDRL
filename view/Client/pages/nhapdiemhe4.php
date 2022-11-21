<?php
    include_once "header.php";

    if ($quyenNguoiDung != 'cvht') {
        echo "<script>history.go(-1)</script>";
    }
?>

<!-- Header -->
<header id="header" class="header">
    <div class="container">
        <div class="row">
            <h3 style="text-transform: uppercase;">Nhập điểm hệ 4</h3>
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container -->
</header>
<!-- end of header -->
<!-- end of header -->


<div style="width: 100%;">
    <div class="container">
        <div class="row" style="margin: 0 auto; background: white;border-radius: 10px;">
            <div style="padding-right: 48px; padding-left: 48px; padding-top: 48px; padding-bottom: 24px;">
                <span style="font-weight: 700" >Học kỳ - Năm học:</span>
                <select class="ms-3" id="select_hocKy_namHoc">
                    
                </select>
                <span class="ms-4" style="font-weight: 700;" >Lớp:</span>
                <select class="ms-3" id="select_lop">
                    
                </select>
                <input type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="import_file" class="ms-4"">
            </div>
            <div style="padding-right: 48px; padding-left: 48px; padding-bottom: 48px; text-align: center;">
                <span style="font-weight: 700;" >Lưu ý: File excel tải lên phải định dạng theo thứ tự các cột sau: STT, Mã sinh viên, Họ tên sinh viên, Điểm.</span>
            </div>
            <div id="bangDiemXemTruoc" style="padding-right: 48px; padding-left: 48px;">
                <h4 style="text-transform: uppercase; text-align:center;">Bảng điểm xem trước</h4>
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left" id="my_table">
                                    <thead>
                                        <tr>

                                        </tr>
                                    </thead>
                                    <tbody id="tbody_BangDiemXemTruoc">
                                        <tr>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--//table-responsive-->

                        </div>
                        <!--//app-card-body-->
                    </div>
                    <!--//app-card-->
                </div>
            </div>
            <div style="padding-right: 48px; padding-left: 48px; padding-bottom: 48px; text-align: center;">
                <span id="loiXemTruoc" style="font-weight: 700; display:none;" >Dữ liệu trong file upload chưa hợp lệ. Vui lòng kiểm tra lại!</span>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto" style="padding-right: 48px; padding-left: 48px; padding-bottom: 48px; justify-content: center;">
                <button id="btnLuu" class="btn btn-success" type="button" style="display: none;"> Lưu bảng điểm </button>
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

    <!-- Scripts -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Bootstrap framework -->
    <script src="../js/swiper.min.js"></script>
    <!-- Swiper for image and text sliders -->
    <script src="../js/scripts.js"></script>

    <!-- Custom scripts -->
    <script src="../js/nhapdiemhe4/nhapdiemhe4.js"></script>

    <script>
        var maSo = getCookie("maSo");
        var maHocKyDanhGia = $("#select_hocKy_namHoc").find(":selected").val();
        var maLop = $("#select_lop").find(":selected").val();
        
        tableTitle.forEach(function(title, index) {
            $("#my_table>thead>tr").append(`<th class='cell'>${title}</th>`);

            if(index == tableTitle.length - 1) {
                $("#my_table>thead>tr").append(`<th class='cell'>Lỗi</th>`);
            }
        });

        $("#import_file").on("change", function() {
            // Kiểm tra file rỗng
            $("#tbody_BangDiemXemTruoc tr").remove();
            $("#loiXemTruoc").hide();

            if($("#import_file").val() == "") {
                return;
            }

            // Kiểm tra định dạng file có phải là Excel không?
            $fileName = $('input[type=file]')[0].files[0].name;
            $fileExtension = $fileName.split('.').pop();
            if ($fileExtension != 'xlsx' && $fileExtension != 'csv' && $fileExtension != 'xls') {
                presentNotification("error", "Lỗi", "File tải lên phải là dạng excel!");
                $("#import_file").val("");
                return;
            }

            // Kiểm tra có chọn học kỳ và lớp chưa?
            maHocKyDanhGia = $("#select_hocKy_namHoc").find(":selected").val();
            maLop = $("#select_lop").find(":selected").val();

            if(maHocKyDanhGia == "none" || maLop == "none") {
                presentNotification("error", "Lỗi", "Vui lòng chọn học kỳ - năm học hoặc lớp trước!");
                $("#import_file").val("");
                return;
            }

            //Tạo bảng điểm xem trước
            var formData = new FormData();
            formData.append("import_file_GPA", $('input[type=file]')[0].files[0]);
            formData.append("maHocKyDanhGia", maHocKyDanhGia);
            formData.append("maLop", maLop);

            createBangDiemXemTruoc(formData);
        });

        loadComboBoxHocKyVaNamHoc();
        loadComboBoxLopTheoMaCVHT(maSo);

        $("#btnLuu").on("click", function() {
            if(maHocKyDanhGia == "none" || maLop == "none") {
                presentNotification("error", "Lỗi", "Vui lòng chọn học kỳ - năm học hoặc lớp trước!");
                $("#import_file").val("");
                return;
            }
            luuDiem(maHocKyDanhGia);
        });
    </script>
        
    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

    </body>

    </html>