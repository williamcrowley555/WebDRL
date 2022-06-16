<script src="assets/js/check_token.js"></script>
<script>
	//remove class active
	$("#menu-button-ThongKe").removeClass("active");
	$("#menu-button-SinhVien").removeClass("active");
	$("#menu-button-HoatDongDanhGia").removeClass("active");
	$("#menu-button-Khoa").removeClass("active");
	$("#menu-button-Lop").removeClass("active");
	$("#menu-button-CoVanHocTap").removeClass("active");
	$("#menu-button-TieuChiDanhGia").removeClass("active");
	$("#menu-button-ThongBaoDanhGia").removeClass("active");

	//add class active
	$("#menu-button-PhieuRenLuyen").addClass("active");

	//set title
	document.title = "Phiếu rèn luyện | Web điểm rèn luyện";
</script>

<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">

		<h1 class="app-page-title">.</h1>
		<h1 class="app-page-title"><img src="assets/images/icons/class.png" alt="" width="30px"> Phiếu rèn luyện</h1>

		<div class="row g-4 mb-4">

			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						<div class="col-auto">

							<select class="form-select w-auto" id="select_Khoa">

							</select>
						</div>


						<div class="col-auto">
							<form class="table-search-form row gx-1 align-items-center">
								<div class="col-auto">
									<input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Nhập mã sinh viên">
								</div>
								<div class="col-auto">
									<button type="submit" class="btn app-btn-secondary">Tìm kiếm</button>
								</div>
							</form>

						</div>
						<!--//col-->
						<div class="col-auto" style="padding-left: 15px;">
							<button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: #61a376;color: white;"><img src='assets/images/icons/pdf.png' width='17px' /> Xuất danh sách</button>
						</div>

					</div>
					<!--//row-->
				</div>
				<!--//table-utilities-->
			</div>
			<!--//col-auto-->

			<!-- Modal -->
			<div class="modal fade" id="ModalXemVaDuyet" tabindex="-1" aria-labelledby="ModalXemVaDuyetLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
				<div class="modal-dialog modal-xl">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="ModalXemVaDuyetLabel">Chi tiết phiếu điểm rèn luyện: <span id="text_maPhieuRenLuyen_XemVaDuyet" style="font-weight: bold;"></span></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<h6 style="text-transform: uppercase; text-align: left;">--Thông tin sinh viên--</h6>

							<div class="row justify-content-center" style="padding-bottom: 30px;text-align: start;" id="part_thongTinSinhVien">

								
							</div>

							<h6 style="text-transform: uppercase; text-align: left;">--PHIẾU ĐÁNH GIÁ ĐIỂM RÈN LUYỆN--</h6>

							<form id="formDanhGiaDRL" method="post" enctype="multipart/form-data">
								<div class="form-outline mb-4">
									<div class="row justify-content-center" style="padding-bottom: 30px;text-align: start;">

										<table class="table table-hover table-bordered">
											<thead>
												<tr style="text-align: center;">
													<th scope="col"><strong>NỘI DUNG ĐÁNH GIÁ</strong></th>
													<th scope="col"><strong>Điểm tối đa</strong></th>
													<th scope="col"><strong>Điểm SV tự đánh giá</strong></th>
													<th scope="col"><strong>Điểm lớp đánh giá</strong></th>
													<th scope="col"><strong>Ghi chú</strong></th>
												</tr>
											</thead>
											<tbody id="tbody_noiDungDanhGia">

											</tbody>

										</table>


									</div>

									<button type="submit" class="btn btn-primary" style="width: auto;text-align: center;text-transform: uppercase;color: white;font-size: 16px;float: right;margin-right: 15px;margin-bottom: 20px;margin-top: -10px;" onclick="return DuyetDiemRenLuyen();">Duyệt điểm</button>

								<div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 0px;"></div><div class="form-notch-trailing"></div></div></div>
							</form>

							


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
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
										<th class="cell">Mã phiếu rèn luyện</th>
										<th class="cell">Mã sinh viên</th>
										<th class="cell">Mã học kỳ</th>
										<th class="cell">Điểm tổng</th>
										<th class="cell">Xếp loại</th>
										<th class="cell">Cố vấn duyệt</th>
										<th class="cell">Khoa duyệt</th>
										<th class="cell">Tệp đính kèm</th>
										<th class="cell"></th>
									</tr>
								</thead>
								<tbody id="id_tbodyPhieuRenLuyen">

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
<script src="assets/js/phieurenluyen/function.js"></script>

