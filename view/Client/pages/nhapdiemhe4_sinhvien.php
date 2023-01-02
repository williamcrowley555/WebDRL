<?php
    include_once "header.php";

    if ($quyenNguoiDung != 'sinhvien') {
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
            <div class="col-sm-3"></div>
            <!-- Bảng chứa thông tin của sinh viên -->
            <div class="card col-sm-6 mt-4">
                <div class="card-body" id="information-card">
                    <h5 class="card-title text-center">Thông tin sinh viên</h5>
                    <div>
                        <span class="font-weight-bold">Mã số sinh viên: </span>
                        <span class="font-weight-normal" id="information-card_maSinhVien"></span>
                    </div>
                    <div>
                        <span class="font-weight-bold">Họ và tên: </span>
                        <span class="font-weight-normal" id="information-card_hoTenSinhVien"></span>
                    </div>
                    <div>
                        <span class="font-weight-bold">Lớp: </span>
                        <span class="font-weight-normal" id="information-card_lop"></span>
                    </div>
                    <div>
                        <span class="font-weight-bold">Khoa: </span>
                        <span class="font-weight-normal" id="information-card_tenKhoa"></span>
                    </div>
                    <div>
                        <span class="font-weight-bold">Cố vấn học tập: </span>
                        <span class="font-weight-normal" id="information-card_hoTenCoVan"></span>
                        <span class="font-weight-normal" id="information-card_maCoVanHocTap"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3"></div>

            <!-- Bảng điểm của sinh viên -->
            <div id="bangDiemXemTruoc" style="padding-right: 48px; padding-left: 48px; padding-top:48px;">
                <h4 style="text-transform: uppercase; text-align:center;">Bảng điểm sinh viên</h4>
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
    <script src="../js/nhapdiemhe4/nhapdiemhe4_sinhvien.js"></script>

    <script>
        redirectPage();
        loadThongTinSinhVien();

        tableTitle.forEach(function(title, index) {
            $("#my_table>thead>tr").append(`<th class='cell'>${title}</th>`);

            if(index == tableTitle.length - 1) {
                $("#my_table>thead>tr").append(`<th class='cell'>Hành động</th>`);
            }
        });

        loadGPAToTable();

        $(document).on("click", ".btn_NhapDiem_DiemHe4", function() {
            $(this).closest('tr').children('td:nth-child(6)').empty();
            $(this).closest('tr').children('td:nth-child(6)').append(
                `<input type="number" min="0" max="4" onchange="isGPA(this, 0, 4)" class="chinhSua-diemTB" style="width:120px" placeholder="Nhập điểm">`
            );

            $(this).hide();
            $(this).closest('tr').find('.edit-confirmation').show();
        });

        $(document).on("click", ".btn_ChinhSua_DiemHe4", function() {
            var diem = $(this).closest('tr').children('td:nth-child(6)').text();
            $(this).closest('tr').children('td:nth-child(6)').empty();
            $(this).closest('tr').children('td:nth-child(6)').append(
                `<input type="number" value="${diem}" min="0" max="4" onchange="isGPA(this, 0, 4)" class="chinhSua-diemTB" style="width:120px" placeholder="Nhập điểm">`
            );

            $(this).hide();
            $(this).closest('tr').find('.edit-confirmation').show();
        });

        $(document).on("click", ".btn_XacNhanNhapDiem_DiemHe4", function() {
            var diemChinhSua = $(this).closest('tr').find('.chinhSua-diemTB').val();
            let maSinhVien = $(this).attr('data-idmssv');
            let maHocKyDanhGiaXemDiem = $(this).attr('data-idmahkdg');
            let namHocXet = $(this).attr('data-namHocXet');
            let hocKyXet = $(this).attr('data-hocKyXet');
            var maHocKyMo = hocKyXet + "-" + namHocXet;
            // Call Edit API here...
            updateDiemHe4(maSinhVien, maHocKyDanhGiaXemDiem, diemChinhSua, "nhapDiem", namHocXet, hocKyXet, maHocKyMo);
            // Call Get All API
            loadGPAToTable();

            // $(this).parent().hide();
            // $(this).closest('tr').find('.btn_ChinhSua_DiemHe4').show();
        });

        $(document).on("click", ".btn_XacNhanChinhSua_DiemHe4", function() {
            var diemChinhSua = $(this).closest('tr').find('.chinhSua-diemTB').val();
            let maSinhVien = $(this).attr('data-idmssv');
            let maHocKyDanhGiaXemDiem = $(this).attr('data-idmahkdg');
            let namHocXet = $(this).attr('data-namHocXet');
            let hocKyXet = $(this).attr('data-hocKyXet');
            var maHocKyMo = hocKyXet + "-" + namHocXet;
            // Call Edit API here...
            updateDiemHe4(maSinhVien, maHocKyDanhGiaXemDiem, diemChinhSua, "chinhSua", namHocXet, hocKyXet, maHocKyMo);
            // Call Get All API
            loadGPAToTable();

            // $(this).parent().hide();
            // $(this).closest('tr').find('.btn_ChinhSua_DiemHe4').show();
        });

        // Xử lý hủy chỉnh sửa điểm trung bình học kỳ
        $(document).on("click", ".btn_HuyChinhSua_DiemHe4", function() {
            // Call Get All API
            //LoadDiemHe4(maSinhVien);
            var maHocKyDanhGiaXemDiem = $("#select_hocKy_namHoc_xemdiem").find(":selected").val();
            var maLopXemDiem = $("#select_lop_xemdiem").find(":selected").val();
            loadGPAToTable();

            $(this).parent().hide();
            $(this).closest('tr').find('.btn_ChinhSua_DiemHe4').show();
        });
        
    </script>