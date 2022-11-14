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
            
            //Kiểm tra tồn tại admin?
            $stmt = $itemAdmin->getAdminTheoTaiKhoan($data->taiKhoan, true);
            $itemCount = $stmt->rowCount();
            if($itemCount == 1) {
                $itemAdmin->taiKhoan  = $data->taiKhoan;

                //values
                $itemAdmin->hoTen = $data->hoTen;
                $itemAdmin->email = $data->email; 
                $itemAdmin->soDienThoai = $data->soDienThoai;
                $itemAdmin->quyen = $data->quyen;
                // Nếu tồn tại admin, thực hiện update như thông thường

                // Kiểm tra tồn tại email?
                $stmt = $itemAdmin->getAdminTheoEmailUpdate($data->email, $data->taiKhoan, true);
                $itemCount = $stmt->rowCount();

                if($itemCount > 0) {
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

                // Kiểm tra tồn tại sdts
                $stmt = $itemAdmin->getAdminTheoSdtUpdate($data->soDienThoai, $data->taiKhoan,true);
                $itemCount = $stmt->rowCount();

                if($itemCount > 0) {
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
                
                // Update admin
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
                // Nếu không tìm thấy admin, tạo mới admin và xóa CTSV có tài khoản là $taiKhoan
                $itemAdmin->taiKhoan  = $data->taiKhoan;

                //values
                $itemAdmin->hoTen = $data->hoTen;
                $itemAdmin->email = $data->email; 
                $itemAdmin->soDienThoai = $data->soDienThoai;
                $itemAdmin->matKhau = md5($data->taiKhoan);
                $itemAdmin->quyen = $data->quyen;
                $itemAdmin->kichHoat = 1;
                
                //Kiểm tra tồn tại email trong admin
                $stmt = $itemAdmin->getAdminTheoEmail($data->email, true);
                $itemCount = $stmt->rowCount();

                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Email bị trùng! Vui lòng nhập email khác!")
                    );
                    return;
                }

                $stmt = $itemCTSV->getPhongCTSVTheoEmailUpdate($data->email, $data->taiKhoan, true);
                $itemCount = $stmt->rowCount();

                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Email bị trùng! Vui lòng nhập email khác!")
                    );
                    return;
                }
                
                // Kiểm tra tồn tại sdt trong admin
                $stmt = $itemAdmin->getAdminTheoSdt($data->soDienThoai, true);
                $itemCount = $stmt->rowCount();

                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Số điện thoại bị trùng! Vui lòng nhập số điện thoại khác!")
                    );
                    return;
                }
                
                $stmt = $itemCTSV->getPhongCTSVTheoSdtUpdate($data->soDienThoai, $data->taiKhoan, true);
                $itemCount = $stmt->rowCount();

                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Số điện thoại bị trùng! Vui lòng nhập số điện thoại khác!")
                    );
                    return;
                }

                // Tạo mới admin
                if ($itemAdmin->createAdmin()) {
                    //Nếu thành công, xóa ctsv có tài khoản là $taiKhoan
                    $itemCTSV->taiKhoan  = $data->taiKhoan;

                    if ($itemCTSV->deletePhongCTSV()) {
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
                    http_response_code(500);
                    echo json_encode(
                        array("message" => "admin cập nhật KHÔNG thành công.")
                    );
                }
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
