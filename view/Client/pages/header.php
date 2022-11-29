<?php
include_once __DIR__ . "/helpers/checkcookie.php";

$checkCookie = new CheckCookie();

$page_word = explode("/", $_SERVER['REQUEST_URI']);

//echo end($page_word);

if (strcmp(end($page_word), 'dangnhap.php') != 0) {
    $checkCookie->CheckAuthLogin();
}

if (isset($_COOKIE['jwt'])){
    $jwt = $_COOKIE['jwt'];
    $dataToken = CheckCookie::read_data_token($jwt);

    if ($dataToken['status'] == 1 ){
        $quyenNguoiDung = $dataToken['user_data']->aud;
        $quyen = $_COOKIE['quyen'];
        $maSo = $_COOKIE['maSo'];
    }else{
        setcookie("jwt", "", time() -3600);
        
        setcookie("hoTen", "", time() -3600);
        setcookie("maSo", "", time() -3600);

        header('Location: dangnhap.php');
    }
   
    
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Your description">
    <meta name="author" content="Your name">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
    <meta property="og:site_name" content="" />
    <!-- website name -->
    <meta property="og:site" content="" />
    <!-- website link -->
    <meta property="og:title" content="" />
    <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" />
    <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" />
    <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" />
    <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image">
    <!-- to have large image post format in Twitter -->

    <!-- Webpage Title -->
    <title>
        <?php 
			//$page_word = explode("/", $_SERVER['REQUEST_URI'] );

            $active_dangNhap = '';
            $active_chamDiem = '';
            $active_chamDiemChiTiet = '';
            $active_CVHT_DuyetDiem = '';
            $active_CVHT_NhapDiem = '';
            $active_Khoa_DuyetDiem = '';
            $active_TraCuuDiem = '';
            $active_TraCuuHoatDong = '';
            $active_TaiKhoan = '';

			switch (end($page_word)) {
				case 'dangnhap.php':{
					echo "Đăng nhập | Điểm rèn luyện";
                    $active_dangNhap = "active";
                
					break;
				}
					
				case 'chamdiem.php':{
					echo "Chấm điểm | Điểm rèn luyện";
                    $active_chamDiem = "active";
					break;
				}

				case 'chamdiemchitiet.php':{
					echo "Chấm điểm chi tiết | Điểm rèn luyện";
                    $active_chamDiemChiTiet = "active";
					break;
				}

				case 'cvht_duyetdiemrenluyen.php':{
					echo "Duyệt điểm rèn luyện | CVHT | Điểm rèn luyện";
                    $active_CVHT_DuyetDiem = "active";
					break;
				}

                case 'nhapdiemhe4.php':{
					echo "Nhập điểm hệ 4";
                    $active_CVHT_NhapDiem = "active";
					break;
				}

				case 'khoa_duyetdiemrenluyen.php':{
					echo "Duyệt điểm rèn luyện | Khoa | Điểm rèn luyện";
                    $active_Khoa_DuyetDiem = "active";
					break;
				}

				case 'tracuudiemrenluyen.php':{
					echo "Tra cứu điểm rèn luyện | Điểm rèn luyện";
                    $active_TraCuuDiem = "active";
					break;
				}

				case 'tracuuhoatdongthamgia.php':{
					echo "Tra cứu hoạt động tham gia | Điểm rèn luyện";
                    $active_TraCuuHoatDong = "active";
					break;
				}

                case 'taikhoan.php':{
					echo "Quản lý tài khoản";
                    $active_TaiKhoan = "active";
					break;
				}

				default:{
					echo "Điểm rèn luyện";
					break;
				}
			}
			
            
		?>

    </title>

    <!-- MDB -->
    <link rel="stylesheet" href="../css/mdb.min.css" />

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/fontawesome-all.min.css" rel="stylesheet">
    
    <link href="../css/swiper.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    
    <script src="../js/jquery-3.6.0.js"></script>
    
    <script src="../js/sweetalert2.all.min.js"></script>

    <!-- Favicon  -->
    <link rel="icon" href="../images/SGU-LOGO-400x400.png">

    

    <!-- Custom Script -->
    <script src="../js/dangnhap/dangnhap.js"></script>
    <script src="../../config/urlapi.js" ></script>
    

</head>

<!-- Preloader -->
<div class="loader_bg">
    <div class="loader"></div>
</div>

<body data-bs-spy="scroll" data-bs-target="#navbarExample" >

    <!-- Navigation -->
    <nav id="navbarExample" class="navbar navbar-expand-lg fixed-top navbar-light" aria-label="Main navigation" style="background: white;">
        <div class="container">

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="tracuudiemrenluyen.php"><img src="../images/logo.png" alt="alternative"></a>

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text" href="index.html">Nubis</a> -->

            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ms-auto navbar-nav-scroll d-flex align-items-center">
                    <?php 
                        if(end($page_word) != 'dangnhap.php') {
                            echo "
                                <li class='nav-item'>
                                    <a class='nav-link ".((end($page_word) == 'tracuudiemrenluyen.php') ? " active'" : "'") ." href='tracuudiemrenluyen.php' style='text-transform: uppercase;'> Tra cứu điểm rèn luyện</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link ". $active_TraCuuHoatDong . "' href='tracuuhoatdongthamgia.php'  style='text-transform: uppercase;'> Tra cứu hoạt động tham gia</a>
                                </li>";
                        }
                    ?>
                
                    <!-- Chức năng chung -->
                    <!-- <li class="nav-item">
                        <a class="nav-link <?php //if (end($page_word) == 'tracuudiemrenluyen.php') echo 'active'; ?>" href="tracuudiemrenluyen.php" style="text-transform: uppercase;"> Tra cứu điểm rèn luyện</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php //echo $active_TraCuuHoatDong; ?>" href="tracuuhoatdongthamgia.php"  style="text-transform: uppercase;"> Tra cứu hoạt động tham gia</a>
                    </li> -->

                    <!-- Chức năng sinh viên -->
                    <?php 
                        if (isset($quyenNguoiDung)){
                            switch ($quyenNguoiDung) {
                                case 'sinhvien':{
                                    echo "<li class='nav-item'>
                                        <a class='nav-link ". $active_chamDiem ."' href='chamdiem.php' style='text-transform: uppercase;'> Chấm điểm rèn luyện</a>
                                    </li>";
                                    break;
                                }
                                
                                case 'cvht':{
                                    echo "<li class='nav-item'>
                                            <a class='nav-link ".$active_CVHT_DuyetDiem."' href='cvht_duyetdiemrenluyen.php' style='text-transform: uppercase;'> Duyệt danh sách điểm rèn luyện theo lớp</a>
                                        </li>
                                        <li class='nav-item'>
                                            <a class='nav-link ".$active_CVHT_NhapDiem."' href='nhapdiemhe4.php' style='text-transform: uppercase;'> Nhập điểm </a>
                                        </li>";
                                    break;
                                }
                    
                                case 'khoa':{
                                    echo "<li class='nav-item'>
                                        <a class='nav-link ".$active_Khoa_DuyetDiem."' href='khoa_duyetdiemrenluyen.php'  style='text-transform: uppercase;'> Duyệt danh sách điểm rèn luyện</a>
                                    </li>";
                                    break;
                                }
                            }

                            if (isset($_COOKIE['hoTen'])) $hoten = $_COOKIE['hoTen'];

                            echo "<li class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button' data-mdb-toggle='dropdown' aria-expanded='false' style='text-transform: uppercase;'>
                                    <span class='nav-item' style='text-transform: uppercase;'> 
                                        Xin chào, ". $hoten ." <img class='d-inline-block rounded-circle ms-3' id='avatar' src='' alt='user profile' width='50px'>
                                    </span>
                                </a>
                                <ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                                    <li>
                                        <a class='dropdown-item' href='taikhoan.php' style='text-transform: uppercase;'> <img src='../images/edit-account.png' width='20px'> Tài khoản </a>
                                    </li>
                                    <li>
                                        <hr class='dropdown-divider'>
                                    </li>
                                    <li>
                                        <button class='dropdown-item' id='btn_DangXuat' onclick='return DangXuat();' style='text-transform: uppercase;'><img src='../images/logout.png' width='15px'> Đăng xuất</button>
                                    </li>
                                </ul>
                            </li>";

                         
                        }else{
                            echo "<li class='nav-item'>
                                <a class='nav-link ". $active_dangNhap ."' href='dangnhap.php' style='text-transform: uppercase;'> Đăng nhập</a>
                            </li>";
                        }


                    ?>
                    

                    



                </ul>


            </div>
            <!-- end of navbar-collapse -->
     
        </div>
        <!-- end of container -->
    </nav>
    <!-- end of navbar -->
    <!-- end of navigation -->

    <script>
        setTimeout(function() {
            $('.loader_bg').fadeToggle();
        }, 1000);


    </script>
    <!-- Custom Script -->
    <script src="../js/header/header.js"></script>

	<!-- Constants Chuc Nang JS -->
	<script src="../../constants/constants_chucNang.js"></script> 