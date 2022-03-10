<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/hockydanhgia.php';

    $database = new Database();
    $db = $database->getConnection();
    $item = new HocKyDanhGia($db);
    $item->maHocKyDanhGia = isset($_GET['maHocKyDanhGia']) ? $_GET['maHocKyDanhGia'] : die(); //Lấy id từ phương thức GET
  
    $item->getSingleHocKyDanhGia();
    if($item->hocKyXet != null){
        // create array
        $hockydanhgia_arr = array(
            "maHocKyDanhGia" =>  $item->maHocKyDanhGia,
            "hocKyXet" => $item->hocKyXet,
            "namHocXet" => $item->namHocXet,
            "maSinhVien" => $item->maSinhVien,
            "coVanDuyet" => $item->coVanDuyet,
            "khoaDuyet" => $item->khoaDuyet
        );
      
        http_response_code(200);
        echo json_encode($hockydanhgia_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("hockydanhgia not found.");
    }
?>