<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/thamgiahoatdong.php';
    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

        $database = new Database();
        $db = $database->getConnection();

        $item = new ThamGiaHoatDong($db); //new Khoa object
        $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 

        if ($data != null){
            //set các biến bằng data nhận từ user
            $item->maHoatDong = $data->maHoatDong;
            $item->maSinhVienThamGia = $data->maSinhVienThamGia;

            if($item->createThamGiaHoatDong()){
                echo 'thamgiahoatdong created successfully.';
            } else{
                echo 'thamgiahoatdong could not be created.';
            }
        }else{
            echo 'No data posted.';
        }
    }
    

?>