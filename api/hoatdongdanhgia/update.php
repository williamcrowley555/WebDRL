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
    
    $data = json_decode(file_get_contents("php://input"));
    
    if ($data != null){
        $item->maHoatDong  = $data->maHoatDong ;
    
        //values
        $item->maTieuChi3 = $data->maTieuChi3;
        $item->maKhoa = $data->maKhoa;
        $item->tenHoatDong = $data->tenHoatDong;
        $item->diemNhanDuoc = $data->diemNhanDuoc;
        $item->diaDiemDienRaHoatDong = $data->diaDiemDienRaHoatDong;
        $item->maQRDiaDiem = $data->maQRDiaDiem;
        $item->thoiGianBatDauHoatDong = $data->thoiGianBatDauHoatDong;
        $item->thoiGianKetThucHoatDong = $data->thoiGianKetThucHoatDong;
        
        if($item->updateHoatDongDanhGia()){
            echo json_encode("HoatDongDanhGia data updated.");
        } else{
            echo json_encode("Data could not be updated");
        }

    }else{
        echo 'No data posted.';
    }

    

?>