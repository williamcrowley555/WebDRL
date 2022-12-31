<?php
    include_once "header.php";

    if (!($quyenNguoiDung == 'sinhvien' || $quyenNguoiDung == 'cvht')) {
        echo "<script>history.go(-1)</script>";
    }

    if (!isset($_GET['maHocKy'])) {
        echo "<script>window.location.href = 'chamdiem.php';</script>";
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
            <div style="padding: 48px;">
                <h6 style="text-transform: uppercase; text-align: left;">--Thông tin sinh viên--</h6>
                <div class="form-outline mb-4">
                    <div class="row justify-content-center" style="padding-bottom: 30px;text-align: start;" id="part_thongTinSinhVien">

                    </div>
                </div>

                <h6 style="text-transform: uppercase; text-align: left;">--PHIẾU ĐÁNH GIÁ ĐIỂM RÈN LUYỆN--</h6>

                <form id='formDanhGiaDRL' method="post" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <div class="row justify-content-center" style="padding-bottom: 30px;text-align: start;">
                            <table class="table table-hover table-bordered" id="tablePhieuRenLuyen">
                                <thead>
                                    <tr style="text-align: center;">
                                    </tr>
                                </thead>

                                <tbody id="tbody_noiDungDanhGia">

                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: auto;">Chấm điểm</button>
                        <button type='button' data-bs-toggle='modal' data-bs-target='#ModalExportPRL' class='btn btn_XuatPRL' style='color: white;background: #c04f4f;margin: 5px;'>
                            <img src='../../Admin/assets/images/icons/pdf.png' width='17px' />
                            <span style='margin-left: 5px;'>Xuất phiếu</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end of row -->
    </div>

    <!-- end of container -->

    <!-- Modal xuất phiếu rèn luyện -->
    <div class="modal fade" id="ModalExportPRL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="" method='POST' class="modal-dialog" id="form_export_prl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Xuất phiếu rèn luyện </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label class="mb-3 form-label" style="color: black; font-weight: 500;">Vui lòng chọn loại file muốn tải về</label>

                    <input type='hidden' name='data' class='data' />

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="radio" name="fileTypeExport" value="doc" id="radioExportWord" checked>
                        <label class="form-check-label" for="radioExportWord">
                            Word (.doc)
                        </label>
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="radio" name="fileTypeExport" value="pdf" id="radioExportPDF">
                        <label class="form-check-label" for="radioExportPDF">
                            PDF (.pdf)
                        </label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success" style='color: white;'>Tải về</button>
                </div>
            </div>
        </form>
    </div>


    <!-- Modal xem danh sách hoạt động-->
    <div class="modal fade" id="XemDanhSachHoatDongModal" tabindex="-1" aria-labelledby="XemDanhSachHoatDongModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Danh sách hoạt động đã tham gia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div>
                    <span style="font-weight: 700" >Tiêu chí được cộng: </span><span id="id_thamgiahd_tieuChiDuocCong" ></span>
                    </div>
                    
                    <hr>
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left table-hover">
                            <thead>
                                <tr>
                                    <th class="cell">Mã hoạt động</th>
                                    <th class="cell">Tên hoạt động</th>
                                    <th class="cell">Điểm nhận được</th>
                                </tr>
                            </thead>

                            <tbody id="id_tbody_DanhSachThamGiaHoatDong">
                                <!-- <tr>
                                    <td colspan="4" style="text-align:center">Không tìm thấy kết quả.</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Phieu Ren Luyen Helper JS -->
    <script src="../../../helper/js/phieuRenLuyen.js"></script>

    <!-- Export Word JS -->
    <script src="../../../helper/js/export_word.js"></script>

    <!-- Custom scripts -->
    <script src="../js/chamdiemchitiet/chamdiemchitiet.js"></script>

    <script>
        getPhieuRenLuyenTitle().forEach(function(title) {
            $("#tablePhieuRenLuyen>thead>tr").append(`<th scope="col"><strong>${title}</strong></th>`);
        });

        $('form#formDanhGiaDRL').find(':submit').text(
            getCookie("quyen") == "sinhvien" ? "Chấm điểm" : "Duyệt điểm"
        );

        let maPhieuRenLuyen = null;
        let maSinhVienGET = null;
        let maHocKyDanhGiaGET = url.searchParams.get("maHocKy");
        let _isAllowedToScore = false;

        if (getCookie("quyen") == 'sinhvien') {
            maSinhVienGET = getCookie("maSo");
        } else if (getCookie("quyen") == 'cvht') {
            maSinhVienGET = url.searchParams.get("maSinhVien");
        } 

        if (maSinhVienGET != null && maHocKyDanhGiaGET != null) {
            maSinhVienGET = maSinhVienGET.trim();
            maHocKyDanhGiaGET = maHocKyDanhGiaGET.trim();

            // Tìm phiếu rèn luyện theo mã sinh viên và học kỳ đánh giá
            $.ajax({
                url: urlapi_phieurenluyen_single_read_MaHKDG_MaSV + maHocKyDanhGiaGET +"&maSinhVien=" + maSinhVienGET,
                async: false,
                type: "GET",
                contentType: "application/json;charset=utf-8",
                dataType: "json",
                headers: {
                    Authorization: jwtCookie,
                },
                success: function (result_PRL) {
                    maPhieuRenLuyen = result_PRL.maPhieuRenLuyen;
                },
                error: function (errorPRL) {},
            });
            
            phieuRenLuyen = getThongTinPhieuRenLuyen(maPhieuRenLuyen);

            // Nếu phiếu không tồn tại => Lấy các tiêu chí đang được kích hoạt để hiển thị
            if (typeof(phieuRenLuyen.thongTinPhieu.maPhieuRenLuyen) === "undefined") {
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

                // Lấy thông tin sinh viên nếu chưa có
                if (jQuery.isEmptyObject(phieuRenLuyen.sinhVien)) {
                    $.ajax({
                        url: urlapi_sinhvien_details_read + maSinhVienGET,
                        async: false,
                        type: "GET",
                        contentType: "application/json;charset=utf-8",
                        dataType: "json",
                        headers: {
                            Authorization: jwtCookie,
                        },
                        success: function (result) {
                            phieuRenLuyen.sinhVien = result;
                            phieuRenLuyen.thongTinPhieu.maSinhVien = result.maSinhVien
                        },
                        error: function (error) {},
                    });
                }

                // Lấy thông tin học kỳ đánh giá nếu chưa có
                if (jQuery.isEmptyObject(phieuRenLuyen.hocKyDanhGia)) {
                    $.ajax({
                        url: urlapi_hockydanhgia_single_read + maHocKyDanhGiaGET,
                        async: false,
                        type: "GET",
                        contentType: "application/json;charset=utf-8",
                        dataType: "json",
                        headers: {
                            Authorization: jwtCookie,
                        },
                        success: function (result_HKDG) {
                            phieuRenLuyen.hocKyDanhGia = result_HKDG;
                            phieuRenLuyen.thongTinPhieu.maHocKyDanhGia = result_HKDG.maHocKyDanhGia;
                        },
                        error: function (error) {},
                    });
                }

                // Lấy thông báo đánh giá nếu chưa có
                if (jQuery.isEmptyObject(phieuRenLuyen.thongBaoDanhGia)) {
                    $.ajax({
                        url: urlapi_thongbaodanhgia_single_read_MaHKDG + maHocKyDanhGiaGET,
                        async: false,
                        type: "GET",
                        contentType: "application/json;charset=utf-8",
                        dataType: "json",
                        headers: {
                            Authorization: jwtCookie,
                        },
                        success: function (result_TBDG) {
                            phieuRenLuyen.thongBaoDanhGia = result_TBDG;
                        },
                        error: function (error) {},
                    });
                }

                // Xóa nút và form xuất phiếu rèn luyện
                $('.btn_XuatPRL').remove();
                $('#ModalExportPRL').remove();
            }

            createPhieuRenLuyenForm(
                {
                    tieuChiCap1: phieuRenLuyen.tieuChiCap1,
                    tieuChiCap2: phieuRenLuyen.tieuChiCap2,
                    tieuChiCap3: phieuRenLuyen.tieuChiCap3,
                },
                phieuRenLuyen.thongBaoDanhGia,
                getCookie('quyen'),
                "#tbody_noiDungDanhGia",
            );

            // Xóa nút duyệt điểm nếu user role không phải là 'sinhvien', 'cvht' hoặc nằm ngoài thời gian đánh giá
            _isAllowedToScore = isAllowedToScore(phieuRenLuyen.thongBaoDanhGia, getCookie("quyen"), ["sinhvien", "cvht"]);
            if(!_isAllowedToScore) {
                $('form#formDanhGiaDRL').find(':submit').remove();
            }
                
            setThongTinSinhVien(phieuRenLuyen.sinhVien, phieuRenLuyen.hocKyDanhGia, "#part_thongTinSinhVien");
            setDiemPhieuRenLuyen(phieuRenLuyen.thongTinPhieu, 
                                phieuRenLuyen.diemTieuChiCap2, 
                                phieuRenLuyen.diemTieuChiCap3, 
                                phieuRenLuyen.thongBaoDanhGia, 
                                getCookie('quyen'), 
                                "#tbody_noiDungDanhGia");

            xuLyLuuDiemRenLuyen(phieuRenLuyen, getCookie('quyen'), "form#formDanhGiaDRL", function() {
                Swal.fire({
                    icon: "success",
                    title: "Chấm điểm rèn luyện thành công!",
                    text: "Đang chuyển hướng...",
                    timer: 2000,
                    timerProgressBar: true,
                });

                window.setTimeout(function() {
                    if (getCookie('quyen') == 'sinhvien') {
                        window.location.href = 'chamdiem.php';
                    } else {
                        window.location.href = 'cvht_danhsachsinhvien.php?maLop=' + phieuRenLuyen.sinhVien.maLop;
                    }
                }, 2000);
            });
        } else {
            if (getCookie('quyen') == 'sinhvien') {
                window.location.href = 'chamdiem.php';
            } else {
                $.ajax({
                    url: urlapi_sinhvien_details_read + maSinhVienGET,
                    async: false,
                    type: "GET",
                    contentType: "application/json;charset=utf-8",
                    dataType: "json",
                    headers: {
                        Authorization: jwtCookie,
                    },
                    success: function (result) {
                        window.location.href = 'cvht_danhsachsinhvien.php?maLop=' + result.maLop;
                    },
                    error: function (error) {},
                });
            }
        }

        function javascriptInputFile() {
            var inputs = document.querySelectorAll('.inputfile');
            Array.prototype.forEach.call(inputs, function(input) {
                var label = input.nextElementSibling,
                    labelVal = label.innerHTML;

                input.addEventListener('change', function(e) {
                    var fileName = '';
                    if (this.files && this.files.length > 1)
                        fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                    else
                        fileName = e.target.value.split('\\').pop();

                    if (fileName)
                        label.querySelector('span').innerHTML = fileName;
                    else
                        label.innerHTML = labelVal;
                });

                // Firefox bug fix
                input.addEventListener('focus', function() {
                    input.classList.add('has-focus');
                });
                input.addEventListener('blur', function() {
                    input.classList.remove('has-focus');
                });
            });
        }

        javascriptInputFile();

        //Xem danh sách hoạt động tham gia
        $(document).on("click", ".btn_XemDanhSachHoatDong" ,function() {

            let thamgiahd_maTieuChi = $(this).attr('data-tieuchi-id');
            let thamgiahd_tenTieuChi = $(this).attr('data-tentieuchi');
            let thamgiahd_maHocKyDanhGia = $('#input_maHocKyDanhGia').val();
            let thamgiahd_maSinhVien = getCookie("maSo");

            $('#id_thamgiahd_tieuChiDuocCong').text(thamgiahd_tenTieuChi);

            LoadDanhSachHoatDongDaThamGia(thamgiahd_maHocKyDanhGia, thamgiahd_maTieuChi, thamgiahd_maSinhVien);
        })

        // Xử lý click nút xuất phiếu
        $(document).on("click", ".btn_XuatPRL", function() {
            $('#form_export_prl').trigger("reset");
        })

        // Xuất phiếu rèn luyện
        $(document).on("submit", "#form_export_prl", function(e) {
            $(this).find('.data').val(
                JSON.stringify(phieuRenLuyen)
            );

            var fileType = $('input[name="fileTypeExport"]:checked').val();

            if (fileType.toLowerCase() == 'doc') {
                $(this).attr('action', '');

                var formData = new FormData(this);

                // Tạo HTML Phieu Ren Luyen 
                $.ajax({
                    url: host_domain_url + '/helper/phieuRenLuyenGenerator.php',
                    type: "POST",
                    data: formData,
                    processData: false, 
                    contentType: false,
                    enctype: 'multipart/form-data',
                    mimeType: 'multipart/form-data',
                    success: function (result) {
                        result = JSON.parse(result);

                        exportToWord(result.htmlPhieuRenLuyen, 'phieu_ren_luyen');
                    },
                });

                return false;
            } else if (fileType.toLowerCase() == 'pdf') {
                $(this).attr('action', host_domain_url + '/mpdf/export_phieuRenLuyen.php');
            } 

            return true;
        })

    </script>

    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

    </body>

    </html>