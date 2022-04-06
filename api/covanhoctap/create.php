<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/covanhoctap.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new CVHT($db); //new Khoa object
    $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 

    if ($data != null){
        //set các biến bằng data nhận từ user
        $item->maCoVanHocTap = $data->maCoVanHocTap;
        $item->hoTenCoVan = $data->hoTenCoVan;
        $item->soDienThoai = $data->soDienThoai;
        $item->matKhauTaiKhoanCoVan = md5($data->matKhauTaiKhoanCoVan);

        if($item->createCVHT()){
            echo 'CVHT created successfully.';
        } else{
            echo 'CVHT could not be created.';
        }
    }else{
        echo 'No data posted.';
    }
    

?>