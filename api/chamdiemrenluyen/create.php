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

    $item = new ChamDiemRenLuyen($db); //new HoatDongDanhGia object
    $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 

    if ($data != null){
        //set các biến bằng data nhận từ user
        $item->maTieuChi3 = $data->maTieuChi3;
        $item->maSinhVien = $data->maSinhVien;
        $item->diemSinhVienDanhGia = $data->diemSinhVienDanhGia;
        $item->diemLopDanhGia = $data->diemLopDanhGia;
        $item->diemTrungBinhChungHKTruoc = $data->diemTrungBinhChungHKTruoc;
        $item->diemTrungBinhChungHKXet = $data->diemTrungBinhChungHKXet;


        if($item->createChamDiemRenLuyen()){
            echo 'chamdiemrenluyen created successfully.';
        } else{
            echo 'chamdiemrenluyen could not be created.';
        }
    }else{
        echo 'No data posted.';
    }
    

?>