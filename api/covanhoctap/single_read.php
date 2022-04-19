<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/covanhoctap.php';
    include_once '../auth/read-data.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

        $database = new Database();
        $db = $database->getConnection();
        $item = new CVHT($db);
        $item->maCoVanHocTap = isset($_GET['maCoVanHocTap']) ? $_GET['maCoVanHocTap'] : die(); //Lấy id từ phương thức GET
    
        $item->getSingleCVHT();
        if($item->hoTenCoVan != null){
            // create array
            $covanhoctap_arr = array(
                "maCoVanHocTap" =>  $item->maCoVanHocTap,
                "hoTenCoVan" => $item->hoTenCoVan,
                "soDienThoai" => $item->soDienThoai,
                "matKhauTaiKhoanCoVan" => $item->matKhauTaiKhoanCoVan
            );
        
            http_response_code(200);
            echo json_encode($covanhoctap_arr);
        }
        
        else{
            http_response_code(404);
            echo json_encode("covanhoctap not found.");
        }
    }   
?>