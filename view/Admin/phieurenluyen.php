<script src="assets/js/check_token.js"></script>
<script>
    //remove class active
    $("#menu-button-QuanTriVien").removeClass("active");
    $("#menu-button-ThongKe").removeClass("active");
    $("#menu-button-SinhVien").removeClass("active");
    $("#menu-button-HoatDongDanhGia").removeClass("active");
    $("#menu-button-Khoa").removeClass("active");
    $("#menu-button-Lop").removeClass("active");
    $("#menu-button-CoVanHocTap").removeClass("active");
    $("#menu-button-TieuChiDanhGia").removeClass("active");
    $("#menu-button-ThongBaoDanhGia").removeClass("active");
    $("#menu-button-KhieuNai").removeClass("active");
    $("#menu-button-ThongKe").removeClass("active");
    $("#menu-button-CaiDat").removeClass("active");
    $("#menu-button-ThongKeCanhCao").removeClass("active");

    //add class active
    $("#menu-button-PhieuRenLuyen").addClass("active");

    //set title
    document.title = "Phiếu rèn luyện | Web điểm rèn luyện";
</script>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title">.</h1>
        <h1 class="app-page-title"><img src="assets/images/icons/class.png" alt="" width="30px"> Phiếu rèn luyện</h1>

        <div class="row g-4 mb-4">

            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">

                        <div class="col-auto">

                            <select class="form-select w-auto" id="select_Khoa">

                            </select>
                        </div>

                        <div class="col-auto">

                            <select class="form-select w-auto" id='select_Lop'>

                            </select>
                        </div>

                        <div class="col-auto">

                            <select class="form-select w-auto" id='select_HocKyDanhGia'>

                            </select>
                        </div>

                        <div class="col-auto">
                            <input type="text" id="input_timKiemMaSinhVien" name="" class="form-control" placeholder="Nhập mã sinh viên">
                        </div>

                        <div class="col-auto">
                            <button type="button" id="btn_timKiemMaPhieuRenLuyen" class="btn app-btn-secondary">Tìm kiếm</button>
                        </div>
                        <!--//col-->

                    </div>
                    <!--//row-->
                </div>
                <!--//table-utilities-->
            </div>
            <!--//col-auto-->

            <!-- Modal -->
            <div class="modal fade" id="ModalXemVaDuyet" tabindex="-1" aria-labelledby="ModalXemVaDuyetLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalXemVaDuyetLabel">Chi tiết phiếu điểm rèn luyện: <span id="text_maPhieuRenLuyen_XemVaDuyet" style="font-weight: bold;"></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <h6 style="text-transform: uppercase; text-align: left;">--Thông tin sinh viên--</h6>

                            <div class="row justify-content-center" style="padding-bottom: 30px;text-align: start;" id="part_thongTinSinhVien">
                            
                            </div>

                            <h6 style="text-transform: uppercase; text-align: left;">--PHIẾU ĐÁNH GIÁ ĐIỂM RÈN LUYỆN--</h6>

                            <form id="formDanhGiaDRL" method="post" enctype="multipart/form-data">
                                <div class="form-outline mb-4">
                                    <div class="row justify-content-center" style="padding-bottom: 30px;text-align: start;">

                                        <table class="table table-hover table-bordered" id="tablePhieuRenLuyen">
                                            <thead>
                                                <tr style="text-align: center;">
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_noiDungDanhGia">

                                            </tbody>

                                        </table>

                                    </div>

                                    <button type="submit" class="btn btn-primary" style="width: auto;text-align: center;text-transform: uppercase;color: white;font-size: 16px;float: right;margin-right: 15px;margin-bottom: 20px;margin-top: -10px;">Duyệt điểm</button>
                                    <div id="counselorApproveWaiting" class="text-uppercase text-center text-body fw-bold bg-warning p-3" style="display: none;font-size: 18px">
                                        <svg style="vertical-align: middle;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                        </svg>
                                        <p class="d-inline align-middle">ĐANG CHỜ CỐ VẤN HỌC TẬP DUYỆT ĐIỂM</p>
                                    </div>
                                <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 0px;"></div><div class="form-notch-trailing"></div></div></div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">STT</th>
                                        <th class="cell">Mã phiếu rèn luyện</th>
                                        <th class="cell">Mã sinh viên</th>
                                        <th class="cell">Mã học kỳ</th>
                                        <th class="cell">Điểm tổng</th>
                                        <th class="cell">Xếp loại</th>
                                        <th class="cell">Cố vấn duyệt</th>
                                        <th class="cell">Khoa duyệt</th>
                                        <th class="cell">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="id_tbodyPhieuRenLuyen">

                                </tbody>
                            </table>
                        </div>
                        <!--//table-responsive-->

                    </div>
                    <!--//app-card-body-->
                </div>
                <!--//app-card-->
                <nav class="app-pagination" id="idPhanTrang">
                    <!-- <ul class="pagination justify-content-center" id="idPhanTrang">
                            
                        </ul> -->
                </nav>
                <!--//app-pagination-->

            </div>
            <!--//tab-pane-->



        </div>
        <!--//row-->
        


    </div>
    <!--//container-fluid-->
