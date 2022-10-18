<script src="assets/js/check_token.js"></script>
<script>
	//remove class active
	$("#menu-button-ThongKe").removeClass("active");
	$("#menu-button-SinhVien").removeClass("active");
	$("#menu-button-HoatDongDanhGia").removeClass("active");
	$("#menu-button-Khoa").removeClass("active");
	$("#menu-button-PhieuRenLuyen").removeClass("active");
	$("#menu-button-CoVanHocTap").removeClass("active");
	$("#menu-button-TieuChiDanhGia").removeClass("active");
	$("#menu-button-ThongBaoDanhGia").removeClass("active");

	//add class active
	$("#menu-button-Lop").addClass("active");

	//set title
	document.title = "Lớp | Web điểm rèn luyện";
</script>

<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">

		<h1 class="app-page-title">.</h1>
		<h1 class="app-page-title"><img src="assets/images/icons/class.png" alt="" width="30px"> Lớp</h1>

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
									<input type="text" id="input_timKiemMaLop" name="" class="form-control" placeholder="Nhập mã lớp...">
								</div>
								<div class="col-auto">
									<button type="button" id="btn_timKiemMaLop" class="btn app-btn-secondary">Tìm kiếm</button>
								</div>

								<div class="col-auto" style="padding-left: 15px;">
									<button class="btn app-btn-primary btn_Them_Lop" type="button" data-bs-toggle="modal" data-bs-target="#AddModal">Thêm mới</button>
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

						</div>
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

			<!-- Modal thêm -->
			<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form action="" class="modal-dialog" id="AddForm">
					<div class="modal-content">
						<div class="modal-header">
							<img src="assets/images/icons/add.png" width="25px" style="padding-right: 5px;">
							<h5 class="modal-title" id="exampleModalLabel"> Thêm lớp</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="input_MaLop" class="form-label" style="color: black; font-weight: 500;">Mã lớp</label>
								<input type="text" name="maLop" class="form-control mb-2" id="input_MaLop" placeholder="Mã lớp sẽ tự động nhập..." readonly>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="input_TenLop" class="form-label" style="color: black; font-weight: 500;">Tên lớp</label>
								<input type="text" name="tenLop" class="form-control" id="input_TenLop" placeholder="Nhập tên lớp...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="select_Khoa_Add" class="form-label" style="color: black; font-weight: 500;">Khoa</label>
								<select class="form-select" name="maKhoa" aria-label="Default select example" id="select_Khoa_Add">

								</select>
							</div>

							<div class="mb-3 form-group">
								<label for="select_CVHT_Add" class="form-label" style="color: black; font-weight: 500;">Cố vấn học tập</label>
								<select class="form-select" name="maCoVanHocTap" aria-label="Default select example" id="select_CVHT_Add">

								</select>
							</div>

							<div class="mb-3 form-group">
								<label for="select_KhoaHoc_Add" class="form-label" style="color: black; font-weight: 500;">Khóa học</label>
								<select class="form-select" name="maKhoaHoc" aria-label="Default select example" id="select_KhoaHoc_Add">

								</select>
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
							<h5 class="modal-title" id="exampleModalLabel"> Chỉnh sửa lớp</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="edit_input_MaLop" class="form-label" style="color: black; font-weight: 500;">Mã lớp</label>
								<input type="text" name="maLop" class="form-control mb-2" id="edit_input_MaLop" placeholder="Mã lớp sẽ tự động nhập..." readonly>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_input_TenLop" class="form-label" style="color: black; font-weight: 500;">Tên lớp</label>
								<input type="text" name="tenLop" class="form-control" id="edit_input_TenLop" placeholder="Nhập tên lớp...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_select_Khoa_Add" class="form-label" style="color: black; font-weight: 500;">Khoa</label>
								<select class="form-select" name="maKhoa" aria-label="Default select example" id="edit_select_Khoa_Add">

								</select>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_select_CVHT_Add" class="form-label" style="color: black; font-weight: 500;">Cố vấn học tập</label>
								<select class="form-select edit_select_CVHT_Add" name="maCoVanHocTap" aria-label="Default select example" id="edit_select_CVHT_Add">

								</select>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_select_KhoaHoc_Add" class="form-label" style="color: black; font-weight: 500;">Khóa học</label>
								<select class="form-select" name="maKhoaHoc" aria-label="Default select example" id="edit_select_KhoaHoc_Add">

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
<script src="assets/js/lop/function.js"></script>


<!-- Form Validator -->
<script src="./assets/js/validator.js"></script>

