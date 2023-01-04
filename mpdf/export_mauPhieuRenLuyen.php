<?php
    require_once '../vendor/autoload.php';
    
    $data = json_decode($_POST["data"], true);

    $tieuChiCap1 = $data["tieuChiCap1"];
    $tieuChiCap2 = $data["tieuChiCap2"];
    $tieuChiCap3 = $data["tieuChiCap3"];

    $fileName = 'mau_phieu_ren_luyen';
    
    $html = '';

    $html .= "<div style='margin-bottom: 20px'>
                <div style='width: 40%;float: left;'>
                    <h4 style='text-align: center; font-weight: 400'>
                        ỦY BAN NHÂN DÂN <br />THÀNH PHỐ HỒ CHÍ MINH <br /><b>TRƯỜNG ĐẠI HỌC SÀI GÒN</b>
                        <hr style='border-top: 2px solid black; width: 140px;' />
                    </h4>
                </div>
                <div style='width: 60%;float: left;'>
                    <h4 style='text-align: center;'>
                        CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM <br />Độc lập - Tự do - Hạnh phúc
                        <hr style='border-top: 2px solid black; width: 140px;' />
                    </h4>
                </div>
            </div>";
    
    $html .= '<h3 style="text-transform: uppercase; text-align: center; margin-top: 20px">--Thông tin sinh viên--</h3>
        <div class="row justify-content-center" style="padding-bottom: 20px; text-align: start;" id="part_thongTinSinhVien">
            <div class="row">
                <div style=" margin-bottom:10px"><span style="font-weight: bold; font-size: 16px;">Họ tên: </span></div>
                <div style=" margin-bottom:10px"><span style="font-weight: bold; font-size: 16px;">Mã số sinh viên: </span></div>
                <div style=" margin-bottom:10px"><span style="font-weight: bold; font-size: 16px;">Ngày sinh: </span></div>
                <div style=" margin-bottom:10px"><span style="font-weight: bold; font-size: 16px;">Lớp: </span></div>
                <div style=" margin-bottom:10px"><span style="font-weight: bold; font-size: 16px;">Khoa: </span></div>
                <div style=" margin-bottom:10px"><span style="font-weight: bold; font-size: 16px;">Hệ: </span></div>
                <div style=" margin-bottom:10px"><span style="font-weight: bold; font-size: 16px;">Học kỳ: </span></div>
                <div style=" margin-bottom:10px"><span style="font-weight: bold; font-size: 16px;">Năm học: </span></div>
            </div>
        </div>';

    $html .= '<h3 style="text-transform: uppercase; text-align: center;">--PHIẾU ĐÁNH GIÁ ĐIỂM RÈN LUYỆN--</h3>
            <form id="formDanhGiaDRL" method="post" enctype="multipart/form-data">
                <div class="form-outline" style="margin-bottom: 20px">
                    <div class="row justify-content-center" style="margin-top: 10px; text-align: start;">
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

                $html .= '<tr>
                            <td style="padding: 10px; border: 1px solid #ccc;"><em>' . 
                                (strpos(strtolower($tcc2["noidung"]), strtolower("Kết quả học tập")) ?
                                (
                                    $tcc2["noidung"] .
                                    '<br/>
                                    Điểm TBC học kỳ trước: 
                                    <br/>
                                    Điểm TBC học kỳ đang xét: ' 
                                )  
                                : 
                                $tcc2["noidung"]) . 
                            '</em></td>
                            <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"><em>' . ($tcc2["diemtoida"] == 0 ? '' : $tcc2["diemtoida"] . "đ") . '</em></td>
                            <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"></td>
                            <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"></td>
                            <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"></td>
                        </tr>';

                // Tiêu chí 3
                foreach ($tieuChiCap3 as $tcc3) {
                    if ($tcc2["matc2"] == $tcc3["matc2"]) {

                        $html .= '<tr>
                                    <td style="padding: 10px; border: 1px solid #ccc;"><em>' . $tcc3["noidung"] . '</em></td>
                                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"><em>' . $tcc3["diem"] . 'đ</em></td>
                                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"></td>
                                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"></td>
                                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"></td>
                                </tr>';
                    }
                }
            }
        }  

        // Điểm tổng cộng của tiêu chí 1
        $html .= '<tr style="background: darkseagreen;">
                    <td style="padding: 10px; border: 1px solid #ccc; font-weight: bold;">Cộng:</td>
                    <td style="padding: 10px; border: 1px solid #ccc;"></td>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"></td>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"></td>
                    <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"></td>
                </tr>';
    }

    // Điểm tổng cộng của phiếu rèn luyện
    $html .= '<tr>
                <td style="padding: 10px; border: 1px solid #ccc; font-weight: bold;">ĐIỂM TỔNG CỘNG (tối đa không quá 100 điểm):</td>
                <td style="padding: 10px; border: 1px solid #ccc;"></td>
                <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"></td>
                <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"></td>
                <td style="padding: 10px; border: 1px solid #ccc; text-align: center;"></td>
            </tr>';

    // Điểm tổng cộng đã chốt
    $html .= '<tr>
                <td style="padding: 10px; border: 1px solid #ccc; font-weight: bold; text-transform: uppercase; font-size: 18px;" colspan="2">ĐIỂM: <span id="text_diemTongCong"></span></td>
                <td style="padding: 10px; border: 1px solid #ccc; font-weight: bold; text-transform: uppercase; font-size: 18px;" colspan="3">Xếp loại: <span id="text_XepLoai"></span></td>
            </tr>';

    $html .= '              </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>';

    // Chữ ký
    $html .= "<div>
                <div style='width: 33.33%;float: left; text-align: center; margin-bottom: 100px'>
                    <h4>Họ tên và chữ ký của sinh viên</h4>
                </div>
                <div style='width: 33.33%;float: left; text-align: center; margin-bottom: 100px'>
                    <h4>Họ tên và chữ ký của lớp trưởng</h4>
                </div>
                <div style='width: 33.33%;float: left; text-align: center; margin-bottom: 100px'>
                    <h4>Họ tên và chữ ký của cố vấn học tập</h4>
                </div>
            </div>
            
            <div style='margin-bottom: 20px'>
                <div style='width: 50%;float: left; text-align: center; margin-bottom: 100px'>
                    <h4>Hội đồng cấp khoa</h4>
                </div>
                <div style='width: 50%;float: left; text-align: center; margin-bottom: 100px'>
                    <h4>Hội đồng cấp trường</h4>
                </div>
            </div>";

    $mpdf = new \Mpdf\Mpdf();
    $stylesheet = file_get_contents('./css/export_mauPhieuRenLuyen.css');
    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
    $mpdf->Output($fileName . '.pdf', 'D');
    echo $html;
?>