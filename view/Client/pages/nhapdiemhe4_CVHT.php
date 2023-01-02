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
                <input class="form-check-input" type="radio" name="radio_nhapdiemhe4" id="radio_nhapdiem">
                <label class="form-check-label" id="label_nhapdiem" for="radio_nhapdiem"> Nhập điểm </label>
                <input class="form-check-input ms-5" type="radio" name="radio_nhapdiemhe4" id="radio_xemdiem">
                <label class="form-check-label" id="label_xemdiem" for="radio_xemdiem"> Xem điểm </label>
                <input class="form-check-input ms-5" type="radio" name="radio_nhapdiemhe4" id="radio_molop">
                <label class="form-check-label" id="label_molop" for="radio_molop"> Mở lớp nhập điểm </label>
            </div>
            
            <!-- Bảng nhập điểm -->
            <div id='selector_nhapdiem' style="padding: 0 60px; padding-bottom: 48px;">
                <span style="font-weight: 700" >Học kỳ - Năm học:</span>
                <select class="ms-3" id="select_hocKy_namHoc">
                    
                </select>
                <span class="ms-4" style="font-weight: 700;" >Lớp:</span>
                <select class="ms-3" id="select_lop">
                    
                </select>
                <input type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="import_file" class="ms-4"">
            </div>
            <div id='luuy_nhapdiem' style="padding-right: 48px; padding-left: 48px; padding-bottom: 48px; text-align: center;">
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
            <div id="loiXemTruoc" style="padding-right: 48px; padding-left: 48px; padding-bottom: 48px; text-align: center;">
                <span style="font-weight: 700;" >Dữ liệu trong file upload chưa hợp lệ. Vui lòng kiểm tra lại!</span>
            </div>
            <div id="btnLuu" class="gap-2 col-3 mx-auto" style="padding-right: 48px; padding-left: 48px; padding-bottom: 48px; justify-content: center;">
                <button class="btn btn-success" type="button"> Lưu bảng điểm </button>
            </div>
            
            <!-- Bảng xem điểm -->
            <div id='selector_xemdiem' style="padding:0 60px; padding-bottom: 48px; ">
                <span style="font-weight: 700" >Học kỳ - Năm học:</span>
                <select class="ms-3" id="select_hocKy_namHoc_xemdiem">
                    
                </select>
                <span class="ms-4" style="font-weight: 700;" >Lớp:</span>
                <select class="ms-3" id="select_lop_xemdiem">
                    
                </select>

                <button id="btn_xemdiem" type="button" class="btn btn-success ms-5" style="color: white;">Xem điểm</button>
            </div>
            <div id='danhsachdiemhe4' style="padding-right: 48px; padding-left: 48px; padding-bottom: 48px; text-align: center; ">
                <h4 style="text-transform: uppercase; text-align:center;">Danh sách điểm hệ 4</h4>
                <div class="table-responsive px-2" id ="DanhSachKetQua">
                    <table class="table app-table-hover mb-0 text-left" id="table_ketQuaHocTap">
                        <thead>
                            <tr>

                            </tr>
                        </thead>
                        <tbody id="tbody_danhSachDiemHe4">
                            
                        </tbody>
                    </table>
                </div>

                <nav class="app-pagination ps-2 pt-3" id="idPhanTrang">
                    
                </nav>
            </div>

            <!-- Bảng mở lớp -->
            <div id='selector_molop' style="padding: 0 60px; padding-bottom: 48px; ">
                <span style="font-weight: 700" >Học kỳ - Năm học:</span>
                <select class="ms-3" id="select_hocKy_namHoc_molop">
                    
                </select>

            </div>
            <div id='danhsachlop' style="padding-right: 48px; padding-left: 48px; padding-bottom: 48px; text-align: center; ">
                <h4 style="text-transform: uppercase; text-align:center;">Danh sách lớp</h4>
                <div class="table-responsive px-2" id ="DanhSachLop">
                    <table class="table app-table-hover mb-0 text-left" id="table_danhSachLop">
                        <thead>
                            <tr>

                            </tr>
                        </thead>
                        <tbody id="tbody_danhSachLop">
                            
                        </tbody>
                    </table>
                </div>

                <nav class="app-pagination ps-2 pt-3" id="idPhanTrangDanhSachLop">
                    
                </nav>
            </div>

            <!-- Form tải về mẫu phiếu nhập điểm -->
            <form action="" method='POST' id='formDownloadMauNhapDiemHe4' class='text-center pb-2'>
                <input type='hidden' name="table_data" id="table_data" />
                <p>Tải về mẫu nhập điểm hệ 4 <button type='submit' class='btn btn-link bg-white p-0' name="btn_export_to_excel" style='outline: none; box-shadow: none;'>tại đây</button></p>
            </form>
            
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

        <!-- Icon mở khóa -->
        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock" viewBox="0 0 16 16">
  <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
