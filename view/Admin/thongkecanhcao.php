<script src="assets/js/check_token.js"></script>

<script>
	//remove class active
	$("#menu-button-QuanTriVien").removeClass("active");
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
	$("#menu-button-CaiDat").removeClass("active");
	$("#menu-button-ThongKe").removeClass("active");

	//add class active
	$("#menu-button-ThongKeCanhCao").addClass("active");

	//set title
	document.title = "Thống kê cảnh cáo | Web điểm rèn luyện";
</script>

<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">

		<h1 class="app-page-title">.</h1>
		<h1 class="app-page-title"><img src="assets/images/icons/bad-score-analytics.png" alt="" width="30px"> Thống kê cảnh cáo</h1>

		<div class="row g-4 mb-4">

			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						<div class="col-auto">
							<select class="form-select w-auto" id="select_Khoa">

							</select>
						</div>

						<div class="col-auto">
							<select class="form-select w-auto" id="select_Lop">

							</select>
						</div>

						<div class="col-auto" style="padding-left: 15px;">
							<button type="button" id="btn_thongKe" class="btn app-btn-primary">Thống kê</button>
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

			<div class="tab-pane fade show active" role="tabpanel" aria-labelledby="orders-all-tab">
				<div class="app-card app-card-orders-table shadow-sm mb-5">
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table app-table-hover mb-0 text-left" id="tableThongKe">
								<thead>
									<tr>

									</tr>
								</thead>
								<tbody id="tbodyThongKe">

								</tbody>
							</table>
						</div>
						<!--//table-responsive-->
						
						
					</div>
					<!--//app-card-body-->
				</div>
				<!--//app-card-->
				<nav class="app-pagination" id="idPhanTrangThongKe">
					<!-- <ul class="pagination justify-content-center" id="idPhanTrang">
							
						</ul> -->
				</nav>
				<!--//app-pagination-->

			</div>
			<!--//tab-pane-->

			<div class="modal fade" id="danhSachPhieuDiemRenLuyenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="bg-light" style="min-width: 100vh; min-height: 100vh;">
					<div class="modal-dialog p-2">
						<div class="modal-content border-0" style="min-width: 700px;min-height:450px;margin-left:-50px;">
							<div class="modal-header">
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<h5 class="text-center"> Danh sách phiếu rèn luyện </h5>
							<span id="maSinhVien" class="fw-bold ps-3"></span>
							<span id="hoTenSinhVien" class="fw-bold ps-3 pb-2"></span>
							<div class="modal-body py-0">
								<div class="tab-content border bg-light" id="nav-tabContent">
									<!-- List tab -->
									<div class="tab-pane fade active show" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
										<div class="table-responsive px-2" id ="DanhSachKetQua">
										<h3 class="form-label" id="maSinhVien_ketQuaHocTap" style="color: black; font-weight: 500;"> </h3>
											<table class="table app-table-hover mb-0 text-left" id="tableDanhSachPhieuRenLuyen">
												<thead>
													<tr>

													</tr>
												</thead>
												<tbody id="tbodyDanhSachPhieuRenLuyen">
													
												</tbody>
											</table>
										</div>
										<!--//table-responsive-->
									</div>

									<!-- Add tab -->					
								</div>

								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							</div>
						</div>
					</div>
				</div>
			</div>

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
<script src="assets/js/thongkecanhcao/function.js"></script>

<script>
	loadCombobox(urlapi_khoa_read, "#select_Khoa", thongBaoLoiComboboxKhoa);

	tableThongKeTitle.forEach(function(title, index) {
		$("#tableThongKe>thead>tr").append(`<th class='cell'>${title}</th>`);

		if(index == tableThongKeTitle.length - 1) {
			$("#tableThongKe>thead>tr").append(`<th class='cell' width='150'>Hành động</th>`);
		}
	});

	tableDanhSachPhieuRenLuyen.forEach(function(title, index) {
		$("#tableDanhSachPhieuRenLuyen>thead>tr").append(`<th class='cell'>${title}</th>`);
	});

	$("#select_Khoa").on("change", function() {
		var maKhoa = $(this).find('option:selected').val();
		loadCombobox(urlapi_lop_read_maKhoa + maKhoa, "#select_Lop", thongBaoLoiComboboxLop);
	});

	$("#btn_thongKe").on("click", function() {
		// console.log("hello");
		loadTableThongKe();
	});

	$(document).on("click", ".btn_xemChiTiet", function() {
		
		var maSinhVien = $(this).attr('data-id');
		var hoTenSinhVien = $(this).attr('data-hoten');
		$("#maSinhVien").empty();
		$("#hoTenSinhVien").empty();
		$("#maSinhVien").append("Mã sinh viên: " + maSinhVien);
		$("#hoTenSinhVien").append("Họ tên sinh viên: " + hoTenSinhVien);
		loadDanhSachPhieuRenLuyen(maSinhVien);
	});
</script>