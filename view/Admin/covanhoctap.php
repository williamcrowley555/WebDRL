<script src="assets/js/check_token.js"></script>
<script>
	//remove class active
	$("#menu-button-ThongKe").removeClass("active");
	$("#menu-button-SinhVien").removeClass("active");
	$("#menu-button-Lop").removeClass("active");
	$("#menu-button-Khoa").removeClass("active");
	$("#menu-button-PhieuRenLuyen").removeClass("active");
	$("#menu-button-HoatDongDanhGia").removeClass("active");
	$("#menu-button-TieuChiDanhGia").removeClass("active");
	$("#menu-button-ThongBaoDanhGia").removeClass("active");


	//add class active
	$("#menu-button-CoVanHocTap").addClass("active");

	//add title header
	document.title = "Cố vấn học tập | Web điểm rèn luyện";
</script>
<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">

		<h1 class="app-page-title">.</h1>
		<h1 class="app-page-title"><img src="assets/images/icons/presentation.png" alt="" width="30px"> <span id="title-main-page">Cố vấn học tập</span> </h1>

		<div class="row g-4 mb-4">

			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						<div class="col-auto">

							<select class="form-select w-auto" id="select_Khoa">

							</select>
						</div>


						<div class="col-auto">
							<div class="table-search-form row gx-1 align-items-center">
								<div class="col-auto">
									<input type="text" id="input_timKiemMaCVHT" name="searchorders" class="form-control search-orders" placeholder="Nhập mã cố vấn học tập...">
								</div>
								<div class="col-auto">
									<button type="button" id="btn_timKiemMaCVHT" class="btn app-btn-secondary">Tìm kiếm</button>
								</div>
							</div>

						</div>
						<!--//col-->
						<div class="col-auto" style="padding-left: 15px;">
							<button class="btn app-btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#AddModal">Thêm mới</button>
						</div>

					</div>
					<!--//row-->
				</div>
				<!--//table-utilities-->
			</div>
			<!--//col-auto-->

			<!-- Modal thêm -->
			<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form class="modal-dialog" id="AddForm">
					<div class="modal-content">
						<div class="modal-header">
							<img src="assets/images/icons/add.png" width="25px" style="padding-right: 5px;">
							<h5 class="modal-title" id="exampleModalLabel"> Thêm cố vấn học tập</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Mã cố vấn học tập</label>
								<input type="text" class="form-control" name="maCoVanHocTap" id="inputMaCoVanHocTap" placeholder="Nhập mã cố vấn học tập...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Họ tên cố vấn học tập</label>
								<input type="text" class="form-control" name="hoTenCoVan" id="inputTenCoVanHocTap" placeholder="Nhập họ tên cố vấn học tập...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Số điện thoại</label>
								<input type="text" class="form-control" name="soDienThoai" id="inputSoDienThoai" placeholder="Nhập số điện thoại...">
								<span class="invalid-feedback"></span>
							</div>

							<hr>
							<span style="text-transform: uppercase;color: black;"><img src="assets/images/icons/lock.png" alt="" style="width: 20px;"> Thông tin mật khẩu</span>
							<hr>

							<div class="mb-3 form-group">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Mật khẩu</label>
								<input type="password" class="form-control" name="matKhauTaiKhoanCoVan" id="inputMatKhauMoi" placeholder="Nhập mật khẩu...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Nhập lại mật khẩu</label>
								<input type="password" class="form-control" name="nhapLaiMatKhauTaiKhoanCoVan" id="inputNhapLaiMatKhau" placeholder="Nhập lại mật khẩu...">
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
				<form class="modal-dialog" id="EditForm">
					<div class="modal-content">
						<div class="modal-header">
							<img src="assets/images/icons/edit.png" width="25px" style="padding-right: 5px;">
							<h5 class="modal-title" id="exampleModalLabel"> Chỉnh sửa Cố vấn học tập</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="edit_input_MaCVHT" class="form-label" style="color: black; font-weight: 500;">Mã cố vấn học tập</label>
								<input type="text" class="form-control mb-2" name="maCoVanHocTap" id="edit_input_MaCVHT" placeholder="Nhập mã cố vấn học tập..." readonly>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_input_TenCVHT" class="form-label" style="color: black; font-weight: 500;">Họ tên cố vấn học tập</label>
								<input type="text" class="form-control" name="hoTenCoVan" id="edit_input_TenCVHT" placeholder="Nhập họ tên cố vấn học tập...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_input_sdt" class="form-label" style="color: black; font-weight: 500;">Số điện thoại</label>
								<input type="text" class="form-control" name="soDienThoai" id="edit_input_sdt" placeholder="Nhập số điện thoại...">
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


			<!-- Modal reset password -->
			<div class="modal fade" id="DatLaiMatKhauModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form class="modal-dialog" id="ChangePasswordForm">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"> Đặt lại mật khẩu</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="input_CoVanHocTap_Update" class="form-label" style="color: black; font-weight: 500;">Mã cố vấn học tập</label>
								<input type="text" class="form-control mb-2" name="maCoVanHocTap" id="input_CoVanHocTap_Update" placeholder="Nhập mã cố vấn học tập..." disabled>
								<span class="invalid-feedback"></span>
							</div>


							<div class="mb-3 form-group">
								<label for="input_MatKhauMoi" class="form-label" style="color: black; font-weight: 500;">Mật khẩu mới</label>
								<input type="password" class="form-control" name="matKhauTaiKhoanCoVan" id="input_MatKhauMoi" placeholder="Nhập mật khẩu mới...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="input_NhapLaiMatKhauMoi" class="form-label" style="color: black; font-weight: 500;">Nhập lại Mật khẩu mới</label>
								<input type="password" class="form-control" name="nhapLaiMatKhauTaiKhoanCoVan" id="input_NhapLaiMatKhauMoi" placeholder="Nhập lại mật khẩu mới...">
								<span class="invalid-feedback"></span>
							</div>


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-info" style='color: white;'>Đặt lại mật khẩu</button>
						</div>
					</div>
				</form>
			</div>



			<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
				<div class="app-card app-card-orders-table shadow-sm mb-5">
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table app-table-hover mb-0 text-left">
								<thead>
									<tr>
										<th class="cell">STT</th>
										<th class="cell">Mã cố vấn học tập</th>
										<th class="cell">Họ tên cố vấn</th>
										<th class="cell">Số điện thoại</th>
										<th class="cell"></th>
									</tr>
								</thead>
								<tbody id="id_tbodyData">

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
<script src="assets/js/covanhoctap/function.js"></script>

