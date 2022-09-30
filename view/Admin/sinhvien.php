<script src="assets/js/check_token.js"></script>
<script>
	//remove class active
	$("#menu-button-ThongKe").removeClass("active");
	$("#menu-button-Lop").removeClass("active");
	$("#menu-button-HoatDongDanhGia").removeClass("active");
	$("#menu-button-Khoa").removeClass("active");
	$("#menu-button-PhieuRenLuyen").removeClass("active");
	$("#menu-button-CoVanHocTap").removeClass("active");
	$("#menu-button-TieuChiDanhGia").removeClass("active");
	$("#menu-button-ThongBaoDanhGia").removeClass("active");

	//add class active
	$("#menu-button-SinhVien").addClass("active");

	//set title
	document.title = "Sinh viên | Web điểm rèn luyện";
</script>

<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">

		<h1 class="app-page-title">.</h1>
		<h1 class="app-page-title"><img src="assets/images/icons/group.png" alt="" width="30px"> Sinh viên</h1>

		<div class="row g-4 mb-4">

			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						<div class="col-auto">

							<select class="form-select w-auto" id='select_Khoa'>

							</select>
						</div>

						<div class="col-auto">

							<select class="form-select w-auto" id='select_Lop'>

							</select>
						</div>

						<div class="col-auto">
							<div class="table-search-form row gx-1 align-items-center">
								<div class="col-auto">
									<input type="text" id="input_timKiemMaSinhVien" name="" class="form-control" placeholder="Nhập mã số sinh viên...">
								</div>
								<div class="col-auto">
									<button type="button" id="btn_timKiemMaSinhVien" class="btn app-btn-secondary">Tìm kiếm</button>
								</div>

								<div class="col-auto" style="padding-left: 15px;">
									<button class="btn app-btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#AddModal">Thêm mới</button>
								</div>

								<div class="col-auto" style="padding-left: 15px;">
									<button class="btn app-btn-primary" type="button" data-bs-toggle="" data-bs-target="#" disabled>Import danh sách</button>
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
							<h5 class="modal-title" id="exampleModalLabel"> Thêm sinh viên</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="input_MaSinhVien" class="form-label" style="color: black; font-weight: 500;">Mã sinh viên</label>
								<input type="text" name="maSinhVien" class="form-control mb-2" id="input_MaSinhVien" placeholder="Nhập mã sinh viên...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="input_HoTenSinhVien" class="form-label" style="color: black; font-weight: 500;">Họ tên sinh viên</label>
								<input type="text" name="hoTenSinhVien" class="form-control" id="input_HoTenSinhVien" placeholder="Nhập họ tên sinh viên...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="input_NgaySinh" class="form-label" style="color: black; font-weight: 500;">Ngày sinh</label>
								<input type="date" name="ngaySinh" class="form-control" id="input_NgaySinh" placeholder="Nhập ngày sinh...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="select_Lop_Add" class="form-label" style="color: black; font-weight: 500;">Lớp</label>
								<select class="form-select" name="maLop" aria-label="Default select example" id="select_Lop_Add"></select>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_select_He" class="form-label" style="color: black; font-weight: 500;">Hệ</label>
								<select class="form-select edit_select_He" name="he" aria-label="Default select example" id="select_He_Add">
									<option value="dai_hoc">Đại học</option>
									<option value="cao_dang">Cao đẳng</option>
								</select>
								<span class="invalid-feedback"></span>
							</div>

							<hr>
							<div class="mb-3">
								<span style="color: black; font-weight: bold; text-transform: uppercase;font-size: 15px;">Mật khẩu đăng nhập mặc định là Mã sinh viên!</span>
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
							<h5 class="modal-title" id="exampleModalLabel"> Chỉnh sửa sinh viên</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="edit_input_MaSinhVien" class="form-label" style="color: black; font-weight: 500;">Mã sinh viên</label>
								<input type="text" name="maSinhVien" class="form-control mb-2" id="edit_input_MaSinhVien" placeholder="Nhập mã sinh viên..." readonly>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_input_TenSinhVien" class="form-label" style="color: black; font-weight: 500;">Họ tên sinh viên</label>
								<input type="text" name="hoTenSinhVien" class="form-control" id="edit_input_TenSinhVien" placeholder="Nhập tên sinh viên...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_input_NgaySinh" class="form-label" style="color: black; font-weight: 500;">Ngày sinh:</label>
								<input type="date" name="ngaySinh" class="form-control mb-2" id="edit_input_NgaySinh" name="birthday">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_select_Lop" class="form-label" style="color: black; font-weight: 500;">Lớp</label>
								<select class="form-select" name="maLop" aria-label="Default select example" id="edit_select_Lop"></select>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_select_He" class="form-label" style="color: black; font-weight: 500;">Hệ</label>
								<select class="form-select edit_select_He" name="he" aria-label="Default select example" id="edit_select_He">
									<option value="dai_hoc">Đại học</option>
									<option value="cao_dang">Cao đẳng</option>
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

			<!-- Modal reset password -->
			<div class="modal fade" id="DatLaiMatKhauModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form action="" class="modal-dialog" id="ChangePasswordForm">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"> Đặt lại mật khẩu</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3">
								<label for="input_MaSinhVien_Update" class="form-label" style="color: black; font-weight: 500;">Mã sinh viên</label>
								<input type="text" class="form-control mb-2" id="input_MaSinhVien_Update" placeholder="Nhập mã sinh viên..." disabled>
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

			<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
				<div class="app-card app-card-orders-table shadow-sm mb-5">
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table app-table-hover mb-0 text-left" id="my_table">
								<thead>
									<tr>
										<th class="cell">STT</th>
										<th class="cell">Mã số sinh viên</th>
										<th class="cell">Họ tên sinh viên</th>
										<th class="cell">Ngày sinh</th>
										<th class="cell">Hệ</th>
										<th class="cell">Lớp</th>
										<th class="cell"></th>
									</tr>
								</thead>
								<tbody id="id_tbodySinhVien">

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
<script src="assets/js/sinhvien/function.js"></script>


