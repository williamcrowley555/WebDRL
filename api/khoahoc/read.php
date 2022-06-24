<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/khoahoc.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        if ($checkQuyen->checkQuyen_Khoa_CTSV($data["user_data"]->aud)) {
            $database = new Database();
            $db = $database->getConnection();
    
            $items = new KhoaHoc($db);
            $stmt = $items->getAllKhoaHoc();
            $itemCount = $stmt->rowCount();     
    
    
            if($itemCount > 0){
                $khoahocArr = array();
                $khoahocArr["khoahoc"] = array(); //tạo object json 
                $khoahocArr["itemCount"] = $itemCount;
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $e = array(
                        "maKhoaHoc" => $maKhoaHoc,
                        "namBatDau" => $namBatDau,
                        "namKetThuc" => $namKetThuc
                    );
                    array_push($khoahocArr["khoahoc"], $e);
                }
                http_response_code(200);
                echo json_encode($khoahocArr);
            }
            else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy dữ liệu.")
                );
            }
        } else {
            http_response_code(403);
            echo json_encode(
                array("message" => "Bạn không có quyền thực hiện điều này!")
            );
        }
    } else {
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }
    
?>