</svg> -->
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
    <script src="../js/nhapdiemhe4/nhapdiemhe4_CVHT.js"></script>

    <script>
        // Chuyển hướng trang nếu chức năng nhập điểm chưa mở hoặc không đúng quyền.
        redirectPage();

        $("#select_hocKy_namHoc").on("change", function() {
            $("#tbody_BangDiemXemTruoc tr").remove();
            $("#loiXemTruoc").hide();
            $("#btnLuu").hide();
            $("#import_file").val("");
        });

        $("#select_lop").on("change", function() {
            $("#tbody_BangDiemXemTruoc tr").remove();
            $("#loiXemTruoc").hide();
            $("#btnLuu").hide();
            $("#import_file").val("");
        });

        $("#select_hocKy_namHoc_molop").on("change", function() {
            $("#tbody_danhSachLop tr").remove();
            $("#idPhanTrangDanhSachLop").empty();
        });

        var maSo = getCookie("maSo");
        var maHocKyDanhGia = $("#select_hocKy_namHoc").find(":selected").val();
        var maLop = $("#select_lop").find(":selected").val();
        var maHocKyDanhGiaXemDiem = $("#select_hocKy_namHoc_xemdiem").find(":selected").val();
        var maLopXemDiem = $("#select_lop_xemdiem").find(":selected").val();

        //Hiển thị Elements tương ứng với các quyền được mở khi tải trang.
        var isUnlockLop = isUnlockForCVHT("lop");
        var isUnlockCVHT = isUnlockForCVHT();
        if (isUnlockLop && isUnlockCVHT)
            showUnlockCVHTAndLopElements();
        else if(isUnlockLop)
            showUnlockLopElements();
            else
                showUnlockCVHTElements();

        // Chọn radio nhập điểm thì hiện bảng điểm xem trước
        $("#radio_nhapdiem").on("click", function() {
            // Ẩn thông tin của bảng xem điểm
            hideXemDiemElements();

            // Ẩn thông tin của bảng mở lớp
            hideMoLopElements();

            // Hiện thông tin của bảng nhập điểm
            showNhapDiemElements();
        });

        $("#radio_xemdiem").on("click", function() {
            // Ẩn thông tin của bảng nhập điểm
            hideNhapDiemElements();

            // Ẩn thông tin của bảng mở lớp
            hideMoLopElements();

            // Hiện thông tin của bảng xem điểm
            showXemDiemElements();
        });

        $("#radio_molop").on("click", function() {
            // Ẩn thông tin của bảng nhập điểm
            hideNhapDiemElements();

            // Ẩn thông tin của bảng xem điểm
            hideXemDiemElements();

            // Hiện thông tin của bảng mở lớp
            showMoLopElements();
        });
        
        tableTitle.forEach(function(title, index) {
            $("#my_table>thead>tr").append(`<th class='cell'>${title}</th>`);

            if(index == tableTitle.length - 1) {
                $("#my_table>thead>tr").append(`<th class='cell'>Lỗi</th>`);
            }
        });

        tableDanhSachDiemHe4Title.forEach(function(title, index) {
            $("#table_ketQuaHocTap>thead>tr").append(`<th class='cell'>${title}</th>`);

            if(index == tableDanhSachDiemHe4Title.length - 1) {
                $("#table_ketQuaHocTap>thead>tr").append(`<th class='cell'>Hành động</th>`);
            }
        });

        tableDanhSachLopTitle.forEach(function(title, index) {
            $("#table_danhSachLop>thead>tr").append(`<th class='cell'>${title}</th>`);

            if(index == tableDanhSachLopTitle.length - 1) {
                $("#table_danhSachLop>thead>tr").append(`<th class='cell'>Hành động</th>`);
            }
        });

        $("#import_file").on("change", function() {
            // Kiểm tra file rỗng
            $("#tbody_BangDiemXemTruoc tr").remove();
            $("#loiXemTruoc").hide();
            $("#btnLuu").hide();

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

        $("#btnLuu").on("click", function() {
            if(maHocKyDanhGia == "none" || maLop == "none") {
                presentNotification("error", "Lỗi", "Vui lòng chọn học kỳ - năm học hoặc lớp trước!");
                $("#import_file").val("");
                return;
            }
            luuDiem(maHocKyDanhGia);
        });

        $("#btn_xemdiem").on("click", function() {
            var maHocKyDanhGiaXemDiem = $("#select_hocKy_namHoc_xemdiem").find(":selected").val();
            var maLopXemDiem = $("#select_lop_xemdiem").find(":selected").val();
            if(maHocKyDanhGiaXemDiem == "none" || maLopXemDiem == "none") {
                presentNotification("error", "Lỗi", "Vui lòng chọn học kỳ - năm học hoặc lớp trước!");
                $("#import_file").val("");
                return;
            }
            loadGPAToTable(maLopXemDiem, maHocKyDanhGiaXemDiem);
        });

        $("#select_hocKy_namHoc_molop").on("change", function() {
            var maHocKyDanhGiaMoLop = $("#select_hocKy_namHoc_molop").find(":selected").val();
            if(maHocKyDanhGiaMoLop == "none") {
                presentNotification("error", "Lỗi", "Vui lòng chọn học kỳ - năm học trước!");
                return;
            }
            loadDanhSachLop(maSo);
        });

        // Xử lý chỉnh sửa điểm trung bình học kỳ
	$(document).on("click", ".btn_ChinhSua_DiemHe4", function() {
		var diem = $(this).closest('tr').children('td:nth-child(4)').text();
		$(this).closest('tr').children('td:nth-child(4)').empty();
		$(this).closest('tr').children('td:nth-child(4)').append(
			`<input type="number" value="${diem}" min="0" max="4" onchange="isGPA(this, 0, 4)" class="chinhSua-diemTB" style="width:120px" placeholder="Nhập điểm">`
		);

		$(this).hide();
		$(this).closest('tr').find('.edit-confirmation').show();
	});

	// Xử lý xác nhận chỉnh sửa điểm trung bình học kỳ
	$(document).on("click", ".btn_XacNhanChinhSua_DiemHe4", function() {
		var diemChinhSua = $(this).closest('tr').find('.chinhSua-diemTB').val();
		let maSinhVien = $(this).attr('data-idmssv');
		let maHocKyDanhGiaXemDiem = $("#select_hocKy_namHoc_xemdiem").find(":selected").val();
        var maLopXemDiem = $("#select_lop_xemdiem").find(":selected").val();
		// Call Edit API here...
		updateDiemHe4(maSinhVien, maHocKyDanhGiaXemDiem, diemChinhSua);
		// Call Get All API
        loadGPAToTable(maLopXemDiem, maHocKyDanhGiaXemDiem);

		// $(this).parent().hide();
		// $(this).closest('tr').find('.btn_ChinhSua_DiemHe4').show();
	});

	// Xử lý hủy chỉnh sửa điểm trung bình học kỳ
	$(document).on("click", ".btn_HuyChinhSua_DiemHe4", function() {
		// Call Get All API
		//LoadDiemHe4(maSinhVien);
        var maHocKyDanhGiaXemDiem = $("#select_hocKy_namHoc_xemdiem").find(":selected").val();
        var maLopXemDiem = $("#select_lop_xemdiem").find(":selected").val();
        loadGPAToTable(maLopXemDiem, maHocKyDanhGiaXemDiem);

		$(this).parent().hide();
		$(this).closest('tr').find('.btn_ChinhSua_DiemHe4').show();
	});

    // Xử lý mở nhập điểm
    $(document).on("click", ".btn_MoNhapDiem", function() {
        var maLop = $(this).attr('data-malop');
        var maHocKyDanhGia = $("#select_hocKy_namHoc_molop").find(":selected").val();
        var result = callGetAPI(urlapi_hockydanhgia_single_read + maHocKyDanhGia);
        var maHocKyMo = result.hocKyXet + "-" + result.namHocXet;
        khoaHoacMoNhapDiem(urlapi_lopmonhapdiemhe4_create, maLop, maHocKyMo);
    });

    // Xử lý khóa nhập điểm
    $(document).on("click", ".btn_KhoaNhapDiem", function() {
        var maLop = $(this).attr('data-malop');
        var maHocKyDanhGia = $("#select_hocKy_namHoc_molop").find(":selected").val();
        var result = callGetAPI(urlapi_hockydanhgia_single_read + maHocKyDanhGia);
        var maHocKyMo = result.hocKyXet + "-" + result.namHocXet;
        khoaHoacMoNhapDiem(urlapi_lopmonhapdiemhe4_delete, maLop, maHocKyMo);
    });

    $(document).on("submit", "#formDownloadMauNhapDiemHe4", function(e) {
        $(this).attr('action', host_domain_url + '/phpspreadsheet/export/export_diemhe4.php');
        var tableContent = [
            diemhe4 = {
                soThuTu: "1",
                maSinhVien: "3118410179",
                hoTenSinhVien: "Phạm Đức Khải",
                diem: "3"
            }
        ]

        $("#formDownloadMauNhapDiemHe4 #table_data").val(
            JSON.stringify({
                tableTitle: tableTitle,
                tableContent: tableContent
            })
        );
    });

    function isGPA(inputElement, min, max) {
		if (inputElement.value < min) {
			inputElement.value = min;
		} else if (inputElement.value > max) {
			inputElement.value = max;
		}
	};
    </script>
        
    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

    </body>

    </html>