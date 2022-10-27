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
	$("#menu-button-ThongKe").removeClass("active");

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

							<select class="form-select w-auto" id='select_Lop'>

							</select>
						</div>

						<div class="col-auto">
                            <input type="text" id="input_timKiemMaPhieuRenLuyen" name="" class="form-control" placeholder="Nhập mã phiếu rèn luyện">
                        </div>

                        <div class="col-auto">
                            <button type="button" id="btn_timKiemMaPhieuRenLuyen" class="btn app-btn-secondary">Tìm kiếm</button>
                        </div>
						<!--//col-->

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
													<th scope="col"><strong>Điểm Khoa đánh giá</strong></th>
													<th scope="col"><strong>Điểm nhận từ hoạt động</strong></th>
													<th scope="col"><strong>Minh chứng ngoài (nếu có)</strong></th>
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
										<th class="cell">Hành động</th>
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

<!-- Modal xem danh sách hoạt động-->
<div class="modal fade" id="XemDanhSachHoatDongModal" tabindex="-1" aria-labelledby="XemDanhSachHoatDongModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Danh sách hoạt động đã tham gia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div>
                        <span style="font-weight: 700">Tiêu chí được cộng: </span><span id="id_thamgiahd_tieuChiDuocCong"></span>
                    </div>

                    <hr>
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left table-hover">
                            <thead>
                                <tr>
                                    <th class="cell">Mã hoạt động</th>
                                    <th class="cell">Tên hoạt động</th>
                                    <th class="cell">Điểm nhận được</th>
                                </tr>
                            </thead>
                            <tbody id="id_tbody_DanhSachThamGiaHoatDong">

                                <!-- <tr>
                                        <td colspan="4" style="text-align:center">Không tìm thấy kết quả.</td>
                                    </tr> -->

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="AnhMinhChungModal" tabindex="-1" aria-labelledby="AnhMinhChungModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ảnh minh chứng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                   <img src="#" alt="" srcset="" id="id_img_modal" width="300px" />


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

<footer class="app-footer">

</footer>
<!--//app-footer-->


<!-- Page Specific JS -->
<script src="assets/js/phieurenluyen/function.js"></script>

<!-- Phieu Ren Luyen Helper JS -->
<script src="../../helper/js/phieuRenLuyen.js"></script>

