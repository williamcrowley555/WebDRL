<?php
    require '../../vendor/autoload.php';
    require '../../helper/validator.php';
    require '../../config/database.php';
    require '../../class/khoa.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $tableTitle = ["STT", "Mã khoa", "Tên khoa", "Tài khoản khoa"];

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ext)) {
        $invalidRows = array();

        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $rows = $spreadsheet->getActiveSheet()->toArray();

        $database = new Database();
        $db = $database->getConnection();

        $isValidTitleOrder = true;
        $success = true;
        $successfulRowCount = 0;
        $rowCount = 0;

        foreach($rows as $row) {
            // Skip the first row (table title)
            if($rowCount > 0) {
                $item = new Khoa($db); //new Khoa object
                $item->maKhoa = $row['1'];
                $item->tenKhoa = $row['2'];
                $item->taiKhoanKhoa = $row['3'];      
                $item->matKhauKhoa = isset($row['4']) ? md5($row['4']) : md5($row['3']);   

                // Validate maKhoa
                if(
                    ($errorMsg = isRequired($row['1'], "Mã khoa không được để trống")) != null
                    || 
                    ($errorMsg = isCharacters($row['1'], false, "Mã khoa chỉ bao gồm các ký tự chữ")) != null
                    ||
                    ($errorMsg = exactLength($row['1'], 3, "Mã khoa phải có đủ 3 chữ số")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], isset($row['4']) ? $row['4'] : null, $errorMsg));
                    continue;
                }

                // Validate tenKhoa
                if(
                    ($errorMsg = isRequired($row['2'], "Tên khoa không được để trống")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], isset($row['4']) ? $row['4'] : null, $errorMsg));
                    continue;
                }

                // Validate taiKhoanKhoa
                if(
                    ($errorMsg = isRequired($row['3'], "Tài khoản khoa không được để trống")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], isset($row['4']) ? $row['4'] : null, $errorMsg));
                    continue;
                }

                // Validate matKhauKhoa
                if(isset($row['4'])) {
                    if(
                        ($errorMsg = minLength($row['4'], 4, "Mật khẩu phải có tối thiểu 4 ký tự")) != null
                    ) {
                        $success = false;
                        array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], isset($row['4']) ? $row['4'] : null, $errorMsg));
                        continue;
                    }
                }

                // Kiểm tra Mã khoa đã tồn tại?
                $stmt = $item->getKhoaTheoMaKhoa($row['1'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], isset($row['4']) ? $row['4'] : null, 'Mã khoa đã tồn tại'));
                    continue;
                } 

                // Kiểm tra Tài khoản khoa đã tồn tại?
                $stmt = $item->getKhoaTheoTaiKhoanKhoa($row['3']);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], isset($row['4']) ? $row['4'] : null, 'Tài khoản khoa đã tồn tại'));
                    continue;
                } 
                
                // Lưu import Khoa
                $result = $item->createKhoa();
                    
                if ($result) {
                    $successfulRowCount++; 
                } else {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], isset($row['4']) ? $row['4'] : null, 'Lỗi database'));
                }
            } elseif($rowCount == 0) {
                // Kiểm tra thứ tự tên các cột của bảng
                for ($i = 0; $i < count($tableTitle); $i++) {
                    if (strcasecmp($tableTitle[$i], $row[$i]) != 0) {
                        $success = false;
                        $isValidTitleOrder = false;
                        break 2;
                    } 
                }

                array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], isset($row['4']) ? $row['4'] : "Mật khẩu", 'Lỗi'));
            }

            $rowCount++;
        }

        if($success) {
            echo json_encode(array('success' => true));
        } else {
            if ($isValidTitleOrder) {
                echo json_encode(array('success' => false,
                                        'message' => "Số dòng được thêm thành công: $successfulRowCount",
                                        'invalidRows' => $invalidRows));
            } else {
                echo json_encode(array('success' => false,
                                        'message' => "Thứ tự tên các cột chưa đúng yêu cầu!"));
            }
        }
    } else {
        echo json_encode(array('success' => false,
                                'message' => 'File upload yêu cầu phải là File Excel!'));
    }

?>