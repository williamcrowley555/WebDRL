<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/khoahoc.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new KhoaHoc($db); //new Khoa object
    $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 

    if ($data != null){
        //set các biến bằng data nhận từ user
        $item->namBatDau = $data->namBatDau;
        $item->namKetThuc = $data->namKetThuc;

        if($item->createKhoaHoc()){
            echo 'khoahoc created successfully.';
        } else{
            echo 'khoahoc could not be created.';
        }
    }else{
        echo 'No data posted.';
    }
    

?>