<?php
    $data = json_decode($_POST["data"], true);
    $tableTitle = $data["tableTitle"];
    $tableContent = $data["tableContent"];
    $exportType = $data["exportType"];

    $html = '';

    if($tableTitle && $tableContent) {
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
        
        $html .= '<h2 style="text-transform: uppercase; text-align: center; margin-top: 20px">Thống kê cảnh cáo</h2>';

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
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $data["maLop"] . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . $data["totNghiep"] . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . ($exportType == "all" ? $data["soLanYeuKem"] : ($exportType == "yeu" ? $data["soLanYeu"] : $data["soLanKem"])) . '</td>
                        <td style="padding: 10px; border: 1px solid #ccc; text-align: left; font-size: 16px;">' . ($exportType == "all" ? $data["soLanYeuKemLienTiep"] : ($exportType == "yeu" ? $data["soLanYeuLienTiep"] : $data["soLanKemLienTiep"])) . '</td>
                    </tr>';
        }            
                    
        $html .= '</tbody>
            </table>';
    }

    echo json_encode(array('htmlThongKeCanhCao' => $html));
?>