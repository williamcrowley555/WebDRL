<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/chamdiemrenluyen.php';
    $database = new Database();
    $db = $database->getConnection();

    $items = new ChamDiemRenLuyen($db);
    $stmt = $items->getAllChamDiemRenLuyen();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount); //print itemCount
    if($itemCount > 0){
        $ChamDiemRenLuyenArr = array();
        $ChamDiemRenLuyenArr["ChamDiemRenLuyen"] = array(); //tạo object json 
        $ChamDiemRenLuyenArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "maChamDiemRenLuyen" => $maChamDiemRenLuyen ,
                "maTieuChi3" => $maTieuChi3,
                "maSinhVien" => $maSinhVien,
                "diemSinhVienDanhGia" => $diemSinhVienDanhGia,
                "diemLopDanhGia" => $diemLopDanhGia,
                "diemTrungBinhChungHKTruoc" => $diemTrungBinhChungHKTruoc,
                "diemTrungBinhChungHKXet" => $diemTrungBinhChungHKXet
            );
            array_push($ChamDiemRenLuyenArr["ChamDiemRenLuyen"], $e);
        }
        echo json_encode($ChamDiemRenLuyenArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>