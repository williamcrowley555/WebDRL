<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/chucnang.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        //if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV_Admin($data["user_data"]->aud)) {
            if (isset($_GET['maChucNang'])) {
                $maChucNang = $_GET['maChucNang'];
            } else {
                $maChucNang = null;
            }

            if ($maChucNang != null) {
                $database = new Database();
                $db = $database->getConnection();
                $item = new ChucNang($db);
                $item->maChucNang = $maChucNang;
            
                $item->getSingleChucNang();
                if($item->tenChucNang != null) {
                    // create array
                    $chucNang_arr = array(
                        "maChucNang" =>  $item->maChucNang,
                        "tenChucNang" => $item->tenChucNang,
                        "kichHoat" => $item->kichHoat,
                        "moTa" => $item->moTa
                    );
                
                    http_response_code(200);
                    echo json_encode($chucNang_arr);
                } else {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Không tìm thấy dữ liệu.")
                    );
                }
            } 
        // } else {
        //     http_response_code(403);
        //     echo json_encode(
        //         array("message" => "Bạn không có quyền thực hiện điều này!")
        //     );
        // }
    } else {
        http_response_code(403);
        echo json_encode(
            array("message" => "Vui lòng đăng nhập trước!")
        );
    }

?>