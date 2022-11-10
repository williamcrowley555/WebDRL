<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../class/hoatdongdanhgia.php';
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

        $item = new HoatDongDanhGia($db);

        $data = json_decode(file_get_contents("php://input"));

        if ($data != null) {
            $item->maHoatDong  = $data->maHoatDong;

            //values
            $item->maTieuChi3 = $data->maTieuChi3;
            $item->maTieuChi2 = $data->maTieuChi2;
            $item->maKhoa = $data->maKhoa;
            $item->tenHoatDong = $data->tenHoatDong;
            $item->diemNhanDuoc = $data->diemNhanDuoc;
            $item->diaDiemDienRaHoatDong = $data->diaDiemDienRaHoatDong;
            $item->maHocKyDanhGia = $data->maHocKyDanhGia;
            $item->thoiGianBatDauDiemDanh = $data->thoiGianBatDauDiemDanh;
            $item->thoiGianBatDauHoatDong = $data->thoiGianBatDauHoatDong;
            $item->thoiGianKetThucHoatDong = $data->thoiGianKetThucHoatDong;

            if ($item->updateHoatDongDanhGia()) {
                http_response_code(200);
                echo json_encode(
                    array("message" => "Hoatdongdanhgia cập nhật thành công!")
                ); 
            } else {
                http_response_code(500);
                echo json_encode(
                    array("message" => "Hoatdongdanhgia cập nhật KHÔNG thành công!")
                );
            }
        } else {
            http_response_code(404);
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



?>