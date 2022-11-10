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
	$("#menu-button-ThongKe").removeClass("active");

	//add class active
	$("#menu-button-KhieuNai").addClass("active");

	//set title
	document.title = "Khiếu nại | Web điểm rèn luyện";
</script>

<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">

		<h1 class="app-page-title">.</h1>
		<h1 class="app-page-title"><img src="assets/images/icons/complaint.png" alt="" width="30px"> Khiếu nại</h1>

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

						<div class="col-auto">
							<div class="table-search-form row gx-1 align-items-center">
								<div class="col-auto">
									<input type="text" id="input_timKiemMaSinhVien" name="searchorders" class="form-control search-orders" placeholder="Nhập mã số sinh viên">
								</div>
								<div class="col-auto">
									<button type="button" id="btn_timKiemMaSinhVien" class="btn app-btn-secondary">Tìm kiếm</button>
								</div>
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

			<!-- Modal ảnh minh chứng -->
			<div class="modal fade" id="AnhMinhChungModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="btn-close" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#XemChiTietModal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<img src="" class="minh-chung-img" style="width: 100%;" alt="modal img">
					</div>
					</div>
				</div>
			</div>

			<!-- Modal xem chi tiết khiếu nại -->
			<div class="modal fade" id="XemChiTietModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"> Xem chi tiết khiếu nại</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="input_MaKhieuNai" class="form-label" style="color: black; font-weight: 500;">Mã khiếu nại</label>
								<input type="text" class="form-control" id="input_MaKhieuNai" style="background-color:transparent;" readonly placeholder="Mã khiếu nại...">
							</div>

							<div class="mb-3 form-group">
								<label for="input_MaPhieuRenLuyen" class="form-label" style="color: black; font-weight: 500;">Mã phiếu rèn luyện</label>
								<input type="text" class="form-control" id="input_MaPhieuRenLuyen" style="background-color:transparent;" readonly placeholder="Mã phiếu rèn luyện...">
							</div>

							<div class="mb-3 form-group">
								<label for="input_MaSinhVien" class="form-label" style="color: black; font-weight: 500;">Mã sinh viên</label>
								<input type="text" class="form-control" id="input_MaSinhVien" style="background-color:transparent;" readonly placeholder="Mã sinh viên...">
							</div>

							<div class="mb-3 form-group">
								<label for="input_HoTenSinhVien" class="form-label" style="color: black; font-weight: 500;">Họ tên sinh viên</label>
								<input type="text" class="form-control" id="input_HoTenSinhVien" style="background-color:transparent;" readonly placeholder="Họ tên sinh viên...">
							</div>

							<div class="mb-3 form-group">
								<label for="input_MaLop" class="form-label" style="color: black; font-weight: 500;">Mã lớp</label>
								<input type="text" class="form-control" id="input_MaLop" style="background-color:transparent;" readonly placeholder="Mã lớp...">
							</div>

							<div class="mb-3 form-group">
								<label for="input_TrangThai" class="form-label" style="color: black; font-weight: 500;">Trạng thái</label>
								<input type="text" class="form-control" id="input_TrangThai" style="background-color:transparent;" readonly placeholder="Trạng thái...">
							</div>

							<div class="mb-3 form-group">
								<label for="input_ThoiGianKhieuNai" class="form-label" style="color: black; font-weight: 500;">Thời gian khiếu nại</label>
								<input type="text" class="form-control" id="input_ThoiGianKhieuNai" style="background-color:transparent;" readonly placeholder="Thời gian khiếu nại...">
							</div>

							<div class="mb-3 form-group">
								<label for="textarea_LyDoKhieuNai" class="form-label" style="color: black; font-weight: 500;">Lý do khiếu nại</label>
								<textarea class="form-control h-100" id="textarea_LyDoKhieuNai" rows="8" style="background-color:transparent;" readonly></textarea>
							</div>

							<div class="mb-0 form-group">
								<label class="form-label mb-3" style="color: black; font-weight: 500;">Ảnh minh chứng</label>
								<p id="num-of-files" style="text-align: center; margin: 20px 0;">Không có ảnh minh chứng</p>
								<div id="images" style="width: 90%; position: relative; margin: auto; display: flex; justify-content: space-evenly; gap: 20px; flex-wrap: wrap;"></div>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
						</div>
					</div>
				</div>
			</div>

			<div class="tab-pane fade show active" id="tabKhieuNai" role="tabpanel" aria-labelledby="orders-all-tab">
				<div class="app-card app-card-orders-table shadow-sm mb-5">
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table app-table-hover mb-0 text-left" id="tableKhieuNai">
								<thead>
									<tr>

									</tr>
								</thead>
								<tbody id="tbodyKhieuNai">

								</tbody>
							</table>
						</div>
						<!--//table-responsive-->

					</div>
					<!--//app-card-body-->
				</div>
				<!--//app-card-->
				<nav class="app-pagination" id="idPhanTrangKhieuNai">
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
<script src="assets/js/khieunai/function.js"></script>