<script>
	//hàm trong function.js
	GetListPhieurenluyen();

	LoadComboBoxThongTinKhoa();

	getTieuChiDanhGia();


	function TinhDiemTongCong() {
		//Code tự tính điểm tổng cộng-------------------//
		let calDiemTongCong_SinhVien = 0;
			let calDiemTongTieuChi1 = 0;
			let calDiemTongTieuChi1_SinhVien = 0;
			$("#tbody_noiDungDanhGia").find("input").each(function() {
				var tieuChi = this.id.slice(0, 8);
				var tieuChi_SinhVien = this.id.slice(0, 3);
				var idDiemTongTieuChi1 = this.id.slice(0, 17);
				var idDiemTongTieuChi1_SinhVien = this.id.slice(0, 12);


				if (tieuChi == 'CVHT_TC2' || tieuChi == 'CVHT_TC3') {
					if (this.value != null) {
					// calDiemTongCong += Number(this.value);
						calDiemTongTieuChi1 += Number(this.value);
					}
				}

				if (tieuChi_SinhVien == 'TC2' || tieuChi_SinhVien == 'TC3') {
					if (this.value != null) {
						calDiemTongTieuChi1_SinhVien += Number(this.value);
					calDiemTongCong_SinhVien += Number(this.value);
					}
				}

				if (idDiemTongTieuChi1_SinhVien == 'TongCong_TC1') {
					$('#' + this.id).val(calDiemTongTieuChi1_SinhVien);
					calDiemTongTieuChi1_SinhVien = 0;
				}

				if (idDiemTongTieuChi1 == 'CVHT_TongCong_TC1') {
					$('#' + this.id).val(calDiemTongTieuChi1);
					calDiemTongTieuChi1 = 0;
				}
				
			});

			$("#input_diemtongcong").val(calDiemTongCong_SinhVien);
		
			//onchange
			$('#tbody_noiDungDanhGia').find("input").on('change', function() {
				let calDiemTongCong = 0;
				let calDiemTongTieuChi1 = 0;
				$("#tbody_noiDungDanhGia").find("input").each(function() {
					var tieuChi = this.id.slice(0, 8);

					var idDiemTongTieuChi1 = this.id.slice(0, 17);

					if (tieuChi == 'CVHT_TC2' || tieuChi == 'CVHT_TC3') {
						if (this.value != null) {
							calDiemTongCong += Number(this.value);
							calDiemTongTieuChi1 += Number(this.value);
						}
					}

					if (idDiemTongTieuChi1 == 'CVHT_TongCong_TC1') {
						$('#' + this.id).val(calDiemTongTieuChi1);
						calDiemTongTieuChi1 = 0;
					}


				});

				$('#CVHT_input_diemtongcong').val(calDiemTongCong);

				
				var diemTong_XepLoai = Number($('#CVHT_input_diemtongcong').val());

				$("#text_XepLoai").text(TinhXepLoai(diemTong_XepLoai));

			

			});
			//Code tự tính điểm tổng cộng-------------------//
		}
	


		function TinhXepLoai(diemTong_XepLoai) {
            if (diemTong_XepLoai >= 90 && diemTong_XepLoai <= 100) {
                return 'Xuất sắc';
            }

            if (diemTong_XepLoai >= 80 && diemTong_XepLoai <= 89) {
                return 'Tốt';
            }

            if (diemTong_XepLoai >= 65 && diemTong_XepLoai <= 79) {
                return 'Khá';
            }

            if (diemTong_XepLoai >= 50 && diemTong_XepLoai <= 64) {
                return 'Trung bình';
            }

            if (diemTong_XepLoai >= 35 && diemTong_XepLoai <= 49) {
                return 'Yếu';
            }

            if (diemTong_XepLoai < 35) {
                return 'Kém';
            }
        }


	$(document).on("click", ".btn_XemVaDuyet", function() {

		let maPhieuRenLuyen = $(this).attr('data-id');
		let maSinhVienGET = $(this).attr('data-mssv-id');
		let maHocKyDanhGiaGET = $(this).attr('data-mahocky-id');
		//$("#CVHT_input_diemtongcong").val("");

		$('#text_maPhieuRenLuyen_XemVaDuyet').text(maPhieuRenLuyen);
		getThongTinNguoiDung(maSinhVienGET, maHocKyDanhGiaGET);
		LoadThongTinSinhVienDanhGia(maPhieuRenLuyen);

		TinhDiemTongCong();
		
	})


	

	
	
</script>