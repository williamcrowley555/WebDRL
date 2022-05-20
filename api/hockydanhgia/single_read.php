<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../class/hockydanhgia.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';

$read_data = new read_data();
$data = $read_data->read_token();

// kiểm tra đăng nhập thành công 
if ($data["status"] == 1) {
    //if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {
        $database = new Database();
        $db = $database->getConnection();
        $item = new HocKyDanhGia($db);
        $item->maHocKyDanhGia = isset($_GET['maHocKyDanhGia']) ? $_GET['maHocKyDanhGia'] : die(); //Lấy id từ phương thức GET

        $item->getSingleHocKyDanhGia();
        if ($item->hocKyXet != null) {
            // create array
            $hockydanhgia_arr = array(
                "maHocKyDanhGia" =>  $item->maHocKyDanhGia,
                "hocKyXet" => $item->hocKyXet,
                "namHocXet" => $item->namHocXet
            );

            http_response_code(200);
            echo json_encode($hockydanhgia_arr);
        } else {
            http_response_code(404);
            echo json_encode("hockydanhgia not found.");
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