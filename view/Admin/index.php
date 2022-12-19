
<!DOCTYPE html>
<html lang="vi"> 
<head>
    <title >Web điểm rèn luyện</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 

	<!-- Goong.io maps API -->
	<script src="https://cdn.jsdelivr.net/npm/@goongmaps/goong-js@1.0.9/dist/goong-js.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/@goongmaps/goong-js@1.0.9/dist/goong-js.css" rel="stylesheet" />


	<!-- Local -->
	<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> 
	<!-- <script src="assets/plugins/popper.min.js"></script> -->
	<script src="assets/js/jquery-3.6.0.js"></script>

	<!-- Select search code -->
	<script src="assets/js/dselect.js"></script>

	<!-- JQuery UI -->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

	
	<script src="assets/js/sweetalert2.all.min.js"></script>
	
	<!-- Pagination -->
	<script src="assets/js/pagination.min.js"></script>

	<link rel="stylesheet" href="assets/css/pagination.css"/>	
	
	<!-- Custom JS -->
	<script src="assets/js/app.js"></script>
	
	<script src="assets/js/check_token.js"></script>

	<script src="../config/urlapi.js" ></script>

	<!-- Chart -->
	<script src="assets/plugins/chart.js/chart.min.js"></script> 
   
   <!-- Virtual Select CSS -->  
   <link rel="stylesheet" href="assets/css/virtual-select.min.css">

	<!-- Virtual Select JS -->
	<script src="assets/js/virtual-select.min.js"></script> 
   
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
	
	<!-- Constants Chuc Nang JS -->
	<script src="../constants/constants_chucNang.js"></script> 

	<script>
		
		function LoadContentMainPage(fileNamePage) {
			$('#content-main-page').empty();

			$('#content-main-page').load(fileNamePage);

		}

		//Get hoTenNhanVien
		var hoTenNhanVien = '';
		if (getCookie('hoTenNhanVien') != null) {
			hoTenNhanVien = getCookie('hoTenNhanVien');
		} else if (getCookie('hoTen') != null) {
			hoTenNhanVien = getCookie('hoTen');
		}

		//Logout
		function DangXuat() {
			var _input_MaSo = getCookie('taiKhoan');

			var dataPost = {
				maSo: _input_MaSo
			}

			$.ajax({
				url: urlapi_logout_client,
				data: JSON.stringify(dataPost),
				type: "POST",
				contentType: "application/json;charset=utf-8",
				dataType: "json",
				async: false,
				success: function (result) {

				deleteAllCookies();

				Swal.fire({
					icon: "success",
					title: "Đăng xuất thành công!",
					text:"Đang chuyển hướng...",
					timer: 1000,
					timerProgressBar: true,
					showConfirmButton: false,
				});
				
				
				
				setTimeout(function () {
					window.location.href = 'login.php';
				}, 1000);

				},
				error: function (errorMessage) {
				Swal.fire({
					icon: "error",
					title: "Lỗi đăng xuất",
					text: errorMessage.responseText,
					timer: 3000,
					timerProgressBar: true,
				});
				},
			});
		}

	</script>
	
</head> 

<!-- Preloader -->
<div class="loader_bg">
	<div class="loader"></div>
</div>


