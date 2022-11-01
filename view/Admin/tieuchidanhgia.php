<script src="assets/js/check_token.js"></script>
<script>
	//remove class active
	$("#menu-button-ThongKe").removeClass("active");
	$("#menu-button-SinhVien").removeClass("active");
	$("#menu-button-HoatDongDanhGia").removeClass("active");
	$("#menu-button-Khoa").removeClass("active");
	$("#menu-button-PhieuRenLuyen").removeClass("active");
	$("#menu-button-CoVanHocTap").removeClass("active");
	$("#menu-button-Lop").removeClass("active");
	$("#menu-button-ThongBaoDanhGia").removeClass("active");
	$("#menu-button-ThongKe").removeClass("active");

	//add class active
	$("#menu-button-TieuChiDanhGia").addClass("active");

	//set title
	document.title = "Tiêu chí đánh giá | Web điểm rèn luyện";
</script>

<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">

		<h1 class="app-page-title">.</h1>
		<h1 class="app-page-title"><img src="assets/images/icons/class.png" alt="" width="30px"> Tiêu chí đánh giá</h1>

		<div class="row g-4 mb-4">

			<div class="col-auto">
				<div class="page-utilities">
					<div class="row g-2 justify-content-start justify-content-md-end align-items-center">

						<div class="col-auto">
							<select class="form-select w-auto" id="selected_tieuchi">
								<option selected value="tieuchicap1">Tiêu chí cấp 1</option>
								<option value="tieuchicap2">Tiêu chí cấp 2</option>
								<option value="tieuchicap3">Tiêu chí cấp 3</option>
							</select>
						</div>



						<div class="col-auto" style="padding-left: 15px;">
							<button class="btn app-btn-primary btn_Them_TieuChi" type="button" data-bs-toggle="modal" data-bs-target="#AddModal">Thêm mới</button>
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
				<form action="" class="modal-dialog" id="AddForm">
					<div class="modal-content">
						<div class="modal-header">
							<img src="assets/images/icons/add.png" width="25px" style="padding-right: 5px;">
							<h5 class="modal-title" id="exampleModalLabel"> Thêm tiêu chí</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="input_CapTieuChi" class="form-label" style="color: black; font-weight: 500;">Cấp tiêu chí </label>
								<select class="form-select" aria-label="Default select example" name="capTC" id="select_CapTieuChi">
									<option selected value="tieuchicap1">Tiêu chí cấp 1</option>
									<option value="tieuchicap2">Tiêu chí cấp 2</option>
									<option value="tieuchicap3">Tiêu chí cấp 3</option>
								</select>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="input_TenTieuChi" class="form-label" style="color: black; font-weight: 500;">Tên tiêu chí</label>
								<input type="text" class="form-control" name="noidung" id="input_TenTieuChi" placeholder="Nhập tên tiêu chí...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="input_Diem" class="form-label" style="color: black; font-weight: 500;">Điểm</label>
								<input type="number" class="form-control" name="diem" id="input_Diem" placeholder="Nhập điểm...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="select_TieuChiCapTren" class="form-label" style="color: black; font-weight: 500;">Tiêu chí cấp trên</label>
								<select class="form-select" aria-label="Default select example" name="tcCapTren" id="select_TieuChiCapTren"></select>
								<span class="invalid-feedback"></span>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-primary" style='color: white;'>Thêm mới</button>
						</div>
					</div>
				</form>
			</div>


			<!-- Modal chỉnh sửa -->
			<div class="modal fade" id="ChinhSuaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form action="" class="modal-dialog" id="EditForm">
					<div class="modal-content">
						<div class="modal-header">
							<img src="assets/images/icons/edit.png" width="25px" style="padding-right: 5px;">
							<h5 class="modal-title" id="exampleModalLabel"> Chỉnh sửa tiêu chí</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3 form-group">
								<label for="edit_select_CapTieuChi" class="form-label" style="color: black; font-weight: 500;">Cấp tiêu chí </label>
								<select class="form-select" aria-label="Default select example" name="capTC" id="edit_select_CapTieuChi"></select>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_input_MaTieuChi" class="form-label" style="color: black; font-weight: 500;">Mã tiêu chí</label>
								<input type="text" class="form-control mb-2" name="matc" id="edit_input_MaTieuChi" placeholder="Nhập mã lớp..." readonly>
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_input_TenTieuChi" class="form-label" style="color: black; font-weight: 500;">Tên tiêu chí</label>
								<input type="text" class="form-control" name="noidung" id="edit_input_TenTieuChi" placeholder="Nhập tên tiêu chí...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_input_Diem" class="form-label" style="color: black; font-weight: 500;">Điểm</label>
								<input type="number" class="form-control" name="diem" id="edit_input_Diem" placeholder="Nhập điểm...">
								<span class="invalid-feedback"></span>
							</div>

							<div class="mb-3 form-group">
								<label for="edit_select_TieuChiCapTren" class="form-label" style="color: black; font-weight: 500;">Tiêu chí cấp trên</label>
								<select class="form-select" aria-label="Default select example" name="tcCapTren" id="edit_select_TieuChiCapTren"></select>
								<span class="invalid-feedback"></span>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="submit" class="btn btn-warning" style='color: white;'>Chỉnh sửa</button>
						</div>
					</div>
				</form>
			</div>


			<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
				<div class="app-card app-card-orders-table shadow-sm mb-5">
					<div class="app-card-body">
						<div class="table-responsive">
							<table class="table app-table-hover mb-0 text-left" >
								<thead id="id_theadTieuChi">
									<tr id="coloum_table">
										<th class="cell">Số thứ tự</th>
										<th class="cell">Mã tiêu chí</th>
										<th class="cell" width="500">Tên tiêu chí</th>
										<th class="cell">Điểm</th>
										<th class="cell">Mã tiêu chí trên</th>
										<th class="cell">Hành động</th>
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
<script src="assets/js/tieuchidanhgia/function.js"></script>


