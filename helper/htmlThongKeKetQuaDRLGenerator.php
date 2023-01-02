<?php
    $data = json_decode($_POST["data"], true);
    $classInfo = $data["classInfo"];
    $tableTitle = $data["tableTitle"];
    $tableContent = $data["tableContent"];

    $html = '';

    if($classInfo) {
        $html .= '<h2 style="text-transform: uppercase; text-align: center; margin-bottom: 10px;">Thông tin lớp</h2>';

        $html .= '<p style="font-weight: bold; font-size: 16px; margin-left: 30px">Mã lớp: <span style="font-weight: normal;">'. $classInfo["maLop"] .'</span></p>';
        $html .= '<p style="font-weight: bold; font-size: 16px; margin-left: 30px">Tên lớp: <span style="font-weight: normal;">'. $classInfo["tenLop"] .'</span></p>';
        $html .= '<p style="font-weight: bold; font-size: 16px; margin-left: 30px">Khoa: <span style="font-weight: normal;">'. $classInfo["maKhoa"] . ' - ' . $classInfo["tenKhoa"] .'</span></p>';
        $html .= '<p style="font-weight: bold; font-size: 16px; margin-left: 30px">Cố vấn học tập: <span style="font-weight: normal;">'. $classInfo["hoTenCoVan"] . '</span></p>';
        $html .= '<p style="font-weight: bold; font-size: 16px; margin-left: 30px">Khóa học: <span style="font-weight: normal;">'. $classInfo["maKhoaHoc"] .'</span></p>';
        $html .= '<p style="font-weight: bold; font-size: 16px; margin-left: 30px">Sỉ số lớp: <span style="font-weight: normal;">'. $classInfo["siSo"] .'</span></p>';
    }

    if($tableTitle && $tableContent) {
        $html .= '<h2 style="text-transform: uppercase; text-align: center; margin-top: 20px">Kết quả điểm rèn luyện</h2>';

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
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $data["maSinhVien"] . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $data["hoTenSinhVien"] . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $data["ngaySinh"] . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $data["diemTongCong"] . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $data["xepLoai"] . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . ($data["sinhVienCham"] == '1' ? 'Đã chấm' : 'Chưa chấm') . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . ($data["coVanDuyet"] == '1' ? 'Đã duyệt' : 'Chưa duyệt') . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . ($data["khoaDuyet"] == '1' ? 'Đã duyệt' : 'Chưa duyệt') . '</td>
                    </tr>';
        }            
                    
        $html .= '</tbody>
            </table>';
    }

    echo json_encode(array('htmlThongKeKetQuaDRL' => $html));
?>