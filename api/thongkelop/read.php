<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/thongke.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';

$database = new Database();
$db = $database->getConnection();

$read_data = new read_data();
$data = $read_data->read_token();
$checkQuyen = new checkQuyen();

// kiểm tra đăng nhập thành công và có phải giáo viên không
if ($data["status"] == 1) {
    if ($checkQuyen->checkQuyen_CVHT_Khoa_CTSV($data["user_data"]->aud)) {

        if (isset($_GET['maLop'])) {
            $GET_maLop = $_GET['maLop'];
        } else {
            $GET_maLop = null;
        }

        if (isset($_GET['maHocKyDanhGia'])) {
            $GET_maHocKyDanhGia = $_GET['maHocKyDanhGia'];
        } else {
            $GET_maHocKyDanhGia = null;
        }

        if ($GET_maLop != null && $GET_maHocKyDanhGia != null) {
            $items = new ThongKe($db);
            
            $stmt = $items->getSoSinhVienDaDuyet($GET_maLop, $GET_maHocKyDanhGia);
    
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                
                $thongKe_arr = array(
                    "maLop" =>  $maLop,
                    "siSo" => $siSo,
                    "coVanDaDuyet" =>  $coVanDaDuyet,
                    "khoaDaDuyet" => $khoaDaDuyet
                );

                http_response_code(200);
                echo json_encode($thongKe_arr);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Không tìm thấy kết quả.")
                );
            }
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