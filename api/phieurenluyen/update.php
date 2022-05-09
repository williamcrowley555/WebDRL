<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../class/phieurenluyen.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';

$read_data = new read_data();
$data = $read_data->read_token();

// kiểm tra đăng nhập thành công 
if ($data["status"] == 1) {
    if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {

        $database = new Database();
        $db = $database->getConnection();

        $item = new PhieuRenLuyen($db);

        $data = json_decode(file_get_contents("php://input"));

        if ($data != null) {
            $item->maPhieuRenLuyen  = $data->maPhieuRenLuyen;

            //values
            $item->xepLoai = $data->xepLoai;
            $item->diemTongCong = $data->diemTongCong;
            $item->maSinhVien = $data->maSinhVien;
            $item->diemTrungBinhChungHKTruoc = $data->diemTrungBinhChungHKTruoc;
            $item->diemTrungBinhChungHKXet = $data->diemTrungBinhChungHKXet;
            $item->maHocKyDanhGia = $data->maHocKyDanhGia;

            if ($item->updatePhieuRenLuyen()) {
                echo json_encode("phieurenluyen data updated.");
            } else {
                echo json_encode("Data could not be updated");
            }
        } else {
            echo 'No data posted.';
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
