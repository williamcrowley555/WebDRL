<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/sinhvien.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        //if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {
       
            if (isset($_GET['mssv'])) {
                $mssv = $_GET['mssv'];
            } else {
                $mssv = null;
            }

            if ($mssv != null) {
                $database = new Database();
                $db = $database->getConnection();

                $items = new SinhVien($db);
                $stmt = $items->getSinhVienTheoMSSV($mssv, true);
                $itemCount = $stmt->rowCount();
        
                if ($itemCount > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    extract($row);
                    $sv = array(
                        "maSinhVien" => $maSinhVien,
                        "hoTenSinhVien" => $hoTenSinhVien,
                        "ngaySinh" => $ngaySinh,
                        "he" => $he,
                        "maLop" => $maLop
                    );
                    
                    
                    http_response_code(200);
                    echo json_encode($sv);
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không tìm thấy kết quả.")
                    );
                }
            }
            
        // } else {
        //     http_response_code(403);
        //     echo json_encode(
        //         array("message" => "Bạn không có quyền thực hiện điều này!")
        //     );
    } else {
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }
    ?>