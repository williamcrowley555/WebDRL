<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../class/sinhvien.php';
include_once '../auth/read-data.php';
include_once '../auth/check_quyen.php';

$read_data = new read_data();
$data = $read_data->read_token();
$checkQuyen = new checkQuyen();

// kiểm tra đăng nhập thành công 
if ($data["status"] == 1) {
    if ($checkQuyen->checkQuyen_Khoa_CTSV($data["user_data"]->aud)) {
        $database = new Database();
        $db = $database->getConnection();

        $item = new SinhVien($db);

        $data = json_decode(file_get_contents("php://input"));

        if ($data != null) {
                $item->maSinhVien  = $data->maSinhVien;

                //values
                $item->hoTenSinhVien = $data->hoTenSinhVien;
                // $item->ngaySinh = $data->ngaySinh;
                // $item->email = $data->email; 
                // $item->sdt = $data->sdt;
                // $item->he = $data->he;
                // $item->maLop = $data->maLop;
                $item->totNghiep = $data->totNghiep;

                if ($item->updateSinhVien_XetTotNghiep()) {
                    http_response_code(200);
                    echo json_encode(
                        array("message" => "sinhvien xét tốt nghiệp thành công.")
                    );
                } else {
                    http_response_code(500);
                    echo json_encode(
                        array("message" => "sinhvien xét tốt nghiệp KHÔNG thành công.")
                    );
                }
            
        } else {
            http_response_code(404);
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