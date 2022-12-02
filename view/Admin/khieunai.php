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
	$("#menu-button-CaiDat").removeClass("active");

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

			<!-- Modal phê duyệt khiếu nại -->
			<div class="modal fade" id="PheDuyetModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form action="" class="modal-dialog" id="PheDuyetForm">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"> Phê duyệt khiếu nại</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="edit_input_MaKhieuNai" class="form-label" style="color: black; font-weight: 500;">Mã khiếu nại</label>
								<input type="text" class="form-control" id="edit_input_MaKhieuNai" placeholder="Mã khiếu nại...">
							</div>

							<div class="mb-3 form-group">
								<label class="form-label d-block" style="color: black; font-weight: 500;">Trạng thái</label>
								
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="trangThai" value="1" id="trangThai_ChapThuan">
									<label class="form-check-label" for="trangThai_ChapThuan">
										Chấp thuận
									</label>
								</div>

								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="trangThai" value="-1" id="trangThai_TuChoi">
									<label class="form-check-label" for="trangThai_TuChoi">
										Từ chối
									</label>
								</div>
							</div>

							<div class="mb-3 form-group" style="display:none">
								<label for="edit_textarea_LoiNhan" class="form-label" style="color: black; font-weight: 500;">Lời nhắn</label>
								<textarea class="form-control h-100" id="edit_textarea_LoiNhan" rows="8"></textarea>
							</div>

							<div class="mb-3 form-group" style="display:none">
								<label for="edit_textarea_LyDoTuChoi" class="form-label" style="color: black; font-weight: 500;">Lý do từ chối</label>
								<textarea class="form-control h-100" id="edit_textarea_LyDoTuChoi" rows="8"></textarea>
							</div>

							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="edit_checkBox_guiEmail" checked="true">
								<label class="form-check-label" for="edit_checkBox_guiEmail">
									Gửi email thông báo phê duyệt cho sinh viên
								</label>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-primary" style='color: white;'>Phê duyệt</button>
						</div>
					</div>
				</form>
			</div>

			<div class="d-inline text-end">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
					<path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
				</svg>
				Lọc trạng thái: 
				<select class="form-select w-auto d-inline mx-3" id="select_TrangThai">
					<option value='all' selected>Tất cả</option>
					<option value='0'>Đang chờ duyệt</option>
					<option value='1'>Chấp thuận</option>
					<option value='-1'>Từ chối</option>
				</select>
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
		TimKiemKhieuNai(_input_timKiemMaSinhVien);
		// if (_input_timKiemMaSinhVien != '') {
		// 	if(Number(_input_timKiemMaSinhVien)) {
		// 		TimKiemKhieuNai(_input_timKiemMaSinhVien);
		// 	} else {
		// 		Swal.fire({
		// 			icon: "error",
		// 			title: "Lỗi",
		// 			text: "Mã số sinh viên không hợp lệ!",
		// 			timer: 2000,
		// 			timerProgressBar: true,
		// 		});
		// 	}
		// }
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

	// Xử lý filter trạng thái
	$('#select_TrangThai').on('change', function() {
		const status = $('#select_TrangThai').val();
		var filterData = tableKhieuNaiContent;
		var counter = 0;

		if (status != 'all') {
			 filterData = tableKhieuNaiContent.reduce(function(filtered, data) {
				if (data.trangThai == status) {
					counter++; 

					data = {...data, soThuTu: counter};

					filtered.push(data);
				}

				return filtered;
			}, []);
		}

		$("#tbodyKhieuNai tr").remove();

		$("#idPhanTrangKhieuNai").pagination({
			dataSource: filterData,
			pageSize: 10,
			autoHidePrevious: true,
			autoHideNext: true,
			callback: function (data, pagination) {
				var htmlData = "";
				var count = 0;

				if(data.length == 0) {
					htmlData += "<tr>\
									<td colspan='9' class='text-center'>\
										<p class='mt-4'>Không tìm thấy kết quả.</p>\
									</td>\
								</tr>"
					$("#tbodyKhieuNai").append(htmlData);
				} else {
					for (let i = 0; i < data.length; i++) {
						count += 1;

						htmlData +=
						"<tr>\
											<td class='cell'>" +
						data[i].soThuTu +
						"</td>\
											<td class='cell'><span class='truncate'>" +
						data[i].maKhieuNai +
						"</span></td>\
											<td class='cell'>" +
						data[i].maPhieuRenLuyen +
						"</td>\
											<td class='cell'>" +
						data[i].maSinhVien +
						"</td>\
											<td class='cell'>" +
						data[i].hoTenSinhVien +
						"</td>\
											<td class='cell'>" +
						data[i].maLop +
						"</td>\
											<td class='cell'>" +
						(data[i].trangThai == 1
							? "<span class='badge bg-success' style='color: white;font-size: inherit;'>Chấp thuận</span>"
							: data[i].trangThai == -1
							? "<span class='badge bg-danger' style='color: white;font-size: inherit;'>Từ chối</span>"
							: "<span class='badge bg-info' style='color: white;font-size: inherit;'>Đang chờ duyệt</span>") +
						"</td>\
											<td class='cell'>" +
						(data[i].trangThai == 0
							? timeSinceBadge(data[i].thoiGianKhieuNai)
							: toDateTimeString(data[i].thoiGianKhieuNai)) +
						"</td>\
											<td class='cell'>\
											<button class='btn btn-secondary btn_XemChiTiet' style='color: white;' data-bs-toggle='modal' data-bs-target='#XemChiTietModal' data-id = '" +
						data[i].maKhieuNai +
						"' >Xem chi tiết</button>\
											<button class='btn btn-info btn_PheDuyet' style='color: white;' data-bs-toggle='modal' data-bs-target='#PheDuyetModal' data-id = '" +
						data[i].maKhieuNai +
						"' >Phê duyệt</button>\
						</td>\
											</tr>";
					}

					$("#tbodyKhieuNai").html(htmlData);
				}
			},
		});
	})

	$("input[type=radio][name=trangThai]", "#PheDuyetForm").change(function() {
		$('#edit_textarea_LoiNhan').parent().hide();
		$('#edit_textarea_LyDoTuChoi').parent().hide();

		if (this.value == '1') {
			$('#edit_textarea_LoiNhan').parent().show();
		} else if (this.value == '-1') {
			$('#edit_textarea_LyDoTuChoi').parent().show();
		}
	});

	$('#PheDuyetModal').on('shown.bs.modal', function (e) {
		$('#edit_textarea_LoiNhan').parent().hide();
		$('#edit_textarea_LyDoTuChoi').parent().hide();

		const status = $('input[name=trangThai]:checked', '#PheDuyetForm').val();

		if (status == '1') {
			$('#edit_textarea_LoiNhan').parent().show();
		} else if (status == '-1') {
			$('#edit_textarea_LyDoTuChoi').parent().show();
		}
	})

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
							img.setAttribute("src", `${host_domain_url}/user-images/sinhvien/${result_KN.maSinhVien}/khieuNai_minhChung/${result_KN.maHocKyDanhGia}/${fileName}`);
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

	//Xử lý hiện modal phê duyệt
	$(document).on("click", ".btn_PheDuyet", function() {
		let maKhieuNai = $(this).attr('data-id');

		LoadThongTinPheDuyet(maKhieuNai);
	})

	$("#PheDuyetForm").submit(function(e) {
		e.preventDefault();
		pheDuyet();
	});

</script>