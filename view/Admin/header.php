<?php
	
	

?>

<!DOCTYPE html>
<html lang="vi"> 
<head>
    <title>
		<?php 
			$page_word = explode("/", $_SERVER['REQUEST_URI'] );

			switch (end($page_word)) {
				case 'index.php':{
					echo "Thống kê | Web điểm rèn luyện";
					break;
				}
					
				case 'sinhvien.php':{
					echo "Sinh viên | Web điểm rèn luyện";
					break;
				}

				case 'lop.php':{
					echo "Lớp | Web điểm rèn luyện";
					break;
				}

				case 'covanhoctap.php':{
					echo "Cố vấn học tập | Web điểm rèn luyện";
					break;
				}

				case 'khoa.php':{
					echo "Khoa | Web điểm rèn luyện";
					break;
				}

				case 'phieurenluyen.php':{
					echo "Phiếu rèn luyện | Web điểm rèn luyện";
					break;
				}

				case 'hoatdongdanhgia.php':{
					echo "Hoạt động đánh giá | Web điểm rèn luyện";
					break;
				}

				case 'tieuchidanhgia.php':{
					echo "Tiêu chí đánh giá | Web điểm rèn luyện";
					break;
				}

				case 'thongbaodanhgia.php':{
					echo "Thông báo đánh giá | Web điểm rèn luyện";
					break;
				}


				default:{
					echo "Web điểm rèn luyện";
					break;
				}
					
			}
			
		?>

	</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
	<script src="assets/js/jquery-3.6.0.js"></script>
	<script src="assets/js/sweetalert2.all.min.js"></script>
	
	<!-- Pagination -->
	<script src="assets/js/pagination.min.js"></script>

	<link rel="stylesheet" href="assets/css/pagination.css"/>	
	
    
	<script src="assets/js/check_token.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

	
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
		            <div class="app-search-box col">
		                <form class="app-search-form">   
							<input type="text" placeholder="Tìm kiếm..." name="search" class="form-control search-input">
							<button type="submit" class="btn search-btn btn-primary" value="Search"><i class="fas fa-search"></i></button> 
				        </form>
		            </div><!--//app-search-box-->
		            
		            <div class="app-utilities col-auto">
			            <div class="app-utility-item app-notifications-dropdown dropdown">    
				     
									        
				        </div><!--//app-utility-item-->
			            <div class="app-utility-item">
				            <span><?php if (isset($_COOKIE['hoTenNhanVien'])) echo $_COOKIE['hoTenNhanVien']; ?></span>
					    </div><!--//app-utility-item-->
			            
			            <div class="app-utility-item app-user-dropdown dropdown">
				            <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img src="assets/images/user.png" alt="user profile"></a>
				            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
								
								<li><a class="dropdown-item" href="#">
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
		            <a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"><span class="logo-text">PORTAL</span></a>
	
		        </div><!--//app-branding-->  
		        
			    <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
				    <ul class="app-menu list-unstyled accordion" id="menu-accordion">



					    <li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link <?php if (end($page_word) == 'index.php') echo 'active'; ?>" href="index.php">
						        <span class="nav-icon">
									<img src="assets/images/icons/home.png" alt="icon tổng quan/thống kê" width="10%">
						         </span>
		                         <span class="nav-link-text">Thống kê</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->


						<li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link <?php if (end($page_word) == 'sinhvien.php') echo 'active'; ?>" href="sinhvien.php">
						        <span class="nav-icon">
									<img src="assets/images/icons/group.png" alt="icon sinh viên" width="10%">
						         </span>
		                         <span class="nav-link-text">Sinh viên</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->

						<li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link <?php if (end($page_word) == 'lop.php') echo 'active'; ?>" href="lop.php">
						        <span class="nav-icon">
									<img src="assets/images/icons/class.png" alt="icon lớp" width="10%">
						         </span>
		                         <span class="nav-link-text">Lớp</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->

						<li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link <?php if (end($page_word) == 'covanhoctap.php') echo 'active'; ?>" href="covanhoctap.php">
						        <span class="nav-icon">
									<img src="assets/images/icons/presentation.png" alt="icon cố vấn học tập" width="10%">
						         </span>
		                         <span class="nav-link-text">Cố vấn học tập</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->


						<li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link <?php if (end($page_word) == 'khoa.php') echo 'active'; ?>" href="khoa.php">
						        <span class="nav-icon">
									<img src="assets/images/icons/user.png" alt="icon khoa" width="10%">
						         </span>
		                         <span class="nav-link-text">Khoa</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->

						<li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link <?php if (end($page_word) == 'phieurenluyen.php') echo 'active'; ?>" href="phieurenluyen.php">
						        <span class="nav-icon">
									<img src="assets/images/icons/document.png" alt="icon phiếu chấm điểm" width="10%">
						         </span>
		                         <span class="nav-link-text">Phiếu rèn luyện</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->

						<li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link <?php if (end($page_word) == 'hoatdongdanhgia.php') echo 'active'; ?>" href="hoatdongdanhgia.php">
						        <span class="nav-icon">
									<img src="assets/images/icons/class.png" alt="icon hoạt động" width="10%">
						         </span>
		                         <span class="nav-link-text">Hoạt động đánh giá</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->

						<li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link <?php if (end($page_word) == 'tieuchidanhgia.php') echo 'active'; ?>" href="tieuchidanhgia.php">
						        <span class="nav-icon">
									<img src="assets/images/icons/society.png" alt="icon tiêu chí" width="10%">
						         </span>
		                         <span class="nav-link-text">Tiêu chí đánh giá</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->

						<li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link <?php if (end($page_word) == 'thongbaodanhgia.php') echo 'active'; ?>" href="thongbaodanhgia.php">
						        <span class="nav-icon">
									<img src="assets/images/icons/social.png" alt="icon thông báo đánh giá" width="10%">
						         </span>
		                         <span class="nav-link-text">Thông báo đánh giá</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->

				    </ul><!--//app-menu-->
			    </nav><!--//app-nav-->
			    
		       
	        </div><!--//sidepanel-inner-->
	    </div><!--//app-sidepanel-->
    </header><!--//app-header-->