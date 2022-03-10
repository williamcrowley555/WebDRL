<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/lop.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Lop($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    if ($data != null){
        $item->maLop  = $data->maLop ;
    
        //values
        $item->tenLop = $data->tenLop;
        $item->maKhoa = $data->maKhoa;
        $item->maCoVanHocTap = $data->maCoVanHocTap;
        $item->maKhoaHoc = $data->maKhoaHoc;
        
        if($item->updateLop()){
            echo json_encode("Lop data updated.");
        } else{
            echo json_encode("Data could not be updated");
        }

    }else{
        echo 'No data posted.';
    }

    

?>