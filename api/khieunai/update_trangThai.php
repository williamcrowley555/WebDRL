<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../class/khieunai.php';
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

        $item = new KhieuNai($db);

        $data = json_decode(file_get_contents("php://input"));

        if ($data != null) {

            if (isset($data->maKhieuNai) && isset($data->trangThai)) {
                $item->maKhieuNai = $data->maKhieuNai;

                //values
                $item->trangThai = $data->trangThai;
                $item->loiNhan = $data->trangThai == '1' ? $data->loiNhan : null;
                $item->lyDoTuChoi = $data->trangThai == '-1' ? $data->lyDoTuChoi : null;
    
                if ($item->updateKhieuNai_TrangThai()) {
                    http_response_code(200);
                    echo json_encode(
                        array("message" =>  "Phê duyệt thành công")
                    );
                } else {
                    http_response_code(500);
                    echo json_encode(
                        array("message" => "Phê duyệt thất bại")
                    );
                }
            }
        } else {
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
