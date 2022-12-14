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

    $tableTitle = [
        "STT",
        "Mã số sinh viên",
        "Học kỳ",
        "Năm học",
        "Điểm"
    ];

    $allowed_ext = ['xls','csv','xlsx'];

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

        foreach($rows as $row) {
            // Skip the first row (table title)
            if($rowCount > 0) {
                $item = new DiemTrungBinhHe4($db); //new DiemTrungBinhHe4 object
                $itemSinhVien = new SinhVien($db);
                $itemHocKyDanhGia = new HocKyDanhGia($db);

                $item->maSinhVien = $row['1'];
                $item->hocKy = $row['2'];
                $item->namHoc = $row['3'];
                $item->diem = $row['4'];
                $splitNamHoc = explode("-", $row['3']);
                $item->maHocKyDanhGia = "HK" . $row['2'] 
                    . substr($splitNamHoc[0], -2) . substr($splitNamHoc[1], -2);
                $item->maDiemTrungBinh = $row['1'] . $item->maHocKyDanhGia;



                // $item->maDiemTrungBinh = $row['1'];
                // $item->maHocKyDanhGia = $row['2'];
                // $item->diem = $row['3'];
                // $item->maSinhVien = $row['4'];

                // Validate maDiemTrungBinh
                // if(
                //     ($errorMsg = isRequired($row['1'], "Mã điểm trung bình không được để trống")) != null
                //     ||
                //     ($errorMsg = minLength($row['1'], 17, "Mã điểm trung bình phải có tối thiểu 17 chữ số")) != null
                //     ||
                //     ($errorMsg = isGPAIDFormat($row['1'], $row['4'], $row['2'], "Mã điểm trung bình sai định dạng")) != null
                // ) {
                //     $success = false;
                //     array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $errorMsg));
                //     continue;
                // }

                // Validate maHocKyDanhGia
                // if(
                //     ($errorMsg = isRequired($row['2'], "Mã học kỳ đánh giá không được để trống")) != null
                //     ||
                //     ($errorMsg = minLength($row['2'], 7, "Mã học kỳ đánh giá phải có tối thiểu 7 chữ số")) != null
                // ) {
                //     $success = false;
                //     array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $errorMsg));
                //     continue;
                // }

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

                // Validate hocKy
                if(
                    ($errorMsg = isRequired($row['2'], "Học kỳ không được để trống")) != null
                    || 
                    ($errorMsg = isPositiveNumber($row['2'], "Học kỳ chỉ bao gồm các ký tự số")) != null
                    ||
                    ($errorMsg = isHocKy($row['2'], "Học kỳ chỉ có thể là 1 hoặc 2")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $errorMsg));
                    continue;
                }

                // Validate namHoc
                if(
                    ($errorMsg = isRequired($row['3'], "Năm học không được để trống")) != null
                    ||
                    ($errorMsg = isNamHoc($row['3'], "Định dạng năm học phải là YYYY-YYYY")) != null
                    ||
                    ($errorMsg = isValidNamHoc($row['3'], "Năm học trước phải nhỏ hơn năm học sau")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $errorMsg));
                    continue;
                }

                // Validate diem
                if(
                    ($errorMsg = isRequired($row['4'], "Điểm không được để trống")) != null
                    ||
                    ($errorMsg = isNumber($row['4'], "Điểm phải là số hoặc số thập phân")) != null
                    ||
                    ($errorMsg = isGPA($row['4'], "Điểm phải nằm trong khoảng từ 0 đến 4")) != null
                ) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], $errorMsg));
                    continue;
                }
                

                // Kiểm tra mã điểm trung bình đã tồn tại?
                // $stmt = $item->getDiemHe4TheoMaDiemTrungBinh($row['1'], true);
                // $itemCount = $stmt->rowCount();
        
                // if ($itemCount > 0) {
                //     $success = false;
                //     array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], 'Mã điểm trung bình đã tồn tại'));
                //     continue;
                // }

                //Kiểm tra MSSV có tồn tại?
                $stmt = $itemSinhVien->getSinhVienTheoMSSV($row['1'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount == 0) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], 'Mã số sinh viên không tồn tại'));
                    continue;
                }

                // Kiểm tra năm học và học kỳ có tồn tại?
                // $stmt = $itemHocKyDanhGia->getHocKyVaNamHoc($row['2'], $row['3']);
                // $itemCount = $stmt->rowCount();
        
                // if ($itemCount == 0) {
                //     $success = false;
                //     array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], 'Mã học kỳ đánh giá không tồn tại'));
                //     continue;
                // }


                //Kiểm tra Mã học kỳ đánh giá có tồn tại?
                // $stmt = $itemHocKyDanhGia->getHocKyDanhGiaTheoMaHocKyDanhGia($row['2'], true);
                // $itemCount = $stmt->rowCount();
        
                // if ($itemCount == 0) {
                //     $success = false;
                //     array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], 'Mã học kỳ đánh giá không tồn tại'));
                //     continue;
                // }

                //Kiểm tra Điểm của Sinh viên tại Mã học kỳ đánh giá có tồn tại?
                $stmt = $item->getTonTaiDiemCuaSinhVienTheoMaHocKyDanhGia($item->maHocKyDanhGia, $row['1'], true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $success = false;
                    array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], 'Học kỳ - năm học đã tồn tại điểm'));
                    continue;
                }

                // Lưu import điểm hệ 4
                    $result = $item->createDiemTrungBinhHe4();
                
                    if ($result) {
                        $successfulRowCount++; 
                    } else {
                        $success = false;
                        array_push($invalidRows, array($row['0'], $row['1'], $row['2'], $row['3'], $row['4'], 'Lỗi database'));
                    }
                //}
            } else if($rowCount == 0) {
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