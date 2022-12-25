<?php
    require '../../vendor/autoload.php';
    require '../../helper/validator.php';
    require '../../config/database.php';
    require '../../class/sinhvien.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    $tableTitle = [
        "STT",
        "Mã số sinh viên",
        "Họ tên sinh viên",
        "Ngày sinh",
        "Email",
        "Số điện thoại",
        "Hệ",
        "Tốt nghiệp",
      ];

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
                $item = new SinhVien($db); //new SinhVien object
                $item->maSinhVien = $row['1'];
                $item->hoTenSinhVien = $row['2'];
                $item->ngaySinh = $row['3'];
                $item->email = $row['4'];
                $item->sdt = $row['5'];
                $item->he = $row['6'];
                $item->totNghiep = (($row['7'] === "Chưa tốt nghiệp") ? 0 : (($row['7'] === "Đã tốt nghiệp") ? 1 : $row['7']));
                $item->matKhauSinhVien = md5($row['1']);
                $item->maLop = $_POST["lop"];

                // Validate maSinhVien
                if(
                    ($errorMsg = isRequired($row['1'], "Mã số sinh viên không được để trống")) != null
                    || 
                    ($errorMsg = isPositiveNumber($row['1'], "Mã số sinh viên chỉ bao gồm các ký tự số")) != null
                    ||
                    ($errorMsg = minLength($row['1'], 10, "Mã số sinh viên phải có tối thiểu 10 chữ số")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], $errorMsg));
                    continue;
                }

                // Validate hoTenSinhVien
                if(
                    ($errorMsg = isRequired($row['2'], "Họ tên sinh viên không được để trống")) != null
                    || 
                    ($errorMsg = isCharacters($row['2'], true, "Họ tên sinh viên chỉ bao gồm các ký tự chữ")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], $errorMsg));
                    continue;
                }

                // Validate ngaySinh
                if(
                    ($errorMsg = isRequired($row['3'], "Ngày sinh không được để trống")) != null
                    || 
                    ($errorMsg = isDateFormat($row['3'], 'Y-m-d', "Ngày sinh phải theo định dạng yyyy-mm-dd")) != null
                    || 
                    ($errorMsg = isDateOfBirth($row['3'], "Ngày sinh không hợp lệ")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], $errorMsg));
                    continue;
                }

                // Validate email
                if(
                    ($errorMsg = isRequired($row['4'], "Email không được để trống")) != null
                    ||
                    ($errorMsg = isEmail($row['4'])) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], $errorMsg));
                    continue;
                }

                // Validate sdt
                if(
                    ($errorMsg = isRequired($row['5'], "Số điện thoại không được để trống")) != null 
                    ||
                    ($errorMsg = isPhoneNumber($row['5'], "Số điện thoại không đúng")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], $errorMsg));
                    continue;
                }

                // Validate he
                if(
                    ($errorMsg = isRequired($row['6'], "Hệ không được để trống")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], $errorMsg));
                    continue;
                }

                // Validate totNghiep
                if(
                    ($errorMsg = isRequired($row['7'], "Tốt nghiệp không được để trống")) != null 
                    ||
                    ($errorMsg = isGraduate($row['7'], "Tốt nghiệp phải định dạng là \"Đã tốt nghiệp\" hoặc \"Chưa tốt nghiệp\"")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], $errorMsg));
                    continue;
                }

                //Kiểm tra MSSV đã tồn tại?
                $stmt = $item->getSinhVienTheoMSSV($row['1'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], 'Mã số sinh viên đã tồn tại'));
                    continue;
                }

                //Kiểm tra email đã tồn tại?
                $stmt = $item->getSinhVienTheoEmail($row['4'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], 'Email đã tồn tại'));
                    continue;
                }

                //Kiểm tra sđt đã tồn tại?
                $stmt = $item->getSinhVienTheoSdt($row['5'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], 'Số điện thoại đã tồn tại'));
                    continue;
                }
                
                $result = $item->createSinhVien();
                
                if ($result) {
                    $successfulRowCount++; 
                } else {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], 'Lỗi database'));
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
            
                array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], 'Lỗi'));
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