<script>

	Validator({
        form: '#AddForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isRequired('#inputMaCoVanHocTap', 'Vui lòng nhập mã cố vấn học tập'),
			Validator.isNumber('#inputMaCoVanHocTap', 'Mã cố vấn học tập chỉ bao gồm các ký tự số'),
			Validator.minLength('#inputMaCoVanHocTap', 5, "Mã cố vấn học tập phải có tối thiểu 5 chữ số"),
			Validator.isRequired('#inputTenCoVanHocTap', 'Vui lòng nhập họ tên cố vấn học tập'),
			Validator.isCharacters('#inputTenCoVanHocTap', 'Họ tên cố vấn học tập chỉ bao gồm các ký tự chữ'),
			Validator.isRequired('#inputSoDienThoai', 'Vui lòng nhập số điện thoại'),
			Validator.isPhoneNumber('#inputSoDienThoai'),
			Validator.minLength('#inputMatKhauMoi', 5, "Mật khẩu phải có tối thiểu 5 ký tự"),
			Validator.isRequired('#inputNhapLaiMatKhau'),
			Validator.isConfirmed('#inputNhapLaiMatKhau', function() {
				return document.querySelector('#AddForm #inputMatKhauMoi').value;
			}, 'Mật khẩu nhập lại không chính xác'),
        ],
        onSubmit: ThemCVHT
    })
	  
	Validator({
        form: '#EditForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isRequired('#edit_input_MaCVHT', 'Vui lòng nhập mã cố vấn học tập'),
			Validator.isNumber('#edit_input_MaCVHT', 'Mã cố vấn học tập chỉ bao gồm các ký tự số'),
			Validator.minLength('#edit_input_MaCVHT', 5, "Mã cố vấn học tập phải có tối thiểu 5 chữ số"),
			Validator.isRequired('#edit_input_TenCVHT', 'Vui lòng nhập họ tên cố vấn học tập'),
			Validator.isCharacters('#edit_input_TenCVHT', 'Họ tên cố vấn học tập chỉ bao gồm các ký tự chữ'),
			Validator.isRequired('#edit_input_sdt', 'Vui lòng nhập số điện thoại'),
			Validator.isPhoneNumber('#edit_input_sdt'),
        ],
        onSubmit: ChinhSua_CVHT
    })
	  
	Validator({
		form: '#ChangePasswordForm',
		formGroupSelector: '.form-group',
		errorSelector: '.invalid-feedback',
		rules: [
			Validator.minLength('#input_MatKhauMoi', 5, "Mật khẩu phải có tối thiểu 5 ký tự"),
			Validator.isRequired('#input_NhapLaiMatKhauMoi'),
			Validator.isConfirmed('#input_NhapLaiMatKhauMoi', function() {
				return document.querySelector('#ChangePasswordForm #input_MatKhauMoi').value;
			}, 'Mật khẩu nhập lại không chính xác'),
		],
		onSubmit: DatLaiMatKhau_CVHT
	})

	var maKhoa_selected = 'tatcakhoa';

	function xuLyTimKiemMaCVHT() {
		var _input_timKiemMaCVHT = $('#input_timKiemMaCVHT').val().trim();

		if (_input_timKiemMaCVHT != '') {
			if(Number(_input_timKiemMaCVHT)){
				TimKiemCoVanHocTap(_input_timKiemMaCVHT);
			} else {
				Swal.fire({
					icon: "error",
					title: "Lỗi",
					text: "Mã cố vấn học tập không hợp lệ!",
					timer: 2000,
					timerProgressBar: true,
				});
			}
		}
	}

	//hàm trong function.js
	GetListCVHT(maKhoa_selected);

	LoadComboBoxThongTinKhoa_CVHT();

	$('#select_Khoa').on('change', function() {
		$('#input_timKiemMaCVHT').val('');

		var maKhoa_selected = $('#select_Khoa').val();

		GetListCVHT(maKhoa_selected);
	});

	$('#btn_timKiemMaCVHT').on('click', function() {
		xuLyTimKiemMaCVHT();
	});

	$('#input_timKiemMaCVHT').keypress(function (e) {
		var key = e.which;
		if(key == 13)  // the 'Enter' code
		{
			$('#btn_timKiemMaCVHT').click();
		}
	}); 

	//Dat lai mat khau
	$(document).on("click", ".btn_DatLaiMatKhau_CVHT", function() {
		var maCVHT = $(this).attr('data-id');

		$('#input_CoVanHocTap_Update').val(maCVHT);
		$("#ChangePasswordForm #input_MatKhauMoi").val("");
      	$("#ChangePasswordForm #input_MatKhauMoi").removeClass("is-invalid");
		$("#ChangePasswordForm #input_NhapLaiMatKhauMoi").val("");
      	$("#ChangePasswordForm #input_NhapLaiMatKhauMoi").removeClass("is-invalid");
	})

	//Xử lý chỉnh sửa
	$(document).on("click", ".btn_ChinhSua_CVHT", function() {

		var maCVHT_edit = $(this).attr('data-id');

		$('#edit_input_MaCVHT').val(maCVHT_edit);

		LoadThongTinChinhSua_CVHT(maCVHT_edit);
	})
</script>