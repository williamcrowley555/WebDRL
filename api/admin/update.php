<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../class/admin.php';
include_once '../../class/phongcongtacsinhvien.php';
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

        $itemAdmin = new Admin($db);
        $itemCTSV = new PhongCongTacSinhVien($db);

        $data = json_decode(file_get_contents("php://input"));

        if ($data != null) {
            $itemAdmin->taiKhoan  = $data->taiKhoan;

            //values
            $itemAdmin->hoTen = $data->hoTen;
            $itemAdmin->email = $data->email; 
            $itemAdmin->soDienThoai = $data->soDienThoai;

            $stmt = $itemAdmin->getAdminTheoEmail($data->email, true);
            $itemCount = $stmt->rowCount();

            if($itemCount > 1) {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Email bị trùng! Vui lòng nhập email khác!")
                );
                return;
            }

            $stmt = $itemCTSV->getPhongCTSVTheoEmail($data->email, true);
            $itemCount = $stmt->rowCount();

            if($itemCount > 0) {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Email bị trùng! Vui lòng nhập email khác!")
                );
                return;
            }

            $stmt = $itemAdmin->getAdminTheoSdt($data->soDienThoai, true);
            $itemCount = $stmt->rowCount();

            if($itemCount > 1) {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Số điện thoại bị trùng! Vui lòng nhập số điện thoại khác!")
                );
                return;
            }

            $stmt = $itemCTSV->getPhongCTSVTheoSdt($data->soDienThoai, true);
            $itemCount = $stmt->rowCount();

            if($itemCount > 0) {
                http_response_code(404);
                echo json_encode(
                    array("message" => "Số điện thoại bị trùng! Vui lòng nhập số điện thoại khác!")
                );
                return;
            }
            
            if ($itemAdmin->updateAdmin()) {
                http_response_code(200);
                echo json_encode(
                    array("message" => "admin cập nhật thành công.")
                );
            } else {
                http_response_code(500);
                echo json_encode(
                    array("message" => "admin cập nhật KHÔNG thành công.")
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
