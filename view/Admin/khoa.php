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

						<!-- <div class="col-auto">

								<select class="form-select w-auto">
									<option selected value="option-1">Tất cả khoa</option>
									<option value="option-2">Công nghệ thông tin</option>
									<option value="option-3">Điện tử viễn thông</option>
								</select>
							</div> -->


						<div class="col-auto">
							<form class="table-search-form row gx-1 align-items-center">
								<div class="col-auto">
									<input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Nhập mã khoa">
								</div>
								<div class="col-auto">
									<button type="submit" class="btn app-btn-secondary">Tìm kiếm</button>
								</div>
							</form>

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

			<!-- Modal chỉnh sửa -->
			<div class="modal fade" id="ChinhSuaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<img src="assets/images/icons/edit.png" width="25px" style="padding-right: 5px;">
							<h5 class="modal-title" id="exampleModalLabel"> Chỉnh sửa Khoa</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3">
								<label for="edit_input_MaKhoa" class="form-label" style="color: black; font-weight: 500;">Mã khoa</label>
								<input type="text" class="form-control mb-2" id="edit_input_MaKhoa" placeholder="Nhập mã lớp..." readonly>
							</div>
							<div class="mb-3">
								<label for="edit_input_TenKhoa" class="form-label" style="color: black; font-weight: 500;">Tên khoa</label>
								<input type="text" class="form-control mb-2" id="edit_input_TenKhoa" placeholder="Nhập tên khoa...">
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="button" class="btn btn-warning" style='color: white;' onclick="return ChinhSua_Khoa()">Chỉnh sửa</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal đặt lại mật khẩu-->
			<div class="modal fade" id="DatLaiMatKhauModal" tabindex="-1" aria-labelledby="ModalDatLaiMatKhauLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Đặt lại mật khẩu</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<label for="input_MaKhoa" class="form-label" style="color: black; font-weight: 500;">Mã khoa</label>
								<input type="text" class="form-control" id="input_MaKhoa_DLMK" placeholder="Nhập mã khoa..." disabled>
							</div>

							<div class="mb-3">
								<label for="input_MatKhauMoi" class="form-label" style="color: black; font-weight: 500;">Mật khẩu mới</label>
								<input type="password" class="form-control" id="input_MatKhauMoi" placeholder="Nhập mật khẩu mới...">
							</div>

							<div class="mb-3">
								<label for="input_NhapLaiMatKhau" class="form-label" style="color: black; font-weight: 500;">Xác nhận mật khẩu</label>
								<input type="password" class="form-control" id="input_NhapLaiMatKhau" placeholder="Nhập lại mật khẩu mới...">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="button" class="btn btn-primary" style="color: white;"  onclick="return DatLaiMatKhau_Khoa()">Xác nhận</button>
						</div>
					</div>
				</div>
			</div>


			<!-- Modal thêm -->
			<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<img src="assets/images/icons/add.png" width="25px" style="padding-right: 5px;">
							<h5 class="modal-title" id="exampleModalLabel"> Thêm Khoa</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Mã khoa</label>
								<input type="text" class="form-control" id="add_input_MaKhoa" placeholder="Nhập mã khoa...">
							</div>

							<div class="mb-3">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Tên khoa</label>
								<input type="text" class="form-control" id="add_input_TenKhoa" placeholder="Nhập tên khoa...">
							</div>

							<div class="mb-3">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Tài khoản khoa</label>
								<input type="text" class="form-control" id="add_input_TaiKhoanKhoa" placeholder="Nhập tài khoản khoa...">
							</div>

							<hr>
							<span style="text-transform: uppercase;color: black;"><img src="assets/images/icons/lock.png" alt="" style="width: 20px;"> Thông tin mật khẩu</span>
							<hr>

							<div class="mb-3">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Mật khẩu mới</label>
								<input type="password" class="form-control" id="add_input_MatKhau" placeholder="Nhập mật khẩu...">
							</div>

							<div class="mb-3">
								<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;">Nhập lại mật khẩu</label>
								<input type="password" class="form-control" id="add_input_NhapLaiMatKhau" placeholder="Nhập lại mật khẩu...">
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="button" class="btn btn-primary" style='color: white;' onclick="return ThemMoi_Khoa()">Thêm mới</button>
						</div>
					</div>
				</div>
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


<script type="text/javascript">
	//hàm trong function.js
	GetListKhoa();

	$(document).on("click", ".btn_DatLaiMatKhau_Khoa", function() {
		var maKhoa_DLMK = $(this).attr('data-id');

		$('#input_MaKhoa_DLMK').val(maKhoa_DLMK);

	})

	//Xử lý chỉnh sửa
	$(document).on("click", ".btn_ChinhSua_Khoa", function() {

		let maKhoa_edit = $(this).attr('data-id');
		let tenKhoa_edit = $(this).attr('data-tenKhoa');
		let taiKhoanKhoa = $(this).attr('data-taiKhoanKhoa');
		let matKhauKhoa = $(this).attr('data-matKhauKhoa');


		$('#edit_input_MaKhoa').val(maKhoa_edit);
		$('#edit_input_TenKhoa').val(tenKhoa_edit);

	})
</script>