<script>
	LoadComboBoxThongTinKhoa();

    LoadComboBoxThongTinLopTheoKhoa($('#select_Khoa').val());

	//hàm trong function.js
	GetListPhieurenluyen($('#select_Lop').val());

	// getTieuChiDanhGia();

	// TinhDiemTongCong();

    function onlyLettersAndNumbers(str) {
		return /^[A-Za-z0-9]*$/.test(str);
	}

    function xuLyTimKiemMaPhieuRenLuyen() {
        var _input_timKiemMaPhieuRenLuyen = $('#input_timKiemMaPhieuRenLuyen').val().trim();

        if (_input_timKiemMaPhieuRenLuyen != '') {
            if(onlyLettersAndNumbers(_input_timKiemMaPhieuRenLuyen)){
                TimKiemPhieuRenLuyen(_input_timKiemMaPhieuRenLuyen);
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    text: "Mã phiếu rèn luyện không hợp lệ!",
                    timer: 2000,
                    timerProgressBar: true,
                });
            }
        }
    }

    $('#select_Khoa').on('change', function() {
		$('#input_timKiemMaPhieuRenLuyen').val('');

		var maKhoa_selected = $('#select_Khoa').val();
		
		LoadComboBoxThongTinLopTheoKhoa(maKhoa_selected);

		var maLop_selected = $('#select_Lop').val();

		GetListPhieurenluyen(maLop_selected);
	});

    $('#select_Lop').on('change', function() {
        $('#input_timKiemMaPhieuRenLuyen').val('');
        
        var maKhoa_selected = $('#select_Khoa').val();
        var maLop_selected = $('#select_Lop').val();

        GetListPhieurenluyen(maLop_selected);
    });

    $('#btn_timKiemMaPhieuRenLuyen').on('click', function() {
        xuLyTimKiemMaPhieuRenLuyen();
    });

    $('#input_timKiemMaPhieuRenLuyen').keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the 'Enter' code
        {
            $('#btn_timKiemMaPhieuRenLuyen').click();
        }
    }); 

	function TinhDiemTongCong() {

		//Code tự tính điểm tổng cộng-------------------//
        let calDiemTongCong_SinhVien = 0;
        let calDiemTongCong_CVHT = 0;
        let calDiemTongCong_Khoa = 0;
        let calDiemTongTieuChi1_SinhVien = 0;
        let calDiemTongTieuChi1_CVHT = 0;
        let calDiemTongTieuChi1_Khoa = 0;
        $("#tbody_noiDungDanhGia").find("input").each(function() {
            var tieuChi_SinhVien = this.id.slice(0, 3);
            var tieuChi = this.id.slice(0, 8);
            var idDiemTongTieuChi1_SinhVien = this.id.slice(0, 12);
            var idDiemTongTieuChi1 = this.id.slice(0, 17);

            if (tieuChi_SinhVien == 'TC2' || tieuChi_SinhVien == 'TC3') {
                if (this.value != null) {
                    calDiemTongTieuChi1_SinhVien += Number(this.value);
                   //calDiemTongCong_SinhVien += Number(this.value);
                }
            }

            if (tieuChi == 'CVHT_TC2' || tieuChi == 'CVHT_TC3') {
                if (this.value != null) {
                   // calDiemTongCong += Number(this.value);
                   calDiemTongTieuChi1_CVHT += Number(this.value);
                    //calDiemTongCong_CVHT += Number(this.value);
                }
            }

            if (tieuChi == 'Khoa_TC2' || tieuChi == 'Khoa_TC3') {
                if (this.value != null) {
                   // calDiemTongCong += Number(this.value);
                   calDiemTongTieuChi1_Khoa += Number(this.value);
                   //calDiemTongCong_Khoa += Number(this.value);
                }
            }

            // Điểm tổng cộng tiêu chí 1 của sinh viên
            if (idDiemTongTieuChi1_SinhVien == 'TongCong_TC1') {
                var diemToiDa_TC1 = $('#' + this.id).attr('max-value');

                if (calDiemTongTieuChi1_SinhVien > diemToiDa_TC1) {
                    $('#' + this.id).val(diemToiDa_TC1);

                    calDiemTongCong_SinhVien += Number(diemToiDa_TC1);
                    calDiemTongTieuChi1_SinhVien = 0;
                } else {
                    $('#' + this.id).val(calDiemTongTieuChi1_SinhVien);

                    calDiemTongCong_SinhVien += Number(calDiemTongTieuChi1_SinhVien);
                    calDiemTongTieuChi1_SinhVien = 0;
                }
            }

            // Điểm tổng cộng tiêu chí 1 của cvht
            if (idDiemTongTieuChi1 == 'CVHT_TongCong_TC1') {
                var diemToiDa_TC1_CVHT = $('#' + this.id).attr('max-value');

                if (calDiemTongTieuChi1_CVHT > diemToiDa_TC1_CVHT) {
                    $('#' + this.id).val(diemToiDa_TC1_CVHT);

                    calDiemTongCong_CVHT += Number(diemToiDa_TC1_CVHT);
                    calDiemTongTieuChi1_CVHT = 0;
                } else {
                    $('#' + this.id).val(calDiemTongTieuChi1_CVHT);

                     calDiemTongCong_CVHT += Number(calDiemTongTieuChi1_CVHT);
                     calDiemTongTieuChi1_CVHT = 0;
                }
            }

            // Điểm tổng cộng tiêu chí 1 của khoa
            if (idDiemTongTieuChi1 == 'Khoa_TongCong_TC1') {
                var diemToiDa_TC1_Khoa = $('#' + this.id).attr('max-value');

                if (calDiemTongTieuChi1_Khoa > diemToiDa_TC1_Khoa) {
                    $('#' + this.id).val(diemToiDa_TC1_Khoa);

                    calDiemTongCong_Khoa += Number(diemToiDa_TC1_Khoa);
                    calDiemTongTieuChi1_Khoa = 0;
                } else {
                    $('#' + this.id).val(calDiemTongTieuChi1_Khoa);

                     calDiemTongCong_Khoa += Number(calDiemTongTieuChi1_Khoa);
                     calDiemTongTieuChi1_Khoa = 0;
                }
            }
            
        });

        // Điểm tổng cộng của phiếu rèn luyện
		$("#input_diemtongcong").val(calDiemTongCong_SinhVien);
        $("#CVHT_input_diemtongcong").val(calDiemTongCong_CVHT);

		if (calDiemTongCong_Khoa > 100){
			$("#Khoa_input_diemtongcong").val(100);
			$('#text_diemTongCong').text(100);
		}else{
			$("#Khoa_input_diemtongcong").val(calDiemTongCong_Khoa);
			$('#text_diemTongCong').text(calDiemTongCong_Khoa);
		}

        // Điểm tổng cộng đã chốt
		var diemTong_XepLoai = Number($('#Khoa_input_diemtongcong').val());

        $("#text_XepLoai").text(TinhXepLoai(diemTong_XepLoai));
     
        //Code tự tính điểm tổng cộng-------------------//
	}

    //onchange
    $('#tbody_noiDungDanhGia').find("input").on('change', function() {
        _isAllowedToScore = isAllowedToScore(phieuRenLuyen.thongBaoDanhGia, getCookie("quyen"), ["khoa"]);
        if(_isAllowedToScore) {
            TinhDiemTongCong();
        }
    });


    $('#inputTBCHocKyDangXet').on('change', function() {
        TuDongDienDiemTBC();
    });

    $('#inputTBCHocKyTruoc').on('change', function() {
        TuDongDienDiemTBC();
    });

    function TuDongDienDiemTBC() {
        var TBCHocKyDangXet = $('#inputTBCHocKyDangXet').val();
        var TBCHocKyTruoc = $('#inputTBCHocKyTruoc').val();
        var bac_HocKyDangXet = 0;
        var bac_HocKyTruoc = 0;

        $('#Khoa_TC3_1').val('');
        $('#Khoa_TC3_2').val('');
        $('#Khoa_TC3_3').val('');
        $('#Khoa_TC3_4').val('');
        $('#Khoa_TC3_5').val('');
        $('#Khoa_TC3_6').val('');
        $('#Khoa_TC3_7').val('');

        //Hoc ky dang xet
        if ((TBCHocKyDangXet >= 3.60) && (TBCHocKyDangXet <= 4)) {
            $('#Khoa_TC3_1').val($('#Khoa_TC3_1').attr('max_value'));
            bac_HocKyDangXet = 4;
        }

        if ((TBCHocKyDangXet >= 3.20) && (TBCHocKyDangXet <= 3.59)) {
            $('#Khoa_TC3_2').val($('#Khoa_TC3_2').attr('max_value'));
            bac_HocKyDangXet = 3;
        }

        if ((TBCHocKyDangXet >= 2.50) && (TBCHocKyDangXet <= 3.19)) {
            $('#Khoa_TC3_3').val($('#Khoa_TC3_3').attr('max_value'));
            bac_HocKyDangXet = 2;
        }

        if ((TBCHocKyDangXet >= 2) && (TBCHocKyDangXet <= 2.49)) {
            $('#Khoa_TC3_4').val($('#Khoa_TC3_4').attr('max_value'));
            bac_HocKyDangXet = 1;
        }

        if (TBCHocKyDangXet < 2) {
            $('#Khoa_TC3_5').val($('#Khoa_TC3_5').attr('max_value'));
        }

        //Hoc ky truoc//
        if ((TBCHocKyTruoc >= 3.60) && (TBCHocKyTruoc <= 4)) {
            bac_HocKyTruoc = 4;
        }

        if ((TBCHocKyTruoc >= 3.20) && (TBCHocKyTruoc <= 3.59)) {
            bac_HocKyTruoc = 3;
        }

        if ((TBCHocKyTruoc >= 2.50) && (TBCHocKyTruoc <= 3.19)) {
            bac_HocKyTruoc = 2;
        }

        if ((TBCHocKyTruoc >= 2) && (TBCHocKyTruoc <= 2.49)) {
            bac_HocKyTruoc = 1;
        }

        //console.log(bac_HocKyDangXet + "---" + bac_HocKyTruoc)
        //So sanh bac
        if ((bac_HocKyDangXet - bac_HocKyTruoc) == 1) {
            $('#Khoa_TC3_6').val($('#Khoa_TC3_6').attr('max_value'));
        }

        if ((bac_HocKyDangXet - bac_HocKyTruoc) > 1) {
            $('#Khoa_TC3_6').val($('#Khoa_TC3_6').attr('max_value'));
        }


        //Kích hoạt sự kiên onchange manually vì value set bằng javascript kh hoạt động onchange
        input_TC3_1 = document.getElementById('Khoa_TC3_1');
        ev_TC3_1 = document.createEvent('Event');
        ev_TC3_1.initEvent('change', true, false);
        input_TC3_1.dispatchEvent(ev_TC3_1);

        input_TC3_2 = document.getElementById('Khoa_TC3_2');
        ev_TC3_2 = document.createEvent('Event');
        ev_TC3_2.initEvent('change', true, false);
        input_TC3_2.dispatchEvent(ev_TC3_2);

        input_TC3_3 = document.getElementById('Khoa_TC3_3');
        ev_TC3_3 = document.createEvent('Event');
        ev_TC3_3.initEvent('change', true, false);
        input_TC3_3.dispatchEvent(ev_TC3_3);

        input_TC3_4 = document.getElementById('Khoa_TC3_4');
        ev_TC3_4 = document.createEvent('Event');
        ev_TC3_4.initEvent('change', true, false);
        input_TC3_4.dispatchEvent(ev_TC3_4);

        input_TC3_5 = document.getElementById('Khoa_TC3_5');
        ev_TC3_5 = document.createEvent('Event');
        ev_TC3_5.initEvent('change', true, false);
        input_TC3_5.dispatchEvent(ev_TC3_5);


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
        let _isAllowedToScore = false;

        // Nếu lần đầu tiên click nút xem chi tiết phiếu hoặc xem phiếu khác với phiếu trước đó đã xem
        if (typeof(phieuRenLuyen.thongTinPhieu.maPhieuRenLuyen) === "undefined" 
            || maPhieuRenLuyen != phieuRenLuyen.thongTinPhieu.maPhieuRenLuyen) {
            var oldPhieuRenLuyen = phieuRenLuyen;
            phieuRenLuyen = getThongTinPhieuRenLuyen(maPhieuRenLuyen);

            // Kiểm tra phiếu rèn luyện cần xem có cùng các tiêu chí của phiếu rèn luyện cũ?
            // Nếu giống => bỏ qua việc tạo lại form và ngược lại
            if (!arraysEqual(oldPhieuRenLuyen.tieuChiCap1, phieuRenLuyen.tieuChiCap1)
                || !arraysEqual(oldPhieuRenLuyen.tieuChiCap2, phieuRenLuyen.tieuChiCap2)
                || !arraysEqual(oldPhieuRenLuyen.tieuChiCap3, phieuRenLuyen.tieuChiCap3)) {
                createPhieuRenLuyenForm(
                    {
                        tieuChiCap1: phieuRenLuyen.tieuChiCap1,
                        tieuChiCap2: phieuRenLuyen.tieuChiCap2,
                        tieuChiCap3: phieuRenLuyen.tieuChiCap3,
                    },
                    phieuRenLuyen.thongBaoDanhGia,
                    getCookie('quyen'),
                    "#tbody_noiDungDanhGia",
                );

                // Xóa nút duyệt điểm nếu user role không phải là 'khoa' hoặc nằm ngoài thời gian đánh giá
                _isAllowedToScore = isAllowedToScore(phieuRenLuyen.thongBaoDanhGia, getCookie("quyen"), ["khoa"]);
                if(!_isAllowedToScore) {
                    $('#formDanhGiaDRL').find(':submit').remove();
                }
            }
        } 
            
        $('#text_maPhieuRenLuyen_XemVaDuyet').text(maPhieuRenLuyen);
        setThongTinSinhVien(phieuRenLuyen.sinhVien, phieuRenLuyen.hocKyDanhGia, "#part_thongTinSinhVien");
        setDiemPhieuRenLuyen(phieuRenLuyen.thongTinPhieu, 
                            phieuRenLuyen.diemTieuChiCap2, 
                            phieuRenLuyen.diemTieuChiCap3, 
                            phieuRenLuyen.thongBaoDanhGia, 
                            getCookie('quyen'), 
                            "#tbody_noiDungDanhGia");

        if (_isAllowedToScore) {
            TinhDiemTongCong();
        }
	})

    $(document).on("submit", ".form_exportPDFPhieuRenLuyen", function(e) {
        // e.preventDefault();
        let maPhieuRenLuyen = $(this).parent().children('.btn_XemVaDuyet').attr('data-id');

        phieuRenLuyen = getThongTinPhieuRenLuyen(maPhieuRenLuyen);

        // console.log(phieuRenLuyen)

        $(this).children('.data').val(
            JSON.stringify(phieuRenLuyen)
        );

		return true;
    })

	//Xem danh sách hoạt động tham gia
	$(document).on("click", ".btn_XemDanhSachHoatDong", function() {

		let thamgiahd_maTieuChi = $(this).attr('data-tieuchi-id');
		let thamgiahd_tenTieuChi = $(this).attr('data-tentieuchi');
		let thamgiahd_maHocKyDanhGia = $('#input_maHocKyDanhGia').val();

		$('#id_thamgiahd_tieuChiDuocCong').text(thamgiahd_tenTieuChi);

		LoadDanhSachHoatDongDaThamGia(thamgiahd_maHocKyDanhGia, thamgiahd_maTieuChi);
	})
	
	$(document).on("click", ".btn_AnhMinhChung", function() {
            let img_id = $(this).attr('data-img-id');
            let src_img_id = $("#"+img_id).attr('src');

            $('#id_img_modal').attr("src", src_img_id);
    })

	//Duyệt điểm
	function DuyetDiemRenLuyen() {
        var GET_MaHocKy = $('#input_maHocKyDanhGia').text();
        var GET_MaSinhVien = $('#text_maSV').text();
        var GET_MaLop = $('#text_MaLop').text();

        $("form#formDanhGiaDRL").on("submit", function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Xác nhận duyệt điểm rèn luyện?',
                showDenyButton: true,
                confirmButtonText: 'Xác nhận',
                denyButtonText: `Đóng`,
            }).then((result) => {
                if (result.isConfirmed) {
                    if (checkValidateInput()) {
                        var _inputMaSinhVien = GET_MaSinhVien;
                        var _inputDiemTBCHKTruoc = $("#inputTBCHocKyTruoc").val();
                        var _inputDiemTBCHKDangXet = $("#inputTBCHocKyDangXet").val();
                        var _inputMaHocKyDanhGia = $("#input_maHocKyDanhGia").val();
                        // var _inputDiemTongCong = Number($('#input_diemtongcong').val());
                        var _inputXepLoai = '';

                        var _inputMaPhieuRenLuyen = "PRL" + _inputMaHocKyDanhGia + _inputMaSinhVien;
                        //vd: maPhieuRenLuyen = PRLHK121223118410262

                        _inputXepLoai = $("#text_XepLoai").text();
                        
                        var formData = new FormData(document.getElementById('formDanhGiaDRL'));
                        formData.append("maPhieuRenLuyen", _inputMaPhieuRenLuyen);
                        formData.append("maSinhVien", _inputMaSinhVien);
                        formData.append("maHocKyDanhGia", _inputMaHocKyDanhGia);
                        formData.append("xepLoai", _inputXepLoai);
                        formData.append("coVanDuyet", 1);
                        formData.append("khoaDuyet", 1); //khoa duyệt
                
                    
                        //update phiếu rèn luyện trước
                        $.ajax({
                            url: urlapi_phieurenluyen_update,
                            async: false,
                            type: "POST",
                            contentType: false,
                            cache: false,
                            processData: false,
                            //dataType: "json",
                            data: formData,
                            headers: {
                                Authorization: jwtCookie,
                            },
                            success: function(resultUpdate) {
                            
                                $.ajax({
                                    url: urlapi_chamdiemrenluyen_read_maPhieuRenLuyen + _inputMaPhieuRenLuyen,
                                    async: false,
                                    type: "GET",
                                    contentType: "application/json;charset=utf-8",
                                    dataType: "json",
                                    headers: {
                                        Authorization: jwtCookie,
                                    },
                                    success: function(resultGET) {
                                        $.each(resultGET, function (index_GET) {
                                            for (var q = 0;q < resultGET[index_GET].length;q++) {
                                                var maTieuChi3 = resultGET[index_GET][q].maTieuChi3;
                                                var maTieuChi2 = resultGET[index_GET][q].maTieuChi2;
                                                var diemSinhVienDanhGia = resultGET[index_GET][q].diemSinhVienDanhGia;
                                                var diemLopDanhGia = resultGET[index_GET][q].diemLopDanhGia;
                                                var maChamDiemRenLuyen = resultGET[index_GET][q].maChamDiemRenLuyen;
                                                var ghiChu = resultGET[index_GET][q].ghiChu;

                                                //Vòng lặp input để tạo các hàng giá trị của chamdiemrenluyen theo mã phiếu điểm rèn luyện
                                                $("#tbody_noiDungDanhGia").find("input").each(function() {
                                                    if (this.value != "") {
                                                        var _inputDiemKhoaDanhGia = this.value;
                                                        var tieuChi = this.id.slice(0, 8);

                                                        //Chưa xử lý thêm ghi chú (thêm 1 switch case trước switch case tiêu chí này)
                                                        if (tieuChi == "Khoa_TC2") {
                                                            var _inputMaTieuChi2 = this.id.slice(9, this.id.length);

                                                            //Cập nhật row
                                                            if (maTieuChi2 === _inputMaTieuChi2 ){
                                                                    
                                                                var stringFormIDTemp = "formDanhGiaDRL_TC2_" + _inputMaTieuChi2;

                                                                var formData_TC2 = new FormData(document.getElementById(stringFormIDTemp));
                                                                formData_TC2.append("maChamDiemRenLuyen", maChamDiemRenLuyen);
                                                                formData_TC2.append("maPhieuRenLuyen", _inputMaPhieuRenLuyen);
                                                                formData_TC2.append("maTieuChi3", 0);
                                                                formData_TC2.append("maTieuChi2", _inputMaTieuChi2);
                                                                formData_TC2.append("maSinhVien", _inputMaSinhVien);
                                                                formData_TC2.append("diemSinhVienDanhGia", diemSinhVienDanhGia);
                                                                formData_TC2.append("diemLopDanhGia", diemLopDanhGia);
                                                                formData_TC2.append("diemKhoaDanhGia", _inputDiemKhoaDanhGia);
                                                                formData_TC2.append("ghiChu", ghiChu);

                                                                $.ajax({
                                                                    url: urlapi_chamdiemrenluyen_update,
                                                                    data: formData_TC2,
                                                                    async: false,
                                                                    type: "POST",
                                                                    contentType: false,
                                                                    cache: false,
                                                                    processData: false,
                                                                    //dataType: "json",
                                                                    headers: {
                                                                        Authorization: jwtCookie,
                                                                    },
                                                                    success: function(resultUpdate_ChamDiemRenLuyen) {
                                                                        //console.log(resultCreate_ChamDiemRenLuyen);
                                                                    },
                                                                    error: function(errorMessage) {
                                                                        Swal.fire({
                                                                            icon: "error",
                                                                            title: "Thông báo",
                                                                            text: errorMessage.responseText,
                                                                            //timer: 5000,
                                                                            timerProgressBar: true,
                                                                        });
                                                                    },
                                                                });
                                                            }
                                                        }

                                                        if (tieuChi == "CVHT_TC3"){
                                                            var _inputMaTieuChi3 = this.id.slice(9, this.id.length);

                                                            //Nếu đã có row rồi thì cập nhật cột diemLopDanhGia, ngược lại tạo row mới
                                                            if (maTieuChi3 === _inputMaTieuChi3 ){
                                                                    
                                                                var stringFormIDTemp_2 = document.getElementById("formDanhGiaDRL_TC3_" + _inputMaTieuChi3);

                                                                var formData_TC3 = new FormData(stringFormIDTemp_2);
                                                                formData_TC3.append("maChamDiemRenLuyen", maChamDiemRenLuyen);
                                                                formData_TC3.append("maPhieuRenLuyen", _inputMaPhieuRenLuyen);
                                                                formData_TC3.append("maTieuChi3", _inputMaTieuChi3);
                                                                formData_TC3.append("maTieuChi2", 0);
                                                                formData_TC3.append("maSinhVien", _inputMaSinhVien);
                                                                formData_TC3.append("diemSinhVienDanhGia", diemSinhVienDanhGia);
                                                                formData_TC3.append("diemLopDanhGia", diemLopDanhGia);
                                                                formData_TC3.append("diemKhoaDanhGia", _inputDiemKhoaDanhGia);
                                                                formData_TC3.append("ghiChu", ghiChu);

                                                                $.ajax({
                                                                    url: urlapi_chamdiemrenluyen_update,
                                                                    data: formData_TC3,
                                                                    async: false,
                                                                    type: "POST",
                                                                    contentType: false,
                                                                    cache: false,
                                                                    processData: false,
                                                                    //dataType: "json",
                                                                    headers: {
                                                                        Authorization: jwtCookie,
                                                                    },
                                                                    success: function(resultCreate_ChamDiemRenLuyen) {
                                                                        //console.log(resultCreate_ChamDiemRenLuyen);
                                                                    },
                                                                    error: function(errorMessage) {
                                                                        Swal.fire({
                                                                            icon: "error",
                                                                            title: "Thông báo",
                                                                            text: errorMessage.responseText,
                                                                            //timer: 5000,
                                                                            timerProgressBar: true,
                                                                        });
                                                                    },
                                                                });
                                                            }
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    },
                                    error: function(errorMessage) {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Thông báo",
                                            text: errorMessage.responseText,
                                            //timer: 5000,
                                            timerProgressBar: true,
                                        });
                                    },
                                });

                                $('#ModalXemVaDuyet').modal('hide');

                                Swal.fire({
                                    icon: "success",
                                    title: "Duyệt điểm rèn luyện thành công!",
                                    text: "Đang chuyển hướng...",
                                    timer: 2500,
                                    timerProgressBar: true,
                                });

                                window.setTimeout(function() {
                                    GetListPhieurenluyen($('#select_Lop').val());
                                }, 2500);
                            },
                            error: function(errorMessage_tc3) {

                                Swal.fire({
                                    icon: "error",
                                    title: "Lỗi",
                                    text: errorMessage_tc3.responseText,
                                    //timer: 5000,
                                    timerProgressBar: true,
                                });
                            },
                        });
                    }
                }
            })
        });
    }

</script>