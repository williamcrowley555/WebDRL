<?php include_once('header.php'); ?>


<div class="app-wrapper">

	<div class="app-content pt-3 p-md-3 p-lg-4">
		<div class="container-xl">

			<h1 class="app-page-title">.</h1>
			<h1 class="app-page-title"><img src="assets/images/icons/presentation.png" alt="" width="30px">  Cố vấn học tập</h1>

			<div class="row g-4 mb-4">

				<div class="col-auto">
					<div class="page-utilities">
						<div class="row g-2 justify-content-start justify-content-md-end align-items-center">

							<div class="col-auto">

								<select class="form-select w-auto">
									<option selected value="option-1">Tất cả khoa</option>
									<option value="option-2">Công nghệ thông tin</option>
									<option value="option-3">Điện tử viễn thông</option>
								</select>
							</div>

							
							<div class="col-auto">
								<form class="table-search-form row gx-1 align-items-center">
									<div class="col-auto">
										<input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Nhập mã lớp...">
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

				<!-- Modal thêm -->
				<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">	
						<div class="modal-content">
							<div class="modal-header">
								<img src="assets/images/icons/add.png" width="25px" style="padding-right: 5px;" > 
								<h5 class="modal-title" id="exampleModalLabel"> Thêm cố vấn học tập</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
						<div class="modal-body">

						<div class="mb-3">
							<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;" >Mã cố vấn học tập</label>
							<input type="text" class="form-control" id="inputMaCoVanHocTap" placeholder="Nhập mã cố vấn học tập..." >
						</div>

						<div class="mb-3">
							<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;" >Họ tên cố vấn học tập</label>
							<input type="text" class="form-control" id="inputTenCoVanHocTap" placeholder="Nhập họ tên cố vấn học tập..." >
						</div>

						<div class="mb-3">
							<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;" >Số điện thoại</label>
							<input type="text" class="form-control" id="inputSoDienThoai" placeholder="Nhập số điện thoại..." >
						</div>

						<hr>
						 <span style="text-transform: uppercase;color: black;"><img src="assets/images/icons/lock.png" alt="" style="width: 20px;"> Thông tin mật khẩu</span>
						<hr>

						<div class="mb-3">
							<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;" >Mật khẩu mới</label>
							<input type="password" class="form-control" id="inputMatKhauMoi" placeholder="Nhập mật khẩu..." >
						</div>

						<div class="mb-3">
							<label for="inputMaCoVanHocTap" class="form-label" style="color: black; font-weight: 500;" >Nhập lại mật khẩu</label>
							<input type="password" class="form-control" id="inputNhapLaiMatKhau" placeholder="Nhập lại mật khẩu..." >
						</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="button" class="btn btn-primary" style='color: white;' onclick="ThemCVHT()">Thêm mới</button>
						</div>
						</div>
					</div>
				</div>

				<!-- Modal reset password -->
				<div class="modal fade" id="DatLaiMatKhauModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"> Đặt lại mật khẩu</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">

								<div class="mb-3">
									<label for="input_CoVanHocTap_Update" class="form-label" style="color: black; font-weight: 500;">Mã cố vấn học tập</label>
									<input type="text" class="form-control mb-2" id="input_CoVanHocTap_Update" placeholder="Nhập mã cố vấn học tập..." disabled>
								</div>


								<div class="mb-3">
									<label for="input_MatKhauMoi" class="form-label" style="color: black; font-weight: 500;">Mật khẩu mới</label>
									<input type="password" class="form-control" id="input_MatKhauMoi" placeholder="Nhập mật khẩu mới...">
								</div>

								<div class="mb-3">
									<label for="input_NhapLaiMatKhauMoi" class="form-label" style="color: black; font-weight: 500;">Nhập lại Mật khẩu mới</label>
									<input type="password" class="form-control" id="input_NhapLaiMatKhauMoi" placeholder="Nhập lại mật khẩu mới...">
								</div>

								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
								<button type="button" class="btn btn-info" style='color: white;' onclick="return DatLaiMatKhau()">Đặt lại mật khẩu</button>
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
											<th class="cell">Mã cố vấn học tập</th>
											<th class="cell">Họ tên cố vấn</th>
											<th class="cell">Số điện thoại</th>
											<th class="cell"></th>
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
<script src="assets/js/covanhoctap/function.js"></script>


<script src="assets/js/jquery-3.6.0.js"></script>
<!-- Pagination -->
<script src="assets/js/pagination.min.js"></script>

<link rel="stylesheet" href="assets/css/pagination.css"/>
<script>
	setTimeout(function() {
		$('.loader_bg').fadeToggle();
	}, 1000);

	//hàm trong function.js
	GetListCVHT();
 

	//Dat lai mat khau
	$(document).ready(function(){
		$('.btn_DatLaiMatKhau').on('click', function(){
			var maSinhVien = $(this).attr('data-id');
		
			$('#input_CoVanHocTap_Update').val(maSinhVien);
			
		
		})
	});


</script>
</body>


</html>