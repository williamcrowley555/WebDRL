<?php
    require '../../vendor/autoload.php';
    require '../../helper/validator.php';
    require '../../config/database.php';
    require '../../class/lop.php';
    require '../../class/covanhoctap.php';
    require '../../class/khoahoc.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $tableTitle = [
        "STT",
        "Mã lớp",
        "Tên lớp",
        "Mã cố vấn học tập",
        "Mã khóa học",
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
                $item = new Lop($db); //new Lop object
                $item->maLop = $row['1'];
                $item->tenLop = $row['2'];
                $item->maCoVanHocTap = $row['3'];   
                $item->maKhoaHoc = $row['4'];   
                $item->maKhoa = $_POST["khoa"];

                // Validate maLop
                if(
                    ($errorMsg = isRequired($row['1'], "Mã lớp không được để trống")) != null
                    || 
                    ($errorMsg = isNotSpecialChars($row['1'], false, "Mã lớp chỉ bao gồm các ký tự chữ, số và không bao gồm khoảng trắng")) != null
                    ||
                    ($errorMsg = minLength($row['1'], 7, "Mã lớp phải có tối thiểu 7 ký tự")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $errorMsg));
                    continue;
                }

                // Validate tenLop
                if(
                    ($errorMsg = isRequired($row['2'], "Tên lớp không được để trống")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $errorMsg));
                    continue;
                }

                // Validate maCoVanHocTap
                if(
                    ($errorMsg = isRequired($row['3'], "Mã cố vấn học tập không được để trống")) != null
                    || 
                    ($errorMsg = isPositiveNumber($row['3'], "Mã cố vấn học tập chỉ bao gồm các ký tự số")) != null
                    ||
                    ($errorMsg = minLength($row['3'], 5, "Mã cố vấn học tập phải có tối thiểu 5 chữ số")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $errorMsg));
                    continue;
                }

                // Kiểm tra Mã cố vấn học tập có tồn tại?
                $cvht = new CVHT($db); //new CVHT object
                $stmt = $cvht->getCVHTTheoMaCVHT($row['3'], true);
                $cvhtCount = $stmt->rowCount();
        
                if ($cvhtCount <= 0) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], 'Mã cố vấn học tập không tồn tại'));
                    continue;
                }

                // Validate maKhoaHoc
                if($row['4']) {
                    if(
                        ($errorMsg = isRequired($row['4'], "Mã khóa học không được để trống")) != null
                        || 
                        ($errorMsg = isNotSpecialChars($row['4'], false, "Mã khóa học chỉ bao gồm các ký tự chữ, số và không bao gồm khoảng trắng")) != null
                        ||
                        ($errorMsg = minLength($row['4'], 3, "Mã khóa học phải có tối thiểu 3 ký tự")) != null
                    ) {
                        $success = false;
                        array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $errorMsg));
                        continue;
                    }
                }

                // Kiểm tra Mã khóa học có tồn tại?
                $khoaHoc = new KhoaHoc($db); //new KhoaHoc object
                $khoaHoc->maKhoaHoc = $row['4'];
                $khoaHoc->getSingleKhoaHoc();
        
                if ($khoaHoc->namBatDau == null) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], 'Mã khóa học không tồn tại'));
                    continue;
                }

                // Kiểm tra Mã lớp đã tồn tại?
                $stmt = $item->getLopTheoMaLop($row['1'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], 'Mã lớp đã tồn tại'));
                } else {
                    $result = $item->createLop();
                    
                    if ($result) {
                        $successfulRowCount++; 
                    } else {
                        $success = false;
                        array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], 'Lỗi database'));
                    }
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

                array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], 'Lỗi'));
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