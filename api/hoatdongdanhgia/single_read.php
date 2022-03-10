<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/hoatdongdanhgia.php';

    $database = new Database();
    $db = $database->getConnection();
    $item = new HoatDongDanhGia($db);
    $item->maHoatDong = isset($_GET['maHoatDong']) ? $_GET['maHoatDong'] : die(); //Lấy id từ phương thức GET
  
    $item->getSingleHoatDongDanhGia();
    if($item->maTieuChi3 != null){
        // create array
        $hoatdongdanhgia_arr = array(
            "maHoatDong" =>  $item->maHoatDong,
            "maTieuChi3" => $item->maTieuChi3,
            "maKhoa" => $item->maKhoa,
            "tenHoatDong" =>  $item->tenHoatDong,
            "diemNhanDuoc" => $item->diemNhanDuoc        );
      
        http_response_code(200);
        echo json_encode($hoatdongdanhgia_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("hoatdongdanhgia not found.");
    }
?>