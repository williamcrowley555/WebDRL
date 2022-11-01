<?php
    require_once '../vendor/autoload.php';
    
    $data = json_decode($_POST["data"], true);

    $thongTinPhieu = $data["thongTinPhieu"];
    $sinhVien = $data["sinhVien"];
    $hocKyDanhGia = $data["hocKyDanhGia"];
    $diemTieuChiCap2 = $data["diemTieuChiCap2"];
    $diemTieuChiCap3 = $data["diemTieuChiCap3"];
    $tieuChiCap1 = $data["tieuChiCap1"];
    $tieuChiCap2 = $data["tieuChiCap2"];
    $tieuChiCap3 = $data["tieuChiCap3"];

    $fileName = 'phieu_ren_luyen';
    
    $html = '';

    function getDiemTieuChiCap2($maTieuChi2, $diemTieuChiCap2List) {
        foreach($diemTieuChiCap2List as $diemTCC2) {
            if ($diemTCC2["maTieuChi2"] == $maTieuChi2) {
                return $diemTCC2;
            }
        }

        return null;
    }

    function getDiemTieuChiCap3($maTieuChi3, $diemTieuChiCap3List) {
        foreach($diemTieuChiCap3List as $diemTCC3) {
            if ($diemTCC3["maTieuChi3"] == $maTieuChi3) {
                return $diemTCC3;
            }
        }

        return null;
    }
    
    if($sinhVien && $hocKyDanhGia) {
        $html .= '<h3 style="text-transform: uppercase; text-align: left;">--Thông tin sinh viên--</h3>
            <div class="row justify-content-center" style="padding-bottom: 20px; text-align: start;" id="part_thongTinSinhVien">
                <div class="row">
                    <div class="col"><span style="font-weight: bold; font-size: 16px;">Họ tên: </span>' . $sinhVien["hoTenSinhVien"] . '</div>
                    <div class="col"><span style="font-weight: bold; font-size: 16px;">Mã số sinh viên: </span><span id="text_maSV">' . $sinhVien["maSinhVien"] . '</span></div>
                    <div class="col"><span style="font-weight: bold; font-size: 16px;">Ngày sinh: </span>' . date_format(date_create($sinhVien["ngaySinh"]), "d/m/Y") . '</div>
                    <div class="col"><span style="font-weight: bold; font-size: 16px;">Lớp: </span><span id="text_MaLop">' . $sinhVien["maLop"] . '</span></div>
                    <div class="col"><span style="font-weight: bold; font-size: 16px;">Khoa: </span>' . $sinhVien["maKhoa"] . ' - ' . $sinhVien["tenKhoa"] . '</div>
                    <div class="col"><span style="font-weight: bold; font-size: 16px;">Hệ: </span>' . $sinhVien["he"] . '</div>
                    <div class="col"><span style="font-weight: bold; font-size: 16px;">Học kỳ: </span>' . $hocKyDanhGia["hocKyXet"] . '</div>
                    <div class="col"><span style="font-weight: bold; font-size: 16px;">Năm học: </span>' . $hocKyDanhGia["namHocXet"] . '</div>
                    <div class="col" style="display: none;"><input type="text" id="input_maHocKyDanhGia" value="' . $hocKyDanhGia["maHocKyDanhGia"] . '" /></div>
                </div>
            </div>';
    }

    $html .= '<h3 style="text-transform: uppercase; text-align: left;">--PHIẾU ĐÁNH GIÁ ĐIỂM RÈN LUYỆN--</h3>
            <form id="formDanhGiaDRL" method="post" enctype="multipart/form-data">
                <div class="form-outline mb-4">
                    <div class="row justify-content-center" style="margin-top: 20px; text-align: start;">
                        <table class="table table-hover table-bordered" style="border-collapse: collapse;">
                            <thead>
                                <tr style="text-align: center;">
                                    <th style="padding: 10px; border: 1px solid #ccc;" scope="col"><strong>NỘI DUNG ĐÁNH GIÁ</strong></th>
                                    <th style="padding: 10px; border: 1px solid #ccc;" scope="col"><strong>Điểm tối đa</strong></th>
                                    <th style="padding: 10px; border: 1px solid #ccc;" scope="col"><strong>Điểm SV tự đánh giá</strong></th>
                                    <th style="padding: 10px; border: 1px solid #ccc;" scope="col"><strong>Điểm lớp đánh giá</strong></th>
                                    <th style="padding: 10px; border: 1px solid #ccc;" scope="col"><strong>Điểm Khoa đánh giá</strong></th>
                                </tr>
                            </thead>
                            
                            <tbody id="tbody_noiDungDanhGia">';
                            
    $diemTongCong_SinhVien = 0;
    $diemTongCong_CVHT = 0;
    $diemTongCong_Khoa = 0;

    // Tiêu chí 1                        
    foreach ($tieuChiCap1 as $tcc1) {
        $diemTongTieuChi1_SinhVien = 0;
        $diemTongTieuChi1_CVHT = 0;
        $diemTongTieuChi1_Khoa = 0;
        
        $html .= '<tr>
                    <td style="padding: 10px; border: 1px solid #ccc; font-weight: bold;">' . $tcc1["noidung"] . '</td>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center; font-weight: bold;">' . ($tcc1["diemtoida"] == 0 ? '' : $tcc1["diemtoida"] . "đ") . '</td>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center; font-weight: bold;"></td>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center; font-weight: bold;"></td>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center; font-weight: bold;"></td>
                </tr>';

        // Tiêu chí 2
        foreach ($tieuChiCap2 as $tcc2) {
            if ($tcc1["matc1"] == $tcc2["matc1"]) {
                $diemTCC2 = getDiemTieuChiCap2($tcc2["matc2"], $diemTieuChiCap2);

                if ($diemTCC2 != null) {
                    $diemTongTieuChi1_SinhVien += ($diemTCC2["diemSinhVienDanhGia"] ? $diemTCC2["diemSinhVienDanhGia"] : 0);
                    $diemTongTieuChi1_CVHT += ($diemTCC2["diemLopDanhGia"] ? $diemTCC2["diemLopDanhGia"] : 0);
                    $diemTongTieuChi1_Khoa += ($diemTCC2["diemKhoaDanhGia"] ? $diemTCC2["diemKhoaDanhGia"] : 0);
                }

                $html .= '<tr>
                            <td style="padding: 10px; border: 1px solid #ccc;"><em>' . 
                                (strpos(strtolower($tcc2["noidung"]), strtolower("Kết quả học tập")) ?
                                (
                                    $tcc2["noidung"] .
                                    '<br/>
                                    Điểm TBC học kỳ trước: ' . $thongTinPhieu["diemTrungBinhChungHKTruoc"] .
                                    '<br/>
                                    Điểm TBC học kỳ đang xét: ' . $thongTinPhieu["diemTrungBinhChungHKXet"]
                                )  
                                : 
                                $tcc2["noidung"]) . 
                            '</em></td>
                            <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"><em>' . ($tcc2["diemtoida"] == 0 ? '' : $tcc2["diemtoida"] . "đ") . '</em></td>
                            <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">' . ($diemTCC2 == null ? "" : $diemTCC2["diemSinhVienDanhGia"]) . '</td>
                            <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">' . ($diemTCC2 == null ? "" : $diemTCC2["diemLopDanhGia"]) . '</td>
                            <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">' . ($diemTCC2 == null ? "" : $diemTCC2["diemKhoaDanhGia"]) . '</td>
                        </tr>';

                // Tiêu chí 3
                foreach ($tieuChiCap3 as $tcc3) {
                    if ($tcc2["matc2"] == $tcc3["matc2"]) {
                        $diemTCC3 = getDiemTieuChiCap3($tcc3["matc3"], $diemTieuChiCap3);

                        if ($diemTCC3 != null) {
                            $diemTongTieuChi1_SinhVien += ($diemTCC3["diemSinhVienDanhGia"] ? $diemTCC3["diemSinhVienDanhGia"] : 0);
                            $diemTongTieuChi1_CVHT += ($diemTCC3["diemLopDanhGia"] ? $diemTCC3["diemLopDanhGia"] : 0);
                            $diemTongTieuChi1_Khoa += ($diemTCC3["diemKhoaDanhGia"] ? $diemTCC3["diemKhoaDanhGia"] : 0);
                        }

                        $html .= '<tr>
                                    <td style="padding: 10px; border: 1px solid #ccc;"><em>' . $tcc3["noidung"] . '</em></td>
                                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"><em>' . ($tcc3["diem"] == 0 ? '' : $tcc3["diem"] . "đ") . '</em></td>
                                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">' . ($diemTCC3 == null ? "" : $diemTCC3["diemSinhVienDanhGia"]) . '</td>
                                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">' . ($diemTCC3 == null ? "" : $diemTCC3["diemLopDanhGia"]) . '</td>
                                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">' . ($diemTCC3 == null ? "" : $diemTCC3["diemKhoaDanhGia"]) . '</td>
                                </tr>';
                    }
                }
            }
        }  

        // Tính điểm tổng cộng của tiêu chí 1
        $html .= '<tr style="background: darkseagreen;">
                    <td style="padding: 10px; border: 1px solid #ccc; font-weight: bold;">Cộng:</td>
                    <td style="padding: 10px; border: 1px solid #ccc;"></td>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">' . ($diemTongTieuChi1_SinhVien > $tcc1["diemtoida"] ? $tcc1["diemtoida"] : $diemTongTieuChi1_SinhVien) . '</td>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">' . ($diemTongTieuChi1_CVHT > $tcc1["diemtoida"] ? $tcc1["diemtoida"] : $diemTongTieuChi1_CVHT) . '</td>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">' . ($diemTongTieuChi1_Khoa > $tcc1["diemtoida"] ? $tcc1["diemtoida"] : $diemTongTieuChi1_Khoa) . '</td>
                </tr>';

        // Cộng điểm tổng của tiêu chí 1 vào điểm tổng cộng của phiếu rèn luyện
        $diemTongCong_SinhVien += ($diemTongTieuChi1_SinhVien > $tcc1["diemtoida"] ? $tcc1["diemtoida"] : $diemTongTieuChi1_SinhVien);
        $diemTongCong_CVHT += ($diemTongTieuChi1_CVHT > $tcc1["diemtoida"] ? $tcc1["diemtoida"] : $diemTongTieuChi1_CVHT);
        $diemTongCong_Khoa += ($diemTongTieuChi1_Khoa > $tcc1["diemtoida"] ? $tcc1["diemtoida"] : $diemTongTieuChi1_Khoa);
    }

    // Hiển thị điểm tổng cộng của phiếu rèn luyện
    $html .= '<tr>
                <td style="padding: 10px; border: 1px solid #ccc; font-weight: bold;">ĐIỂM TỔNG CỘNG (tối đa không quá 100 điểm):</td>
                <td style="padding: 10px; border: 1px solid #ccc;"></td>
                <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">' . $diemTongCong_SinhVien . '</td>
                <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">' . $diemTongCong_CVHT . '</td>
                <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">' . $diemTongCong_Khoa . '</td>
            </tr>';

    // Hiển thị điểm tổng cộng đã chốt
    $html .= '<tr>
                <td style="padding: 10px; border: 1px solid #ccc; font-weight: bold; text-transform: uppercase; font-size: 18px;" colspan="2">ĐIỂM: <span id="text_diemTongCong">' . $thongTinPhieu["diemTongCong"] . '</span></td>
                <td style="padding: 10px; border: 1px solid #ccc; font-weight: bold; text-transform: uppercase; font-size: 18px;" colspan="3">Xếp loại: <span id="text_XepLoai">' . $thongTinPhieu["xepLoai"] . '</span></td>
            </tr>';

    $html .= '              </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>';

    $mpdf = new \Mpdf\Mpdf();
    // $stylesheet = file_get_contents('../view/Admin/assets/css/portal.css');
    // $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
    $mpdf->Output($fileName . '.pdf', 'D');
    echo $html;
?>