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

	//add class active
	$("#menu-button-ThongKe").addClass("active");

	//set title
	document.title = "Thống kê | Web điểm rèn luyện";
</script>

<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">

		<h1 class="app-page-title">.</h1>
		<h1 class="app-page-title"><img src="assets/images/icons/analysis.png" alt="" width="30px"> Thống kê</h1>

		<div class="row g-4 mb-4">

			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						<div class="col-auto">
							<select class="form-select w-auto" id="select_Khoa">

							</select>
						</div>

						<div class="col-auto">
							<select class="form-select w-auto" id="select_KhoaHoc">

							</select>
						</div>

						<div class="col-auto">
							<select class="form-select w-auto" id="select_HocKyDanhGia">

							</select>
						</div>

						<div class="col-auto" style="padding-left: 15px;">
							<button type="button" id="btn_thongKe" class="btn app-btn-primary">Thống kê</button>
						</div>


						<div class="col-auto">
							<div class="table-search-form row gx-1 align-items-center">

								
							</div>

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

			<!-- Modal thêm -->
			<!-- <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form action="" class="modal-dialog" id="AddForm">
					<div class="modal-content">
						<div class="modal-header">
							<img src="assets/images/icons/add.png" width="25px" style="padding-right: 5px;">
							<h5 class="modal-title" id="exampleModalLabel"> Thêm lớp</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="input_MaLop" class="form-label" style="color: black; font-weight: 500;">Mã lớp</label>
								<input type="text" name="maLop" class="form-control mb-2" id="input_MaLop" placeholder="Mã lớp sẽ tự động nhập..." readonly>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="input_TenLop" class="form-label" style="color: black; font-weight: 500;">Tên lớp</label>
								<input type="text" name="tenLop" class="form-control" id="input_TenLop" placeholder="Nhập tên lớp...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="select_Khoa_Add" class="form-label" style="color: black; font-weight: 500;">Khoa</label>
								<select class="form-select" name="maKhoa" aria-label="Default select example" id="select_Khoa_Add">

								</select>
							</div>

							<div class="mb-3 form-group">
								<label for="select_CVHT_Add" class="form-label" style="color: black; font-weight: 500;">Cố vấn học tập</label>
								<select class="form-select" name="maCoVanHocTap" aria-label="Default select example" id="select_CVHT_Add">

								</select>
							</div>

							<div class="mb-3 form-group">
								<label for="select_KhoaHoc_Add" class="form-label" style="color: black; font-weight: 500;">Khóa học</label>
								<select class="form-select" name="maKhoaHoc" aria-label="Default select example" id="select_KhoaHoc_Add">

								</select>
							</div>


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-primary" style='color: white;'>Thêm mới</button>
						</div>
					</div>
				</form>
			</div> -->

			<div class="tab-pane fade show active" id="tabLop" role="tabpanel" aria-labelledby="orders-all-tab">
				<div class="app-card app-card-orders-table shadow-sm mb-5">
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table app-table-hover mb-0 text-left" id="tableLop">
								<thead>
									<tr>

									</tr>
								</thead>
								<tbody id="tbodyLop">

								</tbody>
							</table>
						</div>
						<!--//table-responsive-->

					</div>
					<!--//app-card-body-->
				</div>
				<!--//app-card-->
				<nav class="app-pagination" id="idPhanTrangLop">
					<!-- <ul class="pagination justify-content-center" id="idPhanTrang">
							
						</ul> -->
				</nav>
				<!--//app-pagination-->

			</div>
			<!--//tab-pane-->


			<div class="tab-pane fade show active" id="tabSinhVien" role="tabpanel" aria-labelledby="orders-all-tab" style="display: none;">

				<button type="button" class="btn btn-outline-info fs-6" id="backToTabLop">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
					</svg> 
					Trở về
				</button>

				<div class="app-card app-card-orders-table shadow-sm p-2 my-3">
					<div class="app-card-body">
						
						<h4 class="text-uppercase">Thông tin lớp</h4>
						<div class="row pt-2" id="classInfo">
							
						</div>

					</div>
					<!--//app-card-body-->
				</div>
				<!--//app-card-->

				<!-- Biểu đồ rèn luyện -->
				<div class="row d-flex justify-content-center mb-3">
					<div class="col-12 col-lg-10">
						<div class="app-card app-card-chart h-100">
							<div class="app-card-header p-3 border-0">
								<h4 class="app-card-title">Biểu đồ rèn luyện (tính theo số lượng sinh viên)</h4>
							</div><!--//app-card-header-->
							<div class="app-card-body p-4">					   
								<div class="chart-container">
									<canvas id="bieuDoRenLuyen" ></canvas>
								</div>
							</div><!--//app-card-body-->
						</div><!--//app-card-->
					</div><!--//col-->
				</div>

				<div class="app-card app-card-orders-table shadow-sm mb-3">
					<div class="app-card-body">
						
						<h4 class="mb-3 text-uppercase hoc-ky-danh-gia">Kết quả điểm rèn luyện</h4>

						<div class="d-flex justify-content-between align-items-center mb-3">
							<form action="http://localhost/WebDRL/mpdf/export_ketQuaDRL.php" method="POST" id="form_exportPDFKetQuaDRL" class="d-inline">
								<input type="hidden" name="data" class="data" />
								<button type="submit" class="btn btn-danger text-white">In PDF</button>
							</form>

							<div class="d-inline">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
									<path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
								</svg>
								Lọc cột: 
								<select class="form-select w-auto d-inline mx-3" id="select_FilterColumn">
									<option disabled value selected>--- Chọn cột ---</option>
									<option value='diem'>Điểm</option>
									<option value='xepLoai'>Xếp loại</option>
									<option value='sinhVienCham'>Sinh viên chấm</option>
									<option value='coVanDuyet'>Cố vấn duyệt</option>
									<option value='khoaDuyet'>Khoa duyệt</option>
								</select>
								Lựa chọn: 
								<select class="form-select w-auto d-inline" id="select_FilterOption">
								</select>
							</div>
						</div>

						<div class="table-responsive">
							<table class="table app-table-hover mb-0 text-left" id="tableSinhVien">
								<thead>
									<tr>

									</tr>
								</thead>
								<tbody id="tbodySinhVien">

								</tbody>
							</table>
						</div>
						<!--//table-responsive-->

					</div>
					<!--//app-card-body-->
				</div>
				<!--//app-card-->
				<nav class="app-pagination" id="idPhanTrangSinhVien">
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
<script src="assets/js/thongke/function.js"></script>

