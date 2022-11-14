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

        $itemCTSV = new PhongCongTacSinhVien($db);
        $itemAdmin = new Admin($db);

        $data = json_decode(file_get_contents("php://input"));

        if ($data != null) {

            //Kiểm tra tồn tại ctsv?
            $stmt = $itemCTSV->getPhongCTSVTheoTaiKhoan($data->taiKhoan, true);
            $itemCount = $stmt->rowCount();
            if($itemCount == 1) {
                $itemCTSV->taiKhoan  = $data->taiKhoan;

                //values
                $itemCTSV->hoTenNhanVien = $data->hoTenNhanVien;
                $itemCTSV->email = $data->email; 
                $itemCTSV->sodienthoai = $data->sodienthoai;
                $itemCTSV->quyen = $data->quyen;
                // Nếu tồn tại ctsv, thực hiện update như thông thường
                
                //Kiểm tra tồn tại email?
                $stmt = $itemCTSV->getPhongCTSVTheoEmailUpdate($data->email, $data->taiKhoan,true);
                $itemCount = $stmt->rowCount();
    
                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Email bị trùng! Vui lòng nhập email khác!")
                    );
                    return;
                }
    
                $stmt = $itemAdmin->getAdminTheoEmail($data->email, true);
                $itemCount = $stmt->rowCount();
    
                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Email bị trùng! Vui lòng nhập email khác!")
                    );
                    return;
                }
    
                // Kiểm tra tồn tại sdt?
                $stmt = $itemCTSV->getPhongCTSVTheoSdtUpdate($data->sodienthoai, $data->taiKhoan, true);
                $itemCount = $stmt->rowCount();
    
                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Số điện thoại bị trùng! Vui lòng nhập số điện thoại khác!")
                    );
                    return;
                }
    
                $stmt = $itemAdmin->getAdminTheoSdt($data->sodienthoai, true);
                $itemCount = $stmt->rowCount();
    
                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Số điện thoại bị trùng! Vui lòng nhập số điện thoại khác!")
                    );
                    return;
                }
    
                if ($itemCTSV->updatePhongCTSV()) {
                    http_response_code(200);
                    echo json_encode(
                        array("message" => "phongctsv cập nhật thành công.")
                    );
                } else {
                    http_response_code(500);
                    echo json_encode(
                        array("message" => "phongctsv cập nhật KHÔNG thành công.")
                    );
                }

            } else {
                $itemCTSV->taiKhoan  = $data->taiKhoan;

                //values
                $itemCTSV->hoTenNhanVien = $data->hoTenNhanVien;
                $itemCTSV->email = $data->email; 
                $itemCTSV->sodienthoai = $data->sodienthoai;
                $itemCTSV->quyen = $data->quyen;
                $itemCTSV->matKhau = md5($data->taiKhoan);
                $itemCTSV->diaChi = null;
                $itemCTSV->kichHoat = 1;

                // Nếu không tìm thấy ctsv, tạo mới ctsv và xóa admin có tài khoản là $taiKhoan

                //Kiểm tra tồn tại email?
                $stmt = $itemCTSV->getPhongCTSVTheoEmail($data->email, true);
                $itemCount = $stmt->rowCount();
    
                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Email bị trùng! Vui lòng nhập email khác!")
                    );
                    return;
                }
    
                $stmt = $itemAdmin->getAdminTheoEmailUpdate($data->email, $data->taiKhoan, true);
                $itemCount = $stmt->rowCount();
    
                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Email bị trùng! Vui lòng nhập email khác!")
                    );
                    return;
                }
    
                // Kiểm tra tồn tại sdt?
                $stmt = $itemCTSV->getPhongCTSVTheoSdt($data->sodienthoai, true);
                $itemCount = $stmt->rowCount();
    
                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Số điện thoại bị trùng! Vui lòng nhập số điện thoại khác!")
                    );
                    return;
                }
    
                $stmt = $itemAdmin->getAdminTheoSdtUpdate($data->sodienthoai, $data->taiKhoan, true);
                $itemCount = $stmt->rowCount();
    
                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Số điện thoại bị trùng! Vui lòng nhập số điện thoại khác!")
                    );
                    return;
                }

                if ($itemCTSV->createPhongCTSV()) {
                    //Nếu thành công, xóa ctsv có tài khoản là $taiKhoan
                    $itemAdmin->taiKhoan  = $data->taiKhoan;
    
                    if ($itemAdmin->deleteAdmin()) {
                        http_response_code(200);
                        echo json_encode(
                            array("message" => "ctsv cập nhật thành công.")
                        );
                    } else {
                        http_response_code(500);
                        echo json_encode(
                            array("message" => "cstv cập nhật KHÔNG thành công.")
                        );
                    }
                } else {
                    http_response_code(500);
                    echo json_encode(
                        array("message" => "ctsv cập nhật KHÔNG thành công.")
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
