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
							<select class="form-select w-auto" id = "selected_tieuchi">
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

				

				<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					<div class="app-card app-card-orders-table shadow-sm mb-5">
						<div class="app-card-body">
							<div class="table-responsive">
								<table class="table app-table-hover mb-0 text-left" >
									<thead>
										<tr id = "coloum_table">
											<th class="cell">STT</th>
											<th class="cell">Mã Tiêu Chí</th>
											<th class="cell">Tên Tiêu Chí</th>
											<th class="cell">Điểm</th>
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

	$('#selected_tieuchi').on('change', function(){
		var tieuChi_selected = $('#selected_tieuchi').val();
		// let tr = document.createElement("<th class='cell'>Điểm</th>");
		// $('$coloum_table').append(tr);
		GetListTieuChi(tieuChi_selected);
	
	});
 

</script>
