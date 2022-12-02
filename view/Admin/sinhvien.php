<script src="assets/js/check_token.js"></script>
<script>
	//remove class active
	$("#menu-button-QuanTriVien").removeClass("active");
	$("#menu-button-ThongKe").removeClass("active");
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
									<input type="text" id="input_timKiemMaSinhVien" class="form-control" style="min-width: 200px;" placeholder="Nhập mã số sinh viên...">
								</div>
								<div class="col-auto">
									<button type="button" id="btn_timKiemMaSinhVien" class="btn app-btn-secondary">Tìm kiếm</button>
								</div>

								<div class="col-auto" style="padding-left: 15px;">
									<button class="btn app-btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#AddModal">Thêm mới</button>
								</div>

								<div class="col-auto dropdown" style="padding-left: 15px;">
									<button class="btn btn-danger text-white dropdown-toggle" type="button" id="dropdownImportButton" data-bs-toggle="dropdown" aria-expanded="false">
										Import
									</button>
									<ul class="dropdown-menu" aria-labelledby="dropdownImportButton">
										<li>
											<button name="btn_import_sinhvien_from_excel" class="dropdown-item" data-bs-toggle='modal' data-bs-target='#ImportSinhVienFromExcelModal'>Import sinh viên từ Excel</button>
											<button name="btn_import_diemhe4_from_excel" class="dropdown-item" data-bs-toggle='modal' data-bs-target='#ImportGPAFromExcelModal'>Import điểm hệ 4 từ Excel</button>

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

								<div class="col-auto" style="padding-left: 15px;">
									<button class="btn btn-info btn_XetTotNghiep" type="button" data-bs-toggle="modal" data-bs-target="#ModalXetTotNghiep" style="color: white;">Xét tốt nghiệp</button>
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
								<label for="input_Email" class="form-label" style="color: black; font-weight: 500;">Email</label>
								<input type="email" name="email" class="form-control" id="input_Email" placeholder="Nhập email...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="input_sdt" class="form-label" style="color: black; font-weight: 500;">Số điện thoại</label>
								<input type="tel" name="sdt" class="form-control" id="input_sdt" placeholder="Nhập số điện thoại...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="select_Lop_Add" class="form-label" style="color: black; font-weight: 500;">Lớp</label>
								<select class="form-select" name="maLop" aria-label="Default select example" id="select_Lop_Add"></select>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label class="form-label" style="color: black; font-weight: 500;">Hệ</label>
								<select class="form-select edit_select_He" name="he" aria-label="Default select example" id="select_He_Add">
									<option value="dai_hoc">Đại học</option>
									<option value="cao_dang">Cao đẳng</option>
								</select>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label class="form-label" style="color: black; font-weight: 500;">Tốt nghiệp</label>
								<select class="form-select edit_select_TotNghiep" name="totNghiep" aria-label="Default select example" id="select_TotNghiep_Add">
									<option value="0">Chưa tốt nghiệp</option>
									<option value="1">Đã tốt nghiệp</option>
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
								<input type="date" name="ngaySinh" class="form-control mb-2" id="edit_input_NgaySinh">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_input_Email" class="form-label" style="color: black; font-weight: 500;">Email:</label>
								<input type="email" name="email" class="form-control mb-2" id="edit_input_Email" name="email">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_input_sdt" class="form-label" style="color: black; font-weight: 500;">Số điện thoại:</label>
								<input type="tel" name="sdt" class="form-control mb-2" id="edit_input_sdt">
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

							<div class="mb-3 form-group">
								<label for="edit_select_TotNghiep" class="form-label" style="color: black; font-weight: 500;">Tốt nghiệp</label>
								<select class="form-select edit_select_TotNghiep" name="totNghiep" aria-label="Default select example" id="edit_select_TotNghiep">
									<option value="0">Chưa tốt nghiệp</option>
									<option value="1">Đã tốt nghiệp</option>
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

							<div class="mb-3 form-group">
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

			<!-- Modal quản lý điểm trung bình học kỳ -->
			<div class="modal fade" id="QuanLyDiemTrungBinhHocKyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="bg-light" style="min-width: 100vh; min-height: 100vh;">
					<div class="modal-dialog p-2">
						<div class="modal-content border-0" style="min-width: 700px;min-height:450px;margin-left:-50px;">
							<div class="modal-header">
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body py-0">
								<nav>
									<div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
										<button class="nav-link active" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list" aria-selected="true">Danh sách</button>

										<button class="nav-link" id="nav-add-tab" data-bs-toggle="tab" data-bs-target="#nav-add" type="button" role="tab" aria-controls="nav-add" aria-selected="false">Thêm mới</button>
									</div>
								</nav>

								<div class="tab-content border bg-light" id="nav-tabContent">
									<!-- List tab -->
									<div class="tab-pane fade active show" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
										<div class="table-responsive px-2" id ="DanhSachKetQua">
										<h3 class="form-label" id="maSinhVien_ketQuaHocTap" style="color: black; font-weight: 500;"> </h3>
											<table class="table app-table-hover mb-0 text-left" id="table_ketQuaHocTap">
												<thead>
													<tr>

													</tr>
												</thead>
												<tbody id="id_tbodyKetQuaHocTap">
													
												</tbody>
											</table>
										</div>
										<!--//table-responsive-->
									</div>

									<!-- Add tab -->
									<div class="tab-pane fade" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">
										<form action="" class="my-0 w-100" id="AddScoreForm">
											<div class="mb-3 form-group">
												<label for="input_MaSinhVien_GPA" class="form-label" style="color: black; font-weight: 500;">Mã sinh viên: </label>
												<input type="text" class="form-control mb-2" id="input_MaSinhVien_GPA" placeholder="Nhập mã sinh viên..." disabled>
												<span class="invalid-feedback"></span>
											</div>

											<div class="mb-3 form-group">
												<label for="quanlydiemtrungbinhhocky_select_Lop" class="form-label" style="color: black; font-weight: 500;">Học kỳ - Năm học</label>
												<select class="form-select" name="lop" id="select_Quanlydiemtrungbinhhocky"></select>
												<span class="invalid-feedback"></span>
											</div>                                    
										
											<div class="mb-3 form-group">
												<label for="input_DiemTrungBinh" class="form-label" style="color: black; font-weight: 500;">Điểm trung bình hệ 4</label>
												<input type="number" name="diemTrungBinh" class="form-control mb-2" id="input_DiemTrungBinh" placeholder="Nhập điểm trung bình hệ 4 ...">
												<span class="invalid-feedback"></span>
											</div>

											<div class="text-end">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
												<button type="submit" class="btn btn-primary" style="color: white;"> Nhập </button>
											</div>
										</form>	
									</div>						
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Modal import sinh vien from excel -->
			<div class="modal fade" id="ImportSinhVienFromExcelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form action="" class="modal-dialog" id="form_import_from_excel">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"> Import sinh viên từ Excel</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="select_lop_import" class="form-label" style="color: black; font-weight: 500;">Lớp</label>
								<select class="form-select" name="lop" aria-label="Default select example" id="select_lop_import">
								</select>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="import_file" class="form-label" style="color: black; font-weight: 500;">Upload file</label>
								<input type="file" name="import_file" class="form-control" id="import_file">
								<span class="invalid-feedback"></span>
							</div>

							<div class="form-group">
								<p class="mb-0 fw-bold text-body">Yêu cầu thứ tự các cột như sau: STT, Mã số sinh viên, Họ tên sinh viên, Ngày sinh, Email, SĐT, Hệ, Tốt nghiệp</p>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-primary" style='color: white;'>Import</button>
						</div>
					</div>
				</form>
			</div>

			<!-- Modal import diem he 4 from excel -->
			<div class="modal fade" id="ImportGPAFromExcelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form action="" class="modal-dialog" id="form_import_GPA_from_excel">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"> Import điểm hệ 4 từ Excel</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<!-- <div class="mb-3 form-group">
								<label for="select_lop_import" class="form-label" style="color: black; font-weight: 500;">Lớp</label>
								<select class="form-select" name="lop" aria-label="Default select example" id="select_lop_import">
								</select>
								<span class="invalid-feedback"></span>
							</div> -->

							<div class="mb-3 form-group">
								<label for="import_file_GPA" class="form-label" style="color: black; font-weight: 500;">Upload file</label>
								<input type="file" name="import_file_GPA" class="form-control" id="import_file_GPA">
								<span class="invalid-feedback"></span>
							</div>

							<div class="form-group">
								<p class="mb-0 fw-bold text-body">Yêu cầu thứ tự các cột như sau: STT, Mã điểm trung bình, Mã học kỳ đánh giá,  Điểm, Mã số sinh viên</p>
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

			<!-- Modal Xet tot nghiep -->
			<div class="modal fade" id="ModalXetTotNghiep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"> Xét tốt nghiệp </h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<label style="color: black; font-weight: 500;">Chọn khoa</label><br />
								<select class="form-select" name="maKhoaXetTotNghiep" id="select_Khoa_XetTotNghiep"></select>
							</div>
							<div class="mb-3">
								<label style="color: black; font-weight: 500;">Chọn lớp</label><br />
								<select class="form-select " name="maLopXetTotNghiep" id="select_Lop_XetTotNghiep"></select>
							</div>

							<div class="mb-3">
								<label style="color: black; font-weight: 500;">Tìm kiếm</label><br />
								<input id="input_TimKiem_XetTotNghiep" placeholder="Nhập mã số sinh viên..." style="width:50%;"  oninput="searchCheckBox()"/>
							</div>

							<div class="mb-3">
								<label style="color: black; font-weight: 500;">Danh sách sinh viên xét tốt nghiệp (tích = tốt nghiệp)</label>
								<button type="button" class="btn btn-danger float-end btn_BoChonTatCa" style="color: white;"> Bỏ chọn tất cả </button>
								<button type="button" class="btn btn-info float-end me-3 btn_ChonTatCa" style="color: white;"> Chọn tất cả </button>
							</div>
							
							<div class="container" id="listXetTotNghiep" style="border:1px solid #ccc; height: 200px; overflow-y: scroll;">
								
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn app-btn-primary" data-bs-dismiss="modal" id="Luu_XetTotNghiep">Lưu</button>
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
<!-- <script src="assets/js/modal.js"></script> -->


