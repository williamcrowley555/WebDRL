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
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        if ($checkQuyen->checkQuyen_Khoa_CTSV_Admin($data["user_data"]->aud)) {
            $database = new Database();
            $db = $database->getConnection();
    
            $item = new SinhVien($db); //new SinhVien object
            $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 
    
            if ($data != null){
                //set các biến bằng data nhận từ user
                $item->maSinhVien = $data->maSinhVien;
                $item->hoTenSinhVien = $data->hoTenSinhVien;
                $item->ngaySinh = $data->ngaySinh;     
                $item->email = $data->email; 
                $item->sdt = $data->sdt;    
                $item->he = $data->he;
                $item->matKhauSinhVien =md5($data->matKhauSinhVien);
                $item->maLop = $data->maLop;
                $item->totNghiep = $data->totNghiep;

                $stmt = $item->getSinhVienTheoEmail($data->email, true);
                $itemCount = $stmt->rowCount();

                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Email vừa tạo đã bị trùng! Vui lòng nhập email khác!")
                    );
                    return;
                }

                $stmt = $item->getSinhVienTheoSdt($data->sdt, true);
                $itemCount = $stmt->rowCount();

                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Số điện thoại vừa tạo đã bị trùng! Vui lòng nhập số điện thoại khác!")
                    );
                    return;
                }
    
                if($item->createSinhVien()){
                    http_response_code(200);
                    echo json_encode(
                        array("message" => "sinhvien tạo thành công.")
                    );
                } else{
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Mã sinh viên vừa tạo đã bị trùng! Vui lòng nhập mã khác!")
                    );
                }
            }else{
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
    ?>