<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/hoatdongdanhgia.php';
    include_once '../auth/read-data.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

        $database = new Database();
        $db = $database->getConnection();

        $item = new HoatDongDanhGia($db); //new HoatDongDanhGia object
        $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 

        if ($data != null){
            //set các biến bằng data nhận từ user
            $item->maTieuChi3 = $data->maTieuChi3;
            $item->maKhoa = $data->maKhoa;
            $item->tenHoatDong = $data->tenHoatDong;
            $item->diemNhanDuoc = $data->diemNhanDuoc;
            $item->diaDiemDienRaHoatDong = $data->diaDiemDienRaHoatDong;
            $item->maQRDiaDiem = $data->maQRDiaDiem;
            $item->thoiGianBatDauHoatDong = $data->thoiGianBatDauHoatDong;
            $item->thoiGianKetThucHoatDong = $data->thoiGianKetThucHoatDong;

            if($item->createHoatDongDanhGia()){
                echo 'HoatDongDanhGia created successfully.';
            } else{
                echo 'HoatDongDanhGia could not be created.';
            }
        }else{
            echo 'No data posted.';
        }
    }  

?>