<script>
	tableLopTitle.forEach(function(title, index) {
		$("#tableLop>thead>tr").append(`<th class='cell'>${title}</th>`);

		if(index == tableLopTitle.length - 1) {
			$("#tableLop>thead>tr").append(`<th class='cell' width='130'>Hành động</th>`);
		}
	});

	tableSinhVienTitle.forEach(function(title, index) {
		$("#tableSinhVien>thead>tr").append(`<th class='cell'>${title}</th>`);
	});

	LoadComboBoxThongTinKhoa_ThongKe();
	LoadComboBoxThongTinKhoaHoc_ThongKe(); 
	LoadComboBoxThongTinHocKyDanhGia_ThongKe();

	$('#btn_thongKe').on('click', function() {
		var maKhoa = $('#select_Khoa').val();
		var maKhoaHoc = $('#select_KhoaHoc').val();
		var maHocKyDanhGia = $('#select_HocKyDanhGia').val();

		if (maKhoa && maKhoaHoc && maHocKyDanhGia) {
			ThongKeLop(maKhoa, maKhoaHoc, maHocKyDanhGia);
			$('#backToTabLop').click();
		} else {
			Swal.fire({
				icon: "error",
				title: "Lỗi",
				text: "Vui lòng chọn khoa, khóa học và học kỳ đánh giá cần thống kê!",
				timer: 5000,
				timerProgressBar: true,
			});
		}

	});
	
	$('#backToTabLop').on('click', function() {
		$('#tabSinhVien').hide();
		$('#tabLop').show();
	});

	//Xử lý xem chi tiết
	$(document).on("click", ".btn_XemChiTiet", function() {
		let maLop = $(this).attr('data-id');
		let maHocKyDanhGia = $(this).attr('hocKy-id');

		$('#tabLop').hide();
		$('#tabSinhVien').show();

		ThongKeSinhVien(maLop, maHocKyDanhGia);
	})

	// Xử lý filter column
	$('#select_FilterColumn').on('change', function() {
		var column = $('#select_FilterColumn').val();
		$("#select_FilterOption").empty();

		switch(column) {
			case 'diem':
				$("#select_FilterOption").append(`<option value='all' selected>Tất cả</option>`);
				$("#select_FilterOption").append(`<option value='overThan50'>Trên 50 điểm</option>`);
				$("#select_FilterOption").append(`<option value='lessThan50'>Dưới 50 điểm</option>`);

				$('#select_FilterOption').trigger('change');

				break;
			case 'xepLoai':
				$("#select_FilterOption").append(`<option value='all' selected>Tất cả</option>`);
				$("#select_FilterOption").append(`<option value='xuatSac'>Xuất sắc</option>`);
				$("#select_FilterOption").append(`<option value='tot'>Tốt</option>`);
				$("#select_FilterOption").append(`<option value='kha'>Khá</option>`);
				$("#select_FilterOption").append(`<option value='trungBinh'>Trung bình</option>`);
				$("#select_FilterOption").append(`<option value='yeu'>Yếu</option>`);
				$("#select_FilterOption").append(`<option value='kem'>Kém</option>`);

				$('#select_FilterOption').trigger('change');

				break;
				
				
				break;
			case 'sinhVienCham':
				$("#select_FilterOption").append(`<option value='all' selected>Tất cả</option>`);
				$("#select_FilterOption").append(`<option value='daCham'>Đã chấm</option>`);
				$("#select_FilterOption").append(`<option value='chuaCham'>Chưa chấm</option>`);

				$('#select_FilterOption').trigger('change');
				
				
				break;
			case 'coVanDuyet':
				$("#select_FilterOption").append(`<option value='all' selected>Tất cả</option>`);
				$("#select_FilterOption").append(`<option value='daDuyet'>Đã duyệt</option>`);
				$("#select_FilterOption").append(`<option value='chuaDuyet'>Chưa duyệt</option>`);

				$('#select_FilterOption').trigger('change');
				
				
				break;
			case 'khoaDuyet':
				$("#select_FilterOption").append(`<option value='all' selected>Tất cả</option>`);
				$("#select_FilterOption").append(`<option value='daDuyet'>Đã duyệt</option>`);
				$("#select_FilterOption").append(`<option value='chuaDuyet'>Chưa duyệt</option>`);

				$('#select_FilterOption').trigger('change');
				
				break;
			default:
				break;
		}
	});

	$('#select_FilterOption').on('change', function() {
		var column = $('#select_FilterColumn').val();
		var option = $('#select_FilterOption').val();
		var counter = 0;
		tmpTableSinhVienContent = tableSinhVienContent;

		switch(column) {
			case 'diem':

				if (option == 'overThan50') {
					tmpTableSinhVienContent = tableSinhVienContent.reduce(function(filtered, data) {
					if (data.diemTongCong >= 50) {
						counter++; 

						data = {...data, soThuTu: counter};

						filtered.push(data);
					}

					return filtered;
					}, []);
				} else if (option == 'lessThan50') {
					tmpTableSinhVienContent = tableSinhVienContent.reduce(function(filtered, data) {
					if (data.diemTongCong < 50) {
						counter++; 

						data = {...data, soThuTu: counter};

						filtered.push(data);
					}

					return filtered;
					}, []);
				}

				break;
			case 'xepLoai':
				
				xepLoaiOptionText = $(`#select_FilterOption option[value='${option}']`).text();

				if (xepLoaiOptionText != 'Tất cả') {
					tmpTableSinhVienContent = tableSinhVienContent.reduce(function(filtered, data) {
					if (data.xepLoai == xepLoaiOptionText) {
						counter++; 

						data = {...data, soThuTu: counter};

						filtered.push(data);
					}

					return filtered;
					}, []);
				}

				break;
				
				
				break;
			case 'sinhVienCham':

				if (option == 'daCham') {
					tmpTableSinhVienContent = tableSinhVienContent.reduce(function(filtered, data) {
					if (data.sinhVienCham == '1') {
						counter++; 

						data = {...data, soThuTu: counter};

						filtered.push(data);
					}

					return filtered;
					}, []);
				} else if (option == 'chuaCham') {
					tmpTableSinhVienContent = tableSinhVienContent.reduce(function(filtered, data) {
					if (data.sinhVienCham == '0') {
						counter++; 

						data = {...data, soThuTu: counter};

						filtered.push(data);
					}

					return filtered;
					}, []);
				}
				
				break;
			case 'coVanDuyet':

				if (option == 'daDuyet') {
					tmpTableSinhVienContent = tableSinhVienContent.reduce(function(filtered, data) {
					if (data.coVanDuyet == '1') {
						counter++; 

						data = {...data, soThuTu: counter};

						filtered.push(data);
					}

					return filtered;
					}, []);
				} else if (option == 'chuaDuyet') {
					tmpTableSinhVienContent = tableSinhVienContent.reduce(function(filtered, data) {
					if (data.coVanDuyet == '0') {
						counter++; 

						data = {...data, soThuTu: counter};

						filtered.push(data);
					}

					return filtered;
					}, []);
				}
				
				break;
			case 'khoaDuyet':

				if (option == 'daDuyet') {
					tmpTableSinhVienContent = tableSinhVienContent.reduce(function(filtered, data) {
					if (data.khoaDuyet == '1') {
						counter++; 

						data = {...data, soThuTu: counter};

						filtered.push(data);
					}

					return filtered;
					}, []);
				} else if (option == 'chuaDuyet') {
					tmpTableSinhVienContent = tableSinhVienContent.reduce(function(filtered, data) {
					if (data.khoaDuyet == '0') {
						counter++; 

						data = {...data, soThuTu: counter};

						filtered.push(data);
					}

					return filtered;
					}, []);
				}

				break;
			default:
				break;
		}

  		$("#tbodySinhVien tr").remove();

		$("#idPhanTrangSinhVien").pagination({
				dataSource: tmpTableSinhVienContent,
				pageSize: 10,
				autoHidePrevious: true,
				autoHideNext: true,
				callback: function (data, pagination) {
					var htmlData = "";

					for (let i = 0; i < data.length; i++) {
						htmlData +=
							"<tr>\
								<td class='cell'>" +
								data[i].soThuTu +
								"</td>\
									<td class='cell'><span class='truncate'>" +
								data[i].maSinhVien +
								"</span></td>\
									<td class='cell'>" +
								data[i].hoTenSinhVien +
								"</td>\
									<td class='cell'>" +
								data[i].ngaySinh +
								"</td>\
									<td class='cell'>" +
								data[i].diemTongCong +
								"</td>\
									<td class='cell'>" +
								data[i].xepLoai +
								"</td>\
								<td class='cell'>" +
								(data[i].sinhVienCham == "1"
									? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Đã chấm</span>"
									: "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Chưa chấm</span>") +
								"</td>\
									<td class='cell'>" +
								(data[i].coVanDuyet == '1' ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Đã duyệt</span>" : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Chưa duyệt</span>") +
								"</td>\
									<td class='cell'>" +
								(data[i].khoaDuyet == '1' ? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Đã duyệt</span>" : "<span class='badge bg-warning' style='color: white;font-size: inherit;'>Chưa duyệt</span>") +
								"</td>\
							</tr>";
					}

					$("#tbodySinhVien").html(htmlData);
				},
			});
	});

	$('#form_exportPDFKetQuaDRL').submit(function() {
		if(Array.isArray(tmpTableSinhVienContent) && tmpTableSinhVienContent.length > 0) {
			var fileName = $(this).children('.data').attr('file-name');

			$("#form_exportPDFKetQuaDRL .data").val(
				JSON.stringify({
					fileName: fileName,
					classInfo: selectedClass,
					tableTitle: tableSinhVienTitle,
					tableContent: tmpTableSinhVienContent
				})
			);

			return true;
		} else {
			Swal.fire({
				icon: "error",
				title: "Lỗi",
				text: "Không có dữ liệu để in PDF!",
				timer: 2000,
				timerProgressBar: true,
				showCloseButton: true,
			});

			return false;
		}
	});

</script>