<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

include_once '../../config/database.php';
include_once '../../class/diemtrungbinhhe4.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';

$read_data = new read_data();
$data = $read_data->read_token();
$checkQuyen = new checkQuyen();

// kiểm tra đăng nhập thành công 
if ($data["status"] == 1) {
    // if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV_Admin($data["user_data"]->aud)) {

        if (isset($_GET['maSinhVien'])) {
            $maSinhVien = $_GET['maSinhVien'];
        } else {
            $maSinhVien = null;
        }

        if (isset($_GET['maHocKyDanhGia'])) {
            $maHocKyDanhGia = $_GET['maHocKyDanhGia'];
        } else {
            $maHocKyDanhGia = null;
        }
        
        $database = new Database();
        $db = $database->getConnection();

        if($maSinhVien != null && $maHocKyDanhGia != null) {
            $item = new DiemTrungBinhHe4($db);
            $item->getSingleTheoMSSVVaMaHKDG($maSinhVien, $maHocKyDanhGia);

            if ($item->maDiemTrungBinh != null) {
                $diemtrungbinhhe4Arr = array(
                    "maDiemTrungBinh" => $item->maDiemTrungBinh,
                    "diem" => $item->diem,
                    "maHocKyDanhGia" => $item->maHocKyDanhGia,
                    "maSinhVien" => $item->maSinhVien,
                );
                
                http_response_code(200);
                echo json_encode($diemtrungbinhhe4Arr);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }
        }
    // }
}
?>