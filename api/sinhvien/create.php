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

    $item = new SinhVien($db); //new Khoa object
    $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 

    if ($data != null){
        //set các biến bằng data nhận từ user
        $item->hoTenSinhVien = $data->hoTenSinhVien;
        $item->ngaySinh = $data->ngaySinh;        
        $item->he = $data->he;
        $item->matKhauSinhVien = $data->matKhauSinhVien;
        $item->maLop = $data->maLop;

        if($item->createSinhVien()){
            echo 'sinhvien created successfully.';
        } else{
            echo 'sinhvien could not be created.';
        }
    }else{
        echo 'No data posted.';
    }
    

?>