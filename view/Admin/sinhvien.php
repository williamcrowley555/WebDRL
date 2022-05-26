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
								</div>

							</div>
							<!--//col-->


						</div>
						<!--//row-->
					</div>
					<!--//table-utilities-->
				</div>
				<!--//col-auto-->

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
	
 
	LoadComboBoxThongTinKhoa();

	$('#select_Khoa').on('change', function(){
		var maLop_selected = $('#select_Khoa').val();
	
		LoadComboBoxThongTinLopTheoKhoa(maLop_selected);
	
	});

</script>
</body>


</html>