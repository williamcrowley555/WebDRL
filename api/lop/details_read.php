<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/lop.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        //if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV_Admin($data["user_data"]->aud)) {
            
            if (isset($_GET['maLop'])) {
                $GET_maLop = $_GET['maLop'];
            } else {
                $GET_maLop = null;
            }
            
            $database = new Database();
            $db = $database->getConnection();
            
            if($GET_maLop != null) {
                $item = new Lop($db);
                $item->maLop = $GET_maLop; 
            
                $item->getSingleLopDetails();
                if($item->tenLop != null) {
                    // create array
                    $lop_arr = array(
                        "maLop" =>  $item->maLop,
                        "tenLop" => $item->tenLop,
                        "maKhoa" => $item->maKhoa,
                        "tenKhoa" => $item->tenKhoa,
                        "maCoVanHocTap" => $item->maCoVanHocTap,
                        "hoTenCoVan" => $item->hoTenCoVan,
                        "soDienThoaiCoVan" => $item->soDienThoaiCoVan,
                        "maKhoaHoc" => $item->maKhoaHoc
                    );
                
                    http_response_code(200);
                    echo json_encode($lop_arr);
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không tìm thấy dữ liệu.")
                    );
                
                }
            } 
        // } else {
        //         http_response_code(403);
        //         echo json_encode(
        //             array("message" => "Bạn không có quyền thực hiện điều này!")
        //         );
        // }
       
    } else {
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }
    
?>