<!-- Form Validator -->
<script src="./assets/js/validator.js"></script>


<script>
	Validator({
        form: '#AddForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
          Validator.isRequired('#input_MaSinhVien', 'Vui lòng nhập mã số sinh viên'),
          Validator.isNumber('#input_MaSinhVien', 'Mã số sinh viên chỉ bao gồm các ký tự số'),
          Validator.minLength('#input_MaSinhVien', 10, "Mã số sinh viên phải có tối thiểu 10 chữ số"),
          Validator.isRequired('#input_HoTenSinhVien', 'Vui lòng nhập họ tên sinh viên'),
          Validator.isCharacters('#input_HoTenSinhVien', 'Họ tên sinh viên chỉ bao gồm các ký tự chữ'),
          Validator.isDateOfBirth('#input_NgaySinh'),
        ],
        onSubmit: ThemMoi_SinhVien
    })
	  
	Validator({
        form: '#EditForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
          Validator.isRequired('#edit_input_MaSinhVien', 'Vui lòng nhập mã số sinh viên'),
          Validator.isNumber('#edit_input_MaSinhVien', 'Mã số sinh viên chỉ bao gồm các ký tự số'),
          Validator.minLength('#edit_input_MaSinhVien', 10, "Mã số sinh viên phải có tối thiểu 10 chữ số"),
          Validator.isRequired('#edit_input_TenSinhVien', 'Vui lòng nhập họ tên sinh viên'),
          Validator.isCharacters('#edit_input_TenSinhVien', 'Họ tên sinh viên chỉ bao gồm các ký tự chữ'),
          Validator.isDateOfBirth('#edit_input_NgaySinh'),
        ],
        onSubmit: ChinhSua_SinhVien
    })
	  
	Validator({
		form: '#ChangePasswordForm',
		formGroupSelector: '.form-group',
		errorSelector: '.invalid-feedback',
		rules: [
			Validator.minLength('#input_MatKhauMoi', 6, "Mật khẩu phải có tối thiểu 6 ký tự"),
			Validator.isRequired('#input_NhapLaiMatKhauMoi'),
			Validator.isConfirmed('#input_NhapLaiMatKhauMoi', function() {
				return document.querySelector('#ChangePasswordForm #input_MatKhauMoi').value;
			}, 'Mật khẩu nhập lại không chính xác'),
		],
		onSubmit: DatLaiMatKhau_SinhVien
	})

	var maKhoa_selected = 'tatcakhoa';
	var maLop_selected = 'tatcalop';

	function xuLyTimKiemMSSV() {
		var _input_timKiemMaSinhVien = $('#input_timKiemMaSinhVien').val().trim();

		if (_input_timKiemMaSinhVien != '') {
			if(Number(_input_timKiemMaSinhVien)){
				TimKiemSinhVien(_input_timKiemMaSinhVien);
			} else {
				Swal.fire({
					icon: "error",
					title: "Lỗi",
					text: "Mã số sinh viên không hợp lệ!",
					//timer: 5000,
					timerProgressBar: true,
				});
			}
		}
	}

	//hàm trong function.js
	GetListSinhVien(maKhoa_selected, maLop_selected);

	$('#select_Khoa').on('change', function() {
		$('#input_timKiemMaSinhVien').val('');

		var maKhoa_selected = $('#select_Khoa').val();
		
		LoadComboBoxThongTinLopTheoKhoa(maKhoa_selected);

		var maLop_selected = $('#select_Lop').val();

		GetListSinhVien(maKhoa_selected, maLop_selected);
	});

	$('#select_Lop').on('change', function() {
		$('#input_timKiemMaSinhVien').val('');
		
		var maKhoa_selected = $('#select_Khoa').val();
		var maLop_selected = $('#select_Lop').val();

		GetListSinhVien(maKhoa_selected, maLop_selected);
	});

	$('#btn_timKiemMaSinhVien').on('click', function() {
		xuLyTimKiemMSSV();
	});

	$('#input_timKiemMaSinhVien').keypress(function (e) {
		var key = e.which;
		if(key == 13)  // the 'Enter' code
		{
			$('#btn_timKiemMaSinhVien').click();
		}
	}); 

	LoadComboBoxThongTinLop_SinhVien(); //Load combobox trong modal thêm mới

	LoadComboBoxThongTinKhoa_SinhVien();


	//Dat lai mat khau
	$(document).on("click", ".btn_DatLaiMatKhau_SinhVien", function() {

		let maSinhVien = $(this).attr('data-id');

		$('#input_MaSinhVien_Update').val(maSinhVien);
		$("#input_MatKhauMoi").val("");
		$("#input_NhapLaiMatKhauMoi").val("");
	})


	var select_box_element = document.querySelector('#select_Lop_Add');

	dselect(select_box_element, {
		search: true
	});

	//Xử lý chỉnh sửa
	$(document).on("click", ".btn_ChinhSua_SinhVien", function() {

		let maSinhVien_edit = $(this).attr('data-id');

		$('#edit_input_MaSinhVien').val(maSinhVien_edit);

		LoadThongTinChinhSua_SinhVien(maSinhVien_edit);
	})
</script>