<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/phongcongtacsinhvien.php';
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
    
            $item = new PhongCongTacSinhVien($db); //new SinhVien object
            $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 
    
            if ($data != null){
                //set các biến bằng data nhận từ user
                $item->taiKhoan = $data->taiKhoan;
                $item->hoTenNhanVien = $data->hoTenNhanVien;     
                $item->email = $data->email; 
                $item->sodienthoai = $data->sodienthoai; 
                $item->matKhau =md5($data->taiKhoan);
                $item->quyen = $data->quyen;
                $item->kichHoat = $data->kichHoat;

                $stmt = $item->getPhongCTSVTheoEmail($data->email, true);
                $itemCount = $stmt->rowCount();

                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Email vừa tạo đã bị trùng! Vui lòng nhập email khác!")
                    );
                    return;
                }

                $stmt = $item->getPhongCtsvTheoSdt($data->sodienthoai, true);
                $itemCount = $stmt->rowCount();

                if($itemCount > 0) {
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Số điện thoại vừa tạo đã bị trùng! Vui lòng nhập số điện thoại khác!")
                    );
                    return;
                }
    
                if($item->createPhongCTSV()){
                    http_response_code(200);
                    echo json_encode(
                        array("message" => "phongcongtacsinhvien tạo thành công.")
                    );
                } else{
                    http_response_code(404);
                    echo json_encode(
                        array("message" => "Id vừa tạo đã bị trùng! Vui lòng nhập mã khác!")
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