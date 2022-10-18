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

						<div class="col-auto dropdown" style="padding-left: 15px;">
							<button class="btn btn-danger text-white dropdown-toggle" type="button" id="dropdownImportButton" data-bs-toggle="dropdown" aria-expanded="false">
								Import
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownImportButton">
								<li>
									<button type="submit" name="btn_import_from_excel" class="dropdown-item" data-bs-toggle='modal' data-bs-target='#ImportFromExcelModal'>Import from Excel</button>
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

							<div class="mb-3 form-group">
								<label for="select_Khoa_Add" class="form-label" style="color: black; font-weight: 500;">Khoa</label>
								<select class="form-select" name="maKhoa" aria-label="Default select example" id="select_Khoa_Add">

								</select>
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

							<div class="mb-3 form-group">
								<label for="select_Khoa_Edit" class="form-label" style="color: black; font-weight: 500;">Khoa</label>
								<select class="form-select" name="maKhoa" aria-label="Default select example" id="select_Khoa_Edit">

								</select>
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
								<label for="select_khoa_import" class="form-label" style="color: black; font-weight: 500;">Khoa</label>
								<select class="form-select" name="khoa" aria-label="Default select example" id="select_khoa_import">
								</select>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="import_file" class="form-label" style="color: black; font-weight: 500;">Upload file</label>
								<input type="file" name="import_file" class="form-control" id="import_file">
								<span class="invalid-feedback"></span>
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


<!-- Form Validator -->
<script src="./assets/js/validator.js"></script>

<script>

	Validator({
        form: '#AddForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isRequired('#inputMaCoVanHocTap', 'Vui lòng nhập mã cố vấn học tập'),
			Validator.isPositiveNumber('#inputMaCoVanHocTap', 'Mã cố vấn học tập chỉ bao gồm các ký tự số'),
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
			Validator.isPositiveNumber('#edit_input_MaCVHT', 'Mã cố vấn học tập chỉ bao gồm các ký tự số'),
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

	tableTitle.forEach(function(title, index) {
		$("#my_table>thead>tr").append(`<th class='cell'>${title}</th>`);

		if(index == tableTitle.length - 1) {
			$("#my_table>thead>tr").append(`<th class='cell'>Hành động</th>`);

		}
	});

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

	//add modal
	var select_box_element_Khoa = document.querySelector('#select_Khoa_Add');

	dselect(select_box_element_Khoa, {
		search: true
	});

	dselect(document.querySelector('#select_khoa_import'), {
		search: true
	});

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

		//edit modal
		var edit_select_box_element_Khoa = document.querySelector('#select_Khoa_Edit');

		dselect(edit_select_box_element_Khoa, {
			search: true
		});

		$("#EditForm #edit_input_MaCVHT").removeClass("is-invalid");
		$("#EditForm #edit_input_TenCVHT").removeClass("is-invalid");
		$("#EditForm #edit_input_sdt").removeClass("is-invalid");
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
				url: 'http://localhost/WebDRL/phpspreadsheet/import/import_covanhoctap.php',
				type: "POST",
				data: formData,
				processData: false, 
				contentType: false,
				enctype: 'multipart/form-data',
				mimeType: 'multipart/form-data',
				success: function (result) {
					// console.log(result)
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
			$(this).attr('action', 'http://localhost/WebDRL/phpspreadsheet/export/export_covanhoctap.php');

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