<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/khoahoc.php';
    include_once '../auth/read-data.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

        $database = new Database();
        $db = $database->getConnection();
        $item = new KhoaHoc($db);
        $item->maKhoaHoc = isset($_GET['maKhoaHoc']) ? $_GET['maKhoaHoc'] : die(); //Lấy id từ phương thức GET
    
        $item->getSingleKhoaHoc();
        if($item->namBatDau != null){
            // create array
            $khoahoc_arr = array(
                "maKhoaHoc" =>  $item->maKhoaHoc,
                "namBatDau" => $item->namBatDau,
                "namKetThuc" => $item->namKetThuc
            );
        
            http_response_code(200);
            echo json_encode($khoahoc_arr);
        }
        
        else{
            http_response_code(404);
            echo json_encode("khoahoc not found.");
        }
    }
?>