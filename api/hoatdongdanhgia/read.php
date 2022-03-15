<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/hoatdongdanhgia.php';
    $database = new Database();
    $db = $database->getConnection();

    $items = new HoatDongDanhGia($db);
    $stmt = $items->getAllHoatDongDanhGia();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount); //print itemCount
    if($itemCount > 0){
        $hoatdongdanhgiaArr = array();
        $hoatdongdanhgiaArr["hoatdongdanhgia"] = array(); //tạo object json 
        $hoatdongdanhgiaArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "maHoatDong" => $maHoatDong ,
                "maTieuChi3" => $maTieuChi3,
                "maKhoa" => $maKhoa,
                "tenHoatDong" => $tenHoatDong,
                "diemNhanDuoc" => $diemNhanDuoc,
                "diaDiemDienRaHoatDong" => $diaDiemDienRaHoatDong,
                "maQRDiaDiem" => $maQRDiaDiem,
                "tenKhoa" => $tenKhoa,
                "matKhauKhoa" => $matKhauKhoa
            );
            array_push($hoatdongdanhgiaArr["hoatdongdanhgia"], $e);
        }
        echo json_encode($hoatdongdanhgiaArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>