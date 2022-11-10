<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../class/covanhoctap.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';


$read_data = new read_data();
$data = $read_data->read_token();
$checkQuyen = new checkQuyen();

// kiểm tra đăng nhập thành công 
if ($data["status"] == 1) {
    if ($checkQuyen->checkQuyen_Khoa_CTSV_Admin($data["user_data"]->aud)) {
        $database = new Database();
        $db = $database->getConnection();

        $item = new CVHT($db); //new Khoa object
        $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 

        if ($data != null) {
            //set các biến bằng data nhận từ user
            $item->maCoVanHocTap = $data->maCoVanHocTap;
            $item->hoTenCoVan = $data->hoTenCoVan;
            $item->soDienThoai = $data->soDienThoai;
            $item->email = $data->email;
            $item->maKhoa = $data->maKhoa;
            $item->matKhauTaiKhoanCoVan = md5($data->matKhauTaiKhoanCoVan);

            if ($item->createCVHT()) {
                http_response_code(200);
                echo json_encode(
                    array("message" => "Thêm cố vấn học tập thành công!")
                );
            } else {
                echo 'Thêm cố vấn học tập thất bại!';
            }
        } else {
            http_response_code(404);
            echo 'Không nhận được dữ liệu gửi lên.';
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