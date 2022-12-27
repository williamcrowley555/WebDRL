<?php
    require '../../vendor/autoload.php';
    require '../../helper/validator.php';
    require '../../config/database.php';
    require '../../class/sinhvien.php';
    require '../../class/hockydanhgia.php';
    require '../../class/diemtrungbinhhe4.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
    $fileName = $_FILES['import_file_GPA']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    $tableTitle = [
        "STT",
        "Mã sinh viên",
        "Họ tên sinh viên",
        "Điểm"
    ];

    if(in_array($file_ext, $allowed_ext)) {
        $invalidRows = array();

        $inputFileNamePath = $_FILES['import_file_GPA']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $rows = $spreadsheet->getActiveSheet()->toArray();

        $database = new Database();
        $db = $database->getConnection();

        $isValidTitleOrder = true;
        $success = true;
        $successfulRowCount = 0;
        $rowCount = 0;

        $GPAArr = array();
        $GPAArr["diemtrungbinhhe4"] = array(); //tạo object json 
        

        foreach($rows as $row) {
            // Skip the first row (table title)
            if($rowCount > 0) {
                $item = new DiemTrungBinhHe4($db); //new DiemTrungBinhHe4 object
                $itemSinhVien = new SinhVien($db);
                $itemHocKyDanhGia = new HocKyDanhGia($db);

                //$GPAArr["itemCount"] = $itemCount;

                // $item->maDiemTrungBinh = $row['1'] . $_POST['maHocKyDanhGia'];
                // $item->maHocKyDanhGia = $_POST['maHocKyDanhGia'];
                // $item->diem = $row['3'];
                // $item->maSinhVien = $row['1'];

                // Validate maDiemTrungBinh
                if(
                    ($errorMsg = isRequired($row['1'] . $_POST['maHocKyDanhGia'], "Mã điểm trung bình không được để trống")) != null
                    ||
                    ($errorMsg = minLength($row['1'] . $_POST['maHocKyDanhGia'], 17, "Mã điểm trung bình phải có tối thiểu 17 chữ số")) != null
                    ||
                    ($errorMsg = isGPAIDFormat($row['1'] . $_POST['maHocKyDanhGia'], $row['1'], $_POST['maHocKyDanhGia'], "Mã điểm trung bình sai định dạng")) != null
                ) {
                    $success = false;
                    //array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $errorMsg));
                    $e = array(
                        "soThuTu" => $rowCount,
                        "maSinhVien" => $row['1'],
                        "hoTenSinhVien" => $row['2'],
                        "diem" => $row['3'],
                        "loi" => $errorMsg
                    );
                    array_push($GPAArr["diemtrungbinhhe4"], $e);
                    $rowCount++;
                    continue;
                }

                // Validate maHocKyDanhGia
                if(
                    ($errorMsg = isRequired($_POST['maHocKyDanhGia'], "Mã học kỳ đánh giá không được để trống")) != null
                    ||
                    ($errorMsg = minLength($_POST['maHocKyDanhGia'], 7, "Mã học kỳ đánh giá phải có tối thiểu 7 chữ số")) != null
                ) {
                    $success = false;
                    $e = array(
                        "soThuTu" => $rowCount,
                        "maSinhVien" => $row['1'],
                        "hoTenSinhVien" => $row['2'],
                        "diem" => $row['3'],
                        "loi" => $errorMsg
                    );
                    array_push($GPAArr["diemtrungbinhhe4"], $e);
                    $rowCount++;
                    continue;
                }

                // Validate diem
                if(
                    // ($errorMsg = isRequired($row['3'], "Điểm không được để trống")) != null
                    // ||
                    ($errorMsg = isNumber($row['3'], "Điểm phải là số hoặc số thập phân")) != null
                    ||
                    ($errorMsg = isGPA($row['3'], "Điểm phải từ 0 đến 4")) != null
                ) {
                    $success = false;
                    $e = array(
                        "soThuTu" => $rowCount,
                        "maSinhVien" => $row['1'],
                        "hoTenSinhVien" => $row['2'],
                        "diem" => $row['3'],
                        "loi" => $errorMsg
                    );
                    array_push($GPAArr["diemtrungbinhhe4"], $e);
                    $rowCount++;
                    continue;
                }
                
                // Validate maSinhVien
                if(
                    ($errorMsg = isRequired($row['1'], "Mã số sinh viên không được để trống")) != null
                    || 
                    ($errorMsg = isPositiveNumber($row['1'], "Mã số sinh viên chỉ bao gồm các ký tự số")) != null
                    ||
                    ($errorMsg = minLength($row['1'], 10, "Mã số sinh viên phải có tối thiểu 10 chữ số")) != null
                ) {
                    $success = false;
                    $e = array(
                        "soThuTu" => $rowCount,
                        "maSinhVien" => $row['1'],
                        "hoTenSinhVien" => $row['2'],
                        "diem" => $row['3'],
                        "loi" => $errorMsg
                    );
                    array_push($GPAArr["diemtrungbinhhe4"], $e);
                    $rowCount++;
                    continue;
                }

                $stmt = $itemSinhVien->getSinhVienTheoMSSVTheoLop($row['1'], $_POST['maLop'],true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount == 0) {
                    $success = false;
                    // array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], 'Mã số sinh viên không tồn tại'));
                    $e = array(
                        "soThuTu" => $rowCount,
                        "maSinhVien" => $row['1'],
                        "hoTenSinhVien" => $row['2'],
                        "diem" => $row['3'],
                        "loi" => "Mã số sinh viên không nằm trong danh sách của lớp được chọn"
                    );
                    array_push($GPAArr["diemtrungbinhhe4"], $e);
                    $rowCount++;
                    continue;
                }

                //Kiểm tra Điểm của Sinh viên tại Mã học kỳ đánh giá có tồn tại?
                $stmt = $item->getTonTaiDiemCuaSinhVienTheoMaHocKyDanhGia($_POST['maHocKyDanhGia'], $row['1'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $success = false;
                    //array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], 'Mã học kỳ đánh giá đã tồn tại điểm'));
                    $e = array(
                        "soThuTu" => $rowCount,
                        "maSinhVien" => $row['1'],
                        "hoTenSinhVien" => $row['2'],
                        "diem" => $row['3'],
                        "loi" => "Sinh viên đã có điểm của học kỳ này"
                    );
                    array_push($GPAArr["diemtrungbinhhe4"], $e);
                    $rowCount++;
                    continue;
                }

                // Kiểm tra mã điểm trung bình đã tồn tại?
                $stmt = $item->getDiemHe4TheoMaDiemTrungBinh($row['1'] . $_POST['maHocKyDanhGia'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $success = false;
                    //array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], 'Mã điểm trung bình đã tồn tại'));
                    $e = array(
                        "soThuTu" => $rowCount,
                        "maSinhVien" => $row['1'],
                        "hoTenSinhVien" => $row['2'],
                        "diem" => $row['3'],
                        "loi" => "Mã điểm trung bình đã tồn tại"
                    );
                    array_push($GPAArr["diemtrungbinhhe4"], $e);
                    $rowCount++;
                    continue;
                }

                //Kiểm tra MSSV có tồn tại?
                $stmt = $itemSinhVien->getSinhVienTheoMSSV($row['1'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount == 0) {
                    $success = false;
                    // array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], 'Mã số sinh viên không tồn tại'));
                    $e = array(
                        "soThuTu" => $rowCount,
                        "maSinhVien" => $row['1'],
                        "hoTenSinhVien" => $row['2'],
                        "diem" => $row['3'],
                        "loi" => "Mã số sinh viên không tồn tại"
                    );
                    array_push($GPAArr["diemtrungbinhhe4"], $e);
                    $rowCount++;
                    continue;
                }
                
                //Kiểm tra Mã học kỳ đánh giá có tồn tại?
                $stmt = $itemHocKyDanhGia->getHocKyDanhGiaTheoMaHocKyDanhGia($_POST['maHocKyDanhGia'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount == 0) {
                    $success = false;
                    //array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], 'Mã học kỳ đánh giá không tồn tại'));
                    $e = array(
                        "soThuTu" => $rowCount,
                        "maSinhVien" => $row['1'],
                        "hoTenSinhVien" => $row['2'],
                        "diem" => $row['3'],
                        "loi" => "Mã học kỳ đánh giá không tồn tại"
                    );
                    array_push($GPAArr["diemtrungbinhhe4"], $e);
                    $rowCount++;
                    continue;
                }

                //array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], 'Mã học kỳ đánh giá đã tồn tại điểm'));

                $e = array(
                    "soThuTu" => $rowCount,
                    "maSinhVien" => $row['1'],
                    "hoTenSinhVien" => $row['2'],
                    "diem" => $row['3'],
                    "loi" => ""
                );
                array_push($GPAArr["diemtrungbinhhe4"], $e);
            } else if($rowCount == 0) {
                // Kiểm tra thứ tự tên các cột của bảng
                for ($i = 0; $i < count($tableTitle); $i++) {
                    if (strcasecmp($tableTitle[$i], $row[$i]) != 0) {
                        $success = false;
                        $isValidTitleOrder = false;
                        break 2;
                    } 
                }

                // $e = array(
                //     "soThuTu" => $rowCount,
                //     "maSinhVien" => $row['1'],
                //     "hoTenSinhVien" => $row['2'],
                //     "diem" => $row['3'],
                //     "loi" => ""
                // );
                //array_push($GPAArr["diemtrungbinhhe4"], $e);
            
                //array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $row['5'], $row['6'], $row['7'], 'Lỗi'));
            }
            $rowCount++;
        }
        //echo json_encode(array('success' => $success, 'array' => $GPAArr));

        if($success) {
            echo json_encode(array('success' => true,
                                    'message' => null,
                                    'array' => $GPAArr));
        } else {
            if ($isValidTitleOrder) {
                echo json_encode(array('success' => false,
                                        'message' => null,
                                        'array' => $GPAArr));
            } else {
                echo json_encode(array('success' => false,
                                        'message' => "Thứ tự tên các cột chưa đúng yêu cầu!",
                                        'array' => null));
            }
        }


        // if($success) {
        //     echo json_encode(array('success' => true));
        //     $ChamDiemRenLuyenArr = array();
        // } else {
        //     echo json_encode(array('success' => false,
        //                         'message' => "Số dòng được thêm thành công: $successfulRowCount",
        //                         'invalidRows' => $invalidRows));
        // }
    } else {
        echo json_encode(array('success' => false,
                                'message' => 'File upload yêu cầu phải là File Excel!'));
    }

?>