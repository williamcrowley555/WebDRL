<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/sinhvien.php';
    $database = new Database();
    $db = $database->getConnection();

    $items = new SinhVien($db);
    $stmt = $items->getAllSinhVien();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount); //print itemCount
    if($itemCount > 0){
        $sinhvienArr = array();
        $sinhvienArr["sinhvien"] = array(); //tạo object json 
        $sinhvienArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "maSinhVien" => $maSinhVien ,
                "hoTenSinhVien" => $hoTenSinhVien,
                "ngaySinh" => $ngaySinh,
                "he" => $he,
                "matKhauSinhVien" => $matKhauSinhVien,
                "maLop" => $maLop
            );
            array_push($sinhvienArr["sinhvien"], $e);
        }
        echo json_encode($sinhvienArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>