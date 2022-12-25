<?php
    require '../../vendor/autoload.php';
    require '../../helper/validator.php';
    require '../../config/database.php';
    require '../../class/covanhoctap.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $tableTitle = [
        "STT",
        "Mã cố vấn học tập",
        "Họ tên cố vấn",
        "Số điện thoại",
        "Email",
    ];

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
                $item = new CVHT($db); //new CVHT object
                $item->maCoVanHocTap = $row['1'];
                $item->hoTenCoVan = $row['2'];
                $item->soDienThoai = $row['3'];
                $item->email = $row['4'];
                $item->matKhauTaiKhoanCoVan = isset($row['5']) ? md5($row['5']) : md5($row['1']);
                $item->maKhoa = $_POST["khoa"];

                // Validate maCoVanHocTap
                if(
                    ($errorMsg = isRequired($row['1'], "Mã cố vấn học tập không được để trống")) != null
                    || 
                    ($errorMsg = isPositiveNumber($row['1'], "Mã cố vấn học tập chỉ bao gồm các ký tự số")) != null
                    ||
                    ($errorMsg = minLength($row['1'], 5, "Mã cố vấn học tập phải có tối thiểu 5 chữ số")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], isset($row['5']) ? $row['5'] : null, $errorMsg));
                    continue;
                }

                // Validate hoTenCoVan
                if(
                    ($errorMsg = isRequired($row['2'], "Họ tên cố vấn học tập không được để trống")) != null
                    || 
                    ($errorMsg = isCharacters($row['2'], true, "Họ tên cố vấn học tập chỉ bao gồm các ký tự chữ")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], isset($row['5']) ? $row['5'] : null, $errorMsg));
                    continue;
                }

                // Validate soDienThoai
                if(
                    ($errorMsg = isRequired($row['3'], "Số điện thoại không được để trống")) != null
                    || 
                    ($errorMsg = isPhoneNumber($row['3'])) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], isset($row['5']) ? $row['5'] : null, $errorMsg));
                    continue;
                }

                // Validate email
                if(
                    ($errorMsg = isRequired($row['4'], "Email không được để trống")) != null
                    ||
                    ($errorMsg = isEmail($row['4'])) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], isset($row['5']) ? $row['5'] : null, $errorMsg));
                    continue;
                }

                // Validate matKhauTaiKhoanCoVan
                if($row['5']) {
                    if(
                        ($errorMsg = minLength($row['5'], 5, "Mật khẩu phải có tối thiểu 5 ký tự")) != null
                    ) {
                        $success = false;
                        array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], isset($row['5']) ? $row['5'] : null, $errorMsg));
                        continue;
                    }
                }

                // Kiểm tra Mã cố vấn học tập đã tồn tại?
                $stmt = $item->getCVHTTheoMaCVHT($row['1'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], isset($row['4']) ? $row['4'] : null, isset($row['5']) ? $row['5'] : null, 'Mã cố vấn học tập đã tồn tại'));
                    continue;
                }

                // Kiểm tra Email đã tồn tại?
                $stmt = $item->getCVHTTheoEmail($row['4'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], isset($row['4']) ? $row['4'] : null, isset($row['5']) ? $row['5'] : null, 'Email tồn tại'));
                    continue;
                }

                // Kiểm tra sđt đã tồn tại?
                $stmt = $item->getCVHTTheoSdt($row['3'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], isset($row['4']) ? $row['4'] : null, isset($row['5']) ? $row['5'] : null, 'Số điện thoại tồn tại'));
                    continue;
                }
                
                // Lưu import CVHT
                $result = $item->createCVHT();
                
                if ($result) {
                    $successfulRowCount++; 
                } else {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], isset($row['5']) ? $row['5'] : null, 'Lỗi database'));
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
                
                array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], isset($row['5']) ? $row['5'] : "Mật khẩu", 'Lỗi'));
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