<script src="assets/js/check_token.js"></script>
<script>
	//remove class active
	$("#menu-button-ThongKe").removeClass("active");
	$("#menu-button-SinhVien").removeClass("active");
	$("#menu-button-Lop").removeClass("active");
	$("#menu-button-HoatDongDanhGia").removeClass("active");
	$("#menu-button-PhieuRenLuyen").removeClass("active");
	$("#menu-button-CoVanHocTap").removeClass("active");
	$("#menu-button-TieuChiDanhGia").removeClass("active");
	$("#menu-button-ThongBaoDanhGia").removeClass("active");

	//add class active
	$("#menu-button-Khoa").addClass("active");

	//set title
	document.title = "Khoa | Web điểm rèn luyện";
</script>

<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">

		<h1 class="app-page-title">.</h1>
		<h1 class="app-page-title"><img src="assets/images/icons/class.png" alt="" width="30px"> Khoa</h1>

		<div class="row g-4 mb-4">

			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						<div class="col-auto">
							<div class="table-search-form row gx-1 align-items-center">
								<div class="col-auto">
									<input type="text" id="input_timKiemMaKhoa" name="searchorders" class="form-control search-orders" placeholder="Nhập mã khoa">
								</div>
								<div class="col-auto">
									<button type="button" id="btn_timKiemMaKhoa" class="btn app-btn-secondary">Tìm kiếm</button>
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
				<form action="" class="modal-dialog" id="AddForm">
					<div class="modal-content">
						<div class="modal-header">
							<img src="assets/images/icons/add.png" width="25px" style="padding-right: 5px;">
							<h5 class="modal-title" id="exampleModalLabel"> Thêm Khoa</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Mã khoa</label>
								<input type="text" class="form-control" name="maKhoa" id="add_input_MaKhoa" placeholder="Nhập mã khoa...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Tên khoa</label>
								<input type="text" class="form-control" name="tenKhoa" id="add_input_TenKhoa" placeholder="Nhập tên khoa...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Tài khoản khoa</label>
								<input type="text" class="form-control" name="taiKhoanKhoa" id="add_input_TaiKhoanKhoa" placeholder="Nhập tài khoản khoa...">
								<span class="invalid-feedback"></span>
							</div>

							<hr>
							<span style="text-transform: uppercase;color: black;"><img src="assets/images/icons/lock.png" alt="" style="width: 20px;"> Thông tin mật khẩu</span>
							<hr>

							<div class="mb-3 form-group">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Mật khẩu</label>
								<input type="password" class="form-control" name="matKhauKhoa" id="add_input_MatKhau" placeholder="Nhập mật khẩu...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Nhập lại mật khẩu</label>
								<input type="password" class="form-control" name="nhapLaiMatKhauKhoa" id="add_input_NhapLaiMatKhau" placeholder="Nhập lại mật khẩu...">
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
							<h5 class="modal-title" id="exampleModalLabel"> Chỉnh sửa Khoa</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="edit_input_MaKhoa" class="form-label" style="color: black; font-weight: 500;">Mã khoa</label>
								<input type="text" class="form-control mb-2" name="maKhoa" id="edit_input_MaKhoa" placeholder="Nhập mã lớp..." readonly>
								<span class="invalid-feedback"></span>
							</div>
							
							<div class="mb-3 form-group">
								<label for="edit_input_TenKhoa" class="form-label" style="color: black; font-weight: 500;">Tên khoa</label>
								<input type="text" class="form-control mb-2" name="tenKhoa" id="edit_input_TenKhoa" placeholder="Nhập tên khoa...">
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

			<!-- Modal đặt lại mật khẩu-->
			<div class="modal fade" id="DatLaiMatKhauModal" tabindex="-1" aria-labelledby="ModalDatLaiMatKhauLabel" aria-hidden="true">
				<form action="" class="modal-dialog" id="ChangePasswordForm">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Đặt lại mật khẩu</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="mb-3 form-group">
								<label for="input_MaKhoa" class="form-label" style="color: black; font-weight: 500;">Mã khoa</label>
								<input type="text" class="form-control" name="maKhoa" id="input_MaKhoa_DLMK" placeholder="Nhập mã khoa..." disabled>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="input_MatKhauMoi" class="form-label" style="color: black; font-weight: 500;">Mật khẩu mới</label>
								<input type="password" class="form-control" name="matKhauKhoa" id="input_MatKhauMoi" placeholder="Nhập mật khẩu mới...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="input_NhapLaiMatKhau" class="form-label" style="color: black; font-weight: 500;">Nhập lại mật khẩu mới</label>
								<input type="password" class="form-control" name="nhapLaiMatKhauKhoa" id="input_NhapLaiMatKhau" placeholder="Nhập lại mật khẩu mới...">
								<span class="invalid-feedback"></span>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-primary" style="color: white;">Xác nhận</button>
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
										<th class="cell">Mã khoa</th>
										<th class="cell">Tên khoa</th>
										<th class="cell">Tài khoản khoa</th>
										<th class="cell"></th>
									</tr>
								</thead>
								<tbody id="id_tbodyKhoa">

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
<script src="assets/js/khoa/function.js"></script>


<!-- Form Validator -->
<script src="./assets/js/validator.js"></script>


