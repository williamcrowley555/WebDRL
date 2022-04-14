<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/lop.php';
    include_once '../auth/read-data.php';
    $database = new Database();
    $db = $database->getConnection();

    $read_data = new read_data();
    $data=$read_data->read_token();
    
    if($data["status"]==1){
        $items = new Lop($db);
        $stmt = $items->getAllLop();
        $itemCount = $stmt->rowCount();


    echo json_encode($itemCount); //print itemCount
        if($itemCount > 0){
            $lopArr = array();
            $lopArr["lop"] = array(); //tạo object json 
            $lopArr["itemCount"] = $itemCount;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $e = array(
                    "maLop" => $maLop ,
                    "tenLop" => $tenLop,
                    "maKhoa" => $maKhoa,
                    "maCoVanHocTap" => $maCoVanHocTap,
                    "maKhoaHoc" => $maKhoaHoc
                );
                array_push($lopArr["lop"], $e);
            }
            echo json_encode($lopArr);
        }
        else{
            http_response_code(404);
            echo json_encode(
                array("message" => "No record found.")
            );
        }

    }else{
        http_response_code(404);
        echo json_encode(
            array("message" => "bạn không có quyền (tài khoản giáo viên hoặc khoa)")
        );
    }
    

?>