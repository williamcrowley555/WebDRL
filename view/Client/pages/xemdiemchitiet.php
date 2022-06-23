<?php
include_once "header.php";

if (!isset($_GET['maHocKy']) && !isset($_GET['maSinhVien'])) {
    echo "<script>window.location.href = 'tracuudiemrenluyen.php';</script>";
}

?>


<!-- Header -->
<header id="header" class="header">
    <div class="container">
        <div class="row">
            <h4 style="text-transform: uppercase;">Xem phiếu điểm rèn luyện</h4>
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

                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th scope="col"><strong>NỘI DUNG ĐÁNH GIÁ</strong></th>
                                        <th scope="col"><strong>Điểm tối đa</strong></th>
                                        <th scope="col"><strong>Điểm SV tự đánh giá</strong></th>
                                        <th scope="col"><strong>Điểm Lớp đánh giá</strong></th>
                                        <th scope="col"><strong>Điểm Khoa đánh giá</strong></th>
                                        <th scope="col"><strong>Điểm nhận từ hoạt động</strong></th>
                                        <th scope="col"><strong>Minh chứng ngoài (nếu có)</strong></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_noiDungDanhGia">

                                </tbody>


                            </table>


                        </div>

                        
                    </div>
                </form>

            </div>
        </div>
        <!-- end of row -->
    </div>

    <!-- end of container -->

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
                        <span style="font-weight: 700">Tiêu chí được cộng: </span><span id="id_thamgiahd_tieuChiDuocCong"></span>
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


    <div class="modal fade" id="AnhMinhChungModal" tabindex="-1" aria-labelledby="AnhMinhChungModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ảnh minh chứng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                   <img src="#" alt="" srcset="" id="id_img_modal" width="300px" />


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

    <!-- Custom scripts -->
    <script src="../js/xemdiemchitiet/xemdiemchitiet.js"></script>

    <script>


    </script>

    <script>
        HienThiThongTinVaDanhGia();
        LoadThongTinSinhVienDanhGia();

        
        //Code tự tính điểm tổng cộng-------------------//
        let calDiemTongCong_SinhVien = 0;
        let calDiemTongCong_CVHT = 0;
        let calDiemTongCong_Khoa = 0;
        let calDiemTongTieuChi1 = 0;
        let calDiemTongTieuChi1_Khoa = 0;
        let calDiemTongTieuChi1_SinhVien = 0;
        $("#tbody_noiDungDanhGia").find("input").each(function() {
            var tieuChi = this.id.slice(0, 8);
            var tieuChi_SinhVien = this.id.slice(0, 3);
            var idDiemTongTieuChi1 = this.id.slice(0, 17);
            var idDiemTongTieuChi1_SinhVien = this.id.slice(0, 12);


            if (tieuChi == 'CVHT_TC2' || tieuChi == 'CVHT_TC3') {
                if (this.value != null) {
                   // calDiemTongCong += Number(this.value);
                    calDiemTongTieuChi1 += Number(this.value);
                    calDiemTongCong_CVHT += Number(this.value);
                }
            }

            if (tieuChi == 'Khoa_TC2' || tieuChi == 'Khoa_TC3') {
                if (this.value != null) {
                   // calDiemTongCong += Number(this.value);
                   calDiemTongTieuChi1_Khoa += Number(this.value);
                   calDiemTongCong_Khoa += Number(this.value);
                }
            }

            if (tieuChi_SinhVien == 'TC2' || tieuChi_SinhVien == 'TC3') {
                if (this.value != null) {
                    calDiemTongTieuChi1_SinhVien += Number(this.value);
                   calDiemTongCong_SinhVien += Number(this.value);
                }
            }

            if (idDiemTongTieuChi1_SinhVien == 'TongCong_TC1') {
                $('#' + this.id).val(calDiemTongTieuChi1_SinhVien);
                calDiemTongTieuChi1_SinhVien = 0;
            }

            if (idDiemTongTieuChi1 == 'CVHT_TongCong_TC1') {
                $('#' + this.id).val(calDiemTongTieuChi1);
                calDiemTongTieuChi1 = 0;
            }

            if (idDiemTongTieuChi1 == 'Khoa_TongCong_TC1') {
                $('#' + this.id).val(calDiemTongTieuChi1_Khoa);
                calDiemTongTieuChi1_Khoa = 0;
            }
            
        });

        $("#input_diemtongcong").val(calDiemTongCong_SinhVien);
        $("#CVHT_input_diemtongcong").val(calDiemTongCong_CVHT);
        $("#Khoa_input_diemtongcong").val(calDiemTongCong_Khoa);
       
        
       
        //Code tự tính điểm tổng cộng-------------------//

        $('#inputTBCHocKyDangXet').on('change', function() {
            TuDongDienDiemTBC();

        });

        $('#inputTBCHocKyTruoc').on('change', function() {
            TuDongDienDiemTBC();

        });


        function TuDongDienDiemTBC() {
            var TBCHocKyDangXet = $('#inputTBCHocKyDangXet').val();
            var TBCHocKyTruoc = $('#inputTBCHocKyTruoc').val();
            var bac_HocKyDangXet = 0;
            var bac_HocKyTruoc = 0;

            $('#CVHT_TC3_1').val('');
            $('#CVHT_TC3_2').val('');
            $('#CVHT_TC3_3').val('');
            $('#CVHT_TC3_4').val('');
            $('#CVHT_TC3_5').val('');
            $('#CVHT_TC3_6').val('');
            $('#CVHT_TC3_7').val('');

            //Hoc ky dang xet
            if ((TBCHocKyDangXet >= 3.60) && (TBCHocKyDangXet <= 4)) {
                $('#CVHT_TC3_1').val($('#CVHT_TC3_1').attr('max_value'));
                bac_HocKyDangXet = 4;
            }

            if ((TBCHocKyDangXet >= 3.20) && (TBCHocKyDangXet <= 3.59)) {
                $('#CVHT_TC3_2').val($('#CVHT_TC3_2').attr('max_value'));
                bac_HocKyDangXet = 3;
            }

            if ((TBCHocKyDangXet >= 2.50) && (TBCHocKyDangXet <= 3.19)) {
                $('#CVHT_TC3_3').val($('#CVHT_TC3_3').attr('max_value'));
                bac_HocKyDangXet = 2;
            }

            if ((TBCHocKyDangXet >= 2) && (TBCHocKyDangXet <= 2.49)) {
                $('#CVHT_TC3_4').val($('#CVHT_TC3_4').attr('max_value'));
                bac_HocKyDangXet = 1;
            }

            if (TBCHocKyDangXet < 2) {
                $('#CVHT_TC3_5').val($('#CVHT_TC3_5').attr('max_value'));
            }




            //Hoc ky truoc//
            if ((TBCHocKyTruoc >= 3.60) && (TBCHocKyTruoc <= 4)) {
                bac_HocKyTruoc = 4;
            }

            if ((TBCHocKyTruoc >= 3.20) && (TBCHocKyTruoc <= 3.59)) {
                bac_HocKyTruoc = 3;
            }

            if ((TBCHocKyTruoc >= 2.50) && (TBCHocKyTruoc <= 3.19)) {
                bac_HocKyTruoc = 2;
            }

            if ((TBCHocKyTruoc >= 2) && (TBCHocKyTruoc <= 2.49)) {
                bac_HocKyTruoc = 1;
            }

            //console.log(bac_HocKyDangXet + "---" + bac_HocKyTruoc)
            //So sanh bac
            if ((bac_HocKyDangXet - bac_HocKyTruoc) == 1) {
                $('#CVHT_TC3_6').val($('#CVHT_TC3_6').attr('max_value'));
            }

            if ((bac_HocKyDangXet - bac_HocKyTruoc) > 1) {
                $('#CVHT_TC3_6').val($('#CVHT_TC3_6').attr('max_value'));
            }


            //Kích hoạt sự kiên onchange manually vì value set bằng javascript kh hoạt động onchange
            input_TC3_1 = document.getElementById('CVHT_TC3_1');
            ev_TC3_1 = document.createEvent('Event');
            ev_TC3_1.initEvent('change', true, false);
            input_TC3_1.dispatchEvent(ev_TC3_1);

            input_TC3_2 = document.getElementById('CVHT_TC3_2');
            ev_TC3_2 = document.createEvent('Event');
            ev_TC3_2.initEvent('change', true, false);
            input_TC3_2.dispatchEvent(ev_TC3_2);

            input_TC3_3 = document.getElementById('CVHT_TC3_3');
            ev_TC3_3 = document.createEvent('Event');
            ev_TC3_3.initEvent('change', true, false);
            input_TC3_3.dispatchEvent(ev_TC3_3);

            input_TC3_4 = document.getElementById('CVHT_TC3_4');
            ev_TC3_4 = document.createEvent('Event');
            ev_TC3_4.initEvent('change', true, false);
            input_TC3_4.dispatchEvent(ev_TC3_4);

            input_TC3_5 = document.getElementById('CVHT_TC3_5');
            ev_TC3_5 = document.createEvent('Event');
            ev_TC3_5.initEvent('change', true, false);
            input_TC3_5.dispatchEvent(ev_TC3_5);


        }



        function TinhXepLoai(diemTong_XepLoai) {
            if (diemTong_XepLoai >= 90 && diemTong_XepLoai <= 100) {
                return 'Xuất sắc';
            }

            if (diemTong_XepLoai >= 80 && diemTong_XepLoai <= 89) {
                return 'Tốt';
            }

            if (diemTong_XepLoai >= 65 && diemTong_XepLoai <= 79) {
                return 'Khá';
            }

            if (diemTong_XepLoai >= 50 && diemTong_XepLoai <= 64) {
                return 'Trung bình';
            }

            if (diemTong_XepLoai >= 35 && diemTong_XepLoai <= 49) {
                return 'Yếu';
            }

            if (diemTong_XepLoai < 35) {
                return 'Kém';
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
        $(document).on("click", ".btn_XemDanhSachHoatDong", function() {

            let thamgiahd_maTieuChi = $(this).attr('data-tieuchi-id');
            let thamgiahd_tenTieuChi = $(this).attr('data-tentieuchi');
            let thamgiahd_maHocKyDanhGia = $('#input_maHocKyDanhGia').val();
       
            $('#id_thamgiahd_tieuChiDuocCong').text(thamgiahd_tenTieuChi);

            LoadDanhSachHoatDongDaThamGia(thamgiahd_maHocKyDanhGia, thamgiahd_maTieuChi);


        })



        $(document).on("click", ".btn_AnhMinhChung", function() {
            let img_id = $(this).attr('data-img-id');
            let src_img_id = $("#"+img_id).attr('src');

            $('#id_img_modal').attr("src", src_img_id);

       
        })


    </script>

    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

    </body>

    </html>