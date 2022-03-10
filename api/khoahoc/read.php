<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/khoahoc.php';
    $database = new Database();
    $db = $database->getConnection();

    $items = new Khoa($db);
    $stmt = $items->getAllKhoa();
    $itemCount = $stmt->rowCount();     


    echo json_encode($itemCount); //print itemCount
    if($itemCount > 0){
        $khoahocArr = array();
        $khoahocArr["khoahoc"] = array(); //tạo object json 
        $khoahocArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "maKhoaHoc " => $maKhoaHoc ,
                "namBatDau" => $namBatDau,
                "namKetThuc" => $namKetThuc
            );
            array_push($khoahocArr["khoahoc"], $e);
        }
        echo json_encode($khoahocArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>