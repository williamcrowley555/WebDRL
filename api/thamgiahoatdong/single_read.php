<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/thamgiahoatdong.php';
    include_once '../auth/read-data.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

        $database = new Database();
        $db = $database->getConnection();
        $item = new ThamGiaHoatDong($db);
        $item->maThamGiaHoatDong = isset($_GET['maThamGiaHoatDong']) ? $_GET['maThamGiaHoatDong'] : die(); //Lấy id từ phương thức GET
    
        $item->getSingleThamGiaHoatDong();
        if($item->maHoatDong != null){
            // create array
            $thamgiahoatdong_arr = array(
                "maThamGiaHoatDong" =>  $item->maThamGiaHoatDong,
                "maHoatDong" => $item->maHoatDong,
                "maSinhVienThamGia" => $item->maSinhVienThamGia
            );
        
            http_response_code(200);
            echo json_encode($thamgiahoatdong_arr);
        }
        
        else{
            http_response_code(404);
            echo json_encode("thamgiahoatdong not found.");
        }
    }
?>