<script type="text/javascript">

	Validator({
        form: '#AddForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isRequired('#add_input_MaKhoa', 'Vui lòng nhập mã khoa'),
			Validator.isCharacters('#add_input_MaKhoa', 'Mã khoa chỉ bao gồm các ký tự chữ', false),
			Validator.exactLength('#add_input_MaKhoa', 3, "Mã khoa phải có đủ 3 ký tự"),
			Validator.isRequired('#add_input_TenKhoa', 'Vui lòng nhập tên khoa'),
			Validator.isRequired('#add_input_TaiKhoanKhoa', 'Vui lòng nhập tài khoản khoa'),
			Validator.minLength('#add_input_MatKhau', 4, "Mật khẩu phải có tối thiểu 4 ký tự"),
			Validator.isRequired('#add_input_NhapLaiMatKhau'),
			Validator.isConfirmed('#add_input_NhapLaiMatKhau', function() {
				return document.querySelector('#AddForm #add_input_MatKhau').value;
			}, 'Mật khẩu nhập lại không chính xác'),
        ],
        onSubmit: ThemMoi_Khoa
    })
	  
	Validator({
        form: '#EditForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isRequired('#edit_input_MaKhoa', 'Vui lòng nhập mã khoa'),
			Validator.isCharacters('#edit_input_MaKhoa', 'Mã khoa chỉ bao gồm các ký tự chữ', false),
			Validator.exactLength('#edit_input_MaKhoa', 3, "Mã khoa phải có đủ 3 ký tự"),
			Validator.isRequired('#edit_input_TenKhoa', 'Vui lòng nhập tên khoa'),
        ],
        onSubmit: ChinhSua_Khoa
    })
	  
	Validator({
		form: '#ChangePasswordForm',
		formGroupSelector: '.form-group',
		errorSelector: '.invalid-feedback',
		rules: [
			Validator.isRequired('#input_MaKhoa_DLMK', 'Vui lòng nhập mã khoa'),
			Validator.isCharacters('#input_MaKhoa_DLMK', 'Mã khoa chỉ bao gồm các ký tự chữ', false),
			Validator.exactLength('#input_MaKhoa_DLMK', 3, "Mã khoa phải có đủ 3 ký tự"),
			Validator.minLength('#input_MatKhauMoi', 4, "Mật khẩu phải có tối thiểu 4 ký tự"),
			Validator.isRequired('#input_NhapLaiMatKhau'),
			Validator.isConfirmed('#input_NhapLaiMatKhau', function() {
				return document.querySelector('#ChangePasswordForm #input_MatKhauMoi').value;
			}, 'Mật khẩu nhập lại không chính xác'),
		],
		onSubmit: DatLaiMatKhau_Khoa
	})

	function onlyLettersAndNumbers(str) {
		return /^[A-Za-z0-9]*$/.test(str);
	}

	function xuLyTimKiemMaKhoa() {
		var _input_timKiemMaKhoa = $('#input_timKiemMaKhoa').val().trim();

		if (_input_timKiemMaKhoa != '') {
			if(onlyLettersAndNumbers(_input_timKiemMaKhoa)){
				TimKiemKhoa(_input_timKiemMaKhoa);
			} else {
				Swal.fire({
					icon: "error",
					title: "Lỗi",
					text: "Mã khoa không hợp lệ!",
					timer: 2000,
					timerProgressBar: true,
				});
			}
		}
	}

	//hàm trong function.js
	GetListKhoa();

	$('#btn_timKiemMaKhoa').on('click', function() {
		xuLyTimKiemMaKhoa();
	});

	$('#input_timKiemMaKhoa').keypress(function (e) {
		var key = e.which;
		if(key == 13)  // the 'Enter' code
		{
			$('#btn_timKiemMaKhoa').click();
		}
	}); 

	$('#input_timKiemMaKhoa').change(function (e) {
		if(!$('#input_timKiemMaKhoa').val()) {
			GetListKhoa();
		} 
	}); 

	//Dat lai mat khau
	$(document).on("click", ".btn_DatLaiMatKhau_Khoa", function() {
		var maKhoa_DLMK = $(this).attr('data-id');

		$('#input_MaKhoa_DLMK').val(maKhoa_DLMK);
		$("#ChangePasswordForm #input_MatKhauMoi").val("");
      	$("#ChangePasswordForm #input_MatKhauMoi").removeClass("is-invalid");
		$("#ChangePasswordForm #input_NhapLaiMatKhau").val("");
      	$("#ChangePasswordForm #input_NhapLaiMatKhau").removeClass("is-invalid");
	})

	//Xử lý chỉnh sửa
	$(document).on("click", ".btn_ChinhSua_Khoa", function() {

		let maKhoa_edit = $(this).attr('data-id');
		let tenKhoa_edit = $(this).attr('data-tenKhoa');
		let taiKhoanKhoa = $(this).attr('data-taiKhoanKhoa');
		let matKhauKhoa = $(this).attr('data-matKhauKhoa');


		$('#edit_input_MaKhoa').val(maKhoa_edit);
		$('#edit_input_TenKhoa').val(tenKhoa_edit);

		$("#EditForm #edit_input_MaKhoa").removeClass("is-invalid");
      	$("#EditForm #edit_input_TenKhoa").removeClass("is-invalid");
	})
</script>