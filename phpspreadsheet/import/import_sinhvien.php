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

    if(in_array($file_ext, $allowed_ext)) {
        $invalidRows = array();

        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $rows = $spreadsheet->getActiveSheet()->toArray();

        $database = new Database();
        $db = $database->getConnection();

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
                $item->he = $row['4'];
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
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $errorMsg));
                    continue;
                }

                // Validate hoTenSinhVien
                if(
                    ($errorMsg = isRequired($row['2'], "Họ tên sinh viên không được để trống")) != null
                    || 
                    ($errorMsg = isCharacters($row['2'], true, "Họ tên sinh viên chỉ bao gồm các ký tự chữ")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $errorMsg));
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
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $errorMsg));
                    continue;
                }

                // Validate he
                if(
                    ($errorMsg = isRequired($row['4'], "Hệ không được để trống")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $errorMsg));
                    continue;
                }

                // Kiểm tra MSSV đã tồn tại?
                $stmt = $item->getSinhVienTheoMSSV($row['1'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], 'Mã số sinh viên đã tồn tại'));
                } else {
                    $result = $item->createSinhVien();
                    
                    if ($result) {
                        $successfulRowCount++; 
                    } else {
                        $success = false;
                        array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], 'Lỗi database'));
                    }
                }
            } elseif($rowCount == 0) {
                array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], 'Lỗi'));
            }

            $rowCount++;
        }

        if($success) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false,
                                'message' => "Số dòng được thêm thành công: $successfulRowCount",
                                'invalidRows' => $invalidRows));
        }
    } else {
        echo json_encode(array('success' => false,
                                'message' => 'File upload yêu cầu phải là File Excel!'));
    }

?>