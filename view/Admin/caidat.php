<script src="assets/js/check_token.js"></script>
<script>
	//remove class active
	$("#menu-button-QuanTriVien").removeClass("active");
	$("#menu-button-ThongKe").removeClass("active");
	$("#menu-button-SinhVien").removeClass("active");
	$("#menu-button-Lop").removeClass("active");
	$("#menu-button-HoatDongDanhGia").removeClass("active");
	$("#menu-button-Khoa").removeClass("active");
	$("#menu-button-PhieuRenLuyen").removeClass("active");
	$("#menu-button-CoVanHocTap").removeClass("active");
	$("#menu-button-TieuChiDanhGia").removeClass("active");
	$("#menu-button-ThongBaoDanhGia").removeClass("active");
	$("#menu-button-KhieuNai").removeClass("active");
	$("#menu-button-ThongKe").removeClass("active");

	//add class active
	$("#menu-button-CaiDat").addClass("active");

	//set title
	document.title = "Cài đặt | Web điểm rèn luyện";
</script>

<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">

		<h1 class="app-page-title">.</h1>
		<h1 class="app-page-title"><img src="assets/images/icons/settings.png" alt="" width="30px"> Cài đặt</h1>

		<div class="row g-4 mb-4">

			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						<!--//col-->
						<!-- <div class="col-auto" style="padding-left: 15px;">
								<button class="btn app-btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm mới</button>
							</div> -->

					</div>
					<!--//row-->
				</div>
				<!--//table-utilities-->
			</div>
			<!--//col-auto-->

			<!-- Modal tùy chỉnh -->
			<div class="modal fade" id="CustomFunctionalityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form action="" class="modal-dialog" id="CustomFunctionalityForm">
					<div class="modal-content">
						<div class="modal-header">
							<img src="assets/images/icons/edit.png" width="25px" style="padding-right: 5px;">
							<h5 class="modal-title" id="exampleModalLabel"> Tùy chỉnh chức năng</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="custom_input_MaChucNang" class="form-label" style="color: black; font-weight: 500;">Mã chức năng</label>
								<input type="text" name="maChucNang" class="form-control mb-2" id="custom_input_MaChucNang" readonly>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="custom_input_TenChucNang" class="form-label" style="color: black; font-weight: 500;">Tên chức năng</label>
								<input type="text" name="tenChucNang" class="form-control mb-2" id="custom_input_TenChucNang" readonly>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="custom_select_HocKyDanhGia" class="form-label" style="color: black; font-weight: 500;">Học kỳ - Năm học áp dụng</label>
								<select class="mw-100" name="maHocKyDanhGia[]" id="custom_select_HocKyDanhGia" style="color: #5d6778; font-size: 1rem;" 
									multiple data-search="true" data-silent-initial-value-set="true" placeholder="Chọn học kỳ - năm học">

								</select>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="custom_select_Quyen" class="form-label" style="color: black; font-weight: 500;">Quyền áp dụng</label>
								<select class="mw-100" name="maQuyen[]" id="custom_select_Quyen" style="color: #5d6778; font-size: 1rem;" 
									multiple data-search="true" data-silent-initial-value-set="true" placeholder="Chọn quyền">

								</select>
								<span class="invalid-feedback"></span>
							</div>

							<label class="me-3" style="color: black; font-weight: 500;">Trạng thái: </label>
							<div class="mb-3 form-check form-switch d-inline-block">
								<label class="form-check-label" for="custom_check_active">Kích hoạt</label>
								<input class="form-check-input" type="checkbox" name="kichHoat" id="custom_check_active">
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-primary" style='color: white;'>Lưu</button>
						</div>
					</div>	
				</form>
			</div>

			<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
				<div class="app-card app-card-orders-table shadow-sm mb-5">
					<h1 class="app-page-title mb-4">Chức năng</h1>

					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table app-table-hover mb-0 text-left" id="functionality_table">
								<thead>
									<tr>

									</tr>
								</thead>
								<tbody id="id_tbodyChucNang">

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
<script src="assets/js/caidat/function.js"></script>


<!-- Form Validator -->
<script src="./assets/js/validator.js"></script>

<script>
	
	Validator({
        form: '#CustomFunctionalityForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
          Validator.isRequired('#custom_input_MaChucNang', 'Vui lòng nhập mã chức năng'),
          Validator.isNumber('#custom_input_MaChucNang', 'Mã lớp chỉ bao gồm ký tự số'),
          Validator.isRequired('#custom_select_HocKyDanhGia', 'Vui lòng chọn học kỳ - năm học áp dụng'),
          Validator.isRequired('#custom_select_Quyen', 'Vui lòng chọn quyền áp dụng'),
        ],
        onSubmit: TuyChinh_ChucNang
    })

	tableTitle.forEach(function(title, index) {
		$("#functionality_table>thead>tr").append(`<th class='cell'>${title}</th>`);

		if(index == tableTitle.length - 1) {
			$("#functionality_table>thead>tr").append(`<th class='cell'>Hành động</th>`);
		}
	});

	LoadComboBoxThongTinHocKyDanhGia_CaiDat();

	LoadComboBoxThongTinQuyen_CaiDat();

	GetListChucNang();

	VirtualSelect.init({
		ele: '#custom_select_HocKyDanhGia'
	});

	VirtualSelect.init({
		ele: '#custom_select_Quyen'
	});

	$('#custom_check_active').change(function () {
		if ($('#' + this.id).is(":checked")) {
			$("label[for='" + this.id + "']").text("Kích hoạt").css("color", "green");
		} else {
			$("label[for='" + this.id + "']").text("Vô hiệu hóa").css("color", "#393939");
		}		
	});

	//Xử lý tùy chỉnh
	$(document).on("click", ".btn_Custom_ChucNang", function() {

		let maChucNang_custom = $(this).attr('data-id');

		$('#custom_input_MaChucNang').val(maChucNang_custom);

		LoadThongTinTuyChinh_ChucNang(maChucNang_custom);

		$("#custom_check_active").trigger("change");

		$("#CustomFunctionalityForm #custom_input_MaChucNang").removeClass("is-invalid");
		$("#CustomFunctionalityForm #custom_select_HocKyDanhGia").removeClass("is-invalid");
		$("#CustomFunctionalityForm #custom_select_Quyen").removeClass("is-invalid");
	})

</script>