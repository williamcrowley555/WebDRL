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
<script src="assets/js/quantrivien/function.js"></script>

<script>
	tableQuanTriVienTitle.forEach(function(title, index) {
		$("#tableQuanTriVien>thead>tr").append(`<th class='cell'>${title}</th>`);

		if(index == tableQuanTriVienTitle.length - 1) {
			$("#tableQuanTriVien>thead>tr").append(`<th class='cell'>Hành động</th>`);
		}
	});

</script>