<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/khoa.php';
    include_once '../auth/read-data.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        $database = new Database();
        $db = $database->getConnection();

        $items = new Khoa($db);
        $stmt = $items->getAllKhoa();
        $itemCount = $stmt->rowCount();


    // echo json_encode($itemCount); //print itemCount
        if($itemCount > 0){
            $khoaArr = array();
            $khoaArr["khoa"] = array(); //tạo object json 
            $khoaArr["itemCount"] = $itemCount;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $e = array(
                    "maKhoa" => $maKhoa,
                    "tenKhoa" => $tenKhoa,
                    "taiKhoanKhoa" => $taiKhoanKhoa,
                    "matKhauKhoa" => $matKhauKhoa
                );
                array_push($khoaArr["khoa"], $e);
            }
            echo json_encode($khoaArr);
        }
        else{
            http_response_code(404);
            echo json_encode(
                array("message" => "No record found.")
            );
        }
    }

?>