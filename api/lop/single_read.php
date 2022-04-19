<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/lop.php';
    include_once '../auth/read-data.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

        $database = new Database();
        $db = $database->getConnection();
        $item = new Lop($db);
        $item->maLop = isset($_GET['maLop']) ? $_GET['maLop'] : die(); //Lấy id từ phương thức GET
    
        $item->getSingleLop();
        if($item->tenLop != null){
            // create array
            $lop_arr = array(
                "maLop" =>  $item->maLop,
                "tenLop" => $item->tenLop,
                "maKhoa" => $item->maKhoa,
                "maCoVanHocTap" => $item->maCoVanHocTap,
                "maKhoaHoc" => $item->maKhoaHoc
            );
        
            http_response_code(200);
            echo json_encode($lop_arr);
        }
        
        else{
            http_response_code(404);
            echo json_encode("lop not found.");
        }
    }
?>