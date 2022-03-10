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
    $item->maSinhVien = isset($_GET['maSinhVien']) ? $_GET['maSinhVien'] : die(); //Lấy id từ phương thức GET
  
    $item->getSingleSinhVien();
    if($item->hoTenSinhVien != null){
        // create array
        $sinhvien_arr = array(
            "maSinhVien" =>  $item->maSinhVien,
            "hoTenSinhVien" => $item->hoTenSinhVien,
            "ngaySinh" => $item->ngaySinh,
            "he" => $item->he,
            "matKhauSinhVien" => $item->matKhauSinhVien,
            "matKhauSinhVien" => $item->matKhauSinhVien
        );
      
        http_response_code(200);
        echo json_encode($sinhvien_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("sinhvien not found.");
    }
?>