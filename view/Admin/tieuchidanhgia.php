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
							<button class="btn app-btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#AddModal">Thêm mới</button>
						</div>


						<!--//col-->


					</div>
					<!--//row-->
				</div>
				<!--//table-utilities-->
			</div>
			<!--//col-auto-->

			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							...
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Save changes</button>
						</div>
					</div>
				</div>
			</div>


			<!-- Modal chỉnh sửa -->
			<div class="modal fade" id="ChinhSuaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<img src="assets/images/icons/edit.png" width="25px" style="padding-right: 5px;">
							<h5 class="modal-title" id="exampleModalLabel"> Chỉnh sửa tiêu chí</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">

							<div class="mb-3">
								<label for="edit_input_CapTieuChi" class="form-label" style="color: black; font-weight: 500;">Cấp tiêu chí </label>
								<input type="text" class="form-control mb-2" id="edit_input_CapTieuChi" placeholder="Nhập cấp tiêu chí..." readonly>
							</div>

							<div class="mb-3">
								<label for="edit_input_MaTieuChi" class="form-label" style="color: black; font-weight: 500;">Mã tiêu chí</label>
								<input type="text" class="form-control mb-2" id="edit_input_MaTieuChi" placeholder="Nhập mã lớp..." readonly>
							</div>

							<div class="mb-3">
								<label for="edit_input_TenTieuChi" class="form-label" style="color: black; font-weight: 500;">Tên tiêu chí</label>
								<input type="text" class="form-control" id="edit_input_TenTieuChi" placeholder="Nhập tên tiêu chí...">
							</div>

							<div class="mb-3">
								<label for="edit_input_Diem" class="form-label" style="color: black; font-weight: 500;">Điểm</label>
								<input type="number" class="form-control" id="edit_input_Diem" placeholder="Nhập điểm...">
							</div>

							<div class="mb-3">
								<label for="edit_select_TieuChiCapTren" class="form-label" style="color: black; font-weight: 500;">Tiêu chí cấp trên</label>
								<select class="form-select" aria-label="Default select example" id="edit_select_TieuChiCapTren">

								</select>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
							<button type="button" class="btn btn-warning" style='color: white;' onclick="return ChinhSua_TieuChiDanhGia()">Chỉnh sửa</button>
						</div>
					</div>
				</div>
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
										<th class="cell">Tên tiêu chí</th>
										<th class="cell">Điểm</th>
										<th class="cell">Mã tiêu chí trên</th>
										<th class="cell"></th>
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


<script>
	var tieuChi_selected = "tieuchicap1";
	//hàm trong function.js
	GetListTieuChi(tieuChi_selected);

	$('#selected_tieuchi').on('change', function() {
		var tieuChi_selected = $('#selected_tieuchi').val();
		// let tr = document.createElement("<th class='cell'>Điểm</th>");
		// $('$coloum_table').append(tr);
		GetListTieuChi(tieuChi_selected);

	});

	var select_TieuChi_search = document.getElementById('selected_tieuchi');

    dselect(select_TieuChi_search, {
          search: true
    })

	//Xử lý chỉnh sửa
	$(document).on("click", ".btn_ChinhSua_TieuChiDanhGia", function() {

		var maTieuChi = $(this).attr('data-id');
		var get_tieuchicap = $(this).attr('data-tieuchicap');
		var get_tentieuchi = $(this).attr('data-tentieuchi');
		var get_diem = $(this).attr('data-diem');
		var get_tieuchicaptren = $(this).attr('data-tieuchicaptren');

		$('#edit_input_CapTieuChi').val(get_tieuchicap);
		$('#edit_input_MaTieuChi').val(maTieuChi);
		$('#edit_input_TenTieuChi').val(get_tentieuchi);
		$('#edit_input_Diem').val(get_diem);

		LoadTieuChiCapTren_ChinhSuaModal(get_tieuchicap, get_tieuchicaptren);

		var select_TieuChiCapTren_search = document.getElementById('edit_select_TieuChiCapTren');

		dselect(select_TieuChiCapTren_search, {
			search: true
		})
		//edit modal
		// var edit_select_box_element_Khoa = document.querySelector('#edit_select_Khoa_Add');

		// dselect(edit_select_box_element_Khoa, {
		// 	search: true
		// });

		


	})
</script>