</div>
<!--//app-content-->

<!-- Modal xem danh sách hoạt động-->
<div class="modal fade" id="XemDanhSachHoatDongModal" tabindex="-1" aria-labelledby="XemDanhSachHoatDongModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Danh sách hoạt động đã tham gia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div>
                        <span style="font-weight: 700">Tiêu chí được cộng: </span><span id="id_thamgiahd_tieuChiDuocCong"></span>
                    </div>

                    <hr>
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left table-hover">
                            <thead>
                                <tr>
                                    <th class="cell">Mã hoạt động</th>
                                    <th class="cell">Tên hoạt động</th>
                                    <th class="cell">Điểm nhận được</th>
                                </tr>
                            </thead>
                            <tbody id="id_tbody_DanhSachThamGiaHoatDong">

                                <!-- <tr>
                                        <td colspan="4" style="text-align:center">Không tìm thấy kết quả.</td>
                                    </tr> -->

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xem ảnh minh chứng -->
    <div class="modal fade" id="AnhMinhChungModal" tabindex="-1" aria-labelledby="AnhMinhChungModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ảnh minh chứng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                   <img src="#" alt="" srcset="" id="id_img_modal" width="300px" />


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xuất phiếu rèn luyện -->
    <div class="modal fade" id="ModalExportPRL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="" method='POST' class="modal-dialog" id="form_export_prl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Xuất phiếu rèn luyện </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label class="mb-3 form-label" style="color: black; font-weight: 500;">Vui lòng chọn loại file muốn tải về</label>
                    
                    <input type='hidden' id='export_maPRL' />
                    <input type='hidden' name='data' class='data' />

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="radio" name="fileTypeExport" value="doc" id="radioExportWord" checked>
                        <label class="form-check-label" for="radioExportWord">
                            Word (.doc)
                        </label>
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="radio" name="fileTypeExport" value="pdf" id="radioExportPDF">
                        <label class="form-check-label" for="radioExportPDF">
                            PDF (.pdf)
                        </label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn app-btn-primary" style='color: white;'>Tải về</button>
                </div>
            </div>
        </form>
    </div>

<footer class="app-footer">

</footer>
<!--//app-footer-->


<!-- Page Specific JS -->
<script src="assets/js/phieurenluyen/function.js"></script>

<!-- Phieu Ren Luyen Helper JS -->
<script src="../../helper/js/phieuRenLuyen.js"></script>

<!-- Export Word JS -->
<script src="../../helper/js/export_word.js"></script>

