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
    $item->maThongBao = isset($_GET['maThongBao']) ? $_GET['maThongBao'] : die(); //Lấy id từ phương thức GET
  
    $item->getSingleThongBaoDanhGia();
    if($item->ngaySinhVienDanhGia != null){
        // create array
        $thongbaodanhgia_arr = array(
            "maThongBao" =>  $item->maThongBao,
            "ngaySinhVienDanhGia" => $item->ngaySinhVienDanhGia,
            "ngaySinhVienKetThucDanhGia" => $item->ngaySinhVienKetThucDanhGia,
            "ngayCoVanDanhGia" => $item->ngayCoVanDanhGia,
            "ngayCoVanKetThucDanhGia" => $item->ngayCoVanKetThucDanhGia,
            "ngayKhoaDanhGia" => $item->ngayKhoaDanhGia,
            "ngayKhoaKetThucDanhGia" => $item->ngayKhoaKetThucDanhGia,
            "ngayThongBao" => $item->ngayThongBao,
            "maHocKyDanhGia" => $item->maHocKyDanhGia        
        );
      
        http_response_code(200);
        echo json_encode($thongbaodanhgia_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("thongbaodanhgia not found.");
    }
?>