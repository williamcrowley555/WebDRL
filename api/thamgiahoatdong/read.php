<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/thamgiahoatdong.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';

$read_data = new read_data();
$data = $read_data->read_token();

// kiểm tra đăng nhập thành công 
if ($data["status"] == 1) {
    if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {
        $database = new Database();
        $db = $database->getConnection();

        $items = new ThamGiaHoatDong($db);
        $stmt = $items->getAllThamGiaHoatDong();
        $itemCount = $stmt->rowCount();


        echo json_encode($itemCount); //print itemCount
        if ($itemCount > 0) {
            $thamgiahoatdongArr = array();
            $thamgiahoatdongArr["thamgiahoatdong"] = array(); //tạo object json 
            $thamgiahoatdongArr["itemCount"] = $itemCount;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $e = array(
                    "maThamGiaHoatDong" => $maThamGiaHoatDong,
                    "maHoatDong" => $maHoatDong,
                    "maSinhVienThamGia" => $maSinhVienThamGia
                );
                array_push($thamgiahoatdongArr["thamgiahoatdong"], $e);
            }
            echo json_encode($thamgiahoatdongArr);
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
?>