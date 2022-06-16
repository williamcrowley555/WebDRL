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
		$("#menu-button-Lop").removeClass("active");
		
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
										<input type="text" id="inputTimKiem_MaHoatDong" name="inputTimKiem_MaHoatDong" class="form-control search-orders" placeholder="Nhập mã học kỳ...">
									</div>
									<div class="col-auto">
										<button type="button" class="btn app-btn-secondary">Tìm kiếm</button>
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
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<img src="assets/images/icons/add.png" width="25px" style="padding-right: 5px;">
								<h5 class="modal-title" id="exampleModalLabel"> Thêm thông báo đánh giá</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">

								<div class="mb-3">
									<label for="" class="form-label" style="color: black; font-weight: 500;">Học kỳ đánh giá</label>
									<input type="text" class="form-control mb-2" id="input_HocKyXet" placeholder="Nhập học kỳ...">
									<input type="text" class="form-control" id="input_NamHocXet" placeholder="Nhập năm học...">
								</div>

								<div class="mb-3">
									<label for="input_NgayThongBao" class="form-label" style="color: black; font-weight: 500;">Ngày thông báo</label>
									<input type="date" class="form-control" id="input_NgayThongBao" placeholder="Nhập ngày thông báo...">
								</div>

								<div class="mb-3">
									<label for="input_NgaySinhVienDanhGia" class="form-label" style="color: black; font-weight: 500;"><img src="assets/images/icons/student1.png" alt="Student text" width="15px" /> Ngày sinh viên đánh giá</label>
									<input type="date" class="form-control" id="input_NgaySinhVienDanhGia" placeholder="Nhập ngày sinh viên đánh giá...">
								</div>

								<div class="mb-3">
									<label for="input_NgaySinhVienKetThucDanhGia" class="form-label" style="color: black; font-weight: 500;">Ngày sinh viên kết thúc đánh giá</label>
									<input type="date" class="form-control" id="input_NgaySinhVienKetThucDanhGia" placeholder="Nhập ngày sinh viên kết thúc đánh giá...">
								</div>

								<div class="mb-3">
									<label for="input_NgayCoVanDanhGia" class="form-label" style="color: black; font-weight: 500;"><img src="assets/images/icons/presentation2.png" alt="cố vấn text" width="15px" /> Ngày cố vấn đánh giá</label>
									<input type="date" class="form-control" id="input_NgayCoVanDanhGia" placeholder="Nhập ngày cố vấn đánh giá...">
								</div>

								<div class="mb-3">
									<label for="input_NgayCoVanKetThucDanhGia" class="form-label" style="color: black; font-weight: 500;"> Ngày cố vấn kết thúc đánh giá</label>
									<input type="date" class="form-control" id="input_NgayCoVanKetThucDanhGia" placeholder="Nhập ngày cố vấn kết thúc đánh giá...">
								</div>

								<div class="mb-3">
									<label for="input_NgayKhoaDanhGia" class="form-label" style="color: black; font-weight: 500;"><img src="assets/images/icons/office-worker.png" alt="khoa text" width="15px" /> Ngày Khoa đánh giá</label>
									<input type="date" class="form-control" id="input_NgayKhoaDanhGia" placeholder="Nhập ngày khoa đánh giá...">
								</div>

								<div class="mb-3">
									<label for="input_NgayKhoaKetThucDanhGia" class="form-label" style="color: black; font-weight: 500;">Ngày Khoa kết thúc đánh giá</label>
									<input type="date" class="form-control" id="input_NgayKhoaKetThucDanhGia" placeholder="Nhập ngày Khoa kết thúc đánh giá...">
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
											<th class="cell">Mã thông báo</th>
											<th class="cell">Ngày thông báo</th>
											<th class="cell">Học kỳ - Năm học</th>
											<th class="cell"><img src='assets/images/icons/student1.png' alt='Student text' width='15px' /> Ngày sinh viên đánh giá</th>
											<th class="cell">Ngày sinh viên kết thúc đánh giá</th>
											<th class="cell"><img src='assets/images/icons/presentation2.png' alt='cố vấn text' width='15px' />Ngày cố vấn đánh giá</th>
											<th class="cell">Ngày cố vấn kết thúc đánh giá</th>
											<th class="cell"><img src="assets/images/icons/office-worker.png" alt="khoa text" width="15px" />Ngày Khoa đánh giá</th>
											<th class="cell">Ngày Khoa kết thúc đánh giá</th>
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



<!-- Page Specific JS -->
<script src="assets/js/thongbaodanhgia/function.js"></script>

<script>
	

	//hàm trong function.js
	GetListThongBaoDanhGia();

	//LoadThongTinThemMoi();

	// $(document).ready(function(){
	// 	$('.btn_BatDauDiemDanh').on('click', function(){
	// 		var maHoatDong = $(this).attr('data-id');

	// 		DiemDanhHoatDong(maHoatDong);
	// 	})
	// });



</script>
