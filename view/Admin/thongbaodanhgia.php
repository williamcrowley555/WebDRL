<script src="assets/js/check_token.js"></script>
<script>
		
	//remove class active
	$("#menu-button-QuanTriVien").removeClass("active");
	$("#menu-button-ThongKe").removeClass("active");
	$("#menu-button-SinhVien").removeClass("active");
	$("#menu-button-HoatDongDanhGia").removeClass("active");
	$("#menu-button-Khoa").removeClass("active");
	$("#menu-button-PhieuRenLuyen").removeClass("active");
	$("#menu-button-CoVanHocTap").removeClass("active");
	$("#menu-button-TieuChiDanhGia").removeClass("active");
	$("#menu-button-Lop").removeClass("active");
	$("#menu-button-KhieuNai").removeClass("active");
	$("#menu-button-ThongKe").removeClass("active");
	
	//add class active
	$("#menu-button-ThongBaoDanhGia").addClass("active");
	
	//set title
	document.title = "Thông báo đánh giá | Web điểm rèn luyện";

</script>

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<h1 class="app-page-title">.</h1>
			<h1 class="app-page-title"><img src="assets/images/icons/social.png" alt="" width="30px"> Thông báo đánh giá</h1>

			<div class="row g-4 mb-4">

				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">

							<div class="col-auto">

							</div>


							<div class="col-auto">
								<div class="table-search-form row gx-1 align-items-center" style="padding-bottom: 20px;">
									<div class="col-auto">
										<input type="text" id="input_timKiemMaHKDG" name="inputTimKiem_MaHoatDong" class="form-control search-orders" placeholder="Nhập mã học kỳ...">
									</div>
									<div class="col-auto">
										<button type="button" id="btn_timKiemMaHKDG" class="btn app-btn-secondary">Tìm kiếm</button>
									</div>

									<div class="col-auto" style="padding-left: 15px;">
										<button class="btn app-btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#AddModal">Thêm mới</button>
									</div>
								</div>

								<!-- <div class="table-search-form row gx-1 align-items-center">
									<div class="col-auto">
										<p></p>
										<span style="font-weight: 700;">Lọc theo thời gian: </button>
									</div>
									<div class="col-auto">
										<span style="font-weight: 700;">Thời gian bắt đầu</span>
										<input type="datetime-local" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Nhập mã hoạt động...">
									</div>
									<div class="col-auto">
										<span style="font-weight: 700;">Thời gian bắt đầu</span>
										<input type="datetime-local" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Nhập mã hoạt động...">
									</div>

								</div> -->
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
								<h5 class="modal-title" id="exampleModalLabel"> Thêm thông báo đánh giá</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">

								<div class="mb-3 form-group">
									<label for="select_HocKyXet" class="form-label" style="color: black; font-weight: 500;">Học kỳ đánh giá</label>
									<select class="form-select" name="hocKyXet" id="select_HocKyXet">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
									</select>
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="" class="form-label" style="color: black; font-weight: 500;">Năm học đánh giá</label>
									<div class="input-group">
										<input type="number" class="form-control" name="namHocBatDau" id="input_NamHocBatDau" min="0" placeholder="Năm học bắt đầu...">
										<span class="input-group-text"> &mdash; </span>
										<input type="number" class="form-control" name="namHocKetThuc" id="input_NamHocKetThuc" min="0" placeholder="Năm học kết thúc...">
										<span class="invalid-feedback"></span>
									</div>
								</div>

								<div class="mb-3 form-group">
									<label for="input_NgayThongBao" class="form-label" style="color: black; font-weight: 500;">Ngày thông báo</label>
									<input type="date" class="form-control" name="ngayThongBao" id="input_NgayThongBao" placeholder="Nhập ngày thông báo...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="input_NgaySinhVienDanhGia" class="form-label" style="color: black; font-weight: 500;"><img src="assets/images/icons/student1.png" alt="Student text" width="15px" /> Ngày sinh viên đánh giá</label>
									<input type="date" class="form-control" name="ngaySinhVienDanhGia" id="input_NgaySinhVienDanhGia" placeholder="Nhập ngày sinh viên đánh giá...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="input_NgaySinhVienKetThucDanhGia" class="form-label" style="color: black; font-weight: 500;">Ngày sinh viên kết thúc đánh giá</label>
									<input type="date" class="form-control" name="ngaySinhVienKetThucDanhGia" id="input_NgaySinhVienKetThucDanhGia" placeholder="Nhập ngày sinh viên kết thúc đánh giá...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="input_NgayCoVanDanhGia" class="form-label" style="color: black; font-weight: 500;"><img src="assets/images/icons/presentation2.png" alt="cố vấn text" width="15px" /> Ngày cố vấn đánh giá</label>
									<input type="date" class="form-control" name="ngayCoVanDanhGia" id="input_NgayCoVanDanhGia" placeholder="Nhập ngày cố vấn đánh giá...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="input_NgayCoVanKetThucDanhGia" class="form-label" style="color: black; font-weight: 500;"> Ngày cố vấn kết thúc đánh giá</label>
									<input type="date" class="form-control" name="ngayCoVanKetThucDanhGia" id="input_NgayCoVanKetThucDanhGia" placeholder="Nhập ngày cố vấn kết thúc đánh giá...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="input_NgayKhoaDanhGia" class="form-label" style="color: black; font-weight: 500;"><img src="assets/images/icons/office-worker.png" alt="khoa text" width="15px" /> Ngày khoa đánh giá</label>
									<input type="date" class="form-control" name="ngayKhoaDanhGia" id="input_NgayKhoaDanhGia" placeholder="Nhập ngày khoa đánh giá...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="input_NgayKhoaKetThucDanhGia" class="form-label" style="color: black; font-weight: 500;">Ngày khoa kết thúc đánh giá</label>
									<input type="date" class="form-control" name="ngayKhoaKetThucDanhGia" id="input_NgayKhoaKetThucDanhGia" placeholder="Nhập ngày Khoa kết thúc đánh giá...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="input_NgayKhieuNai" class="form-label" style="color: black; font-weight: 500;">Ngày khiếu nại</label>
									<input type="date" class="form-control" name="ngayKhieuNai" id="input_NgayKhieuNai" placeholder="Nhập ngày khiếu nại...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="input_NgayKetThucKhieuNai" class="form-label" style="color: black; font-weight: 500;">Ngày kết thúc khiếu nại</label>
									<input type="date" class="form-control" name="ngayKetThucKhieuNai" id="input_NgayKetThucKhieuNai" placeholder="Nhập ngày kết thúc khiếu nại...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="checkBox_tuDongThongBao">
									<label class="form-check-label" for="checkBox_tuDongThongBao" checked="false">
										Tự động gửi email thông báo
									</label>
								</div>
								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
								<button type="submit" class="btn btn-primary" style='color: white;'>Thêm mới</button>
							</div>
						</div>
					</form>
				</div>

				<!-- Modal Chỉnh sửa -->
				<div class="modal fade" id="ChinhSuaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<form action="" class="modal-dialog" id="EditForm">
						<div class="modal-content">
							<div class="modal-header">
								<img src="assets/images/icons/edit.png" width="25px" style="padding-right: 5px;">
								<h5 class="modal-title" id="exampleModalLabel"> Chỉnh sửa thông báo đánh giá</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">

								<div class="mb-3 form-group">
									<label for="edit_input_MaThongBao" class="form-label" style="color: black; font-weight: 500;">Mã thông báo</label>
									<input type="text" class="form-control" id="edit_input_MaThongBao" placeholder="Nhập mã thông báo..." readonly>
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_input_HocKyNamHocXet" class="form-label" style="color: black; font-weight: 500;">Học kỳ - Năm học đánh giá</label>
									<input type="text" name="hocKyNamHocXet" id="edit_input_HocKyNamHocXet" class="form-control mb-2" placeholder="Học kỳ - Năm học đánh giá sẽ tự động nhập..." readonly>
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_input_NgayThongBao" class="form-label" style="color: black; font-weight: 500;">Ngày thông báo</label>
									<input type="date" class="form-control" name="ngayThongBao" id="edit_input_NgayThongBao" placeholder="Nhập ngày thông báo...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_input_NgaySinhVienDanhGia" class="form-label" style="color: black; font-weight: 500;"><img src="assets/images/icons/student1.png" alt="Student text" width="15px" /> Ngày sinh viên đánh giá</label>
									<input type="date" class="form-control" name="ngaySinhVienDanhGia" id="edit_input_NgaySinhVienDanhGia" placeholder="Nhập ngày sinh viên đánh giá...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_input_NgaySinhVienKetThucDanhGia" class="form-label" style="color: black; font-weight: 500;">Ngày sinh viên kết thúc đánh giá</label>
									<input type="date" class="form-control" name="ngaySinhVienKetThucDanhGia" id="edit_input_NgaySinhVienKetThucDanhGia" placeholder="Nhập ngày sinh viên kết thúc đánh giá...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_input_NgayCoVanDanhGia" class="form-label" style="color: black; font-weight: 500;"><img src="assets/images/icons/presentation2.png" alt="cố vấn text" width="15px" /> Ngày cố vấn đánh giá</label>
									<input type="date" class="form-control" name="ngayCoVanDanhGia" id="edit_input_NgayCoVanDanhGia" placeholder="Nhập ngày cố vấn đánh giá...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_input_NgayCoVanKetThucDanhGia" class="form-label" style="color: black; font-weight: 500;"> Ngày cố vấn kết thúc đánh giá</label>
									<input type="date" class="form-control" name="ngayCoVanKetThucDanhGia" id="edit_input_NgayCoVanKetThucDanhGia" placeholder="Nhập ngày cố vấn kết thúc đánh giá...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_input_NgayKhoaDanhGia" class="form-label" style="color: black; font-weight: 500;"><img src="assets/images/icons/office-worker.png" alt="khoa text" width="15px" /> Ngày khoa đánh giá</label>
									<input type="date" class="form-control" name="ngayKhoaDanhGia" id="edit_input_NgayKhoaDanhGia" placeholder="Nhập ngày khoa đánh giá...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_input_NgayKhoaKetThucDanhGia" class="form-label" style="color: black; font-weight: 500;">Ngày khoa kết thúc đánh giá</label>
									<input type="date" class="form-control" name="ngayKhoaKetThucDanhGia" id="edit_input_NgayKhoaKetThucDanhGia" placeholder="Nhập ngày khoa kết thúc đánh giá...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_input_NgayKhieuNai" class="form-label" style="color: black; font-weight: 500;">Ngày khiếu nại</label>
									<input type="date" class="form-control" name="ngayKhieuNai" id="edit_input_NgayKhieuNai" placeholder="Nhập ngày khiếu nại...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="mb-3 form-group">
									<label for="edit_input_NgayKetThucKhieuNai" class="form-label" style="color: black; font-weight: 500;">Ngày kết thúc khiếu nại</label>
									<input type="date" class="form-control" name="ngayKetThucKhieuNai" id="edit_input_NgayKetThucKhieuNai" placeholder="Nhập ngày kết thúc khiếu nại...">
									<span class="invalid-feedback"></span>
								</div>

								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" id="edit_checkBox_tuDongThongBao" checked="false">
									<label class="form-check-label" for="edit_checkBox_tuDongThongBao">
										Tự động gửi email thông báo
									</label>
								</div>
								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
								<button type="sumit" class="btn btn-warning" style='color: white;'>Chỉnh sửa</button>
							</div>
						</div>
					</form>
				</div>

				<!-- Modal gửi email thông báo -->
				<div class="modal fade" id="SendEmailNotificationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<form action="" class="modal-dialog" id="form_send_email_notification">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"> Gửi email thông báo</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">

								<label class="mb-3 form-label" style="color: black; font-weight: 500;">Vui lòng chọn đối tượng muốn gửi email thông báo</label>
								<input type="hidden" name="maThongBao" />

								<div class="mb-3 form-check">
									<input class="form-check-input" type="checkbox" name="options" value="allSinhVien" id="checkAllSinhVien">
									<label class="form-check-label" for="checkAllSinhVien" style="color: black;">
										Thông báo cho tất cả sinh viên
									</label>
								</div>

								<div class="mb-3 form-check">
									<input class="form-check-input" type="checkbox" name="options" value="allCVHT" id="checkAllCVHT">
									<label class="form-check-label" for="checkAllCVHT" style="color: black;">
										Thông báo cho tất cả cố vấn học tập
									</label>
								</div>

								<div class="mb-3 form-check">
									<input class="form-check-input" type="checkbox" name="options" value="uploadExcel" id="checkUploadExcel">
									<label class="form-check-label" for="checkUploadExcel" style="color: black;">
										Thông báo theo danh sách email trong Excel
									</label>
								</div>

								<div class="mb-3 form-group" style="display:none">
									<input type="file" name="email_file" class="form-control" id="email_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
								<button type="submit" class="btn" style='color: white;background: dodgerblue;'>Gửi</button>
							</div>
						</div>
					</form>
				</div>


				<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
						<div class="app-card-body">
							<div class="table-responsive">
								<table class="table app-table-hover mb-0 text-center">
									<thead>
										<tr>
											<th class="cell">STT</th>
											<th class="cell">Mã thông báo</th>
											<th class="cell">Mã học kỳ</th>
											<th class="cell">Học kỳ - Năm học</th>
											<th class="cell">Ngày thông báo</th>
											<th class="cell">Ngày sinh viên đánh giá</th>
											<th class="cell">Ngày sinh viên kết thúc đánh giá</th>
											<th class="cell">Ngày cố vấn đánh giá</th>
											<th class="cell">Ngày cố vấn kết thúc đánh giá</th>
											<th class="cell">Ngày Khoa đánh giá</th>
											<th class="cell">Ngày Khoa kết thúc đánh giá</th>
											<th class="cell">Ngày khiếu nại</th>
											<th class="cell">Ngày kết thúc khiếu nại</th>
											<th class="cell" style="width:95px">Tự động thông báo email</th>
											<th class="cell" style="width:185px">Hành động</th>
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
<script src="assets/js/thongbaodanhgia/function.js"></script>


