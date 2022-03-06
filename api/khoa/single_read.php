<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/khoa.php';

    $database = new Database();
    $db = $database->getConnection();
    $item = new Khoa($db);
    $item->maKhoa = isset($_GET['maKhoa']) ? $_GET['maKhoa'] : die(); //Lấy id từ phương thức GET
  
    $item->getSingleKhoa();
    if($item->tenKhoa != null){
        // create array
        $khoa_arr = array(
            "maKhoa" =>  $item->maKhoa,
            "tenKhoa" => $item->tenKhoa,
            "taiKhoanKhoa" => $item->taiKhoanKhoa,
            "matKhauKhoa" => $item->matKhauKhoa
        );
      
        http_response_code(200);
        echo json_encode($khoa_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Khoa not found.");
    }
?>