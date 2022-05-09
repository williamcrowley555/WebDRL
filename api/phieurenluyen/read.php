<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/phieurenluyen.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';


$read_data = new read_data();
$data = $read_data->read_token();

// kiểm tra đăng nhập thành công và có phải giáo viên không
if ($data["status"] == 1 && $data['user_data']->aud == "cvht") {
    if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {
        $database = new Database();
        $db = $database->getConnection();
        $items = new PhieuRenLuyen($db);
        $stmt = $items->getAllPhieuRenLuyen();
        $itemCount = $stmt->rowCount();


        if ($itemCount > 0) {
            $phieurenluyenArr = array();
            $phieurenluyenArr["phieurenluyen"] = array(); //tạo object json 
            $phieurenluyenArr["itemCount"] = $itemCount;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $e = array(
                    "maPhieuRenLuyen" => $maPhieuRenLuyen,
                    "xepLoai" => $xepLoai,
                    "diemTongCong" => $diemTongCong,
                    "maSinhVien" => $maSinhVien,
                    "diemTrungBinhChungHKTruoc" => $diemTrungBinhChungHKTruoc,
                    "diemTrungBinhChungHKXet" => $diemTrungBinhChungHKXet,
                    "maHocKyDanhGia" => $maHocKyDanhGia
                );
                array_push($phieurenluyenArr["phieurenluyen"], $e);
            }
            echo json_encode($phieurenluyenArr);
        } else {
            http_response_code(404);
            echo json_encode(
                array("message" => "No record found.")
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
