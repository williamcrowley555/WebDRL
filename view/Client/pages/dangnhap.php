<?php
    include_once "header.php";

    include_once __DIR__."/helpers/checkcookie.php";

    $checkCookie = new CheckCookie();

    if ($checkCookie->CheckAuthLogin()->maSinhVien != null){
        echo $checkCookie->CheckAuthLogin()->maSinhVien;

    }
?>


    <!-- Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <h3 style="text-transform: uppercase;">Đăng nhập</h3>
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container -->
    </header>
    <!-- end of header -->
    <!-- end of header -->

    <div style="width: 100%;">
        <div class="container">
            <div class="row" style="margin: 0 auto;text-align: center;background: white;border-radius: 10px;">
                <form style="padding: 48px;" id="formLogin">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                      <input type="text" id="inputLogin_MSSV" class="form-control" />
                      <label class="form-label" for="form1Example1">Mã số sinh viên</label>
                    </div>
                  
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                      <input type="password" id="inputLogin_MatKhau" class="form-control" />
                      <label class="form-label" for="form1Example2">Mật khẩu</label>
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                      
                    </div>
                  
                    <!-- Submit button -->
                    <button type="button" style="width:fit-content;" class="btn btn-primary btn-block" id="btnLogin" >Đăng nhập</button>
                  </form>
            </div>
            <!-- end of row -->
        </div>

        <!-- end of container -->
  


    <!-- Footer -->
    <div class="footer">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">


                </div>
                <!-- end of col -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container -->
    </div>
    <!-- end of footer -->
    <!-- end of footer -->


    <!-- Back To Top Button -->
    <button onclick="topFunction()" id="myBtn">
        <img src="../images/up-arrow.png" alt="alternative">
    </button>
    <!-- end of back to top button -->

    <!-- Scripts -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Bootstrap framework -->
    <script src="../js/swiper.min.js"></script>
    <!-- Swiper for image and text sliders -->
    <script src="../js/scripts.js"></script>

    <!-- Custom scripts -->
    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

   

    <script src="../js/sweetalert2.all.min.js"></script>

    <script>
    $( document ).ready(function() {
        setTimeout(function(){
            $('.loader_bg').fadeToggle();
        }, 1000);

        
        var inputMSSV = document.getElementById("inputLogin_MSSV");
        var inputMatKhau = document.getElementById("inputLogin_MatKhau");

        // Execute a function when the user presses a key on the keyboard
        inputMSSV.addEventListener("keypress", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.getElementById("btnLogin").click();
        }
        });

        inputMatKhau.addEventListener("keypress", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.getElementById("btnLogin").click();
        }
        });


        //Login
        $("#btnLogin").on("click",function(){
            var inputMSSV_value = $("#inputLogin_MSSV").val();
            var inputMatKhau_value = $("#inputLogin_MatKhau").val();

            Login(inputMSSV_value, inputMatKhau_value);
        });
    })

        



    </script>
</body>

</html>