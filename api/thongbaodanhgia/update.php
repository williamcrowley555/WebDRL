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
    
    $item = new ThongBaoDanhGia($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    if ($data != null){
        $item->maThongBao   = $data->maThongBao ;
    
        //values
        $item->ngaySinhVienDanhGia = $data->ngaySinhVienDanhGia;
        $item->ngaySinhVienKetThucDanhGia = $data->ngaySinhVienKetThucDanhGia;
        $item->ngayCoVanDanhGia = $data->ngayCoVanDanhGia;
        $item->ngayCoVanKetThucDanhGia = $data->ngayCoVanKetThucDanhGia;
        $item->ngayKhoaDanhGia = $data->ngayKhoaDanhGia;
        $item->ngayKhoaKetThucDanhGia = $data->ngayKhoaKetThucDanhGia;
        $item->ngayThongBao = $data->ngayThongBao;
        $item->maHocKyDanhGia = $data->maHocKyDanhGia;
        
        if($item->updateThongBaoDanhGia()){
            echo json_encode("thongbaodanhgia data updated.");
        } else{
            echo json_encode("Data could not be updated");
        }

    }else{
        echo 'No data posted.';
    }

    

?>