<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/chamdiemrenluyen.php';

    $database = new Database();
    $db = $database->getConnection();
    $item = new ChamDiemRenLuyen($db);
    $item->maChamDiemRenLuyen  = isset($_GET['maChamDiemRenLuyen ']) ? $_GET['maChamDiemRenLuyen '] : die(); //Lấy id từ phương thức GET
  
    $item->getSingleChamDiemRenLuyen();
    if($item->maTieuChi3 != null){
        // create array
        $chamdiemrenluyen_arr = array(
            "maChamDiemRenLuyen" =>  $item->maChamDiemRenLuyen ,
            "maTieuChi3" => $item->maTieuChi3,
            "maSinhVien" => $item->maSinhVien,
            "diemSinhVienDanhGia" => $item->diemSinhVienDanhGia,
            "diemLopDanhGia" => $item->diemLopDanhGia,
            "diemTrungBinhChungHKTruoc" => $item->diemTrungBinhChungHKTruoc,
            "diemTrungBinhChungHKXet" => $item->diemTrungBinhChungHKXet
        );
      
        http_response_code(200);
        echo json_encode($chamdiemrenluyen_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("chamdiemrenluyen not found.");
    }
?>