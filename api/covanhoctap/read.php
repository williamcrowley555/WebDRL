<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/covanhoctap.php';
    $database = new Database();
    $db = $database->getConnection();

    $items = new CVHT($db);
    $stmt = $items->getAllCVHT();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount); //print itemCount
    if($itemCount > 0){
        $covanhoctapArr = array();
        $covanhoctapArr["covanhoctap"] = array(); //tạo object json 
        $covanhoctapArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "maCoVanHocTap " => $maCoVanHocTap ,
                "hoTenCoVan" => $hoTenCoVan,
                "soDienThoai" => $soDienThoai,
                "matKhauTaiKhoanCoVan" => $matKhauTaiKhoanCoVan
            );
            array_push($covanhoctapArr["covanhoctap"], $e);
        }
        echo json_encode($covanhoctapArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }

?>