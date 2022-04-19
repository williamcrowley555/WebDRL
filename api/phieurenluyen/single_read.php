<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/phieurenluyen.php';
    include_once '../auth/read-data.php';
    
    $read_data = new read_data();
    $data=$read_data->read_token();
    
    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){

        $database = new Database();
        $db = $database->getConnection();
        $item = new PhieuRenLuyen($db);
        $item->maPhieuRenLuyen = isset($_GET['maPhieuRenLuyen']) ? $_GET['maPhieuRenLuyen'] : die(); //Lấy id từ phương thức GET
    
        $item->getSinglePhieuRenLuyen();
        if($item->xepLoai != null){
            // create array
            $phieurenluyen_arr = array(
                "maPhieuRenLuyen" =>  $item->maPhieuRenLuyen,
                "xepLoai" => $item->xepLoai,
                "diemTongCong" => $item->diemTongCong,
                "maSinhVien" => $item->maSinhVien,
                "maHocKyDanhGia" => $item->maHocKyDanhGia
            );
        
            http_response_code(200);
            echo json_encode($phieurenluyen_arr);
        }
        
        else{
            http_response_code(404);
            echo json_encode("phieurenluyen not found.");
        }
    }
?>