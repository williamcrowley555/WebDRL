<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/thongbaodanhgia.php';
    $database = new Database();
    $db = $database->getConnection();

    $items = new ThongBaoDanhGia($db);
    $stmt = $items->getAllThongBaoDanhGia();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount); //print itemCount
    if($itemCount > 0){
        $thongbaodanhgiaArr = array();
        $thongbaodanhgiaArr["thongbaodanhgia"] = array(); //tạo object json 
        $thongbaodanhgiaArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "maThongBao " => $maThongBao ,
                "ngaySinhVienDanhGia" => $ngaySinhVienDanhGia,
                "ngaySinhVienKetThucDanhGia" => $ngaySinhVienKetThucDanhGia,
                "ngayCoVanDanhGia" => $ngayCoVanDanhGia,
                "ngayCoVanKetThucDanhGia" => $ngayCoVanKetThucDanhGia,
                "ngayKhoaDanhGia" => $ngayKhoaDanhGia,
                "ngayKhoaKetThucDanhGia" => $ngayKhoaKetThucDanhGia,
                "ngayThongBao" => $ngayThongBao,
                "maHocKyDanhGia" => $maHocKyDanhGia
            );
            array_push($thongbaodanhgiaArr["thongbaodanhgia"], $e);
        }
        echo json_encode($thongbaodanhgiaArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>