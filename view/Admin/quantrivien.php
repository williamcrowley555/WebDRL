<script src="assets/js/check_token.js"></script>

<script>
	//remove class active
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
	$("#menu-button-QuanTriVien").addClass("active");

	//set title
	document.title = "Quản trị viên | Web điểm rèn luyện";
</script>

<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">

		<h1 class="app-page-title">.</h1>
		<h1 class="app-page-title"><img src="assets/images/icons/admin.png" alt="" width="30px"> Quản trị viên</h1>

		<div class="row g-4 mb-4">

			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						<div class="col-auto">
							<select class="form-select w-auto" id="select_Role">

							</select>
						</div>

						<div class="col-auto">
							<div class="table-search-form row gx-1 align-items-center">
								<div class="col-auto">
									<input type="text" id="input_timKiemTaiKhoan" name="searchorders" class="form-control search-orders" placeholder="Nhập tài khoản">
								</div>
								<div class="col-auto">
									<button type="button" id="btn_timKiemTaiKhoan" class="btn app-btn-secondary">Tìm kiếm</button>
								</div>
								<div class="col-auto" style="padding-left: 15px;">
									<button class="btn app-btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#AddModal">Thêm mới</button>
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

			<div class="tab-pane fade show active" id="tabQuanTriVien" role="tabpanel" aria-labelledby="orders-all-tab">
				<div class="app-card app-card-orders-table shadow-sm mb-5">
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table app-table-hover mb-0 text-left" id="tableQuanTriVien">
								<thead>
									<tr>

									</tr>
								</thead>
								<tbody id="tbodyQuanTriVien">

								</tbody>
							</table>
						</div>
						<!--//table-responsive-->

					</div>
					<!--//app-card-body-->
				</div>
				<!--//app-card-->
				<nav class="app-pagination" id="idPhanTrangQuanTriVien">
					<!-- <ul class="pagination justify-content-center" id="idPhanTrang">
							
						</ul> -->
				</nav>
				<!--//app-pagination-->

			</div>
			<!--//tab-pane-->

			<!-- Modal thêm -->
			<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form action="" class="modal-dialog" id="AddForm">
					<div class="modal-content">
						<div class="modal-header">
							<img src="assets/images/icons/add.png" width="25px" style="padding-right: 5px;">
							<h5 class="modal-title" id="exampleModalLabel"> Thêm quản trị viên </h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="input_quantrivien_taikhoan" class="form-label" style="color: black; font-weight: 500;">Tài khoản</label>
								<input type="text" name="taiKhoan" class="form-control mb-2" id="input_quantrivien_taikhoan" placeholder="Nhập tên tài khoản...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="input_quantrivien_hotennguoidung" class="form-label" style="color: black; font-weight: 500;">Họ tên người dùng</label>
								<input type="text" name="hoTenNguoiDung" class="form-control" id="input_quantrivien_hotennguoidung" placeholder="Nhập họ tên người dùng...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="input_quantrivien_email" class="form-label" style="color: black; font-weight: 500;">Email</label>
								<input type="email" name="email" class="form-control" id="input_quantrivien_email" placeholder="Nhập email...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="input_quantrivien_sdt" class="form-label" style="color: black; font-weight: 500;">Số điện thoại</label>
								<input type="tel" name="sdt" class="form-control" id="input_quantrivien_sdt" placeholder="Nhập số điện thoại...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="select_quyen_add" class="form-label" style="color: black; font-weight: 500;">Quyền</label>
								<select class="form-select" name="quyen" aria-label="Default select example" id="select_quyen_add">
									<option value="admin"> Admin </option>
									<option value="ctsv"> Công tác sinh viên </option>
								</select>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label class="form-label" style="color: black; font-weight: 500;">Kích hoạt tài khoản</label>
								<select class="form-select select_kichhoat_add" name="kichHoat" aria-label="Default select example" id="select_kichhoat_add">
									<option value="1">Kích hoạt</option>
									<option value="0">Vô hiệu hóa</option>
								</select>
								<span class="invalid-feedback"></span>
							</div>

							<hr>
							<div class="mb-3">
								<span style="color: black; font-weight: bold; text-transform: uppercase;font-size: 15px;">Mật khẩu đăng nhập mặc định là tên tài khoản!</span>
							</div>


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-primary" style='color: white;'>Thêm mới</button>
						</div>
					</div>
				</form>
			</div>

			<!-- Modal reset password -->
			<div class="modal fade" id="DatLaiMatKhauModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form action="" class="modal-dialog" id="ChangePasswordForm">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"> Đặt lại mật khẩu</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="input_MaTaiKhoan_Update" class="form-label" style="color: black; font-weight: 500;">Tên tài khoản</label>
								<input type="text" class="form-control mb-2" id="input_MaTaiKhoan_Update" placeholder="Nhập tên tài khoản..." disabled>
							</div>

							<div class="mb-3 form-group">
								<label for="input_Quyen_Update" class="form-label" style="color: black; font-weight: 500;">Quyền</label>
								<input type="text" class="form-control mb-2" id="input_Quyen_Update" placeholder="Nhập quyền..." disabled>
							</div>


							<div class="mb-3 form-group">
								<label for="input_MatKhauMoi" class="form-label" style="color: black; font-weight: 500;">Mật khẩu mới</label>
								<input type="password" name="input_MatKhauMoi" class="form-control" id="input_MatKhauMoi" placeholder="Nhập mật khẩu mới...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="input_NhapLaiMatKhauMoi" class="form-label" style="color: black; font-weight: 500;">Nhập lại mật khẩu mới</label>
								<input type="password" name="input_NhapLaiMatKhauMoi" class="form-control" id="input_NhapLaiMatKhauMoi" placeholder="Nhập lại mật khẩu mới...">
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

			<!-- Modal chỉnh sửa -->
			<div class="modal fade" id="ChinhSuaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form action="" class="modal-dialog" id="EditForm">
					<div class="modal-content">
						<div class="modal-header">
							<img src="assets/images/icons/edit.png" width="25px" style="padding-right: 5px;">
							<h5 class="modal-title" id="exampleModalLabel"> Chỉnh sửa quản trị viên </h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="edit_input_taikhoan" class="form-label" style="color: black; font-weight: 500;">Tên tài khoản</label>
								<input type="text" name="taiKhoan" class="form-control mb-2" id="edit_input_taikhoan" placeholder="Nhập tên tài khoản..." readonly>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_input_hotennguoidung" class="form-label" style="color: black; font-weight: 500;">Họ tên người dùng</label>
								<input type="text" name="hoTenNguoiDung" class="form-control" id="edit_input_hotennguoidung" placeholder="Nhập tên sinh viên...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_input_email" class="form-label" style="color: black; font-weight: 500;">Email:</label>
								<input type="email" name="email" class="form-control mb-2" id="edit_input_email" name="email">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_input_sdt" class="form-label" style="color: black; font-weight: 500;">Số điện thoại:</label>
								<input type="tel" name="sdt" class="form-control mb-2" id="edit_input_sdt">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_select_quyen" class="form-label" style="color: black; font-weight: 500;">Quyền</label>
								<select class="form-select" name="quyen" aria-label="Default select example" id="edit_select_quyen">
									<option value="admin"> Admin </option>
									<option value="ctsv"> Công tác sinh viên </option>
								</select>
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

			<nav class="app-pagination" id="idPhanTrang">
				<!-- <ul class="pagination justify-content-center" id="idPhanTrang">
						
					</ul> -->
			</nav>

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
<script src="assets/js/quantrivien/function.js"></script>