<!-- Form Validator -->
<script src="./assets/js/validator.js"></script>


<script>
	Validator({
        form: '#AddForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isPositiveNumber('#select_HocKyXet', 'Học kỳ đánh giá chỉ bao gồm các giá trị: 1, 2, 3'),
			Validator.minNumber('#select_HocKyXet', 1, "Học kỳ đánh giá chỉ bao gồm các giá trị: 1, 2, 3"),
			Validator.maxNumber('#select_HocKyXet', 3, "Học kỳ đánh giá chỉ bao gồm các giá trị: 1, 2, 3"),
			Validator.isRequired('#input_NamHocBatDau', 'Vui lòng nhập năm học bắt đầu và kết thúc'),
			Validator.isPositiveNumber('#input_NamHocBatDau', 'Năm học bắt đầu chỉ bao gồm các ký tự số'),
			Validator.minLength('#input_NamHocBatDau', 4, 'Năm học bắt đầu phải có tối thiểu 4 chữ số'),
			Validator.compare(
				'#input_NamHocBatDau', 
				function() {
					return document.querySelector('#AddForm #input_NamHocKetThuc').value;
				}, 
				`Năm học bắt đầu phải nhỏ hơn năm học kết thúc`, 
				-1),
			Validator.isRequired('#input_NamHocKetThuc', 'Vui lòng nhập năm học bắt đầu và kết thúc'),
			Validator.isPositiveNumber('#input_NamHocKetThuc', 'Năm học kết thúc chỉ bao gồm các ký tự số'),
			Validator.minLength('#input_NamHocKetThuc', 4, 'Năm học kết thúc phải có tối thiểu 4 chữ số'),
			Validator.compare(
				'#input_NamHocKetThuc', 
				function() {
					return document.querySelector('#AddForm #input_NamHocBatDau').value;
				}, 
				`Năm học kết thúc phải lớn hơn năm học bắt đầu`, 
				1),
			Validator.isRequired('#input_NgayThongBao', 'Vui lòng nhập ngày thông báo'),
			Validator.isInDateRange(
				'#input_NgayThongBao', 
				function() {
					var _input_namHocBatDau = $("#AddForm #input_NamHocBatDau").val();

					return `${_input_namHocBatDau}-01-01`;
				},
				function() {
					var _input_namHocKetThuc = $("#AddForm #input_NamHocKetThuc").val();

					return `${_input_namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#input_NgaySinhVienDanhGia', 'Vui lòng nhập ngày sinh viên đánh giá'),
			Validator.isEventDay('#input_NgaySinhVienDanhGia', function() {
				return document.querySelector('#AddForm #input_NgayThongBao').value;
			}, "Ngày sinh viên đánh giá phải diễn ra sau ngày thông báo", true),
			Validator.isInDateRange(
				'#input_NgaySinhVienDanhGia', 
				function() {
					var _input_namHocBatDau = $("#AddForm #input_NamHocBatDau").val();

					return `${_input_namHocBatDau}-01-01`;
				},
				function() {
					var _input_namHocKetThuc = $("#AddForm #input_NamHocKetThuc").val();

					return `${_input_namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#input_NgaySinhVienKetThucDanhGia', 'Vui lòng nhập ngày sinh viên kết thúc đánh giá'),
			Validator.isEventDay('#input_NgaySinhVienKetThucDanhGia', function() {
				return document.querySelector('#AddForm #input_NgaySinhVienDanhGia').value;
			}, "Ngày sinh viên kết thúc đánh giá phải diễn ra sau ngày sinh viên đánh giá", true),
			Validator.isInDateRange(
				'#input_NgaySinhVienKetThucDanhGia', 
				function() {
					var _input_namHocBatDau = $("#AddForm #input_NamHocBatDau").val();

					return `${_input_namHocBatDau}-01-01`;
				},
				function() {
					var _input_namHocKetThuc = $("#AddForm #input_NamHocKetThuc").val();

					return `${_input_namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#input_NgayCoVanDanhGia', 'Vui lòng nhập ngày cố vấn đánh giá'),
			Validator.isEventDay('#input_NgayCoVanDanhGia', function() {
				return document.querySelector('#AddForm #input_NgaySinhVienKetThucDanhGia').value;
			}, "Ngày cố vấn đánh giá phải diễn ra sau ngày sinh viên kết thúc đánh giá", true),
			Validator.isInDateRange(
				'#input_NgayCoVanDanhGia', 
				function() {
					var _input_namHocBatDau = $("#AddForm #input_NamHocBatDau").val();

					return `${_input_namHocBatDau}-01-01`;
				},
				function() {
					var _input_namHocKetThuc = $("#AddForm #input_NamHocKetThuc").val();

					return `${_input_namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#input_NgayCoVanKetThucDanhGia', 'Vui lòng nhập ngày cố vấn kết thúc đánh giá'),
			Validator.isEventDay('#input_NgayCoVanKetThucDanhGia', function() {
				return document.querySelector('#AddForm #input_NgayCoVanDanhGia').value;
			}, "Ngày cố vấn kết thúc đánh giá phải diễn ra sau ngày cố vấn đánh giá", true),
			Validator.isInDateRange(
				'#input_NgayCoVanKetThucDanhGia', 
				function() {
					var _input_namHocBatDau = $("#AddForm #input_NamHocBatDau").val();

					return `${_input_namHocBatDau}-01-01`;
				},
				function() {
					var _input_namHocKetThuc = $("#AddForm #input_NamHocKetThuc").val();

					return `${_input_namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#input_NgayKhoaDanhGia', 'Vui lòng nhập ngày khoa đánh giá'),
			Validator.isEventDay('#input_NgayKhoaDanhGia', function() {
				return document.querySelector('#AddForm #input_NgayCoVanKetThucDanhGia').value;
			}, "Ngày khoa đánh giá phải diễn ra sau ngày cố vấn kết thúc đánh giá", true),
			Validator.isInDateRange(
				'#input_NgayKhoaDanhGia', 
				function() {
					var _input_namHocBatDau = $("#AddForm #input_NamHocBatDau").val();

					return `${_input_namHocBatDau}-01-01`;
				},
				function() {
					var _input_namHocKetThuc = $("#AddForm #input_NamHocKetThuc").val();

					return `${_input_namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#input_NgayKhoaKetThucDanhGia', 'Vui lòng nhập ngày khoa kết thúc đánh giá'),
			Validator.isEventDay('#input_NgayKhoaKetThucDanhGia', function() {
				return document.querySelector('#AddForm #input_NgayKhoaDanhGia').value;
			}, "Ngày khoa kết thúc đánh giá phải diễn ra sau ngày khoa đánh giá", true),
			Validator.isInDateRange(
				'#input_NgayKhoaKetThucDanhGia', 
				function() {
					var _input_namHocBatDau = $("#AddForm #input_NamHocBatDau").val();

					return `${_input_namHocBatDau}-01-01`;
				},
				function() {
					var _input_namHocKetThuc = $("#AddForm #input_NamHocKetThuc").val();

					return `${_input_namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#input_NgayKhieuNai', 'Vui lòng nhập ngày khiếu nại'),
			Validator.isEventDay('#input_NgayKhieuNai', function() {
				return document.querySelector('#AddForm #input_NgayKhoaKetThucDanhGia').value;
			}, "Ngày khiếu nại phải diễn ra sau ngày khoa kết thúc đánh giá", true),
			Validator.isInDateRange(
				'#input_NgayKhieuNai', 
				function() {
					var _input_namHocBatDau = $("#AddForm #input_NamHocBatDau").val();

					return `${_input_namHocBatDau}-01-01`;
				},
				function() {
					var _input_namHocKetThuc = $("#AddForm #input_NamHocKetThuc").val();

					return `${_input_namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#input_NgayKetThucKhieuNai', 'Vui lòng nhập ngày kết thúc khiếu nại'),
			Validator.isEventDay('#input_NgayKetThucKhieuNai', function() {
				return document.querySelector('#AddForm #input_NgayKhieuNai').value;
			}, "Ngày kết thúc khiếu nại phải diễn ra sau ngày khiếu nại", true),
			Validator.isInDateRange(
				'#input_NgayKetThucKhieuNai', 
				function() {
					var _input_namHocBatDau = $("#AddForm #input_NamHocBatDau").val();

					return `${_input_namHocBatDau}-01-01`;
				},
				function() {
					var _input_namHocKetThuc = $("#AddForm #input_NamHocKetThuc").val();

					return `${_input_namHocKetThuc}-12-31`;
				}
			),
        ],
        onSubmit: ThemMoi
    })
	  
	Validator({
        form: '#EditForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isRequired('#edit_input_MaThongBao', 'Vui lòng nhập mã thông báo'),
			Validator.isNumber('#edit_input_MaThongBao', 'Mã thông báo chỉ bao gồm các ký tự số'),
			Validator.isRequired('#edit_input_NgayThongBao', 'Vui lòng nhập ngày thông báo'),
			Validator.isInDateRange(
				'#edit_input_NgayThongBao', 
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocBatDau = nienKhoa.split("-")[0];

					return `${namHocBatDau}-01-01`;
				},
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocKetThuc = nienKhoa.split("-")[1];

					return `${namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#edit_input_NgaySinhVienDanhGia', 'Vui lòng nhập ngày sinh viên đánh giá'),
			Validator.isEventDay('#edit_input_NgaySinhVienDanhGia', function() {
				return document.querySelector('#EditForm #edit_input_NgayThongBao').value;
			}, "Ngày sinh viên đánh giá phải diễn ra sau ngày thông báo", true),
			Validator.isInDateRange(
				'#edit_input_NgaySinhVienDanhGia', 
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocBatDau = nienKhoa.split("-")[0];

					return `${namHocBatDau}-01-01`;
				},
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocKetThuc = nienKhoa.split("-")[1];

					return `${namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#edit_input_NgaySinhVienKetThucDanhGia', 'Vui lòng nhập ngày sinh viên kết thúc đánh giá'),
			Validator.isEventDay('#edit_input_NgaySinhVienKetThucDanhGia', function() {
				return document.querySelector('#EditForm #edit_input_NgaySinhVienDanhGia').value;
			}, "Ngày sinh viên kết thúc đánh giá phải diễn ra sau ngày sinh viên đánh giá", true),
			Validator.isInDateRange(
				'#edit_input_NgaySinhVienKetThucDanhGia', 
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocBatDau = nienKhoa.split("-")[0];

					return `${namHocBatDau}-01-01`;
				},
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocKetThuc = nienKhoa.split("-")[1];

					return `${namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#edit_input_NgayCoVanDanhGia', 'Vui lòng nhập ngày cố vấn đánh giá'),
			Validator.isEventDay('#edit_input_NgayCoVanDanhGia', function() {
				return document.querySelector('#EditForm #edit_input_NgaySinhVienKetThucDanhGia').value;
			}, "Ngày cố vấn đánh giá phải diễn ra sau ngày sinh viên kết thúc đánh giá", true),
			Validator.isInDateRange(
				'#edit_input_NgayCoVanDanhGia', 
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocBatDau = nienKhoa.split("-")[0];

					return `${namHocBatDau}-01-01`;
				},
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocKetThuc = nienKhoa.split("-")[1];

					return `${namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#edit_input_NgayCoVanKetThucDanhGia', 'Vui lòng nhập ngày cố vấn kết thúc đánh giá'),
			Validator.isEventDay('#edit_input_NgayCoVanKetThucDanhGia', function() {
				return document.querySelector('#EditForm #edit_input_NgayCoVanDanhGia').value;
			}, "Ngày cố vấn kết thúc đánh giá phải diễn ra sau ngày cố vấn đánh giá", true),
			Validator.isInDateRange(
				'#edit_input_NgayCoVanKetThucDanhGia', 
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocBatDau = nienKhoa.split("-")[0];

					return `${namHocBatDau}-01-01`;
				},
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocKetThuc = nienKhoa.split("-")[1];

					return `${namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#edit_input_NgayKhoaDanhGia', 'Vui lòng nhập ngày khoa đánh giá'),
			Validator.isEventDay('#edit_input_NgayKhoaDanhGia', function() {
				return document.querySelector('#EditForm #edit_input_NgayCoVanKetThucDanhGia').value;
			}, "Ngày khoa đánh giá phải diễn ra sau ngày cố vấn kết thúc đánh giá", true),
			Validator.isInDateRange(
				'#edit_input_NgayKhoaDanhGia', 
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocBatDau = nienKhoa.split("-")[0];

					return `${namHocBatDau}-01-01`;
				},
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocKetThuc = nienKhoa.split("-")[1];

					return `${namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#edit_input_NgayKhoaKetThucDanhGia', 'Vui lòng nhập ngày khoa kết thúc đánh giá'),
			Validator.isEventDay('#edit_input_NgayKhoaKetThucDanhGia', function() {
				return document.querySelector('#EditForm #edit_input_NgayKhoaDanhGia').value;
			}, "Ngày khoa kết thúc đánh giá phải diễn ra sau ngày khoa đánh giá", true),
			Validator.isInDateRange(
				'#edit_input_NgayKhoaKetThucDanhGia', 
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocBatDau = nienKhoa.split("-")[0];

					return `${namHocBatDau}-01-01`;
				},
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocKetThuc = nienKhoa.split("-")[1];

					return `${namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#edit_input_NgayKhieuNai', 'Vui lòng nhập ngày khiếu nại'),
			Validator.isEventDay('#edit_input_NgayKhieuNai', function() {
				return document.querySelector('#EditForm #edit_input_NgayKhoaKetThucDanhGia').value;
			}, "Ngày khiếu nại phải diễn ra sau ngày khoa kết thúc đánh giá", true),
			Validator.isInDateRange(
				'#edit_input_NgayKhieuNai', 
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocBatDau = nienKhoa.split("-")[0];

					return `${namHocBatDau}-01-01`;
				},
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocKetThuc = nienKhoa.split("-")[1];

					return `${namHocKetThuc}-12-31`;
				}
			),
			Validator.isRequired('#edit_input_NgayKetThucKhieuNai', 'Vui lòng nhập ngày kết thúc khiếu nại'),
			Validator.isEventDay('#edit_input_NgayKetThucKhieuNai', function() {
				return document.querySelector('#EditForm #edit_input_NgayKhieuNai').value;
			}, "Ngày kết thúc khiếu nại phải diễn ra sau ngày khiếu nại", true),
			Validator.isInDateRange(
				'#edit_input_NgayKetThucKhieuNai', 
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocBatDau = nienKhoa.split("-")[0];

					return `${namHocBatDau}-01-01`;
				},
				function() {
					var _input_HocKyNamHocXet = $("#EditForm #edit_input_HocKyNamHocXet").val();
					var nienKhoaIndex = _input_HocKyNamHocXet.indexOf("Năm học: ") + 9;
					var nienKhoa = _input_HocKyNamHocXet.substring(nienKhoaIndex);
					var namHocKetThuc = nienKhoa.split("-")[1];

					return `${namHocKetThuc}-12-31`;
				}
			),
        ],
        onSubmit: ChinhSua_ThongBaoDanhGia
    })

	function onlyLettersAndNumbers(str) {
		return /^[A-Za-z0-9]*$/.test(str);
	}

	function xuLyTimKiemMaHKDG() {
		var _input_timKiemMaHKDG = $('#input_timKiemMaHKDG').val().trim();

		if (_input_timKiemMaHKDG != '') {
			if(onlyLettersAndNumbers(_input_timKiemMaHKDG)){
				TimKiemThongBaoDanhGia(_input_timKiemMaHKDG);
			} else {
				Swal.fire({
					icon: "error",
					title: "Lỗi",
					text: "Mã học kỳ không hợp lệ!",
					timer: 2000,
					timerProgressBar: true,
				});
			}
		}
	}

	//hàm trong function.js
	GetListThongBaoDanhGia();

	$('#btn_timKiemMaHKDG').on('click', function() {
		xuLyTimKiemMaHKDG();
	});

	$('#input_timKiemMaHKDG').keypress(function (e) {
		var key = e.which;
		if(key == 13)  // the 'Enter' code
		{
			$('#btn_timKiemMaHKDG').click();
		}
	}); 

	$('#input_timKiemMaHKDG').change(function (e) {
		if(!$('#input_timKiemMaHKDG').val()) {
			GetListKhoa();
		} 
	}); 

	// Xử lý chỉnh sửa thông báo đánh giá
	$(document).on("click", ".btn_ChinhSua_ThongBaoDanhGia" ,function() {
		var maThongBao = $(this).attr('data-id');
		
		$('#edit_input_MaThongBao').val(maThongBao);

		LoadThongTinChinhSua_ThongBaoDanhGia(maThongBao);

		$("#EditForm #edit_input_MaThongBao").removeClass("is-invalid");
		$("#EditForm #edit_input_NgayThongBao").removeClass("is-invalid");
		$("#EditForm #edit_input_NgaySinhVienDanhGia").removeClass("is-invalid");
		$("#EditForm #edit_input_NgaySinhVienKetThucDanhGia").removeClass("is-invalid");
		$("#EditForm #edit_input_NgayCoVanDanhGia").removeClass("is-invalid");
		$("#EditForm #edit_input_NgayCoVanKetThucDanhGia").removeClass("is-invalid");
		$("#EditForm #edit_input_NgayKhoaDanhGia").removeClass("is-invalid");
		$("#EditForm #edit_input_NgayKhoaKetThucDanhGia").removeClass("is-invalid");
	})
	
	// Xử lý xóa thông báo đánh giá
	$(document).on("click", ".btn_Xoa_ThongBaoDanhGia" ,function() {
		var maThongBao = $(this).attr('data-id');

		XoaThongBaoDanhGia(maThongBao);
	})

	// Xử lý click nút gửi email thông báo
	$(document).on("click", ".btn_GuiEmail_ThongBaoDanhGia" ,function() {
		var maThongBao = $(this).attr('data-id');

		$('#form_send_email_notification').trigger("reset");

		$("#form_send_email_notification input[name='maThongBao']").val(maThongBao);

		$('#form_send_email_notification input[name="email_file"]').parent().hide();
	})

	$('#form_send_email_notification #checkUploadExcel').change(function(e) {
		if (this.checked) {
			$('#form_send_email_notification input[name="email_file"]').parent().show();
		} else {
			$('#form_send_email_notification input[name="email_file"]').parent().hide();
		}
	});

	$('#form_send_email_notification').submit(function(e) {
		e.preventDefault();

		if ($("#form_send_email_notification input[name='options']:checked").length > 0) {
			var options = [];
			var formData = new FormData(this);

			// Kiểm tra đã upload file chưa khi chọn option 'uploadExcel'
			if ($("#form_send_email_notification #checkUploadExcel").is(":checked")) {
				if(document.querySelector("#form_send_email_notification input[name='email_file']").files.length == 0 ){
					Swal.fire({
						icon: "error",
						title: "Lỗi",
						text: "Vui lòng upload file excel để tiếp tục!",
						timer: 2000,
						timerProgressBar: true,
					});

					return;
				}
			}

			$("#form_send_email_notification input[name='options']:checked").each(function (index, input) {
				options.push(input.value);
			});

			formData.append("options", options);

			$('#form_send_email_notification button[type=submit]').text("Đang xử lý...");
			$('#form_send_email_notification button[type=submit]').prop('disabled', true);

			$.ajax({
				url: 'http://localhost/WebDRL/phpmailer/send_email/sendEmailThongBaoDanhGia.php',
				type: "POST",
				data: formData,
				processData: false, 
				contentType: false,
				enctype: 'multipart/form-data',
				mimeType: 'multipart/form-data',
				success: function (result) {
					$('#form_send_email_notification button[type=submit]').text("Gửi");
					$('#form_send_email_notification button[type=submit]').prop('disabled', false);
					
					result = JSON.parse(result);

					if(result.success) {
						Swal.fire({
							icon: "success",
							title: "Thành công",
							text: result.message,
							timer: 2000,
							timerProgressBar: true,
							showCloseButton: true,
						});
					} else {
						Swal.fire({
							icon: "error",
							title: "Thất bại!",
							text: result.message,
							timerProgressBar: true,
							showCloseButton: true,
						});
					}
				},
			});
		} 
	});
</script>