<script>
	tableKhieuNaiTitle.forEach(function(title, index) {
		$("#tableKhieuNai>thead>tr").append(`<th class='cell'>${title}</th>`);

		if(index == tableKhieuNaiTitle.length - 1) {
			$("#tableKhieuNai>thead>tr").append(`<th class='cell'>Hành động</th>`);
		}
	});

	LoadComboBoxThongTinKhoa_KhieuNai();
	LoadComboBoxThongTinKhoaHoc_KhieuNai(); 
	LoadComboBoxThongTinHocKyDanhGia_KhieuNai();

	GetListKhieuNai($("#select_Khoa").val(), $("#select_KhoaHoc").val(), $("#select_HocKyDanhGia").val());

	function xuLyTimKiemMSSV() {
		var _input_timKiemMaSinhVien = $('#input_timKiemMaSinhVien').val().trim();

		if (_input_timKiemMaSinhVien != '') {
			if(Number(_input_timKiemMaSinhVien)) {
				TimKiemKhieuNai(_input_timKiemMaSinhVien);
			} else {
				Swal.fire({
					icon: "error",
					title: "Lỗi",
					text: "Mã số sinh viên không hợp lệ!",
					timer: 2000,
					timerProgressBar: true,
				});
			}
		}
	}

	$('#btn_timKiemMaSinhVien').on('click', function() {
		xuLyTimKiemMSSV();
	});

	$('#input_timKiemMaSinhVien').keypress(function (e) {
		var key = e.which;
		if(key == 13)  // the 'Enter' code
		{
			$('#btn_timKiemMaSinhVien').click();
		}
	}); 

	$('#select_Khoa').on('change', function() {
		GetListKhieuNai($("#select_Khoa").val(), $("#select_KhoaHoc").val(), $("#select_HocKyDanhGia").val());
	});

	$('#select_KhoaHoc').on('change', function() {
		GetListKhieuNai($("#select_Khoa").val(), $("#select_KhoaHoc").val(), $("#select_HocKyDanhGia").val());
	});

	$('#select_HocKyDanhGia').on('change', function() {
		GetListKhieuNai($("#select_Khoa").val(), $("#select_KhoaHoc").val(), $("#select_HocKyDanhGia").val());
	});

	// Xử lý xem ảnh minh chứng
	document.addEventListener("click", function (e) {
		if(e.target.classList.contains("minh-chung-item")) {
			const src = e.target.getAttribute("src");
			document.querySelector(".minh-chung-img").src = src;

			$('#XemChiTietModal').find('.btn-close').trigger('click');

			const AnhMinhChungModal = new bootstrap.Modal(document.getElementById('AnhMinhChungModal'));
			AnhMinhChungModal.show();
		}
	})

	//Xử lý xem chi tiết
	$(document).on("click", ".btn_XemChiTiet", function() {
		let maKhieuNai = $(this).attr('data-id');
		
		$.ajax({
			url: urlapi_khieunai_single_details_read + `?maKhieuNai=${maKhieuNai}`,
			async: false,
			type: "GET",
			contentType: "application/json;charset=utf-8",
			dataType: "json",
			headers: {
				Authorization: jwtCookie,
			},
			success: function (result_KN) {
				let imageContainer = document.getElementById("images");
				let numOfFiles = document.getElementById("num-of-files");
				
				$("#input_MaKhieuNai").val(result_KN.maKhieuNai);
				$("#input_MaPhieuRenLuyen").val(result_KN.maPhieuRenLuyen);
				$("#input_MaSinhVien").val(result_KN.maSinhVien);
				$("#input_HoTenSinhVien").val(result_KN.hoTenSinhVien);
				$("#input_MaLop").val(result_KN.maLop);
				$("#input_TrangThai").val(result_KN.trangThai == 1 ? "Chấp thuận" : (result_KN.trangThai == -1 ? "Từ chối" : "Đang chờ duyệt"));
				$("#input_ThoiGianKhieuNai").val(toDateTimeString(result_KN.thoiGianKhieuNai));
				$("#lyDoKhieuNai").val(result_KN.lyDoKhieuNai);
				$("#textarea_LyDoKhieuNai").val(result_KN.lyDoKhieuNai);

				if (result_KN.minhChung) {
					imageContainer.innerHTML = "";
					numOfFiles.textContent = "";
					
					result_KN.minhChung.split("|").forEach(function(fileName) {
						if (fileName) {
							let figure = document.createElement("figure");
							figure.style.width = "45%";

							let img = document.createElement("img");
							img.style.width = "100%";
							img.style.cursor = "pointer";
							img.setAttribute("src", `http://localhost/WebDRL//user-images/sinhvien/${result_KN.maSinhVien}/khieuNai_minhChung/${result_KN.maHocKyDanhGia}/${fileName}`);
							img.classList.add("minh-chung-item");

							figure.appendChild(img);
							imageContainer.appendChild(figure);
						}
					})
				} else {
					numOfFiles.textContent = 'Không có ảnh minh chứng';
				}
			},
			error: function (error_KN) {
				$("#input_MaKhieuNai").val("");
				$("#input_MaPhieuRenLuyen").val("");
				$("#input_MaSinhVien").val("");
				$("#input_HoTenSinhVien").val("");
				$("#input_MaLop").val("");
				$("#input_TrangThai").val("");
				$("#input_ThoiGianKhieuNai").val("");
				$("#lyDoKhieuNai").val("");
				$("#textarea_LyDoKhieuNai").val("");
			},
		});
	})

</script>