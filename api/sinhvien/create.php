<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/sinhvien.php';
    include_once '../auth/read-data.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

        $database = new Database();
        $db = $database->getConnection();

        $item = new SinhVien($db); //new Khoa object
        $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 

        if ($data != null){
            //set các biến bằng data nhận từ user
            $item->maSinhVien = $data->maSinhVien;
            $item->hoTenSinhVien = $data->hoTenSinhVien;
            $item->ngaySinh = $data->ngaySinh;        
            $item->he = $data->he;
            $item->matKhauSinhVien =md5($data->matKhauSinhVien);
            $item->maLop = $data->maLop;

            if($item->createSinhVien()){
                echo 'sinhvien created successfully.';
            } else{
                echo 'sinhvien could not be created.';
            }
        }else{
            echo 'No data posted.';
        }
    }
    

?>