<!-- Form Validator -->
<script src="./assets/js/validator.js"></script>

<script>
	Validator({
        form: '#AddForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isRequired('#input_quantrivien_taikhoan', 'Vui lòng nhập tên tài khoản'),
			Validator.isRequired('#input_quantrivien_hotennguoidung', 'Vui lòng nhập họ tên người dùng'),
			Validator.isRequired('#input_quantrivien_email', "Vui lòng nhập email"),
			Validator.isEmail('#input_quantrivien_email', "Email không hợp lệ"),
			Validator.isRequired('#input_quantrivien_sdt', "Vui lòng nhập số điện thoại"),
			Validator.isPhoneNumber('#input_quantrivien_sdt'),
        ],
        onSubmit: themMoiQuanTriVien
    })

	Validator({
        form: '#EditForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isRequired('#edit_input_hotennguoidung', 'Vui lòng nhập họ tên người dùng'),
			Validator.isRequired('#edit_input_email', "Vui lòng nhập email"),
			Validator.isEmail('#edit_input_email', "Email không hợp lệ"),
			Validator.isRequired('#edit_input_sdt', "Vui lòng nhập số điện thoại"),
			Validator.isPhoneNumber('#edit_input_sdt'),
        ],
        onSubmit: chinhSuaQuanTriVien
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
		onSubmit: datLaiMatKhauQuanTriVien
	})

	loadComboBoxSelectRole();

	tableQuanTriVienTitle.forEach(function(title, index) {
		$("#tableQuanTriVien>thead>tr").append(`<th class='cell'>${title}</th>`);

		if(index == tableQuanTriVienTitle.length - 1) {
			$("#tableQuanTriVien>thead>tr").append(`<th class='cell'>Hành động</th>`);
		}
	});
	
	getListQuanTriVien("tatcaquyen");

	$('#select_Role').on('change', function() {
		$('#input_timKiemTaiKhoan').val('');
		var maQuyen_selected = $('#select_Role').val();
		//LoadComboBoxThongTinLopTheoKhoa(maKhoa_selected, "#select_Lop");
		//var maLop_selected = $('#select_Lop').val();
		getListQuanTriVien(maQuyen_selected);
	});

	$('#btn_timKiemTaiKhoan').on('click', function() {
		timKiemQuanTriVien($('#input_timKiemTaiKhoan').val(),$('#select_Role').val());
	});

	$('#input_timKiemTaiKhoan').keypress(function (e) {
		var key = e.which;
		if(key == 13)  // the 'Enter' code
		{
			$('#btn_timKiemTaiKhoan').click();
		}
	});

	$(document).on("click", ".btn_DatLaiMatKhau_QuanTriVien", function() {
		let taiKhoan = $(this).attr('data-id');
		let quyen = $(this).attr('data-quyen');
		$('#input_MaTaiKhoan_Update').val(taiKhoan);
		if(quyen == "admin") {
			$("#input_Quyen_Update").val("Admin");
		} else {
			$("#input_Quyen_Update").val("Công tác sinh viên");
		}
		$("#ChangePasswordForm #input_MatKhauMoi").val("");
		$("#ChangePasswordForm #input_MatKhauMoi").removeClass("is-invalid");
		$("#ChangePasswordForm #input_NhapLaiMatKhauMoi").val("");
		$("#ChangePasswordForm #input_NhapLaiMatKhauMoi").removeClass("is-invalid");
	}); 

	$(document).on("click", ".btn_ChinhSua_QuanTriVien", function() {

		let taikhoan_edit = $(this).attr('data-id');
		let quyen_edit = $(this).attr('data-quyen');

		loadThongTinChinhSuaQuanTriVien(taikhoan_edit, quyen_edit);

		$("#EditForm #edit_input_hotennguoidung").removeClass("is-invalid");
	});

	// Xử lý kích hoạt quản trị viên
	$(document).on("click", ".btn_KichHoat_QuanTriVien" ,function() {
		var taiKhoan = $(this).attr('data-id');
		var quyen = $(this).attr('data-quyen');

		kichHoatQuanTriVien(taiKhoan, quyen);
	})
		
	// Xử lý vô hiệu hóa quản trị viên
	$(document).on("click", ".btn_VoHieuHoa_QuanTriVien" ,function() {
		var taiKhoan = $(this).attr('data-id');
		var quyen = $(this).attr('data-quyen');

		voHieuHoaQuanTriVien(taiKhoan, quyen);
	})
</script>