<!-- Form Validator -->
<script src="./assets/js/validator.js"></script>


<script>
	Validator({
        form: '#AddForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isRequired('#input_MaSinhVien', 'Vui lòng nhập mã số sinh viên'),
			Validator.isPositiveNumber('#input_MaSinhVien', 'Mã số sinh viên chỉ bao gồm các ký tự số'),
			Validator.minLength('#input_MaSinhVien', 10, "Mã số sinh viên phải có tối thiểu 10 chữ số"),
			Validator.isRequired('#input_HoTenSinhVien', 'Vui lòng nhập họ tên sinh viên'),
			Validator.isCharacters('#input_HoTenSinhVien', 'Họ tên sinh viên chỉ bao gồm các ký tự chữ'),
			Validator.isRequired('#input_NgaySinh', 'Vui lòng nhập ngày sinh'),
			Validator.isDateOfBirth('#input_NgaySinh'),
			Validator.isRequired('#input_Email', "Vui lòng nhập email"),
			Validator.isEmail('#input_Email', "Email không hợp lệ"),
			Validator.isRequired('#input_sdt', "Vui lòng nhập số điện thoại"),
			Validator.isPhoneNumber('#input_sdt'),
        ],
        onSubmit: ThemMoi_SinhVien
    })
	  
	Validator({
        form: '#EditForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isRequired('#edit_input_MaSinhVien', 'Vui lòng nhập mã số sinh viên'),
			Validator.isPositiveNumber('#edit_input_MaSinhVien', 'Mã số sinh viên chỉ bao gồm các ký tự số'),
			Validator.minLength('#edit_input_MaSinhVien', 10, "Mã số sinh viên phải có tối thiểu 10 chữ số"),
			Validator.isRequired('#edit_input_TenSinhVien', 'Vui lòng nhập họ tên sinh viên'),
			Validator.isCharacters('#edit_input_TenSinhVien', 'Họ tên sinh viên chỉ bao gồm các ký tự chữ'),
			Validator.isRequired('#edit_input_NgaySinh', 'Vui lòng nhập ngày sinh'),
			Validator.isDateOfBirth('#edit_input_NgaySinh'),
			Validator.isRequired('#edit_input_Email', "Vui lòng nhập email"),
			Validator.isEmail('#edit_input_Email', "Email không hợp lệ"),
			Validator.isRequired('#edit_input_sdt', "Vui lòng nhập số điện thoại"),
			Validator.isPhoneNumber('#edit_input_sdt'),
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

	Validator({
		form: '#AddScoreForm',
		formGroupSelector: '.form-group',
		errorSelector: '.invalid-feedback',
		rules: [
			Validator.isRequired('#input_MaSinhVien_GPA'),
			Validator.isRequired('#input_DiemTrungBinh'),
			Validator.isNumber('#input_DiemTrungBinh', 'Điểm trung bình chỉ bao gồm các ký tự số'),
			Validator.minNumber('#input_DiemTrungBinh', 0, "Điểm trung bình phải lớn hơn 0"),
			Validator.maxNumber('#input_DiemTrungBinh', 4, "Điểm trung bình phải nhỏ hơn 4"),
		],
		onSubmit: NhapDiemHe4
	})

	tableTitle.forEach(function(title, index) {
		$("#my_table>thead>tr").append(`<th class='cell'>${title}</th>`);

		if(index == tableTitle.length - 1) {
			$("#my_table>thead>tr").append(`<th class='cell'>Hành động</th>`);
		}
	});

	tableKetQuaHocTapTitle.forEach(function(title, index) {
		$("#table_ketQuaHocTap>thead>tr").append(`<th class='cell'>${title}</th>`);

		if(index == tableKetQuaHocTapTitle.length - 1) {
			$("#table_ketQuaHocTap>thead>tr").append(`<th class='cell'>Hành động</th>`);
		}
	});

	function xuLyTimKiemMSSV() {
		var _input_timKiemMaSinhVien = $('#input_timKiemMaSinhVien').val().trim();
		TimKiemSinhVien(_input_timKiemMaSinhVien);
		// if (_input_timKiemMaSinhVien != '') {
		// 	if(Number(_input_timKiemMaSinhVien)){
		// 		TimKiemSinhVien(_input_timKiemMaSinhVien);
		// 	} else {
		// 		Swal.fire({
		// 			icon: "error",
		// 			title: "Lỗi",
		// 			text: "Mã số sinh viên không hợp lệ!",
		// 			timer: 2000,
		// 			timerProgressBar: true,
		// 		});
		// 	}
		// }
	}

	$('#select_Khoa').on('change', function() {
		$('#input_timKiemMaSinhVien').val('');

		var maKhoa_selected = $('#select_Khoa').val();
		
		LoadComboBoxThongTinLopTheoKhoa(maKhoa_selected, "#select_Lop");

		var maLop_selected = $('#select_Lop').val();

		GetListSinhVien(maKhoa_selected, maLop_selected);
	});

	$('#select_Lop').on('change', function() {
		$('#input_timKiemMaSinhVien').val('');
		
		var maKhoa_selected = $('#select_Khoa').val();
		var maLop_selected = $('#select_Lop').val();

		GetListSinhVien(maKhoa_selected, maLop_selected);
	});

	$("#select_Khoa_XetTotNghiep").on("change", function() {
		$('#input_TimKiem_XetTotNghiep').val('');
		var maKhoa_selected = $('#select_Khoa_XetTotNghiep').val();
		
		if(maKhoa_selected == "tatcakhoa") {
			$("#select_Lop_XetTotNghiep").find("option").remove();
			return;
		}

		LoadComboBoxThongTinLopTheoKhoa(maKhoa_selected, "#select_Lop_XetTotNghiep");
		$("#select_Lop_XetTotNghiep option[value='tatcalop']").remove();
		$('#select_Lop_XetTotNghiep').trigger('change');
	});

	$("#select_Lop_XetTotNghiep").on("change", function() {
		$('#input_TimKiem_XetTotNghiep').val('');
		var maLop_selected = $('#select_Lop_XetTotNghiep').val();
		getListXetTotNghiep(maLop_selected);
		viewCheckBox();
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
	
	function isGPA(inputElement, min, max) {
		if (inputElement.value < min) {
			inputElement.value = min;
		} else if (inputElement.value > max) {
			inputElement.value = max;
		}
	}; 

	LoadComboBoxThongTinLop_SinhVien(); //Load combobox trong modal thêm mới

	LoadComboBoxThongTinKhoa_SinhVien("#select_Khoa");

	//hàm trong function.js
	GetListSinhVien($('#select_Khoa').val(), $('#select_Lop').val());


	//Dat lai mat khau
	$(document).on("click", ".btn_DatLaiMatKhau_SinhVien", function() {

		let maSinhVien = $(this).attr('data-id');

		$('#input_MaSinhVien_Update').val(maSinhVien);
		$("#ChangePasswordForm #input_MatKhauMoi").val("");
      	$("#ChangePasswordForm #input_MatKhauMoi").removeClass("is-invalid");
		$("#ChangePasswordForm #input_NhapLaiMatKhauMoi").val("");
      	$("#ChangePasswordForm #input_NhapLaiMatKhauMoi").removeClass("is-invalid");
	})

	var select_box_element = document.querySelector('#select_Lop_Add');

	dselect(select_box_element, {
		search: true
	});

	dselect(document.querySelector('#select_lop_import'), {
		search: true
	});

	//Xử lý chỉnh sửa
	$(document).on("click", ".btn_ChinhSua_SinhVien", function() {

		let maSinhVien_edit = $(this).attr('data-id');

		$('#edit_input_MaSinhVien').val(maSinhVien_edit);

		LoadThongTinChinhSua_SinhVien(maSinhVien_edit);

		$("#EditForm #edit_input_MaSinhVien").removeClass("is-invalid");
      	$("#EditForm #edit_input_TenSinhVien").removeClass("is-invalid");
      	$("#EditForm #edit_input_NgaySinh").removeClass("is-invalid");
	});

	// Xử lý quản lý điểm trung bình học kỳ
	$(document).on("click", ".btn_QuanLyDiemTrungBinhHocKy_SinhVien", function() {
		$("#AddScoreForm #input_DiemTrungBinh").val("");
		let maSinhVien = $(this).attr('data-id');
		$('#input_MaSinhVien_GPA').val(maSinhVien);
		$('#maSinhVien_ketQuaHocTap').text("Mã sinh viên: " + maSinhVien);
		LoadComboBoxHocKyVaNamHoc();
		LoadDiemHe4(maSinhVien);
	});

	// Xử lý chỉnh sửa điểm trung bình học kỳ
	$(document).on("click", ".btn_ChinhSua_DiemHe4", function() {
		var diem = $(this).closest('tr').children('td:nth-child(3)').text();
		$(this).closest('tr').children('td:nth-child(3)').empty();
		$(this).closest('tr').children('td:nth-child(3)').append(
			`<input type="number" value="${diem}" min="0" max="4" onchange="isGPA(this, 0, 4)" class="chinhSua-diemTB" style="width:120px" placeholder="Nhập điểm">`
		);

		$(this).hide();
		$(this).closest('tr').find('.edit-confirmation').show();
	});

	// Xử lý xác nhận chỉnh sửa điểm trung bình học kỳ
	$(document).on("click", ".btn_XacNhanChinhSua_DiemHe4", function() {
		var diemChinhSua = $(this).closest('tr').find('.chinhSua-diemTB').val();
		let maSinhVien = $(this).attr('data-idmssv');
		let maHocKyDanhGia = $(this).attr('data-idMaHKDG');
		// Call Edit API here...
		//console.log(diemChinhSua);
		updateDiemHe4(maSinhVien, maHocKyDanhGia, diemChinhSua);
		// Call Get All API

		$(this).parent().hide();
		$(this).closest('tr').find('.btn_ChinhSua_DiemHe4').show();
	});

	// Xử lý hủy chỉnh sửa điểm trung bình học kỳ
	$(document).on("click", ".btn_HuyChinhSua_DiemHe4", function() {
		let maSinhVien = $(this).attr('data-idmssv');
		
		// Call Get All API
		LoadDiemHe4(maSinhVien);

		$(this).parent().hide();
		$(this).closest('tr').find('.btn_ChinhSua_DiemHe4').show();
	});

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
							
			$("#ImportSinhVienFromExcelModal").modal("hide");
		
			$.ajax({
				url: host_domain_url + '/phpspreadsheet/import/import_sinhvien.php',
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
								console.log("table title" + tableTitle);
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

	// Xử lý import GPA form excel
	$('#form_import_GPA_from_excel').submit(function(e) {
      	e.preventDefault();

		if(document.getElementById("import_file_GPA").files.length == 0 ){
			Swal.fire({
				icon: "error",
				title: "Lỗi",
				text: "Vui lòng upload file excel để import!",
				timer: 2000,
				timerProgressBar: true,
			});
		} else {
			var formData = new FormData(this);
			for (const pair of formData.entries()) {
				console.log(`${pair[0]}, ${pair[1]}`);
			}
							
			$("#ImportGPAFromExcelModal").modal("hide");
		
			$.ajax({
				url: host_domain_url + '/phpspreadsheet/import/import_GPA.php',
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
							$("#form_import_GPA_from_excel #import_file_GPA").val('');

							if(result.invalidRows) {
								const tableTitle = result.invalidRows.slice(0, 1);
								console.log("table title" + tableTitle);
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
			$(this).attr('action', host_domain_url + '/phpspreadsheet/export/export_sinhvien.php');

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

	// Xử lý xét tốt nghiệp
	$(document).on("click", ".btn_XetTotNghiep", function() {
		LoadComboBoxThongTinKhoa_SinhVien("#select_Khoa_XetTotNghiep");
		LoadComboBoxThongTinLopTheoKhoa($('#select_Khoa_XetTotNghiep').val(), "#select_Lop_XetTotNghiep");

		$("#select_Lop_XetTotNghiep option[value='tatcalop']").remove();
		$("#input_TimKiem_XetTotNghiep").val("");
		$("#listXetTotNghiep").empty();
	});

	// Chọn tất cả
	$(document).on("click", ".btn_ChonTatCa", function() {
		selectAllCheckBox();
	});

	// Bỏ chọn tất cả
	$(document).on("click", ".btn_BoChonTatCa", function() {
		deselectAllCheckBox();
	});

	// Lưu xét tốt nghiệp
	$("#Luu_XetTotNghiep").on("click", function() {
		luuXetTotNghiep();
	});
</script>