<script>
	
	Validator({
        form: '#AddForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
          Validator.isRequired('#input_MaLop', 'Vui lòng nhập mã lớp'),
          Validator.isNotSpecialChars('#input_MaLop', 'Mã lớp chỉ bao gồm các ký tự chữ, số và không bao gồm khoảng trắng', false),
          Validator.minLength('#input_MaLop', 7, "Mã lớp phải có tối thiểu 7 ký tự"),
          Validator.isRequired('#input_TenLop', 'Vui lòng nhập tên lớp'),
        ],
        onSubmit: ThemMoi_Lop
    })
	  
	Validator({
        form: '#EditForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
          Validator.isRequired('#edit_input_MaLop', 'Vui lòng nhập mã lớp'),
          Validator.isNotSpecialChars('#edit_input_MaLop', 'Mã lớp chỉ bao gồm các ký tự chữ, số và không bao gồm khoảng trắng', false),
          Validator.minLength('#edit_input_MaLop', 7, "Mã lớp phải có tối thiểu 7 ký tự"),
          Validator.isRequired('#edit_input_TenLop', 'Vui lòng nhập tên lớp'),
        ],
        onSubmit: ChinhSua_Lop
    })

	tableTitle.forEach(function(title, index) {
		$("#my_table>thead>tr").append(`<th class='cell'>${title}</th>`);

		if(index == tableTitle.length - 1) {
			$("#my_table>thead>tr").append(`<th class='cell'>Hành động</th>`);

		}
	});

	//hàm trong function.js
	var maKhoa = 'tatcakhoa';

	if (maKhoa != '') {
		GetListLop(maKhoa);
	}

	function onlyLettersAndNumbers(str) {
		return /^[A-Za-z0-9]*$/.test(str);
	}

	function xuLyTimKiemMaLop() {
		var _input_timKiemMaLop = $('#input_timKiemMaLop').val().trim();

		if (_input_timKiemMaLop != '') {
			if(onlyLettersAndNumbers(_input_timKiemMaLop)){
				TimKiemLop(_input_timKiemMaLop);
			} else {
				Swal.fire({
					icon: "error",
					title: "Lỗi",
					text: "Mã lớp không hợp lệ!",
					timer: 2000,
					timerProgressBar: true,
				});
			}
		}
	}

	function xuLyTaoMaLop(maLopSelector) {
		return function(data) {
			const maLop = data.substring(0, 6);
			const sttLop = Number(data.substring(6));

			if(sttLop == null) {
				$(maLopSelector).val(maLop + 1);
			} else {
				$(maLopSelector).val(maLop + (sttLop + 1));
			}
		}
	}

	$('#select_Khoa').on('change', function() {
		$('#input_timKiemMaLop').val('');

		var maKhoa = $('#select_Khoa').val();

		if (maKhoa != '') {
			GetListLop(maKhoa);
		}
	});

	$('#btn_timKiemMaLop').on('click', function() {
		xuLyTimKiemMaLop();
	});

	$('#input_timKiemMaLop').keypress(function (e) {
		var key = e.which;
		if(key == 13)  // the 'Enter' code
		{
			$('#btn_timKiemMaLop').click();
		}
	}); 


	LoadComboBoxThongTinKhoa_Lop();

	LoadComboBoxCoVanHocTap_AddModal();

	LoadComboBoxKhoaHoc_AddModal();


	//add modal
	var select_box_element_Khoa = document.querySelector('#select_Khoa_Add');

	dselect(select_box_element_Khoa, {
		search: true
	});


	var select_box_element_CVHT = document.querySelector('#select_CVHT_Add');

	dselect(select_box_element_CVHT, {
		search: true
	});


	var select_box_element_KhoaHoc = document.querySelector('#select_KhoaHoc_Add');

	dselect(select_box_element_KhoaHoc, {
		search: true
	});

	//Xử lý thêm
	$(document).on("click", ".btn_Them_Lop", function() {
		GetMaLopCoSoLopLonNhat($('#AddModal #select_Khoa_Add').find(":selected").val(), 
								$('#AddModal #select_KhoaHoc_Add').find(":selected").val(), 
								xuLyTaoMaLop("#AddModal #input_MaLop"));
	})

	//Xử lý chỉnh sửa
	$(document).on("click", ".btn_ChinhSua_Lop", function() {

		let maLop_edit = $(this).attr('data-id');

		$('#edit_input_MaLop').val(maLop_edit);

		LoadThongTinChinhSua_Lop(maLop_edit);

		//edit modal
		var edit_select_box_element_Khoa = document.querySelector('#edit_select_Khoa_Add');

		dselect(edit_select_box_element_Khoa, {
			search: true
		});

		var edit_select_box_element_CVHT = document.querySelector('#edit_select_CVHT_Add');

		dselect(edit_select_box_element_CVHT, {
			search: true
		});

		var edit_select_box_element_KhoaHoc = document.querySelector('#edit_select_KhoaHoc_Add');

		dselect(edit_select_box_element_KhoaHoc, {
			search: true
		});

		$("#EditForm #edit_input_MaLop").removeClass("is-invalid");
		$("#EditForm #edit_input_TenLop").removeClass("is-invalid");
	})

	$('#AddModal #select_Khoa_Add').on('change', function() {
		GetMaLopCoSoLopLonNhat($('#AddModal #select_Khoa_Add').find(":selected").val(), 
								$('#AddModal #select_KhoaHoc_Add').find(":selected").val(), 
								xuLyTaoMaLop("#AddModal #input_MaLop"));
	});

	$('#AddModal #select_KhoaHoc_Add').on('change', function() {
		GetMaLopCoSoLopLonNhat($('#AddModal #select_Khoa_Add').find(":selected").val(), 
								$('#AddModal #select_KhoaHoc_Add').find(":selected").val(), 
								xuLyTaoMaLop("#AddModal #input_MaLop"));
	});

	// $('#ChinhSuaModal #edit_select_Khoa_Add').on('change', function() {
	// 	GetMaLopCoSoLopLonNhat($('#ChinhSuaModal #edit_select_Khoa_Add').val(), 
	// 							$('#ChinhSuaModal #edit_select_KhoaHoc_Add').val(), 
	// 							xuLyTaoMaLop("#ChinhSuaModal #edit_input_MaLop"));
	// });

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
				url: 'http://localhost/WebDRL/phpspreadsheet/import/import_lop.php',
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
			$(this).attr('action', 'http://localhost/WebDRL/phpspreadsheet/export/export_lop.php');

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