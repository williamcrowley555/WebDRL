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

            //Nếu có gửi matKhauSinhVien thì -> chức năng đặt lại mật khẩu, ngược lại là chức năng chỉnh sửa
            if (isset($data->matKhauSinhVien)){
                $item->maSinhVien  = $data->maSinhVien;

                //values
                $item->hoTenSinhVien = $data->hoTenSinhVien;
                $item->ngaySinh = $data->ngaySinh;
                $item->email = $data->email; 
                $item->sdt = $data->sdt;
                $item->he = $data->he;
                $item->matKhauSinhVien = md5($data->matKhauSinhVien);
                $item->maLop = $data->maLop;
                $item->totNghiep = $data->totNghiep;
    
                if ($item->updateSinhVien()) {
                    http_response_code(200);
                    echo json_encode(
                        array("message" => "sinhvien cập nhật thành công.")
                    );
                } else {
                    http_response_code(500);
                    echo json_encode(
                        array("message" => "sinhvien cập nhật KHÔNG thành công.")
                    );
                }
            }else{
                $item->maSinhVien  = $data->maSinhVien;

                //values
                $item->hoTenSinhVien = $data->hoTenSinhVien;
                $item->ngaySinh = $data->ngaySinh;
                $item->email = $data->email; 
                $item->sdt = $data->sdt;
                $item->he = $data->he;
                $item->maLop = $data->maLop;
                $item->totNghiep = $data->totNghiep;

                $stmt = $item->getSinhVienTheoEmail($data->email, true);
                $itemCount = $stmt->rowCount();

                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Email bị trùng! Vui lòng nhập email khác!")
                    );
                    return;
                }

                $stmt = $item->getSinhVienTheoSdt($data->sdt, true);
                $itemCount = $stmt->rowCount();

                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Số điện thoại  bị trùng! Vui lòng nhập số điện thoại khác!")
                    );
                    return;
                }


                if ($item->updateSinhVien_KhongMatKhau()) {
                    http_response_code(200);
                    echo json_encode(
                        array("message" => "sinhvien cập nhật thành công.")
                    );
                } else {
                    http_response_code(500);
                    echo json_encode(
                        array("message" => "sinhvien cập nhật KHÔNG thành công.")
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
