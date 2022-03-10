<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/thongbaodanhgia.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new ThongBaoDanhGia($db); //new HoatDongDanhGia object
    $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 

    if ($data != null){
        //set các biến bằng data nhận từ user
        $item->ngaySinhVienDanhGia = $data->ngaySinhVienDanhGia;
        $item->ngaySinhVienKetThucDanhGia = $data->ngaySinhVienKetThucDanhGia;
        $item->ngayCoVanDanhGia = $data->ngayCoVanDanhGia;
        $item->ngayCoVanKetThucDanhGia = $data->ngayCoVanKetThucDanhGia;
        $item->ngayKhoaDanhGia = $data->ngayKhoaDanhGia;
        $item->ngayKhoaKetThucDanhGia = $data->ngayKhoaKetThucDanhGia;
        $item->ngayThongBao = $data->ngayThongBao;
        $item->maHocKyDanhGia = $data->maHocKyDanhGia;

        if($item->createThongBaoDanhGia()){
            echo 'ThongBaoDanhGia created successfully.';
        } else{
            echo 'ThongBaoDanhGia could not be created.';
        }
    }else{
        echo 'No data posted.';
    }
    

?>