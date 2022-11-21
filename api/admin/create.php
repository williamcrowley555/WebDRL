<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/admin.php';
    include_once '../auth/read-data.php';
    include_once '../auth/check_quyen.php';

    $read_data = new read_data();
    $data=$read_data->read_token();
    $checkQuyen = new checkQuyen();

    // kiểm tra đăng nhập thành công 
    if($data["status"]==1){
        //if ($checkQuyen->checkQuyen_Khoa_CTSV_Admin($data["user_data"]->aud)) {
            $database = new Database();
            $db = $database->getConnection();
    
            $item = new Admin($db);
            $data = json_decode(file_get_contents("php://input")); //lấy request data từ user 
    
            if ($data != null){
                //set các biến bằng data nhận từ user
                $item->taiKhoan = $data->taiKhoan;
                $item->hoTen = $data->hoTen;     
                $item->email = $data->email; 
                $item->soDienThoai = $data->soDienThoai; 
                $item->matKhau =md5($data->taiKhoan);
                $item->quyen = $data->quyen;
                $item->kichHoat = $data->kichHoat;

                $stmt = $item->getAdminTheoEmail($data->email, true);
                $itemCount = $stmt->rowCount();

                if($itemCount > 0) {
                    showMessage(404, "Email vừa tạo đã bị trùng! Vui lòng nhập email khác!");
                    return;
                }

                $stmt = $item->getAdminTheoSdt($data->soDienThoai, true);
                $itemCount = $stmt->rowCount();

                if($itemCount > 0) {
                    showMessage(404, "Số điện thoại vừa tạo đã bị trùng! Vui lòng nhập số điện thoại khác!");
                    return;
                }
    
                if($item->createAdmin()){
                    showMessage(200, "admin tạo thành công!");
                } else{
                    showMessage(404, "Id vừa tạo đã bị trùng! Vui lòng nhập mã khác!");
                }
            }else{
                showMessage(404, "Không có dữ liệu gửi lên!");
            } 
        // } else {
        //     showMessage(403, "Bạn không có quyền thực hiện điều này!");
        // }
    } else {
        showMessage(403, "Vui lòng đăng nhập trước!");
    }

    function showMessage($responseNumber, $message) {
        http_response_code($responseNumber);
        echo json_encode(
            array("message" => $message)
        );
    }
?>