<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/hoatdongdanhgia.php';
    include_once '../auth/read-data.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
    
        $database = new Database();
        $db = $database->getConnection();
        
        $item = new HoatDongDanhGia($db);
        
        $data = json_decode(file_get_contents("php://input"));
        
        if ($data != null){
            $item->maHoatDong = $data->maHoatDong;
        
            if($item->deleteHoatDongDanhGia()){
                echo json_encode("HoatDongDanhGia deleted.");
            } else{
                echo json_encode("Data could not be deleted");
            }
        }else{
            echo 'No data posted.';
        }
    }
   

?>