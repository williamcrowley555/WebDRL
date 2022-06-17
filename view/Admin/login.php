<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Đăng nhập | Web điểm rèn luyện</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <!-- <script defer src="assets/plugins/fontawesome/js/all.min.js"></script> -->
	<script src="assets/js/sweetalert2.all.min.js"></script>

	<script src="assets/js/auth_login.js"></script>

	<script src="../config/urlapi.js" ></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

	<style>
		body {
			background: linear-gradient(-45deg, #c59282, #e5d5db, #6ac7e8, #23d5ab);
			background-size: 400% 400%;
			animation: gradient 17s ease infinite;
			height: 100vh;
		}

		@keyframes gradient {
			0% {
				background-position: 0% 50%;
			}
			50% {
				background-position: 100% 50%;
			}
			100% {
				background-position: 0% 50%;
			}
		}


	</style>

</head> 
<!-- Preloader -->
<div class="loader_bg">
	<div class="loader"></div>
</div>


<body class="app app-login p-0" >    	
    <div class="row g-0 app-auth-wrapper" style="background: none;">
	    <div class="col-12 text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto" style="width: auto;">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="#"><img class="logo-icon me-2" src="assets/images/SGU-LOGO-400x400.png" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5" style="text-transform: uppercase;">Đăng nhập quản lý<br> Web Điểm rèn luyện</h2>
			        <div class="auth-form-container text-start">
						<form class="auth-form login-form">         
							<div class="email mb-3">
								
								<input id="inputLogin_taiKhoan" name="inputLogin_taiKhoan" type="text" class="form-control signin-email" placeholder="Tài khoản..." required="required">
							</div><!--//form-group-->
							<div class="password mb-3">
								
								<input id="inputLogin_matKhau" name="inputLogin_matKhau" type="password" class="form-control signin-password" placeholder="Mật khẩu..." required="required">
								
							</div><!--//form-group-->
							<div class="text-center">
								<button type="button" id="btnLogin" class="btn app-btn-primary w-100 theme-btn mx-auto" style="text-align: center;" onclick="Login()">ĐĂNG NHẬP</button>
							</div>
						</form>
						
					</div><!--//auth-form-container-->	

			    </div><!--//auth-body-->
		    
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
	    
    
    </div><!--//row-->


	<script src="assets/js/jquery-3.6.0.js"></script>
	<script>
		setTimeout(function() {
			$('.loader_bg').fadeToggle();
		}, 1000);

		
		var inputTaiKhoan = document.getElementById("inputLogin_taiKhoan");
        var input = document.getElementById("inputLogin_matKhau");

        // Execute a function when the user presses a key on the keyboard
        inputTaiKhoan.addEventListener("keypress", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.getElementById("btnLogin").click();
        }
        });

        input.addEventListener("keypress", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.getElementById("btnLogin").click();
        }
        });

	</script>
	<script src="assets/js/auth_login.js"></script>
</body>
</html> 

