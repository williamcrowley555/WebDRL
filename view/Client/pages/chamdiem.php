<?php
    include_once "header.php";

    if ($quyenNguoiDung != 'sinhvien'){
      echo "<script>history.go(-1)</script>";
    }
?>
 

    <!-- Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <h3 style="text-transform: uppercase;">Chấm điểm rèn luyện</h3>
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

                <!-- Modal ảnh minh chứng -->
                <div class="modal fade" id="AnhMinhChungModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#KhieuNaiModal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="" class="minh-chung-img" style="width: 100%;" alt="modal img">
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Modal gửi khiếu nại -->
                <div class="modal fade" id="KhieuNaiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form action="" class="modal-dialog" id="form_khieu_nai">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> Khiếu nại</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <input type="hidden" name="maHocKy" id="khieuNai_maHocKy"/>

                                <div class="mb-3 form-group text-start">
                                    <label for="textarea_lyDoKhieuNai" class="form-label" style="color: black; font-weight: 600;">Lý do khiếu nại</label>
                                    <textarea class="form-control" name="lyDoKhieuNai" id="textarea_lyDoKhieuNai" rows="8"></textarea>
                                    <span class="invalid-feedback position-relative"></span>
                                </div>

                                <div class="mb-0 form-group text-start">
                                    <label class="form-label mb-3" id="label_uploadMinhChung" style="color: black; font-weight: 600;"></label>
                                    <input type="file" id="file-minhChung" name="minhChung[]" accept="image/png, image/jpeg" onchange="preview(this)" multiple style="display: none;">
                                    <label for="file-minhChung" style="display: block; position: relative; background-color: #025bee; color: #ffffff; font-size: 18px; text-align: center; width: max-content; padding: 10px; margin: auto; border-radius: 5px; cursor: pointer;">
                                        <i class="fas fa-upload"></i> &nbsp; Tải minh chứng
                                    </label>
                                    <p id="num-of-files" style="text-align: center; margin: 20px 0;">Không có file được chọn</p>
                                    <div id="images" style="width: 90%; position: relative; margin: auto; display: flex; justify-content: space-evenly; gap: 20px; flex-wrap: wrap;"></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary" style='color: white;'>Xác nhận</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div style="padding: 48px;">
                    <div class="form-outline mb-4">
                        
                        <div class="row justify-content-center" style="padding-bottom: 20px;">
                            <div class="col-6">
                               <span style="font-weight: bold;">Họ tên sinh viên: </span><span id="text_HoTen" ></span>
                            </div>
                            <div class="col-4">
                                <span style="font-weight: bold;">Mã số sinh viên: </span><span id="text_MaSo"></span> 
                            </div>
                        </div>

                        <div class="row justify-content-center" style="padding-bottom: 30px;">
                            <div class="col-6">
                               <span style="font-weight: bold;">Họ tên cố vấn: </span><span id="text_HoTenCoVan" ></span> (<span id="text_MaCoVan" ></span>)
                            </div>
                            <div class="col-4">
                                <span style="font-weight: bold;">Lớp: </span><span id="text_maLop"></span> 
                            </div>
                        </div>

                        <table class="table align-middle mb-0 bg-white table-hover">
                            <thead class="bg-light">
                                <tr>
                                <th>Học kỳ</th>
                                <th>Năm học</th>
                                <th>Trạng thái chấm</th>
                                <th>Cố vấn duyệt</th>
                                <th>Khoa duyệt</th>
                                <th>Điểm</th>
                                <th>Xếp loại</th>
                                <th>Ngày bắt đầu chấm</th>
                                <th>Ngày kết thúc chấm</th>
                                <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody_hocKyDanhGia" >
                                
                            </tbody>
                        </table>
                    </div>  
                </div>

                <p class="mb-3 fw-bold text-body">LƯU Ý: Mỗi sinh viên chỉ được phép khiếu nại duy nhất 1 lần cho mỗi phiếu rèn luyện. Vui lòng xem xét kỹ trước khi gửi khiếu nại.</p>

                <form action='http://localhost/WebDRL/mpdf/export_mauPhieuRenLuyen.php' method='POST' id='formDownloadMauPhieuRenLuyen' class='text-center pb-2'>
                    <input type='hidden' name='data' class='data' />
                    <p>Tải về mẫu phiếu rèn luyện <button type='submit' class='btn btn-link bg-white p-0' style='outline: none; box-shadow: none;'>tại đây</button></p>
                </form>
            </div>
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
    <!-- Form Validator -->
    <script src="../../Admin/assets/js/validator.js"></script>

    <script src="../js/chamdiem/chamdiem.js"></script>

    <script>
        Validator({
            form: '#form_khieu_nai',
            formGroupSelector: '.form-group',
            errorSelector: '.invalid-feedback',
            rules: [
                Validator.isRequired('#textarea_lyDoKhieuNai', 'Vui lòng nhập lý do khiếu nại'),
            ],
            onSubmit: GuiKhieuNai
        })

        getThongTinHocKyDanhGia();
        
        let fileInput = document.getElementById("file-minhChung");
        let imageContainer = document.getElementById("images");
        let numOfFiles = document.getElementById("num-of-files");
            
        const limitedFiles = 4;

        function preview(input) {
            const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];

            // Kiểm tra các file upload đều là file ảnh
            for (var i = 0; i < fileInput.files.length; i++) {
                if (!validImageTypes.includes(fileInput.files[i]['type'])) {
                    input.value = '';
                    imageContainer.innerHTML = '';
                    numOfFiles.textContent = 'Không có file được chọn';
                    
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi",
                        text: `Các minh chứng tải lên phải là file ảnh!`,
                        timer: 2500,
                        timerProgressBar: true,
                    });

                    return;
                }
            }

            if (parseInt(input.files.length) > limitedFiles) {
                input.value = '';
                imageContainer.innerHTML = '';
                numOfFiles.textContent = 'Không có file được chọn';
                
                Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    text: `Chỉ được phép upload tối đa ${limitedFiles} ảnh minh chứng!`,
                    timer: 2500,
                    timerProgressBar: true,
                });
            } else {
                imageContainer.innerHTML = "";
                numOfFiles.textContent = `${fileInput.files.length} Files Được Chọn`;

                for(i of fileInput.files) {
                    let reader = new FileReader();
                    let figure = document.createElement("figure");
                    figure.style.width = "45%";
                    reader.onload=()=>{
                        let img = document.createElement("img");
                        img.style.width = "100%";
                        img.style.cursor = "pointer";
                        img.setAttribute("src", reader.result);
                        img.classList.add("minh-chung-item");

                        figure.appendChild(img);
                    }
                    imageContainer.appendChild(figure);
                    reader.readAsDataURL(i);
                }
            }
        }

	    // Xử lý xem ảnh minh chứng
        document.addEventListener("click", function (e) {
            if(e.target.classList.contains("minh-chung-item")) {
                const src = e.target.getAttribute("src");
                document.querySelector(".minh-chung-img").src = src;

                $('#KhieuNaiModal').find('.btn-close').trigger('click');

                const AnhMinhChungModal = new bootstrap.Modal(document.getElementById('AnhMinhChungModal'));
                AnhMinhChungModal.show();
            }
        })

        $(document).on("click", ".btn_KhieuNai", function() {
            let maHocKy = $(this).attr('data-maHocKy');

            // Lấy thông tin học kỳ đánh giá
            $.ajax({
                url: urlapi_hockydanhgia_single_read + maHocKy,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                    Authorization: jwtCookie,
                },
                success: function (result_HKDG) {
                    $("#form_khieu_nai .modal-title").text(`Khiếu nại Học kỳ: ${result_HKDG.hocKyXet} - Năm học: ${result_HKDG.namHocXet}`);
                },
                error: function (error) {
                    $("#form_khieu_nai .modal-title").text(`Khiếu nại`);
                },
            });

            $("#khieuNai_maHocKy").val(maHocKy);
            $("#textarea_lyDoKhieuNai").val('');
            $("#label_uploadMinhChung").text(`Upload ảnh minh chứng (tối đa ${limitedFiles} ảnh)`);
            $('label[for='+  fileInput.id  +']').show();
            imageContainer.innerHTML = "";
            numOfFiles.textContent = 'Không có file được chọn';
            $("#form_khieu_nai").find(':submit').show();
        })

        $(document).on("click", ".btn_XemLaiKhieuNai", function() {
            let maHocKy = $(this).attr('data-maHocKy');

            // Lấy thông tin học kỳ đánh giá
            $.ajax({
                url: urlapi_hockydanhgia_single_read + maHocKy,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                    Authorization: jwtCookie,
                },
                success: function (result_HKDG) {
                    $("#form_khieu_nai .modal-title").text(`Khiếu nại Học kỳ: ${result_HKDG.hocKyXet} - Năm học: ${result_HKDG.namHocXet}`);
                },
                error: function (error) {
                    $("#form_khieu_nai .modal-title").text(`Khiếu nại`);
                },
            });

            $("#khieuNai_maHocKy").val(maHocKy);
            $("#label_uploadMinhChung").text("Ảnh minh chứng");
            $('label[for='+  fileInput.id  +']').hide();
            $("#form_khieu_nai").find(':submit').hide();

            $.ajax({
                url:
                    urlapi_khieunai_single_read +
                    `?maSinhVien=${getCookie("maSo")}&maHocKyDanhGia=${maHocKy}`,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                    Authorization: jwtCookie,
                },
                success: function (result) {
                    $("#textarea_lyDoKhieuNai").val(result.lyDoKhieuNai);
                    
                    if (result.minhChung) {
                        imageContainer.innerHTML = "";
                        numOfFiles.textContent = "";
                        
                        result.minhChung.split("|").forEach(function(fileName) {
                            if (fileName) {
                                let figure = document.createElement("figure");
                                figure.style.width = "45%";

                                let img = document.createElement("img");
                                img.style.width = "100%";
                                img.style.cursor = "pointer";
                                img.setAttribute("src", `http://localhost/WebDRL//user-images/sinhvien/${getCookie("maSo")}/khieuNai_minhChung/${maHocKy}/${fileName}`);
                                img.classList.add("minh-chung-item");

                                figure.appendChild(img);
                                imageContainer.appendChild(figure);
                            }
                        })
                    } else {
                        numOfFiles.textContent = 'Không có ảnh minh chứng';
                    }
                },
                error: function (error) {
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi",
                        text: "Không tìm thấy khiếu nại của phiếu rèn luyện này!",
                        timer: 2000,
                        timerProgressBar: true,
                    });
                    
                    $("#KhieuNaiModal").find(".btn-close").trigger("click");
                },
            });
        })

        // Download mẫu phiếu rèn luyện
        $(document).on("submit", "#formDownloadMauPhieuRenLuyen", function(e) {
            var phieuRenLuyen = {
                tieuChiCap1: [],
                tieuChiCap2: [],
                tieuChiCap3: []
            };
            
            // Tiêu chí cấp 1
            $.ajax({
                url: urlapi_tieuchicap1_read_kichHoat + "1",
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                    Authorization: jwtCookie,
                },
                success: function (result_TCC1) {
                    result_TCC1["tieuchicap1"].forEach(function (tcc1) {
                        delete tcc1.soThuTu;
                        phieuRenLuyen.tieuChiCap1.push(tcc1);
                    });
                },
                error: function (error) {},
            });
            
            // Tiêu chí cấp 2
            $.ajax({
                url: urlapi_tieuchicap2_read_kichHoat + "1",
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                    Authorization: jwtCookie,
                },
                success: function (result_TCC2) {
                    result_TCC2["tieuchicap2"].forEach(function (tcc2) {
                        delete tcc2.soThuTu;
                        phieuRenLuyen.tieuChiCap2.push(tcc2);
                    });
                },
                error: function (error) {},
            });
            
            // Tiêu chí cấp 3
            $.ajax({
                url: urlapi_tieuchicap3_read_kichHoat + "1",
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                    Authorization: jwtCookie,
                },
                success: function (result_TCC3) {
                    result_TCC3["tieuchicap3"].forEach(function (tcc3) {
                        delete tcc3.soThuTu;
                        phieuRenLuyen.tieuChiCap3.push(tcc3);
                    });
                },
                error: function (error) {},
            });

            $(this).children('.data').val(
                JSON.stringify(phieuRenLuyen)
            );

            return true;
        })
    </script>
    
    <!-- Custom scripts -->
    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

</body>

</html>