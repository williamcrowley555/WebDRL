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

        if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)){
            $database = new Database();
            $db = $database->getConnection();
    
            $item = new Tieuchicap2($db); //new Khoa object
            $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 
    
            if ($data != null){
                //set các biến bằng data nhận từ user
                $item->noidung = $data->noidung;
                $item->diemtoida = $data->diemtoida;
                $item->matc1 = $data->matc1;
    
                if($item->createTC2()){
                    echo 'tieuchicap2 tạo thành công.';
                } else{
                    echo 'tieuchicap2 tạo thất bại.';
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