<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/khoa.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {
            $database = new Database();
            $db = $database->getConnection();
    
            $items = new Khoa($db);
            $stmt = $items->getAllKhoa();
            $itemCount = $stmt->rowCount();
    
    
            if($itemCount > 0){
                $khoaArr = array();
                $khoaArr["khoa"] = array(); //tạo object json 
                $khoaArr["itemCount"] = $itemCount;
                
                $countRow = 0;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $countRow++;
                    $e = array(
                        "soThuTu" => $countRow,
                        "maKhoa" => $maKhoa,
                        "tenKhoa" => $tenKhoa,
                        "taiKhoanKhoa" => $taiKhoanKhoa,
                        "matKhauKhoa" => $matKhauKhoa
                    );
                    array_push($khoaArr["khoa"], $e);
                }
                http_response_code(200);
                echo json_encode($khoaArr);
        
            }else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }

        } else {
            http_response_code(403);
            echo json_encode(
                array("message" => "Bạn không có quyền thực hiện điều này!")
            );
        }
    }else {
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }
