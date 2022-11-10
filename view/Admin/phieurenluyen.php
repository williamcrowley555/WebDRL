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
                            <input type="text" id="input_timKiemMaPhieuRenLuyen" name="" class="form-control" placeholder="Nhập mã phiếu rèn luyện">
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

<footer class="app-footer">

</footer>
<!--//app-footer-->


<!-- Page Specific JS -->
<script src="assets/js/phieurenluyen/function.js"></script>

<!-- Phieu Ren Luyen Helper JS -->
<script src="../../helper/js/phieuRenLuyen.js"></script>

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
        var _input_timKiemMaPhieuRenLuyen = $('#input_timKiemMaPhieuRenLuyen').val().trim();

        if (_input_timKiemMaPhieuRenLuyen != '') {
            if(onlyLettersAndNumbers(_input_timKiemMaPhieuRenLuyen)){
                TimKiemPhieuRenLuyen(_input_timKiemMaPhieuRenLuyen);
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    text: "Mã phiếu rèn luyện không hợp lệ!",
                    timer: 2000,
                    timerProgressBar: true,
                });
            }
        }
    }

    $('#select_Khoa').on('change', function() {
		$('#input_timKiemMaPhieuRenLuyen').val('');

		var maKhoa_selected = $('#select_Khoa').val();
		
		LoadComboBoxThongTinLopTheoKhoa(maKhoa_selected);

		var maLop_selected = $('#select_Lop').val();
        var maHocKyDanhGia_selected = $('#select_HocKyDanhGia').val();

		GetListPhieurenluyen(maLop_selected, maHocKyDanhGia_selected);
	});

    $('#select_Lop').on('change', function() {
        $('#input_timKiemMaPhieuRenLuyen').val('');
        
        var maLop_selected = $('#select_Lop').val();
        var maHocKyDanhGia_selected = $('#select_HocKyDanhGia').val();

		GetListPhieurenluyen(maLop_selected, maHocKyDanhGia_selected);
    });

    $('#select_HocKyDanhGia').on('change', function() {
        $('#input_timKiemMaPhieuRenLuyen').val('');
        
        var maLop_selected = $('#select_Lop').val();
        var maHocKyDanhGia_selected = $('#select_HocKyDanhGia').val();

        GetListPhieurenluyen(maLop_selected, maHocKyDanhGia_selected);
    });

    $('#btn_timKiemMaPhieuRenLuyen').on('click', function() {
        xuLyTimKiemMaPhieuRenLuyen();
    });

    $('#input_timKiemMaPhieuRenLuyen').keypress(function (e) {
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

        // Nếu lần đầu tiên click nút xem chi tiết phiếu hoặc xem phiếu khác với phiếu trước đó đã xem
        if (typeof(phieuRenLuyen.thongTinPhieu.maPhieuRenLuyen) === "undefined" 
            || maPhieuRenLuyen != phieuRenLuyen.thongTinPhieu.maPhieuRenLuyen) {
            var oldPhieuRenLuyen = phieuRenLuyen;
            phieuRenLuyen = getThongTinPhieuRenLuyen(maPhieuRenLuyen);

            // Kiểm tra phiếu rèn luyện cần xem có cùng các tiêu chí của phiếu rèn luyện cũ?
            // Nếu giống => bỏ qua việc tạo lại form và ngược lại
            if (!arraysEqual(oldPhieuRenLuyen.tieuChiCap1, phieuRenLuyen.tieuChiCap1)
                || !arraysEqual(oldPhieuRenLuyen.tieuChiCap2, phieuRenLuyen.tieuChiCap2)
                || !arraysEqual(oldPhieuRenLuyen.tieuChiCap3, phieuRenLuyen.tieuChiCap3)) {
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
                    $('form#formDanhGiaDRL').find(':submit').remove();
                }
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

    $(document).on("submit", ".form_exportPDFPhieuRenLuyen", function(e) {
        let maPhieuRenLuyen = $(this).parent().children('.btn_XemVaDuyet').attr('data-id');

        phieuRenLuyen = getThongTinPhieuRenLuyen(maPhieuRenLuyen);

        $(this).children('.data').val(
            JSON.stringify(phieuRenLuyen)
        );

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
	
	$(document).on("click", ".btn_AnhMinhChung", function() {
            let img_id = $(this).attr('data-img-id');
            let src_img_id = $("#"+img_id).attr('src');

            $('#id_img_modal').attr("src", src_img_id);
    })

</script>