<?php include_once('header.php'); ?>


<div class="app-wrapper">

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<h1 class="app-page-title">.</h1>
			<h1 class="app-page-title"><img src="assets/images/icons/class.png" alt="" width="30px"> Hoạt động đánh giá</h1>

			<div class="row g-4 mb-4">

				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">

							<div class="col-auto">

							</div>

							
							<div class="col-auto">
								<div class="table-search-form row gx-1 align-items-center" style="padding-bottom: 20px;">
									<div class="col-auto">
										<input type="text" id="inputTimKiem_MaHoatDong" name="inputTimKiem_MaHoatDong" class="form-control search-orders" placeholder="Nhập mã hoạt động..." >
									</div>
									<div class="col-auto">
										<button type="button" class="btn app-btn-secondary">Tìm kiếm</button>
									</div>

									<div class="col-auto" style="padding-left: 15px;">
										<button class="btn app-btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#AddModal">Thêm mới</button>
									</div>
								</div>

								<div class="table-search-form row gx-1 align-items-center">
									<div class="col-auto">
										<p></p>
										<span style="font-weight: 700;">Lọc theo thời gian: </button>
									</div>
									<div class="col-auto">
										<span style="font-weight: 700;" >Thời gian bắt đầu</span>
										<input type="datetime-local" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Nhập mã hoạt động..." >
									</div>
									<div class="col-auto">
										<span style="font-weight: 700;" >Thời gian bắt đầu</span>
										<input type="datetime-local" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Nhập mã hoạt động..." >
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
					<div class="modal-dialog">	
						<div class="modal-content">
							<div class="modal-header">
								<img src="assets/images/icons/add.png" width="25px" style="padding-right: 5px;" > 
								<h5 class="modal-title" id="exampleModalLabel"> Thêm hoạt động đánh giá</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
						<div class="modal-body">

						<div class="mb-3">
							<label for="input_TenHoatDong" class="form-label" style="color: black; font-weight: 500;" >Học kỳ áp dụng</label>
							<select class="form-select" aria-label="Default select example" id="select_HocKyDanhGia">
						
							</select>
						</div>

						<div class="mb-3">
							<label for="input_TenHoatDong" class="form-label" style="color: black; font-weight: 500;" >Tên hoạt động</label>
							<input type="text" class="form-control" id="input_TenHoatDong" placeholder="Nhập tên hoạt động..." >
						</div>

						<div class="mb-3">
							<label for="select_Khoa" class="form-label" style="color: black; font-weight: 500;" >Khoa tổ chức</label>
							<select class="form-select" aria-label="Default select example" id="select_Khoa">
						
							</select>
						</div>

						<div class="mb-3">
							<label for="select_TieuChi" class="form-label" style="color: black; font-weight: 500;" >Tiêu chí được cộng điểm</label>
							<select class="form-select" aria-label="Default select example" id="select_TieuChi">
								
							</select>
						</div>

						<div class="mb-3">
							<label for="input_DiemNhanDuoc" class="form-label" style="color: black; font-weight: 500;" >Điểm nhận được</label>
							<input type="number" class="form-control" id="input_DiemNhanDuoc" placeholder="Nhập điểm nhận được..." >
						</div>

						<div class="mb-3">
							<label for="input_DiaDiemHoatDong" class="form-label" style="color: black; font-weight: 500;" >Địa điểm diễn ra hoạt động (nếu có)</label>
							<input type="text" class="form-control" id="input_DiaDiemHoatDong" placeholder="Nhập địa điểm hoạt động..." >
						</div>

						<div class="mb-3">
							<label for="input_ThoiGianBatDau" class="form-label" style="color: black; font-weight: 500;" >Thời gian bắt đầu</label>
							<input type="datetime-local" class="form-control" id="input_ThoiGianBatDau" placeholder="Nhập thời gian bắt đầu..." >
						</div>

						<div class="mb-3">
							<label for="input_ThoiGianKetThuc" class="form-label" style="color: black; font-weight: 500;" >Thời gian kết thúc</label>
							<input type="datetime-local" class="form-control" id="input_ThoiGianKetThuc" placeholder="Nhập thời gian kết thúc..." >
						</div>

						
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="button" class="btn btn-primary" style='color: white;' onclick="return ThemMoi()">Thêm mới</button>
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
											<th class="cell">Mã hoạt động</th>
											<th class="cell">Tên hoạt động</th>
											<th class="cell">Mã khoa tổ chức</th>
											<th class="cell">Tiêu chí được cộng điểm</th>
											<th class="cell">Điểm nhận được</th>
											<th class="cell">Địa điểm</th>
											<th class="cell">Học kỳ áp dụng</th>
											<th class="cell">Thời gian bắt đầu</th>
											<th class="cell">Thời gian kết thúc</th>
											<th class="cell">Thời gian bắt đầu điểm danh</th>
											<th class="cell">Mã QR điểm danh/checkin</th>
											<th></th>
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

</div>
<!--//app-wrapper-->


<!-- Javascript -->
<script src="assets/plugins/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/sweetalert2.all.min.js"></script>

<!-- Charts JS -->
<script src="assets/plugins/chart.js/chart.min.js"></script>
<script src="assets/js/index-charts.js"></script>

<!-- Page Specific JS -->
<script src="assets/js/app.js"></script>
<script src="assets/js/hoatdongdanhgia/function.js"></script>

<script src="assets/js/jquery-3.6.0.js"></script>
<!-- Pagination -->
<script src="assets/js/pagination.min.js"></script>

<link rel="stylesheet" href="assets/css/pagination.css"/>
<script>
	setTimeout(function() {
		$('.loader_bg').fadeToggle();
	}, 1000);

	//hàm trong function.js
	GetListHoatdongdanhgia();
 
	LoadThongTinThemMoi();

</script>
</body>


</html>