<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/tieuchicap2.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        
        if ($checkQuyen->checkQuyen_CTSV_Admin($data["user_data"]->aud)){
            $database = new Database();
            $db = $database->getConnection();
            
            $item = new Tieuchicap2($db);
            
            $data = json_decode(file_get_contents("php://input"));
            
            if ($data != null){
                $item->matc2 = $data->matc2;
            
                if($item->deleteTC2()){
                    echo json_encode("tieuchicap2 xóa thành công.");
                } else{
                    echo json_encode("tieuchicap2 xóa thất bại.");
                }
            }else{
                echo 'Không có dữ liệu được gửi lên.';
            }
        }else{
            http_response_code(403);
            echo json_encode(
                array("message" => "Bạn không có quyền thực hiện điều này!")
            );
        }
        
    }else{
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }
    

?>