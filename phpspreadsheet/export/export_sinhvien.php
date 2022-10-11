<?php
    session_start();

    require '../../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Writer\Xls;
    use PhpOffice\PhpSpreadsheet\Writer\Csv;

    $fileName = "danh_sach_sinh_vien_" . date('d-m-Y');

    if(isset($_POST["btn_export_to_excel"])) {
        $table_data = json_decode($_POST["table_data"], true);
        $tableTitle = $table_data["tableTitle"];
        $tableContent = $table_data["tableContent"];

        if($tableContent != null && count($tableContent) > 0) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $alphabet = array();

            foreach(range('A','Z') as $letter) { 
                array_push($alphabet, $letter);
            }  

            for ($i = 0; $i < count($tableTitle); $i++) {
                $sheet->setCellValue($alphabet[$i] . '1', $tableTitle[$i]);
            }

            $rowCount = 2;
            for ($i = 0; $i < count($tableContent); $i++) {
                $sheet->setCellValue($alphabet[0] . $rowCount, $tableContent[$i]['soThuTu']);
                $sheet->setCellValue($alphabet[1] . $rowCount, $tableContent[$i]['maSinhVien']);
                $sheet->setCellValue($alphabet[2] . $rowCount, $tableContent[$i]['hoTenSinhVien']);
                $sheet->setCellValue($alphabet[3] . $rowCount, $tableContent[$i]['ngaySinh']);
                $sheet->setCellValue($alphabet[4] . $rowCount, $tableContent[$i]['he']);
                $sheet->setCellValue($alphabet[5] . $rowCount, $tableContent[$i]['maLop']);

                $rowCount++;
            }

            $writer = new Xls($spreadsheet);
            $final_filename = $fileName . '.xls';

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attactment; filename="'.urlencode($final_filename).'"');
            $writer->save('php://output');
        } 
    }
?>