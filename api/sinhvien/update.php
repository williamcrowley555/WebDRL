<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/sinhvien.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new SinhVien($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    if ($data != null){
        $item->maSinhVien  = $data->maSinhVien ;
    
        //values
        $item->hoTenSinhVien = $data->hoTenSinhVien;
        $item->ngaySinh = $data->ngaySinh;        
        $item->he = $data->he;
        $item->matKhauSinhVien = $data->matKhauSinhVien;
        $item->maLop = $data->maLop;
        
        if($item->updateSinhVien()){
            echo json_encode("sinhvien data updated.");
        } else{
            echo json_encode("Data could not be updated");
        }

    }else{
        echo 'No data posted.';
    }

    

?>