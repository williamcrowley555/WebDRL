<?php include_once('header.php'); ?>


<div class="app-wrapper">

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
										<input type="text" id="input_timKiemMaSinhVien" name="" class="form-control" placeholder="Nhập mã số sinh viên...">
									</div>
									<div class="col-auto">
										<button type="button" onclick="return TimKiemSinhVien($('#input_timKiemMaSinhVien').val());" class="btn app-btn-secondary">Tìm kiếm</button>
									</div>

									<div class="col-auto" style="padding-left: 15px;">
										<button class="btn app-btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#AddModal">Thêm mới</button>
									</div>

									<div class="col-auto" style="padding-left: 15px;">
										<button class="btn app-btn-primary" type="button" data-bs-toggle="" data-bs-target="#" disabled>Import danh sách</button>
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
								<img src="assets/images/icons/add.png" width="25px" style="padding-right: 5px;">
								<h5 class="modal-title" id="exampleModalLabel"> Thêm sinh viên</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">

								<div class="mb-3">
									<label for="input_MaSinhVien" class="form-label" style="color: black; font-weight: 500;">Mã sinh viên</label>
									<input type="text" class="form-control mb-2" id="input_MaSinhVien" placeholder="Nhập mã sinh viên...">
								</div>

								<div class="mb-3">
									<label for="input_HoTenSinhVien" class="form-label" style="color: black; font-weight: 500;">Họ tên sinh viên</label>
									<input type="text" class="form-control" id="input_HoTenSinhVien" placeholder="Nhập họ tên sinh viên...">
								</div>

								<div class="mb-3">
									<label for="input_NgaySinh" class="form-label" style="color: black; font-weight: 500;">Ngày sinh</label>
									<input type="date" class="form-control" id="input_NgaySinh" placeholder="Nhập ngày sinh...">
								</div>

								<div class="mb-3">
									<label for="select_Lop_Add" class="form-label" style="color: black; font-weight: 500;">Lớp</label>
									<select class="form-select" aria-label="Default select example" id="select_Lop_Add">

									</select>
								</div>
								<p></p>
								<hr>
								<div class="mb-3">
									<span style="color: black; font-weight: bold; text-transform: uppercase;font-size: 15px;">Mật khẩu đăng nhập mặc định là Mã sinh viên!</span>
								</div>

								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
								<button type="button" class="btn btn-primary" style='color: white;' onclick="return ThemMoi()">Thêm mới</button>
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
									<label for="input_MaSinhVien_Update" class="form-label" style="color: black; font-weight: 500;">Mã sinh viên</label>
									<input type="text" class="form-control mb-2" id="input_MaSinhVien_Update" placeholder="Nhập mã sinh viên..." disabled>
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
											<th class="cell">Mã số sinh viên</th>
											<th class="cell">Họ tên sinh viên</th>
											<th class="cell">Ngày sinh</th>
											<th class="cell">Hệ</th>
											<th class="cell">Lớp</th>
											<th class="cell"></th>
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
<script src="assets/js/sinhvien/function.js"></script>


<script src="assets/js/jquery-3.6.0.js"></script>
<!-- Pagination -->
<script src="assets/js/pagination.min.js"></script>

<link rel="stylesheet" href="assets/css/pagination.css"/>
<script>
	setTimeout(function() {
		$('.loader_bg').fadeToggle();
	}, 1000);

	var maKhoa_selected = 'tatcakhoa';
	var maLop_selected = 'tatcalop';

	//hàm trong function.js
	GetListSinhVien(maKhoa_selected, maLop_selected);

	$('#select_Khoa').on('change', function(){
		var maKhoa_selected = $('#select_Khoa').val();
		var maLop_selected = $('#select_Lop').val();

		GetListSinhVien(maKhoa_selected, maLop_selected);
	
	});

	$('#select_Lop').on('change', function(){
		var maKhoa_selected = $('#select_Khoa').val();
		var maLop_selected = $('#select_Lop').val();

		GetListSinhVien(maKhoa_selected, maLop_selected);
	
	});

	$('#input_timKiemMaSinhVien').on('change', function(){
		var _input_timKiemMaSinhVien = $('#input_timKiemMaSinhVien').val();
		
		if (_input_timKiemMaSinhVien != ''){
			TimKiemSinhVien(_input_timKiemMaSinhVien);
		}
		
	
	});
	
	LoadComboBoxThongTinLop(); //Load combobox trong modal thêm mới
 
	LoadComboBoxThongTinKhoa();

	$('#select_Khoa').on('change', function(){
		var maLop_selected = $('#select_Khoa').val();
	
		LoadComboBoxThongTinLopTheoKhoa(maLop_selected);
	
	});


	//Dat lai mat khau
	$(document).ready(function(){
		$('.btn_DatLaiMatKhau').on('click', function(){
			var maSinhVien = $(this).attr('data-id');
		
			$('#input_MaSinhVien_Update').val(maSinhVien);
			
			//DatLaiMatKhau(maSinhVien);
		})
	});

</script>
</body>


</html>