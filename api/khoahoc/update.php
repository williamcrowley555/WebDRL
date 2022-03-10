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
    
    $item = new KhoaHoc($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    if ($data != null){
        $item->maKhoaHoc  = $data->maKhoaHoc ;
    
        //values
        $item->namBatDau = $data->namBatDau;
        $item->namKetThuc = $data->namKetThuc;
        
        if($item->updateKhoaHoc()){
            echo json_encode("Khoa data updated.");
        } else{
            echo json_encode("Data could not be updated");
        }

    }else{
        echo 'No data posted.';
    }

    

?>