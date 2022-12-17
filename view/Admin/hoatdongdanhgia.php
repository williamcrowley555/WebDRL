<script src="assets/js/check_token.js"></script>
<script>

	//remove class active
	$("#menu-button-QuanTriVien").removeClass("active");
	$("#menu-button-ThongKe").removeClass("active");
	$("#menu-button-SinhVien").removeClass("active");
	$("#menu-button-Lop").removeClass("active");
	$("#menu-button-Khoa").removeClass("active");
	$("#menu-button-PhieuRenLuyen").removeClass("active");
	$("#menu-button-CoVanHocTap").removeClass("active");
	$("#menu-button-TieuChiDanhGia").removeClass("active");
	$("#menu-button-ThongBaoDanhGia").removeClass("active");
	$("#menu-button-KhieuNai").removeClass("active");
	$("#menu-button-ThongKe").removeClass("active");
	$("#menu-button-CaiDat").removeClass("active");
	$("#menu-button-ThongKeCanhCao").removeClass("active");
	
	//add class active
	$("#menu-button-HoatDongDanhGia").addClass("active");

	//set title
	document.title = "Hoạt động đánh giá | Web điểm rèn luyện";
		
</script>

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<h1 class="app-page-title">.</h1>
			<h1 class="app-page-title"><img src="assets/images/icons/crowd.png" alt="" width="30px"> Hoạt động đánh giá</h1>

			<div class="row g-4 mb-4">

				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">

							<div class="col-auto">

							</div>

							<div class="col-auto">
								<div class="table-search-form row gx-1 align-items-center" style="padding-bottom: 20px;">
									<div class="col-auto">
										<input type="text" id="inputTimKiem_MaHoatDong" name="inputTimKiem_MaHoatDong" class="form-control search-orders" placeholder="Nhập mã hoạt động...">
									</div>
									<div class="col-auto">
										<button type="button" id="btn_timKiemMaHD" class="btn app-btn-secondary">Tìm kiếm</button>
									</div>

									<div class="col-auto" style="padding-left: 15px;">
										<button class="btn app-btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#AddModal">Thêm mới</button>
									</div>
								</div>

								<div class="table-search-form row gx-1 align-items-center">
									<div class="col-auto me-3">
										<p></p>
										<span style="font-weight: 700;">Lọc theo khoảng thời gian: </button>
									</div>

									<div class="col-auto me-3">
										<span style="font-weight: 700;">Từ:</span>
										<input type="datetime-local" id="fromDateFilter" class="form-control search-orders" placeholder="Nhập thời gian bắt đầu...">
									</div>

									<div class="col-auto me-3">
										<span style="font-weight: 700;">Đến:</span>
										<input type="datetime-local" id="toDateFilter" class="form-control search-orders" placeholder="Nhập thời gian kết thúc...">
									</div>

									<div class="col-auto mt-auto">
										<button type="button" id="btnDateFilter" class="btn app-btn-primary btn-primary" data-bs-toggle="modal">Lọc</button>
									</div>
								</div>
							</div>

							<!--//col-->


						</div>
						<!--//row-->
					</div>
					<!--//table-utilities-->
				</div>
				<!--//col-auto-->

				<!-- Modal thêm -->
				<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<form action="" class="modal-dialog" id="AddForm">
						<div class="modal-content">
							<div class="modal-header">
								<img src="assets/images/icons/add.png" width="25px" style="padding-right: 5px;">
								<h5 class="modal-title" id="exampleModalLabel"> Thêm hoạt động đánh giá</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">

								<div class="mb-3 form-group">
									<label for="select_HocKyDanhGia" class="form-label" style="color: black; font-weight: 500;">Học kỳ áp dụng</label>
									<select class="form-select" aria-label="Default select example" name="maHocKyDanhGia" id="select_HocKyDanhGia">

									</select>
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="input_TenHoatDong" class="form-label" style="color: black; font-weight: 500;">Tên hoạt động</label>
									<input type="text" class="form-control" name="tenHoatDong" id="input_TenHoatDong" placeholder="Nhập tên hoạt động...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="select_Khoa" class="form-label" style="color: black; font-weight: 500;">Khoa tổ chức</label>
									<select class="form-select" aria-label="Default select example" name="maKhoa" id="select_Khoa">

									</select>
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="select_TieuChi" class="form-label" style="color: black; font-weight: 500;">Tiêu chí được cộng điểm</label>
									<select class="form-select" aria-label="Default select example" id="select_TieuChi">

									</select>
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="input_DiemNhanDuoc" class="form-label" style="color: black; font-weight: 500;">Điểm nhận được</label>
									<input type="number" class="form-control" name="diemNhanDuoc" id="input_DiemNhanDuoc" placeholder="Nhập điểm nhận được...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="input_DiaDiemHoatDong" class="form-label" style="color: black; font-weight: 500;">Địa điểm diễn ra hoạt động</label>
									<input type="text" class="form-control" name="diaDiemDienRaHoatDong" id="input_DiaDiemHoatDong" placeholder="Nhập địa điểm hoạt động...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="input_ThoiGianBatDau" class="form-label" style="color: black; font-weight: 500;">Thời gian bắt đầu</label>
									<input type="datetime-local" class="form-control" name="thoiGianBatDauHoatDong" id="input_ThoiGianBatDau" placeholder="Nhập thời gian bắt đầu...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="input_ThoiGianKetThuc" class="form-label" style="color: black; font-weight: 500;">Thời gian kết thúc</label>
									<input type="datetime-local" class="form-control" name="thoiGianKetThucHoatDong" id="input_ThoiGianKetThuc" placeholder="Nhập thời gian kết thúc...">
									<span class="invalid-feedback"></span>
								</div>


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
								<button type="submit" class="btn btn-primary" style='color: white;'>Thêm mới</button>
							</div>
						</div>
					</form>
				</div>


				<!-- Modal chỉnh sửa -->
				<div class="modal fade" id="ChinhSuaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<form action="" class="modal-dialog" id="EditForm">
						<div class="modal-content">
							<div class="modal-header">
								<img src="assets/images/icons/edit.png" width="25px" style="padding-right: 5px;">
								<h5 class="modal-title" id="exampleModalLabel"> Chỉnh sửa hoạt động đánh giá</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">

								<div class="mb-3 form-group">
									<label for="edit_input_MaHoatDong" class="form-label" style="color: black; font-weight: 500;">Mã hoạt động</label>
									<input type="text" class="form-control" name="maHoatDong" id="edit_input_MaHoatDong" placeholder="Nhập mã hoạt động..." readonly>
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_select_HocKyDanhGia" class="form-label" style="color: black; font-weight: 500;">Học kỳ áp dụng</label>
									<select class="form-select" aria-label="Default select example" name="maHocKyDanhGia" id="edit_select_HocKyDanhGia" disabled>

									</select>
									<span class="invalid-feedback"></span>
								</div>
								
								<div class="mb-3 form-group">
									<label for="edit_input_TenHoatDong" class="form-label" style="color: black; font-weight: 500;">Tên hoạt động</label>
									<input type="text" class="form-control" name="tenHoatDong" id="edit_input_TenHoatDong" placeholder="Nhập tên hoạt động...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_select_Khoa" class="form-label" style="color: black; font-weight: 500;">Khoa tổ chức</label>
									<select class="form-select" aria-label="Default select example" name="maKhoa" id="edit_select_Khoa">

									</select>
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_select_TieuChi" class="form-label" style="color: black; font-weight: 500;">Tiêu chí được cộng điểm</label>
									<select class="form-select" aria-label="Default select example" id="edit_select_TieuChi">

									</select>
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_input_DiemNhanDuoc" class="form-label" style="color: black; font-weight: 500;">Điểm nhận được</label>
									<input type="number" class="form-control" name="diemNhanDuoc" id="edit_input_DiemNhanDuoc" placeholder="Nhập điểm nhận được...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_input_DiaDiemHoatDong" class="form-label" style="color: black; font-weight: 500;">Địa điểm diễn ra hoạt động</label>
									<input type="text" class="form-control" name="diaDiemDienRaHoatDong" id="edit_input_DiaDiemHoatDong" placeholder="Nhập địa điểm hoạt động...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_input_ThoiGianBatDau" class="form-label" style="color: black; font-weight: 500;">Thời gian bắt đầu</label>
									<input type="datetime-local" class="form-control" name="thoiGianBatDauHoatDong" id="edit_input_ThoiGianBatDau" placeholder="Nhập thời gian bắt đầu...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_input_ThoiGianKetThuc" class="form-label" style="color: black; font-weight: 500;">Thời gian kết thúc</label>
									<input type="datetime-local" class="form-control" name="thoiGianKetThucHoatDong" id="edit_input_ThoiGianKetThuc" placeholder="Nhập thời gian kết thúc...">
									<span class="invalid-feedback"></span>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
								<button type="submit" class="btn btn-warning" style='color: white;'>Chỉnh sửa</button>
							</div>
						</div>
					</form>
				</div>


				<!-- Modal danh sách tham gia -->
				<div class="modal fade" id="DanhSachThamGiaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<img src="assets/images/icons/lists.png" width="25px" style="padding-right: 5px;">
								<h5 class="modal-title" id="exampleModalLabel"> Danh sách sinh viên tham gia</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">

								<div class="mb-3">
									<label class="form-label" style="color: black; font-weight: 500;">Mã hoạt động: </label>
									<span id="DSSV_text_MaHoatDong" ></span>
								</div>

								<div class="mb-3">
									<label class="form-label" style="color: black; font-weight: 500;">Tên hoạt động: </label>
									<span id="DSSV_text_TenHoatDong" ></span>
								</div>

								<div class="mb-3">
									<label class="form-label" style="color: black; font-weight: 500;">Tổng số sinh viên tham gia: </label>
									<span id="DSSV_text_TongSoSVThamGia" ></span>
								</div>

								<h6>---DANH SÁCH---</h6>
								<div class="table-responsive">
								<table class="table app-table-hover mb-0 text-left">
									<thead>
										<tr>
											<th class="cell">STT</th>
											<th class="cell">Mã sinh viên</th>
											<th class="cell">Tên sinh viên</th>
											<th class="cell">Thời gian điểm danh</th>
										</tr>
									</thead>
									<tbody id="id_tbody_DanhSachThamGia">
										
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


				<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
						<div class="app-card-body">
							<div class="table-responsive">
								<table class="table app-table-hover mb-0 text-left">
									<thead>
										<tr>
											<th class="cell">STT</th>
											<th class="cell">Mã hoạt động</th>
											<th class="cell">Tên hoạt động</th>
											<th class="cell">Mã khoa tổ chức</th>
											<th class="cell">Tiêu chí được cộng điểm</th>
											<th class="cell">Điểm nhận được</th>
											<th class="cell">Địa điểm</th>
											<th class="cell">Học kỳ áp dụng</th>
											<th class="cell">Thời gian bắt đầu</th>
											<th class="cell">Thời gian kết thúc</th>
											<th class="cell">Thời gian bắt đầu điểm danh</th>
											<th class="cell">Mã QR điểm danh/checkin</th>
											<th class="cell">Hành động</th>
										</tr>
									</thead>
									<tbody id="id_tbodyLop">

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

	<footer class="app-footer">

	</footer>
	<!--//app-footer-->


