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
            $active_SinhVien_NhapDiem = '';
            $active_Khoa_DuyetDiem = '';
            $active_TraCuuDiem = '';
            $active_TraCuuHoatDong = '';
            $active_TaiKhoan = '';

			switch (end($page_word)) {
				case 'dangnhap.php':{
					echo "????ng nh???p | ??i???m r??n luy???n";
                    $active_dangNhap = "active";
                
					break;
				}
					
				case 'chamdiem.php':{
					echo "Ch???m ??i???m | ??i???m r??n luy???n";
                    $active_chamDiem = "active";
					break;
				}

				case 'chamdiemchitiet.php':{
					echo "Ch???m ??i???m chi ti???t | ??i???m r??n luy???n";
                    $active_chamDiemChiTiet = "active";
					break;
				}

				case 'cvht_duyetdiemrenluyen.php':{
					echo "Duy???t ??i???m r??n luy???n | CVHT | ??i???m r??n luy???n";
                    $active_CVHT_DuyetDiem = "active";
					break;
				}

                case 'nhapdiemhe4_CVHT.php':{
					echo "Nh???p ??i???m h??? 4 CVHT";
                    $active_CVHT_NhapDiem = "active";
					break;
				}

                case 'nhapdiemhe4_sinhvien.php':{
					echo "Nh???p ??i???m h??? 4 Sinh vi??n";
                    $active_SinhVien_NhapDiem = "active";
					break;
				}

				case 'khoa_duyetdiemrenluyen.php':{
					echo "Duy???t ??i???m r??n luy???n | Khoa | ??i???m r??n luy???n";
                    $active_Khoa_DuyetDiem = "active";
					break;
				}

				case 'tracuudiemrenluyen.php':{
					echo "Tra c???u ??i???m r??n luy???n | ??i???m r??n luy???n";
                    $active_TraCuuDiem = "active";
					break;
				}

				case 'tracuuhoatdongthamgia.php':{
					echo "Tra c???u ho???t ?????ng tham gia | ??i???m r??n luy???n";
                    $active_TraCuuHoatDong = "active";
					break;
				}

                case 'taikhoan.php':{
					echo "Qu???n l?? t??i kho???n";
                    $active_TaiKhoan = "active";
					break;
				}

				default:{
					echo "??i???m r??n luy???n";
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
                                    <a class='nav-link ".((end($page_word) == 'tracuudiemrenluyen.php') ? " active'" : "'") ." href='tracuudiemrenluyen.php' style='text-transform: uppercase;'> Tra c???u ??i???m r??n luy???n</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link ". $active_TraCuuHoatDong . "' href='tracuuhoatdongthamgia.php'  style='text-transform: uppercase;'> Tra c???u ho???t ?????ng tham gia</a>
                                </li>";
                        }
                    ?>
                
                    <!-- Ch???c n??ng chung -->
                    <!-- <li class="nav-item">
                        <a class="nav-link <?php //if (end($page_word) == 'tracuudiemrenluyen.php') echo 'active'; ?>" href="tracuudiemrenluyen.php" style="text-transform: uppercase;"> Tra c???u ??i???m r??n luy???n</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php //echo $active_TraCuuHoatDong; ?>" href="tracuuhoatdongthamgia.php"  style="text-transform: uppercase;"> Tra c???u ho???t ?????ng tham gia</a>
                    </li> -->

                    <!-- Ch???c n??ng sinh vi??n -->
                    <?php 
                        if (isset($quyenNguoiDung)){
                            switch ($quyenNguoiDung) {
                                case 'sinhvien':{
                                    echo "<li class='nav-item'>
                                            <a class='nav-link ". $active_chamDiem ."' href='chamdiem.php' style='text-transform: uppercase;'> Ch???m ??i???m r??n luy???n</a>
                                        </li>
                                        <li class='nav-item' id='nhapdiem_sinhvien'>
                                            <a class='nav-link ".$active_SinhVien_NhapDiem."' href='nhapdiemhe4_sinhvien.php' style='text-transform: uppercase; width: 95px;'> Nh???p ??i???m h??? 4</a>
                                        </li>";
                                    break;
                                }
                                
                                case 'cvht':{
                                    echo "<li class='nav-item'>
                                            <a class='nav-link ".$active_CVHT_DuyetDiem."' href='cvht_duyetdiemrenluyen.php' style='text-transform: uppercase;'> Duy???t danh s??ch ??i???m r??n luy???n theo l???p</a>
                                        </li>
                                        <li class='nav-item' id='nhapdiem_cvht'>
                                            <a class='nav-link ".$active_CVHT_NhapDiem."' href='nhapdiemhe4_CVHT.php' style='text-transform: uppercase; width: 95px;'> Nh???p ??i???m h??? 4</a>
                                        </li>";
                                    break;
                                }
                    
                                case 'khoa':{
                                    echo "<li class='nav-item'>
                                        <a class='nav-link ".$active_Khoa_DuyetDiem."' href='khoa_duyetdiemrenluyen.php'  style='text-transform: uppercase;'> Duy???t danh s??ch ??i???m r??n luy???n</a>
                                    </li>";
                                    break;
                                }
                            }

                            if (isset($_COOKIE['hoTen'])) $hoten = $_COOKIE['hoTen'];

                            echo "<li class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button' data-mdb-toggle='dropdown' aria-expanded='false' style='text-transform: uppercase;'>
                                    <span class='nav-item' style='text-transform: uppercase;'> 
                                        Xin ch??o, ". $hoten ." <img class='d-inline-block rounded-circle ms-3' id='avatar' src='' alt='user profile' width='50px'>
                                    </span>
                                </a>
                                <ul class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink' style='right: 0px;'>
                                    <li>
                                        <a class='dropdown-item' href='taikhoan.php' style='text-transform: uppercase;'> <img src='../images/edit-account.png' width='20px'> T??i kho???n </a>
                                    </li>
                                    <li>
                                        <hr class='dropdown-divider'>
                                    </li>
                                    <li>
                                        <button class='dropdown-item' id='btn_DangXuat' onclick='return DangXuat();' style='text-transform: uppercase;'><img src='../images/logout.png' width='15px'> ????ng xu???t</button>
                                    </li>
                                </ul>
                            </li>";

                         
                        }else{
                            echo "<li class='nav-item'>
                                <a class='nav-link ". $active_dangNhap ."' href='dangnhap.php' style='text-transform: uppercase;'> ????ng nh???p</a>
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

    <!-- Pagination -->
	<script src="../../Admin/assets/js/pagination.min.js"></script>

    <link rel="stylesheet" href="../../Admin/assets/css/pagination.css"/>

	<!-- Constants Chuc Nang JS -->
	<script src="../../constants/constants_chucNang.js"></script> 

    <!-- Custom Script -->
    <script src="../js/header/header.js"></script>