<!-- Form Validator -->
<script src="./assets/js/validator.js"></script>

<script>
	Validator({
        form: '#AddForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isRequired('#select_CapTieuChi', 'Vui lòng chọn cấp tiêu chí'),
			Validator.isRequired('#input_TenTieuChi', 'Vui lòng nhập tên tiêu chí'),
			Validator.isRequired('#input_Diem', 'Vui lòng nhập điểm'),
			Validator.isNumber('#input_Diem', 'Điểm chỉ bao gồm các ký tự số'),
			Validator.minNumber('#input_Diem', 0, "Điểm phải lớn hơn 0"),
			Validator.maxNumber('#input_Diem', 100, "Điểm phải nhỏ hơn 100"),
        ],
        onSubmit: Them_TieuChiDanhGia
    })
	  
	Validator({
        form: '#EditForm',
        formGroupSelector: '.form-group',
        errorSelector: '.invalid-feedback',
        rules: [
			Validator.isRequired('#edit_select_CapTieuChi', 'Vui lòng chọn cấp tiêu chí'),
			Validator.isRequired('#edit_input_MaTieuChi', 'Vui lòng nhập mã tiêu chí'),
			Validator.isNumber('#edit_input_MaTieuChi', 'Mã tiêu chí chỉ bao gồm các ký tự số'),
			Validator.isRequired('#edit_input_TenTieuChi', 'Vui lòng nhập tên tiêu chí'),
			Validator.isRequired('#edit_input_Diem', 'Vui lòng nhập điểm'),
			Validator.isNumber('#edit_input_Diem', 'Điểm chỉ bao gồm các ký tự số'),
			Validator.minNumber('#edit_input_Diem', 0, "Điểm phải lớn hơn 0"),
			Validator.maxNumber('#edit_input_Diem', 100, "Điểm phải nhỏ hơn 100"),
        ],
        onSubmit: ChinhSua_TieuChiDanhGia
    })

	const capTieuChiList = [
		{
			value: 'tieuchicap1',
			text: 'Tiêu chí cấp 1'
		},
		{
			value: 'tieuchicap2',
			text: 'Tiêu chí cấp 2'
		},
		{
			value: 'tieuchicap3',
			text: 'Tiêu chí cấp 3'
		},
	];

	var tieuChi_selected = "tieuchicap1";
	//hàm trong function.js
	GetListTieuChi(tieuChi_selected);

	$('#selected_tieuchi').on('change', function() {
		var tieuChi_selected = $('#selected_tieuchi').val();

		GetListTieuChi(tieuChi_selected);
	});

	$('#select_CapTieuChi').on('change', function() {
		var tieuChi_selected = $('#select_CapTieuChi').val();
		
		LoadTieuChiCapTren_ThemModal(tieuChi_selected);

		// var select_TieuChiCapTren_search = document.getElementById('select_TieuChiCapTren');

		// dselect(select_TieuChiCapTren_search, {
		// 	search: true
		// })
	});

	var select_TieuChi_search = document.getElementById('selected_tieuchi');

    dselect(select_TieuChi_search, {
          search: true
    })

	function appendCapTieuChiOption(selector, capTieuChiValue = undefined) {
		var capTieuChiOptions = capTieuChiList;

		$(selector).find("option").remove();

		if (capTieuChiValue) {
			var capTieuChiOptions = capTieuChiList.filter(function(capTieuChi) {
				return capTieuChi.value == capTieuChiValue;
			});
		}

		capTieuChiOptions.forEach(function(capTieuChi) {
			$(selector).append(
				`<option value='${capTieuChi.value}'>${capTieuChi.text}</option>`
			);
		});
	}

	//Xử lý thêm
	$(document).on("click", ".btn_Them_TieuChi", function() {
		$("#input_TenTieuChi").val('');
		$("#input_Diem").val('');

		$("#select_TieuChiCapTren option").remove();

		appendCapTieuChiOption('#select_CapTieuChi');
	})

	//Xử lý chỉnh sửa
	$(document).on("click", ".btn_ChinhSua_TieuChiDanhGia", function() {

		var maTieuChi = $(this).attr('data-id');
		var get_tieuchicap = $(this).attr('data-tieuchicap');
		var get_tentieuchi = $(this).attr('data-tentieuchi');
		var get_diem = $(this).attr('data-diem');
		var get_tieuchicaptren = $(this).attr('data-tieuchicaptren');

		appendCapTieuChiOption('#edit_select_CapTieuChi', get_tieuchicap);
		$( "#edit_select_CapTieuChi" ).prop( "disabled", true );

		$('#edit_input_MaTieuChi').val(maTieuChi);
		$('#edit_input_TenTieuChi').val(get_tentieuchi);
		$('#edit_input_Diem').val(get_diem);

		LoadTieuChiCapTren_ChinhSuaModal(get_tieuchicap, get_tieuchicaptren);

		var edit_select_TieuChiCapTren_search = document.getElementById('edit_select_TieuChiCapTren');

		dselect(edit_select_TieuChiCapTren_search, {
			search: true
		})
	})

	// Xử lý kích hoạt tiêu chí đánh giá
	$(document).on("click", ".btn_KichHoat_TieuChiDanhGia" ,function() {
		var maTC = $(this).attr('data-id');
		var tieuChi = $(this).attr('data-tieuchicap');

		KichHoatTieuChiDanhGia(maTC, tieuChi);
	})
		
	// Xử lý vô hiệu hóa tiêu chí đánh giá
	$(document).on("click", ".btn_VoHieuHoa_TieuChiDanhGia" ,function() {
		var maTC = $(this).attr('data-id');
		var tieuChi = $(this).attr('data-tieuchicap');

		VoHieuHoaTieuChiDanhGia(maTC, tieuChi)
	})
</script>