<!-- Page Specific JS -->
<script src="assets/js/hoatdongdanhgia/function.js"></script>

<style>
	.ui-autocomplete { position: absolute; cursor: default;z-index:9999 !important;}  
</style>


<!-- Form Validator -->
<script src="./assets/js/validator.js"></script>

<script>
	
	Validator({
        form: '#AddForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isRequired('#input_TenHoatDong', 'Vui lòng nhập tên hoạt động'),
			Validator.isRequired('#input_DiemNhanDuoc', 'Vui lòng nhập số điểm nhận được'),
			Validator.isNumber('#input_DiemNhanDuoc', 'Điểm nhận được chỉ bao gồm các ký tự số'),
			Validator.minNumber('#input_DiemNhanDuoc', 0, "Điểm nhận được phải lớn hơn 0"),
			Validator.maxNumber('#input_DiemNhanDuoc', 100, "Điểm nhận được phải nhỏ hơn 100"),
			Validator.isRequired('#input_DiaDiemHoatDong', 'Vui lòng nhập địa điểm hoạt động'),
			Validator.isRequired('#input_ThoiGianBatDau', 'Vui lòng nhập thời gian bắt đầu'),
			Validator.isRequired('#input_ThoiGianKetThuc', 'Vui lòng nhập thời gian kết thúc'),
			Validator.isEventDay('#input_ThoiGianBatDau', function() {
				return document.querySelector('#AddForm #input_ThoiGianKetThuc').value;
			}),
			Validator.isEventDay('#input_ThoiGianKetThuc', function() {
				return document.querySelector('#AddForm #input_ThoiGianBatDau').value;
			}, undefined, true),
			Validator.isInDateRange(
				'#input_ThoiGianBatDau', 
				function() {
					var _input_MaHocKy = $("#AddForm #select_HocKyDanhGia option:selected").text();
					var namHoc = _input_MaHocKy.substring(_input_MaHocKy.indexOf(" - ") + 3);
					var splittedNamHoc = namHoc.split('-');

					return `${splittedNamHoc[0]}-01-01`;
				},
				function() {
					var _input_MaHocKy = $("#AddForm #select_HocKyDanhGia option:selected").text();
					var namHoc = _input_MaHocKy.substring(_input_MaHocKy.indexOf(" - ") + 3);
					var splittedNamHoc = namHoc.split('-');

					return `${splittedNamHoc[1]}-12-31`;
				}
			),
			Validator.isInDateRange(
				'#input_ThoiGianKetThuc', 
				function() {
					var _input_MaHocKy = $("#AddForm #select_HocKyDanhGia option:selected").text();
					var namHoc = _input_MaHocKy.substring(_input_MaHocKy.indexOf(" - ") + 3);
					var splittedNamHoc = namHoc.split('-');

					return `${splittedNamHoc[0]}-01-01`;
				},
				function() {
					var _input_MaHocKy = $("#AddForm #select_HocKyDanhGia option:selected").text();
					var namHoc = _input_MaHocKy.substring(_input_MaHocKy.indexOf(" - ") + 3);
					var splittedNamHoc = namHoc.split('-');

					return `${splittedNamHoc[1]}-12-31`;
				}
			),
        ],
        onSubmit: ThemMoi_HoatDong
    })
	  
	Validator({
        form: '#EditForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isRequired('#edit_input_MaHoatDong', 'Vui lòng nhập tên hoạt động'),
			Validator.isRequired('#edit_input_TenHoatDong', 'Vui lòng nhập tên hoạt động'),
			Validator.isRequired('#edit_input_DiemNhanDuoc', 'Vui lòng nhập số điểm nhận được'),
			Validator.isNumber('#edit_input_DiemNhanDuoc', 'Điểm nhận được chỉ bao gồm các ký tự số'),
			Validator.minNumber('#edit_input_DiemNhanDuoc', 0, "Điểm nhận được phải lớn hơn 0"),
			Validator.maxNumber('#edit_input_DiemNhanDuoc', 100, "Điểm nhận được phải nhỏ hơn 100"),
			Validator.isRequired('#edit_input_DiaDiemHoatDong', 'Vui lòng nhập địa điểm hoạt động'),
			Validator.isRequired('#edit_input_ThoiGianBatDau', 'Vui lòng nhập thời gian bắt đầu'),
			Validator.isRequired('#edit_input_ThoiGianKetThuc', 'Vui lòng nhập thời gian kết thúc'),
			Validator.isEventDay('#edit_input_ThoiGianBatDau', function() {
				return document.querySelector('#EditForm #edit_input_ThoiGianKetThuc').value;
			}),
			Validator.isEventDay('#edit_input_ThoiGianKetThuc', function() {
				return document.querySelector('#EditForm #edit_input_ThoiGianBatDau').value;
			}, undefined, true),
			Validator.isInDateRange(
				'#edit_input_ThoiGianBatDau', 
				function() {
					var _input_MaHocKy = $("#EditForm #edit_select_HocKyDanhGia option:selected").text();
					var namHoc = _input_MaHocKy.substring(_input_MaHocKy.indexOf(" - ") + 3);
					var splittedNamHoc = namHoc.split('-');

					return `${splittedNamHoc[0]}-01-01`;
				},
				function() {
					var _input_MaHocKy = $("#EditForm #edit_select_HocKyDanhGia option:selected").text();
					var namHoc = _input_MaHocKy.substring(_input_MaHocKy.indexOf(" - ") + 3);
					var splittedNamHoc = namHoc.split('-');

					return `${splittedNamHoc[1]}-12-31`;
				}
			),
			Validator.isInDateRange(
				'#edit_input_ThoiGianKetThuc', 
				function() {
					var _input_MaHocKy = $("#EditForm #edit_select_HocKyDanhGia option:selected").text();
					var namHoc = _input_MaHocKy.substring(_input_MaHocKy.indexOf(" - ") + 3);
					var splittedNamHoc = namHoc.split('-');

					return `${splittedNamHoc[0]}-01-01`;
				},
				function() {
					var _input_MaHocKy = $("#EditForm #edit_select_HocKyDanhGia option:selected").text();
					var namHoc = _input_MaHocKy.substring(_input_MaHocKy.indexOf(" - ") + 3);
					var splittedNamHoc = namHoc.split('-');

					return `${splittedNamHoc[1]}-12-31`;
				}
			),
        ],
        onSubmit: ChinhSua_HoatDong
    })

	function containSpecialChars(str) {
		var regex = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;

		return regex.test(str);
	}

	function xuLyTimKiemMaHD() {
		var _inputTimKiem_MaHoatDong = $('#inputTimKiem_MaHoatDong').val().trim();

		if (_inputTimKiem_MaHoatDong != '') {
			if(containSpecialChars(_inputTimKiem_MaHoatDong)){
				Swal.fire({
					icon: "error",
					title: "Lỗi",
					text: "Mã hoạt động không hợp lệ!",
					timer: 2000,
					timerProgressBar: true,
				});
			} else {
				TimKiemHoatDong(_inputTimKiem_MaHoatDong);
			}
		}
	}

	function convertToDateTimeFormat(date) {
		const offsetMs = date.getTimezoneOffset() * 60 * 1000;
		const dateLocal = new Date(date.getTime() - offsetMs);

		return dateLocal.toISOString().slice(0, 19).replace(/-/g, "-").replace("T", " ");
  	}

	//hàm trong function.js
	GetListHoatdongdanhgia();

	LoadThongTinThemMoi();

	$('#btn_timKiemMaHD').on('click', function() {
		xuLyTimKiemMaHD();
	});

	$('#inputTimKiem_MaHoatDong').keypress(function (e) {
		var key = e.which;
		if(key == 13)  // the 'Enter' code
		{
			$('#btn_timKiemMaHD').click();
		}
	}); 

	$(document).on("click", ".btn_BatDauDiemDanh" ,function() {
		var maHoatDong = $(this).attr('data-id');

		DiemDanhHoatDong(maHoatDong);
	})

	$(document).on("click", ".btn_DanhSachThamGia" ,function() {
		var maHoatDong = $(this).attr('data-id');
		var tenHoatDong = $(this).attr('data-name-id');

		$('#DSSV_text_MaHoatDong').text(maHoatDong);
		$('#DSSV_text_TenHoatDong').text(tenHoatDong);

		LoadDanhSachThamGia(maHoatDong);
	})


	$(document).on("click", ".btn_ChinhSua_HoatDong" ,function() {
		var maHoatDong = $(this).attr('data-id');
	
		$('#edit_input_MaHoatDong').val(maHoatDong);

		LoadThongTinChinhSua_HoatDong(maHoatDong);

		$("#EditForm #edit_input_MaHoatDong").removeClass("is-invalid");
		$("#EditForm #edit_input_TenHoatDong").removeClass("is-invalid");
		$("#EditForm #edit_input_DiemNhanDuoc").removeClass("is-invalid");
		$("#EditForm #edit_input_DiaDiemHoatDong").removeClass("is-invalid");
		$("#EditForm #edit_input_ThoiGianBatDau").removeClass("is-invalid");
		$("#EditForm #edit_input_ThoiGianKetThuc").removeClass("is-invalid");
	})

	// Xử lý lọc hoạt động theo khoảng thời gian
	$(document).on("click", "#btnDateFilter" ,function() {
		$('#inputTimKiem_MaHoatDong').val('');

		var inputFrom = $('#fromDateFilter').val();
		var inputTo = $('#toDateFilter').val();

		const fromDate = new Date(inputFrom);
		const toDate = new Date(inputTo);

		if(fromDate.getTime() < toDate.getTime()) {
			const from = convertToDateTimeFormat(fromDate);
			const to = convertToDateTimeFormat(toDate);

			LocHoatDong(from, to);
		} else {
			Swal.fire({
				icon: "error",
				title: "Lỗi",
				text: 'Khoảng thời gian không hợp lệ!',
				timer: 2000,
				timerProgressBar: true,
				showCloseButton: true,
			});
		}
	})

	//Get Goong maps API
	$('#input_DiaDiemHoatDong').on('keyup', function(){
    	var valueInput = $('#input_DiaDiemHoatDong').val();

    	GetPlaces(valueInput);
    })


    function GetPlaces(valueInput) {
		$.ajax({
			url: "https://rsapi.goong.io/Place/AutoComplete?api_key=dnYBxO8AsdreIU1gMpHztjTI8U3qMwzYfIgdu6lh&location=21.013715429594125,%20105.79829597455202&input="+ valueInput,
			async: false,
			type: "GET",
			contentType: "application/json;charset=utf-8",
			dataType: "json",
			success: function (result_SV) {
				var availableTags = [];

				for (var i = 0; i < result_SV['predictions'].length;i++){
					//console.log(result_SV['predictions'][i].description);
					availableTags.push(result_SV['predictions'][i].description);
				}
			
				$("#input_DiaDiemHoatDong").autocomplete({
					delay: 1000,
					source: availableTags
				});
			},
			error: function (errorMessage) {
			
			},
		});
    }


	var select_box_element_HocKyDanhGia = document.querySelector('#select_HocKyDanhGia');

	dselect(select_box_element_HocKyDanhGia,{
		search: true
	});

	var select_box_element_Khoa = document.querySelector('#select_Khoa');

	dselect(select_box_element_Khoa,{
		search: true
	});

	var select_box_element_TieuChi = document.querySelector('#select_TieuChi');

	dselect(select_box_element_TieuChi,{
		search: true
	});

</script>