<body>   

    <header class="app-header fixed-top">	   	            
        <div class="app-header-inner">  
	        <div class="container-fluid py-2">
		        <div class="app-header-content"> 
		            <div class="row justify-content-between align-items-center">
			        
				    <div class="col-auto">
					    <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
						    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
					    </a>
				    </div><!--//col-->
		            <div class="search-mobile-trigger d-sm-none col">
			            <i class="search-mobile-trigger-icon fas fa-search"></i>
			        </div><!--//col-->
		            
		            <div class="app-utilities col-auto">
			            <div class="app-utility-item app-notifications-dropdown dropdown">    
				     
									        
				        </div><!--//app-utility-item-->
			            <div class="app-utility-item">
				            <span><script>document.write(hoTenNhanVien);</script></span>
					    </div><!--//app-utility-item-->
			            
			            <div class="app-utility-item app-user-dropdown dropdown">
				            <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img src="assets/images/user.png" alt="user profile"></a>
				            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
								
								<li><a class="dropdown-item" href="" onclick='return DangXuat();'>
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
										<path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
								 	 </svg> 
								  
								Đăng xuất</a></li>
							</ul>
			            </div><!--//app-user-dropdown--> 
		            </div><!--//app-utilities-->
		        </div><!--//row-->
	            </div><!--//app-header-content-->
	        </div><!--//container-fluid-->
        </div><!--//app-header-inner-->
        <div id="app-sidepanel" class="app-sidepanel"> 
	        <div id="sidepanel-drop" class="sidepanel-drop"></div>
	        <div class="sidepanel-inner d-flex flex-column">
		        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
		        <div class="app-branding">
		            <a class="app-logo" href="index.php"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"><span class="logo-text">ĐIỂM RÈN LUYỆN</span></a>
	
		        </div><!--//app-branding-->  
		        
			    <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
				    <ul class="app-menu list-unstyled accordion" id="menu-accordion" >


						

				    </ul><!--//app-menu-->
			    </nav><!--//app-nav-->
			    
		       
	        </div><!--//sidepanel-inner-->
	    </div><!--//app-sidepanel-->

	
    </header><!--//app-header-->

	<div class="app-wrapper" id="content-main-page" >

	
	</div>
	<!--//app-wrapper-->

	<script>
		$(document).ready(function() {

			if (_getQuyen.localeCompare('admin') === 0) {
				LoadContentMainPage("quantrivien.php");
			} else {
				LoadContentMainPage("sinhvien.php");
			}
			
		});
		
		var _getQuyen = getCookie('quyen');

		$('#menu_feature li').empty();

		if (_getQuyen.localeCompare('admin') === 0){
			$('#menu-accordion').append("<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link' onclick='LoadContentMainPage(\"quantrivien.php\");' id='menu-button-QuanTriVien' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/admin.png' alt='icon quản trị viên' width='25px'>\
						         </span>\
		                         <span class='nav-link-text'>Quản trị viên</span>\
					        </a>\
					    </li>");
		}

		if (_getQuyen.localeCompare('ctsv') === 0 || _getQuyen.localeCompare('admin') === 0){
			$('#menu-accordion').append("<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link'  onclick='LoadContentMainPage(\"sinhvien.php\");' id='menu-button-SinhVien'>\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/group.png' alt='icon sinh viên' width='10%'>\
						         </span>\
		                         <span class='nav-link-text'>Sinh viên</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link'  onclick='LoadContentMainPage(\"lop.php\");' id='menu-button-Lop' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/class.png' alt='icon lớp' width='10%'>\
						         </span>\
		                         <span class='nav-link-text'>Lớp</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link' onclick='LoadContentMainPage(\"covanhoctap.php\");' id='menu-button-CoVanHocTap'>\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/presentation.png' alt='icon cố vấn học tập' width='10%'>\
						         </span>\
		                         <span class='nav-link-text'>Cố vấn học tập</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link' onclick='LoadContentMainPage(\"khoa.php\");' id='menu-button-Khoa' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/user.png' alt='icon khoa' width='10%'>\
						         </span>\
		                         <span class='nav-link-text'>Khoa</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link' onclick='LoadContentMainPage(\"phieurenluyen.php\");' id='menu-button-PhieuRenLuyen' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/document.png' alt='icon phiếu chấm điểm' width='10%'>\
						         </span>\
		                         <span class='nav-link-text'>Phiếu rèn luyện</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link'  onclick='LoadContentMainPage(\"hoatdongdanhgia.php\");' id='menu-button-HoatDongDanhGia' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/crowd.png' alt='icon hoạt động' width='10%'>\
						         </span>\
		                         <span class='nav-link-text'>Hoạt động đánh giá</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link'  onclick='LoadContentMainPage(\"tieuchidanhgia.php\");' id='menu-button-TieuChiDanhGia'>\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/society.png' alt='icon tiêu chí' width='10%'>\
						         </span>\
		                         <span class='nav-link-text'>Tiêu chí đánh giá</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link'  onclick='LoadContentMainPage(\"thongbaodanhgia.php\");' id='menu-button-ThongBaoDanhGia' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/social.png' alt='icon thông báo đánh giá' width='10%'>\
						         </span>\
		                         <span class='nav-link-text'>Thông báo đánh giá</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link' onclick='LoadContentMainPage(\"khieunai.php\");' id='menu-button-KhieuNai' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/complaint.png' alt='icon khiếu nại' width='25px'>\
						         </span>\
		                         <span class='nav-link-text'>Khiếu nại</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link' onclick='LoadContentMainPage(\"thongke.php\");' id='menu-button-ThongKe' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/analysis.png' alt='icon thống kê tình trạng chấm' width='25px'>\
						         </span>\
		                         <span class='nav-link-text'>Thống kê tình trạng chấm</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link' onclick='LoadContentMainPage(\"thongkecanhcao.php\");' id='menu-button-ThongKeCanhCao' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/bad-score-analytics.png' alt='icon thống kê cảnh cáo' width='25px'>\
						         </span>\
		                         <span class='nav-link-text'>Thống kê cảnh cáo</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link' onclick='LoadContentMainPage(\"caidat.php\");' id='menu-button-CaiDat' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/settings.png' alt='icon cài đặt' width='25px'>\
						         </span>\
		                         <span class='nav-link-text'>Cài đặt</span>\
					        </a>\
					    </li>");

		}else{
			if (_getQuyen.localeCompare('khoa') === 0 ){
				$('#menu-accordion').append("<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link'  onclick='LoadContentMainPage(\"sinhvien.php\");' id='menu-button-SinhVien'>\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/group.png' alt='icon sinh viên' width='10%'>\
						         </span>\
		                         <span class='nav-link-text'>Sinh viên</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link'  onclick='LoadContentMainPage(\"lop.php\");' id='menu-button-Lop' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/class.png' alt='icon lớp' width='10%'>\
						         </span>\
		                         <span class='nav-link-text'>Lớp</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link' onclick='LoadContentMainPage(\"covanhoctap.php\");' id='menu-button-CoVanHocTap'>\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/presentation.png' alt='icon cố vấn học tập' width='10%'>\
						         </span>\
		                         <span class='nav-link-text'>Cố vấn học tập</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link' onclick='LoadContentMainPage(\"phieurenluyen.php\");' id='menu-button-PhieuRenLuyen' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/document.png' alt='icon phiếu chấm điểm' width='10%'>\
						         </span>\
		                         <span class='nav-link-text'>Phiếu rèn luyện</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link'  onclick='LoadContentMainPage(\"hoatdongdanhgia.php\");' id='menu-button-HoatDongDanhGia' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/crowd.png' alt='icon hoạt động' width='10%'>\
						         </span>\
		                         <span class='nav-link-text'>Hoạt động đánh giá</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link' onclick='LoadContentMainPage(\"khieunai.php\");' id='menu-button-KhieuNai' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/complaint.png' alt='icon khiếu nại' width='25px'>\
						         </span>\
		                         <span class='nav-link-text'>Khiếu nại</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link' onclick='LoadContentMainPage(\"thongke.php\");' id='menu-button-ThongKe' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/analysis.png' alt='icon thống kê tình trạng chấm' width='25px'>\
						         </span>\
		                         <span class='nav-link-text'>Thống kê tình trạng chấm</span>\
					        </a>\
					    </li>\
						<li class='nav-item' style='cursor: pointer;'>\
					        <a class='nav-link' onclick='LoadContentMainPage(\"thongkecanhcao.php\");' id='menu-button-ThongKeCanhCao' >\
						        <span class='nav-icon'>\
									<img src='assets/images/icons/bad-score-analytics.png' alt='icon thống kê cảnh cáo' width='25px'>\
						         </span>\
		                         <span class='nav-link-text'>Thống kê cảnh cáo</span>\
					        </a>\
					    </li>");
			}
			
		}


	</script>
	
</body>
<script>
	function objectsEqual(o1, o2) { 
		return typeof o1 === 'object' && Object.keys(o1).length > 0 
			? Object.keys(o1).length === Object.keys(o2).length 
				&& Object.keys(o1).every(p => objectsEqual(o1[p], o2[p]))
			: o1 === o2;
	}

	function arraysEqual(a1, a2) {
		return a1.length === a2.length && a1.every((o, idx) => objectsEqual(o, a2[idx]));
	} 

	setTimeout(function() {
		$('.loader_bg').fadeToggle();
	}, 1000);

	
</script>

</html>