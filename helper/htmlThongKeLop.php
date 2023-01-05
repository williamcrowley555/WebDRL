<?php
    $data = json_decode($_POST["data"], true);
    $thongTinKhoa = $data["thongTinKhoa"];
    $maKhoaHoc = $data["maKhoaHoc"];
    $thongTinHocKyDanhGia = $data["thongTinHocKyDanhGia"];
    $tableTitle = $data["tableTitle"];
    $tableContent = $data["tableContent"];

    $html = '';

    $html .= "<table style='padding-bottom: 20px; width: 100%; '>
                <tr>
                    <td style='width: 40%'>
                        <h4 style='text-align: center; font-weight: 400'>
                            ỦY BAN NHÂN DÂN <br />THÀNH PHỐ HỒ CHÍ MINH <br /><b>TRƯỜNG ĐẠI HỌC SÀI GÒN</b>
                            <hr style='border-top: 2px solid black; width: 140px;' />
                        </h4>
                    </td>
                    <td style='width: 60%'>
                        <h4 style='text-align: center;'>
                            CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM <br />Độc lập - Tự do - Hạnh phúc
                            <hr style='border-top: 2px solid black; width: 140px;' />
                        </h4>
                    </td>
                </tr>
            </table>";

    if($thongTinKhoa && $maKhoaHoc && $thongTinHocKyDanhGia) {
        $html .= '<h2 style="text-transform: uppercase; text-align: center; margin-bottom: 10px;">Thông tin thống kê</h2>';

        $html .= '<p style="font-weight: bold; font-size: 16px; margin-left: 30px">Khoa: <span style="font-weight: normal;">'. $thongTinKhoa['maKhoa'] . ' - ' . $thongTinKhoa['tenKhoa'] .'</span></p>';
        $html .= '<p style="font-weight: bold; font-size: 16px; margin-left: 30px">Khóa học: <span style="font-weight: normal;">'. $maKhoaHoc .'</span></p>';
        $html .= '<p style="font-weight: bold; font-size: 16px; margin-left: 30px">Học kỳ: <span style="font-weight: normal;">' . $thongTinHocKyDanhGia['hocKyXet'] . '</span>, Năm học: <span style="font-weight: normal;">' . $thongTinHocKyDanhGia['namHocXet'] .'</span></p>';
    }

    if($tableTitle && $tableContent) {
        $html .= '<h2 style="text-transform: uppercase; text-align: center; margin-top: 50px;">Danh sách trình trạng chấm các lớp</h2>';

        $html .= '<table style="border-collapse: collapse; margin: 15px auto;">
                    <thead style="color: black; font-weight: bold;">
                        <tr>';
                        
        foreach($tableTitle as $title) { 
            $html .= '<th style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $title . '</th>';
        }  

        $html .= '  </tr>
                </thead>
                <tbody>';

        foreach($tableContent as $data) { 
            $html .= '<tr>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $data["soThuTu"] . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $data["maLop"] . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $data["tenLop"] . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $data["siSo"] . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $data["sinhVienCham"] . '/' . $data["siSo"] . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $data["coVanDaDuyet"] . '/' . $data["siSo"] . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $data["khoaDaDuyet"] . '/' . $data["siSo"] . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . ($data["khoaDaDuyet"] == $data["siSo"] ? 'Hoàn thành' : 'Chưa hoàn thành') . '</td>
                    </tr>';
        }            
                    
        $html .= '</tbody>
            </table>';
    }

    echo json_encode(array('htmlThongKeLop' => $html));
?>