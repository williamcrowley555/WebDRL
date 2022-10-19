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

						<div class="col-auto dropdown" style="padding-left: 15px;">
							<button class="btn btn-danger text-white dropdown-toggle" type="button" id="dropdownImportButton" data-bs-toggle="dropdown" aria-expanded="false">
								Import
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownImportButton">
								<li>
									<button name="btn_import_from_excel" class="dropdown-item" data-bs-toggle='modal' data-bs-target='#ImportFromExcelModal'>Import from Excel</button>
								</li>
							</ul>
						</div>

						<div class="col-auto dropdown" style="padding-left: 15px;">
							<button class="btn btn-success text-white dropdown-toggle" type="button" id="dropdownExportButton" data-bs-toggle="dropdown" aria-expanded="false">
								Export
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownExportButton">
								<li>
									<form action="" method="POST" id="form_export_to_excel">
										<input type="hidden" name="table_data" id="table_data" />
										<button type="submit" name="btn_export_to_excel" class="dropdown-item">Export to Excel</button>
									</form>
								</li>
							</ul>
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

			<!-- Modal import from excel -->
			<div class="modal fade" id="ImportFromExcelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form action="" class="modal-dialog" id="form_import_from_excel">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"> Import From Excel</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="import_file" class="form-label" style="color: black; font-weight: 500;">Upload file</label>
								<input type="file" name="import_file" class="form-control" id="import_file">
								<span class="invalid-feedback"></span>
							</div>

							<div class="form-group">
								<p class="mb-0 fw-bold text-body">Yêu cầu thứ tự các cột như sau: STT, Mã khoa, Tên khoa, Tài khoản khoa, Mật khẩu (optional)</p>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-primary" style='color: white;'>Import</button>
						</div>
					</div>
				</form>
			</div>

			<!-- Modal error list of import from excel -->
			<div class="modal fade" id="ImportErrorListModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"> Dach sách các dòng lỗi</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="table-responsive">
								<table class="table app-table-hover mb-0 text-left" id="table_import_error_list">
									<thead>
										<tr>
										
										</tr>
									</thead>
									<tbody>

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
							<table class="table app-table-hover mb-0 text-left" id="my_table">
								<thead>
									<tr>
										
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

	tableTitle.forEach(function(title, index) {
		$("#my_table>thead>tr").append(`<th class='cell'>${title}</th>`);

		if(index == tableTitle.length - 1) {
			$("#my_table>thead>tr").append(`<th class='cell'>Hành động</th>`);

		}
	});

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

	// Xử lý import form excel 
	$('#form_import_from_excel').submit(function(e) {
		e.preventDefault();

		if(document.getElementById("import_file").files.length == 0 ){
			Swal.fire({
				icon: "error",
				title: "Lỗi",
				text: "Vui lòng upload file excel để import!",
				timer: 2000,
				timerProgressBar: true,
			});
		} else {
			var formData = new FormData(this);

			$("#ImportFromExcelModal").modal("hide");
		
			$.ajax({
				url: 'http://localhost/WebDRL/phpspreadsheet/import/import_khoa.php',
				type: "POST",
				data: formData,
				processData: false, 
				contentType: false,
				enctype: 'multipart/form-data',
				mimeType: 'multipart/form-data',
				success: function (result) {
					console.log(result)
					result = JSON.parse(result);

					if(result.success) {
						Swal.fire({
							icon: "success",
							title: "Thành công",
							text: "Import thành công!",
							timer: 2000,
							timerProgressBar: true,
							showCloseButton: true,
						});
					} else {
						Swal.fire({
							icon: "error",
							title: "Import thất bại!",
							text: result.message,
							timerProgressBar: true,
							showCloseButton: true,
						}).then(function() {
							$("#form_import_from_excel #import_file").val('');

							if(result.invalidRows) {
								const tableTitle = result.invalidRows.slice(0, 1);
								const tableBody = result.invalidRows.slice(1);

								$("#table_import_error_list thead tr th").remove();
								$("#table_import_error_list tbody tr").remove();

								tableTitle[0].forEach(function(title) {
									$("#table_import_error_list>thead>tr").append(`<th class='cell'>${title}</th>`);
								});
								
								tableBody.forEach(function(row) {
									html = "<tr>";

									row.forEach(function(data) {
										html += `<td class='cell'>${data}</td>`;
									});

									html += "</tr>";

									$("#table_import_error_list>tbody").append(html);
								});

								$("#ImportErrorListModal").modal("show");
							}
						});;
					}
				},
			});
		}
	});

	// Xử lý export to excel 
	$('#form_export_to_excel').submit(function() {
		if(Array.isArray(tableContent) && tableContent.length > 0) {
			$(this).attr('action', 'http://localhost/WebDRL/phpspreadsheet/export/export_khoa.php');

			$("#form_export_to_excel #table_data").val(
				JSON.stringify({
					tableTitle: tableTitle,
					tableContent: tableContent
				})
			);

			return true;
		} else {
			Swal.fire({
				icon: "error",
				title: "Lỗi",
				text: "Không có dữ liệu để export!",
				timer: 2000,
				timerProgressBar: true,
				showCloseButton: true,
			});

			return false;
		}
	});
</script>