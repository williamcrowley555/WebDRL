<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../class/chamdiemrenluyen.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';


$read_data = new read_data();
$data = $read_data->read_token();
$checkQuyen = new checkQuyen();

// kiểm tra đăng nhập thành công 
if ($data["status"] == 1) {
    if ($checkQuyen->checkQuyen_CTSV($data["user_data"]->aud)) {
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
$database = new Database();
$db = $database->getConnection();

$items = new ChamDiemRenLuyen($db);
$stmt = $items->getAllChamDiemRenLuyen();
$itemCount = $stmt->rowCount();


if ($itemCount > 0) {
    $ChamDiemRenLuyenArr = array();
    $ChamDiemRenLuyenArr["ChamDiemRenLuyen"] = array(); //tạo object json 
    $ChamDiemRenLuyenArr["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $e = array(
            "maChamDiemRenLuyen" => $maChamDiemRenLuyen,
            "maTieuChi2" => $maTieuChi2,
            "maTieuChi3" => $maTieuChi3,
            "maSinhVien" => $maSinhVien,
            "diemSinhVienDanhGia" => $diemSinhVienDanhGia,
            "diemLopDanhGia" => $diemLopDanhGia,
           
        );
        array_push($ChamDiemRenLuyenArr["ChamDiemRenLuyen"], $e);
    }
    echo json_encode($ChamDiemRenLuyenArr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}
