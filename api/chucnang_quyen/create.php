<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/chucnang_quyen.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        if ($checkQuyen->checkQuyen_CTSV_Admin($data["user_data"]->aud)) {
            $database = new Database();
            $db = $database->getConnection();
    
            $item = new ChucNang_Quyen($db); //new ChucNang_Quyen object
            $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 
    
            if ($data != null){
                //set các biến bằng data nhận từ user
                $item->maChucNang = $data->maChucNang;
                
                if (isset($data->ghiChu)) {
                    $item->ghiChu = $data->ghiChu;
                } else {
                    $item->ghiChu = null;
                }
    
                $quyen = implode(',', $data->maQuyen);
                $successCount = 0;

                foreach ($quyen as $maQuyen) {
                    $item->maQuyen = $maQuyen;

                    if($item->createChucNang_Quyen()) {
                        $successCount++;
                    } 
                }
                    
                if ($successCount > 0) {
                    http_response_code(200);
                    echo json_encode(
                        array("message" => "Thêm quyền cho chức năng thành công!")
                    );
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Thêm quyền cho chức năng thất bại!")
                    );
                }
            }else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không có dữ liệu gửi lên.")
                );
            }
        } else {
            http_response_code(403);
            echo json_encode(
                array("message" => "Bạn không có quyền thực hiện điều này!")
            );
        }
    } else {
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }
?>