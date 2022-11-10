<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../class/hockydanhgia.php';
include_once '../auth/check_quyen.php';
include_once '../auth/read-data.php';

$read_data = new read_data();
$data = $read_data->read_token();
$checkQuyen = new checkQuyen();

// kiểm tra đăng nhập thành công 
if ($data["status"] == 1) {
    if ($checkQuyen->checkQuyen_CTSV_Admin($data["user_data"]->aud)) {
        $database = new Database();
        $db = $database->getConnection();

        $item = new HocKyDanhGia($db); //new HoatDongDanhGia object
        $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 

        if ($data != null) {
            //set các biến bằng data nhận từ user
            $item->maHocKyDanhGia = $data->maHocKyDanhGia;
            $item->hocKyXet = $data->hocKyXet;
            $item->namHocXet = $data->namHocXet;

            // $upload_path = './upload/'.$item->maHocKyDanhGia.'/';

            // //$upload_path = './upload/'.$item->maHocKyDanhGia.'/'.$item->maSinhVien.'/';

            // if (!is_dir($upload_path)){
            //     mkdir($upload_path, 0777, true);
            // }

            if ($item->createHocKyDanhGia()) {
                http_response_code(200);
                echo json_encode(
                    array("message" => "hockydanhgia tạo thành công.")
                );
            } else {
                http_response_code(500);
                echo json_encode(
                    array("message" => "hockydanhgia tạo KHÔNG thành công.")
                );
            }
        } else {
            http_response_code(403);
            echo json_encode(
                array("message" => "Không có dữ liệu gửi lên.")
            );
        }
    } else {
        http_response_code(403);
        echo json_encode(
            array("message" => "Bạn không có quyền thực hiện điều này!")
        );
    }
} else {
    http_response_code(403);
    echo json_encode(
        array("message" => "Vui lòng đăng nhập trước!")
    );
}

?>
