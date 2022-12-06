<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../class/diemtrungbinhhe4.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';

$read_data = new read_data();
$data = $read_data->read_token();
$checkQuyen = new checkQuyen();

// kiểm tra đăng nhập thành công 
if ($data["status"] == 1) {
    //if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV_Admin($data["user_data"]->aud)) {
        $database = new Database();
        $db = $database->getConnection();

        $item = new DiemTrungBinhHe4($db);

        $data = json_decode(file_get_contents("php://input"));

        if ($data != null) {
            $item->maDiemTrungBinh  = $data->maDiemTrungBinh;

            //values
            $item->diem = $data->diem;
            $item->maHocKyDanhGia = $data->maHocKyDanhGia;
            $item->maSinhVien = $data->maSinhVien;

            if ($item->updateDiemTrungBinhHe4()) {
                echo json_encode("Cập nhật Diemtrungbinhhe4 thành công!");
            } else {
                echo json_encode("Điểm chỉnh sửa không hợp lệ!");
            }
        } else {
            echo 'No data posted.';
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