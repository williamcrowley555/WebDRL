<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/quyen.php';
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
    
            $items = new Quyen($db);
            $stmt = $items->getAllQuyen();
            $itemCount = $stmt->rowCount();
    
            if($itemCount > 0){
                $quyenArr = array();
                $quyenArr["quyen"] = array(); //tạo object json 
                $quyenArr["itemCount"] = $itemCount;
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $e = array(
                        "maQuyen" => $maQuyen ,
                        "tenQuyen" => $tenQuyen,
                    );
                    array_push($quyenArr["quyen"], $e);
                }

                http_response_code(200);
                echo json_encode($quyenArr);
            }else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy dữ liệu.")
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