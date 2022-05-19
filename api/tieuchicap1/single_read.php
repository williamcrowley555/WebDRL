<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/tieuchicap1.php';
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
            $item = new Tieuchicap1($db);
            $item->matc1 = isset($_GET['matc1']) ? $_GET['matc1'] : die(); //Lấy id từ phương thức GET
        
            $item->getSingleTC1();
            if($item->noidung != null){
                // create array
                $tieuchicap1_arr = array(
                    "matc1" =>  $item->matc1,
                    "noidung" => $item->noidung,
                    "diemtoida" => $item->diemtoida
                );
            
                http_response_code(200);
                echo json_encode($tieuchicap1_arr);
            }
            
            else{
                http_response_code(404);
                echo json_encode("tieuchicap1 không tìm thấy.");
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