<script>

    getPhieuRenLuyenTitle().forEach(function(title) {
        $("#tablePhieuRenLuyen>thead>tr").append(`<th scope="col"><strong>${title}</strong></th>`);
    });

    LoadComboBoxThongTinKhoa();

    LoadComboBoxThongTinLopTheoKhoa($('#select_Khoa').val());

    LoadComboBoxThongTinHocKyDanhGia();

    //hàm trong function.js
    GetListPhieurenluyen($('#select_Lop').val(), $('#select_HocKyDanhGia').val());

    function onlyLettersAndNumbers(str) {
        return /^[A-Za-z0-9]*$/.test(str);
    }

    function xuLyTimKiemMaPhieuRenLuyen() {
        var _input_timKiemMaSinhVien = $('#input_timKiemMaSinhVien').val().trim();

		if (_input_timKiemMaSinhVien != '') {
			if(Number(_input_timKiemMaSinhVien)){
				TimKiemPhieuRenLuyen(_input_timKiemMaSinhVien);
			} else {
				Swal.fire({
					icon: "error",
					title: "Lỗi",
					text: "Mã số sinh viên không hợp lệ!",
					timer: 2000,
					timerProgressBar: true,
				});
			}
		}
    }

    $('#select_Khoa').on('change', function() {
        $('#input_timKiemMaSinhVien').val('');

        var maKhoa_selected = $('#select_Khoa').val();
        
        LoadComboBoxThongTinLopTheoKhoa(maKhoa_selected);

        var maLop_selected = $('#select_Lop').val();
        var maHocKyDanhGia_selected = $('#select_HocKyDanhGia').val();

        GetListPhieurenluyen(maLop_selected, maHocKyDanhGia_selected);
    });

    $('#select_Lop').on('change', function() {
        $('#input_timKiemMaSinhVien').val('');
        
        var maLop_selected = $('#select_Lop').val();
        var maHocKyDanhGia_selected = $('#select_HocKyDanhGia').val();

        GetListPhieurenluyen(maLop_selected, maHocKyDanhGia_selected);
    });

    $('#select_HocKyDanhGia').on('change', function() {
        $('#input_timKiemMaSinhVien').val('');
        
        var maLop_selected = $('#select_Lop').val();
        var maHocKyDanhGia_selected = $('#select_HocKyDanhGia').val();

        GetListPhieurenluyen(maLop_selected, maHocKyDanhGia_selected);
    });

    $('#btn_timKiemMaPhieuRenLuyen').on('click', function() {
        xuLyTimKiemMaPhieuRenLuyen();
    });

    $('#input_timKiemMaSinhVien').keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the 'Enter' code
        {
            $('#btn_timKiemMaPhieuRenLuyen').click();
        }
    }); 

    $(document).on("click", ".btn_XemVaDuyet", function() {

        let maPhieuRenLuyen = $(this).attr('data-id');
        let maSinhVienGET = $(this).attr('data-mssv-id');
        let maHocKyDanhGiaGET = $(this).attr('data-mahocky-id');
        let _isAllowedToScore = false;

        phieuRenLuyen = getThongTinPhieuRenLuyen(maPhieuRenLuyen);

        createPhieuRenLuyenForm(
                {
                    tieuChiCap1: phieuRenLuyen.tieuChiCap1,
                    tieuChiCap2: phieuRenLuyen.tieuChiCap2,
                    tieuChiCap3: phieuRenLuyen.tieuChiCap3,
                },
                phieuRenLuyen.thongBaoDanhGia,
                getCookie('quyen'),
                "#tbody_noiDungDanhGia",
            );

        // Xóa nút duyệt điểm nếu user role không phải là 'khoa' hoặc nằm ngoài thời gian đánh giá
        _isAllowedToScore = isAllowedToScore(phieuRenLuyen.thongBaoDanhGia, getCookie("quyen"), ["khoa"]);
        
        if(!_isAllowedToScore) {
            $('form#formDanhGiaDRL').find(':submit').hide();
            $('#counselorApproveWaiting').hide();
        } else {
            if (getCookie("quyen") == "khoa" && phieuRenLuyen.thongTinPhieu.coVanDuyet == 1) {
                $('form#formDanhGiaDRL').find(':submit').show();
                $('#counselorApproveWaiting').hide();
            } else {
                $('form#formDanhGiaDRL').find(':submit').hide();
                $('#counselorApproveWaiting').show();
            }
        }
            
        $('#text_maPhieuRenLuyen_XemVaDuyet').text(maPhieuRenLuyen);
        setThongTinSinhVien(phieuRenLuyen.sinhVien, phieuRenLuyen.hocKyDanhGia, "#part_thongTinSinhVien");
        setDiemPhieuRenLuyen(phieuRenLuyen.thongTinPhieu, 
                            phieuRenLuyen.diemTieuChiCap2, 
                            phieuRenLuyen.diemTieuChiCap3, 
                            phieuRenLuyen.thongBaoDanhGia, 
                            getCookie('quyen'), 
                            "#tbody_noiDungDanhGia");

        xuLyLuuDiemRenLuyen(phieuRenLuyen, getCookie('quyen'), "form#formDanhGiaDRL", function() {
            Swal.fire({
                icon: "success",
                title: "Thành công",
                text: "Duyệt điểm rèn luyện thành công!",
                timer: 2000,
                timerProgressBar: true,
            });

            // Lấy lại thông tin phiếu nếu đã cập nhật điểm
            phieuRenLuyen = getThongTinPhieuRenLuyen(maPhieuRenLuyen);
            GetListPhieurenluyen($('#select_Lop').val(), $('#select_HocKyDanhGia').val());
        });
    })

    // Xử lý click nút xuất phiếu
    $(document).on("click", ".btn_XuatPRL", function() {
        let maPRL = $(this).attr('data-id');

        $('#export_maPRL').val(maPRL);

        $('#form_export_prl').trigger("reset");
    })

    // Xuất phiếu rèn luyện
    $(document).on("submit", "#form_export_prl", function(e) {
        let maPhieuRenLuyen = $('#export_maPRL').val();

        phieuRenLuyen = getThongTinPhieuRenLuyen(maPhieuRenLuyen);

        $(this).find('.data').val(
            JSON.stringify(phieuRenLuyen)
        );

        var fileType = $('input[name="fileTypeExport"]:checked').val();

        if (fileType.toLowerCase() == 'doc') {
            $(this).attr('action', '');

			var formData = new FormData(this);

            // Tạo HTML Phieu Ren Luyen 
            $.ajax({
				url: host_domain_url + '/helper/htmlPRLGenerator.php',
				type: "POST",
				data: formData,
				processData: false, 
				contentType: false,
				enctype: 'multipart/form-data',
				mimeType: 'multipart/form-data',
				success: function (result) {
					result = JSON.parse(result);

					exportToWord(result.htmlPhieuRenLuyen, 'phieu_ren_luyen');
				},
			});

            return false;
        } else if (fileType.toLowerCase() == 'pdf') {
            $(this).attr('action', host_domain_url + '/mpdf/export_phieuRenLuyen.php');
        } 

        return true;
    })

    //Xem danh sách hoạt động tham gia
    $(document).on("click", ".btn_XemDanhSachHoatDong", function() {

        let thamgiahd_maTieuChi = $(this).attr('data-tieuchi-id');
        let thamgiahd_tenTieuChi = $(this).attr('data-tentieuchi');
        let thamgiahd_maHocKyDanhGia = $('#input_maHocKyDanhGia').val();

        $('#id_thamgiahd_tieuChiDuocCong').text(thamgiahd_tenTieuChi);

        LoadDanhSachHoatDongDaThamGia(thamgiahd_maHocKyDanhGia, thamgiahd_maTieuChi);
    })
    
    // Xem ảnh minh chứng
    $(document).on("click", ".btn_AnhMinhChung", function() {
            let img_id = $(this).attr('data-img-id');
            let src_img_id = $("#"+img_id).attr('src');

            $('#id_img_modal').attr("src", src_img_id);
    })

</script>