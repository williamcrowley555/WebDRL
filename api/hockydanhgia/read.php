<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/hockydanhgia.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    
    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {
            $database = new Database();
            $db = $database->getConnection();
    
            $items = new HocKyDanhGia($db);
            $stmt = $items->getAllHocKyDanhGia();
            $itemCount = $stmt->rowCount();
    
    
            echo json_encode($itemCount); //print itemCount
            if($itemCount > 0){
                $hockydanhgiaArr = array();
                $hockydanhgiaArr["hockydanhgia"] = array(); //tạo object json 
                $hockydanhgiaArr["itemCount"] = $itemCount;
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $e = array(
                        "maHocKyDanhGia" => $maHocKyDanhGia ,
                        "hocKyXet" => $hocKyXet,
                        "namHocXet" => $namHocXet,
                        "maSinhVien" => $maSinhVien,
                        "coVanDuyet" => $coVanDuyet,
                        "khoaDuyet" => $khoaDuyet
                    );
                    array_push($hockydanhgiaArr["hockydanhgia"], $e);
                }
                echo json_encode($hockydanhgiaArr);
            }
            else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "No record found.")
                );
            } } else {
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
